<div style="text-align: right" style="margin-bottom: 1%; font-weight: bold">
    {{ $date }}
</div>

@if ($cintillo)
    <div>
        <img src="{{ asset('img/cintillo/' . $cintillo->banner_1) }}" width="100%" height="50px">
    </div>

    <div>
        <img src="{{ asset('img/cintillo/' . $cintillo->banner_2) }}" width="100%" height="100px">
    </div>

    <div style="text-align: right; font-weight: bold; margin-top: 1%;">
        {{ $cintillo->nombre . ' | ' . $cintillo->codigo . ' | ' . $cintillo->direccion }}
    </div>
@endif

<div>
    <h1 style="text-transform: uppercase; border-bottom: 1px solid #000; text-align: center; margin-bottom: -2%;">Ficha Equipo</h1>.
</div>

<div style="clear: both"></div>

<style>
    .equipo {
        border-collapse: collapse;
        text-align: center;
        margin: 2% 0% 0% 50%;
    }

    .equipo td, th {
        border: 1px solid black;
    }
    .equipo th {
        background-color: lightskyblue;
    }
    .est_con{
        background: silver;
        font-weight: bold;
    }
    .componente{
        border-collapse: collapse;
        width: 100%;
        margin: 1% 0 1% 0;
    }
    .componente td, th{
        border: 1px solid black;
    }
    .componente th{
        background: silver;
    }
    .titulo {
        text-align: left;
        text-transform: uppercase;
        margin: 1% 0 1% 0;
        border-bottom: 1px solid #080808;
        font-family: monospace;
    }
</style>
@foreach($equipo as $e)
<div style="margin-left: 30%;">
    <table class="equipo">
        <tr>
            <th colspan="2">Equipo Nro. {{ $e->numero }}</th>
        </tr>
        <tr>
            <td class="est_con">Estatus</td>
            <td class="est_con">Condicion</td>
        </tr>
        <tr>
            <td>{{ $e->estatus == 1 ? 'Habilitado' : 'Inhabilitado' }}</td>
            <td>{{ $e->condicion == 1 ? 'Disponible' : 'No Disponible' }}</td>
        </tr>
    </table>
</div>
@break
@endforeach()

<div style="clear: both"></div>

@if(count($compo_ext) > 0)
<div>
    <h2 class="titulo">Componentes Externos</h2>
</div>
@foreach($compo_ext as $ce)
@endforeach
<table class="componente">
    <thead>
        <tr>
            <th colspan="4" style="text-align: left; background: #ADD7F0; text-transform: uppercase;">{{ $ce->periferico }}</th>
        </tr>
        <tr>
            <th>MARCA</th>
            <th>MODELO</th>
            <th>SERIAL</th>
            <th>DESCRIPCION</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $ce->marca }}</td>
            <td>{{ $ce->modelo }}</td>
            <td>{{ $ce->serial }}</td>
            <td>{{ $ce->descripcion }}</td>
        </tr>
    </tbody>
</table>
@endif

@if(count($compo_int) > 0)
<div>
    <h2 class="titulo">Componentes Internos</h2>
</div>
@foreach($compo_int as $ci)
<table class="componente">
    <thead>
        <tr>
            <th colspan="4" style="text-align: left; background: #ADD7F0; text-transform: uppercase;">{{ $ci->periferico }}</th>
        </tr>
        <tr>
            <th>MARCA</th>
            <th>MODELO</th>
            <th>SERIAL</th>
            <th>DESCRIPCION</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $ci->marca }}</td>
            <td>{{ $ci->modelo }}</td>
            <td>{{ $ci->serial }}</td>
            <td>{{ $ci->descripcion }}</td>
        </tr>
    </tbody>
</table>
@endforeach
@endif