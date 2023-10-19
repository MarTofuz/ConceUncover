<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/shop.css') }}">
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
    <h1> Agregar Tienda</h1>
    <br>

    <div class="form-group">
        <p>Nombre de la Tienda:</p>
        <input type="text" id="name" name="name" value="{{ old('name') }}">
    </div>

    <div class="form-group">
        <p>Dirección de la Tienda:</p>
        <input type="text" id="address" name="address" value="{{ old('address') }}">
    </div>

    <div class="form-group">
        <p>Descripción de la Tienda:</p>
        <textarea id="description" name="description">{{ old('description') }}</textarea>
    </div>

    <div class="form-group">
        <p>Asistente de la Tienda:</p>
        <input type="text" id="assistant" name="assistant" value="{{ old('assistant') }}">
    </div>

    <div class="form-group">
        <p>Horario de la Tienda:</p>
        <input type="text" id="schedule" name="schedule" value="{{ old('schedule') }}">
    </div>

    <div class="form-group">
        <p>Ubicación de la Tienda:</p>
        <input type="text" id="location" name="location" value="{{ old('location') }}">
    </div>

    <button class="btn btn-dark px-4" type="submit">Agregar Tienda</button>
</form>

            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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
</body>

</html>
