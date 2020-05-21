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
          <form method="POST" action="{{ route('libros.update', $libro->id) }}">{{--mando el id del libro para editarlo--}}
            @method('PUT') {{--HTML no permite el PUT, lo paso por adentro--}}
            @csrf

            <input
              required
              type="text"
              name="titulo"
              placeholder="Ingrese titulo de libro"
              class="form-control mb-2"
              value="{{$libro->titulo }}" 
            /> 

            <!--
            <input
              type="text"
              name="autor"
              placeholder="Ingrese nombre de autor"
              class="form-control mb-2"
              value="{{$libro->autor }}" 
            /> -->
            
            <div class= "row">
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
            </div>


            
            Fecha de lanzamiento:
            <input
              required
              type="date"
              name="fecha_de_lanzamiento"
              placeholder="Ingrese fecha de lanzamiento"
              class="form-control mb-2"
              value="{{$libro->fecha_de_lanzamiento}}" 
            /> 

            Fecha de vencimiento:  
            <input
              required
              type="date"
              name="fecha_de_vencimiento"
              placeholder="Ingrese fecha de vencimiento"
              class="form-control mb-2"
              value="{{$libro->fecha_de_vencimiento}}" 
            /> 

            <div class="text-right"> 
              <a href="{{route('libros.index')}}" class="btn btn-secondary btn-sm">
                Cancelar
              </a>
              <button class="btn btn-primary btn-sm" type="submit">
                Editar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection