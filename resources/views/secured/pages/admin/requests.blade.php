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
        /* Custom styles for pagination */
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

        /* Custom styles for DataTables buttons */
        div.dt-buttons {
            float: right !important;
        }

        div.dataTables_wrapper div.dataTables_filter {
            display: flex;
        }

        /* Custom styles for dropdown menu items */
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

        /* Custom style for highlighted table row */
        .highlight {
            background-color: rgba(0, 0, 0, 0.075) !important;
        }
    </style>
@endsection

<!-- Header Section -->
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

<!-- Main Content Section -->
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Card for Request List -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="m-0 card-title">Request</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Modal for displaying images -->
                            <div class="modal fade" id="modal-images">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Images for request <strong
                                                    id="modal-images-request-ref"></strong></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <div id="loader" class="spinner-border text-orange" role="status"
                                                style="display: none;">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Request List Table -->
                            <table id="table-request-list" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th># No</th>
                                        <th>Reference</th>
                                        <th>Status</th>
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
                                        <th>Status</th>
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
        /**
         * jQuery Document Ready Function
         * This function runs when the DOM is fully loaded and ready for manipulation.
         */
        $(function() {
            // Status badge mapping
            const statusBadges = {
                'init': '<span class="badge badge-secondary">Initialized</span>',
                'estimated': '<span class="badge badge-info">Estimated</span>',
                'accepted': '<span class="badge badge-primary">Accepted</span>',
                'in_progress': '<span class="badge badge-warning">In Progress</span>',
                'completed': '<span class="badge badge-success">Completed</span>',
                'canceled': '<span class="badge badge-danger">Canceled</span>'
            };

            /**
             * Initialize DataTable with server-side processing
             * @type {Object}
             */
            var tableSaved = $("#table-request-list").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('api.secure.admin.requests.index') }}",
                    type: "GET"
                },
                language: {
                    processing: '<div class="d-flex justify-content-center"><div class="spinner-border text-orange" role="status"><span class="sr-only">Loading...</span></div></div>'
                },
                columns: [{
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
                        data: 'reference'
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            return statusBadges[data] || data;
                        }
                    },
                    {
                        "data": "car_id",
                        "orderable": true,
                        "searchable":false,
                        "render": function(value, type, data, meta) {
                            if (type == 'display') {
                                return data.car.brand.name + " " + data.car.model.name;
                            }
                            return value;
                        }
                    },
                    {
                        "data": "created_by_id",
                        "orderable": true,
                        "searchable":false,
                        "render": function(value, type, data, meta) {
                            if (type == 'display') {
                                return data.created_by.first_name + " " + data.created_by.last_name;
                            }
                            return value;
                        }
                    },
                    {
                        'data': 'created_by.phone',
                        "searchable":false,
                    },
                    {
                        'data': 'created_by.email',
                        'visible': false,
                        "searchable":false,
                    },
                    {
                        "data": "created_at",
                        "orderable": true,
                        "render": function(value, type, data, meta) {
                            // Format the date
                            return type === 'display' ? moment(value).format('Do MMM YYYY') : value;
                        }
                    },
                    {
                        "data": "updated_at",
                        "orderable": true,
                        "render": function(value, type, data, meta) {
                            // Format the date
                            return type === 'display' ? moment(value).format('Do MMM YYYY') : value;
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(value, type, data, meta) {

                            let viewUrl =
                                '{{ route('secured.admin.requests.show', ['id' => ':request_id']) }}'
                                .replace(':request_id', data.id);

                            let imagesUrl =
                                '{{ route('api.secure.admin.requests.images', ['id' => ':request_id']) }}'
                                .replace(':request_id', data.id);

                            return `
                            <div class="d-flex justify-content-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-dark btn-sm btn-images" data-ref="${data.reference}" data-url="${imagesUrl}">
                                        <i class="fas fa-images"></i> Images
                                    </button>
                                    <a href="${viewUrl}" class="btn btn-outline-dark btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </div>
                            </div>`;
                        }
                    },
                ],
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', "pageLength",
                    {
                        extend: 'colvis',
                        columnText: (dt, idx, title) => title === "#" ? `${idx + 1}: No` :
                            `${idx + 1}: ${title}`
                    }
                ]
            });

            tableSaved.buttons().container().appendTo('#table-request-list_wrapper .col-md-6:eq(0)');

            // Change button class
            $('.dt-buttons .btn').removeClass('btn-secondary').addClass('btn-dark');

            /**
             * Image Loading Function
             * This function loads images for a specific request when the 'Images' button is clicked.
             * @param {string} apiUrl - The URL to fetch images from
             */
            function loadImages(apiUrl) {
                const modalBody = $('#modal-images .modal-body');
                const loader = $('#loader');

                modalBody.find('#product-image-section').remove();
                loader.show();
                $('#modal-images').modal('show');

                $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    success: function(response) {
                        const files = response.data;

                        if (files.length === 0) {
                            modalBody.append('<p>No images available.</p>');
                            loader.hide();
                            return;
                        }

                        const html = `
                            <div class="col-12" id="product-image-section">
                                <h5 class="d-inline-block">${files[0].name}</h5>
                                <div class="col-12">
                                    <img src="${files[0].url}" class="product-image h-50" alt="Product Image">
                                </div>
                                <div class="col-12 product-image-thumbs">
                                    ${files.map((file, index) => `
                                                                <div class="product-image-thumb ${index === 0 ? 'active' : ''}">
                                                                    <img src="${file.url}" alt="${file.name}">
                                                                </div>
                                                            `).join('')}
                                </div>
                            </div>
                        `;

                        modalBody.append(html);
                        loader.hide();
                    },
                    error: function(error) {
                        loader.hide();
                        console.error("There was an error fetching the images:", error);
                    }
                });
            }

            /**
             * Event Handler for 'Images' Button Click
             * This attaches a click event handler to the 'Images' button in each table row.
             */
            $('#table-request-list').on('click', '.btn-images', function() {
                $('#modal-images-request-ref').text($(this).data('ref'));
                loadImages($(this).data('url'));
                $(this).parents('tr').toggleClass('highlight');
            });

            /**
             * Event Handler for Image Thumbnail Click
             * This attaches a click event handler to the image thumbnails in the modal.
             */
            $('#modal-images').on('click', '.product-image-thumb', function() {
                const $image_element = $(this).find('img');
                $('.product-image').prop('src', $image_element.attr('src'));
                $('.product-image-thumb.active').removeClass('active');
                $(this).addClass('active');
            });

            /**
             * Event Handler for Modal Hide
             * This removes the highlight class from table rows when the modal is hidden.
             */
            $(document).on('hide.bs.modal', '#modal-images', function() {
                $('#table-request-list tr').removeClass('highlight');
            });
        });
    </script>
@endsection
