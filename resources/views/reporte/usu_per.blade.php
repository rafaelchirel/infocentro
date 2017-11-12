@extends('template.main')
@section('title', 'InfoCentro|Reporte')

@section('complemento', '')
<!-- / Boostrap Select -->
<link href="{{ asset('plugin/bootstrap-select-1.12.2/dist/css/bootstrap-select.css') }}" rel="stylesheet">
<!-- / Boostrap Slider -->
<link rel="stylesheet" type="text/css" href="{{ asset('plugin/bootstrap-slider/bootstrap-slider.css') }}">
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
	 <button type="button" class="btn btn-success btn-lg" id="ButtonCedula">Cedula</button>
 <button type="button" class="btn btn-success btn-lg" id="ButtonAvanzado">Avanzado</button>
</div>

<div class="form-horizontal form-label-left"><br>

	<div class="alert col-md-9 col-sm-9 col-xs-12 col-md-offset-1 col-sm-offset-1 oculto" id="message" role="alert">
	    <strong id="error"></strong>
	</div>
	
	<div id="message">
   		@include('flash::message')
	</div>

	<div id="DivCedula" class="oculto">
		{!! Form::open(['url' => 'cedula-reporte-usuario-personal', 'method' => 'get', 'id' => 'FormCedula']) !!}
			<div class="item form-group">
		        {!! Html::decode(Form::label('cedula','Cedula: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
		        <div class="col-md-6 col-sm-6 col-xs-12">
		            {!! Form::text('cedula', null, ['class' => 'form-control has-feedback-left', 'placeholder' => '17856965', 'required', 'id' => 'cedula', 'minlength=10', 'maxlength=12', "onkeypress = 'return validar(event)'", "onpaste = 'return false'", "onchange='UpperTrim(this.id)'"]) !!}
		            <span class="fa fa-reorder form-control-feedback left"></span>
		        </div>
	 		</div>

	 		<div class="text-center">
	 			{!! Form::submit('Ver PDF', ['class' => 'btn btn-info', 'id' => 'SubmitCedula']) !!}
	 		</div>

	 		<div id="DivImgCedula" class="text-center oculto">
	 			<img src="{{ asset('img/procesando.gif') }}" alt="Procesando">
	 		</div>

		{!! Form::close() !!}
	</div>

	<div id="DivAvanzado" class="">
		{!! Form::open(['url' => 'avazado-reporte-usuario-personal', 'method' => 'post', 'id' => 'FormAvanzado']) !!}
		<div class="form-group">
	        {!! Html::decode(Form::label('cargo','Cargo:', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
	        <div class='col-md-6 col-sm-6 col-xs-12'>
	          {!! Form::select('cargo', ['1' => 'Personal', '2' => 'Usuario'], null, ['class' => 'form-control']) !!}
	        </div>
	    </div>

	    <div class="form-group">
	        {!! Html::decode(Form::label('genero','Genero:', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
	        <div class='col-md-6 col-sm-6 col-xs-12'>
	          {!! Form::select('genero', ['1' => 'Ambos Sexo','M' => 'Hombre', 'F' => 'Mujer'], null, ['class' => 'form-control']) !!}
	        </div>
	    </div>

	    <div class="form-group">
	        {!! Html::decode(Form::label('edad','Edad:', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
	        <div class='col-md-6 col-sm-6 col-xs-12'>
	          {!! Form::select('edad', ['1' => 'Todas las edades', '2' => 'Elegir Rango de edad'], null, ['class' => 'form-control', 'id' => 'edad', 'onchange' => 'func_edad(this.value)']) !!}
	        </div>
	    </div>

	     <div class="form-group oculto" id="DivRango">
	        {!! Html::decode(Form::label('rango','Rango:', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
	        <div class='col-md-6 col-sm-6 col-xs-12'>
				<span id="ex18-label-2a" class="hidden">low</span>
				<span id="ex18-label-2b" class="hidden">high</span>
				<input id="ex18b" class="form-control" type="text" name="rango" />
	        </div>
	    </div>

 		<div class="text-center">
	 			{!! Form::submit('Ver PDF', ['class' => 'btn btn-info', 'id' => 'SubmitAvanzado']) !!}
	 		</div>

 		<div id="DivImgAvanzado" class="text-center oculto">
 			<img src="{{ asset('img/procesando.gif') }}" alt="Procesando">
 		</div>

		{!! Form::close() !!}
	</div>

</div>


@endsection()

@section('complemento-2')
	<!-- / Boostrap Slider -->
    <script src="{{ asset('plugin/bootstrap-slider/bootstrap-slider.js') }}"></script>
    {{-- Validation input --}}
    <script src="{{ asset('js/validation.js') }}"></script>

    <script>
  
	//Validar cedula / solo numeros y un guion / el guion para menor usuarios que no tengan cedula - usan representante
    function validar(e){
      tecla = (document.all) ? e.keyCode : e.which;
      tecla = String.fromCharCode(tecla)
      return /^[0-9\-\Vv]+$/.test(tecla);
    }
 	// Boostrap Slider
	$("#ex18a").slider({
		min: 10,
		max: 100,
		value: 10,
		labelledby: 'ex18-label-1'
	});
	$("#ex18b").slider({
		min: 10,
		max: 100,
		value: [10, 38],
		labelledby: ['ex18-label-2a', 'ex18-label-2b']
	});
	// / Boostrap Slider
	  //Button
	$( "#ButtonAvanzado" ).click(function() {
	  $('#DivAvanzado').removeClass('oculto');
	  $('#DivCedula').addClass('oculto');
	});
	$( "#ButtonCedula" ).click(function() {
	  $('#DivCedula').removeClass('oculto');
	  $('#DivAvanzado').addClass('oculto');
	});
	function func_edad(value){
		if(value == 1){
			$('#DivRango').addClass('oculto');
		}else{
			$('#DivRango').removeClass('oculto');
		}
	}
	//insertando datos a travez de ajax - Form Cedula - GET
	$("#FormCedula").submit(function (e) {
	    
	    var data = $('#cedula').val();
	    var token = $("input[name=_token]").val();
	    var route = "{{ url('cedula-reporte-usuario-personal') }}" + "/" + data;
	    $.ajax({
	        url: route,
	        headers: {'X-CSRF-TOKEN': token},
	        type: 'get',
	        datatype: 'json',
	        data: data,
	        processData: false, //Evitamos que JQuery procese los datos, daría error
	        contentType: false, //No especificamos ningún tipo de dato
	        beforeSend: function(data) {
	        	$('#DivImgCedula').removeClass('oculto');
	        	$('#SubmitCedula').prop('disabled',true);
	        },
	        complete: function(){
			    $('#DivImgCedula').addClass('oculto');
	        	$('#SubmitCedula').prop('disabled',false);
			},
	        success: function (data) {
	           if(data.success == 'false'){
	           		 $('#error').html(data.cedula);
	           		 $('#message').addClass('alert-danger');
	           		 $('#message').removeClass('alert-info');
	           		 $('#message').removeClass('oculto');
					 $('#message').show().delay(3000).fadeOut();
	           }else{
	           		window.open(route,'_blank');
	               	$('#error').html('Cedula Encontrada. Un PDF se abrira en una nueva ventana.');
	               	$('#message').addClass('alert-info');
	               	$('#message').removeClass('alert-danger');
	               	$('#message').removeClass('oculto');
	               	$('#message').show().delay(3000).fadeOut();
	           }
	        },
	        error: function (data) {
	    		$('#error').html('El campo Cedula es requerido.');
	           	$('#message').addClass('alert-danger');
	           	$('#message').removeClass('alert-info');
	           	$('#message').removeClass('oculto');
	           	$('#message').show().delay(3000).fadeOut();
	        	console.clear();
	        },
	    });
	   e.preventDefault(); //Evitamos que se mande del formulario de forma convencional
	});
		//insertando datos a travez de ajax - Form - Avanazado - POST
	$("#FormAvanzado").submit(function (e) {
	    
	    var data = new FormData(this);
	    var token = $("input[name=_token]").val();
	    var route = "{{ url('avazado-reporte-usuario-personal') }}";
	    $.ajax({
	        url: route,
	        headers: {'X-CSRF-TOKEN': token},
	        type: 'post',
	        datatype: 'json',
	        data: data,
	        processData: false, //Evitamos que JQuery procese los datos, daría error
	        contentType: false, //No especificamos ningún tipo de dato
	        beforeSend: function(data) {
	        	$('#DivImgAvanzado').removeClass('oculto');
	        	$('#SubmitAvanzado').prop('disabled',true);
	        },
	        complete: function(){
			    $('#DivImgAvanzado').addClass('oculto');
	        	$('#SubmitAvanzado').prop('disabled',false);
			},
	        success: function (data) {
	           if(data.success == true){
	           	
	           }
	        },
	        error: function (data) {
	    		$('#error').html('Ningun resultado encontrado.');
	           	$('#message').addClass('alert-danger');
	           	$('#message').removeClass('alert-info');
	           	$('#message').removeClass('oculto');
	           	$('#message').show().delay(3000).fadeOut();
	        },
	    });
	   //e.preventDefault(); //Evitamos que se mande del formulario de forma convencional
	});
    </script>
@endsection()