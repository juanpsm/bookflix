@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      
      <a href= "{{url("libros/user/{$capitulo->libro->id}/marcarLeido")}}" class= "btn btn-primary" >
      Terminar de leer
      </a>
      <embed src="{{url($capitulo -> pdf)}}#toolbar=0&navpanes=0&scrollbar=0" height="500"
      class= "w-100">

    </div>
  </div>
</div>
@endsection