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
    <h1 style="text-transform: uppercase; border-bottom: 1px solid #000; text-align: center; margin-bottom: -2%;">Listado de Usuarios | Sistema</h1>.
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
    table th{
        text-align: center;
    }
    h2{
        text-align: center;
        text-decoration: underline;
    }
</style>

    <table width="100%">
        <thead>
            <tr>
                <th>AVATAR</th>
                <th>NOMBRE</th>
                <th>EMAIL</th>
                <th>ROL</th>
                <th>HABILITADO</th>
            </tr>  
        </thead>
        <tbody>
        @foreach ($array as $u)
            <tr>
                <td style="text-align: center;"><img src="{{ asset('img/avatar/' . $u->avatar) }}" alt="{{ $u->name }}" width="50px" height="50px"></td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ ($u->rol == 1) ? 'Administrador' : 'Moderador' }}</td>
                <td>{{ ($u->habilitado == true) ? 'Habilitado' : 'Inhabilitado' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
