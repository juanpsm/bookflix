@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card bg-dark">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Mi Lista:</span>
        </div>
        <div class="card-body">
          @if(count($libros) == 0)
            <span>Acá aparecerán los libros que has comenzado a leer</span>
          @else
            <table class="table table-dark table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">Portada</th>
                  <th scope="col">Título</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($libros as $item)
                  <tr>
                    <td>
                      @if ($item->portada != 'noFile')
                        <img style="height: 70px; border-radius: 10%;" src="{{url($item->portada)}}">
                      @else
                        {{$item->portada}}
                      @endif
                    </td>
                    <td>
                      <a href="{{url("libros/user/{$item->id}")}}"> {{--Tengo que pasar como parametro el item --}}
                        {{ $item->titulo }}
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection