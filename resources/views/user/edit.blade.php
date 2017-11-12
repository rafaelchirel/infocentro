@extends('template.main')
@section('title', 'InfoCentro|Users')

@section('complemento', '')
{{-- script --}}
@endsection()

@section('header', 'Users')
@section('titulo', 'Editar')
@section('content')

<div class="alert alert-danger col-md-9 col-sm-9 col-xs-12 col-md-offset-1 col-sm-offset-1" id="message-error" role="alert" style="display: none">
    <strong id="error"></strong>
</div>

<div class="clearfix"></div>

<div class="form-horizontal form-label-left">

    <style>
        .oculto{ display: none; visibility: hidden;}
    </style>

     <div class="text-center oculto" id="img-muestra">
        <img id="imgSalida" class="img-circle" alt="avatar-timereal" width="100px" height="100px" src="" />
    </div>

	<div class="text-center" id="img-default">
		<img src="{{ asset('img/avatar/' . $user->avatar ) }}" alt="avatar" width="100px" height="100px" class="img-circle">
	</div>
	<br>

    {!! Form::open(['route' => ['user.update', $user->id], 'method' => 'PUT', 'files' => true, 'id' => 'formulario']) !!}
    
    {{ Form::hidden('id', $user->id) }}
    {{ Form::hidden('avataraux', $user->avatar) }}

    <div class="item form-group">
        {!! Html::decode(Form::label('rol','Rol: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('rol', ($user->rol == 1) ? 'ADMINISTRADOR' : 'MODERADOR', ['class' => 'form-control has-feedback-left', 'required', 'id' => 'rol', 'disabled', "onpaste = 'return false'", "onchange='UpperTrim(this.id)'"]) !!}
            <span class="fa fa-asterisk form-control-feedback left"></span>
        </div>
    </div>

      <div class="item form-group">
        {!! Html::decode(Form::label('habilitado','Habilitado: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('habilitado', ($user->habilitado== 1) ? 'SI' : 'NO', ['class' => 'form-control has-feedback-left', 'required', 'id' => 'habilitado', 'disabled']) !!}
            <span class="fa fa-thumb-tack form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('nombre y apellido','Nombre y Apellido: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('name', $user->name, ['class' => 'form-control has-feedback-left', 'placeholder' => 'Doe Perez', 'required', 'id' => 'name', 'maxlength=255', "onpaste = 'return false'", "onchange='UpperTrim(this.id)'", "onkeypress = 'return soloLetras(event)'"]) !!}
            <span class="fa fa-reorder form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('email','Correo Electronico: <span class="required"></span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::email('email', $user->email, ['class' => 'form-control has-feedback-left', 'placeholder' => 'pedrodoe@gmail.com', 'required', 'maxlength=255', 'id' => 'email', "onpaste = 'return false'", "onchange='UpperTrim(this.id)'"]) !!}
            <span class="fa fa-envelope form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('pregunta','Pregunta: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('pregunta', $user->pregunta, ['class' => 'form-control has-feedback-left', 'placeholder' => '¿Estado donde Nacio?', 'required', 'maxlength=255', 'id' => 'pregunta', "onpaste = 'return false'", "onchange='UpperTrim(this.id)'"]) !!}
            <span class="fa fa-user form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('respuesta','Respuesta: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('respuesta', $user->respuesta, ['class' => 'form-control has-feedback-left', 'placeholder' => 'Guarico', 'required', 'id' => 'respuesta', 'maxlength=255', "onpaste = 'return false'", "onchange='UpperTrim(this.id)'"]) !!}
            <span class="fa fa-user form-control-feedback left"></span>
        </div>
    </div>

    <div class="item form-group">
        {!! Html::decode(Form::label('password','Password: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="password" name="password" id="password" value="" class="form-control has-feedback-left" placeholder="123456" minlength="6" maxlength="255" required="" data-toggle="password">
            <span class="fa fa-lock form-control-feedback left"></span>
        </div>
    </div>

      <div class="item form-group">
        {!! Html::decode(Form::label('password','Confirmar Password: <span class="required">*</span>', ["class" => "control-label col-md-3 col-sm-3 col-xs-12"])) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="password" name="password_confirmation" id="password_confirmation" value="" class="form-control has-feedback-left" placeholder="123456" minlength="6" maxlength="255" required="" data-toggle="password">
            <span class="fa fa-lock form-control-feedback left"></span>
        </div>
    </div>
    
    <div class="item form-group">
        {!! Form::label('Avatar', null, ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::file('avatar', ['id' => 'file-input', "accept='image/*'"]) !!}
        </div>
    </div>

    <br>
    <div class="form-group text-center">
        {!! Form::button('Regresar', ['class' => 'btn btn-danger', 'onclick' => 'history.back()']) !!}
        {!! Form::reset('Reset', ['class' => 'btn btn-default']) !!}
        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
    </div>

    {!! Form::close() !!}
</div>
@endsection()

@section('complemento-2')
<!-- bootstrap-show-password -->
<script src="{{ asset('plugin/bootstrap-show-password/bootstrap-show-password.js') }}"></script>
<!-- Validacion -->
<script src="{{ asset('js/validation.js') }}"></script>

<script>

  //Update date - ajax
    $("#formulario").submit(function (e) {
        var data = new FormData(this);
        var token = $("input[name=_token]").val();
        var route = "{{ route('user.update', $user->id) }}";
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
                        document.location.href = "{{ route('perfil') }}";
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
                            //console.clear();
                        }
                      });
                    });
                },
            });
       e.preventDefault(); //Evitamos que se mande del formulario de forma convencional
    });

    //update image - timereal
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
            $('#img-default').addClass('oculto');
        }
        });
    });
    //Seleccionar imagen y luego dejar vacio input file / Se muestra imagen por default
    $( "#file-input" ).change(function() {
        if($('#file-input').val() === ''){
            $('#img-default').removeClass('oculto');
            $('#img-muestra').addClass('oculto');  
        }
    });
    //Agregando atributos a la navbar para que este activa
    $('#componentes-ul-users').attr('style','display: block');
    $("#componentes-li-users").addClass("active");
    $("#componentes-li-2-users").addClass("current-page");
    //bootstrap-show-password 
    $("#password").password('toggle');

</script>
@endsection()
