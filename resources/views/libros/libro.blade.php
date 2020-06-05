@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="mr-auto">{{$libro -> titulo}}</span>
          @if($isFavorite)
            <a href="{{url("libros/user/{$libro->id}/toggle_favorite")}}" class="btn btn-warning btn-sm">Desmarcar favorito</a>
          @else
            <a href="{{url("libros/user/{$libro->id}/toggle_favorite")}}" class="btn btn-secondary btn-sm">Marcar favorito</a>
          @endif
        </div>
        <div class="card-body">
        <h4>Autor: {{$libro -> autor -> nombre}} </h4>
        <h4>Editorial: {{$libro -> editorial -> nombre}} </h4>
        <h4>Generos: </h4>
        @foreach($libro->generos as $genero)
            <div> {{$genero->nombre}}
            </div>
        @endforeach
        <h4>Portada:</h4>
        @if (!($libro-> portada  == 'noFile'))
          <img style="width:100%" src="{{url($libro -> portada)}}">
        @endif  
        </div>
      </div>
    </div>
  </div>
</div>
@endsection