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
                    @foreach ($libros as $item)
                        <a class="" href="{{route("libros.showForUser", $item)}}">
                            <img style="height: 150px; border-radius: 10%;" src="{{$item->portada}}" alt="" class="" >
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
