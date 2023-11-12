@extends('layouts.nav&SideBar')

@section('content')

<head>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/product.css') }}">
</head>
<div class="container">
    <h1>Agregar producto</h1>
    <div class="form-div">
        <form action="{{  route('saveProduct', ['tiendaId' => $tienda->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <input type="file" name="image" accept="image/*">
            <button type="submit" class="btn-add-product">Agregar producto</button>
            @if(session('error'))
            <div class="alert alert-danger" style="color: red;">
                {{ session('error') }}
            </div>
            @endif
        </form>
    </div><br><br>

    <h2>Productos</h2><br>
    <div>
        <div class="card-deck">
            @foreach($productos as $producto)
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ $producto->name }}</h5>
                </div>

                <!-- Imagen del producto -->
                @if ($producto->image)
                <img src="{{ asset('storage/' . $producto->image) }}" alt="{{ $producto->name }}" class="card-img-top">
                @else
                <img src="{{ asset('img/producto.png')  }}" alt="Imagen predeterminada" class="card-img-top">
                @endif

                <div class="card-body">
                    <p class="card-text">Descripción: {{ $producto->description }}</p>
                </div>
                <div class="card-footer">
                    <form action="{{ route('deleteProduct', ['productId' => $producto->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete-product" type="submit">Eliminar</button>
                    </form>
                    <form action="{{ route('editProduct', ['productId' => $producto->id]) }}">
                        <button class="btn-edit-product" type="submit">Editar</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>


</div>
@endsection