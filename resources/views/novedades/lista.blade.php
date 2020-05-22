@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Lista de Novedades: </span>
          {{-- Agregar --}}
          <a href="{{route('novedades.create')}}" class="btn btn-primary btn-sm btn-icon">
            Agregar Novedad
          </a>
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
          
          <table class="table">
  <thead>
  @foreach ($novedades as $item)
         <tr>
           <th scope="col"><img style="height: 70px; border-radius: 10%;" src="{{url($item -> archivo)}}"></th>
           <th scope="col"><img style="height: 70px; border-radius: 10%;" src="{{url($item -> archivo)}}"></th>
           <th scope="col"><img style="height: 70px; border-radius: 10%;" src="{{url($item -> archivo)}}"></th>
           <th scope="col"><img style="height: 70px; border-radius: 10%;" src="{{url($item -> archivo)}}"></th>   
        </tr>
   @endforeach
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
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