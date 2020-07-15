@extends('layouts.auth')

@section('content')
<div class="container">
  {{-- debugueando imagenes y archivos
  <div>limpio  : {{$link = $libro-> portada}}
    <img style="width:10%" src="{{$link}}"></div>
  <div>concat : {{$link = url('storage/app/'.$libro -> portada)}}
    <img style="width:10%" src="{{$link}}"></div>
  <div>st_path: {{$link = storage_path($libro -> portada)}}
    <img style="width:10%" src="{{$link}}"></div>
  <div>asset  :  {{$link = asset($libro->portada)}}
    <img style="width:10%" src="{{$link}}"></div>
  <div>before: {{$link = url("image/seeds/portadas/anne.jpg")}}
    <img style="width:10%" src="{{$link}}"></div>
  <div>relative:{{$link = url("storage/portadas/mxiED6oizk413MyOBAoKuY49mUFxyiDg6CHDKyh1.jpeg")}}
    <img style="width:10%" src="{{$link}}">
  </div> --}}
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <span class="mr-auto">Libro #{{$libro -> id}}</span>
          @if (!$libro -> finalizado())
            <a href="{{route('libros.edit', $libro)}}" class="btn btn-primary btn-sm mr-2">
              editar
            </a>
          @endif
          <a href="{{route('libros.index')}}" class="btn btn-primary btn-sm">Volver</a>
        </div>
        <div class="card-body">
          <div class="row"> {{-- Portada y Tabla Info --}}
            <div class="col-md-3">{{-- Portada --}}
              <span>Portada:</span>
              <div>
                @if (!($libro-> portada  == 'noFile'))
                  <img style="width:100%" src="{{url($libro -> portada)}}">
                @endif
              </div>
            </div>
            <div class="col-md-9">{{-- Tabla Info --}}
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
                      Lanzamiento:
                    </td>
                    <td>
                      {{$libro -> fecha_de_lanzamiento->isoFormat("DD \d\\e MMMM \d\\e YYYY")}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Vencimiento:
                    </td>
                    <td>
                      {{$libro -> fecha_de_vencimiento->isoFormat("DD \d\\e MMMM \d\\e YYYY")}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Cantidad de archivos:
                    </td>
                    <td>
                      {{$libro->cantCapCargados()}} / {{$libro->cantidad_capitulos}}
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

          {{--Exito Agregar Capitulos--}}
          @if ( session('mensaje') )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{session('mensaje')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          <!-- Nav tabs -->
          <ul class="nav nav-tabs justify-content-center" role="tablist">
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#capitulos" role="tab">
                @if ( $libro-> esCompleto() )
                  Archivo
                @else
                  Capítulos
                @endif
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#comentarios" role="tab">
                Commentarios
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#recomendados" role="tab">
                Recomendados
              </a>
            </li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            {{-- Tab Capitulos --}}
            <div class="tab-pane active" id="capitulos" role="tabpanel">
              <div class="row justify-content-end p-2">
                @if ($libro->cantCapCargados() == 0)
                  {{-- Vacio capitulos --}}
                  <div class="col-sm-8">
                    <h4 class="p-4">No se ha cargado ninguno todavía</h4>
                  </div>
                @endif
                @if(!$libro-> finalizado())
                  {{-- Agregar Capítulo/Archivo --}}
                  @if(!$libro-> lleno())
                    <div class="col-sm-3 p-4">
                        <a href="{{route('capitulos.createWithBook', $libro -> id)}}" class="btn btn-primary btn-sm btn-icon">
                          Agregar 
                          @if ( $libro-> esCompleto() )
                            Archivo
                          @else
                            Capítulo
                          @endif
                        </a>
                    </div>
                  @else
                    <div class="col-sm-3 p-4">
                      <a href="{{route('capitulos.finalizar', $libro -> id)}}" class="btn btn-danger btn-sm btn-icon"
                        onclick="return confirm('¿Estás seguro que queres finalizar el libro? Ten en cuenta que luego no podrás editar sus capitulos o archivos.')">
                        Finalizar Libro
                      </a>
                    </div>
                  @endif
                @else
                  <div class="col-sm-3 p-4">
                    <a href="{{route('capitulos.desfinalizar', $libro -> id)}}" class="btn btn-warning btn-sm btn-icon">
                      Desfinalizar libro (esto luego se saca)
                    </a>
                  </div>
                @endif
                {{--<table class="table table-hover table-sm table-striped">
                  <tbody>
                    <tr><td>cargados</td><td>{{$libro->cantCapCargados()}}</td></tr>
                    <tr><td>max</td><td>{{$libro->cantidad_capitulos}}</td></tr>
                    <tr><td>es completo?</td><td>{{$libro -> esCompleto()}}</td></tr>
                    <tr><td>cargados == 1?</td><td>{{$libro -> cantCapCargados() == 1}}</td></tr>
                    <tr><td>esPorCapitulos?</td><td>{{$libro -> esPorCapitulos()}}</td></tr>
                    <tr><td>cargados == max?</td><td>{{$libro -> cantCapCargados() == $libro -> cantidad_capitulos}}</td></tr>
                    <tr><td>esCompleto() && Cargados() == 1?</td><td>{{$libro -> esCompleto() && $libro -> cantCapCargados() == 1 }}</td></tr>
                    <tr><td>esPorCapitulos() && Cargados() == max?</td><td>{{$libro -> esPorCapitulos() && $libro -> cantCapCargados() == $libro -> cantidad_capitulos}}</td></tr>
                    <tr><td>||</td><td>{{ ($libro->esCompleto() && $libro->cantCapCargados() == 1 ) || ( $libro->esPorCapitulos() && $libro->cantCapCargados() == $libro->cantidad_capitulos)}}</td></tr>
                    <tr><td>lleno?</td><td>{{$libro -> lleno()}}</td></tr>
                    <tr><td> IF lleno?</td><td>@if ($libro -> lleno())
                        lleno
                    @else
                        no lleno
                    @endif</td></tr>
                  </tbody>
                </table>--}}
              </div>
              @if ($libro->cantCapCargados() > 0)
                {{-- Tabla de Capitulos --}}
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Título</th>
                      <th scope="col">Pdf</th>
                      @if(!$libro-> finalizado())
                        <th scope="col">Acciones</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($libro -> capitulos as $capitulo)
                      <tr>
                        <td>
                          {{-- Titulo Capitulo : link a "detalles"--}}
                          <a href="{{route('capitulos.show',$capitulo)}}"> {{--Tengo que pasar como parametro el capitulo --}}
                              {{ $capitulo->titulo }}
                          </a>
                        </td>
                        <td>{{-- Miniatura : link a leer el capitulo --}}
                          <a href="{{route('capitulos.showCapituloAdmin',$capitulo)}}">
                            <img style="height: 150px; border-radius: 10%;"
                              data-pdf-thumbnail-file="{{url($capitulo -> pdf)}}" 
                              src="js\pdfThumbnails\pdf.png">
                          </a>
                        </td>
                        {{-- Acciones --}}
                        @if(!$libro-> finalizado())
                          <td>
                            {{-- Edit --}}
                            <a href="{{route('capitulos.edit', $capitulo)}}" class="btn btn-primary btn-sm">
                              editar
                            </a>
                            {{-- Delete --}}
                            <form action="{{route('capitulos.destroy', $capitulo)}}" class="d-inline" method="POST"
                            onclick="return confirm('Estas seguro que queres eliminar el Capitulo?')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                  eliminar
                                </button>
                            </form>
                          </td>
                        @endif
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @endif
            </div>{{-- End Tab Capitulos --}}
            {{-- Tab Comentarios --}}
            <div class="tab-pane" id="comentarios" role="tabpanel">
              <div class="row justify-content-between p-2">
                <div class="col-sm-12">
                  @if (!$libro->tieneComentarios())
                    <h4 class="p-4">Nadie ha comentado todavía</h4>
                  @endif
                </div>
              </div>
              @if ($libro->tieneComentarios())
                {{-- Tabla de Comentarios --}}
                <table class="table table-stripped">
                  <tbody>
                    @foreach($libro -> comentarios as $comentario)
                      <tr>
                        <td>
                          <div class="card">{{-- Card cada comment--}}
                            <div class="card-header">
                              <div class="row justify-content-around align-items-center">
                                <div class="col-sm-7">
                                  <span>
                                    <sup>{{$comentario->created_at->format('d/m/Y')}}
                                      a las {{$comentario->created_at->format('H:i')}}
                                    </sup><br>
                                    {{--Le usuarie <strong>{{$comentario->perfil->user->name}}</strong> con 
                                    le perfile --}}<em>{{$comentario->perfil->nombre}}</em> dijo:
                                  </span>
                                </div>
                                <div class="col-sm-3">
                                  @if($comentario->es_spoiler)
                                  <button class="btn btn-sm btn-warning collapsed" data-toggle="collapse" 
                                    data-target="#collapseSpoiler{{$comentario->id}}" 
                                    aria-expanded="false">
                                    spoiler
                                    <svg class="bi bi-chevron-down" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                  </button>
                                  @endif
                                </div>
                                <div class="col-sm-2">
                                  <form action="{{url("libros/{$libro->id}/comentarios/{$comentario->id}")}}" method="POST"
                                    onclick="return confirm('Estas seguro que queres eliminar el comentario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                      eliminar
                                    </button>
                                  </form>
                                </div>
                              </div>
                            </div>{{-- end card header --}}
                            @if($comentario->es_spoiler)
                            <div id="collapseSpoiler{{$comentario->id}}" class="collapse">
                            @endif
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-sm-10">
                                    <blockquote>
                                    <h3><em>—"{{$comentario->cuerpo}}".</em></h3>
                                  </div>
                                </div>
                              </div>{{-- end card body --}}
                            @if($comentario->es_spoiler)
                            </div>{{-- end collapse spoiler --}}
                            @endif
                          </div>{{-- end card cada comment--}}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @endif
            </div>{{-- End Tab Comentarios --}}
            {{-- Tab Recomendados --}}
            <div class="tab-pane" id="recomendados" role="tabpanel">
              <div class="row justify-content-between p-2">
                <div class="col-sm-12">
                  @if (!$libro->tieneRecomendados())
                    <h4 class="p-4">No hay recomendaciones para éste libro todavía</h4>
                  @endif
                </div>
              </div>
              @if( $libro -> tieneRecomendados())
                <hr class="mt-1 mb-2">
                <div class="row text-center text-lg-left">
                  @foreach($libro -> recomendados() as $libro_recom)
                    <div class="col-lg-3 col-md-4 col-6">
                      <a href="{{route('libros.show',$libro_recom)}}" class="d-block mb-4 h-100 p-2">
                        <figure class="figure">
                          <img src="{{url($libro_recom -> portada)}}" class="figure-img img-fluid rounded" alt="La portada de un libro.">
                          <figcaption class="figure-caption text-right">{{$libro_recom->titulo}}</figcaption>
                        </figure>
                      </a>
                    </div>
                  @endforeach
                </div>
              @endif
            </div>{{-- End Tab Recomendados --}}
          </div>{{-- End Tabs --}}
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $('.collapse').collapse({"toggle": false});
  //$('.collapseCaps').collapse({"toggle": false, 'parent': '#datosCommentario'})
  $(document).on('click','.nav-link.active', function(){
    var href = $(this).attr('href').substring(1);
    //alert(href);
    $(this).removeClass('active');
    $('.tab-pane[id="'+ href +'"]').removeClass('active');
  })
</script>
@endsection