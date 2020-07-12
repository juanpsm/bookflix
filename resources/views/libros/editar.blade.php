@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Editar Libro: {{ $libro->id }}</span>
        </div>
        <div class="card-body">
          {{--Errores--}}
          @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {!! implode('', $errors->all('<div>:message</div>')) !!}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          {{--Exito--}}
          @if ( session('mensaje') )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{session('mensaje')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          {{-- Formulario --}}
          <form method="POST" action="{{ route('libros.update', $libro->id) }}"
            enctype="multipart/form-data" >{{--mando el id del libro para editarlo--}}
            @method('PUT') {{--HTML no permite el PUT, lo paso por adentro--}}
            @csrf

            <div class= "row">
              <div class= "col-lg-6">
                <input
                  required
                  type="text"
                  name="titulo"
                  placeholder="Ingrese nuevo título"
                  class="form-control mb-2"
                  value="{{$libro->titulo }}" 
                />
              </div>
              <div class= "col-lg-6">
                <div class= "col-lg-6">
                  <input
                    required
                    type="text"
                    name="isbn"
                    placeholder="Ingrese ISBN"
                    class="form-control mb-2"
                    value="{{$libro->isbn}}" 
                  />
                </div>
              </div>
            </div>
            <div class= "row">
              <div class= "col-lg-4">
                Autor:<br>
                <select class= "form-control" name="autor" >
                  @foreach($autores as $autor)
                    <option value="{{$autor->id}}"
                      @if($autor->selected)
                        selected
                      @endif
                      >{{$autor->nombre}}</option>
                  @endforeach
                </select> 
              </div>
              <div class= "col-lg-4">
                Editorial:<br>
                <select class= "form-control" name="editorial">
                  @foreach($editoriales as $editorial)
                    <option value="{{$editorial->id}}"
                      @if($editorial->selected)
                        selected
                      @endif
                      >{{$editorial->nombre}}</option>
                  @endforeach
                </select> 
              </div>
              <div class= "col-lg-4">
                Géneros:<br>
                <select class= "form-control" name="generos[]" multiple>
                  @foreach($generos as $genero)
                    <option value="{{$genero->id}}"
                      @if($genero->selected)
                        selected
                      @endif
                      >{{$genero->nombre}}</option>
                  @endforeach
                </select> 
              </div>
            </div>
            <div class= "row">
              <div class= "col-lg-7">
                <div class= "row">
                  <div class= "col-lg-6">
                    Fecha de lanzamiento:
                    <input
                      required
                      type="date"
                      name="fecha_de_lanzamiento"
                      placeholder="Ingrese fecha de lanzamiento"
                      class="form-control mb-2"
                      value="{{$libro->fecha_de_lanzamiento->toDateString()}}" 
                    />
                  </div>
                  <div class= "col-lg-6">
                    Fecha de vencimiento:  
                    <input
                      required
                      type="date"
                      name="fecha_de_vencimiento"
                      placeholder="Ingrese fecha de vencimiento"
                      class="form-control mb-2"
                      value="{{$libro->fecha_de_vencimiento->toDateString()}}" 
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class= "row">
              <div class= "col-lg-8">
                Portada:
                <div class= "row justify-content-center">
                  <div class= "col-lg-3">
                    Actual:
                      @if ($libro ->portada != 'noFile')
                        <img style="height: 100px; border-radius: 10%;" src="{{url($libro ->portada)}}">
                      @else
                        {{$libro->portada}}
                      @endif
                  </div>
                  <div class= "col-lg-9">
                    Cambiar
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input"
                          name="portada" 
                          accept="image/png, .jpeg, .jpg, image/gif" >
                        <label class="custom-file-label" for="inputGroupFile04">
                          imagen .png .jpeg .jpg .gif</label>
                      </div>
                    </div>
                    <p>
                      (Tamaño máximo: 41 Megabytes)
                    </p>
                    <script type="application/javascript">
                      $('input[type="file"]').change(function(e){
                          var fileName = e.target.files[0].name;
                          $('.custom-file-label').html(fileName);
                      });
                    </script>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-right"> 
              <a href="{{route('libros.index')}}" class="btn btn-secondary btn-sm">
                Cancelar
              </a>
              <button class="btn btn-primary btn-sm" type="submit">
                Guardar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection