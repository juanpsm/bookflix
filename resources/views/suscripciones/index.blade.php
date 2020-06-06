@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>La cuenta esta inactiva. Por favor elige un tipo de suscripcion para continuar</span>
        </div>
        <div class="card-body"> 
            <form action="{{url('elegirSuscripcion')}}" method="POST">
                @csrf
                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="estandar" name="tipoCuenta" type="radio" class="custom-control-input" checked 
                            value="estandar" required>
                        <label class="custom-control-label" for="estandar">Estandar</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="premium" name="tipoCuenta" type="radio" class="custom-control-input" 
                            value="premium" required>
                        <label class="custom-control-label" for="premium">Premium</label>
                    </div>
                </div>
                <hr class="mb-4">
                <div class="d-flex">
                    <button class="btn btn-secondary btn-lg btn-block mr-1" type="button"
                        onclick="$('#logout').submit()">Cancelar</button>
                    <button class="btn btn-primary btn-lg btn-block ml-1 mt-0" type="submit">Continuar</button>
                </div>
            </form>
            <form id="logout" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection