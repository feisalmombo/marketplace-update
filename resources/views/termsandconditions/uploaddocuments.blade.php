@extends('layouts.app')

@section('title', 'Add User')

@section('content')
<div class="col-lg-12">
	<h1 class="page-header">Upload document</h1>
</div>

<div class="row">
    <section class="content">
	<div class="col-lg-12">
		@include('msgs.success')
		<div class="panel panel-default">
			<div class="panel-heading">
				Upload Document<a href="{{ url('/documents/terms/conditions') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
			</div>
			<div class="panel-body">
				<div class="container-fluid">
					<section class="container col-sm-offset-3">
						<div class="container-page">
							<div class="col-sm-6">
								<form role="form"  action="{{ url('/documents/terms/conditions') }}" method="POST" enctype="multipart/form-data">
									{{ csrf_field() }}
									<div class="col-lg-12 center-block">
										<h2 style="text-align: center;">Document Information</h2>

                                        <div class="form-group">
                                            <label>Add Documents</label>
                                            <input type="file" name="pdfFiles[]" class="" multiple="multiple" required>

                                        </div>


										<div class="form-group">
											<button type="submit" class="btn btn-primary center-block">
												Upload
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
