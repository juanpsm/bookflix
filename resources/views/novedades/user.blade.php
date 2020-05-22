@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Lista de Novedades: </span>
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
              <th scope="col">Descripción</th>
              <th scope="col">Archivo</th>
              <th scope="col">Publicación</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($novedades as $item)
              <tr>
                {{-- Titulo y link --}}
                <td>
                  <a href="{{route('novedades.show',$item)}}"> {{--Tengo que pasar como parametro el item --}}
                      {{ $item->titulo }}
                  </a>
                </td>
                {{-- Cuerpo --}}
                <td>{{ $item->descripcion }}</td>
                {{--aca deberia mostrar imagen/video--}}
                <td>
                @if ($item -> es_video)
                  <video style="height: 70px; border-radius: 10%;" src="{{url($item -> archivo)}}"></video>
                @else
                  @if ($item -> archivo != 'noFile')
                    <img style="height: 70px; border-radius: 10%;" src="{{url($item -> archivo)}}"> <!--aca deberia mostrar archivo-->
                  @else
                    {{$item->archivo}}
                  @endif
                @endif
                </td>
                {{-- Publicación --}}
                <td>{{$item->fecha_de_publicacion}}</td>
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