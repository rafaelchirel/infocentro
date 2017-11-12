@extends('template.main')
@section('title', 'InfoCentro|Actividad')

@section('complemento', '')
<link href="{{ asset('plugin/jquery-alertable-master/jquery.alertable.css') }}" rel="stylesheet">
<link href="{{ asset('plugin/bootstrap-select-1.12.2/dist/css/bootstrap-select.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Actividad')
@section('titulo', 'Asignar Participantes')

@section('content')


<style>
    p{
        font-weight: bold;
        text-transform: uppercase;
        font-size: 1em;
        font-family: serif;
        color: #000
    }
    .equipo {
        margin: 3% 0 0 0;
        background: white;
    }
    .titulo{
        margin: 0 0 0 0;
        text-decoration: underline;
    }
    .caja_padre{
        width: 200px;
        height: 250px;
        background: tomato;
        border: 1px solid #000;
        text-align: center;
        display: inline-block;
        margin: 1%;
    }
    @media screen and (max-width: 768px) {
        .caja_padre_center{
            text-align: center;
        }
    }
    /*TABLA ACTIVIDAD */
    .tabla_padre th {
        text-align: center;
        background: whitesmoke;
        color: #000;
    }
    .tabla_padre td {
        background: white;
        text-align: left;
    }
    .tabla_padre {
        border-collapse: collapse;
    }
    .actividad{
        margin-top: 4%;
    }

    /*TABLA FACILITADOR */
    .tabla_facilitador th, td {
        text-align: center;
    }
    .tabla_facilitador th {
        background: whitesmoke;
        color: #000;
    }
    .regresar{
        text-align: center;
        margin: 2% 0 0% 0;
    }
</style>


<div id="message">
    @include('flash::message')
</div>

{!! Form::open(['route' => 'AsignarActividad', 'method' => 'post']) !!}
<input type="text" value="{{ $actividad_id }}" name="actividad_id" style="display: none; visibility: hidden">
<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Html::decode(Form::label('participantes','Participantes:', ["class" => "control-label col-md-12 col-sm-12 col-xs-12 text-center"])) !!}

        <div class='col-md-12 col-sm-12 col-xs-12'>
            <select class="selectpicker form-control has-feedback-left" multiple data-actions-box="true" name="miembro[]" id="miembro" title="Seleccione un miembro" data-live-search="true" required="">
                <optgroup label="Personal">
                    @foreach($personal as $p)
                    <option data-tokens="{{ $p->cedula . ' ' .  $p->nombre . ' ' . $p->apellido  }}" value="{{ $p->id }}" id="{{ $p->id }}">{{ $p->cedula . ' ' .  $p->nombre . ' ' . $p->apellido  }}</option>
                    @endforeach
                </optgroup>
                <optgroup label="Usuarios">
                    @foreach($usuario as $u)
                    <option data-tokens="{{ $u->cedula . ' ' .  $u->nombre . ' ' . $u->apellido  }}" value="{{ $u->id }}" id="{{ $u->id }}">{{ $u->cedula . ' ' .  $u->nombre . ' ' . $u->apellido  }}</option>
                    @endforeach
                </optgroup>
            </select>
        </div>
    </div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
    {!! Html::decode(Form::label('cargo','Cargo:', ["class" => "control-label col-md-12 col-sm-12 col-xs-12 text-center"])) !!}

    <div class='col-md-12 col-sm-12 col-xs-12'>
        @if(count($cargo) > 0 && count($usuario) > 0 || count($personal) > 0)
        <select class="selectpicker form-control has-feedback-left" data-live-search="true" name="cargo" id="cargo" title="Seleccione un cargo" required="">
            @else
            <select class="selectpicker form-control has-feedback-left" data-live-search="true" name="cargo" id="cargo" title="Seleccione un equipo" required="" disabled="">
                @endif
                @foreach($cargo as $c)
                <option data-tokens="{{ $c->nombre }}" value="{{ $c->id }}" id="cargo_{{ $c->id }}">{{ $c->nombre }}</option>
                @endforeach
            </select>
    </div>
</div>

