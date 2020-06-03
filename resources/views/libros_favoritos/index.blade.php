@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Libros favoritos:</span>
        </div>
        <div class="card-body">           
          <table class="table table-striped table-hover">
            <thead>
              <tr>
              <th scope="col">Autor</th>
              <th scope="col">Título</th>
              </tr>
            </thead>
            <tbody>
              @if(count($favoritos) > 0)
                @foreach ($favoritos as $item)
                <tr>
                  <td>{{ $item->autor->nombre }}</td>
                  <td>
                    {{ $item->titulo }}
                  </td>
                </tr>
                @endforeach
              @else
                <td colspan="2">Aca se mostraran los favoritos</td>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection