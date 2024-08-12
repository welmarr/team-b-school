@extends('secured.layout')


@section('title')
    Users - Admin
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">




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

        .highlight {
            background-color: rgba(0, 0, 0, 0.075) !important;
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

        <div class="modal fade" id="modal-enable-disable">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to <span id="modal-enable-disable-action" class="badge badge-success">
                            </span> <strong id="modal-enable-disable-user-name"> </strong> account?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" id="modal-content-yes" attr-call-url=""
                            attr-call-by="">Yes</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>

        </div>


        <div class="modal fade" id="modal-add-new-admin">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="modal-add-new-admin-form" method="POST" action="{{ route('api.secure.users.store') }}">
                        <div class="modal-body">
                            <p class="badge badge-dark my-0"> Field with <span class="text-orange">*</span> is mandatory.
                            </p>

                            @csrf
                            <div class="row my-2">
                                <div class="col-6">
                                    <label for="first-name" class="form-label">First name <span
                                            class="text-orange">*</span></label>
                                    <input type="text" class="form-control" id="first-name" name="first_name"
                                        placeholder="John" required>

                                    <div class="text-danger mb-3  d-none modal-add-new-admin-form-input-error"
                                        id="first_name-error">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="last-name" class="form-label">Last name <span
                                            class="text-orange">*</span></label>
                                    <input type="text" class="form-control" id="last-name" name="last_name"
                                        placeholder="Doe" required>

                                    <div class="text-danger mb-3 d-none modal-add-new-admin-form-input-error"
                                        id="last_name-error">
                                    </div>
                                </div>
                            </div>


                            <div class="row my-2">
                                <div class="col-6">
                                    <label for="email" class="form-label">Email <span
                                            class="text-orange">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="you@example.com" required>

                                    <div class="text-danger mb-3  d-none modal-add-new-admin-form-input-error"
                                        id="email-error">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="phonenumber" class="form-label">Phone <span
                                            class="text-orange">*</span></label>
                                    <input type="text" class="form-control" id="phonenumber" name="phone"
                                        placeholder="123456789" required>

                                    <div class="text-danger mb-3 d-none modal-add-new-admin-form-input-error"
                                        id="phone-error">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" form="modal-add-new-admin-form" class="btn btn-success"
                                id="modal-add-new-admin-submit" attr-call-url="" attr-call-by="">Add</button>
                            <button type="button" class="btn btn-orange" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="m-0 card-title">Users</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="user-list-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Type</th>
                                        <th class="d-flex justify-content-center">Status</th>
                                        <th>Created at</th>
                                        <th>First connexion</th>
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
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Type</th>
                                        <th class="d-flex justify-content-center">Status</th>
                                        <th>Created at</th>
                                        <th>First connexion</th>
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
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
@endsection

@section('js-after-adminlte')
    <script>
        /**
         * jQuery document ready function
         */
        $(function() {
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

            /**
             * Initialize DataTable with server-side processing
             * @type {Object}
             */
            var tableSaved = $("#user-list-table").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('api.secure.users') }}",
                language: {
                    "processing": '<div class="d-flex justify-content-center"><div class="spinner-border text-orange" role="status"><span class="sr-only">Loading...</span></div></div>'
                },
                "columns": [{
                        "data": "id",
                        "orderable": true,
                        "render": function(value, type, full, meta) {
                            // Display row number instead of ID
                            if (type === 'display') {
                                return meta.row + 1;
                            }
                            return value;
                        }
                    },
                    {
                        "data": "first_name"
                    },
                    {
                        "data": "last_name"
                    },
                    {
                        "data": "email",
                        "visibility": false,
                    },
                    {
                        "data": "phone"
                    },
                    {
                        "data": "role",
                        "orderable": true,
                        "render": function(value, type, full) {
                            // Style the role differently for admin and non-admin
                            if (type === 'display') {
                                return value == "admin" ? '<strong>' + value + '</strong>' :
                                    '<em>' + value + '</em>';
                            }
                            return value;
                        }
                    },
                    {
                        "data": 'is_active',
                        "orderable": true,
                        "render": function(value, type, full) {
                            // Display user icon based on active status
                            if (type === 'display') {
                                if (typeof value !== 'object') {
                                    return value == 1 ?
                                        '<span class="text-success d-flex justify-content-center"><i class="fas fa-user"></i></span>' :
                                        '<span class="text-danger d-flex  justify-content-center"><i class="fas fa-user-slash"></i></span>';
                                }
                                return '<span class="text-secondary">Error</span>';
                            }
                            return value;
                        }
                    },
                    {
                        "data": "updated_at",
                        "orderable": true,
                        "render": function(value, type, full) {
                            // Format the date
                            return type === 'display' ? (value == null ? "" : moment(value).format(
                                'Do MMM YYYY')) : value;
                        }
                    },
                    {
                        "data": "first_connect_at",
                        "orderable": true,
                        "render": function(value, type, full) {
                            // Format the date
                            return type === 'display' ? (value == null ? "" : moment(value).format(
                                'Do MMM YYYY')) : value;
                        }
                    },
                    {
                        "data": null,
                        "orderable": false,
                        "render": function(value, type, full, meta) {
                            // Generate action buttons for each row
                            let enableDisableUrl =
                                '{{ route('api.secure.users.disable.or.enable', ['user' => ':user']) }}'
                                .replace(':user', full.id);
                            let actionsTags = '<div class="d-flex justify-content-center">';
                            let callLabel = full.is_active ? "disable" : "enable";

                            if (typeof value === 'object') {
                                actionsTags +=
                                    '<button type="button" class="btn btn-outline-dark mr-2 btn-sm btn-disable-or-enable" ' +
                                    'id="enable-disable-id-' + full.id + '" ' +
                                    'call-label="' + callLabel + '" ' +
                                    'call-name="' + full.first_name + " " + full.last_name + '" ' +
                                    'call-url="' + enableDisableUrl + '">' +
                                    (value.is_active === 1 ? 'Disable' : 'Enable') + '</button> ';
                            }
                            actionsTags +=
                                '<button type="button" class="btn btn-dark btn-sm">Details</button> </div>';

                            return actionsTags;
                        }
                    },
                ],
                'order': [
                    [0, 'desc']
                ],
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "dom": 'Bfrtip',
                "buttons": [{
                    text: '<i class="fas fa-plus" id="user-list-table-add-user"></i> New Admin',
                    action: function(e, dt, node, config) {
                        // Open modal for adding new admin
                        $('#modal-add-new-admin').modal('toggle');
                    }
                }, 'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength'],
            });

            // Append DataTable buttons to the wrapper and style them
            tableSaved.buttons().container().appendTo('#user-list-table_wrapper .col-md-6:eq(0)');
            $('.dt-buttons .btn').removeClass('btn-secondary').addClass('btn-dark');

            /**
             * Event listener for enabling/disabling button click
             */
            $(document).on('click', '.btn-disable-or-enable', function(e) {
                const $this = $(this);
                // Update modal content based on the clicked button
                $('#modal-enable-disable-action').text($this.attr('call-label'));
                $('#modal-enable-disable-user-name').text($this.attr('call-name'));

                // Style the modal based on the action (enable/disable)
                if ($this.attr('call-label') == 'enable') {
                    $('#modal-enable-disable-action').removeClass("badge-danger badge-dark").addClass(
                        'badge-success');
                    $('#modal-content-yes').removeClass("btn-danger btn-dark").addClass('btn-success');
                } else {
                    $('#modal-enable-disable-action').removeClass("badge-success badge-dark").addClass(
                        'badge-danger');
                    $('#modal-content-yes').removeClass("btn-success btn-dark").addClass('btn-danger');
                }

                // Set attributes for the confirmation button
                $('#modal-content-yes')
                    .attr('attr-call-url', $this.attr('call-url'))
                    .attr('attr-call-by', $this.attr('id'));
                $('#' + $this.attr('id')).parents('tr').toggleClass('highlight');

                // Show the modal
                $('#modal-enable-disable').modal('toggle');

                e.stopPropagation();
            });

            /**
             * Event listener for confirmation button click in the modal
             */
            $(document).on('click', '#modal-content-yes', function(e) {
                const $this = $(this);
                const callUrl = $this.attr('attr-call-url');
                const callBy = $this.attr('attr-call-by');

                // Send AJAX request to enable/disable user
                $.ajax({
                    url: callUrl,
                    type: 'POST',
                    contentType: 'application/json',
                    success: function(response) {
                        // Update the table row
                        var rowIndex = tableSaved.row($('#' + $(this).attr('attr-call-by'))
                            .parents('tr')).index();

                        tableSaved.cell({
                            row: rowIndex,
                            column: 6
                        }).data(1).draw(false);
                        tableSaved.cell({
                            row: rowIndex,
                            column: 8
                        }).data(1).draw(false);

                        // Prepare success message
                        const isActive = response.data != null && response.data.is_active;
                        const userName = response.data.first_name + " " + response.data
                            .last_name;
                        const message = isActive ?
                            `${userName} account is successfully enabled.` :
                            `${userName} account is successfully disabled.`;

                        // Show success toast
                        Toast.fire({
                            icon: 'success',
                            title: message
                        });
                    },
                    error: function(error) {
                        // Show error toast
                        Toast.fire({
                            icon: 'error',
                            title: 'Oups! Something wrong during the execution of the action. Try later.'
                        })
                    }
                });

                // Close the modal
                $('#modal-enable-disable').modal('toggle');
                e.stopPropagation();
            });

            /**
             * Event listener for submitting the new admin form
             */
            $('#modal-add-new-admin-form').submit(function(e) {
                e.preventDefault();
                // Clear error messages before submitting the form
                $('span.modal-add-new-admin-form-input-error').text('');
                $('span.modal-add-new-admin-form-input-error').addClass('d-none');

                let form = $(this);
                let url = form.attr('action')

                // Send AJAX request to add new admin
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        /*// Prepare new row data
                        let newRowData = {
                            "first_name": response.data.first_name,
                            "last_name": response.data.last_name,
                            "phone": response.data.phone,
                            "role": response.data.role,
                            "email": response.data.email,
                            "is_active": 0,
                            "updated_at": response.data.updated_at,
                            "id": response.data.id,
                            "first_connect_at": response.data.first_connect_at
                        };

                        // Add the new row to the table
                        let rowNode = tableSaved.row.add(newRowData).draw(false)

                        // Update the row number
                        tableSaved.rows().every(function(rowIdx, tableLoop, rowLoop) {
                            this.data().DT_RowIndex = rowIdx + 1;
                            this.invalidate();
                        });*/

                        // Redraw the table to show updated row numbers
                        tableSaved.draw(false);

                        // Show success toast notification
                        Toast.fire({
                            icon: 'success',
                            title: response.msg
                        });

                        // Reset the form
                        form.trigger("reset");

                        // Close the modal
                        $('#modal-add-new-admin').modal('toggle');
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Handle validation errors
                            var errors = xhr.responseJSON.errors;
                            var errorMessages = '';

                            $.each(errors, function(key, value) {
                                // Concatenate each error message
                                errorMessages += (key + ": " + value[0] + '\n');

                                // Display error message for each field
                                $('#' + key + "-error").text(value[0]);
                                $('#' + key + "-error").removeClass('d-none');
                            });

                            // Display validation errors in a toast notification
                            Toast.fire({
                                icon: 'error',
                                title: 'There are some validation error.' + '\n' +
                                    errorMessages
                            });
                        } else {
                            // Handle other errors
                            Toast.fire({
                                icon: 'error',
                                title: 'Oups! Something went wrong during the execution of the action. Try later.'
                            });
                        }
                    }
                });
            });

            /**
             * Event listener for modal hide
             */
            $(document).on('hide.bs.modal', '#modal-enable-disable', function() {
                // Remove highlight class from table rows when modal is hidden
                $('#user-list-table tr').removeClass('highlight');
            });


            $(document).on('hide.bs.modal', '#modal-add-new-admin', function() {
                // Clear error messages before submitting the form
                $('span.modal-add-new-admin-form-input-error').text('');
                $('span.modal-add-new-admin-form-input-error').addClass('d-none');
            });




            // Select the button that contains the span with id modal-add-user
            var buttonContainingSpan = $('#user-list-table-add-user').closest('button');

            console.log(buttonContainingSpan)

            // Remove the class btn-dark and add btn-outline-success
            buttonContainingSpan.removeClass('btn-dark').addClass('btn-success');

        });
    </script>
@endsection
