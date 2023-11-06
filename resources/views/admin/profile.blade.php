@extends('layouts.nav&SideBar')


@section('content')

<head>
<link type="text/css" rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>

<div class="containerProfile">
    <div class="form-box">
        <h1>Perfil</h1>
        <br>
        <div class="text-center">
            <img src="{{ asset('css/usuario.png') }}" class="rounded" alt="...">
        </div>
        <p>Usuario: {{ $user->name ?? 'No hay datos' }}</p>
        <p>Teléfono: {{ $user->phone ?? 'No hay datos' }}</p>
        <p>Dirección: {{ $user->address ?? 'No hay datos' }}</p>
        <p>Correo: {{ $user->email }}</p>
        <br>
        <form action="{{ route('edit') }}">
            <button class="right-button">Editar</button>
        </form>
        <br>
        <br>
        <br>
        <br>
        <hr>
        <br>

        <h1>Tienda</h1>

        @if ($tienda)
        <p>Nombre: {{ $tienda->name }}</p>
        <form action="{{ route('viewProfileShop') }}">
            <button class="right-button">Ver Tienda</button>
        </form>
        <br>
        @else
        <p>No hay tienda asociada</p>
        <form action="{{ route('viewSaveShop') }}">
            <button class="right-button">Nueva Tienda</button>
        </form>
        @endif
    </div>
</div>

@endsection