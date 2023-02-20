<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

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

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

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

    <!-- Leaflet's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <!-- Leaflet's Edit -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    {{-- <script src="/assets/js/Leaflet.Editable.js"></script> --}}

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@materializecss/materialize@1.2.1/dist/js/materialize.min.js"></script>

    <?php endif?>

    <!-- Lazy load css per pages -->
    <?php
    try {
        echo view('pages.' . $content . '.css', $payload);
    } catch (\Throwable $th) {
        if ($th::class != 'InvalidArgumentException') {
            throw $th;
        } else {
            // dd($th::class);
        }
    }
    ?>

    <!-- Main global CSS stylesheet -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <script>
        var payload = <?= json_encode($payload) ?>;
        console.log(payload);
    </script>

    <!-- Main global javascript -->
    <script src="/assets/js/app.js"></script>
</head>

<body class="">
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
        <?= view('pages.' . $content . '.' . $content, $payload) ?>
    </main>
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red" onclick="printLine()">
            <i class="large material-icons">print</i>
        </a>
    </div>

    <!-- Lazy load javascript per pages -->
    <?php
    try {
        echo view('pages.' . $content . '.js', $payload);
    } catch (\Throwable $th) {
        if ($th::class != 'InvalidArgumentException') {
            throw $th;
        } else {
            // dd($th::class);
        }
    }
    ?>
</body>

</html>
