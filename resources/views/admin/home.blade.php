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
            background-color: #000000 ;
            border-radius: 8px;
        }
        /* Se quita la X */
        .mapboxgl-popup-close-button {
            display: none;
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
            <a href="{{ route('home') }}">Inicio</a>
        </nav>
    </header>

    <div class="columna-izquierda">
        <!-- Sidebar -->
        <div class="sidebarleft">
            <div class="usuario">
                <img src="{{ asset('img/avatar.jpg') }}" alt="Imagen de usuario" class="user-avatar">
                <h3 class="usertitle">{{ $user->name }}</h3>
            </div>
            <ul>
                <li> <a href="{{ route('profile') }}"><i class='fas fa-portrait'></i> Perfil</a></li>
                @role('admin')
                <li><a href="{{ route('adminPanel') }}" id="admin_panel"><i class='far fa-clipboard'></i>Administrador</a></li>
                @endrole
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <li><a class="btn btn-outline-dark" href="{{ route('logout') }}">Cerrar Sesión</a></li>
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
    var tiendas = @json($tiendas);
    if (Array.isArray(tiendas)) {
        if (tiendas.length > 0) {
            tiendas.forEach(function(tienda) {
                if (tienda.location) {
                    var lngLat = tienda.location.split(',').map(Number);

                    var popupContent =
                    '<div class="small-box bg-info" style="text-align: center;">' +
                    '<div class="inner" style="text-align: center; padding: 10px;"><br>' +
                    '<h3 style="font-size: 24px; margin: 0; padding-bottom: 10px; text-align: center;">' + tienda.name + '</h3><br>' +
                    '<p><strong style="text-align: center;">Dirección</strong><br>' + tienda.address + '</p><br>' +
                    '<p><strong style="text-align: center;">Horario</strong><br>' + tienda.schedule + '</p><br>' +
                    '</div>' +
                    '</div>' +
                    '<a href="#" class="small-box-footer">' +
                    'Más Información <i class="fas fa-arrow-circle-right"></i>' +
                    '</a>';

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

    var sucursales = @json($sucursales);
    if (Array.isArray(sucursales)) {
        if (sucursales.length > 0) {
            sucursales.forEach(function(sucursal) {
            if (sucursal.location) {
                var lngLat = sucursal.location.split(',').map(Number);

                var popupContent =
                '<div class="small-box bg-info" style="text-align: center;">' +
                '<div class="inner" style="text-align: center; padding: 10px;"><br>' +
                '<h3 style="font-size: 24px; margin: 0; padding-bottom: 10px; text-align: center;">' + sucursal.name + '</h3><br>' +
                '<p><strong style="text-align: center;">Dirección</strong><br>' + sucursal.address + '</p><br>' +
                '<p><strong style="text-align: center;">Horario</strong><br>' + sucursal.schedule + '</p><br>' +
                '</div>' +
                '</div>';

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
