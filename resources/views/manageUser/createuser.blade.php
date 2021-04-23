@extends('layouts.app')

@section('title', 'Add User')

@section('content')
<div class="col-lg-12">
	<h1 class="page-header">Add user</h1>
</div>

<div class="row">
    <section class="content">
	<div class="col-lg-12">
		@include('msgs.success')
		<div class="panel panel-default">
			<div class="panel-heading">
				Create user<a href="{{ url('/view-users') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
			</div>
			<div class="panel-body">
				<div class="container-fluid">
					<section class="container col-sm-offset-3">
						<div class="container-page">
							<div class="col-sm-6">
								<form role="form"  action="{{ url('/view-users') }}" method="POST">
									{{ csrf_field() }}
									<div class="col-lg-12 center-block">
										<h2 style="text-align: center;">User Information</h2>
										<div class="form-group">
											<label>Name: </label>
											<input class="form-control" name="fullname" id="fullname"required="required"  placeholder="eg: Berlin Joseph">
                                        </div>

                                        <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="tel" class="form-control" required="required"  name="phonenumber" id="phonenumber" placeholder="eg: +255654197534">
                                        </div>

                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input type="date" class="form-control" required="required"  name="dob" id="dob">
                                        </div>

                                        <div class="form-group">
                                            <label>NIDA Number</label>
                                            <input type="text" class="form-control" required="required"  name="nidanumber" id="nidanumber" placeholder="e.g: 19930129-9990-00005-9089">
                                        </div>

                                        <div class="form-group">
                                            <label>City</label>
                                            <select class="form-control" required="required" name="cityID" id="cityID">
                                                <option value="">-- Select City --</option>
                                                @foreach($cities as $city)
                                                <option value="{{ $city->city_name }}">{{ $city->city_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

										<div class="form-group">
											<label>Role</label>
											<select class="form-control"  required="required" name="privilege">
												@foreach($roles as $role)
												<option value="{{ $role->slug }}">{{ $role->slug }}</option>
												@endforeach
											</select>
										</div>


										<div class="form-group">
											<button type="submit" class="btn btn-primary center-block">
												Save
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
</section>
@endsection
