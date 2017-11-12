@extends('template.main')
@section('title', 'InfoCentro|Personal')

@section('complemento', '')
<link href="{{ asset('template/iCheck/skins/flat/green.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/bootstrap-select-1.12.2/dist/css/bootstrap-select.css') }}" rel="stylesheet">
<!-- DatePicker-->
<link href="{{ asset('plugin/datepicker/css/datepicker.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Personal')
@section('titulo', 'Editar')
@section('content')

<div class="alert alert-danger col-md-9 col-sm-9 col-xs-12 col-md-offset-1 col-sm-offset-1" id="message-error" role="alert" style="display: none">
    <strong id="error"></strong>
</div>

<div class="clearfix"></div>

<div class="form-horizontal form-label-left">

    {!! Form::open(['route' => ['personal.update', $personal->id], 'method' => 'put', 'files' => true, 'id' => 'formulario']) !!}
    
    {{ Form::hidden('id', $personal->id) }}

    <div style="display: none; visibility: hidden">
        {!! Form::text('condicion_img', $personal->imagen) !!}
    </div>
    <div class="text-center">
        <img src="{{ asset('img/usu_per/' . $personal->imagen) }}" alt="personal" class="img-thumbnail" width="200px" height="200px">
    </div><br>

    <div class="form-group">
        {!! Html::decode(Form::label('cargo','Cargo:', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class='col-md-6 col-sm-6 col-xs-12'>
          {!! Form::select('cargo_id', ['1' => 'Personal', '2' => 'Usuario'], $personal->cargo_id, ['class' => 'form-control selectpicker']) !!}
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('cedula','Cedula: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('cedula', $personal->cedula, ['class' => 'form-control has-feedback-left', 'placeholder' => 'V-26956889', 'required', 'id' => 'cedula','maxlength=12', 'minlength=10', "onkeypress = 'return validar(event)'", "onpaste = 'return false'", "onchange='UpperTrim(this.id)'"]) !!}
            <span class="fa fa-reorder form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('nombre','Nombre: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('nombre', $personal->nombre, ['class' => 'form-control has-feedback-left', 'placeholder' => 'Pedro', 'required', 'id' => 'nombre', 'maxlength' => 45, "onpaste = 'return false'", "onkeypress = 'return soloLetras(event)'", "onchange='UpperTrim(this.id)'"]) !!}
            <span class="fa fa-user form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('apellido','Apellido: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('apellido', $personal->apellido, ['class' => 'form-control has-feedback-left', 'placeholder' => 'Doe', 'required', 'id' => 'apellido', 'maxlength' => 45, "onpaste = 'return false'", "onkeypress = 'return soloLetras(event)'", "onchange='UpperTrim(this.id)'"]) !!}
            <span class="fa fa-user form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('genero','Genero: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            <p>
                @if($personal->genero == 'M')
                Masculino:
                <input type="radio" class="flat" name="genero" id="generoM" value="M" checked="" required />
                Femenino:
                <input type="radio" class="flat" name="genero" id="generoF" value="F" />
                @else
                Masculino:
                <input type="radio" class="flat" name="genero" id="generoM" value="M" required />
                Femenino:
                <input type="radio" class="flat" name="genero" id="generoF" value="F" checked=""/>
                @endif
            </p>
        </div>
    </div>

    <?php $fecha = Carbon\Carbon::parse($personal->fecha_nac)->format('d-m-Y'); ?>

    <div class="item form-group">
        {!! Html::decode(Form::label('fecha_nac','Fecha de Nacimiento: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('fecha_nac', $fecha, ['class' => 'form-control has-feedback-left datepicker', 'required', 'id' => 'fecha_nac', 'readonly']) !!}
            <span class="fa fa-circle-o-notch form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('email','Correo Electronico: <span class="required"></span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::email('email', $personal->email, ['class' => 'form-control has-feedback-left', 'placeholder' => 'pedrodoe@gmail.com', 'id' => 'email', "onpaste = 'return false'", "onchange='UpperTrim(this.id)'"]) !!}
            <span class="fa fa-envelope form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('telefono','Telefono: <span class="required"></span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('telefono', $personal->telefono, ['class' => 'form-control has-feedback-left', 'placeholder' => '04265172508', 'id' => 'telefono', "maxlength=11", "minlength=11", "onpaste = 'return false'",  "onKeyPress='return SoloNumeros(event);'"]) !!}
            <span class="fa fa-mobile form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('direccion','Direccion de habitacion: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
             {{ Form::textarea('direccion', $personal->direccion, ['class' => 'form-control', 'placeholder' => 'Sector Padre Chacin', 'required', 'id' => 'direccion', 'rows' => 2, "onpaste = 'return false'", "onchange='UpperTrim(this.id)'"]) }}
        </div>
    </div>

    <div class="item form-group">
        {!! Form::label('imagen', null, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::file('imagen', ["accept='image/*'"]) !!}
        </div>
    </div>
    @if(count($rs) != 0)
    <div class="form-group">
        {!! Html::decode(Form::label('redsocial','Redes Sociales:', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}

        <div class='col-md-5 col-sm-5 col-xs-12'>
            <select class="selectpicker form-control has-feedback-left" multiple data-actions-box="true" data-live-search="true" id="sel" onchange="habilitar()">
                @foreach($rs as $red_social)
                <option data-tokens="{{ $red_social->nombre }}" value="{{ $red_social->id . '-' . $red_social->tipo }}">{{ $red_social->nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="button" class="btn btn-info col-md-1 col-sm-1 col-xs-12" onclick="agregar_rs()" disabled="" id="añadir">Añadir</button>
    </div>
    <br>
    @endif

    <style>
        .oculto{
            visibility: hidden;
            display: none;
        }
    </style>

    @if(count($rs_per) != 0)
    <div class="text-center" id="titulo_rs">
        @else
        <div class="text-center oculto" id="titulo_rs">
            @endif
            <h4><b>REDES SOCIALES</b></h4>
            <hr style="width: 50%; border: 1px solid #169F85; margin-top: 0">
        </div>

        <div class="clearfix"></div>

        <!-- Aqui indico si el personal es diferente de cero, entro en este condicional-->
        @if(count($rs_per) != 0)
        <?php $cont = 0; ?>
        @foreach($rs_per as $per)

        <div id='{{ $per->nombre . $cont }}'>
            <input style='display: none; visibility: hidden' type='text' name='id_red_social[]' value='{{ $per->id }}'>
        </div>
        <div id='{{ $per->nombre . $cont }}'>
            <div class='item form-group'>
                <label for='male' class='control-label col-md-3 col-sm-3 col-xs-12'>{{ $per->nombre }}</label>
                <div class='col-md-5 col-sm-5 col-xs-12'>

                    @if ($per->tipo == 'url')
                        <input type='url' name='url_red_social[]' id='{{ $cont }}' value="{{ $per->url }}" class='form-control has-feedback-left' required="" maxlength="255" onpaste="return false" onchange="UpperTrim(this.id)">
                    @elseif ($per->tipo == 'text_num')
                        <input type='text' name='url_red_social[]' id='{{ $cont }}' value="{{ $per->url }}" class='form-control has-feedback-left' required="" maxlength="255" onpaste="return false" onchange="UpperTrim(this.id)">
                    @else
                        <input type='text' name='url_red_social[]' id='{{ $cont }}' value="{{ $per->url }}" class='form-control has-feedback-left' required="" maxlength="255" onpaste="return false" onKeyPress="return SoloNumeros(event)">
                    @endif

                    <span class='fa fa-unlink form-control-feedback left'></span>
                </div>
                <button type='button' id='{{ $per->nombre . $cont }}' onclick='eliminar(this.id)' class='btn btn-round btn col-md-1 col-sm-1 col-xs-12' title='eliminar'><i class='fa fa-close'></i></button>
            </div>
        </div>

        <?php $cont++; ?>

        @endforeach

        <!-- Aqui insertare mis redes sociales -->
        <div id="inputdinamico">
        </div>

        @else
        <!-- Aqui insertare mis redes sociales -->
        <div id="inputdinamico">
        </div>
        @endif

        <br>
        <div class="form-group text-center">
            <a href="{{ url('personal') }}"><button type="button" class="btn btn-danger">Regresar</button></a>
            {!! Form::reset('Reset', ['class' => 'btn btn-default']) !!}
            {!! Form::submit('Actualizar', ['class' => 'btn btn-success']) !!}
        </div>

        {!! Form::close() !!}
    </div>

    @endsection()

    @section('complemento-2')
    <script src="{{ asset('template/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('plugin/bootstrap-select-1.12.2/dist/js/bootstrap-select.js') }}"></script>
    <!-- DatePicker-->
    <script src="{{ asset('plugin/datepicker/js/bootstrap-datepicker.js') }}"></script>
    <!-- Validacion -->
    <script src="{{ asset('js/validation.js') }}"></script>

    <script>
        $('#message').show().delay(3000).fadeOut();
         //Validar cedula / solo numeros y un guion / el guion para menor usuarios que no tengan cedula - usan representante
        function validar(e){
          tecla = (document.all) ? e.keyCode : e.which;
          tecla = String.fromCharCode(tecla)
          return /^[0-9\-\Vv\Ee]+$/.test(tecla);
        }

        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
        });
        //function para agregar redes sociales
        var cont = 0;
        function agregar_rs() {
            $('#titulo_rs').removeClass('oculto');
            var x = document.getElementById("sel");

            for (var i = 0; i < x.options.length; i++) {
                if (x.options[i].selected == true) {
                    var auxiliar_tipo = x.options[i].value.split('-');
                    var tipo = auxiliar_tipo[1];
                    var id = auxiliar_tipo[0];
                    //alert(x.options[i].value + ' ' + x.options[i].text);
                    //var count = $('#sel option:selected').length;
                    // //Aqui estara el id de la red social
                    var a = "<div id='demo-" + cont + "'><input style='display: none; visibility: hidden' type='text' name='id_red_social[]' value='" + id + "'>";
                    $("#inputdinamico").append(a);
                    //Aqui la URL de la red Social
                    if (tipo == 'url') {
                    var b = "<div id='demo-" + cont + "'><div class='item form-group'><label for='male' class='control-label col-md-3 col-sm-3 col-xs-12'>" + x.options[i].text + "</label><div class='col-md-5 col-sm-5 col-xs-12'><input type='url' name='url_red_social[]' id='rs-" + cont + "' class='form-control has-feedback-left' required maxlength='255' onchange='UpperTrim(this.id)'><span class='fa fa-unlink form-control-feedback left'></span></div><button type='button' id='demo-" + cont + "' onclick='eliminar(this.id)' class='btn btn-round btn col-md-1 col-sm-1 col-xs-12' data-toggle='tooltip' data-placement='top' title='eliminar'><i class='fa fa-close'></i></button></div></div>";
                    } else if(tipo == 'num'){
                        var b = "<div id='demo-" + cont + "'><div class='item form-group'><label for='male' class='control-label col-md-3 col-sm-3 col-xs-12'>" + x.options[i].text + "</label><div class='col-md-5 col-sm-5 col-xs-12'><input type='text' name='url_red_social[]' id='rs-" + cont + "' class='form-control has-feedback-left' required maxlength='255' onpaste='return false' onchange='UpperTrim(this.id)' onKeyPress='return SoloNumeros(event)'><span class='fa fa-unlink form-control-feedback left'></span></div><button type='button' id='demo-" + cont + "' onclick='eliminar(this.id)' class='btn btn-round btn col-md-1 col-sm-1 col-xs-12' data-toggle='tooltip' data-placement='top' title='eliminar'><i class='fa fa-close'></i></button></div></div>";
                    }else{
                        var b = "<div id='demo-" + cont + "'><div class='item form-group'><label for='male' class='control-label col-md-3 col-sm-3 col-xs-12'>" + x.options[i].text + "</label><div class='col-md-5 col-sm-5 col-xs-12'><input type='text' name='url_red_social[]' id='rs-" + cont + "' class='form-control has-feedback-left' required maxlength='255' onpaste='return false' onchange='UpperTrim(this.id)'><span class='fa fa-unlink form-control-feedback left'></span></div><button type='button' id='demo-" + cont + "' onclick='eliminar(this.id)' class='btn btn-round btn col-md-1 col-sm-1 col-xs-12' data-toggle='tooltip' data-placement='top' title='eliminar'><i class='fa fa-close'></i></button></div></div>";
                    }
                    //Original
                    //var b = "<div id='demo-" + cont + "'><div class='item form-group'><label for='male' class='control-label col-md-3 col-sm-3 col-xs-12'>" + x.options[i].text + "</label><div class='col-md-5 col-sm-5 col-xs-12'><input type='text' name='url_red_social[]' id='" + tipo + "' class='form-control has-feedback-left'><span class='fa fa-unlink form-control-feedback left'></span></div><button type='button' id='demo-" + cont + "' onclick='eliminar(this.id)' class='btn btn-round btn col-md-1 col-sm-1 col-xs-12' data-toggle='tooltip' data-placement='top' title='eliminar'><i class='fa fa-close'></i></button></div></div>";
                    $("#inputdinamico").append(b);
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
        }
        //funcion para eliminar red social
        function eliminar(a) {
            $("#" + a + "").remove();
            $("#" + a + "").remove();
            //$("#" + a + "").remove();
            var e = document.getElementsByName("url_red_social[]");
            if (e.length == 0) {
                $('#titulo_rs').addClass('oculto');
            }
        }
        //Update date - ajax
        $("#formulario").submit(function (e) {
            var data = new FormData(this);
            var token = $("input[name=_token]").val();
            var route = "{{ url('personal/' . $personal->id) }}";

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
                            if (data.cargo == 1){
                                document.location.href = "{{ url('personal') }}/" + data.id;
                            }else{
                                document.location.href = "{{ url('usuario') }}/" + data.id;
                            }
                        }
                    },
                    error: function (data) {
                    //Aqui estoy mostrando el mensaje de los request / Con echat estoy haciendo un recorrido al data.responseJSON
                    $('#responseJSON').remove();
                    $('#message-error').append("<div id='responseJSON'></div>");
                        $.each(data.responseJSON, function() {
                          $.each(this, function(k, v) {
                            $('#responseJSON').append('<span>-'+v+'</span><br>');
                            $("#message-error").fadeIn();
                            if (data.status == 422) {
                                console.clear();
                            }
                          });
                        });
                    },
                });
           e.preventDefault(); //Evitamos que se mande del formulario de forma convencional
        });
        //Agregando atributos a la navbar para que este activa
        $('#componentes-ul-per').attr('style','display: block');
        $("#componentes-li-per").addClass("active");
    </script>
    @endsection()