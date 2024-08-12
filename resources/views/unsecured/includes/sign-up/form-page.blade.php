@extends('unsecured.layout')


@section('title')
    Sign up
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/unsecured.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">

    <style>
        html,
        body {
            height: 100%;
        }

        .container {
            display: flex;
            flex-direction: column !important;
            justify-content: space-between;
        }

        ul.dropdown-menu {
            --bs-dropdown-link-active-bg: #fb4f14;
        }


        button.dropdown-toggle {
            background-clip: padding-box !important;
            border: 1px solid #ced4da !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            appearance: none !important;
            --bs-btn-bg: white !important;
        }

        svg.feather {
            width: 16px !important;
        }
        ul.dropdown-menu {
            --bs-dropdown-link-active-bg: #fb4f14;
        }

        /* Style for dropdown toggle button */
        button.dropdown-toggle {
            background-clip: padding-box !important;
            border: 1px solid #ced4da !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            appearance: none !important;
            --bs-btn-bg: white !important;
        }

        /* Style for dropdown container */
        div.dropdown.bootstrap-select.form-select {
            display: block !important;
            width: 100% !important;
            padding: 0px !important;
        }
    </style>
@endsection


@section('content')
    <div class="w-100" id="form-section">
        <div class="row">
            <div class="col-8 offset-2" style="">
                <form action="{{ route('unsecured.ask-for.sign-up') }}" method="POST">
                    @csrf
                    <h4 class="my-4 fw-bold text-orange">Create account</h4>

                    @if ($errors->has('er-500'))
                        <div class="alert alert-danger">
                            <strong>Whoops! Something went wrong.<br/>{{ $errors->first('er-500') }}</strong>
                        </div>
                    @endif

                    <div class="row my-2">
                        <div class="col-6">
                            <label for="first-name" class="form-label">First name <span class="text-orange">*</span></label>
                            <input type="text" class="form-control" id="first-name" name="first_name" placeholder="John"
                                required>

                            @error('first_name')
                                <div class="text-danger mb-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="last-name" class="form-label">Last name <span class="text-orange">*</span></label>
                            <input type="text" class="form-control" id="last-name" name="last_name" placeholder="Doe"
                                required>

                            @error('last_name')
                                <div class="text-danger mb-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-6">
                            <label for="email" class="form-label">Email <span class="text-orange">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="you@example.com" required>

                            @error('email')
                                <div class="text-danger mb-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="phonenumber" class="form-label">Phone <span class="text-orange">*</span></label>
                            <input type="text" class="form-control" id="phonenumber" name="phone"
                                placeholder="123456789" required>

                            @error('phone')
                                <div class="text-danger mb-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-6">
                            <label for="password" class="form-label">Password <span class="text-orange">*</span></label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="password" name="password" placeholder=""
                                    spellcheck="false" autocapitalize="none" autocomplete="off">
                                <button class="btn btn-outline-orange" type="button" id="toggle-password">
                                    <i class="toggle-password-icon" data-feather="eye-off"></i>
                                </button>
                            </div>

                            @error('password')
                                <div class="text-danger mb-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="password-confirmation" class="form-label">Confirm password <span
                                    class="text-orange">*</span></label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="password-confirmation"
                                    name="password_confirmation" placeholder="" spellcheck="false" autocapitalize="none"
                                    autocomplete="off">
                                <button class="btn btn-outline-orange" type="button" id="toggle-password-confirmation">
                                    <i class="toggle-password-confirmation-icon" data-feather="eye-off"></i>
                                </button>
                            </div>

                            @error('password_confirmation')
                                <div class="text-danger mb-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-check my-2">
                        <input type="radio" class="form-check-input custom-radio" id="use_dealership"
                            name="dealership_option" value="use_dealership">
                        <label class="form-check-label" for="use_dealership">Join Dealership</label>
                    </div>

                    <div class="form-check my-2">
                        <input type="radio" class="form-check-input custom-radio" id="create_dealership"
                            name="dealership_option" value="create_dealership" checked>
                        <label class="form-check-label" for="create_dealership">Register Dealership</label>
                    </div>

                    <div class="card my-2" id="dealership_code_group" style="display: none;">
                        <div class="card-body">
                            <h5 class="card-title underline-orange">Join Dealership</h5>
                            <div class="row">
                                <div class="col-12">
                                    <label for="dealership_code" class="form-label">Dealership Code <span
                                            class="text-orange">*</span></label>
                                    <input type="text" class="form-control" id="dealership_code"
                                        name="dealership_code" placeholder="Enter Dealership Code">

                                    @error('dealership_code')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card my-2" id="create_dealership_group">
                        <div class="card-body">
                            <h5 class="card-title underline-orange">Register Dealership</h5>
                            <div class="row my-2">
                                <div class="col-6">
                                    <label for="new_dealership_name" class="form-label">New Dealership Name <span
                                            class="text-orange">*</span></label>
                                    <input type="text" class="form-control" id="new_dealership_name"
                                        name="new_dealership_name" placeholder="New Dealership Name" required>

                                    @error('new_dealership_name')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="new_dealership_phone" class="form-label">New Dealership Phone <span
                                            class="text-orange">*</span></label>
                                    <input type="text" class="form-control" id="new_dealership_phone"
                                        name="new_dealership_phone" placeholder="New Dealership Phone" required>

                                    @error('new_dealership_phone')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address"
                                        name="new_dealership_address_line_1" placeholder="1234 Main St">

                                    @error('new_dealership_address_line_1')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="address2" class="form-label">Address 2 </label>
                                    <input type="text" class="form-control" id="address2"
                                        name="new_dealership_address_line_2" placeholder="Apartment or suite">

                                    @error('new_dealership_address_line_2')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <select class="form-select my-select" data-live-search="true" id="state"
                                        name="new_dealership_state">
                                        <option value="">Choose...</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District Of Columbia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                    </select>

                                    @error('new_dealership_state')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-5">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="new_dealership_city"
                                        placeholder="City">

                                    @error('new_dealership_city')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-3">
                                    <label for="zip" class="form-label">Zip</label>
                                    <input type="text" class="form-control" id="zip" name="new_dealership_zip"
                                        placeholder="Zip code">

                                    @error('new_dealership_zip')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">

                            </div>
                        </div>
                    </div>

                    <hr class="mt-4 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <button class="w-100 btn btn-orange btn-lg" type="submit">Create</button>
                            <p class="mt-2">Already have an account? <a href="{{ route('unsecured.login') }}"
                                    class="text-orange">Login</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('footer')
    @include('unsecured.includes.footer')
