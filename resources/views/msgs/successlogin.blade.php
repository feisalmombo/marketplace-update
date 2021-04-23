@if(session()->has('messagelogin'))

<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{ session('messagelogin') }}</strong>
</div>

@elseif(session()->has('errorlogin'))

<div class="alert alert-warning">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{ session('errorlogin') }}</strong>
</div>

@elseif(count($errors))

<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>
		@foreach($errors->all() as $errorlogin)
		<li>{{ $errorlogin }}</li>
		@endforeach
	</strong>
</div>

@endif
