<li class="nav-item">
    <a class="nav-link {{ Route::is('dashboard.welcome') ? 'active' : '' }}" href="{{ route('dashboard.welcome') }}">
        <i class="nav-icon fa fa-home"></i>
        <p> @lang('dashboard.dashboard')</p>
    </a>
</li>
@php($user = auth()->user())
@if ($user->hasAnyPermission(['read-locations', 'create-locations']))
    <li
        class="nav-item has-treeview {{ Route::is('dashboard.locations.index') || Route::is('dashboard.locations.create') ? 'menu-open' : '' }}">
        <a href="#"
            class="nav-link {{ Route::is('dashboard.locations.index') || Route::is('dashboard.locations.create') ? 'active' : '' }}">
            <i class="nav-icon fa fa-map-pin"></i>
            <p>
                @lang('dashboard.locations')
                <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('read-locations')
                <li class="nav-item">
                    <a href="{{ route('dashboard.locations.index') }}"
                        class="nav-link {{ Route::is('dashboard.locations.index') ? 'active' : '' }}">
                        <i class="fa fa-map-pin nav-icon"></i>
                        <p>@lang('dashboard.locations')</p>
                    </a>
                </li>
            @endcan
            @can('create-locations')
                <li class="nav-item">
                    <a href="{{ route('dashboard.locations.create') }}"
                        class="nav-link {{ Route::is('dashboard.locations.create') ? 'active' : '' }}">
                        <i class="fa fa-plus nav-icon"></i>
                        <p>@lang('dashboard.add')</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endif
@if ($user->hasAnyPermission(['read-courses', 'create-courses']))
    <li
        class="nav-item has-treeview {{ Route::is('dashboard.courses.index') || Route::is('dashboard.courses.create') ? 'menu-open' : '' }}">
        <a href="#"
            class="nav-link {{ Route::is('dashboard.courses.index') || Route::is('dashboard.courses.create') ? 'active' : '' }}">
            <i class="nav-icon fa fa-users"></i>
            <p>
                @lang('dashboard.courses')
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('read-courses')
                <li class="nav-item">
                    <a href="{{ route('dashboard.courses.index') }}"
                        class="nav-link {{ Route::is('dashboard.courses.index') ? 'active' : '' }}">
                        <i class="fa fa-users nav-icon"></i>
                        <p>@lang('dashboard.courses')</p>
                    </a>
                </li>
            @endcan
            @can('create-courses')
                <li class="nav-item">
                    <a href="{{ route('dashboard.courses.create') }}"
                        class="nav-link {{ Route::is('dashboard.courses.create') ? 'active' : '' }}">
                        <i class="fa fa-plus nav-icon"></i>
                        <p>@lang('dashboard.add')</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endif
@if ($user->hasAnyPermission(['read-trainers', 'create-trainers']))
    <li
        class="nav-item has-treeview {{ Route::is('dashboard.trainers.index') || Route::is('dashboard.trainers.create') ? 'menu-open' : '' }}">
        <a href="#"
            class="nav-link {{ Route::is('dashboard.trainers.index') || Route::is('dashboard.trainers.create') ? 'active' : '' }}">
            <i class="nav-icon fa fa-users"></i>
            <p>
                @lang('dashboard.trainers')
                <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('read-trainers')
                <li class="nav-item">
                    <a href="{{ route('dashboard.trainers.index') }}"
                        class="nav-link {{ Route::is('dashboard.trainers.index') ? 'active' : '' }}">
                        <i class="fa fa-users nav-icon"></i>
                        <p>@lang('dashboard.trainers')</p>
                    </a>
                </li>
            @endcan
            @can('create-trainers')
                <li class="nav-item">
                    <a href="{{ route('dashboard.trainers.create') }}"
                        class="nav-link {{ Route::is('dashboard.trainers.create') ? 'active' : '' }}">
                        <i class="fa fa-plus nav-icon"></i>
                        <p>@lang('dashboard.add')</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endif
