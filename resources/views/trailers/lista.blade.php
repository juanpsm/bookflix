@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Lista de Tráilers: </span>
          {{-- Agregar --}}
          <a href="{{route('trailers.create')}}" class="btn btn-primary btn-sm btn-icon">
            Agregar Tráiler
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
              
              <th scope="col">Título</th>
              <th scope="col">Pdf</th>
              <th scope="col">Acción</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($trailers as $item)
              <tr>
                
                <td>
                  <a href="{{route('trailers.show',$item)}}"> {{--Tengo que pasar como parametro el item --}}
                      {{ $item->titulo }}
                  </a>
                </td>
                {{-- no se si es correcto poner la etiqueta "a",cuando era una imagen usaba <image..> pero creo que
                    no existe la etiqueta pdf--}} 
                
                     @if ($item -> es_pdf)
                         <a style="height: 70px; border-radius: 10%;" src="{{url($item -> pdf)}}"></a>
               
                     @endif
                
                
   
                {{-- Acciones --}}
                <td>
                  {{-- Edit --}}
                  <a href="{{route('trailers.edit', $item)}}" class="btn btn-primary btn-sm">
                    Editar Tráiler
                  </a>
                  {{-- Delete --}}
                  <form action="{{route('trailers.destroy', $item)}}" class="d-inline" method="POST"
                  onclick="return confirm('Estas seguro que queres eliminar el Tráiler?')">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-danger btn-sm">
                        Eliminar Tráiler
                      </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{$trailers->links()}}
        {{-- fin card body --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection