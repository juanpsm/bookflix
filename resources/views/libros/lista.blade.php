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
          @if(count($libros) == 0)
            No existen libros cargados en el sistema.
          @else
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Título</th>
                  <th scope="col">Autor</th>
                  <th scope="col">Editorial</th>
                  <th scope="col">Generos</th>
                  <th scope="col">Portada</th>
                  <th scope="col">Acción</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($libros as $item)
                <tr>
                  {{-- ID --}}
                  <th scope="row">
                    @if($item->deleted_at)
                      <svg class="bi bi-x-circle-fill text-danger " 
                            width="1em" height="1em" viewBox="0 0 16 16" 
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z"/>
                      </svg>
                    @endif  
                    {{ $item->id }}  
                  </th>
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
                  {{--Portada--}}
                  <td>
                    @if ($item ->portada != 'noFile')
                        <img style="height: 70px; border-radius: 10%;" src="{{url($item ->portada)}}">
                      @else
                        {{$item->portada}}
                      @endif
                    </td>
                  {{-- Acciones --}}
                  <td>
                    {{-- Edit --}}
                    <a href="{{route('libros.edit', $item)}}" class="btn btn-primary btn-sm">
                      editar
                    </a>
                    {{-- Delete --}}
                    @if($item->deleted_at)
                    <form action="{{url("libros/{$item->id}/restore")}}" class="d-inline" method="POST"
                    >
                        
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm">
                        restaurar
                        </button>
                    </form>
                    @else

                    <form action="{{route('libros.destroy', $item)}}" class="d-inline" method="POST"
                    @if($item->inUse())
                        onclick="return confirm('Este libro ya fue usado en las preferencias de un usuario. Esta seguro que quiere eliminarlo?')"
                    @else
                        onclick="return confirm('Estas seguro que queres eliminar el libro?')"
                    @endif
                    >
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">
                          eliminar
                        </button>
                    </form>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection