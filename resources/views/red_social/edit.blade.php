@extends('template.main')
@section('title', 'InfoCentro|Red Social')

@section('complemento', '')
<link href="{{ asset('plugin/bootstrap-select-1.12.2/dist/css/bootstrap-select.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Red Social')
@section('titulo', 'Editar')
@section('content')

<div class="form-horizontal form-label-left">

    <div class="text-center " id="img-muestra">
        <img id="imgSalida" class="img-thumbnail" width="150px" height="150px" src="{{ asset('img/red_social/' . $red_social->icono) }}" />
    </div>

    <br>

    <div class="col-md- col-sm-9 col-xs-12 col-md-offset-1 col-sm-offset-1">
        @include('template.partials.errors')
    </div>

    <div class="clearfix"></div>

    {!! Form::open(['route' => ['red-social.update', $red_social], 'method' => 'put', 'files' => true]) !!}
    
    {{ Form::hidden('id', $red_social->id) }}

    <div class="item form-group">
        {!! Html::decode(Form::label('nombre','Nombre: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('nombre', $red_social->nombre, ['class' => 'form-control has-feedback-left', 'placeholder' => 'Facebook', 'required', 'id' => 'nombre', "onkeypress = 'return soloLetras(event)';", "onpaste='return false'", "onclick='UpperTrim(this.id)'"]) !!}
            <span class="fa fa-reorder form-control-feedback left"></span>
        </div>
    </div>

    <div class="form-group">
        {!! Html::decode(Form::label('tipo','Tipo: *', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}

        <div class='col-md-6 col-sm-6 col-xs-12'>
            <select name="tipo" class="selectpicker form-control has-feedback-left" data-live-search="false" data-live-search="false" title="Seleccione un elemento" required="">
                @if($red_social->tipo == 'url')
                <option data-tokens="url" value="url" selected="">URL</option>.
                <option data-tokens="texto | numero" value="text_num">Texto | Numero</option>
                <option data-tokens="Numerico" value="num">Numerico</option>
                @elseif($red_social->tipo == 'text_num')
                <option data-tokens="url" value="url">URL</option>.
                <option data-tokens="texto | numero" value="text_num" selected="">Texto | Numero</option>
                <option data-tokens="Numerico" value="num">Numerico</option>
                @else
                <option data-tokens="url" value="url">URL</option>.
                <option data-tokens="texto | numero" value="text_num">Texto | Numero</option>
                <option data-tokens="Numerico" value="num" selected="">Numerico</option>
                @endif
            </select>
        </div>
    </div>

    <div class="item form-group">
        {!! Form::label('imagen', null, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::file('icono', ['id' => 'file-input']) !!}
        </div>
    </div>

    <input type="text" id="icono_a" name="icono_a" value="{{ $red_social->icono }}" style="display: none; visibility: hidden;">

    <br>

    <div class="clearfix"></div>

    <div class="form-group text-center">
        <a href="{{ url('red-social') }}"><button type="button" class="btn btn-danger">Regresar</button></a>
        {!! Form::reset('Reset', ['class' => 'btn btn-default']) !!}
        {!! Form::submit('Actualizar', ['class' => 'btn btn-success']) !!}
    </div>


    {!! Form::close() !!}
</div>
@endsection()

@section('complemento-2')
<script src="{{ asset('plugin/bootstrap-select-1.12.2/dist/js/bootstrap-select.js') }}"></script>
<script src="{{ asset('js/validation.js') }}"></script>

<script>
$(window).load(function () {

    $(function () {
        $('#file-input').change(function (e) {
            addImage(e);
        });

        function addImage(e) {
            var file = e.target.files[0],
                    imageType = /image.*/;

            if (!file.type.match(imageType))
                return;

            var reader = new FileReader();
            reader.onload = fileOnload;
            reader.readAsDataURL(file);
        }

        function fileOnload(e) {
            var result = e.target.result;
            $('#imgSalida').attr("src", result);
            $('#img-muestra').removeClass('oculto');
        }
    });
});

</script>
@endsection()