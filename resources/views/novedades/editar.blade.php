@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Editar Novedad: {{ $novedad->id }}</span>
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

          @error('descripcion')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              La descripcion es obligatoria
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
          <form method="POST" action="{{ route('novedades.update', $novedad->id) }}" 
            enctype="multipart/form-data" >{{--mando el id de la novedad para editarla--}}
            @method('PUT') {{--HTML no permite el PUT, lo paso por adentro--}}
            @csrf

            <input
              type="text"
              name="titulo"
              placeholder="Ingrese el titulo"
              class="form-control mb-2"
              value="{{$novedad->titulo }}" 
            /> 
            <input
              type="text"
              name="descripcion"
              placeholder="Ingrese descripción"
              class="form-control mb-2"
              value="{{ $novedad->descripcion }}"
            />
            <input 
              type="file" 
              name="archivo" 
              accept=".pdf,.jpg,.png" multiple
            >
            <div class="text-right"> 
              <a href="{{route('novedades.index')}}" class="btn btn-secondary btn-sm">
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