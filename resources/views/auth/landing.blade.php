<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css' rel='stylesheet' />
    <title>Conce Uncover</title>
    <style>
        /* Establece el tamaño del mapa al 100% del ancho y alto del cuerpo */
        body,
        html {
            height: 100%;
            padding-top: 45px;
        }
        .map {
            height: 100%;
            width: 100%;
        }
    </style>
</head>

<body>
    <header>
        <h2 class="logo">Conce Uncover</h2>
        <nav class="navigation">
            <a href="{{ route('register') }}" class="no-css-styles">
                <button class="btnlogin-popup">Registrarse</button>
            </a>
            <a href="{{ route('login') }}" class="no-css-styles">
                <button class="btnlogin-popup">Iniciar Sesión</button>
            </a>
        </nav>
    </header>    
    <div class="map" id='map'></div>
</body>
<script>   
    mapboxgl.accessToken = 'pk.eyJ1IjoibWFydG9mdSIsImEiOiJjbG50M2JldGswMDN3MmxxamhpdHlvYWM1In0.Ig_IGmqviFJg-_P99a8EYw';
    const map = new mapboxgl.Map({
        container: 'map', // Reemplaza 'map' con el ID de tu contenedor de mapa
        style: 'mapbox://styles/martofu/clnt5b40600du01qm82djglho',
        center: [-73.060636, -36.827783], // Cambia a la ubicación inicial que desees
        zoom: 16.66,
        showTileBoundaries: false,
        showNavigationControl: false
    });
</script>
<script>        
    var tiendas;
    
    //var tiendas = @json($tiendas);
    if (Array.isArray(tiendas)) {
        if (tiendas.length > 0) {
            tiendas.forEach(function(tienda) {
                if (tienda.location) {
                    var lngLat = tienda.location.split(',').map(Number);
                    new mapboxgl.Marker()
                        .setLngLat(lngLat)
                        .addTo(map);
                }
            });
        }

    }
</script>
</html>