@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card uper">
		<div class="card-header">
			Agregar Domicilio
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

			<form id="domicilios" method="post" action="{{ route('empleados.domicilios.update',[
				'ID_Empleado'	=>	encode('empleados', $empleado -> ID_Empleado),
				'ID_Domicilio'	=>	encode('domicilios', $domicilio -> ID_Domicilio)])}}" files=true enctype="multipart/form-data">
				@method('PATCH')
				@csrf
				<div class="col-xs-4">
					<div class="well well-sm">
						<div class="form-group">
							<label for="domicilio">Domicilio:</label>
							<input type="text" class="form-control" name="domicilio" value="{{ $domicilio -> Domicilio}}"/>
						</div>
						<div class="form-group">
							<label for="numero_domicilio">Número de domicilio:</label>
							<input type="text" class="form-control" name="numero_domicilio" value="{{ $domicilio -> Numero_Domicilio }}"/>
						</div>
						<div class="form-group">
							<label for="codigo_postal">Código postal:</label>
							<input type="text" class="form-control" name="codigo_postal" value="{{ $domicilio -> Codigo_Postal }}"/>
							<input class="btn-danger btn btn-block btn-agregar-colonias" type="button" name="buscarAsentamiento" value="Buscar Colonia">
						</div>
						<div class="form-group">
							<label for="asentamiento">Colonia:</label>
							<div class="form-group">
								<select id="asentamiento" class="form-control" name="asentamiento">
									<option value="">-- Introduzca un Código Postal Primero --</option>
									@foreach($asentamientos as $asentamiento)
										@if($domicilio -> id == $asentamiento -> id)
											<option selected value="{{ $asentamiento -> id }}">{{ $asentamiento -> asentamiento}}</option>
										@else
											<option value="{{ $asentamiento -> id }}">{{ $asentamiento -> asentamiento }}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
					<a href="{{  url()->previous() }}" class="btn btn-primary btn-sm">Regresar</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
