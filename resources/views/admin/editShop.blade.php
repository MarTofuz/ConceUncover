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
                <form action="{{ route('saveShop') }}" method="POST">
                    @csrf
                    <p>Nombre de la Tienda:</p>
                    <input type="text" id="name" name="name" value="{{ old('name') }}">
                    <br><br>
                    <p>Dirección de la Tienda:</p>
                    <input type="text" id="address" name="address" value="{{ old('address') }}">
                    <br><br>
                    <p>Descripción de la Tienda:</p>
                    <textarea id="description" name="description">{{ old('description') }}</textarea>
                    <br><br>
                    <p>Asistente de la Tienda:</p>
                    <input type="text" id="assistant" name="assistant" value="{{ old('assistant') }}">
                    <br><br>
                    <p>Horario de la Tienda:</p>
                    <input type="text" id="schedule" name="schedule" value="{{ old('schedule') }}">
                    <br><br>
                    <p>Ubicación de la Tienda:</p>
                    <input type="text" id="location" name="location" value="{{ old('location') }}">
                    <br><br>
                    <button class="btn btn-dark px-4" type="submit">Agregar Tienda</button>
                </form>

            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
