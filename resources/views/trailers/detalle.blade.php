@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Detalle de Trailer</span>
          <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Volver</a>
        </div>
        <div class="card-body">
          <h4>Título: {{$trailer -> titulo}} </h4>
          <h4>Libro: 
            @if($trailer->libro)
            <a href="{{route('libros.show', $trailer->libro)}}">
              {{$trailer->libro->titulo}}
            </a>
            @else
              ninguno
            @endif
          </h4>
          <!--no se si se deberia mostrar asi el pdf-->
          <a href="{{route('trailers.showTrailerAdmin',$trailer)}}">
            <img style="height: 600px; border-radius: 10%;"
              data-pdf-thumbnail-file="{{url($trailer -> pdf)}}" 
              src="js\pdfThumbnails\pdf.png">
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection