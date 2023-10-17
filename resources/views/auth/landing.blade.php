<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />
    <title>Conce Uncover</title>
    <style>
        /* Establece el tamaño del mapa al 100% del ancho y alto del cuerpo */
        body,
        html {
            height: 100%;
            padding-top: 45px;
        }
    </style>
</head>

<body>
    <header>
        <h2 class="logo">Conce Uncover</h2>
        <nav class="navigation">
            <a href="{{ route('register') }}" class="no-css-styles">
                <button class="btnlogin-popup">Registrarse</button>
            </a>
            <a href="{{ route('login') }}" class="no-css-styles">
                <button class="btnlogin-popup">Iniciar Sesión</button>
            </a>
        </nav>
    </header>
    
    <iframe width='100%' height='100%' src="https://api.mapbox.com/styles/v1/martofu/clnt5b40600du01qm82djglho.html?title=false&access_token=pk.eyJ1IjoibWFydG9mdSIsImEiOiJjbG50MndhbWYxZjVmMmttcnBqc2Vuajl3In0.Pg-TR5uXMGW1feRu5obIMQ&zoomwheel=true#16.66/-36.827783/-73.060636/332.8" title="Streets" style="border:none;"></iframe>
</body>

</html>