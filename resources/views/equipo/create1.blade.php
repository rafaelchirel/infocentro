@extends('template.main')
@section('title', 'InfoCentro|Equipo')

@section('complemento', '')
<!-- CheckList -->
<link href="{{ asset('template/iCheck/skins/flat/green.css') }}" rel="stylesheet">
<!--  DataPicker -->
<link href="{{ asset('plugin/datepicker/css/datepicker.css') }}" rel="stylesheet">
<!-- BoostrapSelect -->
<link href="{{ asset('plugin/bootstrap-select-1.12.2/dist/css/bootstrap-select.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Equipo')
@section('titulo', 'Registrar')
@section('content')

<!-- Smart Wizard -->
{!! Form::open(['route' => 'equipo.store', 'method' => 'post', 'files' => true]) !!}
<div id="wizard" class="form_wizard wizard_horizontal">
    <ul class="wizard_steps">
        <li>
            <a href="#step-1">
                <span class="step_no">1</span>
                <span class="step_descr">
                    Paso 1<br />
                    <small>Registrar Equipo</small>
                </span>
            </a>
        </li>
        <li>
            <a href="#step-2">
                <span class="step_no">2</span>
                <span class="step_descr">
                    Paso 2<br />
                    <small>Comp. Externos</small>
                </span>
            </a>
        </li>
        <li>
            <a href="#step-3">
                <span class="step_no">3</span>
                <span class="step_descr">
                    Paso 3<br />
                    <small>Comp. Internos</small>
                </span>
            </a>
        </li>
    </ul>

    <!-- Aqui estoy insertando el Numero del equipo - en forma visible-->
    <p class="text-center" id="nro_equipo" style="font-size: 2em; text-transform: uppercase"></p>

    <div id="step-1">
        <div class="form-horizontal form-label-left" style="overflow-y: hidden; overflow-x: hidden;">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Numero de Equipo<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="nombre_equipo" name="numero_equipo" onkeyup="equipo(this.value)" required="required" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="status" name="status" class="form-control" required>
                        <option value="1">Habilitado</option>
                        <option value="0">Inhabilitado</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div id="step-2">

        <h2 class="text-center">Componentes Externos</h2>

        <div class="form-group">
            <div class='col-md-5 col-sm-5 col-xs-12 col-md-offset-3 col-sm-offset-3'>
                <select class="selectpicker form-control" multiple data-actions-box="true" data-live-search="true" id="sel" onchange="habilitar()">
                    @foreach($componentes as $c)
                    @endforeach()
                </select>
            </div>
            <button type="button" class="btn btn-info col-md-1 col-sm-1 col-xs-12" onclick="agregar_componente()" disabled="" id="añadir">Añadir</button>
        </div>
        <br>

        <div class="form-horizontal form-label-left" style="height: 45em;">

            <style>
                .titulo{
                    display: inline;
                    text-align: center;
                    vertical-align: text-top;
                }
                .eliminar{
                    vertical-align: text-top;
                }
            </style>

            <!-- Aqui insertare mis redes sociales -->
            <div id="inputdinamico">
            </div>

            <!--
            Esto es un modelo de plantilla en el script
                        <div class='form-group col-md-6' style='padding-bottom: 1%; margin-top: 2%;'>
                            <div class='col-md-12 col-sm-12 col-xs-12' style="border-bottom: 1px solid #00b3ee;">
                                <div class="col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                                    <h1 class="titulo">Monitor</h1>
                                    <button type="button" class="btn btn-dark btn-sm eliminar" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button>
                                </div>
                            </div>
                            <label class='col-md-12 col-sm-12 col-xs-12' for='marca'>Marca<span class='required'>*</span></label>
                            <div class='col-md-12 col-sm-12 col-xs-12'>
                                <input type='text' id='marca' name='marca[]' required='required' class='form-control col-md-7 col-xs-12'>
                            </div>
                            <label class='col-md-12 col-sm-12 col-xs-12' for='modelo'>Modelo<span class='required'>*</span></label>
                            <div class='col-md-12 col-sm-12 col-xs-12'>
                                <input type='text' id='modelo' name='modelo' required='required' class='form-control col-md-7 col-xs-12'>
                            </div>
                            <label class='col-md-12 col-sm-12 col-xs-12' for='serial'>Serial<span class='required'>*</span></label>
                            <div class='col-md-12 col-sm-12 col-xs-12'>
                                <input type='text' id='serial' name='serial' required='required' class='form-control col-md-7 col-xs-12'>
                            </div>
                            <label class='col-md-12 col-sm-12 col-xs-12' for='descripcion'>Descripcion<span class='required'>*</span></label>
                            <div class='col-md-12 col-sm-12 col-xs-12'>
                                <textarea id='descripcion' name='descripcion' rows='2' cols='30' class='form-control col-md-7 col-xs-12'></textarea>
                            </div>
                            <label class='col-md-12 col-sm-12 col-xs-12' for='imagen'>imagen<span class='required'>*</span></label>
                            <div class='col-md-12 col-sm-12 col-xs-12'>
                                <input type='file' id='imagen' name='imagen' required='required' class='form-control col-md-7 col-xs-12'>
                            </div>
                        </div>
            -->

            <!-- </form> -->
        </div>
    </div>

    <div id="step-3">
        <h2 class="text-center">Componentes Internos</h2>

        <div class="form-group">
            <div class='col-md-5 col-sm-5 col-xs-12 col-md-offset-3 col-sm-offset-3'>
                <select class="selectpicker form-control" multiple data-actions-box="true" data-live-search="true" id="list_comp_interno" onchange="habilitar()">
                    @foreach($componentes as $c)
                    @endforeach()
                </select>
            </div>
            <button type="button" class="btn btn-info col-md-1 col-sm-1 col-xs-12" onclick="agregar_componente_interno()" disabled="" id="añadir_comp_inter">Añadir</button>
        </div>
        <br>

        <div class="form-horizontal form-label-left" style="height: 45em;">

            <!-- Aqui insertare mis redes sociales -->
            <div id="inputdinamico_comp_interno">
            </div>
        </div>

    </div>
