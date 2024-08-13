@extends('secured.layout')

@section('title')
    Profile - Dealership
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
                <h1>Profile - Dealership</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#" class="text-orange">Dashboard</a>
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
                        <p class="text-muted"><strong></strong> {{ $user->first_name }}</p>
                        <p class="text-muted"><strong></strong> {{ $user->last_name }}</p>
                        <p class="text-muted"><strong></strong> {{ $user->email }}</p>
                        <p class="text-muted"><strong></strong> {{ $user->phone }}</p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> Dealership Information</strong>
                        <p class="text-muted"><strong></strong> {{ $user->name }}</p>
                        <p class="text-muted"><strong></strong> {{ $user->phone }}</p>
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                        <p class="text-muted"><strong></strong> {{ $user->address_line_1 }}</p>
                        <p class="text-muted"><strong></strong> {{ $user->city }}</p>
                        <p class="text-muted"><strong></strong> {{ $user->state }}</p>
                        <p class="text-muted"><strong></strong> {{ $user->zip }}</p>
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
                            <form action="" method="POST">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label for="inputFirstName">First Name</label>
                                    <input type="text" id="inputFirstName" class="form-control" value="{{ $user->first_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputLastName">Last Name</label>
                                    <input type="text" id="inputLastName" class="form-control" value="{{ $user->last_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="text" id="inputEmail" class="form-control" value="{{ $user->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputPhoneNumber">Phone Number</label>
                                    <input type="text" id="inputPhoneNumber" class="form-control" value="{{ $user->phone }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputDealerName">Dealership Name</label>
                                    <input type="text" id="inputDealerName" class="form-control" value="{{ $user->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputDealerPhoneNumber">Dealership Phone</label>
                                    <input type="text" id="inputDealerPhoneNumber" class="form-control" value="{{ $user->phone }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Address</label>
                                    <input type="text" id="inputAddress" class="form-control" value="{{ $user->address_line_1 }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress2">Secondary Address</label>
                                    <input type="text" id="inputAddress2" class="form-control" value="{{ $user->address_line_2 }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputCity">City</label>
                                    <input type="text" id="inputCity" class="form-control" value="{{ $user->city }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">State</label>
                                    <input type="text" id="inputState" class="form-control" value="{{ $user->state }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Zip</label>
                                    <input type="text" id="inputState" class="form-control" value="{{ $user->zip }}">
                                </div>
                                <!-- Buttons -->
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <input type="submit" value="Save Changes" class="btn btn-success">
                                    </div>
                                </div>
                            </form>
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