@extends('secured.layout')


@section('title')
    Dashboard - Admin
@endsection

@section('css')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/sharing.css') }}">
@endsection


@section('header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-sm-12 col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fab fa-wpforms"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Requests</span>
                            <span class="info-box-number">
                                {{ $countRequest }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Users</span>
                            <span class="info-box-number">
                                {{ $countUser }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tools"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Tools</span>
                            <span class="info-box-number">
                                {{ $countTool }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-tenge"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Tool types</span>
                            <span class="info-box-number">
                                {{ $countToolType }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fab fa-uniregistry"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">units</span>
                            <span class="info-box-number">
                                {{ $countUnit }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-2">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="far fa-newspaper"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pages</span>
                            <span class="info-box-number">
                                10
                                <small>%</small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable">
                    <!-- Calendar -->
                    <div class="card bg-gradient-success">
                        <div class="card-header border-0">

                            <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i>
                                Calendar
                            </h3>
                            <!-- tools card -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-0">
                            <!--The calendar -->
                            <div id="calendar" style="width: 100%"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.Left col -->

                <!-- right col -->
                <section class="col-lg-5 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Appointment for <strong id="request-list-for"></strong></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0">

                            <div class="modal-body text-center" id="request-list-loader">
                                <div id="loader" class="spinner-border text-success" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>

                            <ul class="products-list product-list-in-card pl-2 pr-2" id="request-list">
                            </ul>
                        </div>

                        <div class="card-footer text-center">
                        </div>
                    </div>
                </section>
                <!-- ./ right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection



@section('footer')
    @include('secured.includes.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
@endsection

@section('js-after-bootstrap')
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
@endsection

@section('js-after-adminlte')
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('adminlte/js/pages/dashboard.js') }}"></script>

    <script>
        $(document).ready(function() {

            // Function to fetch and set enabled dates
            function updateEnabledDates(currentViewDate) {
                $.ajax({
                    url: "{{ route('api.secure.admin.requests.dashboard.appointment.list') }}", //
                    method: 'GET',
                    data: {
                        year: currentViewDate.year(),
                        month: currentViewDate.month() + 1 // Month is zero-indexed
                    },
                    success: function(response) {
                        // Assuming your API returns an array of date strings
                        var enabledDates = response.data.map(function(date) {
                            return moment(date, 'YYYY-MM-DD');
                        });

                        if (enabledDates.length === 0) {
                            // If no dates are enabled, disable all dates in the current month
                            var startOfMonth = currentViewDate.clone().startOf('month');
                            var endOfMonth = currentViewDate.clone().endOf('month');
                            var allDatesInMonth = [];

                            while (startOfMonth.isBefore(endOfMonth) || startOfMonth.isSame(
                                    endOfMonth)) {
                                allDatesInMonth.push(startOfMonth.clone());
                                startOfMonth.add(1, 'days');
                            }

                            $('#calendar').datetimepicker('disabledDates', allDatesInMonth);
                        } else {
                            // Update the datetimepicker with new enabled dates
                            $('#calendar').datetimepicker('enabledDates', enabledDates);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to fetch enabled dates:', error);
                    }
                });
            }


            function updateRequestist(selectedDate) {
                //request-list-for
                //request-list-loader
                $('#request-list-loader').show();
                $('#request-list').hide();
                $.ajax({
                    url: "{{ route('api.secure.admin.requests.dashboard.list') }}",
                    method: 'GET',
                    data: {
                        date: selectedDate.format('YYYY-MM-DD'),
                    },
                    success: function(response) {
                        var requestList = $('#request-list');
                        requestList.empty(); // Clear the current list
                        $('#request-list-for').text(selectedDate.format('YYYY-MM-DD'))
                        console.log(response);

                        if (response.data.length === 0) {
                            var emptyMessage = `
                            <li class="item">
                                <div class="product-info">
                                    <span class="product-title">No requests found for ${selectedDate.format('YYYY-MM-DD')}</span>
                                </div>
                            </li>`;
                            requestList.append(emptyMessage);
                        } else {
                            response.data.forEach(function(item) {
                                let urlView =
                                    "{{ route('secured.admin.requests.show', ['id' => ':request_id']) }}"
                                    .replace(':request_id', item.id);

                                var listItem = `
                                <li class="item">
                                    <div class="product-info">
                                        <a href="${urlView}" class="product-title">${item.reference}
                                            <span class="badge badge-warning float-right">${selectedDate.format('YYYY-MM-DD HH:mm')}</span></a>
                                        <span class="product-description">
                                            ${item.car_brand}/${item.car_model}/${item.car_year}
                                        </span>
                                    </div>
                                </li>`;
                                requestList.append(listItem);
                            });
                        }

                        $('#request-list-loader').hide();
                        $('#request-list').show();
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to fetch request list:', error);
                        $('#request-list-loader').hide();
                        $('#request-list').show();
                    }
                });
            }

            // Fetch initial enabled dates
            var initialViewDate = $('#calendar').datetimepicker('viewDate');
            updateEnabledDates(initialViewDate);
            updateRequestist(initialViewDate);

            var viewDate = $('#calendar').datetimepicker('viewDate');


            // Update enabled dates when the user navigates to a different month
            $('#calendar').on('change.datetimepicker update.datetimepicker', function(e) {
                var currentViewDate = $('#calendar').datetimepicker('viewDate');
                if (e.date) {
                    console.log("Date Selected", e.date.format('YYYY-MM-DD'));
                    updateRequestist(e.date);
                } else {
                    updateEnabledDates(currentViewDate);
                }
            });

        })
    </script>
@endsection
