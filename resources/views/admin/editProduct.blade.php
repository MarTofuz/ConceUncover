@extends('layouts.nav&SideBar')

@section('content')
<head>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/product.css') }}">
</head>
<div class="container">
    <h1>Editar Producto</h1>
    <div class="form-div">
        <form action="{{ route('updateProduct', ['productId' => $producto->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $producto->name }}" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $producto->description }}" required>
            </div>
            <button type="submit" class="btn-update-product">Actualizar Producto</button>
        </form>
    </div>
</div>

@endsection