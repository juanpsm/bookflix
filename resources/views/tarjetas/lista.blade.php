@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Lista de Tarjetas para {{auth()->user()->name}}</span>
          {{-- Agregar --}}
          <a href="{{route('tarjetas.create')}}" class="btn btn-primary btn-sm btn-icon">
            Agregar Tarjeta
          </a>
        </div>
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
          @if(count($tarjetas) == 0)
            No existen tarjetas cargadas en el sistema.
          @else
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre Titular</th>
                <th scope="col">Numero</th>
                <th scope="col">Acción</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tarjetas as $item)
                <tr>
                  {{-- ID --}}
                  <th scope="row">{{ $item->id }}</th>
                  {{-- Titulo y link --}}
                  <td>
                    <a href="{{route('tarjetas.show',$item)}}"> {{--Tengo que pasar como parametro el item --}}
                        {{ $item->name_on_card }}
                    </a>
                  </td>
                  {{-- Cuerpo --}}
                  <td>{{ $item->card_number }}</td>
                  <td>Acción</td>
                  {{-- Acciones --}}
                  <td>
                    {{-- Edit --}}
                    <a href="{{route('tarjetas.edit', $item)}}" class="btn btn-primary btn-sm">
                      editar
                    </a>
                    {{-- Delete --}}
                    <form action="{{route('tarjetas.destroy', $item)}}" class="d-inline" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">
                          eliminar
                        </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{$tarjetas->links()}}
            @endif
        {{-- fin card body --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection