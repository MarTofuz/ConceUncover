<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
</head>
<body>
<h1>No tienes acceso a esta web</h1>

    <p>Por favor, espera 5 segundos...</p>


    <p>Volveras a la main page...</p>

    <script>
        setTimeout(function() {
            window.location.href = "{{ route('home') }}";
        }, 5000); // 5000 milisegundos = 5 segundos
    </script>
</body>
</html>