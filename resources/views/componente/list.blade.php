@extends('template.main')
@section('title', 'InfoCentro|Componentes')

@section('complemento', '')
<link href="{{ asset('plugin/jquery-alertable-master/jquery.alertable.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/zoomgaleria/zoomgaleria.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Estatus - ' .  $est_header = ($estatu->id == 3) ? 'Asignado a Equipo' : $estatu->condicion );
@section('titulo', 'Listado')

@section('content')

<style>
    .titulo {
        text-align: center;
        font-size: 1.5em;
        font-weight: bold;
        border-bottom: 1px solid #00aeef;
    }
</style>

<div id="message">
    @include('flash::message')
</div>

<?php $cont = 0; ?>

@if (count($componentes) > 0)

	@foreach($componentes as $e)
		<div class="table-responsive">
		    <table class="table table-bordered">
		        <thead>
		            <tr>
		                <th colspan="4" class="text-uppercase">{{ $e->periferico }}</th>
		                <th colspan="1" class="text-right" style="border-left: hidden;">
			            		<a href="{{ url("componente-detalle/" . $e->comp_id) }}" title=""><button type="button" class="btn btn-primary btn-xs">Ver detalles</button></a> 
		            	</th>
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
	@endforeach

@endif

<div class="text-center">
    {{ $componentes->render() }}
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
<script src="{{ asset('plugin/jquery-alertable-master/jquery.alertable.js') }}"></script>
<script src="{{ asset('plugin/zoomgaleria/zoomgaleria.js') }}"></script>

<script>
        //Agregando atributos a la navbar para que este activa
		$('#componentes-ul').attr('style','display: block');
		$("#componentes-li").addClass("active");
		$("#componentes-li-2").addClass("current-page");
</script>
@endsection()