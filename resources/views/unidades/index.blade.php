@extends('layouts.app')
@section('content')
<div class="container">
	<div class="uper">
	  @if( session() -> get('success'))
	    <div class="alert alert-success">
	      {{ session() -> get('success') }}
	    </div><br />
	  @endif

	  <table class="table table-striped table-hover table-sm" id="unidades-table" width="100%">
	    <thead>
	        <tr>
			  <th>CLUES</th>
	          <th>Nombre</th>
			  <th>Municipio</th>
			  <th>Jurisdiccion</th>
			  <th>Action</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($unidades as $unidad)
		        <tr class="table-row" >
		            <td scope="col" class="table-col">{{ $unidad -> CLUES }}</td>
		            <td scope="col" class="table-col">{{ $unidad -> Nombre }}</td>
					<td scope="col" class="table-col">{{ $unidad -> Municipio}}</td>
					<td scope="col" class="table-col">{{ $unidad -> Jurisdiccion}}</td>
					<td scope="col" class="not-td">
						<a href="{{ route('unidades.show', encode('unidades',$unidad -> ID_Unidad)) }}" class="btn btn-primary btn-sm">Mostrar</a>
					</td>
		        </tr>
	        @endforeach
	    </tbody>
	  </table>
	</div>
</div>
@endsection
