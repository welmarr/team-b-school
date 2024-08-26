@extends('secured.layout')

@section('title', 'Request view - Dealer')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">

    @if (isset($demand) && $demand->status == 'accepted')
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css') }}">
    @elseif (isset($demand) && $demand->status == 'in_progress')
        <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
        <style>
            .dropdown-item.active,
            .dropdown-item:active {
                background-color: #ffc107 !important;
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
    @endif

@endsection

@section('header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Request details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('secured.dealers.requests.index') }}"
                                class="text-orange">Requests</a></li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')

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
    @endphp
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-{{ $statusClasses[$demand->status] ?? 'dark' }}">
                    <div class="card-header">
                        <h3 class="card-title">Request Details</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3>
                            <span class="badge badge-{{ $statusClasses[$demand->status] ?? 'dark' }}">
                                {{ $statusLabels[$demand->status] ?? 'Unknown' }}
                            </span>
                        </h3>

                        <hr />

                        <div class="row">
                            <div class="col-sm-12 col-md-6">

                                <strong><i class="fas fa-asterisk"></i> Reference</strong>
                                <p class="text-muted mb-2">{{ $demand->reference }}</p>
                            </div>
                            <div class="col-sm-12  col-md-6">
                                <strong><i class="fas fa-car"></i> Car info</strong>
                                <p class="text-muted  mb-2">
                                    <span
                                        class="tag tag-danger">{{ $demand->car->brand->name }}/{{ $demand->car->model->name }}/{{ $demand->car->year }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            @if ($demand->estimation != 0)
                                <div class="col-6">
                                    <i class="fas fa-money-bill-alt"></i> Estimation</strong>
                                    <p class="text-muted  mb-2">
                                        <span class="tag tag-danger">{{ '$' . $demand->estimation }}</span>
                                    </p>
                                </div>
                            @endif
                            @if ($demand->finish_by != 0)
                                <div class="col-6">
                                    <i class="fas fa-stopwatch"></i> Days need</strong>
                                    <p class="text-muted  mb-2">
                                        <span class="tag tag-danger">{{ $demand->finish_by }}</span>
                                    </p>
                                </div>
                            @endif
                        </div>

                        <hr />

                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                        <p class="text-muted">
                            {{ $demand->memo }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">

                @if ($demand->status == 'init')
                    <div class="card card-{{ $statusClasses[$demand->status] ?? 'dark' }}">
                        <div class="card-header">
                            <h3 class="card-title">Next step</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center text-orange">
                                    <p class="text-center mt-4 mb-1"><i class="fas fa-exclamation-triangle"></i> <br> You
                                        will
                                        get estimation under 48 hours.</p>
                                </div>


                                @if (session('success_cancel'))
                                    <div class="alert alert-success">
                                        {{ session('success_cancel') }}
                                    </div>
                                @endif
                                @if (session('error_cancel'))
                                    <div class="alert alert-danger">
                                        {{ session('error_cancel') }}
                                    </div>
                                @endif

                                <form method="POST" id="cancel-request-form"
                                    action="{{ route('secured.dealers.request.cancel', ['id' => $demand->id]) }}">
                                    @csrf
                                    <input type="hidden" name="code">
                                    <div class="row">
                                        <div class="col-12 text-center mt-2 mb-4">
                                            <button class="btn btn-{{ $statusClasses[$demand->status] ?? 'dark' }}"
                                                type="submit" id="cancel-request-form-button"
                                                form="cancel-request-form">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @elseif ($demand->status == 'estimated')
                    <div class="card card-{{ $statusClasses[$demand->status] ?? 'dark' }}">
                        <div class="card-header">
                            <h3 class="card-title">Budget</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">

                            @if (session('success_accept'))
                                <div class="alert alert-success">
                                    {{ session('success_accept') }}
                                </div>
                            @endif
                            @if (session('error_accept'))
                                <div class="alert alert-danger">
                                    {{ session('error_accept') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-5 col-sm-12">
                                    <strong><i class="fas fa-comment-dollar"></i> Estimated budget sent</strong>
                                    <p class="text-muted  mb-2">
                                        <span class="tag tag-danger">{{ "$" . $demand->estimation }}</span>
                                    </p>
                                    <br>
                                </div>
                                <div class="col-md-5 col-sm-12">
                                    <strong><i class="fas fa-stopwatch"></i> Expected Completion Time</strong>
                                    <p class="text-muted  mb-2">
                                        <span class="tag tag-danger">{{ $demand->finish_by }}</span>
                                    </p>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <form method="POST" id="accept-request-form"
                                        action="{{ route('secured.dealers.request.accept', ['id' => $demand->id]) }}">
                                        @csrf
                                        <input type="hidden" name="code">
                                        <div class="row">
                                            <div class="col-12 text-center mt-2 mb-4">
                                                <button class="btn btn-{{ $statusClasses[$demand->status] ?? 'dark' }}"
                                                    type="submit" id="accept-request-form-button"
                                                    form="accept-request-form">Accept estimation</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                @elseif ($demand->status == 'accepted')
                    <div class="card card-{{ $statusClasses[$demand->status] ?? 'dark' }}">
                        <div class="card-header">
                            <h3 class="card-title">Appointment</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            @if (session('success_appointment'))
                                <div class="alert alert-success">
                                    {{ session('success_appointment') }}
                                </div>
                            @endif

                            @if (session('error_appointment'))
                                <div class="alert alert-danger">
                                    {{ session('error_appointment') }}
                                </div>
                            @endif

                            @if (isset($appointment))
                                <span style="margin-bottom: 10px !important; display: block;"><strong><i
                                            class="far fa-calendar-alt"></i> Appointment take for: </strong>
                                    {{ $appointment->appointment_date }}</span>

                                <span style="margin-bottom: 10px !important; display: block;"><strong><i
                                            class="fas fa-calendar-times"></i>
                                        Contact us to modify your appointment</strong><br></span>
                            @else
                                <span style="margin-bottom: 10px !important; display: block;"><strong><i
                                            class="fas fa-calendar-plus"></i> Add
                                        appointment</strong></span><br>


                                <form class="needs-validation" method="POST" id="appointment-date-form"
                                    action="{{ route('secured.dealers.request.estimation.appointment', ['id' => $demand->id]) }}">
                                    @csrf

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control datepicker" required
                                            name="appointment_date" value="" placeholder="MM/DD/YYYY">
                                        <input type="text" class="form-control" required name="appointment_time"
                                            value="" placeholder="24-hour format (15:00)">
                                        <button class="btn btn-success" type="submit" id="appointment-date-form-button"
                                            form="appointment-date-form">Take
                                            appointment</button>
                                    </div>
                                </form>
                            @endif
                        </div>

                    </div>
                @elseif ($demand->status == 'completed')
                    <div class="card card-{{ $statusClasses[$demand->status] ?? 'dark' }}">
                        <div class="card-header">
                            <h3 class="card-title">Invoice</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">

                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <a class="btn btn-success my-2"
                                        href="{{ route('secured.admin.request.invoice', ['id' => $demand->id]) }}"
                                        id="print-invoice-form-button" form="start-work-form">Print invoice</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="card card-{{ $statusClasses[$demand->status] ?? 'dark' }}">
                    <div class="card-header">
                        <h3 class="card-title">Files</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if (isset($files) && $files->count() > 0)
                            <div class="row mt-3">
                                <div class="col-12 d-flex justify-content-end">
                                    <button
                                        class="btn btn-{{ $statusClasses[$demand->status] ?? 'dark' }} btn-images mr-3"><i
                                            class="fas fa-images"></i></button>
                                </div>
                            </div>
                            <div class="modal fade" id="modal-images">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Images</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="loader" class="spinner-border text-orange" role="status"
                                                style="display: none;">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-dark"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                        <th>File Size</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($files as $file)
                                        <tr class="table-files"
                                            data-file-url="{{ route('secured.admin.file.download', ['public_uri' => $file->public_uri]) }}"
                                            data-file-name={{ $file->name }}>
                                            <td>{{ $file->name }}</td>
                                            <td>{{ convertBytesToKB($file->size) }}</td>
                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('secured.admin.file.download', ['public_uri' => $file->public_uri]) }}"
                                                        class="btn btn-{{ $statusClasses[$demand->status] ?? 'dark' }}"
                                                        target="_blank"><i class="fas fa-file-download"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('secured.includes.footer')
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
@endsection


@section('js-before-bootstrap')
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
@endsection

@section('js-after-bootstrap')
    @if (isset($demand) && $demand->status == 'accepted')
        <script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.datepicker').datepicker();

            })
        </script>
    @elseif (isset($demand) && $demand->status == 'in_progress')
        <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
        <script>
            $(document).ready(function() {

                /**
                 * Configure SweetAlert2 toast
                 * @type {Object}
                 */
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                // Initialize select picker
                $('.my-select').selectpicker();

            })
        </script>
    @endif

    <script>
        $(document).ready(function() {
            function loadImages() {
                const modalBody = $('#modal-images .modal-body');
                const loader = $('#loader');

                modalBody.find('#product-image-section').remove();
                loader.show();
                $('#modal-images').modal('show');

                const files = $('.table-files').map(function() {
                    return {
                        public_uri: $(this).data('file-url'),
                        name: $(this).data('file-name')
                    };
                }).get();

                if (files.length === 0) {
                    modalBody.append('<p>No images available.</p>');
                    loader.hide();
                    return;
                }

                const html = `
                    <div class="col-12" id="product-image-section">
                        <h5 class="d-inline-block">${files[0].name}</h5>
                        <div class="col-12">
                            <img src="${files[0].public_uri}" class="product-image h-50" alt="Product Image">
                        </div>
                        <div class="col-12 product-image-thumbs">
                            ${files.map((file, index) => `
                                                                                                                                                                                                                                                                                                                                                        <div class="product-image-thumb ${index === 0 ? 'active' : ''}">
                                                                                                                                                                                                                                                                                                                                                            <img src="${file.public_uri}" alt="${file.name}">
                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                    `).join('')}
                        </div>
                    </div>
                `;

                modalBody.append(html);
                loader.hide();
            }

            $('.btn-images').on('click', loadImages);

            $('#modal-images').on('click', '.product-image-thumb', function() {
                const $image_element = $(this).find('img');
                $('.product-image').prop('src', $image_element.attr('src'));
                $('.product-image-thumb.active').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
@endsection
