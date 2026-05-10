@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card uper">
		@if(session()->get('success'))
			<div class="alert alert-success">
				{{ session()->get('success') }}
			</div>
			<br />
		@endif
		<div class="card-header">
			Editar Información de {{ $empleado -> Nombre_Empleado }} {{ $empleado -> Apellido_Paterno }} {{ $empleado -> Apellido_Materno }}
		</div>
		<div class="card-body">
			@if($errors -> any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors -> all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				<br />
			@endif

			<form method="post" action="{{ route('empleados.update', encode('empleados',$empleado -> ID_Empleado)) }}" files=true enctype="multipart/form-data">
				@method('PATCH')
				@csrf
				<div class="row">
					<div class="col-sm-6 float-sm-left">
						<div class="form-group">
							@if($empleado -> Foto)
								<img src="{{ asset('storage/fotos/'. $empleado -> Foto)}}" />
							@else
								<img src="{{ asset('storage/fotos/nofoto.png')}}" />
							@endif
							<input type="file" class="form-control" name="foto" />
						</div>
					</div>
					<div class="col-sm-6 float-sm-left">
						<div class="form-group">
							<label for="nombre">Nombre :</label>
							<input type="text" class="form-control" name="nombre" value="{{ $empleado -> Nombre_Empleado }}" />
						</div>
						<div class="form-group">
							<label for="apellido_paterno">Apellido Paterno:</label>
							<input type="text" class="form-control" name="apellido_paterno" value="{{ $empleado -> Apellido_Paterno }}" />
						</div>
						<div class="form-group">
							<label for="apellido_materno">Apellido Materno:</label>
							<input type="text" class="form-control" name="apellido_materno" value="{{ $empleado -> Apellido_Materno }}" />
						</div>
						<div class="form-group">
							<label for="rfc">RFC:</label>
							<input type="text" class="form-control" name="rfc" value="{{ $empleado -> RFC }}" />
						</div>
						<div class="form-group">
							<label for="curp">CURP:</label>
							<input type="text" class="form-control" name="curp" value="{{ $empleado -> CURP }}" />
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="sexo">Sexo:</label>
					<div class="form-group">
						<select class="form-control" name="sexo">
							<option>-- Seleccionar Sexo --</option>
							@if($empleado -> Sexo == "MASCULINO")
								<option selected value="MASCULINO">MASCULINO</option>
								<option value="FEMENINO">FEMENINO</option>
							@else
								<option value="MASCULINO">MASCULINO</option>
								<option selected value="FEMENINO">FEMENINO</option>
							@endif
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="estado_civil">Estado Civil:</label>
					<div class="form-group">
						<select class="form-control" name="estado_civil">
							<option>-- Seleccionar Estado Civil --</option>
							@foreach($estados_civiles as $estado_civil)
								@if($empleado -> ID_Estado_Civil == $estado_civil -> ID_Estado_Civil)
									<option selected value="{{ $estado_civil -> ID_Estado_Civil }}">{{ $estado_civil -> Descripcion }}</option>
								@else
									<option value="{{ $estado_civil -> ID_Estado_Civil }}">{{ $estado_civil -> Descripcion }}</option>
								@endif
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="fecha_nacimiento">Fecha de Nacimiento:</label>
					<input type="text" class="form-control datepicker" name="fecha_nacimiento" value="{{ $empleado -> Fecha_Nacimiento }}">
				</div>
				<div class="form-group">
					<label for="lugar_nacimiento">Lugar de Nacimento:</label>
					<input type="text" class="form-control" name="lugar_nacimiento" value="{{ $empleado -> Lugar_Nacimiento }}">
				</div>
				<div class="form-group">
					<label for="correo_electronico">Correo Electrónico:</label>
					<input type="text" class="form-control" name="correo_electronico" value="{{ $empleado -> Correo_Electronico }}"/>
				</div>

				<div class="text-center">
					<button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
					<a href={{route('empleados.index')}} class="btn btn-primary btn-sm">Regresar</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
