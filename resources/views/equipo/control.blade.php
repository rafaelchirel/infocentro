@extends('template.main')
@section('title', 'InfoCentro|Equipo')

@section('complemento', '')
<link href="{{ asset('plugin/jquery-alertable-master/jquery.alertable.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/bootstrap-select-1.12.2/dist/css/bootstrap-select.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Equipo')
@section('titulo', 'Control')

@section('content')


<style>
    p{
        font-weight: bold;
        text-transform: uppercase;
        font-size: 1em;
        font-family: serif;
        color: #000
    }
    .equipo {
        margin: 3% 0 0 0;
        background: white;
    }
    .titulo{
        margin: 0 0 0 0;
        text-decoration: underline;
    }
    .caja_padre{
        width: 200px;
        height: 250px;
        background: tomato;
        border: 1px solid #000;
        text-align: center;
        display: inline-block;
        margin: 1%;
    }
    @media screen and (max-width: 768px) {
        .caja_padre_center{
            text-align: center;
        }
    }

</style>


<div id="message">
    @include('flash::message')
</div>
{!! Form::open(['route' => 'AsignarEquipo', 'method' => 'post']) !!}
<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Html::decode(Form::label('usuario','Usuario:', ["class" => "control-label col-md-12 col-sm-12 col-xs-12 text-center"])) !!}

        <div class='col-md-12 col-sm-12 col-xs-12'>
            @if(count($equipo) > 0 && count($usuarios) > 0)
            <select class="selectpicker form-control has-feedback-left" data-live-search="true" title="Seleccione a un usuario" name="usu_per_id" id="usu_per_id" required="">
                @else
                <select class="selectpicker form-control has-feedback-left" data-live-search="true" title="Seleccione a un usuario" name="usu_per_id" id="usu_per_id" required="" disabled="">
                    @endif
                    @foreach($usuarios as $u)
                    <option data-tokens="{{ $u->nombre . ' ' . $u->apellido . ' ' . $u->cedula }}" value="{{ $u->id }}" id="{{ $u->id }}">{{ $u->cedula . ' ' . $u->nombre . ' ' . $u->apellido  }}</option>
                    @endforeach
                </select>
        </div>
    </div>

    <div class="col-md-4 col-sm-4 col-xs-12">
        {!! Html::decode(Form::label('equipo','Equipo:', ["class" => "control-label col-md-12 col-sm-12 col-xs-12 text-center"])) !!}

        <div class='col-md-12 col-sm-12 col-xs-12'>
            @if(count($equipo) > 0 && count($usuarios) > 0)
            <select class="selectpicker form-control has-feedback-left" data-live-search="true" title="Seleccione un equipo" name="equipo_id" id="equipo_id" required="">
                @else
                <select class="selectpicker form-control has-feedback-left" data-live-search="true" title="Seleccione un equipo" name="equipo_id" id="equipo_id" required="" disabled="">
                    @endif
                    @foreach($equipo as $e)
                    <option data-tokens="{{ $e->numero }}" value="{{ $e->id }}">{{ $e->numero }}</option>
                    @endforeach
                </select>
        </div>
    </div>

    <div class="col-md-2 col-sm-2 col-xs-12">
        <br>
        @if(count($equipo) > 0 && count($usuarios) > 0)
        <button type="submit" class="btn btn-info col-md-12 col-sm-12 col-xs-12">Asignar</button>
        @else
        <button type="submit" class="btn btn-info col-md-12 col-sm-12 col-xs-12" disabled="">Asignar</button>
        @endif

    </div>
</div>
{!! Form::close() !!}
<div class="clearfix"></div>

@if(count($control_maquina) > 0)

<div style="margin-top: 2%; border-top: 2px solid #00aeef; margin-bottom: 2%;"></div>

<div class="clearfix"></div>

<h2 class="text-center"><b>EQUIPOS ASIGNADOS</b></h2>

@else
<div style="margin-top: 2%; border-top: 2px solid #00aeef; margin-bottom: 2%;"></div>
<h5 style="margin-top: 2%;">No hay Equipos asignados...</h5>
@endif

<div class="caja_padre_center" id="caja_padre_center">
    @foreach($control_maquina as $cm)
    <div class="caja_padre">
        <input type="text" value="{{ $cm->id_u }}" name="id_u" style="display: none; visibility: hidden">
        <p class="equipo">Equipo Nro.{{ $cm->numero }}</p>
        <img src="{{ asset('/img/equipo-control.png') }}" width="80px" height="80px">
        <p class="titulo">USUARIO</p>
        <p>{{ $cm->nombre . ' ' . $cm->apellido }}</p>
        <p class="titulo">TIEMPO CONSUMIDO</p>
        <?php
        $date = Carbon\Carbon::now('America/Manaus');
        ?>
        <p>{{ $date->format('H')-Carbon\Carbon::parse($cm->entrada)->format('H') }} Hor : {{ $date->format('i')-Carbon\Carbon::parse($cm->entrada)->format('i') }} Min</p>

        <a href="#" onclick="FinalizarEquipo({{ $cm->id_cm . ',' . $cm->id_e }})"><button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Finalizar"><i class="fa fa-circle"></i></button></a>
    </div>
    @endforeach
</div>
<div id="demo"></div>

@endsection()

@section('complemento-2')
<!--asset ventana alert-->
<script src="{{ asset('plugin/jquery-alertable-master/jquery.alertable.js') }}"></script>
<!--asset para el boostrap select-->
<script src="{{ asset('plugin/bootstrap-select-1.12.2/dist/js/bootstrap-select.js') }}"></script>

<script>
///   Finalizar equipo-usuario
            var FinalizarEquipo = function (id_cm, id_e) {
                $.alertable.confirm("¿Esta seguro de finalizar el equipo?").then(function () {
                window.location.href = id_cm + "/" + id_e + "/FinalizarEquipo";
                });
            };

            $('#message').show().delay(3000).fadeOut();

            //actualizando pagina - actualizar tiempo consumido usuario-equipo
            var int = self.setInterval("refresh()", 60000);
            function refresh()
            {
                location.reload(true);
            }
            //disable select option usuario
            var elementos = document.getElementsByName("id_u");
            for (x = 0; x < elementos.length; x++){
            $("#" + elementos[x].value + "").remove();
            //document.getElementById(elementos[x].value).disabled = true;
            }

            //Disabled select / Usuario - Equipo == 0
            var x = document.getElementById("usu_per_id").length;
            var y = document.getElementById("equipo_id").length;
            if (x == 0 || y == 0) {
                $("usu_per_id").attr('disabled', true);
                $("equipo_id").attr('disabled', true);
            }
</script>
@endsection()