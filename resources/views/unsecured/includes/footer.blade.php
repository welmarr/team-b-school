<footer  style="margin-top: 100px !important;">
    <div class="row">
        <div class="col-2 mb-3">
            <img class="img-fluid" src="{{ asset('img/cincy-transparent.png') }}"  />
        </div>

        <div class="col-1 mb-3 offset-md-2">
          <h6 class="fw-semibold">Main</h6>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="{{ route('unsecured.home') }}" class="nav-link p-0 text-muted {{ isset($activeMenu) && $activeMenu ==  'home' ? 'underline-orange' : '' }}">Home</a></li>
          </ul>
        </div>

        <div class="col-1 mb-3">
          <h6 class="fw-semibold">Meet Us</h6>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="{{ route('unsecured.about') }}" class="nav-link p-0 text-muted {{ isset($activeMenu) && $activeMenu ==  'about' ? 'underline-orange' : '' }}">About us</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Jobs</a></li>
          </ul>
        </div>

        <div class="col-2 mb-3">
          <h6 class="fw-semibold">Services</h6>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="{{ route('unsecured.get-estimate.index') }}" class="nav-link p-0 text-muted {{ isset($activeMenu) && $activeMenu ==  'get-estimate' ? 'underline-orange' : '' }}">Get estimate</a></li>
            <li class="nav-item mb-2"><a href="{{ route('unsecured.track-repair') }}" class="nav-link p-0 text-muted {{ isset($activeMenu) && $activeMenu ==  'track-repair' ? 'underline-orange' : '' }}">Track repair</a></li>
          </ul>
        </div>

        <div class="col-4 mb-3">
          <form>
            <h6 class="fw-bold">Subscribe to our newsletter</h6>
            <p>Join our mailing list to receive updates and exclusive offers.</p>
            <div class="d-flex flex-column flex-sm-row w-100 gap-2">
              <label for="newsletter1" class="visually-hidden">Email address</label>
              <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
              <button class="btn text-white btn-orange" type="button" style="">Subscribe</button>
            </div>
          </form>
        </div>
      </div>

      <div class="d-flex flex-column flex-sm-row justify-content-between py-2 my-4" style="border-top: 1px solid #eb4034 !important">
        <p>&copy; 2024 Team B, Inc. All rights reserved.</p>
        <ul class="list-unstyled d-flex">
          <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="16" height="16"><use xlink:href="#twitter"/></svg></a></li>
          <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="16" height="16"><use xlink:href="#instagram"/></svg></a></li>
          <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="16" height="16"><use xlink:href="#facebook"/></svg></a></li>
        </ul>
      </div>
</footer>
