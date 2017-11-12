<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesion | Registrar</title>
  <!-- CSRF-->
  <meta name="csrf_token" content="{{ csrf_token() }}">
  <!-- Icono navegacion -->
  <link rel="shortcat icon" href="{{ asset('img/ico_infocentro.png') }}">
  <!-- Template / Form -->
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
        <li class="tab active"><a href="#login">Iniciar sesion</a></li>
        <li class="tab" id="registrar"><a href="{{ url('/register') }}">Registrar</a></li>
      </ul>
      
      <div class="tab-content">

         <div id="login">   
          <h1>Bienvenido!</h1>
          
           <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
           {{ csrf_field() }}
          
            <div class="field-wrap">
               @if (!$errors->has('email') && !$errors->has('password'))
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
               @if (!$errors->has('password'))
              <label>
                Contraseña<span class="req">*</span>
              </label>
               @endif
              <input type="password" name="password" id="password" required autocomplete="off"/>
              @if ($errors->has('password'))
              <strong class="message">{{ $errors->first('password') }}</strong>
              @endif
            </div>

          <p class="forgot"><a href="{{ url('reset') }}">Recuperar Contraseña?</a></p>
          
           <button type="submit" class="button button-block">Iniciar sesión</button>
          
          </form>

        </div>

        <div id="signup">   
          <!--<h1>Form Register  - view </h1>-->
        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <!-- jQuery -->
  <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('template/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <!-- script login-register -->
  <script  src="{{ asset('login-register/js/index.js') }}"></script>
  
  <script>
    $('#registrar').click(function(){
      window.location.href='register';
    });
  </script>
</body>
</html>
