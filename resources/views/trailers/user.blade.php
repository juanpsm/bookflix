@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Lista de Tráilers: </span>
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
              <th scope="col">PDF</th>
            
              </tr>
            </thead>
            <tbody>
              @foreach ($trailers as $item)
              <tr>
                {{-- Titulo y link --}}
                <td>
                  <a href="{{route('trailers.show',$item)}}"> {{--Tengo que pasar como parametro el item --}}
                      {{ $item->titulo }}
                  </a>
                </td>
                {{-- Cuerpo --}}
        
                {{--aca deberia mostrar el pdf--}}
                <td>
                    @if ($item -> es_pdf)
                    <a style="height: 70px; border-radius: 10%;" src="{{url($item -> pdf)}}"></a>
                 
                  @endif
                </td>
               
                
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{$trailers->links()}}
        {{-- fin card body --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection