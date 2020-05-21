@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Agregar libro</span>
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
          <form method="POST" action="{{route('libros.store')}}">
            @csrf

            <input
              required
              type="text"
              name="titulo"
              placeholder="Ingrese titulo"
              class="form-control mb-2"
              value="{{old('titulo')}}" 
            />
            <!-- esto ya no es mas un simple string, ahora va ser una lista desplegable
            <input
              type="text"
              name="autor"
              placeholder="Ingrese autor"
              class="form-control mb-2"
              value="{{old('autor')}}" 
            /> -->
           
            <!-- lo que esta haciendo es traer todos los generos y loopear donde $genero
            va a tomar el valor de los distintos generos uno x uno y va a imprimir el html
            que esta entre foreach y endforeach--> 
            <div class= "row">
              <div class= "col-lg-4">
                Géneros:<br>
                <select class= "form-control" name="generos[]" multiple>
                @foreach(\App\Genero::all() as $genero)
                <option value="{{$genero->id}}">{{$genero->nombre}}</option>
                @endforeach
                </select> 
              </div>
              <div class= "col-lg-4">
                Autor:<br>
                <select class= "form-control" name="autor" >
                @foreach(\App\Autor::all() as $autor)
                <option value="{{$autor->id}}">{{$autor->nombre}}</option>
                @endforeach

              </select> 
              </div>
              <div class= "col-lg-4">
                Editorial:<br>
                <select class= "form-control" name="editorial">
                  @foreach(\App\Editorial::all() as $editorial)
                  <option value="{{$autor->id}}">{{$editorial->nombre}}</option>
                  @endforeach

                </select> 
              </div>
            </div>

            
           
            <input
              required
              type="text"
              name="isbn"
              placeholder="Ingrese ISBN"
              class="form-control mb-2"
              value="{{old('isbn')}}" 
            />

            Fecha de lanzamiento:
            <input
              required
              type="date"
              name="fecha_de_lanzamiento"
              placeholder="Ingrese fecha de lanzamiento"
              class="form-control mb-2"
              value="{{old('fecha_de_lanzamiento')}}" 
            />

            Fecha de vencimiento:
            <input
              required
              type="date"
              name="fecha_de_vencimiento"
              placeholder="Ingrese fecha de vencimiento"
              class="form-control mb-2"
              value="{{old('fecha_de_vencimiento')}}" 
            />

            <div class="text-right"> 
              <a href="{{route('libros.index')}}" class="btn btn-secondary btn-sm">
                Cancelar
              </a>
              <button class="btn btn-primary btn-sm" type="submit">
              Agregar
            </button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection