<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SIMK</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/sweetalert.css">
    @yield('scripts.header')

  </head>
  <body>
    @include('navbar')
    <div class="container-fluid container-content">
    <div class="row">
        <div class="col-sm-3">
          @include('users.home.sidebar')
        </div>
        <!-- /col-3 -->
        <div class="col-sm-9" id="app">

            <!-- column 2 -->
             @include('users.home.topnav')

             @yield('content')
        </div>
        <!--/col-span-9-->
    </div>
  </div>

    <script src="/js/jquery-1.12.2.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    <script src="/js/scripts.js"></script>
    @yield('scripts.footer')

    @include('flash')      
  </body>
</html>