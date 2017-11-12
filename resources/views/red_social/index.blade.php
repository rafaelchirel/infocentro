@extends('template.main')
@section('title', 'InfoCentro|Red Social')

@section('complemento', '')
<link href="{{ asset('plugin/bootstrap-select-1.12.2/dist/css/bootstrap-select.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/jquery-alertable-master/jquery.alertable.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Red Social')
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
    <a href="{{ url('red-social/create') }}"><button type="button" class="btn btn-success">Registrar Red Social</button></a>
</div>
<br>

@if(count($red_social) == 0)
<p>No hay ninguna red social registrada...</p>
@else

<!-- Tabla listado red social -->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><b>Redes Sociales</b></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ICONO</th>
                            <th>NOMBRE</th>
                            <th>TIPO</th>
                            <th colspan="2">ACCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($red_social as $rs)
                        <tr>
                            <th scope="row">
                                <img src="{{ asset('img/red_social/' . $rs->icono) }}" width="50px" height="50px">
                            </th>
                            <td>{{ $rs->nombre }}</td>
                            <td>
                                @if($rs->tipo == 'url')
                                <span class="label label-success">URL</span>
                                @elseif($rs->tipo == 'text_num')
                                <span class="label label-primary">Texto | Numero</span>
                                @else
                                <span class="label label-default">Numero</span>
                                @endif
                            </td>
                            <td class="text-center" style="width: 25%">
                                <a href="{{ route('red-social.edit', $rs->id) }}"><button type="button" class="btn btn-info btn-xs">Editar</button></a>
                                <a href="#"  onclick="eliminar('{{$rs->id}}')"><button type="button" class="btn btn-danger btn-xs">Eliminar</button></a>
                            </td>
                        </tr>
                        @endforeach
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
<script src="{{ asset('plugin/bootstrap-select-1.12.2/dist/js/bootstrap-select.js') }}"></script>
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