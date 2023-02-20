<div>
    <div id="map"></div>
</div>

<script>
    const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });

    var cable = payload.data.cable;
    var rawPoints = [];


    console.log(cable)
    var _points = [];
    cable.line.coordinates.map((point) => {
        _points.push([point[1], point[0]])
        pin = L.marker([point[1], point[0]], {
            draggable: true
        })
        pin.on('drag', (e) => {
            // save
            _latLng = e.latlng
            console.log(e.latlng)
        })
        rawPoints.push(pin)
    })


    var rawCable = L.polyline(_points, {
        color: 'green'
    }).bindPopup("<b>" + cable.name + '</b><br><a href="/c/' + cable.id + '">Edit</a>');
    rawCable.on('edit', (ev)=>{
        console.log(ev.target.editing.latlngs)
    })
    rawCable.editing.enable();

    var cables = L.layerGroup([rawCable]);
    var points = L.layerGroup(rawPoints);

    var map = L.map('map', {
        center: payload.data.centerView.reverse(),
        zoom: 13,
        layers: [osm, cables, points]
    });

    function onMapClick(ev) {
        console.log(ev)
    }
    map.on('click', onMapClick);

    var overlayMaps = {
        "Kabel": cables,
        "Titik": points,
    };
    var layerControl = L.control.layers(null, overlayMaps).addTo(map);
</script>
