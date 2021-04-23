<div class="navbar-custom-menu">
<ul class="nav navbar-nav">

<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    @if(Auth::user()->userphoto_path)
        <img src="{{ asset('storage/'.Auth::user()->userphoto_path) }}" alt="Avatar" style="width:32px; height:32px; border-radius:50%">
        @else
        <img src="{{asset('temp/images/img_avatar.png')}}" alt="Default Image" style="width:32px; height:32px; border-radius:50%">
    @endif 
    @foreach(App\Role::All() as $role)
    @if(Auth::user()->hasRole($role->slug)),
    {{$role->name}}
    @endif
@endforeach

{!!": <strong>".Auth::user()->full_name."</i></strong>"!!} <i class="fa fa-caret-down"></i>
</a>
<ul class="dropdown-menu">

    <!-- Menu Footer-->
    <li class="user-footer" style="background-color: #3C8DBC;">
    <div class="">
    <a href="{{ url('/view-users/profile') }}" style="color:white;"><i class="fa fa-user fa-fw"></i> My Profile</a>
    </div>
    <div class="">
        <a href="{{ url('/change-password') }}" style="color:white;"><i class="fa fa-gear fa-fw"></i> Change Password</a>
    </div>
    <div>
        <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" style="color:white;">
        <i class="fa fa-sign-out fa-fw"></i>Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

    </div>
</li>
</ul>
</li>
</ul>
</div>
