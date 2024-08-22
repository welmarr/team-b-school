@extends('secured.layout')

@section('title')
    Profile - {{ $user->role == 'admin' ? 'Admin' : 'Dealer' }}
@endsection

@section('css')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">

    <link rel="stylesheet" href="{{ asset('css/sharing.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">

    <style>
        /* Add custom CSS here to adjust layout if needed */
        .form-section {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .container {
            display: flex;
            flex-direction: column !important;
            justify-content: space-between;
        }

        ul.dropdown-menu {
            --bs-dropdown-link-active-bg: #fb4f14;
        }


        button.dropdown-toggle {
            background-clip: padding-box !important;
            border: 1px solid #ced4da !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            appearance: none !important;
            --bs-btn-bg: white !important;
        }

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
                    <h1>Profile - {{ $user->role == 'admin' ? 'Admin' : 'Dealer' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ $user->role == 'admin' ? route('secured.admin.dashboard') : route('secured.dealers.dashboard') }}" class="text-orange">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Profile</li>
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
                <!-- Profile Details Section -->
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <!-- Profile picture or other content -->
                            </div>
                            <h3 class="profile-username text-center">
                                <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>
                            </h3>
                            <p class="text-center">
                                <span class="badge text-bg-success">Role:{{ $user->role }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Profile Details</h3>
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
                            @if ($user->role == 'dealer' && isset($user->dealership))
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

                <!-- Edit Profile Section -->
                <div class="col-md-6">
                    <div class="form-section">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Profile</h3>
                            </div>
                            <div class="card-body">
                                <form
                                    action="{{ $user->role == 'dealer' ? route('secured.dealers.profile.update') : route('secured.admin.profile.update') }}"
                                    method="POST" id="form-section-user">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
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
                                    <!-- Form fields -->
                                    <div class="form-group">
                                        <label for="inputFirstName">First Name</label>
                                        <input type="text" id="inputFirstName" name="first_name" class="form-control"
                                            value="{{ $user->first_name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputLastName">Last Name</label>
                                        <input type="text" id="inputLastName" name="last_name" class="form-control"
                                            value="{{ $user->last_name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhoneNumber">Phone Number</label>
                                        <input type="text" id="inputPhoneNumber" name="phone" class="form-control"
                                            value="{{ $user->phone }}">
                                    </div>
                                    <!-- Buttons -->
                                    <div class="row mt-3">
                                        <div class="col-12 d-flex justify-content-end">
                                            <input type="submit" value="Save Changes" class="btn btn-success"
                                                form="form-section-user">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if ($user->role == 'dealer' && isset($user->dealership))
                        <section class="connectedSortable">
                            <!-- Calendar -->
                            <div class="card card-primary">
                                <div class="card-header border-0">

                                    <h3 class="card-title">
                                        <i class="far fa-calendar-alt"></i>
                                        Edit Dealership profile
                                    </h3>
                                    <!-- tools card -->
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-primary btn-sm"
                                            data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <!-- /. tools -->
                                </div>
                                <div class="card-body pt-0">
                                    <form action="{{ route('secured.dealers.profile.dealership.update') }}" method="POST"
                                        id="form-section-dealership">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                @if (session('dealership_success'))
                                                    <div class="alert alert-success">
                                                        {{ session('dealership_success') }}
                                                    </div>
                                                @endif
                                                @if (session('dealership_error'))
                                                    <div class="alert alert-danger">
                                                        {{ session('dealership_error') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- Form fields -->
                                        <div class="form-group">
                                            <label for="dealership-name">Name</label>
                                            <input type="text" id="dealership-name" name="dealership_name"
                                                class="form-control" value="{{ $user->dealership->name }}">

                                            @error('dealership_name')
                                                <div class="text-danger mb-3">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="dealership-phone">Phone Number</label>
                                            <input type="text" id="dealership-phone" name="dealership_phone"
                                                class="form-control"
                                                value="{{ $user->dealership->phone }}">

                                            @error('dealership_phone')
                                                <div class="text-danger mb-3">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        @if(isset($user->dealership->address))
                                        <div class="row my-2">
                                            <div class="col-6">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="address"
                                                    name="dealership_address_line_1" placeholder="1234 Main St" value="{{ $user->dealership->address->address_line_1 }}">

                                                @error('dealership_address_line_1')
                                                    <div class="text-danger mb-3">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label for="address2" class="form-label">Address 2 </label>
                                                <input type="text" class="form-control" id="address2"
                                                    name="dealership_address_line_2" placeholder="Apartment or suite" value="{{ $user->dealership->address->address_line_2 }}">

                                                @error('dealership_address_line_2')
                                                    <div class="text-danger mb-3">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row my-2">
                                            <div class="col-md-4">
                                                <label for="state" class="form-label">State
                                                    {{ $user->dealership->state }}</label>
                                                <select class="form-select my-select" data-live-search="true"
                                                    id="state" name="dealership_state">
                                                    <option value="">Choose...</option>
                                                    @foreach (USA_states() as $sigle => $state)
                                                        <option value="{{ $sigle }}" {{ $user->dealership->address->state == $sigle ? 'selected' : '' }}>
                                                            {{ $state }}</option>
                                                    @endforeach
                                                </select>

                                                @error('dealership_state')
                                                    <div class="text-danger mb-3">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-md-5">
                                                <label for="city" class="form-label">City</label>
                                                <input type="text" class="form-control" id="city"
                                                    name="dealership_city" placeholder="City" value="{{ $user->dealership->address->city }}">

                                                @error('dealership_city')
                                                    <div class="text-danger mb-3">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="col-3">
                                                <label for="zip" class="form-label">Zip</label>
                                                <input type="text" class="form-control" id="zip"
                                                    name="dealership_zip" placeholder="Zip code" value="{{ $user->dealership->address->zip }}">

                                                @error('dealership_zip')
                                                    <div class="text-danger mb-3">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        @endif
                                        <!-- Buttons -->
                                        <div class="row mt-3">
                                            <div class="col-12 d-flex justify-content-end">
                                                <input type="submit" value="Save Changes" class="btn btn-success"
                                                    form="form-section-dealership">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card -->
                        </section>
                    @endif
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
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.my-select').selectpicker();
        })
    </script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
@endsection
