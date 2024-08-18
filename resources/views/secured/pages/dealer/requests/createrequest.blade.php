@extends('secured.layout')

@section('title', 'Create Dealer Request')

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
    <link rel="stylesheet" href="{{ asset('css/filepond.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filepond-plugin-image-preview.css') }}">

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
                    <h1>Create Dealer Request</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('secured.dealers.requests.index') }}" class="text-orange">Requests</a>
                        </li>
                        <li class="breadcrumb-item active">Create Request</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create New Request</h3>
                        </div>
                        <!-- form start -->
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <!-- Car Make Section -->
                                <div class="form-group">
                                    <label for="make">Make <span class="text-orange">*</span></label>
                                    <input type="text" name="make" class="form-control" id="make" placeholder="Enter Car Make" required>
                                    @error('make')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Car Model Section -->
                                <div class="form-group">
                                    <label for="model">Model <span class="text-orange">*</span></label>
                                    <input type="text" name="model" class="form-control" id="model" placeholder="Enter Car Model" required>
                                    @error('model')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Car Year Section -->
                                <div class="form-group">
                                    <label for="year">Year <span class="text-orange">*</span></label>
                                    <input type="text" name="year" class="form-control" id="year" placeholder="Enter Car Year" required>
                                    @error('year')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Memo Section -->
                                <div class="form-group">
                                    <label for="memo">Memo <span class="text-orange">*</span></label>
                                    <textarea name="memo" class="form-control" id="memo" placeholder="Enter any additional details or requests" required></textarea>
                                    @error('memo')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- File Upload Section -->
                                <div class="form-group">
                                    <label for="filepond">Add Pictures <span class="text-orange">*</span></label>
                                    <input type="file" class="filepond" name="filepond[]" multiple id="filepond">
                                    @error('filepond')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
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
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
@endsection

@section('js-before-bootstrap')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
@endsection

@section('js-after-bootstrap')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ asset('js/filepond-plugin-file-validate-type.min.js') }}"></script>
    <script src="{{ asset('js/filepond.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
                FilePondPluginFileValidateType
            );

            FilePond.create(document.querySelector('.filepond'), {
                acceptedFileTypes: ['image/*'],
                allowMultiple: true,
                server: {
                    process: {
                        url: '',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }
                }
            });
        });
    </script>
@endsection
