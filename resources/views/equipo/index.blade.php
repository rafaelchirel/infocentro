@extends('template.main')
@section('title', 'InfoCentro|Equipo')

@section('complemento', '')
<link href="{{ asset('plugin/jquery-alertable-master/jquery.alertable.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Equipo')
@section('titulo', 'Listado')

@section('content')

<div id="message">
    @include('flash::message')
</div>

<style>
    th, td {
        text-align: center;
    }
</style>

<!-- Tabla Equipos Habilitados -->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><b>Equipos Habilitados</b></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        @if(count($habilitado) < 1)
        <p>Cero equipos habilitados</p>
        @else
        <div class="x_content">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Nro.Equipo</th>
                            <th>Estatus</th>
                            <th>Condicion</th>
                            <th colspan="2">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($habilitado as $e)
                        <tr>
                            <th scope="row">{{ $e->numero }}</th>
                            <td>{{ $e->estatus == 1 ? "Habilitado" : "Inhabilitado" }}</td>
                            <td>
                                @if($e->condicion == 1)
                                <span class="label label-success">Disponible</span>
                                @else
                                <span class="label label-danger">No Disponible</span>
                                @endif
                            </td>
                            <td class="text-center" style="width: 25%">
                                <a href="{{ route('equipo.show', $e->id) }}"><button type="button" class="btn btn-primary btn-xs">Detalles</button></a>
                                <a href="{{ route('equipo.edit', $e->id) }}"><button type="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button></a>
                                @if($e->condicion == 1)
                                <a href="#" onclick="inhabilitar('{{ $e->id }}')"><button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Inhabilitar"><i class="fa fa-ban"></i></button></a>
                                @else
                                <a href="#" class="disabled"><button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Inhabilitar"><i class="fa fa-ban"></i></button></a>
                                <style>
                                    .disabled {
                                        pointer-events: none;
                                        cursor: default;
                                        opacity: 0.6;
                                    }
                                </style>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- final Tabla Equipos habilitados -->
<div class="clearfix"></div>

<!-- Tabla Equipos Inhabilitados -->
<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 3%">
    <div class="x_panel">
        <div class="x_title">
            <h2><b>Equipos Inhabilitados</b></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        @if(count($inhabilitado) < 1)
        <p>Cero equipos inhabilitados</p>
        @else
        <div class="x_content">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Nro.Equipo</th>
                            <th>Estatus</th>
                            <th>Condicion</th>
                            <th colspan="2">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inhabilitado as $e)
                        <tr>
                            <th scope="row">{{ $e->numero }}</th>
                            <td>{{ $e->estatus == 1 ? "Habilitado" : "Inhabilitado" }}</td>
                            <td>
                                @if($e->condicion == 1)
                                <span class="label label-success">Disponible</span>
                                @else
                                <span class="label label-danger">No Disponible</span>
                                @endif
                            </td>
                            <td class="text-center" style="width: 25%">
                                <a href="{{ route('equipo.show', $e->id) }}"><button type="button" class="btn btn-primary btn-xs">Detalles</button></a>
                                <a href="{{ route('equipo.edit', $e->id) }}"><button type="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button></a>
                                <a href="#" onclick="habilitar('{{ $e->id }}')"><button type="button" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Habilitar"><i class="fa fa-check-circle"></i></button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- final Tabla Equipos Inhabilitados -->

<div class="text-center">
</div>

@endsection()

@section('complemento-2')
<script src="{{ asset('plugin/jquery-alertable-master/jquery.alertable.js') }}"></script>

<script>
    //   Inhabilitar equipo
    var inhabilitar = function (id) {
    $.alertable.confirm("¿Esta seguro de Inhabilitar el equipo?").then(function () {
    window.location.href = id + "/inhabilitar-equipo";
    });
    };
    //    Habilitar equipo
    var habilitar = function (id) {
    $.alertable.confirm("¿Esta seguro de Habilitar el equipo?").then(function () {
    window.location.href = id + "/habilitar-equipo";
    });
    };
    //    Eliminar equipo
    var eliminar = function (id) {
    $.alertable.confirm("¿Esta seguro de Eliminar el registro?").then(function () {
    window.location.href = id + "/destroy";
    });
    };
    $('#message').show().delay(3000).fadeOut();
    //Agregando atributos a la navbar para que este activa
    $('#componentes-ul-equ').attr('style','display: block');
    $("#componentes-li-equ").addClass("active");
    $("#componentes-li-2-equ").addClass("current-page");
</script>
@endsection()