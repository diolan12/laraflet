<script>
    let map;
    // set center map position by default x y value
    var centerPosition = [-7.284998154666389, 112.78127789497377];

    var elem = document.getElementById('modal-new_witel')
    var modalNewWitel = M.Modal.getInstance(elem)

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
    getLocation()
    this.onReady(() => {
        modalNewWitel = M.Modal.getInstance(elem)
    })

    const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });

    var witels = [];
    var fos = [];

    payload.data.witels.map((witel) => {
        witels.push(L.marker(witel.location.coordinates.reverse(), {
            extra: witel
        }).on('click', (ev) => {
            // open modal
            console.log(ev);
        }).bindPopup("<b>Witel " + witel.name + "</b>"))
    })
    payload.data.fos.map((fo) => {
        var _points = []

        console.log("fiber optik " + fo.name, fo.cable_line.coordinates)
        fo.cable_line.coordinates.map((point) => {
            _points.push(point.reverse())
        })
        fos.push(L.polyline(_points, {
            color: 'lime'
        }).bindPopup("<b>" + fo.name + '</b><br><a href="/c/'+fo.id+'"">Edit<a>').openPopup())
    })

    var lgWitels = L.layerGroup(witels);
    var lgFos = L.layerGroup(fos);

    map = L.map('map', {
        center: this.centerPosition,
        zoom: 15,
        layers: [osm, lgWitels, lgFos]
    });


    var overlayMaps = {
        "Witel": lgWitels,
        "Fiber optik": lgFos,
    };
    var layerControl = L.control.layers(null, overlayMaps).addTo(map);

    function onMapClick(ev) {
        console.log(ev)
    }

    function reinitWitels() {
        lgWitels.clearLayers()
        lgWitels.addLayer(L.layerGroup(witels))
    }

    function newWitel(ev) {
        // show modal for witel name
        modalNewWitel.open()

        // add marker
        witels.push(L.marker(ev.latlng, {
            draggable: true
        }).bindPopup("<b>New witel</b>"))

        reinitWitels()

    }
    map.on('click', onMapClick);
    map.on('contextmenu', newWitel);
</script>
