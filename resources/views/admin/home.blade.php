<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Conce Uncover</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #map-container {
            position: fixed;
            top: 10%;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
    <header>
        <h2 class="logo">Conce Uncover</h2>
        <nav class="navigation">
            <a href="{{ route('home') }}">Inicio</a>
            <a href="#">{{ $user->name }}</a>
            <a class="btn btn-outline-dark" href="{{ route('logout') }}">Cerrar Sesión</a>
        </nav>
    </header>
        <div id="map-container"></div>
    </div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        let map = L.map('map-container').setView([-36.827081, -73.050327], 16)

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png',{}).addTo(map);

        L.marker([-36.827081, -73.050327]).addTo(map).bindPopup('Perfil de locales');
    </script>
</body>
</html>

