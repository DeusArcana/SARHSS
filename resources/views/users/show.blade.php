@extends('layouts.app')

@section('content')
	<div class="container">
		<h1>{{ $user -> name }}</h1>
		<table class="table display table-striped table-hover">
			<tr>
				<th>Nombre</th>
				<td>{{ $user -> name }}</td>
			</tr>
			<tr>
				<th>Email:</th>
				<td>{{ $user -> email }}</td>
			</tr>
			<tr>
				<th>Roles:</th>
				<td>
					@foreach ($user -> roles as $role)
						{{ $role -> name }}
					@endforeach
				</td>
			</tr>
		</table>
		@can('edit', $user)
		    <a href="{{ route('users.edit', $user -> id) }}" class="btn btn-info">Editar</a>
		@endcan
		@can('destroy', $user)
		    <form style="display: inline" method="POST" action="{{ route('users.destroy', $user -> id) }}">
				{{ method_field('DELETE') }}
				@csrf
				<button class="btn btn-danger" type="submit">Eliminar</button>
			</form>
		@endcan
	</div>
@endsection