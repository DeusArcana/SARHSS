@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card uper">
		<div class="card-header">
			<div class="form-group">
				<header class="lead">
					Especialidades Médicas
				</header>
			</div>
		</div>
		<div class="card-body">
			<div class="uper">
				@if(session()->get('success'))
					<div class="alert alert-success">
						{{ session()->get('success') }}
					</div>
					<br />
				@endif
		
                <table class="table t-simple table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Consejo</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $especialidades_medicas as $especialidad_medica)
                        <tr>
                            <td>{{ $especialidad_medica -> Titulo }}</td>
                            <td>{{ $especialidad_medica -> Consejo }}</td>
                            <td>
                                <form action="{{route('empleados.especialidad_medica.destroy',[
                                            'ID_Empleado'			=>	encode('empleados',$especialidad_medica -> Empleado_ID_Empleado),
                                            'ID_Empleado_Especialidad_Medica'	=>	encode('especialidad_medica', $especialidad_medica  -> ID_Empleado_Especialidad_Medica)])}}" method="post">
                                    <div class="btn-group" role="group">
                                        <a href="{{route('empleados.especialidad_medica.edit',[
                                                    'ID_Empleado'			=>	encode('empleados',$especialidad_medica -> Empleado_ID_Empleado),
                                                    'ID_Empleado_Especialidad_Medica'=>	encode('especialidad_medica', $especialidad_medica  -> ID_Empleado_Especialidad_Medica)])}}" class="btn btn-primary">Editar</a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Borrar</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
		
				<div class="text-center">
					<a href="{{ route('empleados.show', encode('empleados', $id)) }}" class="btn btn-primary btn-sm">Regresar</a>
					<a href="{{ route('empleados.especialidad_medica.create', encode('empleados', $id)) }}" class="btn btn-primary btn-sm">Agregar Especialidad</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
