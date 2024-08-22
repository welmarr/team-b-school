<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link"  href="{{route('logout')}}" role="button">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ isset($activeMenu) && $activeMenu == 'profile' ? 'nav-activated' : '' }}"  href=" {{ Auth::user()->role == 'admin' ? route('secured.admin.profile.view') : route('secured.dealers.profile.view') }}" role="button">
                <i class="fas fa-user-circle"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
