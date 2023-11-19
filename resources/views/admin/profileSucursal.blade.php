@extends('layouts.nav&SideBar')


@section('content')

<head>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>

<div class="containerProfile">
    <div class="form-box">

        <h1 style="margin-bottom: 80px;">Perfil de Sucursales</h1>
        <div class="form-container" style="margin-bottom: 80px;">
            <p>Nombre: {{ $sucursal->name}}</p>
            <p>Dirección: {{ $sucursal->address}}</p>
            <p>Descripción: {{ $sucursal->description}}</p>
            <p>Asistente: {{ $sucursal->assistant }}</p>
            <p>Horario: {{ $sucursal->schedule }}</p>
            <br>

        </div>


        <div class="button-container">
            <form action="{{ route('viewUpdateSucursal', ['id' => $sucursal->id]) }}) }}">
                @csrf
                <button class="right-button" style="float: left;">Editar</button>
            </form>
            <form action=" {{ route('producto-sucursal', ['sucursalId' => $sucursal->id]) }}">
                <button class="right-button">Productos</button>
            </form>
            <form action="{{ route('viewStatisticsSucursal', ['id' => $sucursal->id]) }}">
                <button class="right-button " style="float: right;">Estadisticas </button>
            </form>
        </div>
    </div>
</div>
@endsection