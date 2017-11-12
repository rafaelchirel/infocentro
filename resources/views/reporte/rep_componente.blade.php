<style>
    table {
        border-collapse: collapse;
        margin: auto;
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

@if (empty($array[0]['historial']))
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
        <h1 style="text-transform: uppercase; border-bottom: 1px solid #000; text-align: center; margin-bottom: -10%">Listado de Componentes</h1>.
    </div>

    @for ($i = 0; $i < count($array); $i++)
        <table width="100%">
            <thead>
                <tr>
                    <th>PERIFERICO</th>
                    <th>MARCA</th>
                    <th>MODELO</th>
                    <th>SERIAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $array[$i]['periferico'] }}</td>
                    <td>{{ $array[$i]['marca'] }}</td>
                    <td>{{ $array[$i]['modelo'] }}</td>
                    <td>{{ $array[$i]['serial'] }}</td>
                </tr>
            </tbody>
        </table>
        <br>
    @endfor

@else
    @for ($i = 0; $i < count($array) ; $i++)

        <div style="text-align: right" style="margin-bottom: 1%; font-weight: bold">{{ $date }}</div>

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
            <h1 style="text-transform: uppercase; border-bottom: 1px solid #000; text-align: center; margin-bottom: -10%">componente</h1>.
        </div>

        <table width="100%">
            <thead>
                <tr>
                    <th>PERIFERICO</th>
                    <th>MARCA</th>
                    <th>MODELO</th>
                    <th>SERIAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $array[$i]['periferico'] }}</td>
                    <td>{{ $array[$i]['marca'] }}</td>
                    <td>{{ $array[$i]['modelo'] }}</td>
                    <td>{{ $array[$i]['serial'] }}</td>
                </tr>
            </tbody>
        </table>
        <br>

        <h2 style="margin-top: -5%;">HISTORIAL</h2>

        @for ($j = 0; $j < count($array[$i]['historial']) ; $j++)
            <table width="100%">
                <thead>
                    <tr style="background: #D0D0D0">
                    <th colspan="1">{{ Carbon\Carbon::parse($array[$i]['historial'][$j]['fecha_hora'])->format('h:i:s A d-m-Y') }}</th>
                        <th colspan="1">{{ $array[$i]['historial'][$j]['user'] }}</th>
                        <th colspan="1">{{ $array[$i]['historial'][$j]['estatu'] }}</th>
                    </tr>
                </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">{!! $array[$i]['historial'][$j]['observacion'] !!}</td>
                        </tr>
                    </tbody>
            </table>
            <br>
        @endfor

    <hr>
    @endfor
@endif
    

