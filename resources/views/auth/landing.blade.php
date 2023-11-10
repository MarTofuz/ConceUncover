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

    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
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

        /* flecha del popup */
        .mapboxgl-popup-anchor-bottom .mapboxgl-popup-tip {
            align-self: center;
            border-bottom: none;
            border-top-color: #000000;
        }

        /* flecha del popup */
        .mapboxgl-popup-anchor-top .mapboxgl-popup-tip {
            align-self: center;
            border-bottom-color: #3cb4cc;
            border-top: none;
        }

        /* flecha del popup */
        .mapboxgl-popup-anchor-top-left .mapboxgl-popup-tip {
            align-self: flex-start;
            border-bottom-color: #3cb4cc;
            border-left: none;
            border-top: none;
        }

        .bg-info,
        .bg-info>a {
            color: rgb(0, 0, 0);
        }

        .bg-info {
            background-color: #000000;
        }

        .small-box {
            border-radius: .25rem;
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
            display: block;
            margin-bottom: 20px;
            position: relative;
        }

        /* Color del recuadro de info */
        .inner {
            background-color: rgb(255, 255, 255);
            border-radius: 8px;
            padding: 30px;
        }

        /* boton de más informacion */
        .small-box-footer {
            background-color: rgb(95, 95, 95);
            color: white;
            display: block;
            padding: 3px 0;
            position: relative;
            text-align: center;
            text-decoration: none;
            z-index: 10;
            border-radius: 8px;
        }

        /* Color del borde */
        .mapboxgl-popup-content {
            background-color: #000000;
            border-radius: 8px;
        }

        /* Se quita la X */
        .mapboxgl-popup-close-button {
            display: none;
        }

        .mapboxgl-ctrl-geocoder {
            width: 100px;
            right: 10px;
            top: 100px;
        }

        .mapboxgl-ctrl-attrib-inner {
            display: none;
        }

        a.mapboxgl-ctrl-logo {
            display: none;
        }

        .btn {
            position: absolute;
            bottom: 20px;
            right: 20px;
            z-index: 999;
            background-color: white;
            color: #000000;
            border: none;
            border-radius: 5%;
            width: 120px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            transition: background-color 0.2s, transform 0.2s;
            white-space: nowrap;
            /* Evita que el texto se divida en múltiples líneas */
            overflow: hidden;
            /* Oculta cualquier contenido que desborde del botón */
        }

        .btn:hover {
            background-color: black;
            color: #fff;
            transform: scale(1);
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

    <div class="map" id='map'>
        <button class="btn btn-primary"> Ver ubicación</button>
    </div>

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
    mapboxgl.accessToken = 'pk.eyJ1IjoibWFydG9mdSIsImEiOiJjbG50MndhbWYxZjVmMmttcnBqc2Vuajl3In0.Pg-TR5uXMGW1feRu5obIMQ';
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/martofu/clnt5b40600du01qm82djglho',
        center: [-73.060636, -36.827783],
        zoom: 16.66,
        showTileBoundaries: false,
        showNavigationControl: false
    });

    var customData = {
        'features': []
    };

    // Agregar tiendas al objeto customData
    var tiendas = @json($tiendas);
    if (Array.isArray(tiendas)) {
        tiendas.forEach(function(tienda) {
            if (tienda.location) {
                var lngLat = tienda.location.split(',').map(Number);

                var feature = {
                    'type': 'Feature',
                    'properties': {
                        'title': tienda.name,
                        'address': tienda.address,
                        'schedule' : tienda.schedule,
                        'type': 'Tienda' // Agrega un tipo para distinguir entre tiendas y sucursales
                    },
                    'geometry': {
                        'coordinates': [lngLat[0], lngLat[1]],
                        'type': 'Point'
                    }
                };

                customData['features'].push(feature);
            }
        });
    }

    // Agregar sucursales al objeto customData
    var sucursales = @json($sucursales);
    if (Array.isArray(sucursales)) {
        sucursales.forEach(function(sucursal) {
            if (sucursal.location) {
                var lngLat = sucursal.location.split(',').map(Number);

                var feature = {
                    'type': 'Feature',
                    'properties': {
                        'title': sucursal.name,
                        'address': sucursal.address,
                        'schedule' : sucursal.schedule,
                        'type': 'Sucursal' // Agrega un tipo para distinguir entre tiendas y sucursales
                    },
                    'geometry': {
                        'coordinates': [lngLat[0], lngLat[1]],
                        'type': 'Point'
                    }
                };

                customData['features'].push(feature);
            }
        });
    }

    customData['type'] = 'FeatureCollection';

    function forwardGeocoder(query) {
        const matchingFeatures = [];
        for (const feature of customData.features) {
            if (
                feature.properties.title.toLowerCase().includes(query.toLowerCase()) &&
                (feature.properties.type === 'Tienda' || feature.properties.type === 'Sucursal')
            ) {
                // Agregar resultados que coincidan con la búsqueda y tengan el tipo "Tienda" o "Sucursal"
                const popupContent = generatePopupContent(feature);
                matchingFeatures.push({
                    place_name: feature.properties.title, // Usamos el título como nombre del lugar
                    center: feature.geometry.coordinates, // Usamos las coordenadas del lugar
                    popupContent: popupContent
                });
            }
        }
        return matchingFeatures;

    }

    function addMarkersAndPopups() {
    customData.features.forEach(function(feature) {
        var popupContent = generatePopupContent(feature);
        var marker = new mapboxgl.Marker()
            .setLngLat(feature.geometry.coordinates)
            .setPopup(new mapboxgl.Popup().setHTML(popupContent))
            .addTo(map);
            marker.setPopup(new mapboxgl.Popup().setHTML(popupContent));
    });
}
addMarkersAndPopups();

    // Función para generar el contenido del popup
    function generatePopupContent(feature) {
        if (feature.properties.type === 'Tienda') {
            // Código para tiendas
            var popupContent =
                '<div class="small-box bg-info" style="text-align: center;">' +
                '<div class="inner" style="text-align: center; padding: 10px;"><br>' +
                '<h3 style="font-size: 24px; margin: 0; padding-bottom: 10px; text-align: center;">' + feature.properties.title + '</h3><br>' +
                '<p><strong style="text-align: center;">Dirección</strong><br>' + feature.properties.address + '</p><br>' +
                '<p><strong style="text-align: center;">Horario</strong><br>' + feature.properties.schedule + '</p><br>' +
                '</div>' +
                '</div>' +
                '<a href="#" class="small-box-footer">' +
                'Más Información <i class="fas fa-arrow-circle-right"></i>' +
                '</a>';
        } else if (feature.properties.type === 'Sucursal') {
            // Código para sucursales
            var popupContent =
                '<div class="small-box bg-info" style="text-align: center;">' +
                '<div class="inner" style="text-align: center; padding: 10px;"><br>' +
                '<h3 style="font-size: 24px; margin: 0; padding-bottom: 10px; text-align: center;">' + feature.properties.title + '</h3><br>' +
                '<p><strong style="text-align: center;">Dirección</strong><br>' + feature.properties.address + '</p><br>' +
                '<p><strong style="text-align: center;">Horario</strong><br>' + feature.properties.schedule + '</p><br>' +
                '</div>' +
                '</div>' +
                '<a href="#" class="small-box-footer">' +
                'Más Información <i class="fas fa-arrow-circle-right"></i>' +
                '</a>';
        }

        return popupContent;
    }



    // Add the control to the map.
    map.addControl(
    new MapboxGeocoder({
        accessToken: 'pk.eyJ1IjoibWFydG9mdSIsImEiOiJjbG50MndhbWYxZjVmMmttcnBqc2Vuajl3In0.Pg-TR5uXMGW1feRu5obIMQ',
        localGeocoder: forwardGeocoder,
        zoom: 14,
        placeholder: 'Buscar lugar.....',
        mapboxgl: mapboxgl
    })
    .on('result', function (e) {
        // 'e.result' contiene la información del lugar seleccionado
        const { center, popupContent } = e.result;

        // Centra el mapa en las coordenadas del lugar
        map.flyTo({
            center: center,
            zoom: 16
        });

        // Abre un popup con el contenido personalizado
        new mapboxgl.Popup({ offset: [0, -40] })
            .setHTML(popupContent)
            .setLngLat(center)
            .addTo(map);
    })
);

    const locateButton = document.querySelector('.btn');
    let userMarker; // Variable para almacenar el marcador del usuario
    let watchId; // Variable para almacenar el ID de la función de seguimiento

    locateButton.addEventListener('click', () => {
        if (watchId) {
            // Si watchId tiene un valor, significa que ya estamos siguiendo la ubicación
            // Entonces, detenemos el seguimiento
            navigator.geolocation.clearWatch(watchId);
            watchId = null;

            // Habilita el botón y restaura el texto original
            locateButton.disabled = false;
            locateButton.textContent = "Ver ubicación";

            // También puedes quitar el marcador del usuario
            if (userMarker) {
                userMarker.remove();
                userMarker = null;
            }
        } else {
            // Si watchId es nulo, comenzamos el seguimiento
            // Deshabilita el botón y muestra "Cargando..."
            locateButton.disabled = true;
            locateButton.textContent = "Cargando...";

            // Función para actualizar el marcador del usuario
            function updateUserMarker(location) {
                if (userMarker) {
                    userMarker.setLngLat(location);
                } else {
                    userMarker = new mapboxgl.Marker({
                            color: 'blue'
                        }) // Puedes personalizar el marcador con un color o una imagen
                        .setLngLat(location)
                        .addTo(map);
                }
            }

            // Función para solicitar la ubicación de forma continua
            function watchUserLocation() {
                watchId = navigator.geolocation.watchPosition((position) => {
                    const userLocation = [position.coords.longitude, position.coords.latitude];
                    map.flyTo({
                        center: userLocation,
                        zoom: 16
                    });
                    updateUserMarker(userLocation);

                    // Habilita el botón y restaura el texto original
                    locateButton.disabled = false;
                    locateButton.textContent = "Detener ubicación"; // Cambia el texto del botón
                }, (error) => {
                    console.error('Error al obtener la ubicación: ', error);

                    // Habilita el botón y restaura el texto original en caso de error
                    locateButton.disabled = false;
                    locateButton.textContent = "Mi ubicación (Error)";
                });
            }

            // Comienza a seguir la ubicación del usuario
            watchUserLocation();
        }
    });
</script>
</html>
