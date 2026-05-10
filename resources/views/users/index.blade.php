@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="uper">
			<h1>Usuarios</h1>

			<table class="table display table-striped table-hover" width="100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Email</th>
						<th>Roles</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr>
							<td><a style="text-decoration: none;" href="{{ route('users.show', $user -> id) }}">{{ $user -> id }}</a></td>
							<td>{{ $user -> name }}</td>
							<td>{{ $user -> email }}</td>
							<td>{{ $user -> roles -> pluck('name') -> implode(" - ") }}</td>
							<td>
								<form class="delete"  method="POST" action="{{ route('users.destroy', $user -> id) }}">
									<div class="btn-group" role="group">
										<a class="btn btn-info btn-sm" href="{{ route('users.edit', $user -> id) }}">Editar</a>
										@csrf
										@method('DELETE')
										<button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
									</div>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
