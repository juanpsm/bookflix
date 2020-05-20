@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Agregar editorial</span>
        </div>
        <div class="card-body">
          {{--Errores--}}
          @error('nombre') 
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              El nombre es obligatorio
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
          <form method="POST" action="{{route('editoriales.store')}}">
            @csrf

            <input
              type="text"
              name="nombre"
              placeholder="Ingrese nombre"
              class="form-control mb-2"
              value="{{old('nombre')}}" 
            />
           
            <div class="text-right"> 
              <a href="{{route('editoriales.index')}}" class="btn btn-secondary btn-sm">
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