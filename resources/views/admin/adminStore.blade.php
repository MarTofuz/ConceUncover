@extends('adminlte::page')

@section('title', 'ConceUncover')

@section('content_header')
<h1>Gestión de Cuentas</h1>
@stop

@section('content')
<p>Control de Acceso a cuentas.</p>
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
<div class="row">
    @if($tiendas->isNotEmpty())
            @foreach($tiendas as $tienda)
                <div class="col-md-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            <h5 class="card-title">Tienda: {{ $tienda->name }}</h5>
                        </div>
                        <div class="card-body">
                            <p>Dirección: {{ $tienda->address }}</p>
                            <p>Descripción: {{ $tienda->description }}</p>
                            <p>Creado por: {{ $tienda->propietario->name }}</p>
                            <form action="{{ route('statusTienda', $tienda->id) }}" method="POST" id="statusForm{{ $tienda->id }}">
                                @csrf
                                <!-- Checkbox de Estado -->
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch{{ $tienda->id }}" @if ($tienda->status) checked @endif name="status_{{ $tienda->id }}" onchange="submitForm({{ $tienda->id }})">
                                    <label class="custom-control-label" for="customSwitch{{ $tienda->id }}">Estado</label>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('eliminar-tienda', ['id' => $tienda->id]) }}" class="btn btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            @endforeach
    @endif

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
                        <form action="{{ route('statusSucursal', $sucursal->id) }}" method="POST" id="statusForm{{ $sucursal->id }}">
                            @csrf
                            <!-- Checkbox de Estado -->
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" class="custom-control-input" id="customSwitch{{ $sucursal->id }}" @if ($sucursal->status) checked @endif name="status_{{ $sucursal->id }}" onchange="submitForm({{ $sucursal->id }})">
                                <label class="custom-control-label" for="customSwitch{{ $sucursal->id }}">Estado</label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('eliminar-sucursal', ['id' => $sucursal->id]) }}" class="btn btn-danger">Eliminar</a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<style>
    .custom-card {
        width: 250px;
        /* Ancho personalizado */
        height: 400px;
        /* Alto personalizado */
    }

    .searchCard {
        width: 340px;
        height: 100px;
        margin-left: 900px;
    }
</style>
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
<script>
    function submitForm(id) {
        document.getElementById('statusForm' + id).submit();
    }
</script>
@stop
