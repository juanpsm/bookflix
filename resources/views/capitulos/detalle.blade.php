@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Detalle de Capitulo</span>
          <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Volver</a>
        </div>
        <div class="card-body">
          <h4>Título: {{$capitulo -> titulo}} </h4>
          <!--no se si se deberia mostrar asi el pdf-->
          <a href="{{route('capitulos.showCapituloAdmin',$capitulo)}}">
            <img style="height: 600px; border-radius: 10%;"
              data-pdf-thumbnail-file="{{url($capitulo -> pdf)}}" 
              src="js\pdfThumbnails\pdf.png">
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection