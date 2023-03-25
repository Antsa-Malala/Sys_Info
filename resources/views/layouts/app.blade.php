<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="{{ URL::asset('bootstrap/bootstrap-5.0.2/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('aos/dist/aos.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/home.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/error.css') }}">
	<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/parsley.min.js') }}"></script>
	<title>{{ $title }}</title>
</head>
<body>
	@include('inc.headers')
	@yield('content')
	@include('inc.errors')
	@include('inc.footer')
	
	<script type="text/javascript" src="{{ URL::asset('bootstrap/bootstrap-5.0.2/js/bootstrap.min.js') }}"></script>
	<script>
  		$('#form').parsley();
	</script>
	{{-- <script type="text/javascript" src="{{ URL::asset('bootstrap/bootstrap-5.0.2/js/bootstrap.min.js') }}"></script> --}}
</body>
</html>