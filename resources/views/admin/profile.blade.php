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
        <div class="wrapper">
            <div class="form-box login">
                <h1 id="user">{{ $user->name }}</h1>
                <hr>
                <br>
                @if($user->phone)
                <p>Teléfono: {{ $user->phone }}</p>
                @else
                <p>Teléfono: No hay datos</p>
                @endif
                <br>
                @if($user->address)
                <p>Dirección: {{ $user->address }}</p>
                @else
                <p>Dirección: No hay datos</p>
                @endif
                <br>
                <p>Correo: {{ $user->email }}</p>
                <br>
                <br>
                <h1>Locales disponibles</h1>
                <hr>
                <br>

                @if ($tiendas && $tiendas->count() > 0)
                @foreach ($tiendas as $unaTienda)
                <div class="tienda">
                    @if ($unaTienda->name)
                    <p>Nombre de la tienda: {{ $unaTienda->name }}</p>
                    @endif
                </div>
                <br>
                @endforeach
                @else
                <p>No tienes locales disponibles</p>
                @endif

                <form action="{{ route('edit') }}">
                    <button class="btn btn-dark px-4">Editar</button>
                </form>
                <br>
                <form action="{{ route('viewSaveShop') }}">
                    <button class="btn btn-dark px-4">Nuevo Local</button>
                </form>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
