@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Lista de Libros:</span>
          {{-- Agregar --}}
          <a href="{{route('libros.create')}}" class="btn btn-primary btn-sm btn-icon">
            Agregar Libro
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
              <th scope="col">Titulo </th>
              <th scope="col">Autor </th>
              <th scope="col">Editorial </th>
              <th scope="col">Generos </th>
              <th scope="col">Acción</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($libros as $item)
              <tr>
                {{-- ID --}}
                <th scope="row">{{ $item->id }}</th>
                {{-- Titulo y link --}}
                <td>
                  <a href="{{route('libros.show',$item)}}"> {{--Tengo que pasar como parametro el item --}}
                      {{ $item->titulo }}
                  </a>
                </td>
                {{-- Autor --}}
                <td>
                  {{ $item->autor->nombre }}
                </td>
                {{-- Editorial --}}
                <td>
                  {{ $item->editorial->nombre }}
                </td>
                {{-- Generos --}}
                <td>
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Generos
                    </a>
                    <div class="dropdown-menu dropdown-menu-left">
                      @foreach($item->generos as $genero)
                        <a class="dropdown-item" href="#">{{ $genero->nombre }}</a>
                      @endforeach
                    </div>
                </td>
                {{-- Acciones --}}
                <td>
                  {{-- Edit --}}
                  <a href="{{route('libros.edit', $item)}}" class="btn btn-primary btn-sm">
                    editar
                  </a>
                  {{-- Delete --}}
                  <form action="{{route('libros.destroy', $item)}}" class="d-inline" method="POST">
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
          {{$libros->links()}}
        {{-- fin card body --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection