@extends('template.main')
@section('title', 'InfoCentro|Usuario')

@section('complemento', '')
<!-- Jquery Alertable -->
<link href="{{ asset('plugin/jquery-alertable-master/jquery.alertable.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Usuario')
@section('titulo', 'Listado')

@section('buscador')
    {!! Form::open(array('url'=>'user','method'=>'GET','autocomplete'=>'off','role'=>'buscar')) !!}
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="" name="filter" value="">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Buscar</button>
                </span>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection()

@section('content')

<div id="message">
    @include('flash::message')
</div>

    <div class="text-right">
        <div class="btn-group">
        <button data-toggle="dropdown" class="btn btn-warning dropdown-toggle btn-xs" type="button"> Acción <span class="caret"></span>
        </button>
        <ul role="menu" class="dropdown-menu pull-right">
        <li><a href="{{ url('user') }}">Todos</a>
          </li>
          <li><a href="{{ url('user' . '?filter=habilitado') }}">Habilitado</a>
          </li>
          <li><a href="{{ url('user' . '?filter=inhabilitado') }}">Inhabilitado</a>
          </li>
          <li><a href="{{ url('user' . '?filter=administrador') }}">Administrador</a>
          </li>
          <li><a href="{{ url('user' . '?filter=moderador') }}">Moderador</a>
          </li>
        </ul>
        </div>
    </div>
    <br>
<style>
    table thead tr th{
        text-align: center;
        text-transform: uppercase;
    }
</style>
<div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre y Apellido</th>
          <th>Email</th>
          <th>Avatar</th>
          <th>Rol</th>
          <th>Registrado</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>

    @if (count($users) == 0)
        <tr>
            <td colspan="7" rowspan="" headers="">Ningun usuario encontrado...</td>
        </tr>
    @else
      <?php $cont = 1 ?>
      @foreach ($users as $u)
        <tr>
          <th scope="row">{{ $cont }}</th>
          <td>{{ $u->name }}</td>
          <td>{{ $u->email }}</td>
          <td class="text-center"><img class="img-circle" src="{{ asset('img/avatar/' . $u->avatar) }}" alt="avatar" width="50px" height="50px"></td>
          <td>{{ ($u->rol == 1) ? 'Administrador' : 'Moderador'  }}</td>
          <td>{{ Carbon\Carbon::parse($u->created_at)->format('d-m-Y h:i:s A') }}</td>
          @if ($u->id == Auth::user()->id)
              <td class="text-center">-</td>
          @else
              <td class="text-center">
                @if ($u->rol == 0)
                    <a href="#" onclick="accion({{ $u->id }}, 1);"><button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Subir a Administrador"><i class="fa fa-key"></i></button></a>
                @else
                    <a href="#" onclick="accion({{ $u->id }}, 2);") }}"><button type="button" class="btn btn-dark btn-xs" data-toggle="tooltip" data-placement="top" title="Bajar a Moderador"><i class="fa fa-male"></i></button></a>
                @endif    
                    <a href="#" onclick="accion({{ $u->id }}, 3);"><button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Restaurar Contraseña (123456)"><i class="fa fa-refresh"></i></button></a>
                @if ($u->habilitado == 0)
                    <a href="#" onclick="accion({{ $u->id }}, 4);"><button type="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Habilitar"><i class="fa fa-check"></i></button></a>
                 @else
                    <a href="#" onclick="accion({{ $u->id }}, 5);"><button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Inhabilitar"><i class="fa fa-ban"></i></button></a>
                 @endif
              </td>
          @endif
        </tr>
        <?php $cont++ ?>
         @endforeach
     @endif
      </tbody>
    </table>
</div>

    <div class="text-center">
    {{ $users->appends(['filter' => $filter])->render() }}
    </div>

@endsection()

@section('complemento-2')
<!-- Jquery Alertable -->
<script src="{{ asset('plugin/jquery-alertable-master/jquery.alertable.js') }}"></script>

<script>
    //cambio de accion
    var accion = function (id, accion) {
        $.alertable.confirm("¿Esta seguro de realizar este proceso?").then(function () {
            window.location.href = "{{URL::to('accion-user')}}" + "/" + id + "/" + accion;
        });
    };
    //ocultar message
    $('#message').show().delay(3000).fadeOut();
</script>
@endsection()