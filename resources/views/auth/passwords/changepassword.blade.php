@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="col-lg-12">
	<h1 class="page-header">Change Password</h1>
</div>

<div class="row">
	<div class="col-md-12 center-block">
		<div class="container-fluid">
			<div class="col-lg-12">
				@include('msgs.success')
				<div class="panel panel-default">
					<div class="panel-heading">
						Change Password<a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
					</div>
					<div class="panel-body">
						<div class="container-fluid">
							<section class="container col-sm-offset-3">
								<div class="container-page">
									<div class="col-sm-6">
										<form role="form"  action="{{ url('/change-password') }}" method="POST" class="form-horizontal">

											{{ csrf_field() }}

											<div class="col-lg-12 center-block">
												<h2 style="text-align: center;">Change Password</h2>
												<div class="form-group">
													<label>Old Password</label>
													<input class="form-control" type="password" name="old_password" required="required">
												</div>
												<div class="form-group">
													<label>New Password</label>
													<input class="form-control" type="password" name="new_password" required="required">
												</div>
												<div class="form-group">
													<label>Confirm New Password</label>
													<input class="form-control" type="password" name="conf_password" required="required">
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-primary center-block" value="Login">
														Change Password
													</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</section>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
