<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <?php if (env('APP_ENV') == 'local'):?>
    <title>Laraflet Debug</title>
    <!-- Fonts -->
    <link href="/assets/css/css2.css" rel="stylesheet">

    <!-- Styles -->
    <!--Import Google Icon Font-->
    <link href="/assets/css/icon.css" rel="stylesheet">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="/assets/css/materialize.min.css">

    <link rel="stylesheet" href="/assets/css/leaflet.css" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="/assets/js/leaflet.js"></script>

    <!-- Compiled and minified JavaScript -->
    <script src="/assets/js/materialize.min.js"></script>

    <?php else:?>
    <title>Laraflet</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@materializecss/materialize@1.2.1/dist/css/materialize.min.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@materializecss/materialize@1.2.1/dist/js/materialize.min.js"></script>
    <?php endif?>

    <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>


    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body class="grey darken-3 white-text">
    <header>
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo">Logo</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="sass.html">Sass</a></li>
                    <li><a href="badges.html">Components</a></li>
                    <li><a href="collapsible.html">JavaScript</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="">
            <div id="map"></div>
        </div>
        <div class="container col row">
            <?php if (count($cable->points) != 0) {
                $del = '';
            } else {
                $del = 'hide';
            } ?>
            <div class="col s6 center">
                <a class="btn red <?= $del ?>" onclick="del()">Hapus</a>
            </div>
            <div class="col s6 center">
                <a id="btn-add" onclick="save()" class="btn green disabled">Tambah</a>
            </div>
        </div>
    </main>
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red" onclick="printLine()">
            <i class="large material-icons">print</i>
        </a>
    </div>
    <script>
        var payload = <?= json_encode($payload) ?>;
        console.log(payload);
    </script>
    <script
        src="https://gist.githubusercontent.com/diolan12/33ff02168a859a8788872656ca946f8f/raw/784026f517cc87dabb6ced1e61a0d5b293bb6daa/rc.js">
    </script>
    <script>
        var _latLng = null;
        var pin;
        var btnAdd = document.getElementById('btn-add')

        function del() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 204) {
                    // Typical action to be performed when the document is ready:
                    M.toast({
                        html: 'I am a toast!'
                    })
                    location.reload();
                }
            };
            xhttp.open("DELETE", "/p/" + payload.cable.id, true);
            xhttp.send();
        }

        function save() {
            var form = new FormData();
            form.append('latitude', _latLng.lat);
            form.append('longitude', _latLng.lng);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 201) {
                    // Typical action to be performed when the document is ready:
                    M.toast({
                        html: 'I am a toast!'
                    })
                    location.reload();
                }
            };
            xhttp.open("POST", "/p/" + payload.cable.id, true);
            xhttp.send(form);
        }
        const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        });
        var points = []
        payload.cable.points.map((point) => {
            console.log(point)
            points.push([point.latitude, point.longitude])
        })
        var cable = L.polyline(points, {
            color: 'green',
            riseOnHover: true,
            draggable: true
        }).bindPopup("<b>" + payload.cable.name + "</b><br>Offline");
        var layers = L.layerGroup([cable])

        var map = L.map('map', {
            editable: true,
            center: [-8.418036, 114.184501],
            zoom: 12.3,
            layers: [osm, layers]
        });

        function onMapClick(e) {
            _latLng = e.latlng
            if (typeof pin == "object") {
                pin.setLatLng(e.latlng)
                points.push(e.latlng)
            } else {
                btnAdd.classList.remove('disabled')
                pin = L.marker(e.latlng, {
                    riseOnHover: true,
                    draggable: true
                })
                pin.addTo(map)
                pin.on('drag', (e) => {
                    // save
                    
                    _latLng = e.latlng
                    console.log(e)
                })
            }
            map.setView(e.latlng)
        }

        map.on('click', onMapClick);

        var overlayMaps = {
            "Kabel": cable,
            // "Kantor": offices,
            // "Gardu": gards,
        };

        var layerControl = L.control.layers(null, overlayMaps).addTo(map);
    </script>
</body>

</html>
