<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <title>Conce Uncover</title>
    <style>
        .styled-table {
    border-collapse: collapse;
    width: 100%;
    font-family: Arial, sans-serif;
}

.styled-table th,
.styled-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.styled-table th {
    background-color: #f2f2f2;
}

.styled-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.styled-table tr:hover {
    background-color: #ddd;
}

/* Estilo para los enlaces */
.styled-table a {
    text-decoration: none;
    color: #007bff;
    margin-right: 10px;
}

.styled-table a:hover {
    text-decoration: underline;
}

    </style>
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
            <h1>Perfil de Tienda</h1>
            <p>Nombre: {{ $tienda->name}}</p>
            <p>Dirección: {{ $tienda->address}}</p>
            <p>Descripción: {{ $tienda->description}}</p>
            <p>Asistente: {{ $tienda->assistant }}</p>
            <p>Horario: {{ $tienda->schedule }}</p>
            <br>
            <form action="{{ route('updateShop') }}">
                <button class="right-button">Editar</button>
            </form>
            <br>
            <br>
            <br>
            <br>
            <hr>
            <br>
            <h1>Sucursales</h1>

            @if(count($sucursales) > 0)
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Descripción</th>
                        <th>Asistente</th>
                        <th>Horario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sucursales as $sucursal)
                    <tr>
                        <td>{{ $sucursal->name }}</td>
                        <td>{{ $sucursal->address }}</td>
                        <td>{{ $sucursal->description }}</td>
                        <td>{{ $sucursal->assistant }}</td>
                        <td>{{ $sucursal->schedule }}</td>
                        <td>
                            <a href="{{ route('viewUpdateSucursal', ['id' => $sucursal->id]) }}">Editar</a>
                            <a href="{{ route('deletedSucursal', ['id' => $sucursal->id]) }}">Eliminar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No hay sucursal asociada</p>
            @endif
            <br>
            <br>
            <a href="{{ route('viewSaveSucursal', ['id' => $tienda->id]) }}" class="btn right-button"> Nueva Sucursal</a>

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
