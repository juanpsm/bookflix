@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card bg-dark">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="mr-auto">
              {{$libro -> titulo}}
              @if($leido)
              <svg class="bi bi-check-all text-primary" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14l.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z"/>
              </svg>
              @endif
          </span>
          @if($isFavorite)
            <a href="{{url("libros/user/{$libro->id}/toggle_favorite")}}" class="btn btn-warning btn-sm">Desmarcar favorito</a>
          @else
            <a href="{{url("libros/user/{$libro->id}/toggle_favorite")}}" class="btn btn-secondary btn-sm">Marcar favorito</a>
          @endif
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
              @if (!($libro-> portada  == 'noFile'))
                <img style="width:100%; border-radius: 2%;" src="{{url($libro -> portada)}}">
              @endif 
            </div>
            <div class="col-md-4">
              <div class="row" style="padding: 10px">
                @foreach($libro->generos as $genero)
                  <div class="genero-libro" 
                        style="border-radius: 10px;
                              border: 1px solid #E50914;
                              padding: 5px;"> 
                    {{$genero->nombre}}
                  </div>
                @endforeach
              </div>
              @if($libro->capitulos()->count())
              <a class="btn btn-lg btn-block" style="color: black; background-color: #E50914"
                  href="{{route('libro.capitulos', $libro->id)}}">
                Leer
              </a>
              @endif
              @if($libro->trailer)
              <button class="btn btn-dark btn-block">
                Trailer
              </button>
              @endif
              <button class="btn btn-info btn-block" type="button" data-toggle="collapse" data-target="#collapseExample">
                Más información
                <svg class="bi bi-chevron-down" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                </svg>
              </button>
              <div class="collapse" id="collapseExample">
                <!--mas informacion:-->
                <div class="card-body">
                  <h6>Autor: {{$libro -> autor -> nombre}} </h6>
                  <h6>Editorial: {{$libro -> editorial -> nombre}} </h6>
                  <h6>ISBN: {{$libro -> isbn}} </h6>
                  <h6>Lanzamiento: {{$libro -> fecha_de_lanzamiento->format("d/m/Y")}} </h6>
                  <h6>Vencimiento:{{$libro -> fecha_de_vencimiento->format("d/m/Y")}} </h6>
                </div>
                <!--div del colapso:-->    
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
            </div>
            <div class="col-md-4">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$('#collapseExample').collapse('hide');
</script>
@endsection