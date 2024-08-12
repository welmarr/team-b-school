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
    <!-- Main content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Profile Details Section -->
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <!-- Profile picture or other content -->
                        </div>
                        <h3 class="profile-username text-center">Users Name</h3>
                        <p class="text-muted text-center">Affiliation</p>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Profile Details</h3>
                    </div>
                    <div class="card-body">
                        <strong><i class="far fa-file-alt mr-1"></i> Personal Information</strong>
                        <p class="text-muted"></p>
                        <p class="text-muted">First Name</p>
                        <p class="text-muted">Last Name</p>
                        <p class="text-muted">Email</p>
                        <p class="text-muted">Phone Number</p>
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                        <p class="text-muted"></p>
                        <p class="text-muted">Address</p>
                        <p class="text-muted">City</p>
                        <p class="text-muted">State</p>
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
                            <div class="card-tools">
                                <!-- Optional tools can be added here -->
                            </div>
                        </div>
                    <div class="card-body">
                        <form action="{{ route('secured.admin.profile.update') }}" method="POST">
                        @csrf
                        @method("PUT")
                            <div class="form-group">
                                <label for="inputFirstName">First Name</label>
                                <input type="text" id="inputFirstName" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="inputLastName">Last Name</label>
                                <input type="text" id="inputLastName" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input type="text" id="inputEmail" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="inputPhoneNumber">Phone Number</label>
                                <input type="text" id="inputPhoneNumber" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Address</label>
                                <input type="text" id="inputEmail" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="inputPhoneNumber">City</label>
                                <input type="text" id="inputPhoneNumber" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">State</label>
                                <input type="text" id="inputEmail" class="form-control" value="">
                            </div>
                            <!-- Buttons -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <a href="#" class="btn btn-secondary">Cancel</a>
                                <input type="submit" value="Save Changes" class="btn btn-success float-right">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
message.txt
7 KB
