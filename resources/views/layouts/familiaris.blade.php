<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="google-signin-scope" content="profile email">
	<meta name="google-signin-client_id" content="493189783758-4amjerqj2vrokpmp47ud103f9h6n77jp.apps.googleusercontent.com">	


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
  	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('externo/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<style>
		fieldset {
		  padding: 1em;
		  font:80%/1 sans-serif;
		  border:1px solid green;
		  margin-right:0.5em;
		  margin-left:0.5em;
		}
		.material-icons {
		  font-family: 'Material Icons';
		  font-weight: normal;
		  font-style: normal;
		  font-size: 24px;  /* Preferred icon size */
		  display: inline-block;
		  line-height: 1;
		  text-transform: none;
		  letter-spacing: normal;
		  word-wrap: normal;
		  white-space: nowrap;
		  direction: ltr;

		  /* Support for all WebKit browsers. */
		  -webkit-font-smoothing: antialiased;
		  /* Support for Safari and Chrome. */
		  text-rendering: optimizeLegibility;

		  /* Support for Firefox. */
		  -moz-osx-font-smoothing: grayscale;

		  /* Support for IE. */
		  font-feature-settings: 'liga';
		}
	</style>
	<script>
		jQuery(document).ready(function($) {
    	    $(".clickable-row").click(function() {
            window.location = $(this).data("href");
    	    });
    	});
		function onSignedIn2(googleUser) {
			// Useful data for your client-side scripts:
			var profile = googleUser.getBasicProfile();
			console.log("ID: " + profile.getId()); // Don't send this directly to your server!
			console.log('Full Name: ' + profile.getName());
			console.log('Given Name: ' + profile.getGivenName());
			console.log('Family Name: ' + profile.getFamilyName());
			console.log("Image URL: " + profile.getImageUrl());
			console.log("Email: " + profile.getEmail());

			// The ID token you need to pass to your backend:
			var id_token = googleUser.getAuthResponse().id_token;
			console.log("ID Token: " + id_token);
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'http://familiaris.pasioncreadora.info/tokensignin');
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
			xhr.onload = function() {
			console.log('Logueado :' + xhr.responseText);
			if (xhr.responseText =="si")
				window.location = "http://familiaris.pasioncreadora.info/inicio";		
			};
			xhr.send('idtoken=' + id_token);
		}
		
		function onSignInFailure() {
			// Handle sign-in errors
			console.log('Algo falló no se autentica');
		}
	    
		function signOut() {
			var auth2 = gapi.auth2.getAuthInstance();
			auth2.signOut().then(function () {
				console.log('User signed out.');
			});
		}

    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Familiaris
                </a><small class="text-gray"> {{ __('words.subtitulo') }} </small>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>							
                        @else
                                	<a class="dropdown-item" href="{{ route('ver_proyectos') }}">
                                		{{ __('words.Ver_proyectos') }}
                                	</a>
                                	<a class="dropdown-item" href="{{ route('proyectos.crear') }}">
                                		{{ __('words.Crear_proyecto') }}
                                	</a>
									
                            	
                                <button type="button" id="navbarDropdown" class="btn btn-secondary dropdown-toggle btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre >
                                    {{ Auth::user()->name }}<i class="material-icons" style="font-size: 18px;">person</i>
                                </button>&nbsp;
								<li class="nav-item dropdown">
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();signOut();">
                                        {{ __('words.Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @component('components.menu_idioma')
							@endcomponent
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">	
		<fieldset>
		<legend>@yield('fieldset')</legend>
			@yield('content')
        </fieldset>
		</main>
    </div>
</body>
</html>
