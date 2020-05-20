@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Agregar Novedad</span>
        </div>
        <div class="card-body">
          {{--Errores--}}
          @error('titulo') 
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              El título es obligatorio
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @enderror

          @error('descripcion')
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  La descripción es obligatoria
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
          <form method="POST" action="{{route('novedades.store')}}" enctype="multipart/form-data">
            @csrf

            <input
              type="text"
              name="titulo"
              placeholder="Ingrese el título"
              class="form-control mb-2"
              value="{{old('titulo')}}" 
            />
            <!--aca esta el textarea agregado: borre tanto el placeholder como el value y sigue
            apareciendo los espacios,no se bien en que parte esta el "error"-->
            <textarea
              type="text"
              name="descripcion"
              class="form-control mb-2"
              value="{{old('descripcion')}}"
              placeholder="Ingrese la descripción" >
            </textarea>
            <!-- este es el input del archivo (imagen/video):-->
            <input 
             type="file" 
             name="archivo" 
             accept="image/png, .jpeg, .jpg, image/gif" 
             class="form-group"
            >

            
             <!--- esto es la estructura de la novedad programada
              pero no sube a la hora que indico.
              este html comentado muestra un input para ingresas fecha y hora de publicacion
              <input
                type="date"
                class="form-control"
                name="scheduled_date" 
                value="{{old('scheduled_date',date('d/m/Y'))}}"> 
                <br>
                <input
                  type="time"
                  class="form-group"
                  name="scheduled_time" 
                  value="{{old('scheduled_time',date('H:i'))}}">-->
            <div class="text-right"> 
              <a href="{{route('novedades.index')}}" class="btn btn-secondary btn-sm">
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