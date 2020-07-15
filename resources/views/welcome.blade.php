<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bookflix</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/nuestro.css') }}" rel="stylesheet">
        <link href="{{ asset('css/portadas.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('showNovedad') }}">Ver novedades</a>
                    @else
                        <a href="{{ url('showNovedadGuest') }}">Ver novedades</a>
                    @endauth
                    {{-- esto lo hacia laravel con auth, lo cambio por guest y lo doy vuelta--}}
                    @guest
                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register')){{-- esto no se que hace --}}
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <a href="{{ url('/home') }}">{{ __('Home') }}</a>        
                    @endguest
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Bookflix
                </div>

                {{-- <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>

                </div> --}}

                <main class="py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card card-dark bg-dark">
                                    <div class="card-header">
                                        Los más Leídos
                                    </div>
                                    <div class="card-body justify-content-center">
                                        <?php
                                        use App\Libro;
                                        
                                        $libros = Libro::withTrashed()->get();
                                        $libros = $libros->sortByDesc(function($libro){return $libro->cantLectores();});
                                        $libros = $libros->take(6);
                                        ?>
                                        <div class="row text-center text-lg-left">
                                            @foreach ($libros as $item)
                                                <div class="col-lg-2 col-md-2 col-2 book">
                                                    <div class="portada">
                                                        <a href="{{route("libros.showForUser", $item)}}" class="d-block mb-4 h-100">
                                                            <img class="img-fluid" style="border-radius: 5%;"
                                                                src="{{$item->portada}}" alt="">
                                                        </a>
                                                        @if (!$item -> finalizado())
                                                            <div class="ribbon">Próximamente</div>
                                                            <div class="embed-cover"></div>
                                                        @endif
                                                    </div>
                                                    <div class="titulo"><small>{{$item->titulo}}</small></div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
