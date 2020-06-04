@extends('layouts.auth')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      
      <object 
        data="{{url($trailer -> pdf)}}#toolbar=0&navpanes=0&scrollbar=0"
        type="application/pdf" 
        style="min-height:100vh;width:100%">
      </object>

      <div class="wrapper">
        <iframe 
          id="myFrame"
          src="{{url($trailer -> pdf)}}#toolbar=0&navpanes=0"
          width="100%"
          height="900px">
        </iframe>
        <div class="embed-cover"></div>
      </div>

      {{-- <object 
        id='myFrame'
        data="{{url($trailer -> pdf)}}#toolbar=0&navpanes=0&scrollbar=0" 
        type="application/pdf" width="600" height="500"> 
          <embed src="{{url($trailer -> pdf)}}#toolbar=0&navpanes=0&scrollbar=0" 
            width="1024px" 
            height="768px"
            style="position:absolute; clip:rect (190px,1100px,800px,250px);"
            />
            <p>This browser does not support PDFs. Please download the PDF to view it:  
              <a href="{{url($trailer -> pdf)}}">Download PDF</a>.
            </p>
      </object> --}}

      <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>

      <h1>PDF.js 'Hello, base64!' example</h1>

      <canvas id="the-canvas"></canvas>
      <script>
        // If absolute URL from the remote server is provided, configure the CORS
        // header on that server.
        var url = '//cdn.mozilla.net/pdfjs/helloworld.pdf';

        // Disable workers to avoid yet another cross-origin issue (workers need
        // the URL of the script to be loaded, and dynamically loading a cross-origin
        // script does not work).
        // PDFJS.disableWorker = true;

        // The workerSrc property shall be specified.
        PDFJS.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

        // Asynchronous download of PDF
        var loadingTask = PDFJS.getDocument(url);
        loadingTask.promise.then(function(pdf) {
          console.log('PDF loaded');

          // Fetch the first page
          var pageNumber = 1;
          pdf.getPage(pageNumber).then(function(page) {
            console.log('Page loaded');

            var scale = 1.5;
            var viewport = page.getViewport(scale);

            // Prepare canvas using PDF page dimensions
            var canvas = document.getElementById('the-canvas');
            var context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            // Render PDF page into canvas context
            var renderContext = {
              canvasContext: context,
              viewport: viewport
            };
            var renderTask = page.render(renderContext);
            renderTask.then(function () {
                console.log('Page rendered');
              });
          });
        }, function (reason) {
          // PDF loading error
          console.error(reason);
        });
      </script>
    </div>
  </div>
</div>
@endsection