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

<div class="form-horizontal form-label-left">

<div class="text-center">
    <img src="{{ asset('img/register-equipo.png') }}" alt="Register-equipo" width="200px" height="200px">
</div>

<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-1 col-sm-offset-1">
    @include('template.partials.errors')
</div>
<div class="clearfix"></div>

    {!! Form::open(['route' => 'equipo.store', 'method' => 'post', 'files' => true]) !!}

    <div class="item form-group">
        {!! Html::decode(Form::label('equipo','Equipo: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::number('numero', null, ['class' => 'form-control has-feedback-left', 'placeholder' => '1', 'required','min' => '1', 'max' => '100', "onkeypress = 'return SoloNumeros(event)';'", "onpaste='return false'"]) !!}
            <span class="fa fa-reorder form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('estatus','Estatus: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            <p>
                Habilitado:
                <input type="radio" class="flat" name="estatus" id="generoM" value="1" checked="" required />
                Inhabilitado:
                <input type="radio" class="flat" name="estatus" id="generoF" value="0" / required="">
            </p>
        </div>
    </div>

    @if (count($componentes) > 0)
        <div class="form-group">
            {!! Html::decode(Form::label('Componentes','Componentes:', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}

            <div class='col-md-6 col-sm-6 col-xs-12'>
                <select name="componente_id[]" class="selectpicker form-control has-feedback-left" multiple data-actions-box="true" data-live-search="true" required="">
                    <optgroup label="Componentes Externos">
                        @foreach ($componentes as $c)
                            @if ($c->condicion == true)
                                    <option data-tokens="{{ $c->periferico . ' ' . $c->serial . ' ' . $c->marca . ' ' . $c->modelo }}" value="{{ $c->id }}">{{ $c->periferico . ' ' . $c->serial . ' ' . $c->marca . ' ' . $c->modelo }}</option>
                            @endif
                        @endforeach
                    </optgroup>

                    <optgroup label="Componentes Internos">
                        @foreach ($componentes as $c)
                            @if ($c->condicion == false)
                                    <option data-tokens="{{ $c->periferico . ' ' . $c->serial . ' ' . $c->marca . ' ' . $c->modelo }}" value="{{ $c->id }}">{{ $c->periferico . ' ' . $c->serial . ' ' . $c->marca . ' ' . $c->modelo }}</option>
                            @endif
                        @endforeach
                    </optgroup>
                </select>
            </div>
        </div>
    @endif

    <br>
    <div class="form-group text-center">
        {!! Form::button('Regresar', ['class' => 'btn btn-danger', 'onclick' => 'history.back()']) !!}
        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    </div>


    {!! Form::close() !!}
</div>

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
 {{-- Validation input --}}
<script src="{{ asset('js/validation.js') }}"></script>

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