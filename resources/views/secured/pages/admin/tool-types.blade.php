@extends('secured.layout')


@section('title')
    Tool types - Admin
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
                    <h1 class="m-0">Tool types</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-orange">Tool types</li>
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

        <!-- Modal for enabling/disabling tool types -->
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
                            </span> <strong id="modal-enable-disable-tool-type-name"> </strong> account?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" id="modal-content-yes" attr-call-url=""
                            attr-call-by="">Yes</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>

        </div>


        <!-- Modal for adding a new tool type -->
        <div class="modal fade" id="modal-add-new-tool-type">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New tool type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="modal-add-new-tool-type-form" method="POST"
                        action="{{ route('api.secure.admin.tool-types.store') }}">
                        <div class="modal-body">
                            <p class="badge badge-dark my-0"> Field with <span class="text-orange">*</span> is mandatory.
                            </p>

                            @csrf
                            <div class="row my-2">
                                <div class="col-12 form-group">
                                    <label for="name" class="form-label">Designation <span
                                            class="text-orange">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder=""
                                        required>

                                    <div class="text-danger mb-3  d-none modal-add-new-tool-type-form-input-error"
                                        id="name-error">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-12 form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>

                                    <div class="text-danger mb-3 d-none modal-add-new-tool-type-form-input-error"
                                        id="description-error">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" form="modal-add-new-tool-type-form" class="btn btn-success"
                                id="modal-add-new-tool-type-submit" attr-call-url="" attr-call-by="">Add</button>
                            <button type="button" class="btn btn-orange" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <!-- Modal for updating a tool type -->
        <div class="modal fade" id="modal-update-tool-type">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update tool type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="modal-update-tool-type-form" method="POST" action="">
                        <div class="modal-body">
                            <p class="badge badge-dark my-0"> Field with <span class="text-orange">*</span> is mandatory.
                            </p>

                            @method('PUT')
                            @csrf
                            <div class="row my-2">
                                <div class="col-12 form-group">
                                    <label for="modal-update-tool-type-form-name" class="form-label">Designation <span
                                            class="text-orange">*</span></label>
                                    <input type="text" class="form-control" id="modal-update-tool-type-form-name"
                                        name="name" placeholder="" required>

                                    <div class="text-danger mb-3  d-none modal-update-tool-type-form-input-error"
                                        id="name-error">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-12 form-group">
                                    <label for="modal-update-tool-type-form-description"
                                        class="form-label">Description</label>
                                    <textarea class="form-control" id="modal-update-tool-type-form-description" name="description" rows="3"></textarea>

                                    <div class="text-danger mb-3 d-none modal-update-tool-type-form-input-error"
                                        id="description-error">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" form="modal-update-tool-type-form" class="btn btn-success"
                                id="modal-update-tool-type-submit" attr-call-url="" attr-call-by="">Update</button>
                            <button type="button" class="btn btn-orange" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12" id="tool-type-table">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="m-0 card-title">Tool types</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tool-type-list-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Designation</th>
                                        <th>Created at</th>
                                        <th class="d-flex justify-content-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Designation</th>
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

                <div class="d-none" id="tool-type-tools-associated-table"></div>
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
            var tableSaved = $("#tool-type-list-table").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('api.secure.admin.tool-types.index') }}",
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
                        "data": "name"
                    },
                    {
                        "data": "updated_at",
                        "orderable": true,
                        "render": function(value, type, full) {
                            // Format the date
                            return type === 'display' ? moment(value).format('Do MMM YYYY') : value;
                        }
                    },
                    {
                        "data": null,
                        "orderable": false,
                        "render": function(value, type, full, meta) {
                            // Generate action buttons for each row
                            let updateUrl =
                                '{{ route('api.secure.admin.tool-types.update', ['tool_type' => ':tool_type']) }}'
                                .replace(':tool_type', full.id);
                            return `
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-outline-dark btn-sm btn-update" id="tool-type-list-table-update-${full.id}" call-url="${updateUrl}" call-name="${full.name}" call-description="${full.description || ''}">Update</button>
                            </div>`;
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
                        text: '<i class="fas fa-plus" id="tool-type-list-table-add-tool-type"></i> Tool type',
                        action: function(e, dt, node, config) {
                            // Open modal for adding new admin
                            $('#modal-add-new-tool-type').modal('toggle');
                        }
                    },
                    'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength'
                ],
            });

            /**
             * Event listener for update button click
             */
            $(document).on('click', '.btn-update', function(e) {
                const $this = $(this);
                // Update modal content based on the clicked button
                $('#modal-update-tool-type-form-name').val($this.attr('call-name'));
                $('#modal-update-tool-type-form-description').text($this.attr('call-description'));

                // Set attributes for the confirmation button
                $('#modal-update-tool-type-form').attr('action', $this.attr('call-url'));
                $('#' + $this.attr('id')).parents('tr').toggleClass('highlight');

                // Show the modal
                $('#modal-update-tool-type').modal('toggle');

                e.stopPropagation();
            });

            /**
             * Event listener for tools button click
             */
            $(document).on('click', '.btn-tools', function(e) {
                const $this = $(this);
                // Toggle table column sizes
                if ($('#tool-type-table').hasClass("col-12")) {
                    $('#tool-type-table').removeClass("col-12").addClass("col-8");
                } else if ($('#tool-type-table').hasClass("col-8")) {
                    $('#tool-type-table').removeClass("col-8").addClass("col-12");
                }

                // Toggle associated tools table visibility
                if ($('#tool-type-tools-associated-table').hasClass("d-none")) {
                    $('#tool-type-tools-associated-table').removeClass("d-none").addClass("col-4");
                } else {
                    $('#tool-type-tools-associated-table').removeClass("col-4").addClass("d-none");
                }

                e.stopPropagation();
            });

            /**
             * Handle form submission
             * @param {jQuery} form - The form element
             * @param {string} formMethod - The HTTP method for the form submission
             * @param {string} modalID - The ID of the modal
             */
            function handleFormSubmit(form, formMethod, modalID) {
                // Clear error messages before submitting the form
                $('span.' + modalID + '-form-input-error').text('');
                $('span.' + modalID + '-form-input-error').addClass('d-none');

                let url = form.attr('action');

                // Send AJAX request to add new tool type
                $.ajax({
                    url: url,
                    type: formMethod,
                    data: form.serialize(),
                    success: function(response) {
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
                        $('#' + modalID).modal('toggle');
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Handle validation errors
                            var errors = xhr.responseJSON.errors;
                            var errorMessages = '';

                            $.each(errors, function(key, value) {
                                // Concatenate each error message
                                errorMessages += `${key}: ${value[0]}\n`;

                                // Display error message for each field
                                $(`#${key}-error`).text(value[0]).removeClass('d-none');

                            });

                            // Display validation errors in a toast notification
                            Toast.fire({
                                icon: 'error',
                                title: `There are some validation errors.\n${errorMessages}`
                            });
                        } else {
                            // Handle other errors
                            Toast.fire({
                                icon: 'error',
                                title: 'Oops! Something went wrong during the execution of the action. Try later.'
                            });
                        }
                    }
                });
            }

            /**
             * Event listener for submitting the new tool type form
             */
            $('#modal-add-new-tool-type-form').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                handleFormSubmit(form, "POST", "modal-add-new-tool-type");
            });

            /**
             * Event listener for submitting the update tool type form
             */
            $('#modal-update-tool-type-form').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                handleFormSubmit(form, "PUT", "modal-update-tool-type");
            });

            /**
             * Event listener for hiding the update tool type modal
             */
            $(document).on('hide.bs.modal', '#modal-update-tool-type', function() {
                // Clear error messages before submitting the form
                $('span.modal-update-tool-type-form-input-error').text('');
                $('span.modal-update-tool-type-form-input-error').addClass('d-none');
                // Remove highlight class from table rows when modal is hidden
                $('#tool-type-list-table tr').removeClass('highlight');
            });

            /**
             * Event listener for hiding the add new tool type modal
             */
            $(document).on('hide.bs.modal', '#modal-add-new-tool-type', function() {
                // Clear error messages before submitting the form
                $('span.modal-add-new-tool-type-form-input-error').text('');
                $('span.modal-add-new-tool-type-form-input-error').addClass('d-none');
            });

            // Select the button that contains the span with id modal-add-tool-type
            var buttonContainingSpan = $('#tool-type-list-table-add-tool-type').closest('button');


            // Append DataTable buttons to the wrapper and style them
            tableSaved.buttons().container().appendTo('#tool-type-list-table_wrapper .col-md-6:eq(0)');
            $('.dt-buttons .btn').removeClass('btn-secondary').addClass('btn-dark');

            // Remove the class btn-dark and add btn-outline-success
            buttonContainingSpan.removeClass('btn-dark').addClass('btn-success');


            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
@endsection
