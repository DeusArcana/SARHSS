@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card uper">
	  <div class="card-header">
		  <div class="form-group">
			  <label class="titulo-unidad">{{ $unidad -> Nombre}}</label>
		  </div>
	  </div>
	  <div class="card-body">
	    @if ( $errors -> any() )
	      <div class="alert alert-danger">
	        <ul>
	            @foreach ( $errors -> all() as $error )
	              <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	      </div><br />
	    @endif
		<form>
			<table  class="table table-striped">
				<header class="lead">
					Información General
				</header>
				<thead>
					<tr>
						<th>CLUES</th>
						<th>Jurisdicción</th>
						<th>Estatus</th>
						<th>Zona Económica</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{ $unidad -> CLUES }} </td>
						<td>{{ $unidad -> Jurisdiccion }} </td>
						<td>{{ $unidad -> Operacion }} </td>
						<td>{{ $unidad -> Zona_Economica }}</td>
					</tr>
				</tbody>
			</table>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Clave</th>
						<th>Tipo de unidad</th>
						<th>Tipología</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{ $unidad -> Clave }} </td>
						<td>{{ $unidad -> Tipo_de_Unidad }} </td>
						<td>{{ $unidad -> Tipologia }} </td>
					</tr>
				</tbody>
			</table>
			<table class="table table-striped">
				<thead>
					<tr>
						<td>Observaciones</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{ $unidad -> Observaciones }} </td>
					</tr>
				</tbody>
			</table>
			<br>
			<table class="table table-striped">
				<header class="lead">
					Ubicación
				</header>
				<thead>
					<tr>
						<th>Domicilio</th>
						<th>#</th>
						<th>Código Postal</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{ $unidad -> Domicilio }}</td>
						<td>{{ $unidad -> Numero_Domicilio }}</td>
						<td>{{ $unidad -> Código_Postal }} </td>

					</tr>
				</tbody>
			</table>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Municipio</th>
						<th>Asentamiento</th>
						<th>Tipo de Asentamiento</th>
						<th>Zona</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{ $unidad -> Municipio }} </td>
						<td>{{ $unidad -> Asentamiento }} </td>
						<td>{{ $unidad -> Tipo_de_Asentamiento }}</td>
						<td>{{ $unidad -> Zona}}</td>
					</tr>
				</tbody>
			</table>
			<br>

			<table id="show-unidades-empleados" class="table table-striped table-hover" width="100%">
				<header class="lead">
					Información Empleados
				</header>
				<thead>
					<tr>
						<th>Código</th>
						<th>Nombre</th>
						<th>Cantidad Esperada</th>
						<th>Cantidad Actual</th>
						<th>Reales</th>
						<th>Comisionados</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($empleado_por_unidad as $item)
						<tr>
							@if ($model_is_empty)
								<td class="info">{{ $item["Codigo_Puesto"] }} </td>
								<td class="info">{{ $item["Puesto"] }} </td>
								<td class="info">{{ $item["Cantidad"] ?? 0 }} </td>
								<td class="info">{{ $empleados_curr	-> get($item["ID_Puesto"]) ?? 0 }}</td>
								<td class="info">{{ $reales			-> get($item["ID_Puesto"]) ?? 0 }}</td>
								<td class="info">{{ $comisionados	-> get($item["ID_Puesto"]) ?? 0 }}</td>
							@elseif ($item["Cantidad"] === 0 or ($item["Cantidad"] + 1) < $empleados_curr -> get($item["ID_Puesto"])  )
								<td class="danger">{{ $item["Codigo_Puesto"] }} </td>
								<td class="danger">{{ $item["Puesto"] }} </td>
								<td class="danger">{{ $item["Cantidad"] ?? 0 }} </td>
								<td class="danger">{{ $empleados_curr	-> get($item["ID_Puesto"]) ?? 0 }}</td>
								<td class="danger">{{ $reales			-> get($item["ID_Puesto"]) ?? 0 }}</td>
								<td class="danger">{{ $comisionados		-> get($item["ID_Puesto"]) ?? 0 }}</td>
							@elseif ($empleados_curr -> get($item["ID_Puesto"]) ==  $item["Cantidad"] + 1)
								<td class="warning">{{ $item["Codigo_Puesto"] }} </td>
								<td class="warning">{{ $item["Puesto"] }} </td>
								<td class="warning">{{ $item["Cantidad"] ?? 0 }} </td>
								<td class="warning">{{ $empleados_curr	-> get($item["ID_Puesto"]) ?? 0 }}</td>
								<td class="warning">{{ $reales			-> get($item["ID_Puesto"]) ?? 0 }}</td>
								<td class="warning">{{ $comisionados	-> get($item["ID_Puesto"]) ?? 0 }}</td>
							@elseif ($empleados_curr -> get($item["ID_Puesto"]) <  $item["Cantidad"])
								<td class="unsatisfied">{{ $item["Codigo_Puesto"] }} </td>
								<td class="unsatisfied">{{ $item["Puesto"] }} </td>
								<td class="unsatisfied">{{ $item["Cantidad"] ?? 0 }} </td>
								<td class="unsatisfied">{{ $empleados_curr	-> get($item["ID_Puesto"]) ?? 0 }}</td>
								<td class="unsatisfied">{{ $reales			-> get($item["ID_Puesto"]) ?? 0 }}</td>
								<td class="unsatisfied">{{ $comisionados	-> get($item["ID_Puesto"]) ?? 0 }}</td>
							@else
								<td class="success">{{ $item["Codigo_Puesto"] }} </td>
								<td class="success">{{ $item["Puesto"] }} </td>
								<td class="success">{{ $item["Cantidad"] ?? 0 }} </td>
								<td class="success">{{ $empleados_curr	-> get($item["ID_Puesto"]) ?? 0 }}</td>
								<td class="success">{{ $reales			-> get($item["ID_Puesto"]) ?? 0 }}</td>
								<td class="success">{{ $comisionados	-> get($item["ID_Puesto"]) ?? 0 }}</td>
							@endif
						</tr>
					@endforeach
				</tbody>
			</table>
			<br>

			<table id="" class="table display table-striped table-hover" width="100%">
				<header class="lead">
					Empleados
				</header>
				<thead>
					<tr>
						<th>RFC</th>
						<th>Nombre</th>
						<th>Apellido Paterno</th>
						<th>Apellido Materno</th>
						<th>Código</th>
						<th>Puesto</th>
						<th>CLUES Física</th>
						<th>CLUES Adscrita</th>
						<th>Base</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($empleado_unidad as $item)
						<tr class='clickable-row' data-href="{{ route('empleados.show', encode('empleados', $item['ID_Empleado']))}}">
							<td>{{ $item["RFC"] 				}} </td>
							<td>{{ $item["Nombre_Empleado"] 	}} </td>
							<td>{{ $item["Apellido_Paterno"] 	}} </td>
							<td>{{ $item["Apellido_Materno"] 	}} </td>
							<td>{{ $item["Codigo_Puesto"] 		}} </td>
							<td>{{ $item["Puesto"] 				}} </td>
							<td>{{ $item["CLUES_Fisica"] 		}} </td>
							<td>{{ $item["CLUES_Adscrita"] 		}} </td>
							<td>{{ $item["Base_Descripcion"] 	}} </td>
						</tr>
					@endforeach
				</tbody>
			</table>

		</form>
			<a href='{{ route('movimientos_unidad.create')}}' class="btn btn-primary">Realizar Solicitud</a>
			<a href='{{ route('unidades.index') }}' class="btn btn-primary">Regresar</a>
		</div>
	</div>
</div>
@endsection
