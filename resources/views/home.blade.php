@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-dark bg-dark">
                <div class="card-header">
                    Libros
                </div>
                <div class="card-body justify-content-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{--Esto en realidad iria en el HomeController pero por ahora queda acá--}}
                    <?php
                    use App\Libro;
                    $libros = Libro::get();
                    ?>
                    <div class="row text-center text-lg-left">
                        @foreach ($libros as $item)
                            <div class="col-lg-3 col-md-4 col-6 book">
                                <div class="portada">
                                    <a href="{{route("libros.showForUser", $item)}}" class="d-block mb-4 h-100">
                                        <img class="img-fluid" style="border-radius: 5%;"
                                            src="{{$item->portada}}" alt="">
                                    </a>
                                    @if (!$item -> finalizado())
                                        <div class="ribbon">Proximamente</div>
                                        <div class="embed-cover"></div>
                                    @endif
                                </div>
                                <div class="titulo">{{$item->titulo}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
