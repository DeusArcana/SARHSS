@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<!-- Icons Grid -->
			<section class="features-icons bg-light text-center">
			  <div class="container">
				<div class="row">
				  <div class="col-lg-3">
					<div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
						<a href="{{ route('unidades.index') }}">
						  <div class="features-icons-icon d-flex">
							<i class="icon-organization m-auto text-primary"></i>
						  </div>
				  		</a>
					  <h3>Unidades Médicas</h3>
					  <p class="lead mb-0">This theme will look great on any device, no matter the size!</p>
					</div>
				  </div>
				  <div class="col-lg-3">
					<div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
						<a href="{{ route('empleados.index') }}">
						  <div class="features-icons-icon d-flex">
							<i class="icon-people m-auto text-primary"></i>
						  </div>
				  		</a>
					  <h3>Empleados</h3>
					  <p class="lead mb-0">Featuring the latest build of the new Bootstrap 4 framework!</p>
					</div>
				  </div>
				  <div class="col-lg-3">
					<div class="features-icons-item mx-auto mb-0 mb-lg-3">
					  <div class="features-icons-icon d-flex">
						<i class="icon-pie-chart m-auto text-primary"></i>
					  </div>
					  <h3>Movimientos de Empleado</h3>
					  <p class="lead mb-0">Ready to use with your own content, or customize the source files!</p>
					</div>
				  </div>
				  <div class="col-lg-3">
					<div class="features-icons-item mx-auto mb-0 mb-lg-3">
					  <div class="features-icons-icon d-flex">
						<i class="icon-paper-plane m-auto text-primary"></i>
					  </div>
					  <h3>Solicitudes</h3>
					  <p class="lead mb-0">Ready to use with your own content, or customize the source files!</p>
					</div>
				  </div>
				</div>
			  </div>
			</section>
        </div>
    </div>
</div>
@endsection
