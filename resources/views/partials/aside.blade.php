<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
            <li class="header">OVERVIEW</li>
        <li class="treeview">
            <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
            <li class="active"><a href="{{url('/home')}}"><i class="fa fa-circle-o"></i> Home</a></li>
            </ul>
        </li>
    
        <li class="treeview">
            <?php
            if (Auth::user()->can('view_product'))
            {?>
            <a href="#">
                <i class="fa fa-university"></i>
                <span>Manage Institutions</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
            <?php if(Auth::user()->can('view_product')){?>
            <li><a href="{{ url('/institution/uploads') }}"><i class="fa fa fa-circle-o"></i> View Institution Uploads</a>
            </li>
            <li><a href="{{url('/institution/uploads/create')}}"><i class="fa fa-circle-o"></i> Institution Uploads</a></li>
                <?php }?>
            </ul>
            <?php }?>
        </li>
    
        <li class="treeview">
            <?php
            if (Auth::user()->can('view_loanrate'))
            {?>
            <a href="#">
                <i class="fa fa-product-hunt"></i> <span>Manage Products</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <?php if(Auth::user()->can('view_loanrate')){?>
                <li>
                <a href="{{ url('/product/uploads')}}"><i class="fa fa-circle-o"></i> View Product Uploads</a>
                </li>
    
                <li>
                    <a href="{{ url('/product/uploads/create')}}"><i class="fa fa-circle-o"></i> Product Uploads</a>
                    </li>
                <?php }?>
            </ul>
            <?php }?>
        </li>
    
        @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('manager'))
        <li class="treeview">
            <a href="#">
                <i class="fa fa-bandcamp"></i>
                <span>All Loan Requests</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ url('/loan/requests') }}"><i class="fa fa-circle-o"></i> Loan Requests</a>
                </li>
            </ul>
        </li>
        @endif
    
        @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('administrator') || Auth::user()->hasRole('manager'))
        <li class="treeview">
            <a href="#">
                <i class="fa fa-eject"></i>
                <span>All Loan Rejected</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ url('/all/loan/rejected') }}"><i class="fa fa-circle-o"></i> Loan Requests Rejected</a>
                </li>
            </ul>
        </li>
        @endif
    
        @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('administrator') || Auth::user()->hasRole('manager'))
        <li class="treeview">
            <a href="#">
                <i class="fa fa-hdd-o"></i>
                <span>Product Inquiries</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
            <li><a href="{{ url('/product/inquries') }}"><i class="fa fa-circle-o"></i> Product Inquiries</a></li>
            </ul>
        </li>
        @endif
    
    
        <li class="treeview">
                <?php
                if (Auth::user()->can('view_user'))
                {?>
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Manage All Users</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                <?php if(Auth::user()->can('view_user')){?>
                    <li><a href="{{ url('/view/all/users') }}"><i class="fa fa-users"></i> All Users</a></li>
                    <?php }?>
                </ul>
                <?php }?>
        </li>
    
        <li class="treeview">
            <?php
            if (Auth::user()->can('manage_privileges'))
            {?>
            <a href="#">
                <i class="fa fa-universal-access"></i> <span>Manage Permissions</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
    
            <ul class="treeview-menu">
            <?php if(Auth::user()->can('manage_privileges')){?>
                <li>
                <a href="{{ url('/settings/manage_users/permissions') }}"><i class="fa fa-circle-o"></i> View Permission</a>
                </li>
    
                <li>
                <a href="{{ url('/settings/manage_users/permissions/entrust_role') }}"><i class="fa fa-circle-o"></i> Assign Permissions to Role</a>
                </li>
    
                <li>
                <a href="{{ url('/settings/manage_users/permissions/entrust_user') }}"><i class="fa fa-circle-o"></i> Entrust Permission to User</a>
                </li>
                <?php }?>
            </ul>
            <?php }?>
        </li>
    
        <li class="treeview">
            <?php
            if (Auth::user()->can('manage_privileges'))
            {?>
            <a href="#">
                <i class="fa fa-bars"></i> <span>Manage Roles</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
            <?php if(Auth::user()->can('manage_privileges')){?>
                <li>
                <a href="{{ url('/settings/manage_users/roles') }}"><i class="fa fa-circle-o"></i> View Roles</a>
                </li>
    
                <li>
                <a href="{{ url('/settings/manage_users/roles/create') }}"><i class="fa fa-circle-o"></i> Entrust Role to User</a>
                </li>
                <?php }?>
            </ul>
            <?php }?>
        </li>
    
    
        <li class="treeview">
            <?php
            if (Auth::user()->can('view_subscriber'))
            {?>
            <a href="#">
                <i class="fa fa-id-badge"></i> <span>Manage Subscribers</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <?php if(Auth::user()->can('view_subscriber')){?>
                <li>
                <a href="{{ url('/subscriber-email') }}"><i class="fa fa-circle-o"></i> View Subscribers</a>
                </li>
                <?php }?>
            </ul>
            <?php }?>
        </li>
    
        @if(Auth::user()->hasRole('technician') || Auth::user()->hasRole('borrower'))
        <li class="treeview">
    
            <a href="#">
                <i class="fa fa-check"></i> <span>My Loans</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
    
                <li>
                    <a href="{{url('/loan/pending')}}"><i class="fa fa-circle-o"></i> Loans Pending</a>
                    </li>
                <li>

                 
                <li>
                    <a href="{{url('/borrower/loan/request/banker/approved')}}"><i class="fa fa-circle-o"></i> Loan Approved by Banker</a>
                </li>   
    
                {{--  <li>
                <a href="{{url('/loan/approved')}}"><i class="fa fa-circle-o"></i> Loans Approved</a>
                </li>  --}}

                <li>
                    <a href="{{url('/loan/applied')}}"><i class="fa fa-circle-o"></i> Loans Applied</a>
                    </li>
    
                <li>
                    <a href="{{url('/loan/rejected')}}"><i class="fa fa-circle-o"></i> Loans Rejected</a>
                </li>
    
            </ul>
    
        </li>
        @endif
    
        @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('administrator') )
        <li class="treeview">
    
            <a href="#">
                <i class="fa fa-address-book-o"></i> <span>Account Information</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
    
                <li>
                <a href="{{url('/personal/information')}}"><i class="fa fa-circle-o"></i> Personal Information</a>
                </li>
    
                <li>
                <a href="{{url('/employment/information')}}"><i class="fa fa-circle-o"></i> Employment Info</a>
                </li>
    
            </ul>
    
        </li>
        @endif
    
        @if(Auth::user()->hasRole('developer'))
        <li class="treeview">
    
            <a href="#">
                <i class="fa fa-check"></i> <span>Add Documents</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
    
                <li>
                <a href="{{url('/documents/terms/conditions')}}"><i class="fa fa-circle-o"></i> View Documents</a>
                </li>
    
            </ul>
    
        </li>
        @endif
    
        @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('borrower') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('administrator'))
        <li class="treeview">
    
            <a href="#">
                <i class="fa fa-cogs"></i> <span>Settings</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
    
                <li>
                    <a href="{{ url('/view-users') }}"><i class="fa fa-circle-o"></i>Edit My Profile</a>
                    </li>
    
                <li>
                    <a href="{{url('/view-users/profile/photo/upload')}}"><i class="fa fa-circle-o"></i>Upload Photo ID</a>
                </li>
    
                <li>
                <a href="{{url('/change-password')}}"><i class="fa fa-circle-o"></i> Change Password</a>
                </li>
    
            </ul>
    
        </li>
        @endif

        @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('financial agent') || Auth::user()->hasRole('manager'))
        <li class="treeview">
            <a href="#">
                <i class="fa fa-window-restore"></i> <span>Loan Aprroved by Banker</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">

                <li>
                    <a href="{{ url('/loan/request/approves')  }}"><i class="fa fa-circle-o"></i>View Loan Pending</a>
                </li>

                <li>
                    <a href="{{ url('/loan/request/banker/approved')  }}"><i class="fa fa-circle-o"></i>Loan Approved by Banker</a>
                </li>
            </ul>

        </li>
        @endif
    
    </ul>
    </section>
    <!-- /.sidebar -->
    </aside>
    