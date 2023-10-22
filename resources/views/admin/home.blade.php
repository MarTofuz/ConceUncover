<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Conce Uncover</title>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />
    <style>
        body, html {
            height: 100%;
            padding-top: 38px;
            overflow-y: hidden;
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

    <iframe width='100%' height='100%' src="https://api.mapbox.com/styles/v1/martofu/clnt5b40600du01qm82djglho.html?title=false&access_token=pk.eyJ1IjoibWFydG9mdSIsImEiOiJjbG50MndhbWYxZjVmMmttcnBqc2Vuajl3In0.Pg-TR5uXMGW1feRu5obIMQ&zoomwheel=true#16.66/-36.827783/-73.060636/332.8" style="border:none;"></iframe>
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

    /////////////SE SUPONE QUE CON ESTO FUNCIONARIA COLOCAR LAS TIENDAS
    /////////////PERO CREO QUE NO ME TOMA LA COLUMNA DE LOCATION EN EL IF

    // Asegurémonos de que la variable 'map' esté definida antes de utilizarla
    var map = new mapboxgl.Map({
        container: 'map', // Reemplaza 'map' con el ID de tu contenedor de mapa
        style: 'mapbox://styles/martofu/clnt5b40600du01qm82djglho',
        center: [-73.060636, -36.827783], // Cambia a la ubicación inicial que desees
        zoom: 16.66,
        showTileBoundaries: false,
        showNavigationControl: false
    });

    // Supongamos que 'tiendas' es una matriz de objetos con información de tiendas
    if (Array.isArray(tiendas) && tiendas.length > 0) {
        tiendas.forEach(function(tienda) {
            if (tienda.location) {
                var lngLat = tienda.location.split(',').map(Number);
                new mapboxgl.Marker()
                    .setLngLat(lngLat)
                    .addTo(map);
            }
        });
    }
</script>

</html>
