<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Restaurar Contraseña</title>
  <!-- CSRF-->
  <meta name="csrf_token" content="{{ csrf_token() }}">
  <!-- Icono navegacion -->
  <link rel="shortcat icon" href="{{ asset('img/ico_infocentro.png') }}">

  <link rel="stylesheet" href="{{ asset('login-register/css/style.css') }}">
  
   <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- Style -->
    <style>
      .message{
        color: red;
      }
      .oculto{
        display: none; visibility: hidden;
      }
    </style>
  
</head>

<body style="background: #FFFFFF; margin: 0;">

  <img src="{{ asset('img/cintillo.png') }}" alt="cintillo-InfoCentro" width="100%">
  <img src="{{ asset('img/InfocentroWeb_Banner.gif') }}" alt="banner-InfoCentro" width="100%" style="box-shadow: 10px 10px 5px #888888;">

  <div class="form">
      
      <h1>RECUPERAR CONTRASEÑA</h1>

      <p class="forgot"><a href="{{ url('login') }}">Regresar a Login</a></p>

      <ul class="tab-group">
        <li class="tab"><a href="#login">Correo Electronico</a></li>
        <li class="tab active"><a href="#ResetPregunta">Pregunta de seguridad</a></li>
      </ul>
      
      <div class="tab-content">
        
        <!-- Alert Contraseña Restaurada exitosamente -->
        <div id="ContraseñaRestaurada" class="oculto" style="text-align: center;">
          <img src="{{ asset('img/check.png') }}" alt="Contraseñada Restaurada Exitosamente" width="200px" height="200px"> 
          <h1>Contraseñada Restaurada Exitosamente.</h1> 
        </div>
        <!-- / Alert Contraseña Restaurada exitosamente -->


        <div id="ResetPregunta"> 
          <!--<h1>Sign Up for Free</h1>-->
          <div id="ContentResetPregunta">
          
          <form class="form-horizontal" role="form" method="POST" action=""  enctype="multipart/form-data" id="FormPregunta">
              {{ csrf_field() }}

          <div class="field-wrap">
            <label>
              Correo Electronico<span class="req">*</span>
            </label>
            <input type="email" name="email" id="email" value="" required autocomplete="off"/>
              <strong class="message oculto" id="error-email">El Correo electronico indicado no existe.</strong>
          </div>
          
          <div id="pregunta-seguridad" class="oculto">
            <div class="field-wrap">
              <label id="label-pregunta">
                Pregunta<span class="req">*</span>
              </label>
              <input type="text" name="pregunta" id="pregunta" value="" autocomplete="off"/>
            </div>

            <div class="field-wrap">
              <label>
                Respuesta<span class="req">*</span>
              </label>
              <input type="text" name="respuesta" id="respuesta" value="" autocomplete="off"/>
                <strong class="message oculto" id="error-respuesta">Respuesta Incorrecta.</strong>
            </div>
          </div>

          <div id="password-div" class="oculto">
            <div class="field-wrap">
              <label>
                Contraseña<span class="req">*</span>
              </label>
              <input type="password" name="password" id="password" minlength="6" maxlength="255" autocomplete="off"/>
                <strong class="message oculto" id="error-password">Las contraseñas no coinciden.</strong>
            </div>

            <div class="field-wrap">
              <label>
                Confirmar Contraseña<span class="req">*</span>
              </label>
              <input type="password" name="password_confirmation" id="password-confirm" minlength="6" maxlength="255" autocomplete="off"/>
            </div>
          </div> 

           <button type="submit" id="verificar" class="button button-block">VERIFICAR</button>
           <button type="submit" id="procesar" class="button button-block oculto">PROCESAR</button>
           <button type="submit" id="ActualizarContraseña" class="button button-block oculto">ACTUALIZAR CONTRASEÑA</button>
          
          </form>
  
          </div>
        </div>
        
           <div id="login">   
          
          <!-- Alert Contraseña Restaurada exitosamente -->
          <div id="ContraseñaRestauradaViaEmail" class="oculto" style="text-align: center;">
            <img src="{{ asset('img/check.png') }}" alt="Contraseñada Restaurada Exitosamente" width="200px" height="200px"> 
            <h1>Contraseña enviada a su correo electronico Exitosamente.</h1> 
          </div>
          <!-- / Alert Contraseña Restaurada exitosamente -->

          <div  id="FormViaEmail">
             <form class="form-horizontal" role="form" method="POST" action="">
             {{ csrf_field() }}
            
              <div class="field-wrap">
                <label>
                  Correo Electronico<span class="req">*</span>
                </label>
                <input type="email" name="email_pas" id="email_pas" value="" required autocomplete="off"/>
                  <strong class="message oculto" id="error-email_pas">El Correo electronico indicado no existe.</strong>
                   <strong class="message oculto" id="error-email_pas_no_env">Email no enviado. Verifique su conexion a internet</strong>
              </div>
             
             <button type="submit" id="ResetPasViaEmail" class="button button-block">Enviar</button>
            
            </form>
          </div>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <!-- jQuery -->
  <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
  <!-- script login-register -->
  <script  src="{{ asset('login-register/js/index.js') }}"></script>
  
  <script>
   //verificando correo electronico - ajax
    $("#verificar").click(function (e) {
        var email = $('#email').val().trim();
        var token = $("input[name=_token]").val();
        var route = "{{ url('verificar-email') }}"+"/"+email;
          if(email.length == 0){
            return false;
          }
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'get',
                datatype: 'json',
                data: email,
                success: function (data) {
                    $('#pregunta-seguridad').removeClass('oculto');
                    $('#pregunta').val(data.pregunta);
                    $('#label-pregunta').addClass('active');
                    $('#email').prop('disabled', 'true');
                    $('#pregunta').prop('disabled', 'true');
                    $('#verificar').remove();
                    $('#procesar').removeClass('oculto');
                    $('#error-email').addClass('oculto');
                    console.clear();
                },
                error: function (data) {
                    $('#error-email').removeClass('oculto');
                    console.clear();
                },
            });
       e.preventDefault(); //Evitamos que se mande del formulario de forma convencional
    });
     //email / pregunta / respuesta / procesar - ajax
    $("#procesar").click(function (e) {
        var email = $('#email').val().trim();
        var preg  = $('#pregunta').val().trim();
        var resp  = $('#respuesta').val().trim();
        var token = $("input[name=_token]").val();
        var route = "{{ url('procesar-pregunta-seguridad') }}";
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'post',
                datatype: 'json',
                data: {email: email, preg: preg, resp: resp},
                success: function (data) {
                  $('#procesar').remove();
                  $('#ActualizarContraseña').removeClass('oculto');
                  $('#respuesta').prop('disabled',true);
                  $('#password-div').removeClass('oculto');
                  $('#password').prop('required',true);
                  $('#password-confirm').prop('required',true);
                  $('#error-respuesta').addClass('oculto');
                  console.clear();
                },
                error: function (data) {
                  $('#error-respuesta').removeClass('oculto');
                  console.clear();
                },
            });
       e.preventDefault(); //Evitamos que se mande del formulario de forma convencional
    });
     //resetear password - ajax
    $("#ActualizarContraseña").click(function (e) {
        var email    = $('#email').val().trim();
        var preg     = $('#pregunta').val().trim();
        var resp     = $('#respuesta').val().trim();
        var pas      = $('#password').val().trim();
        var conf_pas = $('#password-confirm').val().trim();
        var token    = $("input[name=_token]").val();
        var route    = "{{ url('actualizar-password') }}";

        if(pas != conf_pas){
          $('#error-password').removeClass('oculto');
          return false;
        }
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'post',
            datatype: 'json',
            data: {email: email, preg: preg, resp: resp, pas: pas, conf_pas: conf_pas},
            success: function (data) {
              $('#error-password').addClass('oculto');
              $('#ContraseñaRestaurada').removeClass('oculto');
              $('#ContentResetPregunta').remove();
              setTimeout(function() {
               document.location.href = "{{ url('login') }}";
              }, 3000);
              console.clear();
            },
            error: function (data) {
              //#code
              console.clear();
            },
        });
       e.preventDefault(); //Evitamos que se mande del formulario de forma convencional
    });

     //enviar password via correo electronico - ajax
    $("#ResetPasViaEmail").click(function (e) {
        var email    = $('#email_pas').val().trim();
        var token    = $("input[name=_token]").val();
        var route = "{{ url('recuperar-contrasena-via-email') }}"+"/"+email;
        if(email.length == 0){
            return false;
          }
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'get',
            datatype: 'json',
            data: email,
            success: function (data) {
              $('#ContraseñaRestauradaViaEmail').removeClass('oculto');
              $('#FormViaEmail').remove();
              $('#error-email_pas').addClass('oculto');
              setTimeout(function() {
               document.location.href = "{{ url('login') }}";
              }, 3000);
              console.clear();
            },
            error: function (data) {
              if (data.status == 500){//No hay conexion a internet
                $('#error-email_pas').addClass('oculto');
                $('#error-email_pas_no_env').removeClass('oculto');
                console.clear();
              }
              if (data.responseJSON.email == true){//Correo no encontrado
                $('#error-email_pas').removeClass('oculto');
                $('#error-email_pas_no_env').addClass('oculto');
                console.clear();
              }
            },
        });
       e.preventDefault(); //Evitamos que se mande del formulario de forma convencional
    });
  </script>
</body>
</html>
