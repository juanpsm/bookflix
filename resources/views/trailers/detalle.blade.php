@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Detalle de Trailer</span>
          <a href="{{route('trailers.index')}}" class="btn btn-primary btn-sm">Volver</a>
        </div>
        <div class="card-body">
           <h4>Título: {{$trailer -> titulo}} </h4>
           <!--no se si se deberia mostrar asi el pdf-->
           @if ($item -> es_pdf)
                  <a style="height: 70px; border-radius: 10%;" src="{{url($item -> pdf)}}"></a>
               
             @endif
        

        </div>
      </div>
    </div>
  </div>
</div>
@endsection