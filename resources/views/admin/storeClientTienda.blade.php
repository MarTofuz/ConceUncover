<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/storeClient.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">

    <title>Conce Uncover</title>
    <style>
        .media-body {
            width: 100%;
        }

        .media-body-answer {
            padding-left: 150px;
        }

        .media p {
            width: 75%;
        }

        .media {
            width: 100%;
        }

        .star {
            display: inline-block;
            width: 20px;
            height: 20px;
            background: url('path-to-your-star-icon.png') no-repeat;
            background-size: contain;
            cursor: pointer;
        }

        .rated {
            background-position: 0 -20px;
            /* Ajusta este valor según las dimensiones de tu icono de estrella */
        }

        .rating-container {
            margin-bottom: 20px;
        }

        /* Estilos para ocultar la lista de favoritos al inicio */
        #favoritos-list {
            display: none;
            position: absolute;
            background-color: white;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        /* Estilos para la opción "Favoritos" */
        #favoritos:hover #favoritos-list {
            display: block;
        }
    </style>
</head>

<body>
    @if(Auth::check())
    <header>
        <div class="logo-container">
            <h2 class="logo">Conce Uncover</h2>
            <input type="checkbox" id="check" style="display: none;">
            <label for="check">
                <i class="fas fa-bars" id="bars"></i>
            </label>
        </div>
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
                <li>
                    <a href="{{ route('profile') }}">
                        <i class='fas fa-portrait'></i> Perfil
                    </a>
                </li>
                <li id="favoritos">
                    <!-- Opción "Favoritos" -->
                    <a href="#">
                        <i class="fas fa-star"></i> Favoritos
                    </a>
                    <!-- Lista de favoritos que se mostrará al pasar el ratón sobre "Favoritos" -->
                    <ul id="favoritos-list">
                        @foreach ($favoritos->reverse() as $favorito)
                        <li id="favoritos">
                            @if ($favorito->sucursal)
                            <a href="{{ route('viewClientSucursal', ['id' => $favorito->sucursal->id]) }}">
                                <i class="fas fa-star"></i> {{ $favorito->sucursal->name }}
                            </a>
                            @elseif ($favorito->tienda)
                            <a href="{{ route('viewClientTienda', ['id' => $favorito->tienda->id]) }}">
                                <i class="fas fa-star"></i> {{ $favorito->tienda->name }}
                            </a>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a class="btn btn-outline-dark" href="{{ route('logout') }}">Cerrar Sesión</a>
                </li>
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
                <p>Visitas: {{ $totalVisits }}</p>
                <h2>Calificaciones de la Página</h2>

                <p>Valoraciones totales: {{ $tienda->comment->where('rating', '!=', null)->count() }}</p>
                <p>Valoraciones de una estrella: <i class="fa fa-star" style="color: yellow;"></i> {{ $tienda->comment->where('rating', 1)->count() }}</p>
                <p>Valoraciones de dos estrella: <i class="fa fa-star" style="color: yellow;"></i> {{ $tienda->comment->where('rating', 2)->count() }}</p>
                <p>Valoraciones de tres estrella: <i class="fa fa-star" style="color: yellow;"></i> {{ $tienda->comment->where('rating', 3)->count() }}</p>
                <p>Valoraciones de cuatro estrella: <i class="fa fa-star" style="color: yellow;"></i> {{ $tienda->comment->where('rating', 4)->count() }}</p>
                <p>Valoraciones de cinco estrella: <i class="fa fa-star" style="color: yellow;"></i> {{ $tienda->comment->where('rating', 5)->count() }}</p>
                <p>Promedio de Evaluación: <i class="fa fa-star" style="color: yellow;"></i> {{ round($tienda->comment->avg('rating'), 1) }}</p>
                <form action="{{ route('favoritosTienda') }}" method="POST">
                    @csrf
                    <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                    <input type="text" name="tienda_id" value="{{ $tienda->id }}" hidden>

                    @if ($tienda->favoritos->contains('user_id', Auth::user()->id)) <!-- Verifica si la tienda está en favoritos del usuario -->
                    <button class="right-button" style="float: right; background-color: red; color: white;" type="submit">
                        Eliminar Favorito
                    </button>
                    @else
                    <button class="right-button" style="float: right; background-color: yellow; color: black;" type="submit">
                        Agregar a Favoritos
                    </button>
                    @endif
                </form>
            </div>
        </div>
        <div class="comments">
            <h2>Comentarios y valoraciones</h2>
            <div class="comentarios">
                @if (Auth::check())
                @php
                $user = Auth::user();
                $tiendaId = $tienda->id;
                $hasCommented = \App\Models\Comment::where('user_id', $user->id)->where('tienda_id', $tiendaId)->exists();
                @endphp
                @if (!$hasCommented)
                <!-- Mostrar el formulario solo si el usuario no ha comentado -->
                <form action="{{ route('commentRatingTienda', $tienda) }}" method="post">
                    @csrf
                    <div class="form-group" style="display: none;">
                        <label>Nombre</label>
                        <input class="form-control" type="text" value="{{Auth::user()->name}}" readonly>
                    </div>
                    <div class="form-control" type="text" style="display: none;">
                        <label>Email <span class="color-red">*</span></label>
                        <input class="form-control" type="text" value="{{Auth::user()->email}}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Rating</label>
                        <div class="rating-container">
                            @for ($i = 1; $i
                            <= 5; $i++) <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" style="display: none;" required />
                            <label for="star{{ $i }}" class="star" data-value="{{ $i }}"><i class="fa-solid fa-star" style="color: #808080;"></i></label>
                            @endfor
                        </div>
                    </div>
                    <div>
                        <label>Mensaje</label>
                        <textarea class="form-control" name="content" id="content" rows="8" placeholder="Selecciona tu calificación y comenta..." required></textarea>
                        <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                    </div>
                    <p><button class="btn btn-primary" type="submit">Agregar</button></p>
                </form>
                @else
                @if (Auth::check())
                <!-- Mostrar el formulario solo si el usuario está autenticado -->
                <form action="{{ route('commentSave', $tienda) }}" method="post">
                    @csrf
                    <div class="form-group" style="display: none;">
                        <label>Nombre</label>
                        <input class="form-control" type="text" value="{{Auth::user()->name}}" readonly>
                    </div>
                    <div class="form-control" type="text" style="display: none;">
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
                @endif
                @endif
                @forelse ($tienda->comment->whereNull('comment_id')->reverse() as $comment)
                <div class="media">
                    <div class="media-body">
                        <h5 style="margin-left: 1000px;">{{ $comment->created_at->diffForHumans() }} / <a href="javascript:;" class="boton-reply" style="margin-left: 10px;">Responder</a></h5>
                        <div style="display: flex;">
                            <div style="flex-shrink: 0; margin-right: 10px;">
                                <p>
                                    <strong>{{ $comment->user->name }}</strong><br>
                                    @if($comment->rating)
                                <p><i class="fa fa-star" style="color: yellow;"></i> {{ $comment->rating }}</p>
                                @endif
                                @if($comment->user->profile_photo_path)
                                <!-- Si el usuario está autenticado y tiene una foto de perfil -->
                                <img src="{{ asset('storage/' . $comment->user->profile_photo_path) }}" class="media-object" style="width:60px">
                                @else
                                <!-- Si el usuario no está autenticado o no tiene una foto de perfil -->
                                <img src="{{ asset('img/avatar.jpg') }}" class="media-object" style="width:60px">
                                @endif
                                </p>
                            </div>
                            <p style="background-color: #f5f5f5; padding: 10px; border-radius: 5px; width: 100%;">{{ $comment->content }}</p>
                        </div>
                        @foreach ($comment->hijo as $hijo)
                        <div class="media">
                            <div class="media-body-answer">
                                <h5 style="margin-left: 1000px;">{{ $hijo->created_at->diffForHumans() }}</h5>
                                <div style="display: flex;">
                                    <div style="flex-shrink: 0; margin-right: 10px;">
                                        <p>
                                            <strong>{{ $hijo->user->name }}</strong>

                                            <!-- Imagen del usuario (opcional si deseas mostrarla nuevamente) -->
                                            @if($hijo->user->profile_photo_path)<!-- Si el usuario está autenticado y tiene una foto de perfil -->
                                            <img src="{{ asset('storage/' . $hijo->user->profile_photo_path) }}" class="media-object" style="width:60px">
                                            @else
                                            <img src="{{ asset('img/avatar.jpg') }}" class="media-object" style="width:60px">
                                            @endif
                                        </p>
                                    </div>
                                    <p style="background-color: #f5f5f5; padding: 10px; border-radius: 5px; width: 100%">{{ $hijo->content }}</p>
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
                    @empty
                    No hay comentarios para la tienda
                    <br>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @else
    <header>
        <div class="logo-container">
            <h2 class="logo">Conce Uncover</h2>
            <input type="checkbox" id="check" style="display: none;">
            <label for="check">
                <i class="fas fa-bars" id="bars"></i>
            </label>
        </div>
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
                <p>Visitas: {{ $totalVisits }}</p>
                <h2>Calificaciones de la Página</h2>

                <p>Valoraciones totales: {{ $tienda->comment->where('rating', '!=', null)->count() }}</p>
                <p>Valoraciones de una estrella: <i class="fa fa-star" style="color: yellow;"></i> {{ $tienda->comment->where('rating', 1)->count() }}</p>
                <p>Valoraciones de dos estrella: <i class="fa fa-star" style="color: yellow;"></i> {{ $tienda->comment->where('rating', 2)->count() }}</p>
                <p>Valoraciones de tres estrella: <i class="fa fa-star" style="color: yellow;"></i> {{ $tienda->comment->where('rating', 3)->count() }}</p>
                <p>Valoraciones de cuatro estrella: <i class="fa fa-star" style="color: yellow;"></i> {{ $tienda->comment->where('rating', 4)->count() }}</p>
                <p>Valoraciones de cinco estrella: <i class="fa fa-star" style="color: yellow;"></i> {{ $tienda->comment->where('rating', 5)->count() }}</p>
                <p>Promedio de Valoraciones: <i class="fa fa-star" style="color: yellow;"></i> {{ round($tienda->comment->avg('rating'), 1) }}</p>
            </div>
        </div>
        <div class="comments">
            <h2>Comentarios y valoraciones</h2>
            <div class="comentarios">
                @if (Auth::check())
                <!-- Mostrar el formulario solo si el usuario está autenticado -->
                <form action="{{ route('commentSave', $tienda) }}" method="post">
                    @csrf
                    <div class="form-group" style="display: none;">
                        <label>Nombre</label>
                        <input class="form-control" type="text" value="{{Auth::user()->name}}" readonly>
                    </div>
                    <div class="form-control" type="text" style="display: none;">
                        <label>Email <span class="color-red">*</span></label>
                        <input class="form-control" type="text" value="{{Auth::user()->email}}" readonly>
                    </div>
                    <div>
                        <label>Mensaje</label>
                        <textarea class="form-control" name="content" id="content" rows="8" placeholder="Escribe un mensaje..." required></textarea>
                        <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                    </div>
                    <p><button class="btn btn-primary" type="submit">Agregar</button></p>
                </form>
                @endif
                @forelse ($tienda->comment->whereNull('comment_id')->reverse() as $comment)
                <div class="media">
                    <div class="media-body">
                        <h5 style="margin-left: 1000px;">{{ $comment->created_at->diffForHumans() }}</h5>
                        <div style="display: flex;">
                            <div style="flex-shrink: 0; margin-right: 10px;">
                                <p>
                                    <strong>{{ $comment->user->name }}</strong><br>
                                    @if($comment->rating)
                                <p><i class="fa fa-star" style="color: yellow;"></i> {{ $comment->rating }}</p>
                                @endif
                                @if($comment->user->profile_photo_path)
                                <!-- Si el usuario está autenticado y tiene una foto de perfil -->
                                <img src="{{ asset('storage/' . $comment->user->profile_photo_path) }}" class="media-object" style="width:60px">
                                @else
                                <!-- Si el usuario no está autenticado o no tiene una foto de perfil -->
                                <img src="{{ asset('img/avatar.jpg') }}" class="media-object" style="width:60px">
                                @endif
                                </p>
                            </div>
                            <p style="background-color: #f5f5f5; padding: 10px; border-radius: 5px; width: 100%;">{{ $comment->content }}</p>
                        </div>
                        @foreach ($comment->hijo as $hijo)
                        <div class="media">
                            <div class="media-body-answer">
                                <h5 style="margin-left: 1000px;">{{ $hijo->created_at->diffForHumans() }}</h5>
                                <div style="display: flex;">
                                    <div style="flex-shrink: 0; margin-right: 10px;">
                                        <p>
                                            <strong>{{ $hijo->user->name }}</strong>

                                            <!-- Imagen del usuario (opcional si deseas mostrarla nuevamente) -->
                                            @if($hijo->user->profile_photo_path)<!-- Si el usuario está autenticado y tiene una foto de perfil -->
                                            <img src="{{ asset('storage/' . $hijo->user->profile_photo_path) }}" class="media-object" style="width:60px">
                                            @else
                                            <img src="{{ asset('img/avatar.jpg') }}" class="media-object" style="width:60px">
                                            @endif
                                        </p>
                                    </div>
                                    <p style="background-color: #f5f5f5; padding: 10px; border-radius: 5px; width: 100%">{{ $hijo->content }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @empty
                    No hay comentarios para la tienda
                    <br>
                    @endforelse
                </div>
                @endif
            </div>
        </div>
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

<script>
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.querySelector('input[name="rating"]');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const value = star.getAttribute('data-value');
            ratingInput.value = value;

            stars.forEach(s => {
                const starIcon = s.querySelector('i');
                const starValue = s.getAttribute('data-value');

                if (starValue <= value) {
                    starIcon.style.color = '#ffd700'; // Amarillo
                } else {
                    starIcon.style.color = '#808080'; // Gris
                }
            });
        });
    });

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('favorite')) {
            event.preventDefault(); // Evita la acción predeterminada del botón

            var tiendaId = event.target.dataset.tiendaId;
            if (tiendaId) {
                var form = document.createElement('form');
                form.method = 'GET'; // Método del formulario

                // Modificar la acción del formulario para incluir el ID en la URL
                form.action = "{{ route('viewClientTienda', ['id' => ':id']) }}".replace(':id', tiendaId);

                document.body.appendChild(form); // Agrega el formulario al DOM
                form.submit(); // Envía el formulario
            }
        }
    });
</script>
</html>
