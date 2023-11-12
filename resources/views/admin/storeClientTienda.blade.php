<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/storeClient.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Conce Uncover</title>
</head>

<body>
    @if(Auth::check())
    <header>
        <input type="checkbox" id="check" style="display: none;">
        <label for="check">
            <i class="fas fa-bars" id="bars"></i>
        </label>
        <h2 class="logo">Conce Uncover</h2>
        <nav class="navigation">
            <a href="{{ route('home') }}">Inicio</a>
        </nav>
    </header>

    <div class="columna-izquierda">
        <!-- Sidebar -->
        <div class="sidebarleft">
            <div class="usuario">
                @if(Auth::user()->profile_photo_path)
                <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" class="rounded" alt="Perfil " style="width: 40px;height: 40px; border-radius: 50%; margin-right: 10px;margin-left: 42px;">
                @else
                <img src="{{ asset('img/avatar.jpg') }}" alt="Perfil Estático" style="width: 40px;height: 40px; border-radius: 50%; margin-right: 10px;margin-left: 42px;">
                @endif
                <h3 class="usertitle">{{ $user->name }}</h3>
            </div>
            <ul>
                <li> <a href="{{ route('profile') }}"><i class='fas fa-portrait'></i> Perfil</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <li><a class="btn btn-outline-dark" href="{{ route('logout') }}">Cerrar Sesión</a></li>
                <a></a>

            </ul>
        </div>
    </div>


    <div class="columna-derecha">
        <div class="body-container">
            <div class="columna-producto">
                <h2>Productos</h2><br>
                <div>
                    <div class="card-deck">
                        @foreach($productos as $producto)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"> {{ $producto->name }}</h5>
                            </div>
                            @if ($producto->image)
                            <img src="{{ asset('storage/' . $producto->image) }}" alt="{{ $producto->name }}" class="card-img-top">
                            @else
                            <img src="{{ asset('img/producto.png')  }}" alt="Imagen predeterminada" class="card-img-top">
                            @endif
                            <div class="card-body">
                                <p class="card-text">Descripción: {{ $producto->description }}</p>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="columna-info">
                <h2>Información de la tienda "{{$tienda->name}}"</h2><br>
                <p>Dirección: {{ $tienda->address }}</p>
                <p>Descripción: {{ $tienda->description }}</p>
                <p>Asistente: {{ $tienda->assistant }}</p>
                <p>Horario: {{ $tienda->schedule }}</p>
            </div>
        </div>
    </div>

    <div class="comments">
        <h2>Comentarios y valoraciones</h2>
        <div class="comentarios">
            @if (Auth::check())
            <!-- Mostrar el formulario solo si el usuario está autenticado -->
            <form action="{{ route('commentSave', $tienda) }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Nombre</label>
                    <input class="form-control" type="text" value="{{Auth::user()->name}}" readonly>
                </div>
                <div class="form-control" type="text">
                    <label>Email <span class="color-red">*</span></label>
                    <input class="form-control" type="text" value="{{Auth::user()->email}}" readonly>
                </div>
                <div>
                    <label>Mensaje</label>
                    <textarea class="form-control" name="content" id="content" rows="8" required></textarea>
                    <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                </div>
                <p><button class="btn btn-primary" type="submit">Agregar</button></p>
            </form>
            @endif
            @forelse ($tienda->comment->whereNull('comment_id')->reverse() as $comment)
            <div class="media">
                <div class="media-body" style="margin-left: 10px; border: 1px solid #ccc;">
                    <h5 style="margin-left: 1000px;">{{ $comment->created_at->diffForHumans() }} / <a href="javascript:;" class="boton-reply" style="margin-left: 10px;">Responder</a></h5>
                    <div style="display: flex;">
                        <div style="flex-shrink: 0; margin-right: 10px;">
                            <!-- Imagen del usuario (opcional si deseas mostrarla nuevamente) -->
                            @if(Auth::user()->profile_photo_path)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" class="media-object" style="width:60px">
                            @else
                            <img src="{{ asset('img/avatar.jpg') }}" class="media-object" style="width:60px">
                            @endif
                        </div>
                        <p style="background-color: #f5f5f5; padding: 10px; border-radius: 5px;">{{ $comment->content }}</p>
                        @foreach ($comment->hijo as $hijo)
                        <div class="media">
                            <div class="media-body" style="margin-left: 10px; border: 1px solid #ccc;">
                                <h5 style="margin-left: 1000px;">{{ $hijo->created_at->diffForHumans() }}</h5>
                                <div style="display: flex;">
                                    <div style="flex-shrink: 0; margin-right: 10px;">
                                        <!-- Imagen del usuario (opcional si deseas mostrarla nuevamente) -->
                                        @if(Auth::user()->profile_photo_path)
                                        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" class="media-object" style="width:60px">
                                        @else
                                        <img src="{{ asset('img/avatar.jpg') }}" class="media-object" style="width:60px">
                                        @endif
                                    </div>
                                    <p style="background-color: #f5f5f5; padding: 10px; border-radius: 5px;">{{ $hijo->content }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="form-reply" style="display: none;">
                        <form action="{{ route('commentSave', $tienda) }}" role="form" method="post">
                            @csrf
                            <div class="form-group">
                                <h3>Respuesta</h3>
                                <textarea name="content" id="content" rows="8" require></textarea>
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                            </div>
                            <p><button class="btn btn-primary" type="submit">Enviar</button></p>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            No hay comentarios para la tienda
            <br>

            @endforelse
        </div>
    </div>
    @else
    <header>
        <input type="checkbox" id="check" style="display: none;">
        <label for="check">
            <i class="fas fa-bars" id="bars"></i>
        </label>
        <h2 class="logo">Conce Uncover</h2>
        <nav class="navigation">
            <a href="{{ route('/') }}">Inicio</a>
        </nav>
    </header>

    <div class="columna-izquierda">
        <!-- Sidebar -->
        <div class="sidebarleft">

            <ul>
                <li> <a href="{{ route('login') }}"><i class='fas fa-portrait'></i> Iniciar Sesión</a></li>
                <li> <a href="{{ route('register') }}"><i class='fas fa-portrait'></i> Registrarse</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <li><a href="#"><i class="fas fa-star"></i> Favoritos</a></li>
                <a></a>

            </ul>
        </div>
    </div>
    <div class="columna-derecha">
        <div class="body-container">
            <div class="columna-producto">
                <h2>Productos</h2><br>
                <div>
                    <div class="card-deck">
                        @foreach($productos as $producto)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"> {{ $producto->name }}</h5>
                            </div>
                            <img src="http://localhost/ConceUncover/public/img/producto.png" alt="">
                            <div class="card-body">
                                <p class="card-text">Descripción: {{ $producto->description }}</p>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="columna-info">
                <h2>Información de la tienda "{{$tienda->name}}"</h2><br>
                <p>Dirección: {{ $tienda->address }}</p>
                <p>Descripción: {{ $tienda->description }}</p>
                <p>Asistente: {{ $tienda->assistant }}</p>
                <p>Horario: {{ $tienda->schedule }}</p>
            </div>
        </div>
    </div>

    <div class="comments">
        <h2>Comentarios y valoraciones</h2>
        <div class="comentarios">
            @if (Auth::check())
            <!-- Mostrar el formulario solo si el usuario está autenticado -->
            <form action="{{ route('commentSave', $tienda) }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Nombre</label>
                    <input class="form-control" type="text" value="{{Auth::user()->name}}" readonly>
                </div>
                <div class="form-control" type="text">
                    <label>Email <span class="color-red">*</span></label>
                    <input class="form-control" type="text" value="{{Auth::user()->email}}" readonly>
                </div>
                <div>
                    <label>Mensaje</label>
                    <textarea class="form-control" name="content" id="content" rows="8" required></textarea>
                    <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                </div>
                <p><button class="btn btn-primary" type="submit">Agregar</button></p>
            </form>
            @endif
            @forelse ($tienda->comment->whereNull('comment_id')->reverse() as $comment)
            <div class="media">
                <div class="media-body" style="margin-left: 10px; border: 1px solid #ccc;">
                    <h5 style="margin-left: 1000px;">{{ $comment->created_at->diffForHumans() }}</h5>
                    <div style="display: flex;">
                        <div style="flex-shrink: 0; margin-right: 10px;">
                            @if(Auth::check() && Auth::user()->profile_photo_path)
                            <!-- Si el usuario está autenticado y tiene una foto de perfil -->
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" class="media-object" style="width:60px">
                            @else
                            <!-- Si el usuario no está autenticado o no tiene una foto de perfil -->
                            <img src="{{ asset('img/avatar.jpg') }}" class="media-object" style="width:60px">
                            @endif
                        </div>
                        <p style="background-color: #f5f5f5; padding: 10px; border-radius: 5px;">{{ $comment->content }}</p>
                        @foreach ($comment->hijo as $hijo)
                        <div class="media">
                            <div class="media-body" style="margin-left: 10px; border: 1px solid #ccc;">
                                <h5 style="margin-left: 1000px;">{{ $hijo->created_at->diffForHumans() }}</h5>
                                <div style="display: flex;">
                                    <div style="flex-shrink: 0; margin-right: 10px;">
                                        <!-- Imagen del usuario (opcional si deseas mostrarla nuevamente) -->
                                        @if(Auth::check() && Auth::user()->profile_photo_path)
                                        <!-- Si el usuario está autenticado y tiene una foto de perfil -->
                                        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" class="media-object" style="width:60px">
                                        @else
                                        <!-- Si el usuario no está autenticado o no tiene una foto de perfil -->
                                        <img src="{{ asset('img/avatar.jpg') }}" class="media-object" style="width:60px">
                                        @endif
                                    </div>
                                    <p style="background-color: #f5f5f5; padding: 10px; border-radius: 5px;">{{ $hijo->content }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @empty
            No hay comentarios para la tienda
            <br>
            @endforelse
        </div>
        @endif
    </div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const check = document.getElementById("check");
        const columnaIzquierda = document.querySelector(".columna-izquierda");
        const columnaDerecha = document.querySelector(".columna-derecha");

        // Oculta la columna izquierda al cargar la página
        columnaIzquierda.style.display = "none";

        // Agrega un evento al input para cambiar el diseño al hacer clic en el botón
        check.addEventListener("change", function() {
            if (this.checked) {
                columnaIzquierda.style.display = "block";
                columnaDerecha.style.flex = "1";
            } else {
                columnaIzquierda.style.display = "none";
                columnaDerecha.style.flex = "2";
            }
        });

        $(document).ready(function() {
            $('.boton-reply').on('click', function(event) {
                event.preventDefault();
                $('.form-reply').hide();
                $(this).closest('.media').find('.form-reply').show();
            });
        });
    });
</script>


</html>