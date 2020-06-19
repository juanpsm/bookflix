@extends('layouts.auth')
{{--@isset($libro) {{$libro_id = $libro->id}} @else {{$libro_id = "no_book"}}{{ $libro = "no_book"}} @endisset--}}
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Agregar Tráiler</span>
        </div>
        <div class="card-body">
          {{--Errores--}}
          @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {!! implode('', $errors->all('<div>:message</div>')) !!}
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

          {{-- Formulario --}}
          <form method="POST" action="{{route('trailers.store')}}" enctype="multipart/form-data">
            @csrf

            <!-- Titulo -->
            <div class="row container">
              <input
                type="text"
                name="titulo"
                placeholder="Ingrese el título"
                class="form-control mb-2"
                value="{{old('titulo')}}"
              />
            </div>
            <!-- PDF -->
            <div class="row container">
              <div class="row container">
              Archivo PDF:
              </div>
              <input 
                type="file" 
                name="pdf" 
                accept="application/pdf,application/vnd.ms-excel" 
                class="form-group"
              >
            </div>
            <div class="row container">
              Libro:<br>
              <input id="searchBook" class="form-control mb-2">
              <input id="searchBookVal" name="libro" type="hidden">
              <script>
              $(document).ready(function() {
                  $('#searchBook').typeahead({
                      minLength: 1,
                      delay: 400,
                      autoSelect: false,
                      source(query, process) {
                          $.ajax({
                              url: '{{ url("libros/user/search") }}',
                              data: {q: query, limit: 8},
                              dataType: 'json'
                          })
                          .done(function(response) {
                              return process(response);
                          });
                      },
                      displayText: (item) => item.titulo,
                      matcher() { return true },
                      afterSelect(item) {
                          $('#searchBookVal').val(item.id)
                      }
                  });
              });
              </script>
            </div>
            <div class="text-right"> 
              <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                Cancelar
              </a>
              <button class="btn btn-primary btn-sm" type="submit">
                Agregar Trailer
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection