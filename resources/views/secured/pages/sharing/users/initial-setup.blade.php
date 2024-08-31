@extends('unsecured.layout')


@section('title')
    Set up your password
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/unsecured.css') }}">

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

        #form-section {
            display: flex;
            justify-content: center;
        }

        svg.feather {
            width: 16px !important;
        }
    </style>
@endsection


@section('content')
    <div class="w-100" id="form-section">
        <div class="mt-4" style="max-width: 400px;">

            <form action="{{ route('secured.admin.initialSetupCreate') }}" method="POST">
                @csrf
                <h4 class="my-4 fw-bold text-success">Welcome, {{auth()->user()->first_name}}</h4>
                <p class="text-muted">Please update your password to continue. This step is required for your account security.</p>


                <div class="row">
                    <div class="col-12">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('warning'))
                            <div class="alert alert-warning">
                                {{ session('warning') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <div>
                        This is your first login. Please set up your password before continuing.
                    </div>
                </div>



                <div class="row my-2">
                    <div class="col-12">
                        <label for="password" class="form-label">Password <span class="text-success">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="" spellcheck="false"
                                autocapitalize="none" badinput="false" autocomplete="off" name="password" id="password"
                                required>
                            <button class="btn btn-outline-success" type="button" id="toggle-password"><i
                                    class="toggle-password-icon" data-feather="eye-off"></i></button>
                        </div>
                        @error('password')
                            <div class="text-danger mb-3">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-12">
                        <label for="password-confirmation" class="form-label">Confirm password <span
                                class="text-success">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="" spellcheck="false"
                                autocapitalize="none" badinput="false" autocomplete="off" name="password_confirmation"
                                id="password-confirmation" required>
                            <button class="btn btn-outline-success" type="button" id="toggle-password-confirmation"><i
                                    class="toggle-password-icon" data-feather="eye-off"></i></button>
                        </div>
                        @error('password_confirmation')
                            <div class="text-danger mb-3">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>


                <hr class="mb-4 mt-2">
                <div class="row">
                    <button class="w-100 btn btn-success btn-lg" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('js-before-bootstrap')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
@endsection


@section('js-after-bootstrap')
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <script>
        $(document).ready(function() {

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
        });
    </script>
@endsection
