@extends('layouts.app')

@section('content')
<div class="container">
	<div class=" card uper">
		<div class="card-header">
			<div class="form-group">
				<header class="lead">
					Puestos Homólogos
				</header>
			</div>
		</div>
		<div class="card-body">
			<div class="uper">
				<table class="table display table-striped table-hover" width="100%">
					<thead>
						<tr >
							<th>Código</th>
							<th>Nombre</th>
							<th>Código Homólogo</th>
							<th>Nombre Homólogo</th>
						</tr>
					</thead>
					<tbody>
						@foreach($puestos as $puesto)
							<tr>
								<td>{{ $puesto -> Codigo }}</td>
								<td>{{ $puesto -> Nombre }}</td>
								<td>{{ $puesto -> Codigo_Homologo }}</td>
								<td>{{ $puesto -> Nombre_Homologo }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
