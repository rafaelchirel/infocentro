
<style>
	table{
		text-align: center;
		margin: auto;
		font-size: 1em;
		font-weight: bold;
	}
	table th{
		text-transform: uppercase;
		text-decoration: underline;
	}
</style>

<h1>Estimado Sr(a). {{ $user->name }},</h1>
<p>El Sistema de Gestion y Control de Infocentro Valle de la Pascua, registro una solicitud de recuperacion de 
contraseña, hoy {{ $fecha->format('d-m-Y') }} a las  {{ $fecha->format('h:i:s A') }}
</p>

<table>
	<thead>
		<tr>
			<th>Su nueva contraseña es:</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>{{ $password }}</td>
		</tr>
	</tbody>
</table>
	
<p>Si no has realizado esta operación, comunícate con uno de los miembros administradores del Sistema.
</p>

<table>
	<thead>
		<tr>
			<th>Atentamente,</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Sistema de Gestion y Control Infocentro, Valle de la Pascua.</td>
		</tr>
	</tbody>
</table>


