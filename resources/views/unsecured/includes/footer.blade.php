@if (!isset($enable_help_session) || (isset($enable_help_session) && $enable_help_session == true))
    <div class="row" style="margin-top: 50px !important;">
        <h1 class="card-text mb-auto fw-semibold d-flex align-items-center justify-content-center">
            We're Here to Help
        </h1>
        <div class="row my-4" style="margin-top: 50px !important;">
            <div class="col-sm-12 col-md-6 d-flex align-items-center flex-column mt-md-1">
                <i class="text-orange" data-feather="mail" style="width: 64px; height: 64px;"></i>
                <h4 class="my-2 fw-bold">Email</h4>
                <p class="mb-3">If you have any questions, please feel free reach out to our customer
                    support team.</p>
                <a href="mailto:chris@cincydentrepair.com" class="underline-orange"
                    style="color: inherit;">chris@cincydentrepair.com</a>
            </div>

            <div class="col-sm-12 col-md-6 d-flex align-items-center flex-column mt-sm-4 mt-md-1">
                <i class="text-orange" data-feather="phone" style="width: 64px; height: 64px;"></i>
                <h4 class="my-2 fw-bold">Phone</h4>
                <p class="mb-2">You can contact us by phone during our business hours.</p>
                <span class="underline-orange">(513)515-0941</span>
            </div>
        </div>
    </div>
@endif

<footer style="margin-top: 100px !important;">
    <div class="row">
        <div class="col-2 mb-3">
            <a href="{{ route('home') }}"><img class="img-fluid" src="{{ asset('img/cincy-transparent.png') }}" /></a>
        </div>

        <div class="col-1 mb-3 offset-md-2">
            <h6 class="fw-semibold">Main</h6>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="{{ route('home') }}"
                        class="nav-link p-0 text-muted {{ isset($activeMenu) && $activeMenu == 'home' ? 'underline-orange' : '' }}">Home</a>
                </li>
            </ul>
        </div>

        <div class="col-1 mb-3">
            <h6 class="fw-semibold">Meet Us</h6>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="{{ route('about') }}"
                        class="nav-link p-0 text-muted {{ isset($activeMenu) && $activeMenu == 'about' ? 'underline-orange' : '' }}">About
                        us</a></li>
            </ul>
        </div>

        <div class="col-2 mb-3">
            <h6 class="fw-semibold">Services</h6>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="{{ route('get-estimate.view') }}"
                        class="nav-link p-0 text-muted {{ isset($activeMenu) && $activeMenu == 'get-estimate' ? 'underline-orange' : '' }}">Get
                        estimate</a></li>
                <li class="nav-item mb-2"><a href="{{ route('track-repair.view') }}"
                        class="nav-link p-0 text-muted {{ isset($activeMenu) && $activeMenu == 'track-repair' ? 'underline-orange' : '' }}">Track
                        repair</a></li>
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

    <div class="d-flex flex-column flex-sm-row justify-content-between py-2 my-4"
        style="border-top: 1px solid #eb4034 !important">
        <p>&copy; 2024 Team B, Inc. All rights reserved.</p>
        <ul class="list-unstyled d-flex">
            <li class="ms-3"><a class="link-dark"
                    href="https://www.instagram.com/cincydentrepair?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><svg
                        class="bi" width="16" height="16">
                        <use xlink:href="#instagram" />
                    </svg></a></li>
            <li class="ms-3"><a class="link-dark" href="https://www.facebook.com/profile.php?id=61558731607535"><svg
                        class="bi" width="16" height="16">
                        <use xlink:href="#facebook" />
                    </svg></a></li>
        </ul>
    </div>
</footer>
