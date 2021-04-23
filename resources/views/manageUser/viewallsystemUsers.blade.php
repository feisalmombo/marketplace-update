@extends('layouts.app')

@section('title', 'All Users')

@section('content')

<div class="col-lg-12">
<h1 class="page-header">All Users</h1>
</div>
<section class="content">
<div class="row">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
    <div class="panel-heading">
        List of all Users
        <a href="{{ url('/view-users/create') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-plus"></i>&nbsp;Add User</a>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        @if(count($userData)>0)

        <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>S/N</th>
                <th>Photo</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Privilege</th>
                <th>More Details</th>
                <?php if(Auth::user()->can('delete_user')){?>
                <th>Delete</th>
                <?php }?>
                {{-- 'reset_password')) --}}
                {{-- <th>Reset Pass</th> --}}
                <th>Duration</th>
            </tr>
            </thead>
            <tbody>
                    @foreach($userData as $key=>$userDatas)
                    <tr class="odd gradeX">
                        <td>{{ $key + 1 }}</td>
                        @if($userDatas->userphoto_path)
                        <td class="center">
                            <img src="{{ asset('storage/'.$userDatas->userphoto_path) }}" alt="Avatar" style="width:60px; height:60px; border-radius:50%">
                        </td>
                        @else
                        <td>
                        <img src="{{asset('temp/images/img_avatar.png')}}" alt="Default Image" style="width:60px; height:60px; border-radius:50%">
                        </td>
                        @endif
                        <td class="center">{{ $userDatas->full_name }}</td>
                        <td class="center">{{ $userDatas->email }}</td>
                        <td class="center">{{ $userDatas->phone_number }}</td>
                        <td class="center">{{ $userDatas->slug  }}</td>

                        <td>
                            <a class="btn btn-info" data-toggle="modal" href='#{{ $userDatas->id."show" }}'>More Details</a>
                            <div class="modal fade" id="{{ $userDatas->id."show" }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">User Details</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="center-block">
                                                    <div class="form-group">
                                                        <label>Photo: </label>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="center-block">
                                            @if($userDatas->userphoto_path)

                                                    <div class="form-group">
                                                        <img src="{{ asset('storage/'.$userDatas->userphoto_path) }}" alt="Avatar" style="width:60px; height:60px; border-radius:50%">
                                                    </div>
                                            @else
                                            <div class="form-group">
                                              <img src="{{asset('temp/images/img_avatar.png')}}" alt="Default Image" style="width:60px; height:60px; border-radius:50%">
                                            </div>
                                            @endif
                                                </div>
                                                </div>
                                            </div>
                                            <hr/>

                                            <div class="row">
                                            <div class="col-sm-3">
                                                <div class="center-block">
                                                <div class="form-group">
                                                    <label>Full Name: </label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="center-block">
                                                <div class="form-group">
                                                    {{ $userDatas->full_name }}
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                            <hr/>

                                            <div class="row">
                                            <div class="col-sm-3">
                                                <div class="center-block">
                                                <div class="form-group">
                                                    <label>Email: </label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="center-block">
                                                <div class="form-group">
                                                    {{ $userDatas->email }}
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                            <hr/>

                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="center-block">
                                                    <div class="form-group">
                                                        <label>Phone Number: </label>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="center-block">
                                                    <div class="form-group">
                                                        {{ $userDatas->phone_number }}
                                                    </div>
                                                </div>
                                                </div>
                                                </div>
                                                <hr/>

                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="center-block">
                                                        <div class="form-group">
                                                            <label>Government ID: </label>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="center-block">
                                                        <div class="form-group">
                                                            {{ $userDatas->government_id_number }}
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <hr/>
    
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="center-block">
                                                        <div class="form-group">
                                                            <label>Date of Birth: </label>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="center-block">
                                                        <div class="form-group">
                                                            {{ $userDatas->date_of_birth }}
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <hr/>
    
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="center-block">
                                                        <div class="form-group">
                                                            <label>City: </label>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="center-block">
                                                        <div class="form-group">
                                                            {{ $userDatas->city }}
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <hr/>

                                            <div class="row">
                                            <div class="col-sm-3">
                                                <div class="center-block">
                                                <div class="form-group">
                                                    <label>Privilege: </label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="center-block">
                                                <div class="form-group">
                                                    {{ $userDatas->slug }}
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <?php if(Auth::user()->can('delete_user')){?>
                        <td>
                            <a href='#{{ $userDatas->id }}' data-toggle="modal" type="button" class="btn btn-danger"><i class="fa fa-trash" arial-hidden="true"></i></a>
                            <div class="modal fade" id="{{ $userDatas->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title"><strong>Delete</strong></h4>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete User? <h9 style="color: blue;">{{ $userDatas->full_name }}</h9>
                                        </div>
                                        <form action="/view-users/{{ $userDatas->id  }}" method="POST" role="form">

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
                        <?php }?>

                        <?php if(Auth::user()->can('delete_user')){?>
                        <td><a href="/reset/{{$userDatas->id}}" >
                            <span class="fa-passwd-reset fa-stack">
                                <i class="fa fa-undo fa-stack-2x"></i>
                                <i class="fa fa-lock fa-stack-1x"></i>
                            </span></a>
                        </td>
                        <?php }?>

                        <td>{{date("F jS, Y", strtotime($userDatas->created_at))}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>No user found</strong>
        </div>
        @endif
    </div>
</div>
</div>
</div>
</section>
@endsection


