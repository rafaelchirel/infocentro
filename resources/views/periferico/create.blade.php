@extends('template.main')
@section('title', 'InfoCentro|Periferico')

@section('complemento', '')
<!-- BoostrapSelect -->
<link href="{{ asset('plugin/bootstrap-select-1.12.2/dist/css/bootstrap-select.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Periferico')
@section('titulo', 'Registrar')
@section('content')

<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-1 col-sm-offset-1">
    @include('template.partials.errors')
</div>

<div class="form-horizontal form-label-left">

    {!! Form::open(['route' => 'perifericos.store', 'method' => 'post']) !!}

    <div class="item form-group">
        {!! Html::decode(Form::label('nombre','Nombre: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('nombre', null, ['class' => 'form-control has-feedback-left', 'placeholder' => 'Procesador', 'required', 'id' => 'nombre',  "onkeypress = 'return soloLetras(event)';", "onpaste='return false'", "onclick='UpperTrim(this.id)'"]) !!}
            <span class="fa fa-reorder form-control-feedback left"></span>
        </div>
    </div>

    <div class="form-group">
        {!! Html::decode(Form::label('condicion','Condicion:', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}

        <div class='col-md-6 col-sm-6 col-xs-12'>
            <select name="condicion" class="selectpicker form-control has-feedback-left" data-live-search="false" data-live-search="false" title="Seleccione un tipo de componente" required="">
                <option data-tokens="Periferico Exterior" value="1">Periferico Exterior</option>
                <option data-tokens="Periferico Interior" value="0">Periferico Interior</option>
            </select>
        </div>
    </div>

    <br>

    <div class="clearfix"></div>

    <div class="form-group text-center">
        <a href="{{ url('perifericos') }}"><button type="button" class="btn btn-danger">Regresar</button></a>
        {!! Form::reset('Reset', ['class' => 'btn btn-default']) !!}
        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    </div>

    {!! Form::close() !!}
</div>
@endsection()

@section('complemento-2')
<!-- BoostrapSelect -->
<script src="{{ asset('plugin/bootstrap-select-1.12.2/dist/js/bootstrap-select.js') }}"></script>
 {{-- Validation input --}}
<script src="{{ asset('js/validation.js') }}"></script>

    <script>
    //
    </script>
@endsection()