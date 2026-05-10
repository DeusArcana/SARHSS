@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card uper">
		<div class="card-header">
			<em style="font-weight: bold;">Agregar Cursos</em>
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


			<form id="cursos" method="post" action="{{ route('empleados.cursos.store', encode('empleados', $id)) }}" files=true enctype="multipart/form-data">
				@csrf
				<div class="col-xs-4">
					<div class="well well-sm">
						<div class="form-group">
							<label for="curso">Curso:</label>
							<div class="form-group">
								<select class="form-control" name="curso">
									<option value="">Curso Nuevo</option>
									@foreach($cursos as $curso)
										<option value="{{ $curso -> ID_Curso }}">{{ $curso -> Nombre }}</option>
									@endforeach

								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="nombre">Nombre del curso:</label>
							<input id="nombre_curso" type="text" class="form-control" name="nombre"/>
						</div>
						<div class="form-group">
							<label for="institucion">Institución:</label>
							<input id="institucion_curso" type="text" class="form-control" name="institucion"/>
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
