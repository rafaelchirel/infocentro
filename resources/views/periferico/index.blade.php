@extends('template.main')
@section('title', 'InfoCentro|Perifericos')

@section('complemento', '')
<link href="{{ asset('plugin/bootstrap-select-1.12.2/dist/css/bootstrap-select.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/jquery-alertable-master/jquery.alertable.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Perifericos')
@section('titulo', 'Listado')
@section('content')

<style>
    th, td{
        text-align: center;
    }
</style>

<div id="message">
    @include('flash::message')
</div>

<div class="text-right">
    <a href="{{ url('perifericos/create') }}"><button type="button" class="btn btn-success">Registrar Periferico</button></a>
</div>
<br>

@if(count($periferico_externo) == 0 && count($periferico_interno) == 0)
<p>No hay ningun periferico registrado...</p>
@else

<!-- Tabla listado componentes externos -->
@if(count($periferico_externo) == 0)
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><b>Perifericos Externos</b></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="table-responsive">
                <p>No se encontro ningun periferico Externo...</p>
            </div>
        </div>
    </div>
</div>
@else
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><b>Perifericos Externos</b></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="40%">NOMBRE</th>
                            <th>CONDICION</th>
                            <th>ACCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($periferico_externo as $c_e)
                        <tr>
                            <td>{{ $c_e->nombre }}</td>
                            <td>
                                <span class="label label-success">Exterior</span>
                            </td>
                            <td class="text-center" style="width: 25%">
                                <a href="{{ route('perifericos.edit', $c_e->id) }}"><button type="button" class="btn btn-info btn-xs">Editar</button></a>
                                @if ($c_e->eliminar == true)
                                    <a href="#"  onclick="eliminar('{{$c_e->id}}')"><button type="button" class="btn btn-danger btn-xs">Eliminar</button></a>
                                @else
                                    <a href="#"><button type="button" disabled="" class="btn btn-danger btn-xs">Eliminar</button></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
<!-- final Tabla listado componentes externos -->


<!-- Tabla listado componentes externos -->
@if(count($periferico_interno) == 0)
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><b>Perifericos Externos</b></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <p>No se encontro ningun periferico Interno...</p>
                </div>
            </div>
        </div>
    </div>
@else
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><b>Perifericos Internos</b></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="40%">NOMBRE</th>
                            <th>CONDICION</th>
                            <th>ACCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($periferico_interno as $c_i)
                        <tr>
                            <td>{{ $c_i->nombre }}</td>
                            <td>
                                <span class="label label-default">Interior</span>
                            </td>
                            <td class="text-center" style="width: 25%">
                                <a href="{{ route('perifericos.edit', $c_i->id) }}"><button type="button" class="btn btn-info btn-xs">Editar</button></a>
                                @if ($c_i->eliminar == true)
                                    <a href="#"  onclick="eliminar('{{$c_i->id}}')"><button type="button" class="btn btn-danger btn-xs">Eliminar</button></a>
                                 @else
                                    <a href="#"><button type="button" disabled="" class="btn btn-danger btn-xs">Eliminar</button></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
<!-- final Tabla listado componentes externos -->

@endif

@endsection()

@section('complemento-2')
<script src="{{ asset('plugin/bootstrap-select-1.12.2/dist/js/bootstrap-select.js') }}"></script>
<script src="{{ asset('plugin/jquery-alertable-master/jquery.alertable.js') }}"></script>

<script>

//    Eliminar equipo
var eliminar = function (id) {
    $.alertable.confirm("¿Esta seguro de Eliminar la Red Social?").then(function () {
        window.location.href = id + "/eliminar";
    });
};
$('#message').show().delay(3000).fadeOut();
</script>
@endsection()