@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Detalle de Tarjeta</span>
          <a href="{{route('tarjetas.index')}}" class="btn btn-primary btn-sm">Volver</a>
        </div>
        <div class="card-body">
        <h4>#id: {{$tarjeta -> id}} </h4>
        <h4>Titular: {{$tarjeta -> name_on_card}} </h4>
        <h4>Número: {{$tarjeta -> card_number}} </h4>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection