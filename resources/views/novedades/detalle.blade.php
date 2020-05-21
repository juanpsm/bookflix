@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Detalle de Novedad</span>
          <a href="{{route('novedades.index')}}" class="btn btn-primary btn-sm">Volver</a>
        </div>
        <div class="card-body">
        <h4>#id: {{$novedad -> id}} </h4>
        <h4>Título: {{$novedad -> titulo}} </h4>
        <h4>Descripción: {{$novedad -> descripcion}} </h4>
        <h4>Publicación: {{$novedad -> fecha_de_publicacion}} </h4>
        @if ($novedad -> es_video)
          <video  src="{{url($novedad -> archivo)}}" controls></video>
        @else
          @if (!($novedad->archivo == 'noFile'))
            <img style="width:100%" src="{{url($novedad -> archivo)}}"> <!--aca deberia mostrar archivo-->
          @endif
        @endif

        </div>
      </div>
    </div>
  </div>
</div>
@endsection