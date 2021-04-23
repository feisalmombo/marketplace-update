@extends('layouts.app')

@section('title', 'Entrust User Roles')

@section('content')
<div class="col-lg-12">
<h3>Entrust User Roles</h3>
<hr/>
</div>
<div class="row">
<section class="content">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
Entrust Permission To Role<a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
</div>
<div class="panel-body">
<div class="container-fluid">
<section class="container col-sm-offset-3">
    <div class="container-page">
        <div class="col-sm-6">
            <form role="form"  action="{{ url('/settings/manage_users/permissions/entrust_role_permissions') }}" method="POST">
                {{ csrf_field() }}
                <div class="col-lg-12 center-block">
                    <h2 style="text-align: center;">Select Role</h2>

                    <div class="form-group">
                    <select name="roles" id="role" class="form-control text-center" >
                        <option value="">---Select Role to Entrust---</option>
                    @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->slug}}</option>
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
