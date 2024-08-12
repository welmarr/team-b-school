@extends('secured.layout')


@section('title')
    Request - Admin
@endsection

@section('css')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">
@endsection

@section('header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Request details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('secured.admin.requests.index') }}"
                                class=" text-orange">Requests</a></li>
                        <li class="breadcrumb-item active">Deatils</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Request Details</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h2
                            class="badge @if ($demand->status === 'init') badge-secondary @elseif($demand->status === 'estimated') badge-info @elseif($demand->status === 'accepted') badge-primary @elseif($demand->status === 'in_progress') badge-warning @elseif($demand->status === 'completed') badge-success @elseif($demand->status === 'canceled') badge-danger @endif">
                            {{ ucfirst(str_replace('_', ' ', $demand->status)) }}
                        </h2>

                        <hr />
                        <div class="row">
                            <div class="col-sm-12 col-md-6">

                                <strong><i class="fas fa-asterisk"></i> Reference</strong>
                                <p class="text-muted mb-2">{{ $demand->reference }}</p>
                            </div>
                            <div class="col-sm-12  col-md-6">
                                <strong><i class="fas fa-car"></i> Car info</strong>
                                <p class="text-muted  mb-2">
                                    <span
                                        class="tag tag-danger">{{ $demand->car->brand->name }}/{{ $demand->car->model->name }}/{{ $demand->car->year }}</span>
                                </p>
                            </div>
                        </div>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i>
                            Location</strong>
                        <p class="text-muted mb-2">Malibu, California</p>

                        <hr />
                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                        <p class="text-muted">
                            {{ $demand->memo }}
                        </p>

                    </div>

                </div>

            </div>
            <div class="col-md-8">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Budget</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputEstimatedBudget">Estimated budget</label>
                            <input type="number" id="inputEstimatedBudget" class="form-control" value="2300"
                                step="1">
                        </div>
                        <div class="form-group">
                            <label for="inputSpentBudget">Total amount spent</label>
                            <input type="number" id="inputSpentBudget" class="form-control" value="2000" step="1">
                        </div>
                        <div class="form-group">
                            <label for="inputEstimatedDuration">Estimated project duration</label>
                            <input type="number" id="inputEstimatedDuration" class="form-control" value="20"
                                step="0.1">
                        </div>
                    </div>

                </div>

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Files</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th>File Size</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Functional-requirements.docx</td>
                                    <td>49.8005 kb</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                <tr>
                                    <td>UAT.pdf</td>
                                    <td>28.4883 kb</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                <tr>
                                    <td>Email-from-flatbal.mln</td>
                                    <td>57.9003 kb</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                <tr>
                                    <td>Logo.png</td>
                                    <td>50.5190 kb</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                <tr>
                                    <td>Contract-10_12_2014.docx</td>
                                    <td>44.9715 kb</td>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="#" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Save Changes" class="btn btn-success float-right">
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
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
@endsection
