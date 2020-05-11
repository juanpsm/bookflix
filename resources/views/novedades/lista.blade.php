@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Lista de Novedades: </span>
          {{-- Agregar --}}
          <a href="{{route('novedades.create')}}" class="btn btn-primary btn-sm btn-icon">
            Agregar Novedad
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
          
          <table class="table table-striped table-hover">
            <thead>
              <tr>
              <th scope="col">#</th>
              <th scope="col">Título</th>
              <th scope="col">Descripción</th>
              <th scope="col">Acción</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($novedades as $item)
              <tr>
                {{-- ID --}}
                <th scope="row">{{ $item->id }}</th>
                {{-- Titulo y link --}}
                <td>
                  <a href="{{route('novedades.show',$item)}}"> {{--Tengo que pasar como parametro el item --}}
                      {{ $item->titulo }}
                  </a>
                </td>
                {{-- Cuerpo --}}
                <td>{{ $item->descripcion }}</td>
                
                {{-- Acciones --}}
                <td>
                  {{-- Edit --}}
                  <a href="{{route('novedades.edit', $item)}}" class="btn btn-primary btn-sm">
                    editar
                  </a>
                  {{-- Delete --}}
                  <form action="{{route('novedades.destroy', $item)}}" class="d-inline" method="POST">
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
          {{$novedades->links()}}
        {{-- fin card body --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection