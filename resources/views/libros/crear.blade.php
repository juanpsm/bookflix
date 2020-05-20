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
          @error('titulo') 
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              El titulo es obligatorio
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @enderror

          @error('autor') 
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              El autor es obligatorio
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @enderror

          

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
            <select name="generos[]" multiple>
              @foreach(\App\Genero::all() as $genero)
              <option value="{{$genero->id}}">{{$genero->nombre}}</option>
              @endforeach

            </select> 

            <select name="autor">
              @foreach(\App\Autor::all() as $autor)
              <option value="{{$autor->id}}">{{$autor->nombre}}</option>
              @endforeach

            </select> 

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