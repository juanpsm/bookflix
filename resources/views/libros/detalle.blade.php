@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Libro #{{$libro -> id}}</span>
          <a href="{{route('libros.index')}}" class="btn btn-primary btn-sm">Volver</a>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <span>Portada:</span>
                @if (!($libro-> portada  == 'noFile'))
                  <img style="width:100%" src="{{url($libro -> portada)}}">
                @endif 
            </div>
            <div class="col-md-9">
              <table class="table table-hover table-sm table-striped">
                <tbody>
                  <tr>
                    <td>
                      Título:
                    </td>
                    <td>
                      {{$libro -> titulo}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Autor:
                    </td>
                    <td>
                      {{$libro -> autor -> nombre}} 
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Editorial:
                    </td>
                    <td>
                      {{$libro -> editorial -> nombre}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Generos:
                    </td>
                    <td>
                      <ul>
                        @foreach($libro->generos as $genero)
                        <li class="list-item">
                          {{$genero->nombre}}
                        </li>
                        @endforeach
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Trailer:
                    </td>
                    <td>
                      @if ( is_null($libro -> trailer ))
                      {{--$libro -> trailer -> count() == 0 --}}
                        {{-- Agregar Trailer --}}
                        <a href="{{route('trailers.createWithBook', $libro->id)}}" class="btn btn-primary btn-sm">
                          agregar trailer
                        </a>
                      @else
                      <div class="row">
                        <div class="col-md-6">
                          <a href="{{route('trailers.show',$libro -> trailer)}}">
                            <img style="height: 150px; border-radius: 10%;"
                              data-pdf-thumbnail-file="{{url($libro -> trailer -> pdf)}}" 
                              src="js\pdfThumbnails\pdf.png">
                          </a>
                        </div>
                        <div class="col-md-6">
                          <div class="row">
                            <div class="col-md-1">
                              {{-- Edit --}}
                              <a href="{{route('trailers.edit', $libro -> trailer)}}" class="btn btn-primary btn-sm">
                                editar
                              </a>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-1">
                              {{-- Delete --}}
                              <form action="{{route('trailers.destroy', $libro -> trailer)}}" class="d-inline" method="POST"
                                onclick="return confirm('Estas seguro que queres eliminar el trailer?')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                  eliminar
                                </button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      @endif
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-12">
              {{--Exito--}}
              @if ( session('mensaje') )
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('mensaje')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              @endif
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <span>Lista de Capitulos: </span>
                  {{-- Agregar Capítulo --}}
                  <a href="{{route('capitulos.createWithBook', $libro -> id)}}" class="btn btn-primary btn-sm btn-icon">
                    Agregar Capítulo
                  </a>
                </div>
                <div class="card-body">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Título</th>
                        <th scope="col">Pdf</th>
                        <th scope="col">Acciónes</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($libro -> capitulos as $item)
                      <tr>
                        <td>
                          <a href="{{route('capitulos.show',$item)}}"> {{--Tengo que pasar como parametro el item --}}
                              {{ $item->titulo }}
                          </a>
                        </td>
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
                          onclick="return confirm('Estas seguro que queres eliminar el Capitulo?')">
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
                {{-- fin card body --}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection