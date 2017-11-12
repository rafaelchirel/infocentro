@extends('template.main')
@section('title', 'InfoCentro|Componente')

@section('complemento', '')
<!--  boostrapSelect -->
<link href="{{ asset('plugin/bootstrap-select-1.12.2/dist/css/bootstrap-select.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Componente')
@section('titulo', 'Registrar')
@section('content')



<div class="form-horizontal form-label-left">

<img src=" {{ url('img/componentes.jpg') }} " alt="componentes_walppaper" width="100%" height="200px">

<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-1 col-sm-offset-1">
    @include('template.partials.errors')
</div>
<div class="clearfix"></div>

    {!! Form::open(['route' => 'componente.store', 'method' => 'post', 'files' => true]) !!}

    <div class="form-group">
        {!! Html::decode(Form::label('periferico','Periferico:', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class='col-md-6 col-sm-6 col-xs-12'>
          {!! Form::select('periferico_id', $perifericos, null, ['class' => 'form-control selectpicker', 'required', 'maxlength = 100']) !!}
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('marca','Marca: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('marca', null, ['class' => 'form-control has-feedback-left', 'placeholder' => 'HP', 'required', 'id' => 'marca', "onkeypress = 'return soloLetras(event)';'", "onpaste='return false'", "onclick='UpperTrim(this.id)'"]) !!}
            <span class="fa fa-reorder form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('modelo','Modelo: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('modelo', null, ['class' => 'form-control has-feedback-left', 'placeholder' => 'HP L1710', 'required', 'id' => 'modelo', "onpaste='return false'", "onclick='UpperTrim(this.id)'"]) !!}
            <span class="fa fa-user form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('serial','Serial: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('serial', null, ['class' => 'form-control has-feedback-left', 'placeholder' => '1855655LP', 'required', "autocomplete='off'", 'id' => 'serial', "onpaste='return false'", "onclick='UpperTrim(this.id)'", "onKeyPress='return SoloNumeros(event);'"]) !!}
            <span class="fa fa-user form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('descripcion','Descripcion: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => '', 'required', 'id' => 'descripcion', "onpaste='return false'", "onclick='UpperTrim(this.id)'"]) !!}
        </div>
    </div>

     <div class="item form-group">
        {!! Form::label('imagen', null, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::file('imagen',['required', "accept='image/*'"]) !!}
        </div>
    </div>

    <div id="advertencia" class="alert alert-warning col-md-6 col-sm-6 col-xs-12 text-center col-md-offset-3 col-sm-offset-3" style="color: #4F4F4F;">
        <strong>Advertencia!</strong> <br>Una vez registrado este componente, no podra ser editado ni eliminado.
    </div>

    <div class="clearfix"></div>

    <div class="form-group text-center">
        {!! Form::button('Regresar', ['class' => 'btn btn-danger', 'onclick' => 'history.back()']) !!}
        {!! Form::reset('Reset', ['class' => 'btn btn-default']) !!}
        {!! Form::button('Guardar', ['class' => 'btn btn-success', 'onclick' => 'advertencia()', 'id' => 'button']) !!}
        {!! Form::submit('Guardar', ['class' => 'btn btn-success', 'id' => 'submit']) !!}
    </div>

    {!! Form::close() !!}
</div>
@endsection()

@section('complemento-2')
<!--  BoostrapSelect -->
<script src="{{ asset('plugin/bootstrap-select-1.12.2/dist/js/bootstrap-select.js') }}"></script>
{{-- Validation input --}}
<script src="{{ asset('js/validation.js') }}"></script>

<script>
        $('#advertencia').hide();
        $('#submit').hide();

        function advertencia(){
            $('#advertencia').show();
            $('#submit').show();
            $('#button').hide();
        }
</script>
@endsection()