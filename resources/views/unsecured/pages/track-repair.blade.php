@extends('unsecured.layout')


@section('title')
    Track your repair
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/unsecured.css') }}">

    @if (isset($demand) && $demand->status == 'accepted')
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css') }}">
    @endif
    <style>
        .callout {
            border-radius: 0.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            background-color: #fff;
            border-left: 5px solid #e9ecef;
            margin-bottom: 1rem;
            padding: 1rem;
        }

        .callout a {
            color: #495057;
            text-decoration: underline;
        }

        .callout a:hover {
            color: #e9ecef;
        }

        .callout p:last-child {
            margin-bottom: 0;
        }

        .callout.callout-danger {
            border-left-color: #bd2130;
        }

        .callout.callout-warning {
            border-left-color: #d39e00;
        }

        .callout.callout-info {
            border-left-color: #117a8b;
        }

        .callout.callout-success {
            border-left-color: #1e7e34;
        }

        .dark-mode .callout {
            background-color: #3f474e;
        }

        .dark-mode .callout.callout-danger {
            border-left-color: #ed7669;
        }

        .dark-mode .callout.callout-warning {
            border-left-color: #f5b043;
        }

        .dark-mode .callout.callout-info {
            border-left-color: #5faee3;
        }

        .dark-mode .callout.callout-success {
            border-left-color: #00efb2;
        }
    </style>
@endsection


@section('header')
    @include('unsecured.includes.header')
@endsection

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="offset-3 col-6">
                <h1 class="card-text mb-auto mt-3 fw-semibold">
                    Track the request update
                </h1>
            </div>
        </div>

        <div class="row my-4">
            <div class="offset-3 col-6">
                <span class="badge text-bg-orange">Repair request status</span>
                <span class="mb-4 d-block">Enter your request code in the field below to see the latest updates.

                    <form class="needs-validation" method="GET" id="track-form">
                        @if (session('success') || session('error'))
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
                                </div>
                            </div>
                        @endif


                        @if (isset($error_500))
                            <div class="row">
                                <div class="col-12">
                                    @if (isset($error_500))
                                        <div class="alert alert-danger">
                                            {{ $error_500 }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif



                        @if (isset($reference))
                            @if (isset($error))
                                <div class="row">
                                    <div class="col-12">
                                        @if (isset($error))
                                            <div class="alert alert-danger">
                                                {{ $error }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endif

                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="request-number" class="form-label">Request number</label>
                                <input type="text" class="form-control" id="request-number" placeholder="M575665ON"
                                    value="{{ $reference ?? '' }}" required name="reference">
                            </div>

                            <hr class="my-4">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button class="btn btn-orange mb-5" type="submit" form="#track-form"
                                        id="track-form-button">Display
                                        update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @if (isset($demand))
                        @php
                            $statusClasses = [
                                'init' => 'secondary',
                                'estimated' => 'info',
                                'accepted' => 'primary',
                                'in_progress' => 'warning',
                                'completed' => 'success',
                                'canceled' => 'danger',
                            ];

                            $statusLabels = [
                                'init' => 'Initialized',
                                'estimated' => 'Estimated',
                                'accepted' => 'Accepted',
                                'in_progress' => 'In Progress',
                                'completed' => 'Completed',
                                'canceled' => 'Canceled',
                            ];

                            $statusMessages = [
                                'init' =>
                                    'Your request has been received and is being processed. If you do not receive an estimate within 24 hours, please contact us.',
                                'estimated' =>
                                    'An estimate has been prepared for your request. Please check your email to refuse or accept the estimate.',
                                'accepted' =>
                                    'You have successfully accepted the estimation. The next step is to schedule an appointment. You can either call us or select a convenient date to drop off your vehicle. We’re here to accommodate your schedule and ensure a smooth service experience.',
                                'in_progress' =>
                                    'Your request is currently being worked on. We will notify you upon completion.',
                                'completed' =>
                                    'Your request has been successfully completed. You can pass at any time to get your car. Thank you for your business!',
                                'canceled' =>
                                    'Your request has been canceled. If this was unexpected, please contact us for more information.',
                            ];

                            $statusClass = $statusClasses[$demand->status] ?? 'dark';
                            $statusLabel = $statusLabels[$demand->status] ?? 'Unknown';
                            $statusMessage =
                                $statusMessages[$demand->status] ??
                                'The status of your request is currently unknown. Please contact us for more details.';
                        @endphp
                        <div class="request-status">
                            <div class="alert alert-{{ $statusClass }}">
                                <h5><i class="fas fa-info-circle"></i>
                                    <span class="badge text-bg-{{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                </h5>
                                @if ($demand->status == 'accepted')
                                    @if (isset($appointment))
                                        <p>You are already have one appointment at
                                            <strong>{{ $appointment->appointment_date }}</strong>. If you want to change,
                                            please contact us.
                                        </p>
                                    @else
                                        <p>{{ $statusMessage }}</p>
                                        <form class="needs-validation" method="POST" id="appointment-date-form"
                                            action="{{ route('request.estimation.appointment', ['reference' => $demand->reference]) }}">
                                            @if (session('appointment_success') || session('appointment_error'))
                                                <div class="row">
                                                    <div class="col-12">
                                                        @if (session('appointment_error'))
                                                            <div class="text-danger">
                                                                {{ session('appointment_error') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                            @csrf

                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control datepicker" required
                                                    name="appointment_date" value="" placeholder="MM/DD/YYYY">
                                                <input type="text" class="form-control" required name="appointment_time"
                                                    value="" placeholder="24-hour format (15:00)">
                                                <button class="btn btn-{{ $statusClass }}" type="submit"
                                                    id="appointment-date-form-button" form="#appointment-date-form">Take
                                                    appointment</button>
                                            </div>
                                        </form>

                                    @endif
                                @else
                                    <p>{{ $statusMessage }}</p>
                                @endif
                            </div>
                        </div>
                    @endif

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
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            feather.replace();

            $('#track-form-button').on('click', function() {
                let form = document.getElementById('track-form');
                if (form.checkValidity()) {
                    form.submit();
                } else {
                    form.reportValidity();
                }
            })

            $('#appointment-date-form-button').on('click', function() {
                let form = document.getElementById('appointment-date-form');
                if (form.checkValidity()) {
                    form.submit();
                } else {
                    form.reportValidity();
                }
            })

        })
    </script>


    @if (isset($demand) && $demand->status == 'accepted')
        <script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.datepicker').datepicker();
            })
        </script>
    @endif
@endsection
