<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/storeClient.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Conce Uncover</title>
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
                @if(Auth::user()->profile_photo_path)
                <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" class="rounded" alt="Perfil " style="width: 40px;height: 40px; border-radius: 50%; margin-right: 10px;margin-left: 42px;">
                @else
                <img src="{{ asset('img/avatar.jpg') }}" alt="Perfil Estático" style="width: 40px;height: 40px; border-radius: 50%; margin-right: 10px;margin-left: 42px;">
                @endif
                <h3 class="usertitle">{{ $user->name }}</h3>
            </div>
            <ul>
                <li> <a href="{{ route('profile') }}"><i class='fas fa-portrait'></i> Perfil</a></li>
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


    <div class="columna-derecha">
        <div class="body-container">
            <div class="columna-producto">
                <h2>Productos</h2><br>
                <div>
                    <div class="card-deck">
                        @foreach($productos as $producto)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"> {{ $producto->name }}</h5>
                            </div>
                            <img src="http://localhost/ConceUncover/public/img/producto.png" alt="">
                            <div class="card-body">
                                <p class="card-text">Descripción: {{ $producto->description }}</p>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="columna-info">
                <h2>Información de la tienda "{{$tienda->name}}"</h2><br>
                <p>Dirección: {{ $tienda->address }}</p>
                <p>Descripción: {{ $tienda->description }}</p>
                <p>Asistente: {{ $tienda->assistant }}</p>
                <p>Horario: {{ $tienda->schedule }}</p>
            </div>
        </div>
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

    // Agrega o quita una clase basada en si el checkbox está marcado o no
    check.addEventListener("change", function() {
        if (this.checked) {
            columnaDerecha.classList.add('with-sidebar');
        } else {
            columnaDerecha.classList.remove('with-sidebar');
        }
    });
</script>


</html>