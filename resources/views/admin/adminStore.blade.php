@extends('adminlte::page')

@section('title', 'ConceUncover')

@section('content_header')
    <h1>Gestión de Tiendas</h1>
@stop

@section('content')
    <p>Control de Acceso a tiendas.</p>

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

    @if($tiendas->isNotEmpty())
        @foreach($tiendas as $tienda)
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ $tienda->name }}</h5>
                </div>
                <div class="card-body">
                    <p>Dirección: {{ $tienda->address }}</p>
                    <p>Descripción: {{ $tienda->description }}</p>
                    <p>Creado por: {{ $tienda->propietario->name }}</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('eliminar-tienda', ['id' => $tienda->id]) }}" class="btn btn-danger">Eliminar</a>
                </div>
                <div class="modal-footer"><!-- Para separar --></div>
                <div class="card-body">
                    @if ($tienda->sucursales->isNotEmpty())
                        @foreach ($tienda->sucursales as $sucursal)
                            <p>Sucursal: {{ $sucursal->name }}</p>
                            <p>Dirección: {{ $sucursal->address }}</p>
                            <p>Descripción: {{ $sucursal->description }}</p>
                            @if ($tienda->sucursales->isNotEmpty())
                            <a href="{{ route('eliminar-sucursal', ['id' => $sucursal->id]) }}" class="btn btn-danger">Eliminar</a>
                            @endif
                        @endforeach
                    @else
                        <p>No hay sucursales en esta tienda.</p>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
