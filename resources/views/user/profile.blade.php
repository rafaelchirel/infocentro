@extends('template.main')
@section('title', 'InfoCentro|Usuario')

@section('complemento', '')
<!-- Jquery Alertable -->
<link href="{{ asset('plugin/jquery-alertable-master/jquery.alertable.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Usuario')
@section('titulo', 'Mi Perfil')

@section('content')

<div id="message">
    @include('flash::message')
</div>

<style>
 table tr td{
    border-bottom: hidden;
 }
 table {
    text-transform: uppercase;
 } 
 #name{
    font-size: 20px;
    font-weight: bold;
    font-family: arial;
 }     
</style> 

<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
   <div class="panel panel-info">
      <div class="panel-heading text-center" id="name">{{ Auth::user()->name }}</div>
      <div class="panel-body">
        
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center">
            <img src="{{ asset('img/avatar/' . $user->avatar) }}" alt="avatar" width="100px" height="100px" class="img-circle">
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
        <div class="table-responsive">
            <table class="table">
            <thead>
              <tr>
                <th>Email:</th>
                <td>{{ $user->email }}</td>
              </tr>
              <tr>
                <th>Rol:</th>
                <td>{{ ($user->rol == 1) ? 'Administrador' : 'Moderador' }}</td>
              </tr>
              <tr>
                <th>Habilitado:</th>
                <td>{{ ($user->habilitado == 1) ? 'Habilitado' : 'Inhabilitado' }}</td>
              </tr>
              <tr>
                <th>Pregunta:</th>
                <td>{{ $user->pregunta }}</td>
              </tr>
               <tr>
                <th>Respuesta:</th>
                <td>{{ $user->respuesta }}</td>
              </tr>
              <tr>
                <th>Registrado:</th>
                <td>{{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y h:i:s A') }}</td>
              </tr>
               <tr>
                <th>Actualizado:</th>
                  <td>{{ Carbon\Carbon::parse($user->updated_at )->format('d-m-Y h:i:s A') }}</td>
              </tr>
            </thead>
          </table>
          </div>
        </div>
      

      </div>
      <div class="panel-footer text-center">
            <a href="{{ route('user.edit', $user->id ) }}"><button type="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button></a>
            @if ($user->habilitado == true)
              <a href="#" onclick="accion( {{ $user->id }} );"><button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Darme de Baja"><i class="fa fa-thumbs-o-down"></i></button></a>
            @endif
      
      </div>
    </div>
</div>
   
</div>
@endsection()

@section('complemento-2')
<!-- Jquery Alerable-->
<script src="{{ asset('plugin/jquery-alertable-master/jquery.alertable.js') }}"></script>

<script>
    //cambio de accion
    var accion = function (id) {
        $.alertable.confirm("¿Esta seguro que desea darse de baja?").then(function () {
            window.location.href = "{{URL::to('darme-de-baja')}}" + "/" + id ;
        });
    };
    //ocultar message
    $('#message').show().delay(3000).fadeOut();
</script>
@endsection()