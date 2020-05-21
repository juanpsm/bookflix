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

          @error('fecha_de_publicacion')
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Ingresa una fecha y hora válidas
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
            apareciendo los espacios,no se bien en que parte esta el "error"
            No hay que dejar espacios entre <textarea> y </textarea>-->
            <textarea
              type="text"
              name="descripcion"
              class="form-control mb-2"
              placeholder="Ingrese la descripción">{{old('descripcion')}}</textarea>
            
            <p>
              Fecha de publicación<br>
              <input type="datetime-local"
                id='pub'
                name="fecha_de_publicacion" value="{{old('fecha_de_publicacion') ? old('fecha_de_publicacion') : date('Y-m-d\TH:i:s', time())}}"
                min="{{date('Y-m-d\TH:i:s', time())}}" {{--para que no pongan fechas pasadas--}}
                max="2038-01-19T03:14:07" {{--es el máximo que admite SQL--}}
              >
            </p>
            <!-- este es el input del archivo (imagen/video):-->
            <p>
              Archivo: Es opcional y solo se aceptan imagenes .png, .jpeg, .jpg, .gif, o videos .mp4<br>
              <input 
                type="file" 
                name="archivo" 
                accept="image/png, .jpeg, .jpg, image/gif, .mp4" 
                class="form-group"
              >
            </p>
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