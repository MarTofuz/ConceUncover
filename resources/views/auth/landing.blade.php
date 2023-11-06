<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/nav&SideBar.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Conce Uncover</title>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css' rel='stylesheet' />
    <style>
        body,
        html {
            height: 100%;
            overflow-y: hidden;
        }

        .map {
            height: 100%;
            width: auto;
        }
    </style>
</head>

<body>
<header>
        <input type="checkbox" id="check" style="display: none;">
        <label for="check">
            <i class="fas fa-bars" id="bars"></i>
        </label>
        <h2 class="logo">Conce Uncover</h2>
        <nav class="navigation">
            <a href="{{ route('/') }}">Inicio</a>
        </nav>
    </header>
    
    <div class="columna-izquierda">
        <!-- Sidebar -->
        <div class="sidebarleft">
            
            <ul>
            <li> <a href="{{ route('login') }}"><i class='fas fa-portrait'></i> Iniciar Sesión</a></li>
            <li> <a href="{{ route('register') }}"><i class='fas fa-portrait'></i> Registrarse</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <a></a>

            </ul>
        </div>
    </div>


        <div class="map" id='map'></div>
    

</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const check = document.getElementById("check");
        const columnaIzquierda = document.querySelector(".columna-izquierda");
        const columnaDerecha = document.querySelector(".columna-derecha");

        // Oculta la columna izquierda al cargar la página
        columnaIzquierda.style.display = "none";

        // Agrega un evento al input para cambiar el diseño al hacer clic en el botón
        check.addEventListener("change", function() {
            if (this.checked) {
                columnaIzquierda.style.display = "block";
                columnaDerecha.style.flex = "1";
            } else {
                columnaIzquierda.style.display = "none";
                columnaDerecha.style.flex = "2";
            }
        });
    });
</script>

<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoibWFydG9mdSIsImEiOiJjbG50M2JldGswMDN3MmxxamhpdHlvYWM1In0.Ig_IGmqviFJg-_P99a8EYw';
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/martofu/clnt5b40600du01qm82djglho',
        center: [-73.060636, -36.827783],
        zoom: 16.66,
        showTileBoundaries: false,
        showNavigationControl: false
    });
</script>
<script>
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
    //var sucursales = @json($sucursales);
    if (Array.isArray(sucursales)) {
        if (sucursales.length > 0) {
            sucursales.forEach(function(sucursales) {
                if (sucursales.location) {
                    var lngLat = sucursales.location.split(',').map(Number);
                    new mapboxgl.Marker()
                        .setLngLat(lngLat)
                        .addTo(map);
                }
            });
        }
    }
</script>


</html>