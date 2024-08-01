@extends('secured.layout')


@section('title')
    Users - Admin
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
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-orange">Users</li>
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
                            <h3 class="m-0 card-title">Users</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Phone</th>
                                        <th>Type</th>
                                        <th class="d-flex justify-content-center">Status</th>
                                        <th>Created at</th>
                                        <th class="d-flex justify-content-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Phone</th>
                                        <th>Type</th>
                                        <th class="d-flex justify-content-center">Status</th>
                                        <th>Created at</th>
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
            $("#example1").DataTable({
                "processing": true, // Enable processing indicator
                "serverSide": true, // Enable server-side processing
                "ajax": "{{ route('api.secure.users') }}", // Set AJAX source URL
                language: {
                    "processing": '<div class="d-flex justify-content-center"><div class="spinner-border text-orange" role="status"><span class="sr-only">Loading...</span></div></div>'
                },
                "columns": [{
                        "data": null,
                        "orderable": false, // Disable sorting
                        "render": function(data, type, full, meta) {
                            return meta.row + 1; // Row numbering
                        }
                    },
                    {
                        "data": "first_name" // First name column
                    },
                    {
                        "data": "last_name" // Last name column
                    },
                    {
                        "data": "phone" // Phone column
                    },
                    {
                        "data": "role", // Updated at column
                        "orderable": true, // Enable sorting
                        "render": function(value, type, full) {
                            if (type === 'display') {
                                if (value == "admin") {
                                    return '<strong>' + value + '</strong>';
                                }
                                return '<em>' + value + '</em>';
                            }
                            return value; // Return data for other types
                        }
                    },
                    {
                        "data": 'is_active', // Activated status column
                        "orderable": true, // Enable sorting
                        "render": function(value, type, full) {
                            if (type === 'display') {
                                // Render display for 'display' type
                                if (typeof value !== 'object') {
                                    if (value == 1) {
                                        return '<span class="text-success d-flex justify-content-center"><i class="fas fa-user"></i></span>'; // Display 'Enable' badge
                                    } else {
                                        return '<span class="text-danger d-flex  justify-content-center"><i class="fas fa-user-slash"></i></span>'; // Display 'Disable' badge
                                    }
                                } else {
                                    return '<span class="text-secondary">Error</span>'; // Display 'Error' badge
                                }
                            }
                            return value; // Return data for other types
                        }
                    },
                    {
                        "data": "updated_at", // Updated at column
                        "orderable": true, // Enable sorting
                        "render": function(value, type, full) {
                            if (type === 'display') {
                                console.log(value);
                                return moment(value).format('Do MMM YYYY');
                            }
                            return value; // Return data for other types
                        }
                    },
                    {
                        "data": null,
                        "orderable": false, // Disable sorting
                        "render": function(value, type, full, meta) {
                            let actionsTags = '<div class="d-flex justify-content-center">';

                            if (typeof value === 'object') {
                                if (value.is_active === 1) {
                                    actionsTags +=
                                        '<button type="button" class="btn btn-outline-dark mr-2 btn-sm">Disable</button> '; // Display 'Enable' badge
                                } else {
                                    actionsTags +=
                                        '<button type="button" class="btn btn-outline-dark mr-2 btn-sm">Enable</button> '; // Display 'Enable' badge
                                }
                            }
                            actionsTags +=
                                '<button type="button" class="btn btn-dark btn-sm">Details</button> </div>';

                            return actionsTags;
                        }
                    },
                ],
                "responsive": true, // Enable responsive design
                "lengthChange": false, // Disable length change
                "autoWidth": false, // Disable auto width
                "dom": 'Bfrtip', // Define the table control elements to appear
                "buttons": [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength'
                ] // Add buttons
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)'); // Append buttons to container
            // Select all buttons with class 'buttons-html5', remove 'btn-secondary' and add 'btn-dark'
            /* $('.buttons-html5').removeClass('btn-secondary').addClass('btn-dark'); */
            $('.dt-buttons .btn').removeClass('btn-secondary').addClass('btn-dark');
        });
    </script>
@endsection
