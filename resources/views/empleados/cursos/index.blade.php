@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card uper">
		<div class="card-header">
			<div class="form-group">
				<header class="lead">
					Cursos y Acreditaciones
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
                    <header class="lead">
                        Cursos
                    </header>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Institución</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $cursos as $curso )
                            <tr>
                                <td>{{ $curso -> Nombre }}</td>
                                <td>{{ $curso -> Institucion }}</td>
                                <td>
                                    <form action="{{route('empleados.cursos.destroy',[
                                        'ID_Empleado'			=>	encode('empleados',$curso -> Empleado_ID_Empleado),
                                        'ID_Empleado_Curso'	=>	encode('cursos', $curso  -> ID_Empleado_Curso)])}}" method="post">
                                        <div class="btn-group" role="group">
                                            <a href="{{route('empleados.cursos.edit',[
                                                'ID_Empleado'			=>	encode('empleados',$curso -> Empleado_ID_Empleado),
                                                'ID_Empleado_Curso'	=>	encode('cursos', $curso  -> ID_Empleado_Curso)])}}" class="btn btn-primary">Editar</a>
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
                    <a href="{{ route('empleados.cursos.create', encode('empleados', $id )) }}" class="btn btn-primary btn-sm">Agregar Curso</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