<div class="col-md-2 col-sm-2 col-xs-12">
    <br>
    @if(count($cargo) > 0 && count($usuario) > 0 || count($personal) > 0)
    <button type="submit" class="btn btn-info col-md-12 col-sm-12 col-xs-12" id="asignar">Asignar</button>
    @else
    <button type="submit" class="btn btn-info col-md-12 col-sm-12 col-xs-12" disabled="">Asignar</button>
    @endif
</div>

{!! Form::close() !!}
<div class="clearfix"></div>

<div class="regresar">
    <a href="{{ url('actividad') }}"><button type="button" class="btn btn-default btn-xs col-md-2 col-sm-2 col-xs-12 col-lg-offset-5 col-md-offset-5 col-sm-offset-5">Regresar</button></a>
</div>
<div class="clearfix"></div>

<!-- NOMBRE ACTIVIDAD-->
<div class="actividad" style="margin-top: 1%">
    <div class="table-responsive">
        <table class="table table-bordered tabla_padre">
            <thead>
                <tr>
                    <th style="background: #98cbe8" colspan="4">ACTIVIDAD</th>
                </tr>
                <tr>
                    <th>NOMBRE</th>
                    <th>DESCRIPCION</th>
                    <th>FECHA | HORA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 40%">{{ $actividad->nombre }}</td>
                    <td style="width: 40%">{{ $actividad->descripcion }}</td>
                    <td style="width: 20%">
                        <b>Fecha: </b>{{ Carbon\Carbon::parse($actividad->fecha)->format('d-m-Y') }}<br>
                        <b>Hora_Inicio: </b>{{ Carbon\Carbon::parse($actividad->hora_inicio)->format('h:i A') }}<br>
                        <b>Fecha_Salida: </b>{{ Carbon\Carbon::parse($actividad->hora_salida)->format('h:i A') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- FACILITADOR-->
<div>
    <div class="table-responsive">
        <table class="table table-bordered tabla_facilitador">
            <thead>
                <tr>
                    <th style="background: #98cbe8" colspan="7">FACILITADOR</th>
                </tr>
                <tr>
                    <th>CEDULA</th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>SEXO</th>
                    <th>EDAD</th>
                    <th>TELEFONO</th>
                    <th>ACCION</th>
                </tr>
            </thead>
            <tbody>
                @if(count($facilitador) == 0)
                <tr>
                    <td colspan="7">Asigne a un Facilitador...</td>
                </tr>
                @else
                @foreach($facilitador as $c)
                <tr>
            <input type="text" value="{{ $c->id }}" name="id_miembro" style="display: none; visibility: hidden">
            <td>{{ $c->cedula }}</td>
            <td>{{ $c->nombre }}</td>
            <td>{{ $c->apellido }}</td>
            <td>{{ $c->genero }}</td>
            <td>{{ Carbon\Carbon::createFromDate(Carbon\Carbon::parse($c->fecha_nac)->format('Y'),Carbon\Carbon::parse($c->fecha_nac)->format('m'),Carbon\Carbon::parse($c->fecha_nac)->format('d'))->age }}</td>
            <td>{{ $c->telefono }}</td>
            <td>
                <a href="#" onclick="eliminar_miembro({{ $actividad_id . ',' . $c->act_id }})"><button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash-o"></i></button></a>
            </td>
            </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>

<!-- BRIGADISTA-->
<div>
    <div class="table-responsive">
        <table class="table table-bordered tabla_facilitador">
            <thead>
                <tr>
                    <th style="background: #98cbe8" colspan="7">BRIGADISTA</th>
                </tr>
                <tr>
                    <th>CEDULA</th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>SEXO</th>
                    <th>EDAD</th>
                    <th>TELEFONO</th>
                    <th>ACCION</th>
                </tr>
            </thead>
            <tbody>
                @if(count($brigadista) == 0)
                <tr>
                    <td colspan="7">Asigne Brigadistas...</td>
                </tr>
                @else
                @foreach($brigadista as $c)
            <input type="text" value="brigadista" name="brigadista" id="brigadista" style="display: none; visibility: hidden">
            <tr>
            <input type="text" value="{{ $c->id }}" name="id_miembro" style="display: none; visibility: hidden">
            <td>{{ $c->cedula }}</td>
            <td>{{ $c->nombre }}</td>
            <td>{{ $c->apellido }}</td>
            <td>{{ $c->genero }}</td>
            <td>{{ Carbon\Carbon::createFromDate(Carbon\Carbon::parse($c->fecha_nac)->format('Y'),Carbon\Carbon::parse($c->fecha_nac)->format('m'),Carbon\Carbon::parse($c->fecha_nac)->format('d'))->age }}</td>
            <td>{{ $c->telefono }}</td>
            <td>
                <a href="#" onclick="eliminar_miembro({{ $actividad_id . ',' . $c->act_id }})"><button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash-o"></i></button></a>
            </td>
            </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>

<!-- COMUNIDAD-->
<div>
    <div class="table-responsive">
        <table class="table table-bordered tabla_facilitador">
            <thead>
                <tr>
                    <th style="background: #98cbe8" colspan="7">COMUNIDAD</th>
                </tr>
                <tr>
                    <th>CEDULA</th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>SEXO</th>
                    <th>EDAD</th>
                    <th>TELEFONO</th>
                    <th>ACCION</th>
                </tr>
            </thead>
            <tbody>
                @if(count($comunidad) == 0)
                <tr>
                    <td colspan="7">Asigne a miembros de la comunidad...</td>
                </tr>
                @else
                @foreach($comunidad as $c)
                <tr>
            <input type="text" value="{{ $c->id }}" name="id_miembro" style="display: none; visibility: hidden">
            <td>{{ $c->cedula }}</td>
            <td>{{ $c->nombre }}</td>
            <td>{{ $c->apellido }}</td>
            <td>{{ $c->genero }}</td>
            <td>{{ Carbon\Carbon::createFromDate(Carbon\Carbon::parse($c->fecha_nac)->format('Y'),Carbon\Carbon::parse($c->fecha_nac)->format('m'),Carbon\Carbon::parse($c->fecha_nac)->format('d'))->age }}</td>
            <td>{{ $c->telefono }}</td>
            <td>
                <a href="#" onclick="eliminar_miembro({{ $actividad_id . ',' . $c->act_id }})"><button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash-o"></i></button></a>
            </td>
            </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
@endsection()

@section('complemento-2')
<!--asset ventana alert-->
<script src="{{ asset('plugin/jquery-alertable-master/jquery.alertable.js') }}"></script>
<!--asset para el boostrap select-->
<script src="{{ asset('plugin/bootstrap-select-1.12.2/dist/js/bootstrap-select.js') }}"></script>
{{url('eliminar-miembro-actividad/1/2')}}
<script>
                    //   Finalizar equipo-usuario
                    var eliminar_miembro = function (actividad_id, miembro_id) {
                    $.alertable.confirm("¿Esta seguro de eliminar el registro?").then(function () {
                    window.location.href = "{{ url('/') }}/" + actividad_id + "/" + miembro_id + "/eliminar-miembro-actividad";
                    });
                    };
                    //eliminar mensaje
                    $('#message').show().delay(3000).fadeOut();
                    //disable select option usuario
                    var elementos = document.getElementsByName("id_miembro");
                    for (x = 0; x < elementos.length; x++) {
                    $("#" + elementos[x].value + "").remove();
                    //document.getElementById(elementos[x].value).disabled = true;
                    }
                    //Validando brigadista == 10 elimino el select brigadista
                    var brigadista = document.getElementsByName("brigadista").length;
                    if (brigadista == 10){
                    $("#cargo_4").remove();
                    }
                    //contar los elementos del select
                    var miembro = document.getElementById("miembro").length;
                    var cargo = document.getElementById("cargo").length;
                    if (miembro == 0 || cargo == 0) {
                    document.getElementById("miembro").disabled = true;
                    document.getElementById("cargo").disabled = true;
                    document.getElementById("asignar").disabled = true;
                    }

</script>
@endsection()