@extends('unsecured.layout')


@section('title')
    Account created
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/unsecured.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-doc.css') }}">

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
        <div class="mt-4 row d-flex justify-items-center">
            <div class="offset-3 col-6 text-center mt-5">
                <i class="toggle-password-icon" data-feather="check-circle">
                    <div class="bd-callout bd-callout-info">
                        Your <strong>account has been successfully created</strong> is currently under verification. You
                        will be notified via email once your account has been activated. This process may take up to
                        <strong>72 hours</strong>. Thank you for your patience.
                        <div class="my-4">
                            <a class="w-100 btn btn-orange btn-lg" href="{{ route('unsecured.home') }}">Back to Home page</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection



@section('js-after-bootstrap')
    <script src="{{ asset('js/feather.min.js') }}"></script>
@endsection
