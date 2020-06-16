<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Bookflix') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/bootstrap-typeahead.min.js') }}"></script>
        {{--<script src="{{ asset('js/pdfThumbnails/pdfjs/build/pdf.js') }}"></script>--}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.js"></script>
        <script src="{{ asset('js/pdfThumbnails/pdfThumbnails.js') }}"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/nuestro.css') }}" rel="stylesheet">
    </head>
    <body oncontextmenu="return false;">
        <div id="app">
            @if(Auth::check() && session('perfil'))
                <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Bookflix') }}
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="nav-link" role="button" href="{{ url('/home') }}">
                                        Inicio
                                    </a>
                                </li>
                                
                                <li class="nav-item dropdown">
                                    <a id="navbarGenero" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Generos
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                        @foreach(\App\Genero::all() as $genero)
                                            <a class="dropdown-item" href="{{route('generos.showGenero', $genero->id)}}">{{ $genero->nombre }}</a>
                                        @endforeach
                                    </div>  
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" role="button" href="{{route('novedades.showNovedad')}}">
                                        Novedades
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" role="button" href="{{route('libros_leidos.index')}}">
                                        Historial
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" role="button" href="{{route('libros_favoritos.index')}}">
                                        Favoritos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" role="button" href="{{route('libros_miLista.index')}}">
                                        Mi Lista
                                    </a>
                                </li>
                            </ul>
                            <div class="navbar-nav">
                                <input id="searchBook" class="form-control form-control-sm">
                                <script>
                                $(document).ready(function() {
                                    $('#searchBook').typeahead({
                                        minLength: 1,
                                        delay: 400,
                                        autoSelect: false,
                                        source(query, process) {
                                            $.ajax({
                                                url: '{{ url("libros/user/search") }}',
                                                data: {q: query, limit: 8},
                                                dataType: 'json'
                                            })
                                            .done(function(response) {
                                                return process(response);
                                            });
                                        },
                                        displayText: (item) => item.titulo,
                                        matcher() { return true },
                                        afterSelect(item) {
                                            location.href = `{{url('libros/user')}}/${item.id}`
                                        }
                                    });
                                });
                                </script>
                            </div>
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav">
                                <!-- Authentication Links -->
                                @auth
                                    @if(Request::is('*admin*'))
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ __('Hi') }}, {{ Auth::user()->name }}! <span class="caret"></span>
                                    </a>
                                    @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ __('Hi') }}, {{session('perfil')->nombre}}{{-- pido el nombre del perfil en lugar del usuario Auth::user()->name --}}! <span class="caret"></span>
                                            
                                        </a>
                                    @endif

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            {{--<a class="dropdown-item" href="{{ route('tarjetas.index') }}">
                                                Tarjetas
                                            </a>--}}
                                            <a class="dropdown-item" href="{{ route('seleccionar_perfil') }}">
                                                Cambiar perfil
                                            </a>
                                            <a class="dropdown-item" href="{{ url('elegirSuscripcion') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('eliminarSuscripcion-form').submit();">
                                                Cancelar suscripción
                                            </a>

                                            <form id="eliminarSuscripcion-form" action="{{ url('elegirSuscripcion') }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </nav>
            @endif

            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body>
</html>