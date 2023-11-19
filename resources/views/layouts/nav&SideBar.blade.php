<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/nav&SideBar.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    @yield('source')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<title>Conce Uncover</title>
<style>
    /* Estilos para ocultar la lista de favoritos al inicio */
    #favoritos-list {
        display: none;
        position: absolute;
        background-color: white;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        z-index: 1;
    }

    /* Estilos para la opción "Favoritos" */
    #favoritos:hover #favoritos-list {
        display: block;
    }
</style>
</head>

<body>
    <header>
        <div class="logo-container">
            <h2 class="logo">Conce Uncover</h2>
            <input type="checkbox" id="check" style="display: none;">
            <label for="check">
                <i class="fas fa-bars" id="bars"></i>
            </label>
        </div>
        <nav class="navigation">
            <a href="{{ route('home') }}">Inicio</a>
        </nav>
    </header>
    <div class="columna-izquierda">
        <!-- Sidebar -->
        <div class="sidebarleft">
            <div class="usuario">
                @if(Auth::user()->profile_photo_path)
                <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" class="rounded" alt="Perfil " style="width: 40px;height: 40px; border-radius: 50%; margin-right: 10px;margin-left: 42px;">
                @else
                <img src="{{ asset('img/avatar.jpg') }}" alt="Perfil Estático" style="width: 40px;height: 40px; border-radius: 50%; margin-right: 10px;margin-left: 42px;">
                @endif
                <h3 class="usertitle">{{ Auth::user()->name }}</h3>
            </div>
            <ul>
                <li>
                    <a href="{{ route('profile') }}">
                        <i class='fas fa-portrait'></i> Perfil
                    </a>
                </li>
                <li id="favoritos">
                    <!-- Opción "Favoritos" -->
                    <a href="#">
                        <i class="fas fa-star"></i> Favoritos
                    </a>
                    <!-- Lista de favoritos que se mostrará al pasar el ratón sobre "Favoritos" -->
                    <ul id="favoritos-list">
                        @foreach ($favoritos->reverse() as $favorito)
                        <li id="favoritos">
                            @if ($favorito->sucursal)
                            <a href="{{ route('viewClientSucursal', ['id' => $favorito->sucursal->id]) }}">
                                <i class="fas fa-star"></i> {{ $favorito->sucursal->name }}
                            </a>
                            @elseif ($favorito->tienda)
                            <a href="{{ route('viewClientTienda', ['id' => $favorito->tienda->id]) }}">
                                <i class="fas fa-star"></i> {{ $favorito->tienda->name }}
                            </a>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a class="btn btn-outline-dark" href="{{ route('logout') }}">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="columna-derecha text-centre">
        @yield('content')
    </div>



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
</body>

</html>
