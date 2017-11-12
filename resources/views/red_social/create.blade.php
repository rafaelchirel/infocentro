@extends('template.main')
@section('title', 'InfoCentro|Red Social')

@section('complemento', '')
<link href="{{ asset('plugin/bootstrap-select-1.12.2/dist/css/bootstrap-select.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Red Social')
@section('titulo', 'Registrar')
@section('content')

<div class="form-horizontal form-label-left">
    <style>
        .oculto{
            display: none;
            visibility: hidden;
        }
    </style>

    <div class="oculto text-center " id="img-muestra">
        <img id="imgSalida" class="img-thumbnail" width="150px" height="150px" src="" />
    </div>

    <br>

    <div class="alert alert-danger col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3" id="message-error" role="alert" style="display: none">
        <strong id="error"></strong>
    </div>

    <div class="clearfix"></div>

    {!! Form::open(['route' => 'red-social.store', 'method' => 'post', 'files' => true, "id='formulario'"]) !!}

    <div class="item form-group" id="div-padre-nombre">
        {!! Html::decode(Form::label('nombre','Nombre: *', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12" id="div-hijo-nombre">
            {!! Form::text('nombre', null, ['class' => 'form-control has-feedback-left', 'placeholder' => 'Facebook', 'id' => 'nombre', "onkeypress = 'return soloLetras(event)';'", "onpaste='return false'", 'maxlength = 25', 'required', "onclick='UpperTrim(this.id)'"]) !!}
            <span class="fa fa-reorder form-control-feedback left"></span>
        </div>
    </div>

    <div class="form-group" id="div-padre-tipo">
        {!! Html::decode(Form::label('tipo','Tipo: *', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}

        <div class='col-md-6 col-sm-6 col-xs-12' id="div-hijo-tipo">
            <select name="tipo" id="tipo" class="selectpicker form-control has-fee/dback-left" data-live-search="false" data-live-search="true" title="Seleccione un Elemento" required="">
                <option data-tokens="url" value="url">URL</option>
                <option data-tokens="texto | numero" value="text_num">Texto | Numero</option>
                <option data-tokens="Numerico" value="num">Numerico</option>
            </select>
        </div>
        
    </div>

    <div class="item form-group">
        {!! Form::label('imagen *', null, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::file('icono', ['required', 'id' => 'file-input', 'accept' => 'image/*']) !!}
        </div>
    </div>

    <br>

    <div class="clearfix"></div>

    <div class="form-group text-center">
        <a href="{{ url('red-social') }}"><button type="button" class="btn btn-danger">Regresar</button></a>
        {!! Form::reset('Reset', ['class' => 'btn btn-default']) !!}
        {!! Form::submit('Guardar', ['class' => 'btn btn-success', 'id' => 'btnsubmit', 'onclick' => 'UpperTrim()']) !!}
    </div>

    {!! Form::close() !!}
</div>
@endsection()

@section('complemento-2')
    <script src="{{ asset('plugin/bootstrap-select-1.12.2/dist/js/bootstrap-select.js') }}"></script>
    {{-- Validation input --}}
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

    //insertando datos a travez de ajax
    $("#formulario").submit(function (e) {
        
        var data = new FormData(this);
        var token = $("input[name=_token]").val();
        var route = "{{ route('red-social.store') }}";

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'post',
            datatype: 'json',
            data: data,
            processData: false, //Evitamos que JQuery procese los datos, daría error
            contentType: false, //No especificamos ningún tipo de dato
            success: function (data) {
                if (data.success == 'true') {
                    document.location.href = "{{ url('red-social') }}";
                }
            },
            error: function (data) {
                //Aqui estoy mostrando el mensaje de los request
                $("#error").html(data.responseJSON.nombre);
                $("#message-error").fadeIn();
                if (data.status == 422) {
                    console.clear();
                }
            },
        });
       e.preventDefault(); //Evitamos que se mande del formulario de forma convencional
    });

    </script>
@endsection()