@extends('secured.layout')

@section('title', 'Request - Admin')

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
                        <li class="breadcrumb-item"><a href="{{ route('secured.admin.requests.index') }}"
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
                            <div class="col-6">
                                <strong><i class="fas fa-map-marker-alt mr-1"></i>
                                    Location</strong>
                                <p class="text-muted mb-2">Malibu, California</p>
                            </div>
                            @if ($demand->estimation != 0)
                                <div class="col-6">
                                    <i class="fas fa-money-bill-alt"></i> Estimation</strong>
                                    <p class="text-muted  mb-2">
                                        <span class="tag tag-danger">{{ '$' . $demand->estimation }}</span>
                                    </p>
                                </div>
                            @endif
                        </div>
                        <div class="row">
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
                            <form method="post" id="form-extimated"
                                action="{{ route('secured.admin.requests.estimate.submit', ['id' => $demand->id]) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="inputEstimatedBudget">Estimated budget</label>
                                    <input type="number" id="inputEstimatedBudget" class="form-control" value=""
                                        name="budget" step="1">
                                </div>
                                <div class="form-group">
                                    <label for="inputEstimatedDuration"> Estimated repair duration (in working days)
                                    </label>
                                    <input type="number" id="inputEstimatedDuration" class="form-control" value=""
                                        name="duration" step="1">
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 d-flex justify-content-end">
                                        <input type="submit" value="Submit" class="btn btn-success" form="form-extimated">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                @elseif ($demand->status == 'estimated')
                    <div class="card card-{{ $statusClasses[$demand->status] ?? 'dark' }}">
                        <div class="card-header">
                            <h3 class="card-title">Budget</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="callout callout-{{ $statusClasses[$demand->status] ?? 'dark' }}">
                                <h5><i class="fas fa-warning"></i> Note:</h5>
                                The estimation is already sent to the customer. You can call him if need.
                            </div>
                            <strong><i class="fas fa-comment-dollar"></i> Estimated budget sent</strong>
                            <p class="text-muted  mb-2">
                                <span class="tag tag-danger">{{ "$" . $demand->estimation }}</span>
                            </p>
                            <br>

                            <strong><i class="fas fa-stopwatch"></i> Expected Completion Time</strong>
                            <p class="text-muted  mb-2">
                                <span class="tag tag-danger">{{ $demand->finish_by }}</span>
                            </p>
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

                            @if (isset($appointment))
                                <span style="margin-bottom: 10px !important; display: block;"><strong><i
                                            class="far fa-calendar-alt"></i> Appointment take for: </strong>
                                    {{ $appointment->appointment_date }}</span>

                                <span style="margin-bottom: 10px !important; display: block;"><strong><i
                                            class="fas fa-calendar-times"></i>
                                        Modify appointment</strong><br></span>
                            @else
                                <span style="margin-bottom: 10px !important; display: block;"><strong><i
                                            class="fas fa-calendar-plus"></i> Add
                                        appointment</strong></span><br>
                            @endif

                            <form class="needs-validation" method="POST" id="appointment-date-form"
                                action="{{ route('secured.admin.request.estimation.appointment', ['id' => $demand->id]) }}">
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
                        </div>

                    </div>
                    @if (isset($appointment))

                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Work</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                @php
                                    $start = null;
                                    $appoitment_c = \Carbon\Carbon::parse($appointment->appointment_date);
                                    $diff_ = $appoitment_c->diffInDays(\Carbon\Carbon::today());
                                    $diff_ = (int) $diff_;
                                    if ($diff_ >= 0) {
                                        $start = \Carbon\Carbon::today()->format('Y-m-d');
                                    } else {
                                        $start = $appoitment_c->format('Y-m-d');
                                    }
                                    $end_days_c = \Carbon\Carbon::parse($start)->addDays($demand->finish_by);
                                    $end_days = $end_days_c->format('Y-m-d');
                                @endphp
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-start">If start</th>
                                            <th class="text-center">Progression</th>
                                            <th class="text-end">Will finished</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="text-start">{{ $start }}</th>
                                            <th>
                                                <div class="progress" style="flex: 1;">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                    </div>
                                                </div>
                                            </th>
                                            <th class="text-end">{{ $end_days }}</th>
                                        </tr>
                                    </tbody>
                                </table>

                                @if ($diff_ >= 0)
                                    <div class="">
                                        @if (session('error_start'))
                                            <div class="alert alert-danger">
                                                {{ session('error_start') }}
                                            </div>
                                        @endif

                                        <form method="POST" id="start-work-form"
                                            action="{{ route('secured.admin.request.start', ['id' => $demand->id]) }}">
                                            @csrf
                                            <input type="hidden" name="code">
                                        </form>
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-end">
                                                <button class="btn btn-success mt-4 mr-3" type="submit"
                                                    id="start-work-form-button" form="start-work-form">Start</button>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                            </div>

                        </div>
                    @endif
                @elseif ($demand->status == 'in_progress')
                    <!-- Modal for adding a new unit -->
                    <div class="modal fade" id="modal-add-tool-usage">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add tool usage</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="modal-add-tool-usage-form" method="POST" action="" autocomplete="off">
                                    <div class="modal-body">
                                        <div class="d-block  text-center">
                                            <div id="modal-add-tool-usage-form-loader" class="spinner-border text-warning"
                                                role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                        <div id="modal-add-tool-usage-form-content" style="display: none;">
                                            <p class="badge badge-dark my-0"> Field with <span
                                                    class="text-orange">*</span> is
                                                mandatory.
                                            </p>
                                            @csrf
                                            <div class="row my-2">
                                                <div class="col-12 form-group">
                                                    <label for="modal-add-tool-usage-form-tool" class="form-label">Tool
                                                        <span class="text-orange">*</span></label>
                                                    <select class="form-select my-select" aria-label=""
                                                        id="modal-add-tool-usage-form-tool" data-live-search="true"
                                                        name="tool">
                                                        <option selected value="">Select the tool</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row my-2">
                                                <div class="col-12 form-group">
                                                    <label for="modal-add-tool-usage-form-qty" class="form-label">Quantity
                                                        <span class="text-orange">*</span></label>
                                                    <input type="text" class="form-control"
                                                        id="modal-add-tool-usage-form-qty" name="qty" placeholder=""
                                                        required autocomplete="off">

                                                    <div class="text-danger mb-3  d-none modal-add-tool-usage-form-input-error"
                                                        id="qty-error">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" form="modal-add-tool-usage-form" class="btn btn-warning"
                                            id="modal-add-tool-usage-submit" attr-call-url=""
                                            attr-call-by="">Add</button>
                                        <button type="button" class="btn btn-orange"
                                            data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="card card-{{ $statusClasses[$demand->status] ?? 'dark' }}">
                        <div class="card-header">
                            <h3 class="card-title">Tools used</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="row mt-3">
                                <div class="col-12 px-3">
                                    @if (session('error_completed'))
                                        <div class="alert alert-danger">
                                            {{ session('error_completed') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 d-flex justify-content-between">
                                    <form action="{{ route('secured.admin.request.complete', ['id' => $demand->id]) }}" id="request-completed-submit-form" method="POST">
                                        @csrf

                                    <button type="submit" class="btn btn-success ml-3 modal-request-completed" id="request-completed-submit" form="request-completed-submit-form"><i
                                        class="fas fa-check"></i> Request completed</button>
                                    </form>
                                    <button
                                        class="btn btn-{{ $statusClasses[$demand->status] ?? 'dark' }} mr-3 modal-add-tool-add-handler"
                                        data-mode="add"
                                        data-href="{{ route('api.secure.requests.tools.usage.add', ['request_id' => $demand->id]) }}"><i
                                            class="fas fa-plus-circle"></i>
                                        Add tool</button>
                                </div>
                            </div>

                            <table class="table" id="tool-usage-table">
                                <thead>
                                    <tr>
                                        <th>Tool Name</th>
                                        <th>Quantity used</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($inventories)
                                        @foreach ($inventories as $inventory)
                                            <tr id="tool-usage-row-{{ $inventory->id }}">
                                                <td>{{ $inventory->tool->name }}</td>
                                                <td>{{ \abs($inventory->quantity) }}
                                                    {{ $inventory->tool->unit->abbreviation }}</td>
                                                <td class="text-right py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button" data-qty="{{ \abs($inventory->quantity) }}"
                                                            data-href="{{ route('api.secure.requests.tools.usage.update', ['request_id' => $demand->id, 'inventory' => $inventory->id]) }}"
                                                            data-id="{{ $inventory->id }}"
                                                            data-tool-id="{{ $inventory->tool->id }}"
                                                            class="btn btn-{{ $statusClasses[$demand->status] ?? 'dark' }} modal-add-tool-edit-handler"><i
                                                                class="fas fa-pen"></i></button>
                                                        <button type="button"data-id="{{ $inventory->id }}" data-href=""
                                                            class="btn btn-outline-{{ $statusClasses[$demand->status] ?? 'dark' }}"><i
                                                                class="fas fa-trash-alt"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
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
                                    <a class="btn btn-success my-2" href="{{route('secured.admin.request.invoice', ['id' => $demand->id])}}"
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

                $(document).on('click', '.modal-add-tool-add-handler', function() {
                    console.log('Button clicked, toggling modal...');
                    $('#modal-add-tool-usage-form')[0].reset(); // Reset the form fields
                    populateToolSelect();
                    $('#modal-add-tool-usage-form').attr('action', $(this).data('href'));
                    $('#modal-add-tool-usage-form').find('input[name="_method"]').remove();


                    $('#modal-add-tool-usage-form-loader').hide();
                    $('#modal-add-tool-usage-form-content').show();
                    $('#modal-add-tool-usage').modal('show');
                });

                $(document).on('click', '.modal-add-tool-edit-handler', function() {
                    $('#modal-add-tool-usage-form')[0].reset();
                    //populateToolSelect(); // Populate the select options
                    var toolId = $(this).data('tool-id');
                    var qty = $(this).data('qty');
                    var id = $(this).data('id');

                    populateToolSelect(toolId);

                    $('#modal-add-tool-usage-form-tool').val(toolId);
                    $('#modal-add-tool-usage-form-qty').val(qty);

                    $('#modal-add-tool-usage-form').attr('action', $(this).data('href'));
                    if (!$('#modal-add-tool-usage-form').find('input[name="_method"]').length) {
                        $('#modal-add-tool-usage-form').append(
                            '<input type="hidden" name="_method" value="PUT">');
                    }

                    $('#modal-add-tool-usage-form-loader').hide();
                    $('#modal-add-tool-usage-form-content').show();
                    $('#modal-add-tool-usage').modal('show');
                });

                function populateToolSelect(selected = null) {
                    $.ajax({
                        url: "{{ route('api.secure.tools.list') }}", // The route to get the tools
                        method: 'GET',
                        success: function(response) {
                            // console.log(selected);
                            if (response.data && response.data.length > 0) {
                                var selectElement = $('#modal-add-tool-usage-form-tool');
                                selectElement.empty(); // Clear any existing options
                                // Add a default option
                                selectElement.append(
                                    '<option selected value="">Select the tool</option>');

                                // Loop through each tool and append to the select
                                $.each(response.data, function(index, tool) {
                                    selectElement.append('<option value="' + tool.id +
                                        '">' + tool.name + '</option>');
                                });
                                // Refresh the select picker
                                selectElement.selectpicker('destroy');
                                selectElement.selectpicker('render');

                                if (selected) {
                                    // console.log('val ------> ' + selected)
                                    selectElement.selectpicker('val', '' + selected);
                                }
                            } else {
                                console.log('No tools found.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log('There was an error fetching the tools: ' + error);
                        }
                    });
                }

                // Handle form submission for adding or updating tool usage
                $('#modal-add-tool-usage-form').submit(function(event) {
                    event.preventDefault();
                    var form = $(this);

                    var method = form.attr('method');

                    if (form.find('input[name="_method"]').length) {
                        method = 'PUT'; // Assuming a hidden _method field is used for PUT requests
                    } else {
                        method = 'POST'; // Default to POST if no _method field is found
                    }
                    // console.log("submitted", method, $(this).attr('action'), $(this).serialize());

                    $.ajax({
                        url: $(this).attr('action'),
                        method: method,
                        data: $(this).serialize(),
                        success: function(response) {
                            console.log(response);
                            if (response.data) {

                                var updateRouteTemplate =
                                    "{{ route('api.secure.requests.tools.usage.update', ['request_id' => ':request_id', 'inventory' => ':inventory']) }}"
                                    .replace('request_id', response.data.request_id).replace(
                                        'inventory', response.data.id);
                                var deleteRouteTemplate =
                                    "{{ route('api.secure.requests.tools.usage.delete', ['request_id' => ':request_id', 'inventory' => ':inventory']) }}"
                                    .replace('request_id', response.data.request_id).replace(
                                        'inventory', response.data.id);

                                var rowId = 'tool-usage-row-' + response.data.id;
                                var rowHtml = '<tr id="' + rowId + '">' +
                                    '<td>' + response.data.tool.name + '</td>' +
                                    '<td>' + Math.abs(response.data.quantity) + '</td>' +
                                    '<td class="text-right py-0 align-middle">' +
                                    '<div class="btn-group btn-group-sm">' +
                                    '<button type="button" data-qty="' + Math.abs(response.data
                                        .quantity) + '"' +
                                    ' data-href="' + updateRouteTemplate + '"' +
                                    ' data-id="' + response.data.id + '"' +
                                    ' data-tool-id="' + response.data.tool_id + '"' +
                                    ' class="btn btn-warning modal-add-tool-edit-handler">' +
                                    '<i class="fas fa-pen"></i></button>' +
                                    '<button type="button" data-id="' + response.data.id + '"' +
                                    ' data-href="' + deleteRouteTemplate + '"' +
                                    ' class="btn btn-outline-warning">' +
                                    '<i class="fas fa-trash-alt"></i></button>' +
                                    '</div>' +
                                    '</td>' +
                                    '</tr>';

                                // console.log(rowHtml)

                                if ($('#' + rowId).length) {
                                    $('#' + rowId).replaceWith(rowHtml);
                                    console.log("UPDATE")
                                } else {
                                    $('#tool-usage-table tbody').append(rowHtml);
                                    console.log("ADD")
                                }


                                $('#modal-add-tool-usage').modal('hide');

                                Toast.fire({
                                    icon: 'success',
                                    title: response.msg
                                });
                            }
                        },
                        error: function(xhr) {


                            $('#modal-add-tool-usage').modal('hide');
                            console.log(xhr);

                            var errors = xhr.responseJSON.errors;
                            var errorMessages = Object.values(errors).map(error => error.join('\n'))
                                .join('\n');

                            Toast.fire({
                                icon: 'error',
                                title: `There are some validation errors.\n${errorMessages}`
                            });
                        }
                    });
                });

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
