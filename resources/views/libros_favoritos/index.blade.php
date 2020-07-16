@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card bg-dark">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Libros favoritos:</span>
        </div>
        <div class="card-body">  
          @if(count($favoritos) == 0)
            <span>Acá se mostraran los libros favoritos</span>
          @else
            <table class="table table-dark table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">Portada</th>
                  <th scope="col">Título</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($favoritos as $item)
                  <tr>
                  <td>
                    @if ($item->portada != 'noFile')
                        <img style="height: 70px; border-radius: 10%;" src="{{url($item->portada)}}">
                      @else
                        {{$item->portada}}
                      @endif
                    </td>
                    <td>
                      @if($item->deleted_at || $item->vencido())
                        {{ $item->titulo }}<br>
                        <small>Este libro ya no se encuentra disponible</small>
                      @elseif($item->proximamente())
                        <small>Proximamente...</small>
                      @else
                      <a href="{{url("libros/user/{$item->id}")}}"> {{--Tengo que pasar como parametro el item --}}
                        {{ $item->titulo }}
                      </a>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            @endif
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection