@extends('secured.layout')


@section('title')
    Tool history movement - Admin
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
                        <li class="breadcrumb-item active">History movement</li>
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
                            <h3 class="m-0 card-title">History movement <span
                                    class="badge badge-success">{{ $tool->name }}</span> : <strong>{{$tool->calculateStock() . " " . $tool->unit->name }} in stock</strong></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="row">
                            <div class="col-6">
                                <div class="card-body">
                                    <div class="card card-dark">
                                        <div class="card-header">
                                            <h3 class="card-title">Adding historic</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                    title="Collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Added at</th>
                                                        <th>Type</th>
                                                        <th>Memo</th>
                                                        <th>Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($addedMovements as $movement)
                                                        <tr>
                                                            <td>{{ $movement->created_at }}</td>
                                                            <td>{{ $movement->type }}</td>
                                                            <td>{{ $movement->note }}</td>
                                                            <td>
                                                                <span
                                                                    class="{{ $movement->quantity < 0 ? 'text-danger' : 'text-success' }}">
                                                                    {{ $movement->quantity }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="text-muted text-center" colspan="4">No data found
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            @if (!$addedMovements->empty())
                                                <div class="d-flex justify-content-end">
                                                    {{ $addedMovements->links() }}
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card-body">
                                    <div class="card card-dark">
                                        <div class="card-header">
                                            <h3 class="card-title">Scraping historic</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                    title="Collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Scraped at</th>
                                                        <th>Type</th>
                                                        <th>Memo</th>
                                                        <th>Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($scrapedMovements as $movement)
                                                        <tr>
                                                            <td>{{ $movement->created_at }}</td>
                                                            <td>{{ $movement->type }}</td>
                                                            <td>{{ $movement->note }}</td>
                                                            <td>
                                                                <span
                                                                    class="{{ $movement->quantity < 0 ? 'text-danger' : 'text-success' }}">
                                                                    {{ $movement->quantity }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="text-muted text-center" colspan="4">No data found
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            @if (!$scrapedMovements->empty())
                                                <div class="d-flex justify-content-end">
                                                    {{ $scrapedMovements->links() }}
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card-body">
                                    <div class="card card-dark">
                                        <div class="card-header">
                                            <h3 class="card-title">Using historic</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                    title="Collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Used at</th>
                                                        <th>Request</th>
                                                        <th>Type</th>
                                                        <th>Memo</th>
                                                        <th>Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse  ($usedMovements as $movement)
                                                        <tr>
                                                            <td>{{ $movement->created_at }}</td>
                                                            <td><a
                                                                    href="{{ route('secured.admin.requests.show', ['id' => $movement->request_id]) }}">View
                                                                    request</a></td>
                                                            <td>{{ $movement->type }}</td>
                                                            <td>{{ $movement->note }}</td>
                                                            <td>
                                                                <span
                                                                    class="{{ $movement->quantity < 0 ? 'text-danger' : 'text-success' }}">
                                                                    {{ $movement->quantity }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="text-muted text-center" colspan="5">No data found
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>

                                            @if (!$usedMovements->empty())
                                                <div class="d-flex justify-content-end">
                                                    {{ $usedMovements->links() }}
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
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
