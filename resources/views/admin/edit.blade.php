@extends('layouts.nav&SideBar')


@section('content')

<head>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>

<div class="containerProfile">
    <div class="wrapper">
        <div class="form-box login">
            <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                <h2>Editar Perfil</h2>
                <br>
                <br>
                @csrf
                <div class="form-group">
                    <label for="name" class="label">Nombre:</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone" class="label">Teléfono:</label>
                    <input type="text" id="phone" name="phone" value="{{ $user->phone }}" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="address" class="label">Dirección:</label>
                    <input type="text" id="address" name="address" value="{{ $user->address }}" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="email" class="label">Correo:</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="profile_photo" class="label">Imagen de perfil:</label>
                    <input type="file" id="profile_photo" name="profile_photo" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <label for="delete_photo" class="label">Eliminar imagen actual:</label>
                    <input type="checkbox" id="delete_photo" name="delete_photo"> Marcar para eliminar
                </div>
                <br>
                <button class="btn btn-dark px-4" type="submit">Actualizar</button>
            </form>
        </div>
    </div>


</div>

@endsection