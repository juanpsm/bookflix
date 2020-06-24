@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card bg-dark">
        <div class="card-header d-flex justify-content-between align-items-center">
          {{-- Titulo --}}
          <span class="mr-auto">
              {{$libro -> titulo}}
              {{-- marca Leído --}}
              @if($leido)
              <svg class="bi bi-check-all text-primary" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14l.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z"/>
              </svg>
              @endif
          </span>
          {{-- Boton Favoritos --}}
          @if($isFavorite)
            <a href="{{url("libros/user/{$libro->id}/toggle_favorite")}}" class="btn btn-warning btn-sm">Desmarcar favorito</a>
          @else
            <a href="{{url("libros/user/{$libro->id}/toggle_favorite")}}" class="btn btn-secondary btn-sm">Marcar favorito</a>
          @endif
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
              {{-- Portada --}}
              @if (!($libro-> portada  == 'noFile'))
                <img style="width:100%; border-radius: 2%;" src="{{url($libro -> portada)}}">
              @endif 
            </div>
            <div class="col-md-4">
              {{-- Generos --}}
              <div class="row" style="padding: 10px">
                @foreach($libro->generos as $genero)
                <div class="p-2">
                  <div class="genero-libro" 
                        style="border-radius: 10px;
                              border: 1px solid #E50914;
                              background-color: #ca1d2642;
                              padding: 5px;"> 
                    {{$genero->nombre}}
                  </div>
                </div>
                @endforeach
              </div>

              
              <div>
              Calificacion promedio {{number_format($libro->calificaciones()->avg('puntaje'), 2, ',', '.')}}
              </div>

              {{-- LEER (solo si tiene capitulos) --}}
              @if($libro->capitulos()->count())
              <a class="btn btn-lg btn-block" style="color: black; background-color: #E50914"
                    @if ($libro->capitulos()->count()==1)
                      {{-- si tiene capitulos uno solo muestra directamente el pdf (elemento 0 del array)) --}}
                      href="{{route('capitulo.reader', ['libro_id'=>$libro->id, 'id'=>$libro->capitulos[0] ])}}"
                    @else
                      {{-- si tiene mas muestra la lista de capitulos --}}
                      href="{{route('libro.capitulos', $libro->id)}}"
                    @endif>
                Leer
              </a>
              @endif

              @if($leido && $calificacion)
                Lo puntuaste con {{$calificacion->puntaje}}
              @elseif($leido)
                <a class="btn btn-warning btn-block" href="#" onclick="calificarLibro()">
                    Calificar libro
                </a>
              @endif

              {{-- Trailer (solo si tiene) --}}
              @if($libro->trailer)
                <a class="btn btn-dark btn-block"
                    href="{{route('trailers.showTrailerUserLibro', $libro-> trailer)}}">
                    Trailer
                </a>
              @endif
              {{-- Más información --}}
              <button class="btn btn-info btn-block" type="button" data-toggle="collapse" data-target="#collapseExample">
                Más información
                <svg class="bi bi-chevron-down" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                </svg>
              </button>
              <div class="collapse" id="collapseExample">
                <!-- mas informacion: colapso -->
                <div class="card-body">
                  <h6>Autor: {{$libro -> autor -> nombre}} </h6>
                  <h6>Editorial: {{$libro -> editorial -> nombre}} </h6>
                  <h6>ISBN: {{$libro -> isbn}} </h6>
                  <h6>Lanzamiento: {{$libro -> fecha_de_lanzamiento->format("d/m/Y")}} </h6>
                  <h6>Vencimiento:{{$libro -> fecha_de_vencimiento->format("d/m/Y")}} </h6>
                </div>
                <!-- end div del colapso -->    
              </div>
            </div>
          </div>
          <hr>
          @if($comentarioPerfil)
          MI COMENTARIO
          <div class="">
              <div>{{$comentarioPerfil->cuerpo}}</div>
              <hr>
              <form action="{{url("libros/{$libro->id}/comentarios/{$comentarioPerfil->id}")}}" method="POST"
              onclick="return confirm('Estas seguro que queres eliminar el comentario?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger">Eliminar</button>
              </form>
          </div>
          @else
          <div>
            <form action="{{url("libros/{$libro->id}/comentarios")}}" method="POST">
              @csrf
              <textarea class="form-control" name="cuerpo"></textarea>
              <button class="btn btn-primary">Comentar</button>
            </form>
          </div>
          @endif

          <!--
          <button class="btn btn-info btn-block" type="button" data-toggle="collapse" data-target="#collapseExample">
                Ver comentarios
                <svg class="bi bi-chevron-down" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                </svg>
          </button>
          <div class="collapse" id="collapseExample">
                
                <div class="card-body">
                    @foreach($comentarios as $comentario)
                    <div>{{$comentario->cuerpo}}</div>
                    <hr>
                    @endforeach
                </div>
               
              </div> -->
          <div class=""> 
            TODOS LOS COMENTARIOS
            @foreach($comentarios as $comentario)
              <div>{{$comentario->cuerpo}}</div>
              <hr>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--
<form>
  <p class="clasificacion">
    <input id="radio1" type="radio" name="estrellas" value="5">
    <label for="radio1">★</label>
    <input id="radio2" type="radio" name="estrellas" value="4">
    <label for="radio2">★</label>
    <input id="radio3" type="radio" name="estrellas" value="3">
    <label for="radio3">★</label>
    <input id="radio4" type="radio" name="estrellas" value="2">
    <label for="radio4">★</label>
    <input id="radio5" type="radio" name="estrellas" value="1">
    <label for="radio5">★</label>
  </p>
</form>
-->

<script>
$('#collapseExample').collapse('hide');

function calificarLibro() {
  event.preventDefault();

  let r = prompt('Elige un numero de 1 a 5 para calificar al libro')
  if (r === null)
    return false

  else if (!r || r < 1 || r > 5) {
    alert('El numero debe ser entre 1 y 5')
    return false
  }

  location.href = `{{url("libros/{$libro->id}/calificar")}}?value=${r}`

  return false;
}
</script> 
@endsection