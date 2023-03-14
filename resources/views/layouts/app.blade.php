<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{ URL::asset('bootstrap/bootstrap-5.0.2/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('aos/dist/aos.css') }}">
	<title>{{ $title }}</title>
</head>
<body>
	@yield('content')
	@include('inc.errors')
</body>
</html>