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
    <h1 style="text-transform: uppercase; border-bottom: 1px solid #000; text-align: center; margin-bottom: -2%;">Ficha Personal</h1>.
</div>

<style>
    table {
        border-collapse: collapse;
        margin: auto;
    }

    table, td, th {
        border: 1px solid black;
        font-size: 1.1em;
    }
</style>

@foreach($personal as $p)
<div style="text-align: center; margin: auto; margin: -3% 0 1% 0">
    <img src="{{ asset('img/usu_per/' . $p->imagen) }}" width="130px" height="130px" style=" border: 3px solid #000;">
</div>

<table>
    <tr>
        <th colspan="2" style="text-align: center; color: red">DATOS PERSONALES</th>
    </tr>
    <tr>
        <td><b>Nombre</b></td>
        <td>{{ $p->nombre }}</td>
    </tr>
    <tr>
        <td><b>Apellido</b></td>
        <td>{{ $p->apellido }}</td>
    </tr>
    <tr>
        <td><b>Cedula</b></td>
        <td>{{ $p->cedula }}</td>
    </tr>
    <tr>
        <td><b>Genero</b></td>
        <td>{{ $p->genero }}</td>
    </tr>
    <tr>
        <td><b>Edad</b></td>
        <td>{{ Carbon\Carbon::createFromDate(Carbon\Carbon::parse($p->fecha_nac)->format('Y'),Carbon\Carbon::parse($p->fecha_nac)->format('m'),Carbon\Carbon::parse($p->fecha_nac)->format('d'))->age }}</td>
    </tr>
    <tr>
        <td><b>Fecha de Nacimiento</b></td>
        <td>{{ Carbon\Carbon::parse($p->fecha_nac)->format('d-m-Y') }}</td>
    </tr>
    <tr>
        <td><b>Email</b></td>
        <td>{{ $p->email }}</td>
    </tr>
    <tr>
        <td><b>Telefono</b></td>
        <td>{{ $p->telefono }}</td>
    </tr>
    <tr>
        <td><b>Direccion</b></td>
        <td>{{ $p->direccion }}</td>
    </tr>
    @endforeach
    @if(count($rs) != 0)
    <tr>
        <td colspan="2" style="text-align: center; color: red"><b>REDES SOCIALES</b></td>
    </tr>
    @foreach($rs as $r)
    <tr>
        <td colspan="2" style="text-align: center"><b>{{ $r->nombre }}</b></td>
    </tr>
    <tr>
        @if($r->tipo == 'url')
        <td colspan="2" style="text-align: center"><a href="{{ $r->url }}" target="_blank">{{ $r->url }}</a></td>
        @else
        <td colspan="2" style="text-align: center">{{ $r->url }}</td>
        @endif
    </tr>
    @endforeach
    @endif

</table>
