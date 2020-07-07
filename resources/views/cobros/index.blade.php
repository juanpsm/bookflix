@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center"> Listado de Cobros</div>
        <div class="card-body"> 
            @if(empty($ok) && empty($err))
            Aqui se mostraran los cobros exitosos y fallidos
            @else
            <div class="row">
                <div class="col">
                    <h3>Exitosos</h3>
                    @foreach($ok as $item)
                    <div>{!!$item!!}</div>
                    <hr>
                    @endforeach
                </div>
                <div class="col">
                    <h3>Fallidos (se deshabilitaron las cuentas)</h3>
                    @foreach($err as $item)
                    <div>{!!$item!!}</div>
                    <hr>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection