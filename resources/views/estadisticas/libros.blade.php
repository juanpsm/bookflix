@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">{{--d-flex justify-content-between align-items-center--}}
          <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
              <span>Libros más leídos:</span>
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

          @if(count($libros) == 0)
            Todavía no se han registrado libros en el sitio.
          @else
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Título</th>
                  <th scope="col">Lectores</th>
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
                  {{-- Titulo --}}
                  <td>
                    <a href="{{route('libros.show',$item)}}"> {{--Tengo que pasar como parametro el item --}}
                      {{ $item->titulo }}
                    </a>
                  </td>
                  {{-- Lectores --}}
                  <td>
                    {{$item->cantLectores()}}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="row d-flex justify-content-center"> 
              {{$libros->links()}}
            </div>
          @endif
        {{-- fin card body --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection