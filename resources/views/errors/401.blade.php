<!DOCTYPE html>
<html>
<head>
	<title>Acceso Restringido</title>
	<!-- Icono navegacion -->
    <link rel="shortcat icon" href="{{ asset('img/ico_infocentro.png') }}">
 	<!-- Bootstrap -->
  	<link href="{{ asset('template/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<div  style="text-align: center; margin-top: 7%;">

	<div class="container col-sm-4 col-xs-12 col-sm-offset-4">
	  <div class="panel panel-default">
	    <div class="panel-heading" style="font-weight: bold;">ACCESO RESTRINGIDO</div>
	    <img src="{{ asset('img/acceso_denegado.png') }}" alt="Acceso Denegado" width="200px" alt="200px" style="margin: 1%;">
	  </div>
	</div>

	<div class="clearfix"></div>

	<a href="{{ asset('/') }}" title="inicio">Volver al inicio</a>
</div>

 <!-- jQuery -->
<script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('template/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>