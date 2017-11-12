@extends('template.main')
@section('title', 'InfoCentro|Componentes')

@section('complemento', '')
<link href="{{ asset('plugin/jquery-alertable-master/jquery.alertable.css') }}" rel="stylesheet">
@endsection()

@section('header', 'Componentes')
@section('titulo', 'Listado de Estatus')

@section('content')

<div id="message">
    @include('flash::message')
</div>

    <div class="form-group text-center">

    <?php $id = 1 ?>
        @foreach ($estatus as $e)
        
                    @if ($e->id == 1 && $contador[0] != 0)
                        <a href="{{ route('componente.show', $id) }}" title="Listado de Componentes"><button type="button" class="btn btn-danger btn-lg" style="width: 350px; height: 70px;">
                        {{ $e->condicion }} <span class="badge">{{ $contador[$i] }}</span><p>En espera de asignacion</p></button>
                        </a>
                        <br><br>
                    @else
                        @if ($e->id > 1)
                            @if ($contador[$i] == 0)
                                @if ($e->id == 3)
                                    <button type="button" class="btn btn-info btn-lg" disabled="" style="width: 350px; height: 70px;">
                                    Asignado a Equipo <span class="badge">{{ $contador[$i] }}</span></button>
                                    <br><br>
                                @else
                                    <button type="button" class="btn btn-info btn-lg" disabled="" style="width: 350px; height: 70px;">
                                    {{ $e->condicion }} <span class="badge">{{ $contador[$i] }}</span></button>
                                    <br><br>
                                @endif
                            @else
                                @if ($e->id == 3)
                                    <a href="{{ route('componente.show', $id) }}" title="Asignado a Equipo"><button type="button" class="btn btn-info btn-lg" style="width: 350px; height: 70px;">
                                    Asignado a Equipo <span class="badge">{{ $contador[$i] }}</span></button>
                                    </a>
                                    <br><br>
                                @else
                                    <a href="{{ route('componente.show', $id) }}" title="{{ $e->condicion }}"><button type="button" class="btn btn-info btn-lg" style="width: 350px; height: 70px;">
                                    {{ $e->condicion }} <span class="badge">{{ $contador[$i] }}</span></button>
                                    </a>
                                    <br><br>
                                @endif
                            @endif
                        @endif
                    @endif

        <?php $i++; $id++; ?>
       
        @endforeach 
    </div> 

@endsection()

@section('complemento-2')
<script src="{{ asset('plugin/jquery-alertable-master/jquery.alertable.js') }}"></script>

<script>
        //
</script>
@endsection()