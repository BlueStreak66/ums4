@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>

            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                @can('permission_access')
                <li class="{{ $request->segment(2) == 'permissions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.permissions.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.roles.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('global.users.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            @can('team_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share-alt"></i>
                    <span class="title">@lang('global.team-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                @can('team_access')
                <li class="">
                        <a href="{{ route('admin.teams.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.teams.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('team_access')
                <li class="">
                        <a href="{{ route('admin.team_members') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('global.team-members.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            @can('payment_access')
            <li class="">
                <a href="{{ route('admin.payment_history.index') }}">
                    <i class="fa fa-credit-card"></i>
                    <span class="title">Payment History</span>
                </a>
            </li>
            @endcan
			@can('payment_access')
            <li class="treeview">
            <a href="#">
                <i class="fa fa-share-alt"></i>
                <span class="title">@lang('global.total_payment.title')</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
            @can('team_access')
                <li class="">
                    <a href="{{ route('admin.user_payment.index') }}">
                        <i class="fa fa-briefcase"></i>
                        <span class="title">
                            @lang('global.total_payment.individual')
                        </span>
                    </a>
                </li>
            @endcan
            @can('team_access')
            <li class="">
                <a href="{{ route('admin.payment_history.team') }}">
                    <i class="fa fa-user"></i>
                    <span class="title">
                        @lang('global.total_payment.team')
                    </span>
                </a>
            </li>
            @endcan
            </ul>
            </li>
            @endcan
            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">Change password</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('global.logout')</button>
{!! Form::close() !!}
