@extends('layouts.auth') {{-- no se si deberia usar la misma que los users (app.blade.php) o otra, por ej "auth.blade.php" --}}

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Dashboard</div>

          <div class="card-body">
            {{--Exito--}}
            @if ( session('mensaje') )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{session('mensaje')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>
            @endif

            Estadísticas del sitio:
              <a href="{{route('estadisticas.users')}}"  class="btn btn-primary">
                Registro de usuarios
              </a>
              <a href="{{route('estadisticas.libros')}}"  class="btn btn-primary">
                Libros Mas Leídos
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection