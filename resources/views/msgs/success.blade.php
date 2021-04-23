@if(session()->has('message'))

<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{ session('message') }}</strong>
</div>

@elseif(session()->has('error'))

<div class="alert alert-warning">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{ session('error') }}</strong>
</div>

@elseif(count($errors))

<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</strong>
</div>

@endif
