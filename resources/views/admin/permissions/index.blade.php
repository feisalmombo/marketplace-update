@extends('layouts.app')

@section('title', 'Permissions')

@section('content')


<div class="col-lg-12">
	<h1 class="page-header">All Permissions</h1>
</div>
<div class="row">
    <section class="content">
	<div class="col-lg-12">
		@include('msgs.success')
		<div class="panel panel-default">
			<div class="panel-heading">
				List of All Permission<a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
			</div>
			<div class="panel-body table-responsive">
                @if(count($permissions)>0)
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>S/N</th>
							<th>Name</th>
							<th>Descriptions</th>
							<th>Created Day</th>
						</tr>
					</thead>
					<tbody>

						@foreach($permissions as $key=>$permission)
						<tr class="odd gradeX">
							<td>{{ ++$counts }}</td>
							<td>{{ $permission->name }}</td>
							<td class="center">{{ $permission->slug }}</td>
                            <td>{{date("F jS, Y", strtotime($permission->created_at))}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				<div class="alert alert-info">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>No Permission found</strong>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>

</section>
@endsection
