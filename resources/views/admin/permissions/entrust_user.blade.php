@extends('layouts.app')

@section('title', 'Entrust Users')

@section('content')
<div class="col-lg-12">
<h3>Entrust Users</h3>
<hr/>
</div>
<div class="row">
<section class="content">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
Entrust Permission To User<a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
</div>
<div class="panel-body">
<div class="container-fluid">
<section class="container col-sm-offset-3">
    <div class="container-page">
        <div class="col-sm-6">
            <form role="form"  action="{{ url('/settings/manage_users/permissions/entrust_usr') }}" method="POST">
                {{ csrf_field() }}
                <div class="col-lg-12 center-block">
                    <h2 style="text-align: center;">Select User</h2>

                    <div class="form-group">
                    <select name="users" id="user" class="form-control text-center" >
                        <option value="">---Select User to Entrust---</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->full_name}}</option>
                    @endforeach
                        </select>

                    </div>



                    <div class="form-group" id="permission">

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
<section>
@endsection
