@extends('secured.layout')

@section('title')
    Profile - Admin
@endsection

@section('css')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">
    <style>
        /* Add custom CSS here to adjust layout if needed */
        .form-section {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>
@endsection

@section('header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile - Admin</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('secured.admin.dashboard') }}" class="text-orange">Dashboard</a>
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
                            {{ $user->first_name }} {{ $user->last_name }}
                        </h3>
                        <p class="text-muted text-center">
                            <strong>Role:</strong> {{ $user->role }}
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
                        <p class="text-muted"><strong></strong> {{ $user->first_name }}</p>
                        <p class="text-muted"><strong></strong> {{ $user->last_name }}</p>
                        <p class="text-muted"><strong></strong> {{ $user->email }}</p>
                        <p class="text-muted"><strong></strong> {{ $user->phone }}</p>
                        <hr>
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
                        <form action="{{ route('secured.admin.profile.update') }}" method="POST">
    @csrf
    @method('PUT')
    <!-- Form fields -->
    <div class="form-group">
        <label for="inputFirstName">First Name</label>
        <input type="text" id="inputFirstName" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}">
    </div>
    <div class="form-group">
        <label for="inputLastName">Last Name</label>
        <input type="text" id="inputLastName" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}">
    </div>
    <div class="form-group">
        <label for="inputEmail">Email</label>
        <input type="email" id="inputEmail" name="email" class="form-control" value="{{ old('email', $user->email) }}">
    </div>
    <div class="form-group">
        <label for="inputPhoneNumber">Phone Number</label>
        <input type="text" id="inputPhoneNumber" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
    </div>
    <!-- Buttons -->
    <div class="row mt-3">
        <div class="col-12">
            <a href="#" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Save Changes" class="btn btn-success float-right">
        </div>
    </div>
</form>

                            <!-- Display success or error messages -->
                            @if(session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger mt-3">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                    </div>
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

@section('js-after-bootstrap')
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
@endsection
