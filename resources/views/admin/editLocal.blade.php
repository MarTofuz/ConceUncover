<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/shop.css') }}">
    <title>Conce Uncover</title>
    <style>
        .mapboxgl-ctrl-attrib-button {
            display: none;
        }

        .mapboxgl-ctrl-attrib-inner {
            display: none;
        }

        .mapboxgl-marker {
            position: relative;
            top: -100px;
            /* Ajusta el valor de top según sea necesario */
        }
    </style>
</head>

<body>
    <header>
        <h2 class="logo">Conce Uncover</h2>
        <nav class="navigation">
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
    <div class="container">
        <div class="wrapper">
            <div class="form-box login">
                <form action="{{ route('updateShop') }}" method="POST">
                    @csrf
                    <h1>Editar Tienda</h1>
                    <div class="form-group">
                        <p>Nombre:</p>
                        <input type="text" id="name" name="name" value="{{ $tienda->name }}" required>
                    </div>
                    <div class="form-group">
                        <p>Dirección:</p>
                        <input type="text" id="address" name="address" value="{{ $tienda->address }}" required>
                    </div>
                    <div class="form-group">
                        <p>Descripción:</p>
                        <input id="description" name="description" value="{{ $tienda->description }}" required></input>
                    </div>
                    <div class="form-group">
                        <p>Asistente:</p>
                        <input id="assistant" name="assistant" value="{{ $tienda->assistant }}" required></input>
                    </div>
                    <div class="form-group">
                        <p>Horario:</p>
                        <input id="schedule" name="schedule" value="{{ $tienda->schedule }}" required></input>
                    </div>
                    <div class="form-group">
                        <p>Ubicacion:</p>
                        <input id="location" required name="location" value="{{ $tienda->location }}" readonly></input>
                    </div>
                    <!-- Agrega un campo oculto para mantener el ID de la tienda -->
                    <input type="hidden" name="tienda_id" value="{{ $tienda->id }}">

                    <div class="form-group" style="display: flex; flex-direction: column;">
                        <div id="map" style="width: 500px; height: 300px; margin: 20px auto; cursor: pointer;"></div>
                        <br>
                    </div>
                    <button class="btn btn-dark px-4" type="submit">Actualizar</button>

                </form>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            mapboxgl.accessToken = 'pk.eyJ1IjoibWFydG9mdSIsImEiOiJjbG50MndhbWYxZjVmMmttcnBqc2Vuajl3In0.Pg-TR5uXMGW1feRu5obIMQ';

            var initialLngLat = [-73.060636, -36.827783];
            var storedLngLat = JSON.parse(localStorage.getItem('markerLocation')) || initialLngLat;

            var map = new mapboxgl.Map({
                container: 'map', // El ID del contenedor en tu formulario
                style: 'mapbox://styles/martofu/clnt5b40600du01qm82djglho', // Establece tu estilo de mapa
                center: storedLngLat, // Centra el mapa en las coordenadas iniciales o en la última ubicación del marcador
                zoom: 16.66, // Establece el nivel de zoom inicial
                showTileBoundaries: false, // Oculta los vínculos en el mapa
                showNavigationControl: false, // Oculta los controles de navegación
            });

            // Agrega código para permitir a los usuarios interactuar con el mapa y seleccionar la ubicación, por ejemplo, un marcador:
            map.on('click', function(e) {
                var lngLat = e.lngLat;

                // Muestra las coordenadas en el campo de ubicación
                document.getElementById('location').value = lngLat.lng + ', ' + lngLat.lat;

                // Almacena las coordenadas en el almacenamiento local (localStorage)
                localStorage.setItem('markerLocation', JSON.stringify(lngLat));
            });
        });
    </script>
</body>

</html>
