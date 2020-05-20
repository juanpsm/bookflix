@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Lista de Editoriales:</span>
          {{-- Agregar --}}
          <a href="{{route('editoriales.create')}}" class="btn btn-primary btn-sm btn-icon">
            Agregar Editorial
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
              <th scope="col">Nombre </th>
              <th scope="col">Acción</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($editoriales as $item)
              <tr>
                {{-- ID --}}
                <th scope="row">{{ $item->id }}</th>
                {{-- Titulo y link --}}
                <td>
                  <a href="{{route('editoriales.show',$item)}}"> {{--Tengo que pasar como parametro el item --}}
                      {{ $item->nombre }}
                  </a>
                </td>
               
                {{-- Acciones --}}
                <td>
                  {{-- Edit --}}
                  <a href="{{route('editoriales.edit', $item)}}" class="btn btn-primary btn-sm">
                    editar
                  </a>
                  {{-- Delete --}}
                  <form action="{{route('editoriales.destroy', $item)}}" class="d-inline" method="POST">
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
          {{$editoriales->links()}}
        {{-- fin card body --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection