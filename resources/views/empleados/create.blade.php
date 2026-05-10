@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card uper">
	  <div class="card-header">
	    Agregar Empleado
	  </div>
	  <div class="card-body">
	    @if ($errors->any())
	      <div class="alert alert-danger">
	        <ul style="list-style: none;">
	            @foreach ($errors->all() as $error)
	              <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	      </div>
		  <br/>
		@endif
		  <ul class="nav nav-pills" role="tablist">
			  <li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#tab-personal">Datos Personales</a></li>
			  <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#tab-laborales">Datos Institucionales</a></li>
			  <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#tab-domicilios">Domicilio</a></li>
		  </ul>

	      <form id="personal" method="post" action="{{ route('empleados.store') }}" files=true enctype="multipart/form-data">
			  @csrf
			  <div class="tab-content">
	  			<div id="tab-personal" class="container tab-pane active">
					<div class="form-group">
		                <label for="mombre">Nombre:</label>
		                <input style="text-transform: uppercase;" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}"/>
		            </div>
		            <div class="form-group">
		                <label for="apellido_paterno">Apellido Paterno:</label>
		                <input style="text-transform: uppercase;" type="text" class="form-control" name="apellido_paterno" value="{{ old('apellido_paterno') }}"/>
		            </div>
					<div class="form-group">
		                <label for="apellido_materno">Apellido Materno:</label>
		                <input style="text-transform: uppercase;" type="text" class="form-control" name="apellido_materno" value="{{ old('apellido_materno') }}"/>
		            </div>
					<div class="form-group">
		  			  <label for="curp">CURP:</label>
		  			  <input style="text-transform: uppercase;" type="text" class="form-control" name="curp" value="{{ old('curp') }}"/>
				    </div>
					<div class="form-group">
		                <label for="rfc">RFC:</label>
		                <input style="text-transform: uppercase;" type="text" class="form-control" name="rfc" value="{{ old('rfc') }}"/>
		            </div>
					<div class="form-group">
						<label for="sexo">Sexo:</label>
						<div class="form-group">
							<select class="form-control" name="sexo">
								<option>Seleccionar sexo</option>
								<option value="Masculino" {{old('sexo')=='Masculino' ? 'selected' : ''}}>Masculino</option>
								<option value="Femenino" {{old('sexo')=='Femenino' ? 'selected' : ''}}>Femenino</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="estado_civil">Estado Civil:</label>
						<div class="form-group">
							<select class="form-control" name="estado_civil">
								<option>-- Seleccionar Estado Civil --</option>
								@foreach($estados_civiles as $estado_civil)
									<option value="{{ $estado_civil -> ID_Estado_Civil }}"  {{old('estado_civil')==$estado_civil -> ID_Estado_Civil ? 'selected' : ''}}>{{ $estado_civil -> Descripcion }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="fecha_nacimiento">Fecha de Nacimiento:</label>
						<input type="text" class="form-control datepicker" data-date="01-01-1940" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
					</div>
					<div class="form-group">
						<label for="lugar_nacimiento">Lugar de Nacimento:</label>
						<input style="text-transform: uppercase;" type="text" class="form-control" name="lugar_nacimiento" value="{{ old('lugar_nacimiento') }}"/>
					</div>
					<div class="form-group">
						<label for="correo_electronico">Correo Electrónico:</label>
						<input type="text" class="form-control" name="correo_electronico" value="{{ old('correo_electronico') }}"/>
					</div>
					<div class="form-group">
						<label for="foto">Foto:</label>
						<input type="file" class="form-control" name="foto"/>
					</div>
				</div>

				<div id="tab-laborales" class="container tab-pane fade">
					<div class="form-group">
						<label for="base">Base:</label>
						<div class="form-group">
							<select class="form-control" name="base">
								<option>-- Seleccionar tipo de base --</option>
								@foreach($bases as $base)
									<option value="{{ $base -> ID_Base }}">{{ $base -> Codigo }} - {{ $base -> Descripcion }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div id="servicio" class="form-group" style="display: none">
	  	                <label for="servicio">Servicio:</label>
	  	  			  <div class="form-group">
	  	    	  			<select class="form-control" name="servicio">
	  	  					<option>-- Seleccionar Servicio --</option>
	  	      				@foreach($servicios as $servicio)
	  	        				<option value="{{ $servicio -> ID_Servicio}}">{{ $servicio -> Nombre}}</option>
	  	      				@endforeach
	  	    				</select>
	  	  			  </div>
	  	            </div>
					<div id="puesto" class="form-group" style="display: none">
						<label for="servicio_puesto">Puesto:</label>
						<div class="form-group">
							<select class="form-control" name="servicio_puesto">
								<option value="">-- Seleccionar Puesto --</option>
							</select>
						</div>
					</div>
					<div id="puesto_alter" class="form-group" style="display: none">
						<div class="form-row">
							<label class="col-3 col-form-label">Inserte el Código del Puesto:</label>
							<div class="col-7">
								<input id="input_puesto_alter" type="text" class="form-control" name="puesto_alter"/>
							</div>
							<div class="col-2">
								<input class="btn btn-primary btn-block btn-buscar-puesto" type="button" name="buscarPuestoHomologo" value="Buscar">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Estado de Comisión:</label>
						<div class="row">
							<div class="col-3">
								<label for="result">Permanente</label>
								<input type="radio" name="result" value="permantene" checked>
							</div>
							<div class="col-3">
								<label for="result">Comisionado</label>
							    <input type="radio" name="result" value="comisionado">
							</div>
						</div>


					</div>

					<div id="clues_adscrita" class="form-group">
						<div class="form-row">
							<label class="col-3 col-form-label">Inserte el CLUES de la Unidad Adscrita</label>
							<div class="col-7">
								<input id="input_clues_adscrita" type="text" class="form-control" name="clues_adscrita"/>

							</div>
							<div class="col-2">
								<input class="btn btn-primary btn-block btn-buscar-unidad-adscrita" type="button" name="buscarUnidad" value="Buscar">
							</div>
						</div>
					</div>

					<div id="clues_fisica" class="form-group" style="display: none">
						<div class="form-row">
							<label class="col-3 col-form-label">Inserte el CLUES de la Unidad Física</label>
							<div class="col-7">
								<input id="input_clues_fisica" type="text" class="form-control" name="clues_fisica"/>
							</div>
							<div class="col-2">
								<input class="btn btn-primary btn-block btn-buscar-unidad-fisica" type="button" name="buscarUnidad" value="Buscar">
							</div>
						</div>
					</div>

					<div id="numero_oficio" class="form-group" style="display: none">
						<label>Número de Oficio</label>
						<input id="input_numero_oficio" type="text" class="form-control" name="numero_oficio"/>

					</div>
					<div id="clave_presupuestal" class="form-group">
						<label class="col-sm-12" for="clave_presupuestal">Clave Presupuestal:</label>
						<div class="row">
							<div class="col-sm-12"><input readonly id="cpre_base" type="text" class="form-control-plaintext" name="clave_presupuestal_base"/></div>
							<div class="col-sm-12"><input readonly id="cpre_puesto" type="text" class="form-control-plaintext" name="clave_presupuestal_codigo"/></div>
							<div class="col-sm-12"><input type="text" class="form-control" name="clave_presupuestal_unico"/></div>
						</div>
					</div>
					<div class="form-group">
						<label for="turno">Turno:</label>
						<div class="form-group">
							<select id="horas" select class="form-control">
								<option>-- Seleccionar Turno --</option>
								<option>TURNO MATUTINO</option>
								<option>TURNO VESPERTINO</option>
								<option>TURNO NOCTURNO</option>
								<option>TURNO SÁBADO - DOMINGO - DIAS FESTIVOS</option>
								<option>TURNO ESPECIAL</option>
								<option>TURNO MIXTO</option>
							</select>

						</div>
						<div class="form-group">
							<select class="form-control" name="turno">
								<option value="">--Seleccionar Horas--</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="fecha_nacimiento">Fecha de Inicio del Turno:</label>
						<input type="text" class="form-control datepicker" name="fecha_turno">
					</div>
				</div>

				<div id="tab-domicilios" class="container tab-pane fade">
					<div id="domicilios">
						<div class="form-group">
							<label for="domicilio">Calle:</label>
							<input type="text" class="form-control" name="domicilio"/>
						</div>
						<div class="form-group">
							<label for="numero_domicilio">Número de Domicilio:</label>
							<input type="text" class="form-control" name="numero_domicilio"/>
						</div>
						<div class="form-group">
							<label for="codigo_postal">Código Postal:</label>
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
					<div class="text-center">
						<button type="submit" class="btn btn-primary btn-sm">Agregar</button>
					</div>
				</div>
	  		</div>
			<br>

			<div class="text-center">
				<a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Regresar</a>
			</div>
	      </form>
	  </div>
	</div>
</div>
@endsection
