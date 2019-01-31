<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BOOK') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
	<div class="">

		<nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="box-shadow:none;">
				<div class="container">

						<div class="collapse navbar-collapse flex" id="navbarSupportedContent">
							{{$venue->title}}
						</div>
				</div>
		</nav>

		<p style="margin:50px;">
      		Su reserva fue confirmada. <br>
  		
			Mapa: <a href="http://www.google.com/maps/place/"{{$venue->latitude.','.$venue->longitude}}></a> <br>
  		
			Fecha y hora: {{$book->event_date_start}}
    </p>
	</div>

</body>
</html>
