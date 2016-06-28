<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Bootstrap 3 Admin</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/invoice.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/jquery-ui.min.css') }}" rel="stylesheet">
  </head>
  <body>

  <div class="container">
    <div class="col-lg-12">
      <div class="row">
          <div class="col-md-12 text-center">
            <h3>KLINIK dan RUMAH BERSALIN CAHAYA BUNDA</h4> 
          </div>
          <div class="col-md-12 text-center">
            <h4>Jln. Ir. Soekarno 88x, Grokgak Tabanan</h4> 
          </div>
          <div class="col-md-12 text-center">
            <h4>Telp. (0361) 8941576</h4> 
          </div>
      </div>
      <hr>
      @yield('content')            

      @if (isset($showSign) && $showSign)
      <div class="row">
        <div class="col-md-3 text-center">
          PASIEN<br>
          <br>
          <br>
          (.................................)
        </div>
        <div class="col-md-3 text-center">
          PETUGAS KLINIK<br>
          <br>
          <br>
          (.................................)
        </div>
      </div>
      @endif
    </div>
  </div>
  </body>
<!-- header -->