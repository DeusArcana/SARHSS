@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{ __('Edit Profile') }}</div>

					<div class="card-body">
						@if (session('error'))
							<div class="alert alert-danger">
								{{ session('error') }}
							</div>
						@endif
						@if (session('success'))
							<div class="alert alert-success">
								{{ session('success') }}
							</div>
						@endif
						<form class="form-horizontal" method="POST" action="{{ route('users.update', $user -> id) }}">
							{{ method_field('PUT') }}
							@csrf

							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">{{ __('Username') }}</label>

								<div class="col-md-6">
									<input id="name" type="text" class="form-control" name="name" required value="{{ $user -> name }}">

									@if ($errors->has('name'))
										<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">{{ __('E-Mail Address') }}</label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control" name="email" required value="{{ $user -> email }}">

									@if ($errors->has('email'))
										<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button class="btn btn-primary">
										{{ __('Edit Profile') }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection