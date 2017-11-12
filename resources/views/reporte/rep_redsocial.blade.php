
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
    <h1 style="text-transform: uppercase; border-bottom: 1px solid #000; text-align: center;">Listado de Redes Sociales</h1>.
</div>

<table width="100%">
    <thead>
        <tr>
            <th>ICONO</th>
            <th>NOMBRE</th>
            <th>TIPO</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($array as $a)
            <tr>
                <td>
                    <img src="{{ asset('img/red_social/' . $a->icono)  }}" alt="{{ $a->nombre }}" width="50px" height="50px">
                </td>
                <td>{{ $a->nombre }}</td>
                <td>{{ $a->tipo }}</td>
            </tr>
        @endforeach
    </tbody>
</table>