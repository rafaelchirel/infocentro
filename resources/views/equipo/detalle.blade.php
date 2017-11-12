@extends('template.main')
@section('title', 'InfoCentro|Equipo')

@section('complemento', '')
<link href="{{ asset('plugin/jquery-alertable-master/jquery.alertable.css') }}" rel="stylesheet">
 <!-- jQuery -->
<script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
@endsection()

@section('header', 'Equipo')
@section('titulo', 'Detalle')

@section('content')

<div id="message">
    @include('flash::message')
</div>

<style>
    .titulo {
        text-align: center;
        font-size: 1.5em;
        font-weight: bold;
        border-bottom: 1px solid #00aeef;
    }
</style>

@foreach($equipo as $e)

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-10 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-1">
    <div class="pricing" style="height: 50px;">
        <div class="title">
            <h2>Equipo Nro. {{ $e->numero }}</h2>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-footer">
            <div class="table-responsive">
                <table style="width:100%">
                    <tr>
                        <th class="text-center">ESTATUS</th>
                        <th class="text-center">CONDICIÓN</th>
                    </tr>
                    <tr>
                        <td class="text-center">{{ $e->estatus == 1 ? 'Habilitado' : 'Inhabilitado' }}</td>
                        <td class="text-center">{{ $e->condicion == 1 ? 'Disponible' : 'No Disponible' }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <div style="margin-top: 3%; border-top: 2px solid #00aeef; padding-top: 2%;">
                                <a href="{{ url('equipo') }}"><button type="button" class="btn btn-default btn-xs">Regresar</button></a>
                                <a href="{{ route('ficha_equipo', $e->id) }}" target="_blank"><button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="PDF"><i class="fa fa-file-pdf-o"></i></button></a>
                                <a href="{{ route('equipo.edit', $e->id) }}"><button type="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button></a>
                                @if($e->estatus == 1)
                                <a href="#" onclick="inhabilitar('{{ $e->id }}')"><button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Inhabilitar"><i class="fa fa-ban"></i></button></a>
                                @else
                                <a href="#" onclick="habilitar('{{ $e->id }}')"><button type="button" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Habilitar"><i class="fa fa-check-circle"></i></button></a>
                                @endif
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
<div class="clearfix"></div>

<?php
$cont = 0;
?>

<h1 class="titulo">COMPONENTES EXTERNOS</h1>
@if(count($compo_ext) == 0)
<p> Este equipo no tiene componentes externos</p>
@else

@foreach($compo_ext as $e)
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="4" class="text-uppercase">{{ $e->periferico }}</th>
                <th colspan="1" class="text-right" style="border-left: hidden;">
                        <a href="{{ url('componente-detalle/' . $e->comp_id) }}" title="{{ $e->periferico }}"><button type="button" class="btn btn-primary btn-xs">Ver detalles</button></a> 
                         <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target=".modal-{{ $cont }}">Estatus</button> 
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

@include('equipo.modal-estatu')

<?php
$cont++;
?>
@endforeach

@endif

<div class="clearfix"></div>

<h1 class="titulo">COMPONENTES INTERNOS</h1>
@if(count($compo_int) == 0)
<p> Este equipo no tiene componentes externos</p>
@else

@foreach($compo_int as $e)
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="4" class="text-uppercase">{{ $e->periferico }}</th>
                <th colspan="1" class="text-right" style="border-left: hidden;">
                    <a href="{{ url('componente-detalle/' . $e->comp_id) }}" title="{{ $e->periferico }}"><button type="button" class="btn btn-primary btn-xs">Ver detalles</button></a> 
                   <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target=".modal-{{ $cont }}">Estatus</button> 
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

@include('equipo.modal-estatu')

<?php
$cont++;
?>
@endforeach

@endif

@endsection()

@section('complemento-2')

 {{-- Validation input --}}
 <script src="{{ asset('js/validation.js') }}"></script>
 
<script>
    //   Inhabilitar equipo
    var inhabilitar = function (id) {
    $.alertable.confirm("¿Esta seguro de Inhabilitar el equipo?").then(function () {
    window.location.href = "{{ url('/') }}/" + id + "/inhabilitar-equipo";
    });
    };
    //    Habilitar equipo
    var habilitar = function (id) {
    $.alertable.confirm("¿Esta seguro de Habilitar el equipo?").then(function () {
    window.location.href = "{{ url('/') }}/" + id + "/habilitar-equipo";
    });
    };
    //    Eliminar equipo
    var eliminar = function (id) {
    $.alertable.confirm("¿Esta seguro de Eliminar el registro?").then(function () {
    window.location.href = "{{ url('/') }}/" + id + "/destroy";
    });
    };
    $('#message').show().delay(3000).fadeOut();

    //Agregando atributos a la navbar para que este activa
        $('#componentes-ul-equ').attr('style','display: block');
        $("#componentes-li-equ").addClass("active");
        $("#componentes-li-2-equ").addClass("current-page");
</script>
@endsection()