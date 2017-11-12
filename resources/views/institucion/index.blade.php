@extends('template.main')
@section('title', 'InfoCentro|Cintillo')

@section('complemento', '')
<link href="{{ asset('plugin/jquery-alertable-master/jquery.alertable.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Cintillo')
@section('titulo', 'Visualizacion')
@section('content')

<style>
    th, td{
        text-align: center;
    }
</style>

<div id="message">
    @include('flash::message')
</div>

@if(count($institucion) == 0)
<div class="text-right">
    <a href="{{ url('institucion/create') }}"><button type="button" class="btn btn-success">Registrar Cintillo</button></a>
</div>
<br>
<p>No hay ninguna cintillo registrado...</p>
@else

<!-- Tabla listado red social -->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><b>Cintillo - Institucion</b></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>CODIGO</th>
                            <th>DIRECCION</th>
                            <th colspan="2">ACCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                {{ $institucion->nombre }}
                            </th>
                            <td> <span class="label label-default">{{ $institucion->codigo }}</span></td>
                            <td>{{ $institucion->direccion }}</td>
                            <td class="text-center" style="width: 25%">
                                <a href="{{ route('institucion.edit', $institucion->id) }}"><button type="button" class="btn btn-info btn-xs">Editar</button></a>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="4">
                                <img src="{{ asset('img/cintillo/' . $institucion->banner_1) }}" width="100%" height="30px">
                            </th>
                        </tr>
                        <tr>
                            <th colspan="4">
                                <img src="{{ asset('img/cintillo/' . $institucion->banner_2) }}" width="100%" height="60px">
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- final listado red social -->

@endif

@endsection()

@section('complemento-2')
<script src="{{ asset('plugin/jquery-alertable-master/jquery.alertable.js') }}"></script>

<script>

//    Eliminar equipo
var eliminar = function (id) {
    $.alertable.confirm("¿Esta seguro de Eliminar la Red Social?").then(function () {
        window.location.href = id + "/eliminar-red-social";
    });
};
$('#message').show().delay(3000).fadeOut();
</script>
@endsection()