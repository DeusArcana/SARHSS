@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card uper">
		<div class="card-header">
			Agregar Domicilio
		</div>
		<div class="card-body">
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors -> all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div><br />
			@endif

			<form id="domicilios" method="post" action="{{ route('empleados.domicilios.store', encode('empleados', $empleado -> ID_Empleado)) }}" files=true enctype="multipart/form-data">
				@csrf
				<div  class="col-xs-4">
					<div class="well well-sm">
						<div class="form-group">
							<label for="domicilio">Domicilio:</label>
							<input type="text" class="form-control" name="domicilio"/>
						</div>
						<div class="form-group">
							<label for="numero_domicilio">Número de domicilio:</label>
							<input type="text" class="form-control" name="numero_domicilio"/>
						</div>
						<div class="form-group">
							<label for="codigo_postal">Código postal:</label>
							<input type="text" class="form-control" name="codigo_postal"/>
							<input class="btn btn-secondary btn-block btn-agregar-colonias" type="button" name="buscarAsentamiento" value="Buscar Colonia">
						</div>
						<div class="form-group">
							<label for="asentamiento">Colonia:</label>
							<div class="form-group">
								<select id="asentamiento" class="form-control" name="asentamiento">
									<option value="">-- Introduzca Código Postal Primero --</option>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="text-center">
					<button type="submit" class="btn btn-primary btn-sm">Agregar</button>
					<a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Regresar</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
