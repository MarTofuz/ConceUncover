@extends('layouts.nav&SideBar')

@section('content')

<head>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/editShop.css') }}">
</head>

<div class="containerProfile">
    <div class="wrapper">
        <div class="form-box login">
            <form action="{{ route('saveShop') }}" method="POST">
                @csrf
                <h1> Agregar Tienda</h1>
                <br>

                <div class="form-group-grid">
                    <label for="name" style="font-size: 18px;">Nombre:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" style="font-size: 16px; width: 100%; height:40px" required>
                </div>

                <div class="form-group-grid">
                    <label for="address" style="font-size: 18px;">Dirección:</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}" style="font-size: 16px; width: 100%; height: 40px;" required>
                </div>

                <div class="form-group-grid">
                    <label for="description" style="font-size: 18px;">Descripción:</label>
                    <textarea id="description" name="description" style="font-size: 16px; width: 100%;" required>{{ old('description') }}</textarea>
                </div>

                <div class="form-group-grid">
                    <label for="assistant" style="font-size: 18px;">Asistente:</label>
                    <input type="text" id="assistant" name="assistant" value="{{ old('assistant') }}" style="font-size: 16px; width: 100%; height: 40px;" required>
                </div>

                <div class="form-group-grid">
                    <label for="schedule" style="font-size: 18px;">Horario:</label>
                    <input type="text" id="schedule" name="schedule" value="{{ old('schedule') }}" style="font-size: 16px; width: 100%; height:40px;" required>
                </div>

                <div class="form-group-grid">
                    <label for="location" style="font-size: 18px;">Ubicación:</label>
                    <input type="text" id="location" name="location" value="{{ old('location') }}" style="font-size: 16px; width: 100%; height:40px;" readonly>
                </div>
                <!-- pruebas -->
                <div class="form-group" style="display: flex; flex-direction: column;">
                    <div id="map" style="width: 500px; height: 300px; margin: 20px auto;"></div>
                    <br>
                    <button class="btn btn-dark px-4" type="submit" style="margin: 0 auto;">Agregar Tienda</button>
                </div>
            </form>
        </div>
    </div>
</div>
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

    .form-group-grid {
        display: grid;
        grid-template-rows: auto auto;
        /* Establecer el diseño de la etiqueta encima del campo de entrada */
        margin-bottom: 20px;
    }
</style>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

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

@endsection