@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card bg-dark">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Lista de Tráilers: </span>
        </div>
        <div class="card-body"> 

          @if ($trailers -> isEmpty())
            {{--otra forma es $novedades -> total() == 0 --}}
            No hay tráilers que mostrar por el momento.
          @else
          <table class="table table-dark table-striped table-hover">
            <thead>
              <tr>
              <th scope="col">Título</th>
              <th scope="col">Libro</th>
              <th scope="col">Pdf</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($trailers as $item)
              <tr>
                {{-- Titulo y link --}}
                <td>
                  {{ $item -> titulo }}
                </td>
                {{-- Libro --}}
                <td>
                  @if ($item -> libro)
                    <a href="{{route("libros.showForUser", $item)}}">
                      {{$item -> libro -> titulo}}
                    </a>
                  @else
                    no asignado
                  @endif
                </td>
                {{-- PDF --}}
                <td>
                  <a href="{{route('trailers.showTrailerUser',$item)}}">
                  <img style="height: 150px; border-radius: 10%;"
                      data-pdf-thumbnail-file="{{url($item -> pdf)}}" 
                      src="js\pdfThumbnails\pdf.png">
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{$trailers->links()}}
        {{-- fin card body --}}
        @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection