<?php $i = 0; ?>

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
    <h1 style="text-transform: uppercase; border-bottom: 1px solid #000; text-align: center;">Ficha Equipo</h1>.
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
    h2{
        text-align: center;
        text-decoration: underline;
    }
</style>

<table style="margin-top: -3%;">
        <tr>
            <th>Equipo</th>
            <td>{{ $array[$i]['num'] }}</td>
        </tr>
         <tr>
            <th>Estatus</th>
            <td>{{ ($array[$i]['est'] == 1) ? 'Habilitado' : 'Inhabilitado' }}</td>
        </tr>
        <tr>
            <th>Condicion</th>
            <td>{{ ($array[$i]['cond'] == 1) ? 'Disponible' : 'No Disponible' }}</td>
        </tr>
</table>

<h2>COMPONENTES VINCULADOS</h2>

@if ($array[$i]['comp'] == null)
    <p>No hay componentes vinculados...</p>
@else
    @for ($j = 0; $j < count($array[$i]['comp']) ; $j++)
        <table width="100%">
            <thead>
                <tr style="background: #C2C2C2">
                    <th colspan="4">{{ $array[$i]['comp'][$j][0] }}</th>
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
                    <td>{{ $array[$i]['comp'][$j][1] }}</td>
                    <td>{{ $array[$i]['comp'][$j][2] }}</td>
                    <td>{{ $array[$i]['comp'][$j][3] }}</td>
                    <td>{{ $array[$i]['comp'][$j][4] }}</td>
                </tr>
            </tbody>
        </table>
        <br>
    @endfor
@endif

<hr>

<?php $i++; ?>
@endwhile
