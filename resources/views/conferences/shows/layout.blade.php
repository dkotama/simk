<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SIMK</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="/css/app.css"> 
    <link rel="stylesheet" href="/css/sweetalert.css"> 
    <link rel="stylesheet" href="/css/font-awesome.min.css">

  </head>
  <body> 
    @include('navbar')

     <div class="container container-content">
      <div class="row">
        <div class="col-md-3" id="leftCol">
          @include('conferences.shows.sidebar')       
        </div>  
        <div class="col-md-9" id="content-container">
          @yield('content');             
        </div> 
      </div>
    </div>
    
    <script src="/js/jquery-1.12.2.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    @yield('scripts.footer')

    @include('flash')
    
  </body>
</html>

