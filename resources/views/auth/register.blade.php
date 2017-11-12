<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesion | Registrar</title>
  <!-- CSRF-->
  <meta name="csrf_token" content="{{ csrf_token() }}">
  <!-- Icono navegacion -->
  <link rel="shortcat icon" href="{{ asset('img/ico_infocentro.png') }}">

  <link href='{{ asset('login-register/fonts.googleapis/fonts.googleapis.css') }}' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="{{ asset('login-register/normalize/normalize.css') }}">
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
    </style>
  
</head>

<body style="background: #FFFFFF; margin: 0;">

  <img src="{{ asset('img/cintillo.png') }}" alt="cintillo-InfoCentro" width="100%">
  <img src="{{ asset('img/InfocentroWeb_Banner.gif') }}" alt="banner-InfoCentro" width="100%" style="box-shadow: 10px 10px 5px #888888;">

  <div class="form">
      
      <ul class="tab-group">
        <li class="tab" id="login"><a href="{{ url('/login') }}">Iniciar sesion</a></li>
        <li class="tab active"><a href="#signup">Registrar</a></li>
      </ul>
      
      <div class="tab-content">

        <div id="signup">   
          <!--<h1>Sign Up for Free</h1>-->
          
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}"  enctype="multipart/form-data">
              {{ csrf_field() }}

          <div class="field-wrap">
            @if (!$errors->has('name') && !$errors->has('email') && !$errors->has('password') && !$errors->has('pregunta') && !$errors->has('respuesta') && !$errors->has('avatar'))
            <label>
              Nombre y Apellido<span class="req">*</span>
            </label>
            @endif
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autocomplete="off"/>
            @if ($errors->has('name'))
                    <strong class="message">{{ $errors->first('name') }}</strong>
            @endif
          </div>

          <div class="field-wrap">
                @if (!$errors->has('name') && !$errors->has('email') && !$errors->has('password') && !$errors->has('pregunta') && !$errors->has('respuesta') && !$errors->has('avatar'))
            <label>
              Correo Electronico<span class="req">*</span>
            </label>
          @endif
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="off"/>
            @if ($errors->has('email'))
                   <strong class="message">{{ $errors->first('email') }}</strong>
            @endif
          </div>
          
          <div class="field-wrap">
            <label>
              Contraseña<span class="req">*</span>
            </label>
            <input type="password" name="password" id="password" required autocomplete="off"/>
             @if ($errors->has('password'))
                    <strong class="message">{{ $errors->first('password') }}</strong>
            @endif
          </div>

          <div class="field-wrap">
            <label>
              Confirmar Contraseña<span class="req">*</span>
            </label>
            <input type="password" name="password_confirmation" id="password-confirm" required autocomplete="off"/>
          </div>

           <div class="field-wrap">
                   @if (!$errors->has('name') && !$errors->has('email') && !$errors->has('password') && !$errors->has('pregunta') && !$errors->has('respuesta') && !$errors->has('avatar'))
            <label>
              Pregunta<span class="req">*</span>
            </label>
            @endif
            <input type="text" name="pregunta" id="pregunta" value="{{ old('pregunta') }}" required autocomplete="off"/>
            @if ($errors->has('pregunta'))
                <strong class="message">{{ $errors->first('pregunta') }}</strong>
            @endif
          </div>

          <div class="field-wrap">
                   @if (!$errors->has('name') && !$errors->has('email') && !$errors->has('password') && !$errors->has('pregunta') && !$errors->has('respuesta') && !$errors->has('avatar'))
            <label>
              Respuesta<span class="req">*</span>
            </label>
            @endif
            <input type="text" name="respuesta" id="respuesta" value="{{ old('respuesta') }}" required autocomplete="off"/>
            @if ($errors->has('respuesta'))
                    <strong class="message">{{ $errors->first('respuesta') }}</strong>
            @endif
          </div>
              
              <h1 style="text-align: left; margin: 0; font-size: 18px;">AVATAR</h1>
            <div class="field-wrap">
            <input type="file" name="avatar" id="avatar" autocomplete="off"/>
             @if ($errors->has('avatar'))
                <strong class="message">{{ $errors->first('avatar') }}</strong>
              @endif
          </div>
          
           <button type="submit" class="button button-block">Registrarse</button>
          
          </form>

        </div>
        
    <div id="login"> 
    <!-- Form Login - view login -->  
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
   $('#login').click(function(){
      window.location.href='login';
    });
  </script>
</body>
</html>
