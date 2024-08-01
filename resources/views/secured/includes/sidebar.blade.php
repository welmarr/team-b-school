<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-orange mt-4 {{-- elevation-1 --}}">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link mb-4">
        <img src="{{ asset('img/cincy-transparent.png') }}" alt="Logo" class="img-fluid mx-auto d-block"
            style="width: 50% !important;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('secured.admin.dashboard') }}"
                        class="nav-link  {{ isset($activeMenu) && $activeMenu == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('secured.admin.users.index') }}"
                        class="nav-link {{ isset($activeMenu) && $activeMenu == 'users' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Users
                            <span class="right badge badge-dark"> 10 New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('secured.admin.requests.index') }}" class="nav-link {{ isset($activeMenu) && $activeMenu == 'requests' ? 'active' : '' }}">
                        <i class="nav-icon fab fa-wpforms"></i>
                        <p>
                            Requests
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Tools
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/calendar.html" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Calendar
                            <span class="badge badge-dark right">2</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Pages
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Setting
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
