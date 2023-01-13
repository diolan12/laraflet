// var map = L.map('map').setView([-8.418036, 114.184501], 12.5);

const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
});

var offGenteng = L.marker([-8.364409, 114.146513]).bindPopup("<b>KANTOR</b><br>GENTENG");
var offTrembelang = L.marker([-8.432574, 114.204639]).bindPopup("<b>KANTOR</b><br>BENCULUK");
var offices = L.layerGroup([offGenteng, offTrembelang]);

var gardGambiran1 = L.marker([-8.38999, 114.144079]);
var gardGambiran2 = L.marker([-8.392282, 114.145802]);
var gardTrembelang = L.marker([-8.43281, 114.205595]);
var gards = L.layerGroup([gardGambiran1, gardGambiran2, gardTrembelang]);

var rawCables = [];
var rj1 = L.polyline([
    [-8.364409, 114.146513],
    [-8.364223388060376, 114.14744199589629],
    [-8.372725683803404, 114.1453672982199],
    [-8.378468078124511, 114.14610878648799],
    [-8.382713786521965, 114.1463877304072],
    [-8.38999, 114.144079]
], {color: 'green'}).bindPopup("<b>RJ1</b><br>Online");
var rj2 = L.polyline([
    [-8.38999, 114.144079],
    [-8.392287688779126, 114.14516445109088],
    [-8.392282, 114.145802]
], {color: 'red'}).bindPopup("<b>RJ2</b><br>Offline");
// rawCables.push(rj1, rj2)
payload.cables.map((cable)=>{
    console.log(cable)
    var _points = [];
    cable.points.map((point)=>{
        _points.push([point.latitude, point.longitude])
    })
    rawCables.push(L.polyline(_points, {color: 'green'}).bindPopup("<b>"+cable.name+'</b><br><a href="/line/'+cable.id+'">Edit</a>'))
})

var cables = L.layerGroup(rawCables);
// var cables = L.layerGroup([rj1, rj2]);

var map = L.map('map', {
    center: [-8.418036, 114.184501],
    zoom: 12.3,
    layers: [osm, offices, cables]
});

var popup = L.popup();
var line = [];
function onMapClick(e) {
    line.push(e.latlng);
    popup
        .setLatLng(e.latlng)
        .setContent("You clicked the map at " + e.latlng.toString())
        .openOn(map);
    rj2.addLatLng(e.latlng);
}
// map.on('click', onMapClick);
function printLine() {
    console.log(line);
}

var overlayMaps = {
    "Kabel": cables,
    "Kantor": offices,
    // "Gardu": gards,
};
var layerControl = L.control.layers(null, overlayMaps).addTo(map);