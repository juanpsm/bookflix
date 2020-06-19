@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card bg-dark">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div class="p-2">
              <span> {{$trailer->libro->titulo}} - {{$trailer->titulo}} </span>
            </div>
            <div class="d-flex justify-content-end">
              <a href="" class= "btn btn-secondary ml-auto" >
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