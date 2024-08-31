@extends('unsecured.layout')


@section('title')
    Login
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

@php
    $enable_help_session = false;
@endphp


@section('content')
    <div class="w-100" id="form-section">
        <div class="mt-4" style="max-width: 400px;">

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                <h4 class="my-4 fw-bold text-orange">Welcome to Cincy Dent Repair !</h4>


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

                <div class="row">
                    <div class="col-12">
                        <label for="email" class="form-label">Email <span class="text-orange">*</span></label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com"
                            name="email" spellcheck="false" autocapitalize="none" badinput="false" autocomplete="off"
                            required>

                        @error('email')
                            <div class="text-danger mb-3">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-12">
                        <label for="password" class="form-label">Password <span class="text-orange">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="" spellcheck="false"
                                autocapitalize="none" badinput="false" autocomplete="off" name="password" id="password"
                                required>
                            <button class="btn btn-outline-orange" type="button" id="toggle-password"><i
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
                    <div class="col-6">
                        <a href="{{ route('forgot-password.view') }}"
                            class="text-decoration-underline text-dark">Forgot password</a>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input custom-checkbox" id="remember-me">
                            <label class="form-check-label" for="remember-me">Remember me</label>
                        </div>
                    </div>
                </div>

                <hr class="mb-4 mt-2">
                <div class="row">
                    <button class="w-100 btn btn-orange btn-lg" type="submit">Log in</button>
                    <p class="mt-2">Don’t have an account? <a href="{{ route('sign-up') }}"
                            class="text-orange">Sign up</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('footer')
    @include('unsecured.includes.footer')
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
        });
    </script>
@endsection
