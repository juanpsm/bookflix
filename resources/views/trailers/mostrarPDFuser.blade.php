@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      
      <embed src="{{url($trailer -> pdf)}}#toolbar=0&navpanes=0&scrollbar=0" width="500" height="500">

    </div>
  </div>
</div>
@endsection