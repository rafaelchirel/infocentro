@extends('template.main')
@section('title', 'InfoCentro|Personal')

@section('complemento', '')
<link href="{{ asset('plugin/jquery-alertable-master/jquery.alertable.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Personal')
@section('titulo', 'Listado')

@section('buscador')
    {!! Form::open(array('url'=>'personal','method'=>'GET','autocomplete'=>'off','role'=>'buscar')) !!}
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="" name="searchText" value="">
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

                    <div class="clearfix"></div>
                    @if(count($personal) == 0)
                    No se encontro ningun resultado...
                    @else
                    @foreach($personal as $per)
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="profile_details">
                            <div class="well profile_view">
                                <h4 class="brief text-center" style="height: 50px; border-bottom: 1px solid #e0e0e0;"><i><b>{{ $per->nombre . ' ' . $per->apellido}}</b></i></h4>
                                <div class="left col-xs-7">
                                    <p><strong>Cedula:<br></strong>{{ $per->cedula }}</p>
                                    <p><strong>Genero:<br></strong>{{ $per->genero }}</p>
                                    <ul class="list-unstyled">
                                        @if($per->telefono != null)
                                        <li><i class="fa fa-phone"></i> <b>Tlfono:</b><br>{{ $per->telefono }}</li>
                                        @else
                                        <li><i class="fa fa-phone"></i> <b>Tlfono:</b><br>-</li>
                                        @endif
                                        @if($per->email != null)
                                        <li style="height: 50px; word-wrap: break-word; width: 280px;"><i class="fa fa-envelope-square"></i> <b>Email:</b><br>{{ $per->email }}</li>
                                        @else
                                        <li style="height: 50px;" ><i class="fa fa-envelope-square"></i> <b>Email:</b><br>-</li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="right col-xs-5">
                                    @if($per->url)
                                    <img src="{{ asset('img/usu_per/' . $per->url) }}" alt="" class="img-circle img-responsive" width="410px" height="410px">
                                    @else
                                    @if($per->genero == 'F')
                                    <img src="http://localhost/infocentro/public/img/usu_per/F.jpg" alt="" class="img-circle img-responsive" width="410px" height="410px">
                                    @else
                                    <img src="http://localhost/infocentro/public/img/usu_per/M.jpg" alt="" class="img-circle img-responsive" width="410px" height="410px">
                                    @endif
                                    @endif
                                </div>
                                <div class="col-xs-12 bottom text-center">
                                    <div class="col-xs-6 col-sm-6 emphasis" style="width: 100%;">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <a href="{{ route('personal.show', $per->id) }}"><button type="button" class="btn btn-primary btn-xs">
                                                    <i class="fa fa-user"> </i> Detalles
                                                </button>
                                            </a>
                                            <a href="{{ route('personal.edit', $per->id) }}"><button type="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button></a>
                                            @if ($per->eliminar == 1)
                                            <a href="#" onclick="eliminar('{{ $per->id }}')"><button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash-o"></i></button></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>   

<div class="text-center">
    {{ $personal->appends(['searchText' => $searchText])->render() }}
</div>

@endsection()

@section('complemento-2')
<script src="{{ asset('plugin/jquery-alertable-master/jquery.alertable.js') }}"></script>

<script>
        //    Esto script es para deshabilitar un personal
        var deshabilitar = function (id) {
        $.alertable.confirm("¿Esta seguro de Deshabilitar el registro?").then(function () {
        window.location.href = id + "/deshabilitar";
        });
        };
        //    Esto script es para Eliminar un personal
        var eliminar = function (id) {
        $.alertable.confirm("¿Esta seguro de Eliminar el registro?").then(function () {
        window.location.href = id + "/destroy";
        });
        };
        $('#message').show().delay(3000).fadeOut();
</script>
@endsection()