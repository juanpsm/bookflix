@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Agregar capitulo para libro: {{$libro -> titulo}}</span>
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
          <form method="POST" action="{{route('capitulos.store', $libro->id)}}" enctype="multipart/form-data">
            @csrf

            <input
              type="text"
              name="titulo"
              placeholder="Ingrese el título"
              class="form-control mb-2"
              value="{{old('titulo')}}"
            />

            Fecha de lanzamiento: (posterior a la del libro que es 
              <b>{{$libro -> fecha_de_lanzamiento->isoFormat("DD \d\\e MMMM \d\\e YYYY")}}</b>)
            <input
              required
              type="date"
              name="fecha_de_lanzamiento"
              placeholder="Ingrese fecha de lanzamiento"
              class="form-control mb-2"
              value="{{old('fecha_de_lanzamiento')}}" 
            />

            Fecha de vencimiento: (posterior a la del libro que es 
            <b>{{$libro -> fecha_de_vencimiento->isoFormat("DD \d\\e MMMM \d\\e YYYY")}}</b>)
            <input
              required
              type="date"
              name="fecha_de_vencimiento"
              placeholder="Ingrese fecha de vencimiento"
              class="form-control mb-2"
              value="{{old('fecha_de_vencimiento')}}" 
            />

            <!-- este es el input del pdf:-->
            <div>Archivo PDF:</div>
            <input 
              type="file" 
              name="pdf" 
              accept="application/pdf,application/vnd.ms-excel" 
              class="form-group"
            >

            <div class="text-right"> 
              <a href="{{ route('libros.show', $libro -> id) }}" class="btn btn-secondary btn-sm">
                Cancelar
              </a>
              <button class="btn btn-primary btn-sm" type="submit">
                Agregar Capitulo
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection