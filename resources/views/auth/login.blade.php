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
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <label for="email">{{ __('Correo') }}</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <x-input id="inputPassword" class="form-control" type="password" name="password" required autocomplete="current-password" />
                        <label for="inputPassword">{{ __('Contraseña') }}</label>
                    </div>
                    <div class="remember-forgot">
                        <label><x-checkbox id="remember_me" name="remember" /> {{ __('Recordar Contraseña') }}</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"> ¿{{ __('Olvido su contraseña?') }}</a>
                        @endif
                    </div>
                    <div class="alert alert-danger">
                        @if (session('status'))
                            <ul>
                                <li>{{ session('status') }}</li>
                            </ul>
                        @endif
                    </div>
                    <br>
                    <div class="d-grid gap-2">
                        <x-button class="btn btn-dark px-4" type="submit">{{ __('Acceder') }}</x-button>
                    </div>
                    <div class="login-register">
                        <p>{{ __('¿No tienes cuenta?') }} <a href="{{ route('register') }}" class="register-link">{{ __('Crear Cuenta') }}</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
