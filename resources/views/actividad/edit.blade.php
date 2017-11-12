@extends('template.main')
@section('title', 'InfoCentro|Actividad')

@section('complemento', '')
<link href="{{ asset('template/iCheck/skins/flat/green.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/datepicker/css/datepicker.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/chosen/chosen.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Actividad')
@section('titulo', 'Editar')
@section('content')


<div class="form-horizontal form-label-left">

    {!! Form::open(['route' => ['actividad.update', $actividad], 'method' => 'put']) !!}

    <div class="item form-group">
        {!! Html::decode(Form::label('Nombre','Nombre: <span class="requiredulaed">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('nombre', $actividad->nombre, ['class' => 'form-control has-feedback-left', 'placeholder' => 'Charla de Tecnologia', 'required', 'id' => 'cedula']) !!}
            <span class="fa fa-reorder form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('descripcion','Descripcion: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea name="descripcion" rows="2" cols="30" class="form-control has-feedback-left" placeholder="Explicacion sobre el impacto de la tecnologia en la sociedad actual...">{{ $actividad->descripcion }}</textarea>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('fecha','Fecha: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::date('fecha', $actividad->fecha, ['class' => 'form-control has-feedback-left']) !!}
            <span class="fa fa-user form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('hora-inicio','Hora de Inicio: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::time('hora_inicio', $actividad->hora_inicio, ['class' => 'form-control has-feedback-left', 'min' => '00:00', 'max' => '24:00']) !!}
            <span class="fa fa-user form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('hora-salida','Hora de Salida: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::time('hora_salida', $actividad->hora_salida, ['class' => 'form-control has-feedback-left', 'min' => '00:00', 'max' => '24:00']) !!}
            <span class="fa fa-user form-control-feedback left"></span>
        </div>
    </div>

    <div class="form-group text-center">
        {!! Form::button('Regresar', ['class' => 'btn btn-danger', 'onclick' => 'history.back()']) !!}
        {!! Form::reset('Reset', ['class' => 'btn btn-default']) !!}
        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    </div>


    {!! Form::close() !!}
</div>

@endsection()

@section('complemento-2')
<script src="{{ asset('template/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('plugin/datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugin/chosen/chosen.jquery.js') }}"></script>

<script>
$('.datepicker').datepicker({
    format: 'yyyy/mm/dd',
});
﻿  $(".chosen-brigadista").chosen({
    placeholder_text_multiple: 'seleccione a un brigadista.',
    //max_selected_options: '3',
    no_results_text: 'Brigadista no encontrado.'
});
﻿  $(".chosen-comunidad").chosen({
    placeholder_text_multiple: 'seleccione los usuarios de la comunidad.',
    //max_selected_options: '3',
    no_results_text: 'Usuario no encontrado.'
});
$(".chosen-facilitador").chosen({
    no_results_text: 'Facilitador no encontrado.',
});

</script>
@endsection()