@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">{{--d-flex justify-content-between align-items-center--}}
          <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
              <span>Usuarios registrados:</span>
              {{-- Filtro --}}
              <button class="btn btn-info hide" type="button" data-toggle="collapse" data-target="#collapseForm">
                
                <svg class="bi bi-chevron-down" width="1em" height="1em" viewBox="0 0 16 16" 
                  fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                </svg>
              </button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
              <div class="collapse" id="collapseForm">
                
                <form method="POST" action="{{route('estadisticas.users')}}" enctype="multipart/form-data" 
                class="form-inline row justify-content-end">
                  @csrf
                  <div class="col-md-4">
                    Desde:
                    <input
                      required
                      type="date"
                      name="desde"
                      id="desde"
                      class="form-control mb-2"
                      value="<?php echo $_POST['desde'] ?? ''; ?>" 
                    />
                  </div>
                  <div class="col-md-4">
                    Hasta:
                    <input
                      required
                      type="date"
                      name="hasta"
                      id="hasta"
                      class="form-control mb-2"
                      value="<?php echo $_POST['hasta'] ?? ''; ?>" 
                    />
                  </div>
                  <div class="col-md-4">
                    <button class="btn btn-primary btn-sm" type="submit">
                      Filtrar
                    </button>
                    <a href="{{route('estadisticas.users')}}" class="btn btn-secondary btn-sm">
                      Todos
                    </a>
                  </div>
                </form>
              </div>
              <script>
                $('#collapseForm').collapse();
              </script>
            </div>
          </div>
        </div>
        <div class="card-body">
          {{--Errores--}}
          @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {!! implode('', $errors->all('<div>:message</div>')) !!}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          {{--Exito--}}    
          @if ( session('mensaje') )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{session('mensaje')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
          @endif

          @if($usersTotal == 0)
            No existen usuarios registrados en el sistema.
          @else
            @if(count($users) == 0)
              No existen usuarios registrados entre esas fechas.
            @else
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Email</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Suscripcición</th>
                  <th scope="col">Fecha y Hora de Regristro</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $item)
                  <tr>
                    {{-- ID --}}
                    <th scope="row">{{ $item->id }}</th>
                    {{-- Nombre --}}
                    <td>
                      {{ $item->name }}
                    </td>
                    {{-- Email --}}
                    <td>
                      {{ $item->email }}
                    </td>
                    {{-- Estado --}}
                    <td>
                      @if ($item->cuenta_activa)
                        Activo
                      @else
                        Inactivo
                      @endif
                    </td>
                    {{-- Suscripcion --}}
                    <td>
                      @if ($item->es_premium)
                        Premium
                      @else
                        Estandar
                      @endif
                    </td>
                    {{-- Fecha --}}
                    <td>
                      {{$item->getCreationDate()}}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="row d-flex justify-content-center"> 
                {{$users->links()}}
              </div>
            @endif
          @endif
        {{-- fin card body --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection