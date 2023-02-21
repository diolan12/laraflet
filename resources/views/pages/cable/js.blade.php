<script>
    function getMiddle(prop, markers) {
        let values = markers.map(m => m[prop]);
        let min = Math.min(...values);
        let max = Math.max(...values);
        if (prop === 'lng' && (max - min > 180)) {
            values = values.map(val => val < max - 180 ? val + 360 : val);
            min = Math.min(...values);
            max = Math.max(...values);
        }
        let result = (min + max) / 2;
        if (prop === 'lng' && result > 180) {
            result -= 360
        }
        return result;
    }

    function findCenter(markers) {
        return {
            lat: getMiddle('0', markers),
            lng: getMiddle('1', markers)
        }
    }

    function saveLine(evt) {
        var hop = evt.target.options.extraData;
        // console.log(evt.target.options.extraData);
        // console.log(evt.target.editing.latlngs);
        var data = {
            latlngs: JSON.stringify(evt.target.editing.latlngs[0])
        }
        console.log(data);
        $.post('/api/hop-line/'+hop.id, data, (response, status) => {
            // stos.push(L.marker(_tempEv.latlng, {
            //     // draggable: true
            // }).bindPopup("<b>STO " + name + "</b>"))
            // reinitSTO();
            // modalNewWitel.close()
            console.log(response);
            M.toast({
                text: 'Saved'
            })
        }).fail(() => {
            M.toast({
                text: 'Gagal menyimpan'
            })
        });
    }
    const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });

    var connection = payload.data.connection;
    var centerView = findCenter([connection.from.point.coordinates.reverse(), connection.to.point.coordinates
    .reverse()]);
    var stos = [];
    var titikSambung = [];
    var hops = [];

    stos.push(L.marker(connection.from.point.coordinates, {}));
    stos.push(L.marker(connection.to.point.coordinates, {}));

    connection.break_points.map((break_point) => {
        titikSambung.push(L.marker(break_point.point.coordinates.reverse(), {}));
    });
    connection.hops.map((hop) => {
        hop.line.coordinates.map((l) => {
            l.reverse()
        });
        var hopLine = L.polyline(hop.line.coordinates, {
            editable: true,
            extraData: hop
        });
        hopLine.on('edit', saveLine)
        hops.push(hopLine);
    });
    // console.log(cable)
    // cable.line.coordinates.map((point) => {
    //     _points.push([point[1], point[0]])
    //     pin = L.marker([point[1], point[0]], {
    //         draggable: true
    //     })
    //     pin.on('drag', (e) => {
    //         // save
    //         _latLng = e.latlng
    //         console.log(e.latlng)
    //     })
    //     rawPoints.push(pin)
    // })


    // var rawCable = L.polyline(_points, {
    //     color: 'green'
    // }).bindPopup("<b>" + cable.name + '</b><br><a href="/c/' + cable.id + '">Edit</a>');
    // rawCable.on('edit', (ev)=>{
    //     console.log(ev.target.editing.latlngs)
    // })
    // rawCable.editing.enable();

    var cables = L.layerGroup(hops);
    var lgSto = L.layerGroup(stos);
    var lgTitikSambung = L.layerGroup(titikSambung);

    var map = L.map('map', {
        // center: payload.data.centerView.reverse(),
        center: centerView,
        zoom: 13,
        layers: [osm, cables, lgSto, lgTitikSambung]
    });

    function onMapClick(ev) {
        console.log(ev)
    }
    map.on('click', onMapClick);

    var overlayMaps = {
        "Kabel": cables,
        "STO": lgSto,
        "Titik Sambung": lgTitikSambung,
    };
    var layerControl = L.control.layers(null, overlayMaps).addTo(map);
</script>
