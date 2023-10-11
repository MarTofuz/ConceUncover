<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/register.css') }}">
    <title>Conce Uncover</title>
</head>

<body>
    <header>
        <h2 class="logo">Conce Uncover</h2>
        <nav class="navigation">
            <a href="{{ route('/') }}">Inicio</a>
        </nav>
    </header>
    <div class="container">
        <div class="wrapper">
            <div class="form-box login">
                <h2>Registrar</h2>
                <form action="{{ route('register.store') }}" method="post">
                    @csrf
                    <div class="input-box">
                        <span class="icon"><ion-icon name="person"></ion-icon></span>
                        <input class="form-control" required id="name" type="text" name="name" />
                        <label for="name">Usuario</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <input class="form-control" required id="email" type="text" name="email" />
                        <label for="email">Correo</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <input class="form-control" required id="password" type="password" name="password" />
                        <label for="password">Contraseña</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <input class="form-control" required id="password" type="password" name="password_confirmation" />
                        <label for="password_confirmation">Repetir contraseña</label>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="d-grid gap-2">
                        <button class="btn btn-dark px-4" type="submit">Registrarse</button>
                    </div>
                    <div class="login-register">
                        <p>¿Ya tienes cuenta? <a href="login" class="register-link">Ingresar</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
