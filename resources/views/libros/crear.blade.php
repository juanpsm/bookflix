@extends('layouts.app')

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

            <input
              type="text"
              name="autor"
              placeholder="Ingrese autor"
              class="form-control mb-2"
              value="{{old('autor')}}" 
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