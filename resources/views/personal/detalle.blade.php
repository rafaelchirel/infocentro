@extends('template.main')
@section('title', 'InfoCentro|Personal')

@section('complemento', '')
<link href="{{ asset('plugin/jquery-alertable-master/jquery.alertable.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Personal')
@section('titulo', 'Detalles')

@section('content')

<div id="message">
    @include('flash::message')
</div>

<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="row">
                    <div style="visibility: hidden; display: none">
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <ul class="pagination pagination-split">
                                <li><a href="#">A</a></li>
                                <li><a href="#">B</a></li>
                                <li><a href="#">C</a></li>
                                <li><a href="#">D</a></li>
                                <li><a href="#">E</a></li>
                                <li>...</li>
                                <li><a href="#">W</a></li>
                                <li><a href="#">X</a></li>
                                <li><a href="#">Y</a></li>
                                <li><a href="#">Z</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 profile_details">
                        <div class="well profile_view">
                            <div class="col-sm-12">
                                @foreach($personal as $per)
                                <h4 class="brief text-center"><i><b>{{ $per->nombre . ' ' . $per->apellido }}</b></i></h4>
                                <div class="right col-xs-3 col-sm-3 col-md-4 col-lg-4 text-center">
                                    <img src="{{ asset('img/usu_per/' . $per->imagen) }}" alt="foto_perfil" class="img-circle img-responsive">
                                </div>
                                <div class="left col-xs-9 col-sm-9 col-md-8 col-lg-8">
                                    <p><strong>Cedula:<br></strong>{{ $per->cedula }}</p>
                                    <p><strong>Genero:<br></strong>{{ $per->genero }}</p>
                                    <p><strong>Edad:<br></strong>{{ Carbon\Carbon::createFromDate(Carbon\Carbon::parse($per->fecha_nac)->format('Y'),Carbon\Carbon::parse($per->fecha_nac)->format('m'),Carbon\Carbon::parse($per->fecha_nac)->format('d'))->age }}</p>
                                    <p><strong>Fecha de Nac:<br></strong>{{ Carbon\Carbon::parse($per->fecha_nac)->format('d-m-Y') }}</p>
                                    @if($per->email != null)
                                    <p style="word-wrap: break-word;"><strong>Email:<br></strong>{{ $per->email }}</p>
                                    @else
                                    <p><strong>Email:<br></strong>-</p>
                                    @endif
                                    @if($per->telefono != null)
                                    <p><strong>Telefono:<br></strong>{{ $per->telefono }}</p>
                                    @else
                                    <p><strong>Telefono:<br></strong>-</p>
                                    @endif

                                    <p><strong>Dirección:<br></strong>{{ $per->direccion }}</p>
                                    @endforeach

                                    @if(count($rs) > 0)

                                    <div class="text-center">
                                        <h4><b>REDES SOCIALES</b></h4>
                                        <hr style="width: 100%; border: 1px solid #169F85; margin-top: 0">
                                    </div>
                                    <div class="clearfix"></div>
                                    @foreach($rs as $red_social)
                                    @if($red_social->tipo == 'url')
                                    <ul class="list-unstyled">
                                        <li><img src="{{ asset('img/red_social/' . $red_social->icono) }}" width="50px" height="50px"> <a href="{{ $red_social->url }}" target="_blank">{{ $red_social->nombre }}</a></li>
                                    </ul>
                                    @else
                                    <ul class="list-unstyled">
                                        <li><img src="{{ asset('img/red_social/' . $red_social->icono) }}" width="50px" height="50px"> <p style="display: inline">{{ $red_social->url }}</p> </li>
                                    </ul>
                                    @endif
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 bottom text-center">
                                <div class="col-xs-6 col-sm-6 emphasis" style="width: 100%;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                        <a href="{{ url('personal') }}"><button type="button" class="btn btn-default btn-xs">Regresar</button></a>

                                        @foreach($personal as $id)
                                        <a href="{{ route('Ficha-Personal', $id->id) }}" target="_blank"><button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="PDF"><i class="fa fa-file-pdf-o"></i></button></a>
                                        <a href="{{ route('personal.edit', $id->id) }}"><button type="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button></a>
                                        <a href="#" onclick="eliminar('{{ $id->id }}')"><button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash-o"></i></button></a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()

@section('complemento-2')
<script src="{{ asset('plugin/jquery-alertable-master/jquery.alertable.js') }}"></script>

<script>
        //Eliminar mensaje / flash
        $('#message').show().delay(3000).fadeOut();
        //    Esto script es para deshabilitar un personal
        var deshabilitar = function (id) {
        $.alertable.confirm("¿Esta seguro de Deshabilitar el registro?").then(function () {
        window.location = "{{url('/')}}" + "/" + id + "/deshabilitar";
        });
        };
        //    Esto script es para habilitar un personal
        var habilitar = function (id) {
        $.alertable.confirm("¿Esta seguro de Habilitar el registro?").then(function () {
        window.location.href = id + "/habilitar";
        });
        };
        //    Esto script es para Eliminar un personal
        var eliminar = function (id) {
        $.alertable.confirm("¿Esta seguro de Eliminar el registro?").then(function () {
        window.location.href = "{{url('/')}}" + "/" + id + "/destroy";
        });
        };
        //Agregando atributos a la navbar para que este activa
        $('#componentes-ul-per').attr('style','display: block');
        $("#componentes-li-per").addClass("active");
</script>
@endsection()