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
          <div class="row">{{-- Row Portada y botones--}}
            <div class="col-md-8">{{-- Portada --}}
              @if (!($libro-> portada  == 'noFile'))
                <img style="width:100%; border-radius: 2%;" src="{{url($libro -> portada)}}">
              @endif 
            </div>
            <div class="col-md-4">{{-- Botones--}}
              {{-- Generos --}}
              <div class="row d-flex justify-content-around">
                  @foreach($libro->generos as $genero)
                  <div class="p-2">
                    <div class="genero-libro p-1" 
                          style="border-radius: 10px;
                                border: 1px solid #E50914;
                                background-color: #ca1d2642;
                                padding: 5px;"> 
                      {{$genero->nombre}}
                    </div>
                  </div>
                  @endforeach
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
              {{-- Trailer (solo si tiene) --}}
              @if($libro->trailer)
                <a class="btn btn-dark btn-block"
                    href="{{route('trailers.showTrailerUserLibro', $libro-> trailer)}}">
                    Trailer
                </a>
              @endif
              {{-- Más información --}}
              <button class="btn btn-info btn-block" type="button" data-toggle="collapse" data-target="#collapseInfo">
                Más información
                <svg class="bi bi-chevron-down" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                </svg>
              </button>
              <div class="collapse" id="collapseInfo">
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
              {{-- Calif --}}
              @if($promedioCalificacion)
                <p class="calificacion disable">
                  <input id="radio1_a" type="radio" name="estrellas" value="5"
                    {{round($promedioCalificacion) == 5 ? 'checked' : ''}}>
                  <label for="radio1_a">★</label>

                  <input id="radio2_a" type="radio" name="estrellas" value="4"
                    {{round($promedioCalificacion) == 4 ? 'checked' : ''}}>
                  <label for="radio2_a">★</label>

                  <input id="radio3_a" type="radio" name="estrellas" value="3"
                    {{round($promedioCalificacion) == 3 ? 'checked' : ''}}>
                  <label for="radio3_a">★</label>

                  <input id="radio4_a" type="radio" name="estrellas" value="2"
                    {{round($promedioCalificacion) == 2 ? 'checked' : ''}}>
                  <label for="radio4_a">★</label>

                  <input id="radio5_a" type="radio" name="estrellas" value="1"
                    {{round($promedioCalificacion) == 1 ? 'checked' : ''}}>
                  <label for="radio5_a">★</label>
                </p>
                <div class="container">
                  Calificacion promedio {{number_format($promedioCalificacion, 2, ',', '.')}}
                </div>
              @endif
              @if($leido && !$calificacion)
                <form action="{{url("libros/{$libro->id}/calificar")}}" method="POST">
                  @csrf
                  <p class="calificacion">
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
                  <button class="btn btn-warning btn-block">
                      Calificar libro
                  </button>
                </form>
              @elseif($calificacion)
                <form action="{{url("libros/{$libro->id}/calificar")}}" method="POST">
                  @csrf
                  <p class="calificacion">
                    <input id="radio1" type="radio" name="estrellas" value="5"
                      {{$calificacion->puntaje == 5 ? 'checked' : ''}}>
                    <label for="radio1">★</label>
                    <input id="radio2" type="radio" name="estrellas" value="4"
                      {{$calificacion->puntaje == 4 ? 'checked' : ''}}>
                    <label for="radio2">★</label>
                    <input id="radio3" type="radio" name="estrellas" value="3"
                      {{$calificacion->puntaje == 3 ? 'checked' : ''}}>
                    <label for="radio3">★</label>
                    <input id="radio4" type="radio" name="estrellas" value="2"
                      {{$calificacion->puntaje == 2 ? 'checked' : ''}}>
                    <label for="radio4">★</label>
                    <input id="radio5" type="radio" name="estrellas" value="1"
                      {{$calificacion->puntaje == 1 ? 'checked' : ''}}>
                    <label for="radio5">★</label>
                  </p>
                  <button class="btn btn-warning btn-block">
                      Editar calificacion
                  </button>
                </form>
              @endif

              {{-- Recomendados --}}
              @if($libro->tieneRecomendados())
                <div class="row d-flex justify-content-around mt-5"
                  style="border-radius: 10px;
                  border: 1px solid #E50914;
                  padding: 5px;">
                Recomendados para éste título:
                  @foreach($libro->recomendados() as $libro_recom)
                  <div class="col-lg-4">
                    <a href="{{route('libros.showForUser',$libro_recom)}}">
                      <figure class="figure">
                        <img src="{{url($libro_recom -> portada)}}" class="figure-img img-fluid rounded"
                        alt="La portada de un libro.">
                      </figure>
                    </a>
                  </div>
                  @endforeach
                </div>
              @endif
            </div>{{-- End col Botones--}}
          </div>{{-- End Row Portada y botones--}}
          <hr>
          {{-- Publicar Comentario--}}
          @if($leido && !$comentarioPerfil)
            <div class="mb-4">
              @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
                  {!! implode('', $errors->all('<div>:message</div>')) !!}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif
              <form action="{{url("libros/{$libro->id}/comentarios")}}" method="POST">
                @csrf
                <textarea class="form-control" name="cuerpo"></textarea>
                <div class="d-flex">
                  <div class="custom-control custom-switch">
                    <input name="spoiler" value="1" type="checkbox" class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1">Es spoiler</label>
                  </div>
                  <button class="btn btn-primary ml-2">Comentar</button>
                </div>
              </form>
            </div>
          @elseif($comentarioPerfil)
          <div id="editarComentario" class="mb-4 d-none">
              @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
                  {!! implode('', $errors->all('<div>:message</div>')) !!}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif
              <form action="{{url("libros/{$libro->id}/comentarios")}}" method="POST">
                @csrf
                <textarea class="form-control" name="cuerpo">{{$comentarioPerfil->cuerpo}}</textarea>
                <div class="d-flex">
                  <div class="custom-control custom-switch">
                    <input name="spoiler" value="1" type="checkbox" class="custom-control-input" id="customSwitch1"
                      {{$comentarioPerfil->es_spoiler ? 'checked' : ''}}>
                    <label class="custom-control-label" for="customSwitch1">Es spoiler</label>
                  </div>
                  <button class="btn btn-primary ml-2">Comentar</button>
                </div>
              </form>
            </div>
          @endif
          {{-- Ver Comentarios--}}
          @if($libro->tieneComentarios())
            <div class="row d-flex justify-content-around mt-1">
              <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseComentarios">
                Ver comentarios
                <svg class="bi bi-chevron-down" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                </svg>
              </button>
            </div>
            <div class="collapse" id="collapseComentarios">
              <table class="table table-stripped text-white mt-2">
                <tbody>
                  @foreach($comentarios as $comentario)
                    <tr>
                      <td class="text-nowrap small">
                        {{$comentario->perfil->nombre}} ({{$comentario->perfil->user->name}})<br>
                        {{$comentario->created_at->format('d/m/Y H:i:s')}}
                      </td>
                      <td class="w-100">
                        @if($comentario->es_spoiler && $comentario->perfil_id !== $perfil->id)
                          <button class="btn btn-warning" onclick="verSpoiler({{$comentario->id}})">Este comentario es un spoiler. Ver?</button>
                          <div id="comId{{$comentario->id}}" class="d-none">
                            {{$comentario->cuerpo}}
                          </div>
                        @else
                          {{$comentario->cuerpo}}
                        @endif
                      </td>
                      <td class="text-nowrap">
                        @if($comentario->perfil_id === $perfil->id)
                          <button class="btn btn-warning mr-2" type="button" onclick="editarComentario()">Editar</button>
                          <form class="d-inline" action="{{url("libros/{$libro->id}/comentarios/{$comentario->id}")}}" method="POST"
                            onclick="return confirm('Estas seguro que queres eliminar el comentario?')">
                            @csrf
                            @method('DELETE')
                              <button class="btn btn-danger">Eliminar</button>
                          </form>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </div>{{-- End card body--}}
      </div>
    </div>
  </div>
</div>

<script>
$('#collapseInfo').collapse('hide');
$('#collapseComentarios').collapse('hide');

function verSpoiler(id) {
  document.getElementById(`comId${id}`).classList.remove('d-none')
  event.target.remove()
}

function editarComentario() {
  document.getElementById(`editarComentario`).classList.remove('d-none')
}
</script> 
@endsection