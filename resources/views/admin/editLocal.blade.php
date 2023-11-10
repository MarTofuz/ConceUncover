@extends('layouts.nav&SideBar')


@section('content')

<head>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/editLocal.css') }}">
</head>

<div class="containerProfile">
    <div class="wrapper">
        <h1>Editar Tienda</h1>
        <div class="form-box login">
            <form action="{{ route('updateShop') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name" class="label">Nombre:</label>
                    <input type="text" id="name" name="name" value="{{ $tienda->name }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address" class="label">Dirección:</label>
                    <input type="text" id="address" name="address" value="{{ $tienda->address }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description" class="label">Descripción:</label>
                    <input id="description" name="description" value="{{ $tienda->description }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="assistant" class="label">Asistente:</label>
                    <input id="assistant" name="assistant" value="{{ $tienda->assistant }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="schedule" class="label">Horario:</label>
                    <input id="schedule" name="schedule" value="{{ $tienda->schedule }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="location" class="label">Ubicacion:</label>
                    <input id="location" required name="location" value="{{ $tienda->location }}" readonly class="form-control">
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