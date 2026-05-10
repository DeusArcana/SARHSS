@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card uper">
		<div class="card-header">
			<em style="font-weight: bold;">Agregar Especialidad Medica</em>
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

			<form id="cursos" method="post" action="{{ route('empleados.especialidad_medica.store', encode('empleados', $id))}}" files=true enctype="multipart/form-data">
				@csrf
				<div class="col-xs-4">
					<div class="well well-sm">
						<div class="form-group">
							<label for="curso">Especialidad Médica:</label>
							<div class="form-group">
								<select class="form-control" name="especialidad">
									<option value="">-- Seleccionar Especialidad Médica --</option>
									@foreach($especialidades as $especialidad)
										<option value="{{ $especialidad -> ID_Especialidad }}">{{ $especialidad-> Titulo }}</option>
									@endforeach
										<option value="">Curso Nuevo</option>
								</select>
							</div>
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
