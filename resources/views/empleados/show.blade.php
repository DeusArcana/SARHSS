@extends('layouts.app')
@section('content')
<div class="container">
	@if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}
      </div><br />
    @endif
	<div class="card uper">
  		<div class="card-header">
			<div class="form-group">
				<label>{{ $empleado -> Nombre_Empleado }} {{ $empleado -> Apellido_Paterno }} {{ $empleado -> Apellido_Materno }}</label>
				
				<!-- Right Side Of Navbar -->
				<ul class="navbar-nav ml-auto float-sm-right">
					<li class="nav-item dropdown">
						<a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							<div class="col">
								<div class="special-con">
									<div class="bar arrow-top-fall"></div>
									<div class="bar arrow-middle-fall"></div>
									<div class="bar arrow-bottom-fall"></div>
								</div>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-right text-right" role="menu">
							<li>
								<a href="{{route('empleados.domicilios.index', encode('empleados', $empleado -> ID_Empleado ))}}" class="dropdown-item">Modificar Domicilios</a>
							</li>
							@if ($empleado -> Categoria =="Rama Médica")
								<li>
									<a href="{{ route('empleados.especialidad_medica.index', encode('empleados', $empleado -> ID_Empleado)) }}" class="dropdown-item">Modificar Especialidades</a>
								</li>								
							@endif
							<li>
								<a href="{{ route('empleados.estudios.index', encode('empleados', $empleado -> ID_Empleado)) }}" class="dropdown-item">Modificar Estudios</a>
							</li>
							<li>
								<a href="{{ route('empleados.cursos.index', encode('empleados', $empleado -> ID_Empleado)) }}" class="dropdown-item">Modificar Cursos</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
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

			<form>
				<div class="row">
					<div class="col-sm-6 float-sm-left">
						@if($empleado -> Foto)
    							<img src="{{ asset('storage/fotos/'. $empleado -> Foto)}}" />
						@else
    							<img src="{{ asset('storage/fotos/nofoto.png')}}" />
						@endif

					</div>
					<div class="col-sm-6 float-sm-right">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>RFC:</th>
									<th>CURP:</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>{{ $empleado -> RFC }}</td>
									<td>{{ $empleado -> CURP }}</td>
								</tr>
							</tbody>
						</table>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Sexo:</th>
									<th>Estado civil:</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td> {{ $empleado -> Sexo }}</td>
									<td> {{ $empleado -> Estado_Civil }}</td>
								</tr>
							</tbody>
						</table>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Correo Electrónico:</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td> {{ $empleado -> Correo_Electronico }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<br>

				<table class="table t-simple table-striped" width="100%">
					<header class="lead">
						Domicilios
					</header>
					<thead>
						<tr>
							<th>Domicilio</th>
							<th>Número Domicilio</th>
							<th>Coigo Postal</th>
							<th>Asentamiento</th>
							<th>Municipio</th>
							<th>Estado</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $domicilios as $domicilio)
						<tr>
							<td>{{ $domicilio -> Domicilio }}</td>
							<td>{{ $domicilio -> Numero_Domicilio }}</td>
							<td>{{ $domicilio -> Codigo_Postal }}</td>
							<td>{{ $domicilio -> Asentamiento }}</td>
							<td>{{ $domicilio -> Municipio }}</td>
							<td>{{ $domicilio -> Estado }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<br>
				<br>
				<table class="table t-simple table-striped nowrap" width="100%">
					<header class="lead">
						Datos Laborales
					</header>
					<thead>
						<tr>
							<th>CLUES Física</th>
							<th>Unidad Física</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $empleado -> CLUES_Fisica }}</td>
							<td>{{ $empleado -> Nombre_CF }}</td>
						</tr>
					</tbody>
				</table>
				<table class="table t-simple table-striped nowrap" width="100%">

					<thead>
						<tr>
							<th>CLUES Adscrita</th>
							<th>Unidad Adscrita</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $empleado -> CLUES_Adscrita }}</td>
							<td>{{ $empleado -> Nombre_CA }}</td>
						</tr>
					</tbody>
				</table>
				<br>

				<table class="table t-simple table-striped" width="100%">
					<thead>
						<tr>
							<th>Estatus</th>
							<th>Código de Base</th>
							<th>Tipo de Base</th>
							<th>Clave Presupuestal</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $empleado -> Status }}</td>
							<td>{{ $empleado -> Base }}</td>
							<td>{{ $empleado -> Base_Descripcion }}</td>
							<td>{{ $empleado -> Clave_Presupuestal }}</td>
						</tr>
					</tbody>
				</table>

				<table class="table t-simple table-striped" width="100%">
					<thead>
						<tr>
							<th>Tipo de Servicio</th>
							<th>Servicio</th>
							<th>Código de Puesto</th>
							<th>Puesto</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $empleado -> Tipo_Servicio }}</td>
							<td>{{ $empleado -> Servicio}}</td>
							<td>{{ $empleado -> Codigo_Puesto}}</td>
							<td>{{ $empleado -> Puesto}}</td>
						</tr>
					</tbody>
				</table>
				<br>

				@if($empleado -> Categoria == "Rama Médica")
					<table class="table t-simple table-striped" width="100%">
						<header class="lead">
							Especialidad Médicas
						</header>
						<thead>
							<tr>
								<th>Título</th>
								<th>Consejo</th>
							</tr>
						</thead>
						<tbody>
							@foreach( $especialidades as $especialidad)
							<tr>
								<td>{{ $especialidad -> Titulo }}</td>
								<td>{{ $especialidad -> Consejo }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<br>
					<br>
				@endif

				<table class="table t-simple table-striped" width="100%">
					<header class="lead">
						Datos Académicos
					</header>
					<thead>
						<tr>
							<th>Grado de Estudio</th>
							<th>Institución</th>
							<th>Título</th>
							<th>Cédula Estatal</th>
							<th>Cédula Federal</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $escolares as $escolar )
						<tr>
							<td>{{ $escolar -> Nivel_Escolar }}</td>
							<td>{{ $escolar -> Institucion }}</td>
							<td>{{ $escolar -> Titulo }}</td>
							<td>{{ $escolar -> Cedula_Estatal }}</td>
							<td>{{ $escolar -> Cedula_Federal }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<br>
				<br>
				<table class="table t-simple table-striped" width="100%">
					<header class="lead">
						Cursos
					</header>
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Institución</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $cursos as $curso )
						<tr>
							<td>{{ $curso -> Nombre }}</td>
							<td>{{ $curso -> Institucion }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<br>
				<br>
				<table class="table t-simple " width="100%">
					<header class="lead">
						{{$periodo}} {{$jornada_total}} Hrs.
					</header>
					<thead>
						<tr>
							<th>Lunes</th>
							<th>Martes</th>
							<th>Miércoles</th>
							<th>Jueves</th>
							<th>Viernes</th>
							<th>Sábado</th>
							<th>Domingo</th>
							<th>Días Festivos</th>
							<th>Jornada</th>
							<th>Hora de Entrada</th>
							<th>Hora de Salida</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $turnos as $turno )
							<tr>
								@if($turno -> Lunes == 1)
									<td class="success"></i></td>
								@else
									<td></td>
								@endif
								@if($turno -> Martes == 1)
									<td class="success"></td>
								@else
									<td></td>
								@endif
								@if($turno -> Miercoles == 1)
									<td class="success"></td>
								@else
									<td></td>
								@endif
								@if($turno -> Jueves == 1)
									<td class="success"></td>
								@else
									<td></td>
								@endif
								@if($turno -> Viernes == 1)
									<td class="success"></td>
								@else
									<td></td>
								@endif
								@if($turno -> Sabado == 1)
									<td class="success"></td>
								@else
									<td></td>
								@endif
								@if($turno -> Domingo == 1)
									<td class="success"></td>
								@else
									<td></td>
								@endif
								@if($turno -> Dias_Festivos == 1)
									<td class="success"></td>
								@else
									<td></td>
								@endif
								<td>{{$turno -> Horas_Jornada }} Hrs.</td>
								<td>{{$turno -> Hora_Entrada}}</td>
								<td>{{$turno -> Hora_Salida}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="text-center">
					<a href='{{ url() -> previous() }}' class="btn btn-primary btn-sm">Regresar</a>
				</div>
			</form>
	  	</div>
	</div>
</div>
@endsection
