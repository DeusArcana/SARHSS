@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card uper">
		<div class="card-header">
			Agregar Grado de Estudios
			<br>
			{{ $empleado_puesto -> Puesto }}
		</div>
		<div class="card-body">
			@if ($errors -> any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors -> all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				<br />
			@endif

			<div class="col-xs-4">
				<label style="font-weight: bold;">Estudios Recomendados: </label>
				@if ($requisitos != null)
					<label>{{ $requisitos -> Descripcion }}</label>
				@else
					<label>No se cuenta con recomendaciones</label>
				@endif
			</div>

			<form id="grado_estudios" method="post" action="{{ route('empleados.estudios.store', encode('empleados', $empleado_puesto -> ID_Empleado)) }}" files=true enctype="multipart/form-data">
				@csrf
				<div class="col-xs-4">
					<div class="well well-sm">
						<div class="form-group">
							<label for="nivel_escolar">Grado de Estudios:</label>
							<select class="form-control" name="nivel_escolar">
								<option>-- Seleccionar Grado de Estudios --</option>
								@foreach($escolares as $escolar)
									<option value="{{ $escolar -> ID_Escolar }}">{{ $escolar -> Nivel_Escolar }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="institucion">Institución:</label>
							<input type="text" class="form-control" name="institucion"/>
						</div>
						<div class="form-group">
							<label for="titulo">Título:</label>
							<input type="text" class="form-control" name="titulo"/>
						</div>
						<div class="form-group">
							<label for="cedula_estatal">Cédula Estatal:</label>
							<input type="text" class="form-control" name="cedula_estatal"/>
						</div>
						<div class="form-group">
							<label for="cedula_federal">Cédula Federal:</label>
							<input type="text" class="form-control" name="cedula_federal"/>
						</div>
					</div>
				</div>

				<div class="text-center">
					<button type="submit" class="btn btn-primary">Agregar</button>
					<a href="{{ url()->previous() }}" class="btn btn-primary">Regresar</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
