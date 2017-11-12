<?php $i = 0; ?>

@if (!empty($array))

@while ($i < count($array))
 
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
    hr {
      page-break-after: always;
      border: 0;
      margin: 0;
      padding: 0;
    }
</style>

<div style="text-align: center; margin: auto; margin: -3% 0 1% 0">
    <img src="{{ asset('img/usu_per/' . $array[$i]['imagen']) }}" width="130px" height="130px" style=" border: 3px solid #000;">
</div>

<table>
    <tr>
        <th colspan="2" style="text-align: center; color: red">DATOS PERSONALES</th>
    </tr>
    <tr>
        <td><b>Nombre</b></td>
        <td>{{ $array[$i]['nombre'] }}</td>
    </tr>
    <tr>
        <td><b>Apellido</b></td>
        <td>{{ $array[$i]['apellido'] }}</td>
    </tr>
    <tr>
        <td><b>Cedula</b></td>
        <td>{{ $array[$i]['cedula'] }}</td>
    </tr>
    <tr>
        <td><b>Genero</b></td>
        <td>{{ $array[$i]['genero'] }}</td>
    </tr>
    <tr>
        <td><b>Edad</b></td>
        <td>{{ $array[$i]['edad'] }}</td>
    </tr>
    <tr>
        <td><b>Fecha de Nacimiento</b></td>
        <td>{{ $array[$i]['fecha_nac'] }}</td>
    </tr>
    <tr>
        <td><b>Email</b></td>
        <td>{{ $array[$i]['email'] }}</td>
    </tr>
    <tr>
        <td><b>Telefono</b></td>
        <td>{{ $array[$i]['telefono'] }}</td>
    </tr>
    <tr>
        <td><b>Direccion</b></td>
        <td>{{ $array[$i]['direccion'] }}</td>
    </tr>

    <tr>
        <td colspan="2" style="text-align: center; color: red"><b>REDES SOCIALES</b></td>
    </tr>
    @if ($array[$i]['rs'] == false)
    <tr>
        <td colspan="2" style="text-align: center"><b>No tiene Redes Sociales.</b></td>
    </tr>
    @else
        <?php $j = 0; ?>
        @while ($j < count($array[$i]['rs']))
            <tr>
            <td colspan="2" style="text-align: center"><b>{{ $array[$i]['rs'][$j][0] }}</b></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center">{{ $array[$i]['rs'][$j][1] }} </td>
            </tr>

        <?php $j++; ?>
        @endwhile
    @endif
</table>

<hr>

<?php $i++; ?>
@endwhile

@endif