@extends('template.main')
@section('title', 'InfoCentro|Equipo')

@section('complemento', '')
<!-- CheckList -->
<link href="{{ asset('template/iCheck/skins/flat/green.css') }}" rel="stylesheet">
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

    {!! Form::open(['route' => ['equipo.update', $equipo], 'method' => 'put']) !!}
    
    {{ Form::hidden('id', $equipo->id) }}

    <div class="item form-group">
        {!! Html::decode(Form::label('equipo','Equipo: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::number('numero', $equipo->numero, ['class' => 'form-control has-feedback-left', 'placeholder' => '1', 'required','min' => '1', 'max' => '100', "onkeypress = 'return SoloNumeros(event)';'", "onpaste='return false'"]) !!}
            <span class="fa fa-reorder form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('estatus','Estatus: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            <p>
                @if ($equipo->estatus == true)
                    Habilitado:
                    <input type="radio" class="flat" name="estatus" id="generoM" value="1" checked="" required />
                    Inhabilitado:
                    <input type="radio" class="flat" name="estatus" id="generoF" value="0" />
                @else
                     Habilitado:
                    <input type="radio" class="flat" name="estatus" id="generoM" value="1"/>
                    Inhabilitado:
                    <input type="radio" class="flat" name="estatus" id="generoF" value="0" checked="" required />
                @endif
               
            </p>
        </div>
    </div>

    @if (count($componentes) > 0)
        <div class="form-group">
            {!! Html::decode(Form::label('Componentes','Componentes:', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}

            <div class='col-md-6 col-sm-6 col-xs-12'>
                <select name="componente_id[]" class="selectpicker form-control has-feedback-left" multiple data-actions-box="true" data-live-search="true">
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
    //Agregando atributos a la navbar para que este activa
    $('#componentes-ul-equ').attr('style','display: block');
    $("#componentes-li-equ").addClass("active");
    $("#componentes-li-2-equ").addClass("current-page");
</script>
@endsection()