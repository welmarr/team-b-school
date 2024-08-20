@extends('unsecured.layout')

@section('title', 'Request Canceled')

@section('body-class', 'd-flex align-items-center justify-content-center vh-100')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/unsecured.css') }}">
@endsection

@section('content')

    <div class="text-center">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <div class="col-12"><i class="text-danger" data-feather="x-circle"></i></div>
                </div>
                <p class="lead mt-3">Your repair request has been canceled.</p>
                <p class="mt-2">We have received your cancellation and will not proceed with the repair. If this was a
                    mistake or
                    you have any questions, please contact us immediately.</p>
                <p class="mt-4">If you change your mind, you can always submit a new request through our platform.</p>
                <div class="btn-group">
                    <a class="btn btn-outline-danger" href="{{ route('home') }}">Home</a>
                </div>
                </p>
            </div>
        </div>
    </div>
@endsection


@section('js-before-bootstrap')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
@endsection

@section('js-after-bootstrap')
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <script>
        // Initialize Feather icons
        feather.replace();
    </script>
@endsection
