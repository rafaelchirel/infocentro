@extends('template.main')
@section('title', 'InfoCentro|Cintillo')

@section('complemento', '')
@endsection()

@section('header', 'Cintillo')
@section('titulo', 'Editar')
@section('content')

<div class="form-horizontal form-label-left">
    <style>
        .oculto{
            display: none;
            visibility: hidden;
        }
        .banner{
            margin: 1% 0 1% 0;
            border-bottom: 3px solid #0088cc;
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
        }
    </style>

    {!! Form::open(['route' => ['institucion.update', $institucion], 'method' => 'put', 'files' => true]) !!}

    <div class="item form-group">
        {!! Html::decode(Form::label('nombre','Nombre: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('nombre', $institucion->nombre, ['class' => 'form-control has-feedback-left', 'placeholder' => 'Padre Chacin', 'required', 'id' => 'nombre', 'maxlength=20',  "onpaste='return false'", "onclick='UpperTrim(this.id)'"]) !!}
            <span class="fa fa-reorder form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('codigo','Codigo: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('codigo', $institucion->codigo, ['class' => 'form-control has-feedback-left', 'placeholder' => 'Gua14', 'required', 'id' => 'codigo', 'maxlength=20',  "onpaste='return false'", "onclick='UpperTrim(this.id)'"]) !!}
            <span class="fa fa-reorder form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('direccion','Direccion: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea class="form-control" rows="3" name="direccion" id="direccion" required="" maxlength="46" onpaste="return false" onclick="UpperTrim(this.id)">{{ $institucion->direccion }}</textarea>
        </div>
    </div>
    <!-- Banner Nro.1 -->
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
            <h4 class="banner">Banner Nro.1</h4>
        </div>
    </div>

    <div class="oculto text-center " id="img-muestra1">
        <img id="imgSalida" class="img-thumbnail" width="500px" height="30px" src="" />
    </div>

    <div class="text-center " id="img_1">
        <img id="img-original-1" class="img-thumbnail" width="500px" height="30px" src="{{ asset('img/cintillo/' . $institucion->banner_1) }}" />
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('alternativa','Alternativa:', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            <label><small>Imagen Original </small><input type="radio" checked="" value="1" id="img-org-1" onclick="imgoriginal(this.value)"></label>
        </div>
    </div>

    <div class="item form-group">
        {!! Form::label('imagen', null, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::file('banner_1', ['id' => 'file-input1']) !!}
        </div>
    </div>
    <!-- Fin Banner Nro.1 -->

    <!-- Banner Nro.2 -->
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
            <h4 class="banner">Banner Nro.2</h4>
        </div>
    </div>

    <div class="oculto text-center " id="img-muestra2">
        <img id="imgSalida2" class="img-thumbnail" width="500px" height="30px" src="" />
    </div>

    <div class="text-center " id="img_2">
        <img id="img-original-2" class="img-thumbnail" width="500px" height="30px" src="{{ asset('img/cintillo/' . $institucion->banner_2) }}" />
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('alternativa','Alternativa:', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            <label><small>Imagen Original </small><input type="radio" checked="" value="2" id="img-org-2" onclick="imgoriginal(this.value)"></label>
        </div>
    </div>

    <div class="item form-group">
        {!! Form::label('imagen', null, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::file('banner_2', ['id' => 'file-input2']) !!}
        </div>
    </div>
    <!-- Fin Banner Nro.1 -->

    <br>

    <div class="clearfix"></div>

    <div class="form-group text-center">
        <a href="{{ url('institucion') }}"><button type="button" class="btn btn-danger">Regresar</button></a>
        {!! Form::reset('Reset', ['class' => 'btn btn-default']) !!}
        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    </div>


    {!! Form::close() !!}
</div>
@endsection()

@section('complemento-2')

 {{-- Validation input --}}
<script src="{{ asset('js/validation.js') }}"></script>

<script>
    function imgoriginal(id) {
        $('#img_' + id).removeClass('oculto');
        $('#img-muestra' + id).addClass('oculto');
        document.getElementById("file-input" + id).value = null;
    }

    $(window).load(function () {

        $(function () {
            $('#file-input1').change(function (e) {
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
                $('#img_1').addClass('oculto');
                $('#img-muestra1').removeClass('oculto');
                document.getElementById("img-org-1").checked = false;
            }
        });
    });


    $(window).load(function () {

        $(function () {
            $('#file-input2').change(function (e) {
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
                $('#imgSalida2').attr("src", result);
                $('#img_2').addClass('oculto');
                $('#img-muestra2').removeClass('oculto');
                document.getElementById("img-org-2").checked = false;
            }
        });
    });
</script>
@endsection()