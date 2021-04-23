@extends('layouts.app')

@section('title', 'Upload Photo ID')

@section('content')
<div class="col-lg-12">
	<h1 class="page-header">Upload Photo ID</h1>
</div>

<div class="row">
    <section class="content">
	<div class="col-lg-12">
		@include('msgs.success')
		<div class="panel panel-default">
			<div class="panel-heading">
				Photo ID<a href="{{ url('/view-users/profile/photo/upload') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
			</div>
			<div class="panel-body">
				<div class="container-fluid">
					<section class="container col-sm-offset-3">
						<div class="container-page">
							<div class="col-sm-6">
								<form role="form"  action="{{ url('/view-users/profile/photo/upload') }}" method="POST" enctype="multipart/form-data">
									{{ csrf_field() }}
									<div class="col-lg-12 center-block">
										<div class="form-group">
											<label>Select Photo ID (NIDA,Driver License,New Passport Image): </label>
											<input type="file" class="form-control" name="profilephoto" id="profilephoto" required="required">
                                        </div>

										<div class="form-group">
											<button type="submit" class="btn btn-primary center-block">
												Submit
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
