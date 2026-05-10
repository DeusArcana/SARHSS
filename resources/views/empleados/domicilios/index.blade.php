@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card uper">
		<div class="card-header">
			<div class="form-group">
				<header class="lead">
					Domicilios
				</header>
			</div>
		</div>
		<div class="card-body">
			<div class="uper">
				@if(session()->get('success'))
					<div class="alert alert-success">
						{{ session()->get('success') }}
					</div>
					<br />
				@endif
		
				<table id="domicilios-table" class="table display table-striped table-hover" width="100%">
					<thead>
						<tr>
							<th>Domicilio</th>
							<th>Número de Domicilio</th>
							<th>Código Postal</th>
							<th>Asentamiento</th>
							<th>Municipio</th>
							<th>Estado</th>
							<th>Acción</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $domicilios as $domicilio)
							<tr>
								<td>{{ $domicilio -> Domicilio }}</td>
								<td>{{ $domicilio -> Numero_Domicilio }}</td>
								<td>{{ $domicilio -> Codigo_Postal }}</td>
								<td>{{ $domicilio -> Asentamiento }}</td>
								<td>{{ $domicilio -> Municipio }}</td>
								<td>{{ $domicilio -> Estado }}</td>
								<td>
									<form action="{{route('empleados.domicilios.destroy',[
										'ID_Empleado'=>encode('empleados',$domicilio -> ID_Empleado),
										'ID_Domicilio'=>encode('domicilios',$domicilio -> ID_Domicilio)])}}" method="post">

										<div class="btn-group" role="group">
										<a href="{{route('empleados.domicilios.edit',[
											'ID_Empleado'=>encode('empleados',$domicilio -> ID_Empleado),
											'ID_Domicilio'=>encode('domicilios',$domicilio -> ID_Domicilio)])}}" class="btn btn-primary">Editar</a>
										@csrf
										@method('DELETE')
										<button class="btn btn-danger" type="submit">Borrar</button>
										</div>
									</form>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
		
				<div class="text-center">
					<a href="{{  route('empleados.show', encode('empleados', $id )) }}" class="btn btn-primary btn-sm">Regresar</a>
					<a href="{{route('empleados.domicilios.create',encode('empleados', $id ))}}" class="btn btn-primary btn-sm">Agregar domicilio</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
