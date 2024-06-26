@extends('layouts.nav&SideBar')


@section('content')

<head>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>

<div class="containerProfile">
    <div class="form-box">

        <h1>Perfil de Tienda</h1>
        <p>Nombre: {{ $tienda->name}}</p>
        <p>Dirección: {{ $tienda->address}}</p>
        <p>Descripción: {{ $tienda->description}}</p>
        <p>Asistente: {{ $tienda->assistant }}</p>
        <p>Horario: {{ $tienda->schedule }}</p>
        <br>
        <div class="button-container">
            <form action="{{ route('updateShop') }}">
                <button class="right-button" style="float: left;">Editar</button>
            </form>
            <form action="{{ route('productView', ['tiendaId' => $tienda->id]) }}">
                <button class="right-button">Productos</button>
            </form>
            <form action="{{ route('viewStatisticsTienda', ['id' => $tienda->id]) }}">
                <button class="right-button " style="float: right;">Estadisticas </button>
            </form>
        </div>
        <br>
        <br>
        <br>
        <br>
        <hr>
        <br>
        <h1>Sucursales</h1>

        @if(count($sucursales) > 0)
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Descripción</th>
                    <th>Asistente</th>
                    <th>Horario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sucursales as $sucursal)
                <tr>
                    <td>{{ $sucursal->name }}</td>
                    <td>{{ $sucursal->address }}</td>
                    <td>{{ $sucursal->description }}</td>
                    <td>{{ $sucursal->assistant }}</td>
                    <td>{{ $sucursal->schedule }}</td>
                    <td>
                        <a href="{{ route('viewsucursal', ['id' => $sucursal->id]) }}" style="color: black;">Ver Sucursal</a>
                        <a href="{{ route('deletedSucursal', ['id' => $sucursal->id]) }}" style="color: black;">Eliminar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No hay sucursal asociada</p>
        @endif
        <br>
        <br>
        <form action="{{ route('viewSaveSucursal', ['id' => $tienda->id]) }}">
            <button style="width: 200px;" class="right-button">Nueva Sucursal</button>
        </form>

    </div>
</div>
    @endsection
