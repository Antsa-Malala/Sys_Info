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
	<script type="text/javascript" src="{{ URL::asset('js/ajax.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/Operations.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/parsley.min.js') }}"></script>
	<title>{{ $title }}</title>
</head>
<style>
	* {
	    padding: 0;
    	margin: 0;
	}

	html {
		position: relative;
		min-height: 100%;
	}

	body {
		/* Margin bottom by footer height */
		margin-bottom: 60px;
	}

	.footer {
		position: absolute;
		bottom: 0;
		width: 100%;
		/* Set the fixed height of the footer here */
		height: 60px;
	}
</style>
<body>
	@include('inc.headers')
	@yield('content')
	@include('inc.errors')
	@include('inc.footer')
	
	<script type="text/javascript" src="{{ URL::asset('bootstrap/bootstrap-5.0.2/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('aos/dist/aos.js') }}"></script>
	
	<script>
  		$('#form').parsley();
  		AOS.init({
			duration: 1000,
			once: false,
	        easing: 'ease-in-out'
	      });
	</script>
	{{-- <script type="text/javascript" src="{{ URL::asset('bootstrap/bootstrap-5.0.2/js/bootstrap.min.js') }}"></script> --}}
</body>
</html>