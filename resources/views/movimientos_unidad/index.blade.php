@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card uper">
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
	  </div>
	</div>
</div>
@endsection
