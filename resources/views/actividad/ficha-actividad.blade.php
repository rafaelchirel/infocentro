<div style="text-align: right" style="margin-bottom: 1%; font-weight: bold">
    {{ $date }}
</div>

<div>
    <img src="{{ asset('img/cintillo/' . $cintillo->banner_1) }}" width="100%" height="50px">
</div>

<div>
    <img src="{{ asset('img/cintillo/' . $cintillo->banner_2) }}" width="100%" height="100px">
</div>

<div style="text-align: right; font-weight: bold; margin-top: 1%;">
    {{ $cintillo->nombre . ' | ' . $cintillo->codigo . ' | ' . $cintillo->direccion }}
</div>

<div>

    <h1 style="text-transform: uppercase; border-bottom: 1px solid #000; text-align: center; margin-bottom: -2%;">Ficha Actividad</h1>.
</div>

<style>
    table {
        border-collapse: collapse;
        margin: 1% 0 1% 0;
        width: 100%;
    }

    table, td, th {
        border: 1px solid black;
        font-size: 1.1em;
        font-size: 17px;
    }
    table th{
        text-align: center;
    }
    .tabla_facilitador td{
        text-align: center;
        font-size: 15px;
    }
    .tabla_brigadista td{
        text-align: center;
        font-size: 15px;
    }
    .tabla_comunidad td{
        text-align: center;
        font-size: 15px;
    }
</style>

<!-- TABLA ACTIVIDAD-->
<table class="actividad">
    <thead>
        <tr>
            <th style="background: #98cbe8" colspan="3">ACTIVIDAD</th>
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
            <td style="width: 30%">
                <b>Fecha: </b>{{ Carbon\Carbon::parse($actividad->fecha)->format('d-m-Y') }}<br>
                <b>Hora_Inicio: </b>{{ Carbon\Carbon::parse($actividad->hora_inicio)->format('h:i A') }}<br>
                <b>Fecha_Salida: </b>{{ Carbon\Carbon::parse($actividad->hora_salida)->format('h:i A') }}
            </td>
        </tr>
    </tbody>
</table>
<!-- FIN TABLA ACTIVIDAD-->

<!-- TABLA FACILITADOR-->
@if(count($facilitador) > 0)
<table class="tabla_facilitador">
    <thead>
        <tr>
            <th style="background: #98cbe8" colspan="7">FACILITADOR</th>
        </tr>
        <tr>
            <th>Nro.</th>
            <th>CEDULA</th>
            <th>NOMBRE</th>
            <th>APELLIDO</th>
            <th>SEXO</th>
            <th>EDAD</th>
            <th>TELEFONO</th>
        </tr>
    </thead>
    <tbody>
        <?php $c_f = 1; ?>
        @foreach($facilitador as $c)
        <tr>
            <td style="text-align: center;">{{ $c_f }}</td>
            <td>{{ $c->cedula }}</td>
            <td>{{ $c->nom_mie }}</td>
            <td>{{ $c->apellido }}</td>
            <td>{{ $c->genero }}</td>
            <td>{{ Carbon\Carbon::createFromDate(Carbon\Carbon::parse($c->fecha_nac)->format('Y'),Carbon\Carbon::parse($c->fecha_nac)->format('m'),Carbon\Carbon::parse($c->fecha_nac)->format('d'))->age }}</td>
            <td>{{ $c->telefono }}</td>
        </tr>
        <?php $c_f++; ?>
        @endforeach
    </tbody>
</table>
@endif
<!-- FIN TABLA FACILITADOR-->

<!-- TABLA BRIGADISTA-->
@if(count($brigadista) > 0)
<table class="tabla_brigadista">
    <thead>
        <tr>
            <th style="background: #98cbe8" colspan="7">BRIGADISTA</th>
        </tr>
        <tr>
            <th>Nro.</th>
            <th>CEDULA</th>
            <th>NOMBRE</th>
            <th>APELLIDO</th>
            <th>SEXO</th>
            <th>EDAD</th>
            <th>TELEFONO</th>
        </tr>
    </thead>
    <tbody>
        <?php $c_b = 1; ?>
        @foreach($brigadista as $c)
        <tr>
            <td style="text-align: center;">{{ $c_b }}</td>
            <td>{{ $c->cedula }}</td>
            <td>{{ $c->nom_mie }}</td>
            <td>{{ $c->apellido }}</td>
            <td>{{ $c->genero }}</td>
            <td>{{ Carbon\Carbon::createFromDate(Carbon\Carbon::parse($c->fecha_nac)->format('Y'),Carbon\Carbon::parse($c->fecha_nac)->format('m'),Carbon\Carbon::parse($c->fecha_nac)->format('d'))->age }}</td>
            <td>{{ $c->telefono }}</td>
        </tr>
        <?php $c_b++; ?>
        @endforeach
    </tbody>
</table>
@endif
<!-- FIN TABLA BRIGADISTA-->

<!-- TABLA COMUNIDAD-->
@if(count($comunidad) > 0)
<table class="tabla_comunidad">
    <thead>
        <tr>
            <th style="background: #98cbe8" colspan="7">COMUNIDAD</th>
        </tr>
        <tr>
            <th>Nro.</th>
            <th>CEDULA</th>
            <th>NOMBRE</th>
            <th>APELLIDO</th>
            <th>SEXO</th>
            <th>EDAD</th>
            <th>TELEFONO</th>
        </tr>
    </thead>
    <tbody>
        <?php $c_c = 1; ?>
        @foreach($comunidad as $c)
        <tr>
            <td style="text-align: center;">{{ $c_c }}</td>
            <td>{{ $c->cedula }}</td>
            <td>{{ $c->nom_mie }}</td>
            <td>{{ $c->apellido }}</td>
            <td>{{ $c->genero }}</td>
            <td>{{ Carbon\Carbon::createFromDate(Carbon\Carbon::parse($c->fecha_nac)->format('Y'),Carbon\Carbon::parse($c->fecha_nac)->format('m'),Carbon\Carbon::parse($c->fecha_nac)->format('d'))->age }}</td>
            <td>{{ $c->telefono }}</td>
            <?php $c_c++; ?>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
<!-- FIN TABLA COMUNIDAD-->