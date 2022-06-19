<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard.welcome') }}" class="brand-link">
        <img src="{{ Storage::url(setting('logo')) }}" alt="Logo" class="brand-image"
            style="border-radius: .25rem;opacity: .8">
        <span class="brand-text font-weight-light">{{ setting('name') }}</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('default.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('dashboard.profile.edit') }}" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li>
                    <select class="searchable-field form-control"></select>
                </li>
                @include('layouts.dashboard._sidebar')
            </ul>
        </nav>
    </div>
</aside>
