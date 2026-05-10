@extends('layouts.app')

@section('content')
<div class="container">
	<div class="uper">
		@if(session()->get('success'))
			<div class="alert alert-success">
				{{ session()->get('success') }}
			</div>
			<br />
		@endif

		<table id="" class="table display table-striped table-hover" width="100%">
			<thead>
				<tr >
					<th>RFC</th>
					<th>Nombre</th>
					<th>Apellido paterno</th>
					<th>Apellido materno</th>
					<th>Estatus</th>					
					@isset ($empleados[0] -> Jurisdiccion -> Nombre_Jurisdiccion)
						<th>Jurisdicción</th>
					@endisset
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
				@foreach($empleados as $empleado)
					<tr  class="table-row-empleado">
						<td>{{ $empleado -> RFC}}</td>
						<td>{{ $empleado -> Nombre_Empleado ?? $empleado -> Nombre}}</td>
						<td>{{ $empleado -> Apellido_Paterno}}</td>
						<td>{{ $empleado -> Apellido_Materno}}</td>
						<td>{{ $empleado -> Descripcion ?? $empleado -> Status() -> first() -> Descripcion }}</td>
						@isset ( $empleado -> Jurisdiccion -> Nombre_Jurisdiccion )
							<td>{{ $empleado -> Jurisdiccion -> Nombre_Jurisdiccion }}</td>
						@endisset
						<td>
							<form class="delete" action="{{ route('empleados.destroy',encode('empleados',$empleado -> ID_Empleado))}}" method="post">
								<div class="btn-group" role="group">
									<a href="{{ route('empleados.edit', encode('empleados',$empleado -> ID_Empleado))}}" class="btn btn-primary btn-sm">Editar</a>
									<a href="{{ route('empleados.show', encode('empleados',$empleado -> ID_Empleado))}}" class="btn btn-primary btn-sm">Mostrar</a>
									@csrf
									@method('DELETE')
									<button class="btn btn-danger btn-sm" type="submit">Borrar</button>
								</div>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="text-center">
			<a href="{{ route('empleados.create')}}" class="btn btn-primary btn-sm">Agregar Empleado</a>
		</div>
	</div>
</div>

@endsection
