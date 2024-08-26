@extends('secured.layout')


@section('title')
    Tools - Admin
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
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

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
                    <h1 class="m-0">Tools</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-orange">Tools</li>
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
                <div class="col-12" id="tool-table">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="m-0 card-title">Tools</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="modal fade" id="modal-add-inventory">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Inventory movement</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="modal-add-inventory-form" method="POST" action=""
                                            autocomplete="off">
                                            <div class="modal-body">
                                                <div class="d-block  text-center">
                                                    <div id="modal-add-inventory-form-loader"
                                                        class="spinner-border text-warning" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                </div>
                                                <div id="modal-add-inventory-form-content" style="display: none;">
                                                    <p class="badge badge-dark my-0"> Field with <span
                                                            class="text-orange">*</span> is
                                                        mandatory.
                                                    </p>
                                                    @csrf
                                                    <div class="row my-2">
                                                        <div class="col-12 form-group">
                                                            <label for="modal-add-inventory-form-tool"
                                                                class="form-label">Type of mouvement
                                                                <span class="text-orange">*</span></label>
                                                            <select class="form-select" id="modal-add-inventory-form-tool"
                                                                name="action_type" required>
                                                                <option selected>Select the type</option>
                                                                <option value="scrap">Scrap stock</option>
                                                                <option value="add">Add inventory</option>
                                                            </select>

                                                            <div class="text-danger mb-3  d-none modal-add-inventory-form-input-error"
                                                                id="action_type-error">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row my-2">
                                                        <div class="col-12 form-group">
                                                            <label for="modal-add-inventory-form-qty"
                                                                class="form-label">Quantity
                                                                <span class="text-orange">*</span></label>
                                                            <input type="text" class="form-control"
                                                                id="modal-add-inventory-form-qty" name="qty"
                                                                placeholder="" required autocomplete="off" required>

                                                            <div class="text-danger mb-3  d-none modal-add-inventory-form-input-error"
                                                                id="qty-error">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row my-2">
                                                        <div class="col-12 form-group">
                                                            <label for="modal-add-inventory-form-memo"
                                                                class="form-label">Description</label>
                                                            <textarea class="form-control" id="modal-add-inventory-form-memo" rows="3" name="memo"></textarea>

                                                            <div class="text-danger mb-3  d-none modal-add-inventory-form-input-error"
                                                                id="memo-error">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" form="modal-add-inventory-form"
                                                    class="btn btn-success" id="modal-add-inventory-submit"
                                                    attr-call-url="" attr-call-by="">Add</button>
                                                <button type="button" class="btn btn-orange"
                                                    data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                            <table id="tool-list-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Designation</th>
                                        <th>In stock</th>
                                        <th>Tracked</th>
                                        <th>Unit</th>
                                        <th>Type</th>
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
                                        <th>In stock</th>
                                        <th>Tracked</th>
                                        <th>Unit</th>
                                        <th>Type</th>
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
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
@endsection

