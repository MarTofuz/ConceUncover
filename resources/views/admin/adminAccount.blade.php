@extends('adminlte::page')

@section('title', 'ConceUncover')

@section('content_header')
    <h1>Gestión de Cuentas</h1>
@stop

@section('content')
    <p>Control de Acceso a cuentas.</p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
    @foreach ($users as $user)
        <div class="col-md-4">
            <div class="card custom-card" style="width: 18rem;">
                <h5 class="card-title text-center">{{ $user->name }}</h5>
                <img class="card-img-top" src="{{ asset('img/avatar.jpg') }}" alt="Card image cap" height="170">
                <div class="card-body">
                    @if ($user->phone)
                        <p>Teléfono: {{ $user->phone }}</p>
                    @else
                        <p>Teléfono: no disponible</p>
                    @endif

                    @if ($user->address)
                        <p>Dirección: {{ $user->address }}</p>
                    @else
                        <p>Dirección: no disponible</p>
                    @endif
                    <p>Correo: {{ $user->email }}</p>
                </div>
                <a href="{{ route('eliminar-usuario', ['id' => $user->id]) }}" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    @endforeach
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
    .custom-card {
        width: 250px; /* Ancho personalizado */
        height: 400px; /* Alto personalizado */
    }
</style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
