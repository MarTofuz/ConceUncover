<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}">
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
                <h2>Login</h2>
                <form action="{{ route('login.attempt') }}" method="POST">
                    @csrf
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <input class="form-control" id="email" type="text" name="email" required/>
                        <label for="email">Correo</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <input class="form-control" id="inputPassword" type="password" name="password" required/>
                        <label for="inputPassword">Contraseña</label>
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox">Recordar Contraseña</label>
                        <a href="{{ route('restpass') }}"> ¿Olvido su contraseña?</a>
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
                    <br>
                    <div class="d-grid gap-2">
                        <button class="btn btn-dark px-4" type="submit">Acceder</button>
                    </div>
                    <div class="login-register">
                        <p>¿No tienes cuenta? <a href="register"class="register-link">Crear Cuenta</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
