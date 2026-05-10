@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card uper">
		<div class="card-header">
			Editar Grado de Estudios
		</div>
		<div class="card-body">
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				<br />
			@endif
			
			<form id="grado_estudios" method="post" 
					action="{{ route('empleados.estudios.update', [
						"ID_Empleado" 			=> encode('empleados', $empleado_escolar -> Empleado_ID_Empleado), 
						"ID_Empleado_Escolar"	=> encode('estudios',  $empleado_escolar -> ID_Empleado_Escolar)] ) }}" 
					files=true enctype="multipart/form-data">
				@method('PATCH')
				@csrf
				<div class="col-xs-4">
					<div class="well well-sm">
						<div class="form-group">
							<label>Grado de Estudios:</label>
							<select class="form-control" name="nivel_escolar">
							<option>-- Seleccionar Nivel Escolar --</option>
								@foreach($escolares as $escolar)
									@if( $empleado_escolar -> ID_Escolar == $escolar -> ID_Escolar )
										<option selected value="{{ $escolar -> ID_Escolar }}">{{ $escolar -> Nivel_Escolar }}</option>
									@else
										<option value="{{ $escolar -> ID_Escolar }}">{{ $escolar -> Nivel_Escolar }}</option>
									@endif
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="institucion">Institución:</label>
							<input type="text" class="form-control" value="{{ $empleado_escolar -> Institucion }}" name="institucion"/>
						</div>
						<div class="form-group">
							<label for="titulo">Título:</label>
							<input type="text" class="form-control" value="{{ $empleado_escolar -> Titulo }}" name="titulo"/>
						</div>
						<div class="form-group">
							<label for="cedula_estatal">Cédula Estatal:</label>
							<input type="text" class="form-control" value="{{ $empleado_escolar -> Cedula_Estatal }}" name="cedula_estatal"/>
						</div>
						<div class="form-group">
							<label for="cedula_federal">Cédula Federal:</label>
							<input type="text" class="form-control" value="{{ $empleado_escolar -> Cedula_Federal }}" name="cedula_federal"/>
						</div>
					</div>
				</div>

				<div class="text-center">
					<button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
					<a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Regresar</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
