
<style>
    table {
        border-collapse: collapse;
        margin: auto;
        text-align: center;
        text-transform: uppercase;
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
    <h1 style="text-transform: uppercase; border-bottom: 1px solid #000; text-align: center;">Listado de Perifericos</h1>.
</div>

<table width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>NOMBRE</th>
            <th>CONDICION</th>
        </tr>
    </thead>
    <tbody>
    <?php  $i = 1; ?>
        @foreach ($array as $a)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $a->nombre }}</td>
                <td>{{ ($a->condicion == 1) ? 'Exterior' : 'Interior' }}</td>
            </tr>
        <?php $i++ ?>
        @endforeach
    </tbody>
</table>