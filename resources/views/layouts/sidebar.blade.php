  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0);" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="javascript:void(0);" class="d-block">{{ Auth::user()->name }}</a>
        </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item">
                @if(Auth::user()->type == 'admin')
                    <a href="{{ route('admin.home') }}" class="{{ (request()->is('admin/dashboard')) ? 'active' : '' }} nav-link">
                @elseif(Auth::user()->type == 'manager')
                    <a href="{{ route('manager.home') }}" class="{{ (request()->is('manager/dashboard')) ? 'active' : '' }} nav-link">
                @else
                    <a href="{{ route('home') }}" class="{{ (request()->is('dashboard')) ? 'active' : '' }} nav-link">
                @endif
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
            </li>
            @if(Auth::user()->type == 'admin')
            <li class="nav-item">
                <a href="{{ route('categories.list') }}" class="nav-link {{ (request()->is('admin/categories*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>
                    Categories
                </p>
            </a>
            </li>
            @endif
            @if(Auth::user()->type == 'admin')
            <li class="nav-item">
                <a href="{{ route('amenities.list') }}" class="nav-link {{ (request()->is('admin/amenities*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-layer-group"></i>
                <p>
                    Amenities
                </p>
            </a>
            </li>
            @endif
            @if(Auth::user()->type == 'admin')
            <li class="nav-item">
                <a href="{{ route('venues.list') }}" class="nav-link {{ (request()->is('admin/venues*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-location-arrow"></i>
                <p>
                    Venues
                </p>
            </a>
            </li>
            @endif
            @if(Auth::user()->type == 'admin')
            <li class="nav-item">
                <a href="{{ route('users.list') }}" class="nav-link {{ (request()->is('admin/users*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Users
                </p>
            </a>
            </li>
            @endif
            @if(Auth::user()->type == 'admin')
            <li class="nav-item">
                <a href="{{ route('bookings.list') }}" class="nav-link {{ (request()->is('admin/bookings*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Bookings
                </p>
            </a>
            </li>
            @endif
            @if(Auth::user()->type == 'admin')
            <li class="nav-item">
                <a href="{{ route('reviews.list') }}" class="nav-link {{ (request()->is('admin/reviews*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                    Review
                </p>
            </a>
            </li>
            @endif
        </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>