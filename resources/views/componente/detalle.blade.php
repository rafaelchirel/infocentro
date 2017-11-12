@extends('template.main')
@section('title', 'InfoCentro|Componentes')

@section('complemento', '')
	<!-- zoom imagen galeria -->
	<link href="{{ asset('plugin/zoomgaleria/zoomgaleria.css') }}" rel="stylesheet">
	<!-- boostrap select -->
	<link href="{{ asset('plugin/bootstrap-select-1.12.2/dist/css/bootstrap-select.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Componente')
@section('titulo', 'Detalle')

@section('content')

<style>
    .titulo {
        text-align: center;
        font-size: 1.5em;
        font-weight: bold;
        border-bottom: 1px solid #00aeef;
    }
    .required{
    	color: red;
    }
</style>

<div id="message">
    @include('flash::message')
</div>

<?php $cont = 0; ?>

	@foreach($componente as $e)
		<div class="table-responsive">
		    <table class="table table-bordered">
		        <thead>
		            <tr>
		                <th colspan="5" class="text-uppercase text-center">{{ $e->periferico . ' - ' . $e->comp_estatus }}</th>
		            </tr>
		            <tr>
		                <th>IMAGEN</th>
		                <th>MARCA</th>
		                <th>MODELO</th>
		                <th>SERIAL</th>
		                <th>DESCRIPCION</th>
		            </tr>
		        </thead>
		        <tbody>
		            <tr>
		                <th style="width: 100px; height: 100px">
		                    <img id="{{ $cont }}" onclick="p(this.id)" src="{{ asset('/img/componentes/' . $e->imagen) }}" width="100px" height="100px" alt="{{ $e->periferico }}" class="myImg">
		                </th>
		                <td>{{ $e->marca }}</td>
		                <td>{{ $e->modelo }}</td>
		                <td>{{ $e->serial }}</td>
		                <td>{{ $e->descripcion }}</td>
		            </tr>
		        </tbody>
		    </table>
		</div>
	<?php $cont++; ?>

	<!-- button dropdown - cambiar estatus -->
	@if ($e->estatus_id != 4 && $e->estatus_id != 5 && $e->estatus_id != 8)
		<div class="text-center" style="margin: 0 0 2% 0;">
		    <button class="btn btn-success btn-xs" type="button" id="cambiar_estatus">Cambiar Estatus</button>
		</div>
	
		<!-- Cambio de estatus - formulario -->
		<div class="form-horizontal form-label-left" id="formulario">

		    {!! Form::open(['route' => 'cambiar-estatus', 'method' => 'post']) !!}

			<input type="hidden" name="componente_id" value="{{ $e->comp_id }}" required="">

			{{-- select estatus --}}
		    <div class="form-group">
		        {!! Html::decode(Form::label('estatus','Estatus: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
		        <div class='col-md-6 col-sm-6 col-xs-12'>
			        <select name="estatus_id" id="estatus" class="form-control selectpicker" title="seleccione una opcion" required="">
				        @foreach ($estatus as $z)
				        	@if ($e->estatus_id == 3 && $z->id != 1)
				        		{{-- Aqui estoy renombrando el estatus de asignado a equipo a asignar equipo --}}
				        		@if ($z->id == 3)
				        			<option value="{{ $z->id }}">Asignar a Equipo</option>
				        		@else
				        			<option value="{{ $z->id }}">{{ $z->condicion }}</option>
				        		@endif
				        	@elseif ($z->id != $e->estatus_id && $z->id != 1)
				        		{{-- Aqui estoy renombrando el estatus de asignado a equipo a asignar equipo --}}
				        		@if ($z->id == 3)
				        			<option value="{{ $z->id }}">Asignar a Equipo</option>
				        		@else
				        			@if ($z->id != 7)
				        				<option value="{{ $z->id }}">{{ $z->condicion }}</option>
				        			@endif
				        		@endif
				        	@endif
				        @endforeach
			        </select>
		        </div>
	   		</div>

			<!-- condicion para estatus dañado | Equipo-->
			@if ($e->estatus_id == 3)
				<div class="form-group" id="condicion">
			        {!! Html::decode(Form::label('Condicion','Condicion: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
			        <div class='col-md-6 col-sm-6 col-xs-12'>
				         <div class="btn-group" data-toggle="buttons">
	                        <label class="btn btn-default" id="condicion1">
	                          <input type="radio" name="condicion" value="1"> Mismo Equipo
	                        </label>
	                        
							<!-- input hidden - componente vinculado con el equipo actual -->
							@if ($equ_comp)
								<input type="hidden" name="equipo_vinculado" value="{{ $equ_comp->equipo_id }}">
							@endif
	                        

	                        <label class="btn btn-default" id="condicion2">
	                          <input type="radio" name="condicion" value="2"> Otro Equipo
	                        </label>
	                      </div>
			        </div>
		   		</div>
			@endif
			
			{{-- select equipo --}}
			@if (count($equipos) != 0)
				<div class="form-group" id="equipos">
		        {!! Html::decode(Form::label('equipo','Equipo: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
		        <div class='col-md-6 col-sm-6 col-xs-12'>
			        <select name="equipo" class="form-control selectpicker" title="seleccione una opcion">
				        @foreach ($equipos as $a)

							@if ($equ_comp)
								@if (count($equipos) == 1 && $a->id == $equ_comp->equipo_id)
									{{-- Si no hay equipos, no puede habeer option de asignar equipo --}}
									<script>
										var x = document.getElementById("estatus");
					    				x.remove(3);
									</script>
								@else
									@if ($a->id != $equ_comp->equipo_id)
										<option value="{{ $a->id }}">{{ $a->numero }}</option>
									@endif
								@endif
							@else
								<option value="{{ $a->id }}">{{ $a->numero }}</option>
							@endif

				        @endforeach
			        </select>
			        </div>
		   		</div>
			@else
			{{-- Si no hay equipos, no puede habeer option de asignar equipo --}}
				<script>
					var x = document.getElementById("estatus");
    				x.remove(1);
				</script>
			@endif
	   		

			{{-- textarea observacion --}}
			<div class="item form-group">
	        	{!! Html::decode(Form::label('observacion','Observacion: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
	        <div class="col-md-6 col-sm-6 col-xs-12">
	            {!! Form::textarea('observacion', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => '', 'required', 'id' => 'observacion',  "onpaste='return false'", "onclick='UpperTrim(this.id)'"]) !!}
		        </div>
		    </div>

		    <div class="form-group text-center">
		        {!! Form::button('Salir', ['class' => 'btn btn-danger salir']) !!}
		        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
		    </div>

		    {!! Form::close() !!}
			<br></div>	
	@endif
	<!-- Cierre formulario -->
	@endforeach

	<!-- Historial -->
	<div class="panel panel-default">
	  <div class="panel-heading">Historial</div>
			@foreach ($historial as $h)
				@if ($h->observacion != null && $h->observacion != '')
					<!-- content --> 
					<div class="media" style="border: 1px solid #C9C9C9; margin: 2% 1% 2% 1%;">
					  <div class="media-left">
					    <img src="{{ asset('img/avatar/' . $h->avatar) }}" class="media-object" style="width:60px; border: 1px solid black;">
					  </div>
					  <div class="media-body">
					    <h4 class="media-heading text-uppercase"><b>Estatus:</b> {{ $h->estatus }} | {{ Carbon\Carbon::parse($h->fecha_hora)->format('h:i:s A d-m-Y') }} | {{ $h->user }}</h4>
					    <p>{!! $h->observacion !!}</p>
					  </div>
					</div>
				@else
					<!-- content --> 
					<div class="media" style="border: 1px solid #C9C9C9; margin: 2% 1% 2% 1%;">
					  <div class="media-left">
					    <img src="{{ asset('img/avatar/' . $h->avatar) }}" class="media-object" style="width:60px; border: 1px solid black;">
					  </div>
					  <div class="media-body" style="vertical-align: middle;">
					    <h4 class="media-heading text-uppercase"><b>Estatus:</b> {{ $h->estatus }} | {{ Carbon\Carbon::parse($h->fecha_hora)->format('h:i:s A d-m-Y') }} | {{ $h->user }}</h4>
					  </div>
					</div>
				@endif
			@endforeach
	</div>

	<div class="text-center">
		{{ $historial->render() }}
	</div>
	
	<!-- Modal Zoom Componentes -->
		<div id="myModal" class="modal">
		    <span class="close">&times;</span>
		    <img class="modal-content" id="img01">
		    <div id="caption"></div>
		</div>
	<!-- Cierre Zoom Componentes -->

@endsection()

@section('complemento-2')
<script src="{{ asset('plugin/zoomgaleria/zoomgaleria.js') }}"></script>
<script src="{{ asset('plugin/bootstrap-select-1.12.2/dist/js/bootstrap-select.js') }}"></script>
{{-- Validation input --}}
<script src="{{ asset('js/validation.js') }}"></script>

<script>
		//ocultar mensaje
		$('#message').show().delay(3000).fadeOut();
		//al iniciarse la vista se ejuctara
	    $("#formulario").hide();
	    $("#equipos").hide();
	    $('#required').hide();
	    $('#no_required').show();
	    $('#condicion').hide();

	    //mostrar formulario - ocultar button de cambiar estado
	    $("#cambiar_estatus").click(function(){
	        $("#formulario").show();
	        $("#cambiar_estatus").hide();
	    });

	    //Ocultar formulario - mostrar button cambiar estado
	    $(".salir").click(function(){
	        $("#formulario").hide();
	        $("#cambiar_estatus").show();
	    });

	    //Mostrar select listado equipos
	    $('#estatus').on('change', function() {
	    	if (this.value == 3) {
				$("#equipos").show();
	    	}else{
	    		$('#equipos').hide();
	    	}

	    	if (this.value == 7) {
				$("#condicion").show();
	    	}else{
	    		$('#condicion').hide();
	    	}
		});
	    //Grupo boton condicion estatu Dañado | Equipo
		$("#condicion1").click(function(){
	        $('#equipos').hide();
	    });
	    $("#condicion2").click(function(){
	        $("#equipos").show();
	    });

	    //Agregando atributos a la navbar para que este activa
		$('#componentes-ul').attr('style','display: block');
		$("#componentes-li").addClass("active");
		$("#componentes-li-2").addClass("current-page");
</script>

@endsection()