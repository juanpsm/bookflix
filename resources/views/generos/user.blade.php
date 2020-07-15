@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-dark bg-dark">
                <div class="card-header">
                    Género: {{$genero->nombre}}
                </div>
                <div class="card-body justify-content-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($libros->isEmpty())
                        <h3>Por el momento no hay libros de éste género.</h3>
                    @else
                    <div class="row text-center text-lg-left">
                        @foreach ($libros as $item)
                            <div class="col-lg-3 col-md-4 col-6 book">
                                <div class="portada">
                                    <a href="{{route("libros.showForUser", $item)}}">
                                        <img class="img-fluid" style="border-radius: 5%;"
                                            src="{{url($item->portada)}}" alt="">
                                    </a>
                                    @if (!$item -> finalizado())
                                        <div class="ribbon">Próximamente</div>
                                        <div class="embed-cover"></div>
                                    @endif
                                </div>
                                <div class="titulo">{{$item->titulo}}</div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection