@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Detalle de Libro</span>
          <a href="{{route('libros.index')}}" class="btn btn-primary btn-sm">Volver</a>
        </div>
        <div class="card-body">
        <h4>#id: {{$libro -> id}} </h4>
        <h4>Titulo: {{$libro -> titulo}} </h4>
        <h4>Autor: {{$libro -> autor}} </h4>
        <h4>Generos: </h4>
        @foreach($libro->generos as $genero)
            <div> {{$genero->nombre}}
            </div>
        @endforeach    
        </div>
      </div>
    </div>
  </div>
</div>
@endsection