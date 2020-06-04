@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <object 
        data="{{url($trailer -> pdf)}}#toolbar=0&navpanes=0&scrollbar=0" 
        type="application/pdf" width="600" height="500"> 
          <embed src="{{url($trailer -> pdf)}}#toolbar=0&navpanes=0&scrollbar=0" 
            width="1024px" 
            height="768px" />
            <p>This browser does not support PDFs. Please download the PDF to view it:  
              <a href="{{url($trailer -> pdf)}}">Download PDF</a>.
            </p>
      </object>

    </div>
  </div>
</div>
@endsection