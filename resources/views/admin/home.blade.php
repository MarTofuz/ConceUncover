<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Conce Uncover</title>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css' rel='stylesheet' />
    <style>
        body,
        html {
            height: 100%;
            padding-top: 38px;
            overflow-y: hidden;
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
            @role('admin')
            <a href="{{ route('adminPanel') }}" id="admin_panel">Panel Administrador</a>
            @endrole
            <a href="{{ route('home') }}">Inicio</a>
            <div class="dropdown">
                <a href="#" id="userDropdown">{{ $user->name }}</a>
                <div class="dropdown-content" id="userDropdownContent">
                    <!-- Aquí coloca las opciones del menú -->
                    <a href="{{ route('profile') }}">Perfil</a>
                    <a href="#">Favoritos</a>
                    <a class="btn btn-outline-dark" href="{{ route('logout') }}">Cerrar Sesión</a>
                </div>
            </div>
        </nav>
    </header>
    <div class="map" id='map'></div>

</body>
<script>
    const username = document.getElementById('userDropdown');
    const dropdownMenu = document.getElementById('userDropdownContent');
    username.addEventListener('click', function(event) {
        event.stopPropagation(); // Evita que el evento de clic se propague y se ejecute el documento.click
        if (dropdownMenu.style.display === 'block') {
            dropdownMenu.style.display = 'none';
        } else {
            dropdownMenu.style.display = 'block';
        }
    });
    document.addEventListener('click', function(event) {
        if (event.target !== username) {
            dropdownMenu.style.display = 'none';
        }
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

                    var popupContent =
                        '<h1>' + tienda.name + '</h1>' +
                        '<br>' +
                        '<p>Dirección: ' + tienda.address + '</p>' +
                        '<p>Horario: ' + tienda.schedule + '</p>';

                    var popup = new mapboxgl.Popup()
                        .setHTML(popupContent);

                    new mapboxgl.Marker()
                        .setLngLat(lngLat)
                        .setPopup(popup)
                        .addTo(map);
                }
            });
        }
    }

    //var sucursales = @json($sucursales);
    if (Array.isArray(sucursales)) {
        if (sucursales.length > 0) {
            sucursales.forEach(function(sucursal) {
                if (sucursal.location) {
                    var lngLat = sucursal.location.split(',').map(Number);

                    var popupContent =
                        '<h1>' + sucursal.name + '</h1>' +
                        '<br>' +
                        '<p>Dirección: ' + sucursal.address + '</p>' +
                        '<p>Horario: ' + sucursal.schedule + '</p>';

                    var popup = new mapboxgl.Popup()
                        .setHTML(popupContent);

                    new mapboxgl.Marker()
                        .setLngLat(lngLat)
                        .setPopup(popup)
                        .addTo(map);
                }
            });
        }
    }
</script>


</html>
