@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card uper">
		<div class="card-header">
			<div class="form-group">
                <header class="lead">
                    Datos Académicos
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
							<th>Grado de Estudio</th>
							<th>Institución</th>
							<th>Título</th>
							<th>Cédula Estatal</th>
							<th>Cédula Federal</th>
							<th>Acción</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $estudios as $estudio )
						<tr>
                            <td>{{ $estudio -> Nivel_Escolar }}</td>
                            <td>{{ $estudio -> Institucion }}</td>
                            <td>{{ $estudio -> Titulo }}</td>
                            <td>{{ $estudio -> Cedula_Estatal }}</td>
                            <td>{{ $estudio -> Cedula_Federal }}</td>
                            <td>
                                <form action="{{route('empleados.estudios.destroy',[
                                                        'ID_Empleado'			=>	encode('empleados',$estudio -> Empleado_ID_Empleado),
                                                        'ID_Empleado_Escolar'	=>	encode('estudios', $estudio  -> ID_Empleado_Escolar)])}}" method="post">
                                    <div class="btn-group" role="group">
                                        <a href="{{route('empleados.estudios.edit',[
                                                        'ID_Empleado'			=>	encode('empleados',$estudio -> Empleado_ID_Empleado),
                                                        'ID_Empleado_Escolar'	=>	encode('estudios', $estudio  -> ID_Empleado_Escolar)])}}" class="btn btn-primary">Editar</a>
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
					<a href="{{ route('empleados.show', encode('empleados', $id )) }}" class="btn btn-primary btn-sm">Regresar</a>
					<a href="{{ route('empleados.estudios.create', encode('empleados', $id )) }}" class="btn btn-primary btn-sm">Agregar Grado de Estudios</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
