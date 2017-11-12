@extends('template.main')
@section('title', 'InfoCentro|Actividad')

@section('complemento', '')
<link href="{{ asset('plugin/bootstrap-select-1.12.2/dist/css/bootstrap-select.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/jquery-alertable-master/jquery.alertable.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Actividad')
@section('titulo', 'Listado')
@section('content')

<style>
    td{
        text-align: left;
    }
    th{
        text-align: center;
    }
</style>

<div id="message">
    @include('flash::message')
</div>

@if(count($actividades_prox) == 0 && count($actividades_hoy) == 0)
<p style="font-weight: bold; font-size: 1em">No hay ninguna actividad proxima a realizar...</p>
@else

<!-- Tabla actividades de hoy -->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><b>Actividades del dia</b></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>DESCRIPCION</th>
                            <th>FECHA | HORA</th>
                            <th colspan="2">ACCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($actividades_hoy) == 0)
                        <tr>
                            <td colspan="4">No hay Actividade registradas...</td>
                        </tr>
                        @else
                        @foreach($actividades_hoy as $a)
                        <tr>
                            <td style="width: 26%">{{ $a->nombre }}</td>
                            <td>{{ $a->descripcion }}</td>
                            <td style="width: 26%">
                                <b>Fecha: </b>{{ Carbon\Carbon::parse($a->fecha)->format('d-m-Y') }}<br>
                                <b>Hora_Inicio: </b>{{ Carbon\Carbon::parse($a->hora_inicio)->format('h:i A') }}<br>
                                <b>Hora_Salida: </b>{{ Carbon\Carbon::parse($a->hora_salida)->format('h:i A') }}
                            </td>
                            <td class="text-center" style="width: 20%">
                                <a href="{{ route('actividad.edit', $a->id) }}"><button type="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button></a>
                                <a href="{{ url('actividad/' . $a->id) }}"><button type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Asignar Miembros"><i class="fa fa-user"></i></button></a>
                                <a href="{{ route('ficha_actividad', $a->id) }}" target="_blank"><button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="PDF"><i class="fa fa-file-pdf-o"></i></button></a>
                                <a href="#" onclick="eliminar('{{$a->id}}')"><button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-trash-o"></i></button></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- final actividades de hoy  -->


<!-- Tabla proximas a realizar -->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><b>Proximas a realizar</b></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>DESCRIPCION</th>
                            <th>FECHA | HORA</th>
                            <th colspan="2">ACCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($actividades_prox) == 0)
                        <tr>
                            <td colspan="4">No hay Actividade registradas...</td>
                        </tr>
                        @else
                        @foreach($actividades_prox as $a)
                        <tr>
                            <td style="width: 26%">{{ $a->nombre }}</td>
                            <td>{{ $a->descripcion }}</td>
                            <td style="width: 26%">
                                <b>Fecha: </b>{{ Carbon\Carbon::parse($a->fecha)->format('d-m-Y') }}<br>
                                <b>Hora_Inicio: </b>{{ Carbon\Carbon::parse($a->hora_inicio)->format('h:i A') }}<br>
                                <b>Fecha_Salida: </b>{{ Carbon\Carbon::parse($a->hora_salida)->format('h:i A') }}
                            </td>
                            <td class="text-center" style="width: 20%">
                                <a href="{{ route('actividad.edit', $a->id) }}"><button type="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button></a>
                                <a href="{{ url('actividad/' . $a->id) }}"><button type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Asignar Miembros"><i class="fa fa-user"></i></button></a>
                                <a href="{{ route('ficha_actividad', $a->id) }}" target="_blank"><button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="PDF"><i class="fa fa-file-pdf-o"></i></button></a>
                                <a href="#" onclick="eliminar('{{$a->id}}')"><button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-trash-o"></i></button></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- final proximas a realizar -->

@endif

@endsection()

@section('complemento-2')
<script src="{{ asset('plugin/bootstrap-select-1.12.2/dist/js/bootstrap-select.js') }}"></script>
<script src="{{ asset('plugin/jquery-alertable-master/jquery.alertable.js') }}"></script>

<script>
    //Eliminar equipo
    var eliminar = function (id) {
    $.alertable.confirm("¿Esta seguro de Eliminar la Red Social?").then(function () {
    window.location.href = id + "/destroy/actividad";
    });
    };
    $('#message').show().delay(3000).fadeOut();
</script>
@endsection()