@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card bg-dark">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div class="p-2">
              <span>
                @if ($trailer -> libro)
                <a href="{{route("libros.showForUser", $trailer-> libro)}}">
                  {{$trailer -> libro -> titulo}}
                </a>
                @else
                  Sin Libro
                @endif
                  - {{$trailer -> titulo}}
              </span>
            </div>
            <div class="d-flex justify-content-end">
              @if ($trailer -> libro)
                <a href="{{route("libros.showForUser", $trailer-> libro)}}" class= "btn btn-secondary ml-auto" >
              @else
                <a href="{{route('trailers.showListaUser')}}" class= "btn btn-secondary ml-auto" >
              @endif
                Volver
              </a>
            </div>
          </div>
          <div class="card-body">
            <embed src="{{url($trailer -> pdf)}}#toolbar=0&navpanes=0&scrollbar=0" height="500" class= "w-100">
          </div>
    </div>
  </div>
</div>
@endsection