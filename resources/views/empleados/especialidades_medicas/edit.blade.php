@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card uper">
		<div class="card-header">
			<header class="lead">
				Editar Especialidad Médica
			</header>
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

			<form id="especialidad" method="post" action="{{ route('empleados.especialidad_medica.update',[
				"ID_Empleado" 			=> encode('empleados', $empleado_especialidad -> Empleado_ID_Empleado),
				"ID_Empleado_Especialidad_Medica"	=> encode('especialidad_medica',  $empleado_especialidad -> ID_Empleado_Especialidad_Medica)])}}" files=true enctype="multipart/form-data">
				@method('PATCH')
				@csrf
				<div class="col-xs-4">
					<div class="well well-sm">
						<div class="form-group">
							<label for="especialidad">Especialidad Médica:</label>
							<div class="form-group">
								<select class="form-control" name="especialidad">
									<option value="">-- Seleccionar Especialidad Médica --</option>
									@foreach($especialidades as $especialidad)
										@if( $empleado_especialidad -> Especialidad_Medica_ID_Especialidad == $especialidad -> ID_Especialidad )
											<option selected value="{{ $especialidad -> ID_Especialidad }}">{{ $especialidad-> Titulo }}</option>
										@else
											<option value="{{ $especialidad -> ID_Especialidad }}">{{ $especialidad-> Titulo }}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>

					</div>
				</div>
				
				<div class="text-center">
					<a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Regresar</a>
					<button type="submit" class="btn btn-primary btn-sm">Editar</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
