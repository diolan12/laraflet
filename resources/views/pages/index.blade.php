<div>
    <div id="map"></div>
</div>
<script>
    const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });

    var rawCables = [];
    var rawPoints = [];
    payload.data.cables.map((cable) => {
        console.log(cable)
        var _points = [];
        cable.line.coordinates.map((point) => {
            _points.push([point[1], point[0]])
            rawPoints.push(L.marker([point[1], point[0]]))
        })
        rawCables.push(L.polyline(_points, {
            color: 'green'
        }).bindPopup("<b>" + cable.name + '</b><br><a href="/c/' + cable.id + '">Edit</a>'))
        
    })
    var cables = L.layerGroup(rawCables);
    var points = L.layerGroup(rawPoints);

    var map = L.map('map', {
        center: [-8.418036, 114.184501],
        zoom: 12.3,
        layers: [osm, cables]
    });

    function onMapClick(ev) {
        console.log(ev)
    }
    map.on('click', onMapClick);

    var overlayMaps = {
        "Kabel": cables,
        // "Titik": points,
    };
    var layerControl = L.control.layers(null, overlayMaps).addTo(map);
</script>
