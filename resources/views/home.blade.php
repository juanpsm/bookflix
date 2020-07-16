@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-dark bg-dark">
                {{--Esto en realidad iria en el HomeController pero por ahora queda acá--}}
                <?php
                    use App\Libro;
                    use Carbon\Carbon;
                    $libros = Libro::where('fecha_de_vencimiento','>=',Carbon::now()->subDay())->paginate(8);
                ?>
                <div class="card-header">
                    @if(count($libros) == 0)
                        Te has logueado correctamente!
                    @else
                        Libros
                    </div>
                    <div class="card-body justify-content-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row text-center text-lg-left">
                            @foreach ($libros as $item)
                                <div class="col-lg-3 col-md-4 col-6 book">
                                    <div class="portada">
                                        <a href="{{route("libros.showForUser", $item)}}" class="d-block mb-4 h-100">
                                            <img class="img-fluid" style="border-radius: 5%;"
                                                src="{{$item->portada}}" alt="">
                                        </a>
                                        @if ($item -> proximamente())
                                            <div class="ribbon">Próximamente</div>
                                        @endif
                                    </div>
                                    <div class="titulo">{{$item->titulo}}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row d-flex justify-content-center">
                            {{$libros->links()}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
