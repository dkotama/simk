
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>{{ (isset($title)) ? $title : null }} {{ isset($subtitle) ? $subtitle : null}}</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet">
  </head>
  <body>
<!-- header -->
    <div id="top-nav" class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"> SIMK</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><i class="glyphicon glyphicon-user"></i> 
                            {{ isset($userName) ? $userName : null }}
                            {{ isset($userRole) ? " (" . $userRole . ")": null }}
                        </a></li>
                    <li><a href="{{ route('auth.logout')}}" onclick="return confirm('Apakah anda yakin?');"><i class="glyphicon glyphicon-lock"></i> Keluar</a></li>
                </ul>
            </div>
        </div>
        <!-- /container -->
    </div>
    <!-- /Header -->

    <!-- Main -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.sidebar') 
            </div>
            <!-- /col-3 -->
            <div class="col-sm-9">
                <!-- column 2 --> 

              @if(Session::has('flash_message'))
                  <div class="alert alert-info alert-dismissible" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      {{ Session::get('flash_message') }}
                  </div>
              @endif

              @include('partials.errors.error')
              
              @yield('content')            
            </div>
            <!--/col-span-9-->
        </div>
    </div>
<!-- /Main -->
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/scripts.js') }}"></script>
    <script src="{{ URL::asset('js/validator.js') }}"></script>
  </body>
</html>