<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="@yield('meta-description', 'An app to simplify your life.')"/>
	<meta name="robots" content="@yield('meta-robots','follow')"/>
    <title>@yield('title', config('app.name'))</title>
	<link rel="stylesheet" href="{{ (isset($colormode) && $colormode == 'light') ? url('/assets/css/variableslight.css') : url('/assets/css/variablesdark.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ url('/assets/css/index.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ (isset($colormode) && $colormode == 'light') ? url('/assets/css/bootstraplight.min.css') : url('/assets/css/bootstrap.min.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ url('/assets/css/fontawesome.min.css') }}" type="text/css">
	<script src="{{ url('/assets/js/popper.min.js') }}"></script>
	<script src="{{ url('/assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ url('/assets/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ url('/assets/js/index.js') }}"></script>
	<script src="{{ url('/assets/js/jquery.mask.min.js')}}"></script>
	@yield('extraassets')
</head>