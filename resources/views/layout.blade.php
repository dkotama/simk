<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>SIMK</title>

		<link rel="stylesheet" href="/css/bootstrap.min.css">	
    <link rel="stylesheet" href="/css/app.css"> 
    <link rel="stylesheet" href="/css/sweetalert.css"> 
    <link rel="stylesheet" href="css/font-awesome.min.css">
		@yield('scripts.header')

	</head>
	<body> 
    @include('navbar')

		@yield('content')	
    
    <script src="/js/jquery-1.12.2.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
    <script src="/js/sweetalert.min.js"></script>
		@yield('scripts.footer')

	  @include('flash')
	  
	</body>
</html>