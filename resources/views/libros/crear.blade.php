@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Agregar libro</span>
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

          {{-- Formulario --}}
          <form method="POST" action="{{route('libros.store')}}" enctype="multipart/form-data">
            @csrf

            <div class= "row">
              <div class= "col-lg-6">
                <input
                  required
                  type="text"
                  name="titulo"
                  placeholder="Ingrese el título"
                  class="form-control mb-2"
                  value="{{old('titulo')}}" 
                />
              </div>
              <div class= "col-lg-6">
                <input
                  required
                  type="text"
                  name="isbn"
                  placeholder="Ingrese ISBN"
                  class="form-control mb-2"
                  value="{{old('isbn')}}" 
                />
              </div>
            </div>
            <div class= "row">
              <div class= "col-lg-4">
                Autor:<br>
                <select class= "form-control" name="autor" >
                  @foreach(\App\Autor::all() as $autor)
                    <option value="{{$autor->id}}">{{$autor->nombre}}</option>
                  @endforeach
                </select> 
              </div>
              <div class= "col-lg-4">
                Editorial:<br>
                <select class= "form-control" name="editorial">
                  @foreach(\App\Editorial::all() as $editorial)
                    <option value="{{$editorial->id}}">{{$editorial->nombre}}</option>
                  @endforeach
                </select> 
              </div>
              <div class= "col-lg-4">
                Géneros:<br>
                <select class= "form-control" name="generos[]" multiple>
                @foreach(\App\Genero::all() as $genero)
                <option value="{{$genero->id}}">{{$genero->nombre}}</option>
                @endforeach
                </select> 
              </div>
            </div>
            <div class= "row">
              <div class= "col-lg-6">
                <div class= "row">
                  <div class= "col-lg-6">
                    Fecha de lanzamiento:
                    <input
                      required
                      type="date"
                      name="fecha_de_lanzamiento"
                      placeholder="Ingrese fecha de lanzamiento"
                      class="form-control mb-2"
                      value="{{old('fecha_de_lanzamiento')}}" 
                    />
                  </div>
                  <div class= "col-lg-6">
                    Fecha de vencimiento:
                    <input
                      required
                      type="date"
                      name="fecha_de_vencimiento"
                      placeholder="Ingrese fecha de vencimiento"
                      class="form-control mb-2"
                      value="{{old('fecha_de_vencimiento')}}" 
                    />
                  </div>
                </div>
                <div class= "row">
                  <div class= "col-lg-12">
                    Portada:
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input"
                          name="portada" 
                          accept="image/png, .jpeg, .jpg, image/gif" >
                        <label class="custom-file-label" for="inputGroupFile04">
                          imagen .png .jpeg .jpg .gif</label>
                      </div>
                    </div>
                    <p>
                      (Tamaño máximo: 41 Megabytes)
                    </p>
                    <script type="application/javascript">
                      $('input[type="file"]').change(function(e){
                          var fileName = e.target.files[0].name;
                          $('.custom-file-label').html(fileName);
                      });
                    </script>
                  </div>
                </div>
              </div>              
              <div class= "col-lg-6 align-self-center">
                <div class= "row justify-content-center">
                  <div class= "col-lg-6">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" name="tipolibro" id="checkCompleto" checked
                                value="completo" required> 
                        Libro Completo
                      </label>
                      <label class="btn btn-primary">
                        <input type="radio" name="tipolibro" id="checkCapitulos" for="cant"
                        data-toggle="collapse" data-target="#collapseOne"
                        value="porcapitulos" required>
                        Por Capítulos
                      </label>
                    </div>
                    <div class="collapse" id="collapseOne">
                    </div>
                  </div>
                </div>
                <div class= "row justify-content-end">
                  <div class= "col-lg-6">
                    <input id="cant"
                      required
                      min="2"
                      type="number"
                      name="cantidad_capitulos"
                      class="form-control mb-2"
                      placeholder="Cantidad"
                      value="{{old('cantidad_capitulos')}}" 
                      disabled/>
                    <script type="application/javascript">
                      document.getElementById('checkCapitulos').onclick = function() {
                        if(this.checked==true){
                          document.getElementById("cant").disabled=false;
                          document.getElementById("cant").focus();
                        }
                        else{
                          document.getElementById("cant").disabled=true;
                        }
                      };
                      document.getElementById('checkCompleto').onchange = function() {
                        if(this.checked==true){
                          document.getElementById("cant").disabled=true;
                        }
                      };
                    </script>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-right"> 
              <a href="{{route('libros.index')}}" class="btn btn-secondary btn-sm">
                Cancelar
              </a>
              <button class="btn btn-primary btn-sm" type="submit">
                Agregar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection