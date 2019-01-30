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
							
						</div>
				</div>
		</nav>

		<p style="margin:50px;">
      		¡Tu inscripción fue realizada con éxito! <br>
  		
      		Your registration was successful! <br>
  		
      		Sua inscrição foi realizada com sucesso! <br>
  		
      		Votre inscription a été réalisé avec succès! <br>
  		
    </p>
	</div>

</body>
</html>
