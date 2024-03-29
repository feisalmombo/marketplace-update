@extends('layouts.app')

@section('title', 'View Institution Uploads')

@section('content')


<div class="col-lg-12">
	<h1 class="page-header">View Institution Uploads</h1>
</div>
<section class="content">
<div class="row">
	<div class="col-lg-12">
		@include('msgs.success')
		<div class="panel panel-default">
			<div class="panel-heading">
                Institution Uploads
                <a href="{{ url('/institution/uploads/create') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-plus"></i>&nbsp;Institution Uploads</a>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				@if(count($productDatas)>0)

                <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Institution Name</th>
                        <th>Institution Type</th>
                        <th>Created Day</th>
                        <th>Updated Day</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach($productDatas as $key=>$productData)
                            <tr class="odd gradeX">
                                <td>{{ $key + 1}}</td>
                                <td>{{ $productData->institution_name}}</td>
                                <td>{{ $productData->institution_type_name}}</td>
                                <td>{{date("F jS, Y", strtotime($productData->created_at))}}</td>
                                <td>{{date("F jS, Y", strtotime($productData->updated_at))}}</td>
                                <td>
                                    <a href="{{ url('institution/uploads/'.$productData->id.'/edit') }}" type="button" class="btn btn-primary"><i class="fa fa-pencil-square-o" arial-hidden="true"></i></a>
                                </td>
                                <td>
                                    <a href='#{{ $productData->id }}' data-toggle="modal" type="button" class="btn btn-danger"><i class="fa fa-trash" arial-hidden="true"></i></a>
                                    <div class="modal fade" id="{{ $productData->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title"><strong>Delete</strong></h4>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete Institution Name? <h9 style="color: blue;">{{ $productData->institution_name }}</h9>
                                                </div>
                                                <form action="/institution/uploads/{{ $productData->id  }}" method="POST" role="form">

                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>

                                                        <button type="submit" class="btn btn-danger">Yes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                  </table>
                </div>
				@else
				<div class="alert alert-info">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>No Institution Uploads found</strong>
				</div>
				@endif
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>

</section>
<!-- /.row -->

@endsection
