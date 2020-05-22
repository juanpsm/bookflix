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

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>

                </div>
            </div>
        </div>
    </body>
</html>
