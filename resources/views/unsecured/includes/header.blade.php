<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4" style="border-bottom: 1px solid #eb4034 !important">
    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><a href="{{ route('unsecured.home') }}" class="nav-link px-2 {{ isset($activeMenu) && $activeMenu ==  'home' ? 'text-orange' : 'link-dark' }} fw-semibold">Home</a></li>
      <li><a href="{{ route('unsecured.get-estimate.index') }}" class="nav-link px-2  {{ isset($activeMenu) && $activeMenu ==  'get-estimate' ? 'text-orange' : 'link-dark' }} fw-semibold">Get estimate</a></li>
      <li><a href="{{ route('unsecured.track-repair') }}" class="nav-link px-2 {{ isset($activeMenu) && $activeMenu ==  'track-repair' ? 'text-orange' : 'link-dark' }} fw-semibold">Track repair</a></li>
      <li><a href="{{ route('unsecured.about') }}" class="nav-link px-2 {{ isset($activeMenu) && $activeMenu ==  'about' ? 'text-orange' : 'link-dark' }} fw-semibold">About us</a></li>
    </ul>

    <a href="/" class="d-flex align-items-center text-decoration-none">
        <img class="img-fluid" src="{{ asset('img/cincy-transparent.png') }}" style="width: 45%; height: auto" />
    </a>

    <div class="col-md-3 text-end">
      <a href="{{ route('login') }}" class="btn btn-outline-orange me-2">Login</a>
      <a href="{{ route('unsecured.sign-up') }}" class="btn btn-orange">Sign-up</a>
    </div>
  </header>

  @include('unsecured.includes.svg-icon')
