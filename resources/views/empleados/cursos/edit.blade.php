@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card uper">
		<div class="card-header">
			<header class="lead">
				Editar Curso
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

			<form id="cursos" method="post" action="{{ route('empleados.cursos.update', [
				"ID_Empleado" 			=> encode('empleados', $curso_empleado -> Empleado_ID_Empleado),
				"ID_Empleado_Escolar"	=> encode('cursos',  $curso_empleado -> ID_Empleado_Curso)]) }}" files=true enctype="multipart/form-data">
				@method('PATCH')
				@csrf
				<div class="col-xs-4">
					<div class="well well-sm">
						<div class="form-group">
							<label for="curso">Curso:</label>
							<div class="form-group">
								<select class="form-control" name="curso">
									<option>Seleccionar Curso</option>
									@foreach($cursos as $curso)
									@if( $curso_empleado -> Curso_ID_Curso == $curso -> ID_Curso )
										<option selected value="{{ $curso -> ID_Curso }}">{{ $curso -> Nombre }}</option>
									@else
										<option value="{{ $curso -> ID_Curso }}">{{ $curso -> Nombre }}</option>
									@endif
									@endforeach
										<option value="">Curso Nuevo</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="nombre">Nombre del curso:</label>
							<input id="nombre_curso" readonly="readonly" type="text" class="form-control" name="nombre" value="{{$curso_empleado -> Nombre}}"/>
						</div>
						<div class="form-group">
							<label for="institucion">Institución:</label>
							<input id="institucion_curso" readonly="readonly" type="text" class="form-control" name="institucion" value="{{$curso_empleado -> Institucion}}"/>
						</div>

					</div>
				</div>

				<div class="text-center">
					<button type="submit" class="btn btn-primary btn-sm">Editar</button>
					<a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Regresar</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
