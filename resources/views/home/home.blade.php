@extends('template.main')
@section('title', 'InfoCentro|Home')

@section('complemento', '')
	<!-- insertar asset -->
@endsection

@section('header', 'Home')
@section('titulo', 'Indicadores')

@section('content')
          <!-- top tiles -->
          <div class="row tile_count text-center" style="border-bottom: 2px solid #ADADAD">
	          @foreach ($indicador as $key => $valor)
	          	<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
	              <span class="count_top"><i class="fa fa-certificate"></i>{{ $key }}</span>
	              <div class="count">{{ $valor }}</div>
	            </div>
	          @endforeach
          </div>
          <!-- /top tiles -->

{{-- Recorriendo las key principales --}}
<?php $key_charts = array_keys($charts); $cont = 0 ?>
<div class="container-fluid">
	<div class="col-md-12 col-sm-12 col-xs-12">

		@foreach ($key_charts as $title)
			<div class="col-md-5 col-sm-12 col-xs-12 col-lg-offset-1">
				<html>
				  <head>
				    <script type="text/javascript" src="{{ asset('template/GoogleCharts/loader.js') }}"></script>
				    <script type="text/javascript">
				      google.charts.load("current", {packages:["corechart"]});
				      google.charts.setOnLoadCallback(drawChart);
				      function drawChart() {
				        var data = google.visualization.arrayToDataTable([
				          ['Task', 'Hours per Day'],
				          @foreach ($charts[$title] as $a => $b)
				          ['{{ $a }}',     {{ $b }}],
				          @endforeach
				        ]);
				        var options = {
				          title: '{{ $title }}',
				          is3D: true,
				        };
				        var chart = new google.visualization.PieChart(document.getElementById('{{ $cont }}'));
				        chart.draw(data, options);
				      }
				    </script>
				  </head>
				  <body>
				  {{-- validando --}}
				  @foreach ($charts[$title] as $a => $b)
				  	@if ($b != 0)
				  		<div class="text-center" id="{{ $cont }}" style="width: 100%; height: 100%;"></div>
				  	@endif
				  @endforeach
				  </body>
				</html>
			</div>
		<?php $cont++; ?>
		@endforeach

	</div>
</div>
@endsection()

@section('complemento-2')
	<!-- insertar asset -->
<script>
	console.clear();
</script>

@endsection