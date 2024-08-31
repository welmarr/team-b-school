@extends('secured.layout')


@php
    $label = [
        'admin' => 'Admin',
        'dealer' => 'Dealer',
        'dealer-admin' => 'Dealer',
        'simple-customer' => 'Customer',
    ];
@endphp

@section('title')
    Users - Admin
@endsection

@section('css')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">




    <link rel="stylesheet" href="{{ asset('css/sharing.css') }}">
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
                        <li class="breadcrumb-item text-orange"><a href="{{ route('secured.admin.users.index') }}">Users</a>
                        </li>
                        <li class="breadcrumb-item active">Details</li>
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

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <!-- Header content -->
                            </div>
                            <h3 class="profile-username text-center">
                                <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>
                            </h3>
                            <p class="text-center">
                                <span class="badge text-bg-success">Role: {{ $label[$user->role] }}</span>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <!-- Details Section -->
                <div class="col-md-6 col-sm-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">User Details</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="far fa-file-alt mr-1"></i> Personal Information</strong>
                            <p class="text-muted"></p>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <p class=""><span class="text-muted">First name:
                                        </span><strong>{{ $user->first_name }}</strong></p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <p class=""><span class="text-muted">Last name:
                                        </span><strong>{{ $user->last_name }}</strong></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <p class=""><span class="text-muted">Email:
                                        </span><strong>{{ $user->email }}</strong></p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <p class=""><span class="text-muted">Phone:
                                        </span><strong>{{ $user->phone }}</strong></p>
                                </div>
                            </div>
                            @if (($user->role == 'dealer' || $user->role == 'dealer-admin') && isset($user->dealership))
                                <hr>
                                <strong><i class="far fa-file-alt mr-1"></i> Dealership Information</strong>
                                <p class="text-muted"></p>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <p class=""><span class="text-muted">Name:
                                            </span><strong>{{ $user->dealership->name }}</strong></p>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <p class=""><span class="text-muted">Code:
                                            </span><strong>{{ $user->dealership->code }}</strong></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <p class=""><span class="text-muted">Phone:
                                            </span><strong>{{ $user->dealership->phone }}</strong></p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Requests Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <p class=""><span class="text-muted">Initialized:
                                        </span><strong>{{ $requestInitialized }}</strong></p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <p class=""><span class="text-muted">Estimated:
                                        </span><strong>{{ $requestEstimated }}</strong></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <p class=""><span class="text-muted">Accepted:
                                        </span><strong>{{ $requestAccepted }}</strong></p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <p class=""><span class="text-muted">In Progress:
                                        </span><strong>{{ $requestProgress }}</strong></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <p class=""><span class="text-muted">Completed:
                                        </span><strong>{{ $requestCompleted }}</strong></p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <p class=""><span class="text-muted">Canceled:
                                        </span><strong>{{ $requestCanceled }}</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Request list</h3>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
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
                    </div>
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
