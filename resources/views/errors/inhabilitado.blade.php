<!DOCTYPE html>
<html>
<head>
	<title>USUARIO | INHABILITADO</title>
	<!-- Icono navegacion -->
    <link rel="shortcat icon" href="{{ asset('img/ico_infocentro.png') }}">
 	<!-- Bootstrap -->
  	<link href="{{ asset('template/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<div  style="text-align: center; margin-top: 7%;">

	<h1 style="font-weight: bold; font-size: 2em;">{{ Auth::user()->name }}</h1>

	<div class="container col-sm-4 col-xs-12 col-sm-offset-4">
	  <div class="panel panel-default">
	    <div class="panel-heading" style="font-weight: bold;">USUARIO | INHABILITADO</div>
	    <img src="{{ asset('img/inhabilitado.png') }}" alt="Acceso Denegado" width="200px" alt="200px" style="margin: 1%;">
	 	<p>Comuniquese con un Administador...</p>
	  </div>
	</div>

	<div class="clearfix"></div>

	<a href="{{ url('/logout') }}" title="Cerrar Sesion" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Cerrar Sesion</a>

	 <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
       {{ csrf_field() }}
     </form>

</div>

 <!-- jQuery -->
<script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('template/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>