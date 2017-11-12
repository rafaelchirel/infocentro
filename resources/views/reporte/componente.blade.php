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
		{!! Form::open(['url' => 'reporte-componente-pdf', 'method' => 'post', 'id' => 'FormIndividual', 'target' => '_blank']) !!}
			
			<div class="item form-group">
		        {!! Html::decode(Form::label('componente','Componente:', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
		        <div class='col-md-6 col-sm-6 col-xs-12'>
		          {!! Form::text('componente', null, ['class' => 'form-control has-feedback-left', 'placeholder' => 'serial', 'required', 'id' => 'componente']) !!}
		          <span class="fa fa-reorder form-control-feedback left"></span>
		        </div>
	 		</div>

	 		<div class="text-center">
	 			{!! Form::submit('Ver PDF', ['class' => 'btn btn-info', 'id' => 'SubmitIndividual']) !!}
	 		</div>

		{!! Form::close() !!}
	</div>

	<div id="DivGeneral" class="oculto">
		{!! Form::open(['url' => 'reporte-componente-pdf', 'method' => 'post', 'id' => 'FormGeneral', 'target' => '_blank']) !!}
		
			<div class="item form-group">
		        {!! Html::decode(Form::label('estatus','Estatus:', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
		        <div class='col-md-6 col-sm-6 col-xs-12'>
		          {!! Form::select('estatus', $estatus, null, ['class' => 'form-control']) !!}
		        </div>
	 		</div>
	 		<div class="item form-group">
		        {!! Html::decode(Form::label('condicion','Condicion:', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
		        <div class='col-md-6 col-sm-6 col-xs-12'>
		          {!! Form::select('condicion', ['1' => 'Con Historial', '2' => 'Sin Historial'], null, ['class' => 'form-control']) !!}
		        </div>
	 		</div>


	 		<div class="text-center">
		 			{!! Form::submit('Ver PDF', ['class' => 'btn btn-info', 'id' => 'SubmitGeneral']) !!}
		 	</div>

		{!! Form::close() !!}
	</div>

</div>

@endsection()

@section('complemento-2')
<script src="{{ asset('plugin/bootstrap-select-1.12.2/dist/js/bootstrap-select.js') }}"></script>
<!--Jquery Autocomplete -->
<script src="{{ asset('plugin/jquery-autocomplete/jquery.autocomplete.min.js') }}"></script>

    <script>
	  //Button
	$( "#ButtonIndividual" ).click(function() {
	  $('#DivIndividual').removeClass('oculto');
	  $('#DivGeneral').addClass('oculto');
	});
	$( "#ButtonGeneral" ).click(function() {
	  $('#DivGeneral').removeClass('oculto');
	  $('#DivIndividual').addClass('oculto');
	});

	//Jquery Autocomplete
	$('#componente').autocomplete({
    	serviceUrl: "{{ url('jquery-autocomplete') }}",
	});
	/*
	$( "#componente" ).keyup(function() {
	  console.clear();
	});
	*/
    </script>
@endsection()