@if ($user->hasAnyPermission(['read-students', 'create-students']))
    <li
        class="nav-item has-treeview {{ Route::is('dashboard.students.index') || Route::is('dashboard.students.create') ? 'menu-open' : '' }}">
        <a href="#"
            class="nav-link {{ Route::is('dashboard.students.index') || Route::is('dashboard.students.create') ? 'active' : '' }}">
            <i class="nav-icon fa fa-users"></i>
            <p>
                @lang('dashboard.students')
                <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('read-students')
                <li class="nav-item">
                    <a href="{{ route('dashboard.students.index') }}"
                        class="nav-link {{ Route::is('dashboard.students.index') ? 'active' : '' }}">
                        <i class="fa fa-users nav-icon"></i>
                        <p>@lang('dashboard.students')</p>
                    </a>
                </li>
            @endcan
            @can('create-students')
                <li class="nav-item">
                    <a href="{{ route('dashboard.students.create') }}"
                        class="nav-link {{ Route::is('dashboard.students.create') ? 'active' : '' }}">
                        <i class="fa fa-plus nav-icon"></i>
                        <p>@lang('dashboard.add')</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endif
@if ($user->hasAnyPermission(['read-admins', 'create-admins']))
    <li
        class="nav-item has-treeview {{ Route::is('dashboard.admins.index') || Route::is('dashboard.admins.create') ? 'menu-open' : '' }}">
        <a href="#"
            class="nav-link {{ Route::is('dashboard.admins.index') || Route::is('dashboard.admins.create') ? 'active' : '' }}">
            <i class="nav-icon fa fa-users"></i>
            <p>
                @lang('dashboard.admins')
                <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('read-admins')
                <li class="nav-item">
                    <a href="{{ route('dashboard.admins.index') }}"
                        class="nav-link {{ Route::is('dashboard.admins.index') ? 'active' : '' }}">
                        <i class="fa fa-users nav-icon"></i>
                        <p>@lang('dashboard.admins')</p>
                    </a>
                </li>
            @endcan
            @can('create-admins')
                <li class="nav-item">
                    <a href="{{ route('dashboard.admins.create') }}"
                        class="nav-link {{ Route::is('dashboard.admins.create') ? 'active' : '' }}">
                        <i class="fa fa-plus nav-icon"></i>
                        <p>@lang('dashboard.add')</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endif
@if ($user->hasAnyPermission(['read-users', 'create-users']))
    <li
        class="nav-item has-treeview {{ Route::is('dashboard.users.index') || Route::is('dashboard.users.create') ? 'menu-open' : '' }}">
        <a href="#"
            class="nav-link {{ Route::is('dashboard.users.index') || Route::is('dashboard.users.create') ? 'active' : '' }}">
            <i class="nav-icon fa fa-users"></i>
            <p>
                @lang('dashboard.users')
                <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('read-users')
                <li class="nav-item">
                    <a href="{{ route('dashboard.users.index') }}"
                        class="nav-link {{ Route::is('dashboard.users.index') ? 'active' : '' }}">
                        <i class="fa fa-users nav-icon"></i>
                        <p>@lang('dashboard.users')</p>
                    </a>
                </li>
            @endcan
            @can('create-users')
                <li class="nav-item">
                    <a href="{{ route('dashboard.users.create') }}"
                        class="nav-link {{ Route::is('dashboard.users.create') ? 'active' : '' }}">
                        <i class="fa fa-plus nav-icon"></i>
                        <p>@lang('dashboard.add')</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endif
@role('super-admin')
    <li class="nav-item">
        <a href="{{ route('dashboard.setting.index') }}"
            class="nav-link {{ Route::is('dashboard.setting.index') ? 'active' : '' }}">
            <i class="fa fa fa-cogs nav-icon"></i>
            <p>@lang('dashboard.settings')</p>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('dashboard.setting.audit-logs.index') ? 'active' : '' }}"
            href="{{ route('dashboard.setting.audit-logs.index') }}"><i class="nav-icon fa fa-database"></i>
            <p> @lang('dashboard.audit_logs')</p>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('dashboard.setting.backups.index') ? 'active' : '' }}"
            href="{{ route('dashboard.setting.backups.index') }}"><i class="nav-icon fa fa-database"></i>
            <p> @lang('dashboard.backups')</p>
        </a>
    </li>
@endrole
@php($unread = \App\Models\QaTopic::unreadCount())
<li class="nav-item">
    <a href="{{ route('dashboard.messenger.index') }}"
        class="{{ Route::is('dashboard.messenger.*') ? 'active' : '' }} nav-link">
        <i class="fa-fw fa fa-envelope nav-icon"></i>
        <p>@lang('dashboard.messages')</p>
        @if ($unread > 0)
            <strong>({{ $unread }})</strong>
        @endif
    </a>
</li>
