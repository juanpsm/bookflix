@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Lista de Capitulos: </span>
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
              @foreach ($capitulos as $item)
              <tr>
                <td>
                  <a href="{{route('capitulos.show',$item)}}"> {{--Tengo que pasar como parametro el item --}}
                      {{ $item->titulo }}
                  </a>
                </td>
                {{-- no se si es correcto poner la etiqueta "a",cuando era una imagen usaba <image..> pero creo que
                    no existe la etiqueta pdf
                <img style="height: 70px; border-radius: 10%;" src="{{url($item -> pdf)}}">
                <iframe src="{{url($item -> pdf)}}#toolbar=0&navpanes=0&scrollbar=0" width="50" height="100"></iframe>
                --}}
                <td>
                  <a href="{{route('capitulos.show',$item)}}">
                    <img style="height: 150px; border-radius: 10%;"
                      data-pdf-thumbnail-file="{{url($item -> pdf)}}" 
                      src="js\pdfThumbnails\pdf.png">
                  </a>
                </td>

                {{-- Acciones --}}
                <td>
                  {{-- Edit --}}
                  <a href="{{route('capitulos.edit', $item)}}" class="btn btn-primary btn-sm">
                    editar
                  </a>
                  {{-- Delete --}}
                  <form action="{{route('capitulos.destroy', $item)}}" class="d-inline" method="POST"
                  onclick="return confirm('Estas seguro que queres eliminar el Tráiler?')">
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
          {{$capitulos->links()}}
        {{-- fin card body --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection