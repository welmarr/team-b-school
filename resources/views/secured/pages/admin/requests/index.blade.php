@extends('secured.layout')


@section('title')
    Request - Admin
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">

    <link rel="stylesheet" href="{{ asset('css/sharing.css') }}">

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


        .dropdown-menu a.dt-button.dropdown-item.button-page-length.active,
        .dropdown-menu a.dt-button.dropdown-item.buttons-columnVisibility.active {
            color: inherit;
            text-decoration: none;
            background-color: inherit;
        }

        .dropdown-menu a.dt-button.dropdown-item.button-page-length.active span,
        .dropdown-menu a.dt-button.dropdown-item.buttons-columnVisibility.active span {
            display: flex;
            justify-content: space-between;
        }

        .dropdown-menu a.dt-button.dropdown-item.button-page-length.active span::after,
        .dropdown-menu a.dt-button.dropdown-item.buttons-columnVisibility.active span::after {
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
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-orange">Requests</li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
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
                        </div>
                        <!-- /.card-header -->
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
                                        <th class="d-flex justify-content-center">Actions</th>
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
                                        <th class="d-flex justify-content-center">Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
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
            // Initialize DataTable with server-side processing
            var table = $("#example1").DataTable({
                "processing": true, // Enable processing indicator
                "serverSide": true, // Enable server-side processing
                "ajax": {
                    "url": "{{ route('api.secure.requests') }}", // Set AJAX source URL
                    "type": "GET",
                    "data": function(d){
                        console.log(d)
                    }
                },
                language: {
                    "processing": '<div class="d-flex justify-content-center"><div class="spinner-border text-orange" role="status"><span class="sr-only">Loading...</span></div></div>'
                },
                "columns": [{
                        "data": null,
                        "orderable": false, // Disable sorting
                        "render": function(value, type, full, meta) {
                            return meta.row + 1; // Row numbering
                        }
                    },
                    {
                        "data": "reference", // First name column
                    },
                    {
                        "data": "car.brand.name", // First name column
                        "orderable": true, // Disable sorting
                        "render": function(value, type, full, meta) {
                           if(type ==  "display"){
                            return '<strong>' + full.car.brand.name + " " + full.car.model.name + '</strong>';
                           }
                           return value;
                        }
                    },
                    {
                        "data": "created_by.first_name", // First name column
                        "orderable": true, // Disable sorting
                        "render": function(value, type, full, meta) {
                           if(type ==  "display"){
                            return full.created_by.first_name + " " + full.created_by.last_name;
                           }
                           return value;
                        }
                    },
                    {
                        "data": "created_by.phone" // Phone column
                    },
                    {
                        "data": "created_by.email", // Phone column
                        "visible": false,
                    },
                    {
                        "data": "created_at", // Updated at column
                        "orderable": true, // Enable sorting
                        "render": function(value, type, full) {
                            if (type === 'display') {
                                return moment(value).format('Do MMM YYYY');
                            }
                            return value; // Return data for other types
                        }
                    },
                    {
                        "data": "updated_at", // Updated at column
                        "orderable": true, // Enable sorting
                        "visible": false,
                        "render": function(value, type, full) {
                            if (type === 'display') {
                                return moment(value).format('Do MMM YYYY');
                            }
                            return value; // Return data for other types
                        }
                    },
                    {
                        "data": null,
                        "orderable": false, // Disable sorting
                        "render": function(value, type, full, meta) {
                            let detailUrl = '{{route("secured.admin.requests.show", ["request" => ":request"])}}';
                            detailUrl = detailUrl.replace(':request', full.id);
                            let actionsTags = '<div class="d-flex justify-content-center">';

                            actionsTags +=
                                '<button type="button" class="btn btn-outline-dark mr-2 btn-sm">Images</button> ';

                            actionsTags +=
                                '<button type="button" class="btn btn-outline-dark btn-sm mr-2">Memo</button> ';
                            actionsTags +=
                                '<a type="button" class="btn btn-dark btn-sm" href="' + detailUrl + '">Details</a> </div>';

                            return actionsTags;
                        }
                    },
                ],
                "responsive": true, // Enable responsive design
                "lengthChange": false, // Disable length change
                "autoWidth": false, // Disable auto width
                "dom": 'Bfrtip', // Define the table control elements to appear
                "buttons": [
                    'copy', 'csv', 'excel', 'pdf', 'print', "pageLength", {
                        extend: 'colvis',
                        columnText: function(dt, idx, title) {
                            if (title == "#") {
                                return idx + 1 + ': No';

                            }
                            return idx + 1 + ': ' + title;
                        }
                    }
                ], // Add buttons
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)'); // Append buttons to container
            // Select all buttons with class 'buttons-html5', remove 'btn-secondary' and add 'btn-dark'
            /* $('.buttons-html5').removeClass('btn-secondary').addClass('btn-dark'); */
            $('.dt-buttons .btn').removeClass('btn-secondary').addClass('btn-dark');

        });
    </script>
@endsection
