@extends('secured.layout')


@section('title')
    Update tool - Admin
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">




    <link rel="stylesheet" href="{{ asset('css/sharing.css') }}">


    <style>
        svg.feather {
            width: 16px !important;
        }

        ul.dropdown-menu {
            --bs-dropdown-link-active-bg: #fb4f14;
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
                        <li class="breadcrumb-item text-orange"><a href="{{ route('secured.admin.tools.index') }}"
                                type="button" class=" text-orange">Tools</a></li>
                        <li class="breadcrumb-item active">Update</li>
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
                            <h3 class="m-0 card-title">Update tool</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="modal-add-new-tool-form" method="POST"
                                action="{{ route('secured.admin.tools.update', ['tool' => $tool->id]) }}" autocomplete="off">
                                <p class="badge badge-dark my-0"> Field with <span class="text-orange">*</span> is
                                    mandatory.
                                </p>

                                @csrf
                                @method('PUT')

                                <div class="row my-2">
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

                                <div class="row my-2">
                                    <div class="col-6 form-group">
                                        <label for="modal-add-new-tool-form-name" class="form-label">Designation <span
                                                class="text-orange">*</span></label>
                                        <input type="text" class="form-control" id="modal-add-new-tool-form-name"
                                            name="name" placeholder="" required autocomplete="off"
                                            value="{{ $tool->name }}">

                                        <div class="text-danger mb-3 d-none modal-add-new-tool-form-input-error"
                                            id="name-error">
                                        </div>
                                    </div>
                                    <div class="col-6 form-group">
                                        <label for="modal-add-new-tool-form-name" class="form-label">Enable alert stock
                                            <span class="text-orange">*</span></label>
                                        <input type="text" class="form-control" id="modal-add-new-tool-form-name"
                                            name="alert" placeholder="" required autocomplete="off"
                                            value="{{ $tool->condition }}">


                                        @error('alert')
                                            <div class="text-danger mb-3">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row my-2">
                                    <div class="col-sm-12 col-md-6 form-group">
                                        <label for="modal-add-new-tool-form-type" class="form-label">Type <span
                                                class="text-orange">*</span></label>
                                        <select class="form-select my-select" aria-label=""
                                            id="modal-add-new-tool-form-type" data-live-search="true" name="type">
                                            <option value="">Select type</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}"
                                                    {{ $tool->tool_type_id == $type->id ? 'selected' : '' }}>
                                                    {{ $type->name }}</option>
                                            @endforeach
                                        </select>


                                        @error('type')
                                            <div class="text-danger mb-3">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12  col-md-6 form-group">
                                        <label for="modal-add-new-tool-form-unit" class="form-label">Unit <span
                                                class="text-orange">*</span></label>
                                        <select class="form-select my-select" aria-label=""
                                            id="modal-add-new-tool-form-unit" data-live-search="true" name="unit">
                                            <option value="">Select unit</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}"
                                                    {{ $tool->unit_id == $unit->id ? 'selected' : '' }}>
                                                    {{ $unit->name }}</option>
                                            @endforeach
                                        </select>


                                        @error('unit')
                                            <div class="text-danger mb-3">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row my-2">
                                    <div class="col-12 form-group">
                                        <label for="modal-add-new-tool-form-description"
                                            class="form-label">Description</label>
                                        <textarea class="form-control" id="modal-add-new-tool-form-description" rows="3" name="description">{{ $tool->description }}</textarea>

                                        @error('description')
                                            <div class="text-danger mb-3">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row my-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox"
                                            id="modal-add-new-tool-form-tracked" {{ $tool->track_usage ? "checked" : ""}} name="tracked">
                                        <label class="form-check-label" for="modal-add-new-tool-form-tracked">Eneable
                                            tracking</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" form="modal-add-new-tool-form"
                                            class="btn btn-success mr-2" id="modal-add-new-tool-submit" attr-call-url=""
                                            attr-call-by="">Update</button>
                                        <button type="button" class="btn btn-orange"
                                            data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </form>

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
