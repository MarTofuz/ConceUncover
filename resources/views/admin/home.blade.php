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
    //var tiendas = @json($tiendas);
    if (Array.isArray(tiendas)) {
        if (tiendas.length > 0) {
            tiendas.forEach(function(tienda) {
                if (tienda.location) {
                    var lngLat = tienda.location.split(',').map(Number);

                    // Verifica el estado de la tienda
                    if (tienda.status === 1) {
                        // Crea el contenido del popup
                        var popupContent = `
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>${tienda.name}</h3>
                                    <p>Dirección: ${tienda.address}</p>
                                    <p>Horario: ${tienda.schedule}</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        `;

                        var popup = new mapboxgl.Popup({
                            closeButton: false,
                            closeOnClick: false,
                        }).setHTML(popupContent);

                        new mapboxgl.Marker()
                            .setLngLat(lngLat)
                            .setPopup(popup)
                            .addTo(map);
                    }
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

                    // Verifica el estado de la sucursal
                    if (sucursal.status === 1) {
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
                }
            });
        }
    }
</script>


</html>