@endsection



@section('js-before-bootstrap')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
@endsection


@section('js-after-bootstrap')
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.my-select').selectpicker();


            feather.replace(); // Initialize Feather icons

            $('#toggle-password').on('click', function() {
                let passwordField = $('#password');
                let passwordFieldType = passwordField.attr('type');
                let icon = $('.toggle-password-icon');

                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                    icon.replaceWith(feather.icons['eye'].toSvg({
                        class: 'toggle-password-icon'
                    }));
                } else {
                    passwordField.attr('type', 'password');
                    icon.replaceWith(feather.icons['eye-off'].toSvg({
                        class: 'toggle-password-icon'
                    }));
                }
            });


            $('#toggle-password-confirmation').on('click', function() {
                let passwordField = $('#password-confirmation');
                let passwordFieldType = passwordField.attr('type');
                let icon = $('.toggle-password-confirmation-icon');

                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                    icon.replaceWith(feather.icons['eye'].toSvg({
                        class: 'toggle-password-confirmation-icon'
                    }));

                } else {
                    passwordField.attr('type', 'password');
                    icon.replaceWith(feather.icons['eye-off'].toSvg({
                        class: 'toggle-password-confirmation-icon'
                    }));
                }
            });


            $(document).ready(function() {
                $('input[name="dealership_option"]').on('change', function() {
                    let dealershipCodeGroup = $('#dealership_code_group');
                    let createDealershipGroup = $('#create_dealership_group');
                    if ($(this).val() === 'use_dealership') {
                        dealershipCodeGroup.show();
                        createDealershipGroup.hide();
                        createDealershipGroup.find('input').val('')
                    } else if ($(this).val() === 'create_dealership') {
                        dealershipCodeGroup.hide();
                        createDealershipGroup.show();
                        dealershipCodeGroup.find('input').val('');
                    }
                });
            });
        });
    </script>
@endsection
