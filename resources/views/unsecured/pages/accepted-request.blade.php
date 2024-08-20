@extends('unsecured.layout')

@section('title', 'Request Accepted')

@section('body-class', 'd-flex align-items-center justify-content-center vh-100')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/unsecured.css') }}">
@endsection

@section('content')
    <div class="text-center">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <div class="col-12"><i class="text-success" data-feather="check-circle"></i></div>
                </div>
                <p class="lead mt-3">Thank you for accepting the repair estimation. Your request is now being processed.</p>
                <p class="mt-2">Our team will begin work on your vehicle shortly. You will be notified once the repair is
                    complete.
                    If you have any questions, please do not hesitate to contact us.</p>
                <div class="btn-group">
                    <a class="btn btn-outline-success" href="{{ route('home') }}">Home</a><a class="btn btn-success"
                        href="{{ route('get-estimate.view', ['reference' => $reference]) }}">Track Repair</a>
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
        $(document).ready(function() {
            // Initialize Feather icons
            feather.replace();
        });
    </script>
@endsection
