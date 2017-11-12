@extends('template.main')
@section('title', 'InfoCentro|Reporte')

@section('complemento', '')
<!-- / Boostrap Select -->
<link href="{{ asset('plugin/bootstrap-select-1.12.2/dist/css/bootstrap-select.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Usuario | Personal')
@section('titulo', 'Reporte')
@section('content')

<style>
	.oculto{
		display: none;
		visibility: hidden;
	}
	.required{
		color: red;
	}
</style>

<div class="text-center">
	<button type="button" class="btn btn-success btn-lg" id="ButtonIndividual">Individual</button>
 	<button type="button" class="btn btn-success btn-lg" id="ButtonMultiple">Multiple</button>
 	<button type="button" class="btn btn-success btn-lg" id="ButtonGeneral">General</button>
</div>

<div class="form-horizontal form-label-left"><br>

	<div class="alert col-md-9 col-sm-9 col-xs-12 col-md-offset-1 col-sm-offset-1 oculto" id="message" role="alert">
	    <strong id="error"></strong>
	</div>
	
	<div id="message">
   		@include('flash::message')
	</div>

	<div id="DivIndividual" class="">
		{!! Form::open(['url' => 'reporte-equipo-pdf', 'method' => 'post', 'id' => 'FormIndividual', 'target' => '_blank']) !!}
			
			<div class="item form-group">
		        {!! Html::decode(Form::label('equipo','Equipo: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
		        <div class='col-md-6 col-sm-6 col-xs-12'>
		          {!! Form::select('equipo', $equipo, null, ['class' => 'form-control selectpicker']) !!}
		        </div>
	 		</div>

	 		<div class="text-center">
	 			{!! Form::submit('Ver PDF', ['class' => 'btn btn-info', 'id' => 'SubmitIndividual']) !!}
	 		</div>

		{!! Form::close() !!}
	</div>

		<div id="DivMultiple" class="oculto">
		{!! Form::open(['url' => 'reporte-equipo-pdf', 'method' => 'post', 'id' => 'FormCedula', 'target' => '_blank']) !!}
			
			<div class="item form-group">
		        {!! Html::decode(Form::label('equipo','Equipo: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
		        <div class='col-md-6 col-sm-6 col-xs-12'>
		          {!! Form::select('equipo[]', $equipo, null, ['class' => 'form-control selectpicker', 'multiple']) !!}
		        </div>
	 		</div>

	 		<div class="text-center">
	 			{!! Form::submit('Ver PDF', ['class' => 'btn btn-info', 'id' => 'SubmitMultiple']) !!}
	 		</div>

		{!! Form::close() !!}
	</div>

	<div id="DivGeneral" class="oculto">
		{!! Form::open(['url' => 'reporte-equipo-pdf', 'method' => 'post', 'id' => 'FormGeneral', 'target' => '_blank']) !!}
		
	 		<div class="text-center">
		 			{!! Form::submit('Ver PDF', ['class' => 'btn btn-info', 'id' => 'SubmitGeneral']) !!}
		 	</div>

		{!! Form::close() !!}
	</div>

</div>

@endsection()

@section('complemento-2')
<script src="{{ asset('plugin/bootstrap-select-1.12.2/dist/js/bootstrap-select.js') }}"></script>

    <script>
	  //Button
	$( "#ButtonIndividual" ).click(function() {
	  $('#DivIndividual').removeClass('oculto');
	  $('#DivMultiple').addClass('oculto');
	  $('#DivGeneral').addClass('oculto');
	});
	$( "#ButtonMultiple" ).click(function() {
	  $('#DivMultiple').removeClass('oculto');
	  $('#DivIndividual').addClass('oculto');
	  $('#DivGeneral').addClass('oculto');
	});
	$( "#ButtonGeneral" ).click(function() {
	  $('#DivGeneral').removeClass('oculto');
	  $('#DivMultiple').addClass('oculto');
	  $('#DivIndividual').addClass('oculto');
	});

    </script>
@endsection()