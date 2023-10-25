@extends('adminlte::page')

@section('title', 'ConceUncover')

@section('content_header')
    <h1>Gestión de Cuentas</h1>
    <h1>Cualquier cosa</h1>
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

    @foreach ($users as $user)
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $user->name }}</h5>
        </div>
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
        <div class="modal-footer">
            <a href="{{ route('eliminar-usuario', ['id' => $user->id]) }}" class="btn btn-danger">Eliminar</a>
        </div>
    </div>
    @endforeach
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