</div>
{!! Form::close() !!}
<!-- End SmartWizard Content -->



@endsection()

@section('complemento-2')
<!--asset para los radio button -->
<script src="{{ asset('template/iCheck/icheck.min.js') }}"></script>
<!--asset para las fechas en jquery -->
<script src="{{ asset('plugin/datepicker/js/bootstrap-datepicker.js') }}"></script>
<!--asset para el formulario wirzard -->
<script src="{{ asset('template/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }} "></script>
<!--asset para el boostrap select-->
<script src="{{ asset('plugin/bootstrap-select-1.12.2/dist/js/bootstrap-select.js') }}"></script>

<style>
    .oculto{
        visibility: hidden;
        display: none;
    }
</style>

<script>
                $('.datepicker').datepicker({
                    format: 'yyyy/mm/dd',
                });
                //funcion para visualizar Nro.de equipo en todo el formulario wizard
                ﻿function equipo(id) {
                    if (id.trim() != '') {
                        $('#nro_equipo').removeClass('oculto');
                        document.getElementById("nro_equipo").innerHTML = 'Nro. de Equipo: ' + id;
                    } else {
                        $('#nro_equipo').addClass('oculto');
                    }
                }
                //function para agregar redes sociales
                var cont = 0;
                function agregar_componente() {
                    var x = document.getElementById("sel");

                    for (var i = 0; i < x.options.length; i++) {
                        if (x.options[i].selected == true) {
                            //declaro mis variables a utilizar
                            var id = x.options[i].value;
                            var nombre = x.options[i].text;
                            // //Aqui estara el id oculto del componente
                            var a = "<div id='demo-" + cont + "'><input style='display: none; visibility: hidden' type='text' name='id_componente[]' value='" + id + "'>";
                            $("#inputdinamico").append(a);
                            //Aqui estara el nombre y los demas input vacios para insertar los datos de componentes
                            var b = "<div id='demo-" + cont + "'><div class='form-group col-md-6' style='padding-bottom: 1%; margin-top: 2%;'> <div class='col-md-12 col-sm-12 col-xs-12' style='border-bottom: 1px solid #00b3ee;'> <div class='col-md-offset-4 col-sm-offset-4 col-xs-offset-4'> <h1 class='titulo'>" + nombre + "</h1> <button type='button' id='demo-" + cont + "' onclick='eliminar(this.id)' class='btn btn-dark btn-sm eliminar' title='Eliminar'><span class='glyphicon glyphicon-remove'></span></button> </div></div><label class='col-md-12 col-sm-12 col-xs-12' for='marca'>Marca<span class='required'>*</span></label> <div class='col-md-12 col-sm-12 col-xs-12'> <input type='text' id='marca' name='marca[]' required='required' class='form-control col-md-7 col-xs-12'> </div><label class='col-md-12 col-sm-12 col-xs-12' for='modelo'>Modelo<span class='required'>*</span></label> <div class='col-md-12 col-sm-12 col-xs-12'> <input type='text' id='modelo' name='modelo[]' required='required' class='form-control col-md-7 col-xs-12'> </div><label class='col-md-12 col-sm-12 col-xs-12' for='serial'>Serial<span class='required'>*</span></label> <div class='col-md-12 col-sm-12 col-xs-12'> <input type='text' id='serial' name='serial[]' required='required' class='form-control col-md-7 col-xs-12'> </div><label class='col-md-12 col-sm-12 col-xs-12' for='descripcion'>Descripcion<span class='required'>*</span></label> <div class='col-md-12 col-sm-12 col-xs-12'> <textarea id='descripcion' name='descripcion[]' rows='2' cols='30' class='form-control col-md-7 col-xs-12'></textarea> </div><label class='col-md-12 col-sm-12 col-xs-12' for='imagen'>imagen<span class='required'>*</span></label> <div class='col-md-12 col-sm-12 col-xs-12'> <input type='file' id='imagen' name='imagen[]' required='required' class='form-control col-md-7 col-xs-12'> </div></div></div>";
                            $("#inputdinamico").append(b);
                            cont++;
                        }
                    }
                    $('.selectpicker').selectpicker('deselectAll');
                }
                //Agregar componentes internos
                function agregar_componente_interno() {
                    var x = document.getElementById("list_comp_interno");

                    for (var i = 0; i < x.options.length; i++) {
                        if (x.options[i].selected == true) {
                            //declaro mis variables a utilizar
                            var id = x.options[i].value;
                            var nombre = x.options[i].text;
                            // //Aqui estara el id oculto del componente
                            var a = "<div id='demo-" + cont + "'><input style='display: none; visibility: hidden' type='text' name='id_componente[]' value='" + id + "'>";
                            $("#inputdinamico_comp_interno").append(a);
                            //Aqui estara el nombre y los demas input vacios para insertar los datos de componentes
                            var b = "<div id='demo-" + cont + "'><div class='form-group col-md-6' style='padding-bottom: 1%; margin-top: 2%;'> <div class='col-md-12 col-sm-12 col-xs-12' style='border-bottom: 1px solid #00b3ee;'> <div class='col-md-offset-4 col-sm-offset-4 col-xs-offset-4'> <h1 class='titulo'>" + nombre + "</h1> <button type='button' id='demo-" + cont + "' onclick='eliminar(this.id)' class='btn btn-dark btn-sm eliminar' title='Eliminar'><span class='glyphicon glyphicon-remove'></span></button> </div></div><label class='col-md-12 col-sm-12 col-xs-12' for='marca'>Marca<span class='required'>*</span></label> <div class='col-md-12 col-sm-12 col-xs-12'> <input type='text' id='marca' name='marca[]' required='required' class='form-control col-md-7 col-xs-12'> </div><label class='col-md-12 col-sm-12 col-xs-12' for='modelo'>Modelo<span class='required'>*</span></label> <div class='col-md-12 col-sm-12 col-xs-12'> <input type='text' id='modelo' name='modelo[]' required='required' class='form-control col-md-7 col-xs-12'> </div><label class='col-md-12 col-sm-12 col-xs-12' for='serial'>Serial<span class='required'>*</span></label> <div class='col-md-12 col-sm-12 col-xs-12'> <input type='text' id='serial' name='serial[]' required='required' class='form-control col-md-7 col-xs-12'> </div><label class='col-md-12 col-sm-12 col-xs-12' for='descripcion'>Descripcion<span class='required'>*</span></label> <div class='col-md-12 col-sm-12 col-xs-12'> <textarea id='descripcion' name='descripcion[]' rows='2' cols='30' class='form-control col-md-7 col-xs-12'></textarea> </div><label class='col-md-12 col-sm-12 col-xs-12' for='imagen'>imagen<span class='required'>*</span></label> <div class='col-md-12 col-sm-12 col-xs-12'> <input type='file' id='imagen' name='imagen[]' required='required' class='form-control col-md-7 col-xs-12'> </div></div></div>";
                            $("#inputdinamico_comp_interno").append(b);
                            cont++;
                        }
                    }
                    $('.selectpicker').selectpicker('deselectAll');
                }

                //function para habilitar button agregar
                function habilitar() {
                    var count = $('#sel option:selected').length;
                    if (count == 0) {
                        document.getElementById("añadir").disabled = true;
                    } else {
                        document.getElementById("añadir").disabled = false;
                    }
                    //componentes internos
                    var count = $('#list_comp_interno option:selected').length;
                    if (count == 0) {
                        document.getElementById("añadir_comp_inter").disabled = true;
                    } else {
                        document.getElementById("añadir_comp_inter").disabled = false;
                    }
                }
                //funcion para eliminar componente
                function eliminar(a) {
                    $("#" + a + "").remove();
                    $("#" + a + "").remove();
                    $("#" + a + "").remove();
                }
</script>
@endsection()