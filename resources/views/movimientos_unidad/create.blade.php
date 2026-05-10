@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card uper">
	  <div class="card-header">
	    Solicitud
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


	      <form id="personal" method="get" action="{{ route('movimientos_unidad.generarDocumento') }}" target="_blank" files=true enctype="multipart/form-data">

			  @csrf
			  <div class="form-row">
				  <div class="col-sm-6">
					  <h6>Busqueda</h6>
					  <div class="form-row">
						  <label for="busqueda" class="col-2 col-form-label">Puesto</label>
						  <div class="col-sm-8">
							  <input type="text" class="form-control" name="busqueda" placeholder="Introduzca el código del puesto que desea">
						  </div>
						  <div class="col-sm-2">
							  <button class="btn btn-primary">Buscar</button>
						  </div>
					  </div>


				  </div>
				  <div class="col-sm-6">

					  <table class="table">
						  <header class="lead">Resultados
						  </header>
						  <thead>
							  <tr>
								  <th>Nombre</th>
								  <th>Puesto</th>
							  </tr>

						  </thead>
					  </table>
				  </div>
			  </div>

			  <br>
			  <div class="text-center">
	          	<button type="submit" class="btn btn-primary">Agregar</button>
			    <a href="{{ url()->previous() }}" class="btn btn-primary">Regresar</a>
			</div>
	      </form>
	  </div>
	</div>
</div>
@endsection
