<script>
    let map;
    // set center map position by default x y value
    var centerPosition = [-7.299684190520188, 112.76444435119629];

    var elem = document.getElementById('modal-new_witel')
    var elemConnModal = document.getElementById('modal-new_connection')
    var modalNewWitel = M.Modal.getInstance(elem)
    var modalNewConn = M.Modal.getInstance(elemConnModal)
    var selectAsal = $('#new-sto-asal')
    var selectTujuan = $('#new-sto-tujuan')


    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        this.centerPosition = [position.coords.latitude, position.coords.longitude]
        map.setView(this.centerPosition)
    }

    function enableTujuan(ev) {
        console.log(ev.value);
        selectTujuan.prop("disabled", false);
        $('select').formSelect();
    }
    this.onReady(() => {
        getLocation()

        modalNewWitel = M.Modal.getInstance(elem)
        modalNewWitel.options.onCloseStart = () => {
            _tempEv = null;
            $('#sto-name').val('')
            $('#sto-abbr').val('')
            M.updateTextFields();
        }
        modalNewConn = M.Modal.getInstance(elemConnModal)
        modalNewConn.options.onCloseStart = () => {
            selectAsal.val('')
            selectTujuan.prop("disabled", true);
            $('select').formSelect();
            M.updateTextFields();
        }
    })

    const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });

    var stos = [];
    var titikSambung = [];
    var conns = [];

    payload.data.locations.map((location) => {
        stos.push(L.marker(location.point.coordinates.reverse(), {
            extra: location
        }).on('click', (ev) => {
            // open modal
            console.log(ev);
        }).bindPopup("<b>" + location.type.toUpperCase() + " " + location.name + "</b>"))
    })
    payload.data.connections.map((connection) => {
        let a = [connection.from.point.coordinates.reverse(), connection.to.point.coordinates.reverse()];
        let pl = L.polyline(a, {
            color: 'yellow'
        });
        pl.bindPopup("<b>" + connection.from.abbreviation + '-' + connection.to.abbreviation +
            '</b><br><a href="/c/' + connection.id + '"">Edit<a>').openPopup();
        // pl.editing.enable();
        conns.push(pl)
        connection.break_points.map((breakPoint) => {
            titikSambung.push(L.marker(breakPoint.point.coordinates.reverse()));
        });
    });
    // payload.data.fos.map((fo) => {
    //     var _points = []

    //     console.log("fiber optik " + fo.name, fo.cable_line.coordinates)
    //     fo.cable_line.coordinates.map((point) => {
    //         _points.push(point.reverse())
    //     })
    //     conns.push(L.polyline(_points, {
    //         color: 'lime'
    //     }).bindPopup("<b>" + fo.name + '</b><br><a href="/c/' + fo.id + '"">Edit<a>').openPopup())
    // })

    var lgStos = L.layerGroup(stos);
    var lgTitikSambung = L.layerGroup(titikSambung);
    var lgConns = L.layerGroup(conns);

    map = L.map('map', {
        // editable: true,
        center: this.centerPosition,
        zoom: 15,
        layers: [osm, lgStos, lgTitikSambung, lgConns]
    });


    var overlayMaps = {
        "STO": lgStos,
        "Titik Sambung": lgTitikSambung,
        "Fiber optik": lgConns,
    };
    var layerControl = L.control.layers(null, overlayMaps).addTo(map);

    function onMapClick(ev) {
        console.log(ev)
    }

    function reinitSTO() {
        lgStos.clearLayers()
        lgStos.addLayer(L.layerGroup(stos))
    }

    function reinitConns() {
        lgConns.clearLayers()
        lgConns.addLayer(L.layerGroup(conns))
    }

    let _tempEv;

    function openModal(ev) {
        _tempEv = ev;
        // show modal for witel name
        modalNewWitel.open()

    }

    function saveSTO() {
        var name = $('#sto-name').val()
        if (name == '') {
            M.toast({
                text: 'Nama STO tidak boleh kosong'
            })
            return;
        }
        var abbr = $('#sto-abbr').val()
        if (abbr == '') {
            M.toast({
                text: 'Abbreviation STO tidak boleh kosong'
            })
            return;
        }
        abbr = abbr.toUpperCase();
        var data = {
            name: name,
            abbreviation: abbr,
            lat: _tempEv.latlng.lat,
            lng: _tempEv.latlng.lng
        };
        // async
        $.post('/api/location', data, (data, status) => {
            stos.push(L.marker(_tempEv.latlng, {
                // draggable: true
            }).bindPopup("<b>STO " + name + "</b>"))
            reinitSTO();
            modalNewWitel.close()
            M.toast({
                text: 'STO ' + name + ' (' + abbr + ') telah disimpan'
            })
        }).fail(() => {
            M.toast({
                text: 'Gagal menyimpan STO'
            })
        });
    }

    function saveConn() {
        var asal = selectAsal.val();
        if (asal == '') {
            M.toast({
                text: 'Pilih STO asal'
            })
            return;
        }
        var tujuan = selectTujuan.val();
        if (tujuan == '') {
            M.toast({
                text: 'Pilih STO tujuan'
            })
            return;
        }
        var data = {
            from: asal,
            to: tujuan
        };
        $.post('/api/connection', data, (data, status) => {
            console.log(data);
            let a = [data.from.point.coordinates.reverse(), data.to.point.coordinates.reverse()];
            let pl = L.polyline(a, {
                color: 'yellow'
            });
            pl.bindPopup("<b>" + data.from.abbreviation + '-' + data.to.abbreviation +
                '</b><br><a href="/c/' + data.id + '"">Edit<a>').openPopup();
            // pl.editing.enable();
            conns.push(pl)
            reinitConns();
            modalNewConn.close();
            M.toast({
                text: 'Koneksi baru telah disimpan'
            })
        }).fail(() => {
            M.toast({
                text: 'Gagal menyimpan koneksi'
            })
        });
    }
    map.on('click', onMapClick);
    map.on('contextmenu', openModal);
</script>
