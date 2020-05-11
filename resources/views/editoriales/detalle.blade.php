@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Detalle de Editorial</span>
          <a href="{{route('editoriales.index')}}" class="btn btn-primary btn-sm">Volver</a>
        </div>
        <div class="card-body">
        <h4>#id: {{$editorial -> id}} </h4>
        <h4>Nombre: {{$editorial -> nombre}} </h4>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection