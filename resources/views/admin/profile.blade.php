<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <title>Conce Uncover</title>
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
        <div class="form-box">
            <h1>Perfil</h1>
            <div class="text-center">
                <img src="{{ asset('css/usuario.png') }}" class="rounded" alt="...">
            </div>
            <p>Usuario: {{ $user->name ?? 'No hay datos' }}</p>
            <p>Teléfono: {{ $user->phone ?? 'No hay datos' }}</p>
            <p>Dirección: {{ $user->address ?? 'No hay datos' }}</p>
            <p>Correo: {{ $user->email }}</p>
            <br>
            <form action="{{ route('edit') }}">
                <button class="right-button">Editar</button>
            </form>
            <br>
            <br>
            <br>
            <br>
            <hr>
            <br>

            <h1>Tienda</h1>

            @if ($tienda)
            <p>Nombre: {{ $tienda->name }}</p>
            <form action="{{ route('viewProfileShop') }}">
                <button class="right-button">Ver Tienda</button>
            </form>
            <br>
            @else
            <p>No hay tienda asociada</p>
            <form action="{{ route('viewSaveShop') }}">
                <button class="right-button">Nueva Tienda</button>
            </form>
            @endif

        </div>
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


    </div>
</body>

</html>
