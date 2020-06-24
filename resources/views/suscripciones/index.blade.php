@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>La cuenta esta inactiva. Por favor elige un tipo de suscripcion para continuar</span>
        </div>
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif
        <div class="card-body"> 
            <form id="suscripcionForm" action="{{url('elegirSuscripcion')}}" method="POST">
                <div class="row">
                    <div class="col">
                        @csrf
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
                        <div class="text-danger">
                        Nota: si previamente contaba con una suscripcion premium con mas de 2 perfiles,
                        y ahora selecciona una suscripcion estandar, los perfiles seran eliminados
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card-wrapper mb-2"></div>
                        <div class="form-group">
                            <label class="form-label">Numero de tarjeta</label>
                            <input class="form-control" name="card-number" placeholder="Numero de tarjeta" required
                                value="{{old('card-number')}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nombre completo</label>
                            <input class="form-control" name="card-name" placeholder="Nombre completo" required 
                                value="{{old('card-name')}}">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Expira</label>
                                    <input class="form-control" name="card-expiry" placeholder="Expira" required
                                        maxlength="7" value="{{old('card-expiry')}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">CVC</label>
                                    <input class="form-control" name="card-cvc" placeholder="CVC" required 
                                        minlength="3" value="{{old('card-cvc')}}">
                                </div>
                            </div>
                        </div>
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
<script>
var card = new Card({
    form: '#suscripcionForm',
    container: '.card-wrapper',
    formSelectors: {
        nameInput: 'input[name="card-name"]',
        numberInput: 'input[name="card-number"]',
        expiryInput: 'input[name="card-expiry"]',
        cvcInput: 'input[name="card-cvc"]',
    },
    messages: {
        validDate: 'valida\ndesde', // optional - default 'valid\nthru'
        monthYear: 'mm/yy', // optional - default 'month/year'
    },
    placeholders: {
        name: 'Nombre Completo',
    },
});

$('input[name=card-number]')[0].dispatchEvent(new Event('keyup'));
$('input[name=card-name]')[0].dispatchEvent(new Event('change'));
$('input[name=card-expiry]')[0].dispatchEvent(new Event('change'));
$('input[name=card-cvc]')[0].dispatchEvent(new Event('change'));
</script>
@endsection