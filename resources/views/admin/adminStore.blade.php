@extends('adminlte::page')

@section('title', 'ConceUncover')

@section('content_header')
    <h1>Gestión de Tiendas</h1>
@stop

@section('content')
    <p>Control de Acceso a tiendas.</p>

    <div class="card searchCard">
        <div class="card-body">
            <form action="{{ route('buscarTiendas') }}" method="GET">
                <input name="search" placeholder="buscar" type="text">
                <button class="btn btn-dark mt-2">Buscar</button>
            </form>
        </div>
    </div>
<br>

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
    <div class="row">
        @foreach($tiendas as $tienda)
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
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
                </div>
            </div>
            
            @if ($tienda->sucursales->isNotEmpty())
                @foreach ($tienda->sucursales as $sucursal)
                    <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <div class="card-header">
                            <h5 class="card-title">Sucursal</h5>
                            </div>
                            <div class="card-body">
                            <p>{{ $sucursal->name }}</p>
                                <p>Dirección: {{ $sucursal->address }}</p>
                                <p>Descripción: {{ $sucursal->description }}</p>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ route('eliminar-sucursal', ['id' => $sucursal->id]) }}" class="btn btn-danger">Eliminar</a>
                            </div>
                            <div class="modal-footer"><!-- Para separar --></div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
    .searchCard{
    width: 340px; /* Ancho personalizado */
        height: 100px; /* Alto personalizado */
        margin-left: 900px;
}
</style>

