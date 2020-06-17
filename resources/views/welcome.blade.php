<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bookflix</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/nuestro.css') }}" rel="stylesheet">

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

                <main role="main">

                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <h3>Los más Leídos</h3>
                        <ol class="carousel-indicators">


                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active" >
                                <div class="carrusel">
                                <?php
                                use App\Libro;
                                $libros = Libro::limit(6)->get();
                                ?>
                                @foreach ($libros as $item)
                                    <a class="" href="#">
                                        <img style="height: 150px; border-radius: 10%;" src="{{$item->portada}}" alt="" class="" >
                                    </a>
                                @endforeach
                                </div>
                            </div>
                        </div>    
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