@section('js-after-adminlte')
    <script>
        // https://stackoverflow.com/questions/37778173/datatables-with-custom-tooltip-per-cell
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
            var tableHistorySaved = null

            /**
             * Initialize DataTable with server-side processing
             * @type {Object}
             */
            var btnHistoryClicked = null

            /**
             * Initialize DataTable with server-side processing
             * @type {Object}
             */
            var tableSaved = $("#tool-list-table").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('api.secure.admin.tools.index') }}",
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
                        "data": "qty",
                        "orderable": false,
                        searchable: false,
                        "render": function(value, type, full, meta) {
                            if (type === 'display') {
                                let valueUpdate = value ?? 0;

                                let tagHtml = "";
                                if (valueUpdate < full.condition) {
                                    tagHtml = `<span class="text-danger">${valueUpdate}</span>`
                                } else if (valueUpdate < (2 * full.condition) && valueUpdate >= (
                                        full
                                        .condition + (full.condition / 2))) {
                                    tagHtml = `<span class="text-warning">${valueUpdate}</span>`
                                } else {
                                    tagHtml = `<span class="text-success">${valueUpdate}</span>`
                                }
                                return tagHtml;
                            }
                            return value;
                        }
                    },
                    {
                        "data": "track_usage",
                        "render": function(value, type, full, meta) {
                            if (type === 'display') {
                                let tagHtml = "";
                                if (value == 1) {
                                    tagHtml = `<strong>Tracked</strong>`
                                } else {
                                    tagHtml =
                                        `<span class="text-decoration-line-through">Tracked</span>`
                                }
                                return tagHtml;
                            }
                            return value;
                        }
                    },
                    {
                        "data": "unit.abbreviation"
                    },
                    {
                        "data": "type.name"
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
                            //console.log(value, type, full, meta);
                            // Generate action buttons for each row
                            let updateUrl =
                                '{{ route('secured.admin.tools.edit', ['tool' => ':tool']) }}'
                                .replace(':tool', full.id);

                            let historyUrl =
                                '{{ route('secured.admin.tools.history', ['tool' => ':tool']) }}'
                                .replace(':tool', full.id);

                            let addMovementUrl =
                                '{{ route('api.secure.admin.tools.movement', ['id' => ':tool']) }}'
                                .replace(':tool', full.id);
                            return `
                            <div class="d-flex justify-content-center"><div class="btn-group">
                                <button type="button" class="btn btn-dark btn-sm btn-histories modal-add-inventory-handler" id="modal-add-inventory-${full.id}" data-href="${addMovementUrl}">Add movement</button>
                                <a type="button" class="btn btn-outline-dark btn-sm btn-update" id="tool-list-table-update-${full.id}" href="${updateUrl}" call-name="${full.name}" call-description="${full.description || ''}">Update</a>
                                <a type="button" class="btn btn-outline-dark btn-sm btn-update" id="tool-list-table-history-${full.id}" href="${historyUrl}" call-name="${full.name}" call-description="${full.description || ''}">History</a>
                            </div></div>`;
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
                        text: '<i class="fas fa-plus" id="tool-list-table-add-tool"></i> Tool',
                        action: function(e, dt, node, config) {
                            // Open modal for adding new admin
                            window.location.href = '{{ route('secured.admin.tools.create') }}'
                        }
                    },
                    'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength'
                ],
            });



            // Select the button that contains the span with id modal-add-tool
            var buttonContainingSpan = $('#tool-list-table-add-tool').closest('button');


            // Append DataTable buttons to the wrapper and style them
            tableSaved.buttons().container().appendTo('#tool-list-table_wrapper .col-md-6:eq(0)');
            $('.dt-buttons .btn').removeClass('btn-secondary').addClass('btn-dark');

            // Remove the class btn-dark and add btn-outline-success
            buttonContainingSpan.removeClass('btn-dark').addClass('btn-success');


            $('[data-toggle="tooltip"]').tooltip()



            $(document).on('click', '.modal-add-inventory-handler', function() {
                console.log('Button clicked, toggling modal...');
                $('#modal-add-inventory-form')[0].reset(); // Reset the form fields

                $('#modal-add-inventory-form').attr('action', $(this).data('href'));

                $('#' + $(this).attr('id')).parents('tr').toggleClass('highlight');


                $('#modal-add-inventory-form-loader').hide();
                $('#modal-add-inventory-form-content').show();
                $('#modal-add-inventory').modal('show');
            });

            $(document).on('hide.bs.modal', '#modal-add-inventory', function() {
                // Clear error messages before submitting the form
                $('.modal-add-inventory-form-input-error').text('');
                $('.modal-add-inventory-form-input-error').addClass('d-none');
                // Remove highlight class from table rows when modal is hidden
                $('#tool-list-table tr').removeClass('highlight');
            });


            $(document).on('click', '#modal-add-inventory-submit', function() {
                console.log('Button modal-add-inventory-submit clicked, form submitted...');

                // Clear error messages before submitting the form
                $('.modal-add-inventory-form-input-error').text('');
                $('.modal-add-inventory-form-input-error').addClass('d-none');
                let form = $('#modal-add-inventory-form');

                let url = form.attr('action');

                if (!document.getElementById('modal-add-inventory-form').checkValidity()) {
                    document.getElementById('modal-add-inventory-form').reportValidity();
                    return ;
                }

                // Send AJAX request to add new unit
                $.ajax({
                    url: url,
                    type: "POST",
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
                        $('#modal-add-inventory').modal('toggle');
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
                })
            });
        });
    </script>
@endsection
