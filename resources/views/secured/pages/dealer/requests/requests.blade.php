@extends('secured.layout')

@section('title')
    Request - Dealership
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sharing.css') }}">

    <!-- Custom Styles -->
    <style>
        .page-link {
            color: #fb4f14;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }

        .page-link:hover {
            color: #fff !important;
            background-color: #fb4f14 !important;
            border-color: #fb4f14 !important;
        }

        .paginate_button.active>.page-link {
            background-color: #fb4f14 !important;
            border-color: #fb4f14;
            color: white;
        }

        div.dt-buttons {
            float: right !important;
        }

        div.dataTables_wrapper div.dataTables_filter {
            display: flex;
        }

        .dropdown-menu a.dt-button.dropdown-item.active {
            color: inherit;
            text-decoration: none;
            background-color: inherit;
        }

        .dropdown-menu a.dt-button.dropdown-item.active span::after {
            display: inline-block;
            content: "✓";
            color: inherit;
        }
    </style>
@endsection

@section('header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Request</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-orange">Requests</li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="m-0 card-title">Request</h3>
                            <!-- Add New Request Button -->
                            <div class="dt-buttons">
                            <a href="{{ route('secured.dealers.requests.create') }}" class="btn btn-primary">Add Request</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th># No</th>
                                        <th>Reference</th>
                                        <th>Car</th>
                                        <th>Create by</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th># No</th>
                                        <th>Reference</th>
                                        <th>Car</th>
                                        <th>Create by</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('secured.includes.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
@endsection

@section('js-after-bootstrap')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
@endsection

@section('js-after-adminlte')
    <script>
        $(function() {
            let dataURl = '{{ route('api.secure.dealers.requests.index', ['id' => ':request_id']) }}'
            .replace(':request_id', '{{ Auth::user()->id }}');
            var table = $("#example1").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: dataURl,
                    type: "GET",
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, 
                    dataSrc: function(json) {
                        return json.data;
                    },
                    error: function(xhr, error, thrown) {
                        alert('An error occurred while loading the data.');
                    }
                },
                language: {
                    processing: '<div class="d-flex justify-content-center"><div class="spinner-border text-orange" role="status"><span class="sr-only">Loading...</span></div></div>'
                },
                columns: [
                    { data: null, orderable: false, render: function(value, type, full, meta) { return meta.row + 1; } },
                    { data: "reference" },
                    { 
                        data: "car.brand.name",
                        render: function(value, type, full, meta) {
                            return '<strong>' + full.car.brand.name + " " + full.car.model.name + '</strong>';
                        }
                    },
                    { 
                        data: "created_by.first_name",
                        render: function(value, type, full, meta) {
                            return full.created_by.first_name + " " + full.created_by.last_name;
                        }
                    },
                    { data: "created_by.phone" },
                    { data: "created_by.email", visible: false },
                    { 
                        data: "created_at",
                        render: function(value, type, full) {
                            return moment(value).format('Do MMM YYYY');
                        }
                    },
                    { 
                        data: "updated_at", visible: false,
                        render: function(value, type, full) {
                            return moment(value).format('Do MMM YYYY');
                        }
                    },
                    { 
                        data: null, orderable: false,
                        render: function(value, type, full, meta) {
                            let detailUrl = '#';
                            detailUrl = detailUrl.replace(':request', full.id);
                            return `<div class="d-flex justify-content-center gap-1">
                                        <a href="${detailUrl}" class="btn btn-xs btn-success">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </div>`;
                        }
                    }
                ],
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,
                buttons: ["pageLength", "copy", "csv", "excel", "pdf", "print", "colvis"],
                dom: "<'row'<'col-md-6'l><'col-md-6'f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>" +
                    "<'row'<'col-md-12'B>>",
            });

            table.buttons().container().appendTo('.col-md-7:eq(0)');
        });
    </script>
@endsection
