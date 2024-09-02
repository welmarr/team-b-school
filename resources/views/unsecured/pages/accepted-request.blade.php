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
                <p class="lead mt-3">Thank you for accepting the repair estimation.</p>
                <p class="mt-2">The next step is to schedule an appointment. Simply click the link below to be redirected
                    to our appointment booking page. If you have any questions or need further assistance, please feel free
                    to contact us anytime.</p>
                <div class="btn-group"><a class="btn btn-success"
                        href="{{ route('track-repair.view', ['reference' => $reference]) }}">Track Repair</a>
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
