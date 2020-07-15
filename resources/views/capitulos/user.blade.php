@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card bg-dark">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="mr-auto">
            <a href="{{route("libros.showForUser", $libro)}}">
              {{$libro -> titulo}}
            </a>
            @if($leido)
            <svg class="bi bi-check-all text-primary" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M8.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14l.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z"/>
            </svg>
            @endif
        </span>
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
          
          <table class="table table-dark table-striped table-hover">
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
                  {{ $item->titulo }}
                  @if($perfil->capitulosLeidos()->where('id', $item->id)->exists())
                  <svg class="bi bi-check-all text-primary" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14l.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z"/>
                  </svg>
                  @endif
                </td>
                <td>
                  <img style="height: 150px; border-radius: 10%;"
                      data-pdf-thumbnail-file="{{url($item -> pdf)}}" 
                      src="js\pdfThumbnails\pdf.png">
                </td>

                {{-- Acciones --}}
                <td>
                  {{-- Leer --}}
                  <a href="{{route('capitulo.reader', ['libro_id'=>$libro->id, 'id'=>$item->id])}}" class="btn btn-primary btn-sm">
                    Leer
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="row d-flex justify-content-center"> 
            {{$capitulos->links()}}
          </div>
        {{-- fin card body --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection