@extends('secured.layout')

@section('title')
    Profile - Dealership
@endsection

@section('css')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">
    <style>
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
                        <a href="{{ route('secured.dealers.dashboard') }}" class="text-orange">Dashboard</a>
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
                        <p class="text-muted"><strong>First Name:</strong> {{ $user->first_name }}</p>
                        <p class="text-muted"><strong>Last Name:</strong> {{ $user->last_name }}</p>
                        <p class="text-muted"><strong>Email:</strong> {{ $user->email }}</p>
                        <p class="text-muted"><strong>Phone:</strong> {{ $user->phone }}</p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> Dealership Information</strong>
                        @if($dealer)
                            <p class="text-muted"><strong>Name:</strong> {{ $dealer->name }}</p>
                            <p class="text-muted"><strong>Phone:</strong> {{ $dealer->phone }}</p>
                        @else
                            <p class="text-muted">No dealership information available.</p>
                        @endif
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                        @if($address)
                            <p class="text-muted"><strong>Address Line 1:</strong> {{ $address->address_line_1 }}</p>
                            <p class="text-muted"><strong>Address Line 2:</strong> {{ $address->address_line_2 }}</p>
                            <p class="text-muted"><strong>City:</strong> {{ $address->city }}</p>
                            <p class="text-muted"><strong>State:</strong> {{ $address->state }}</p>
                            <p class="text-muted"><strong>Zip:</strong> {{ $address->zip }}</p>
                        @else
                            <p class="text-muted">No address information available.</p>
                        @endif
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
                            <form action="{{ route('secured.dealers.profile.update', $user->id) }}" method="POST">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label for="inputFirstName">First Name</label>
                                    <input type="text" id="inputFirstName" name="first_name" class="form-control" value="{{ $user->first_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputLastName">Last Name</label>
                                    <input type="text" id="inputLastName" name="last_name" class="form-control" value="{{ $user->last_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="text" id="inputEmail" name="email" class="form-control" value="{{ $user->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputPhoneNumber">Phone Number</label>
                                    <input type="text" id="inputPhoneNumber" name="phone" class="form-control" value="{{ $user->phone }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputDealerName">Dealership Name</label>
                                    <input type="text" id="inputDealerName" name="dealer_name" class="form-control" value="{{ $dealer ? $dealer->name : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputDealerPhoneNumber">Dealership Phone</label>
                                    <input type="text" id="inputDealerPhoneNumber" name="dealer_phone" class="form-control" value="{{ $dealer ? $dealer->phone : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Address Line 1</label>
                                    <input type="text" id="inputAddress" name="address_line_1" class="form-control" value="{{ $address ? $address->address_line_1 : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress2">Address Line 2</label>
                                    <input type="text" id="inputAddress2" name="address_line_2" class="form-control" value="{{ $address ? $address->address_line_2 : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputCity">City</label>
                                    <input type="text" id="inputCity" name="city" class="form-control" value="{{ $address ? $address->city : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">State</label>
                                    <input type="text" id="inputState" name="state" class="form-control" value="{{ $address ? $address->state : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputZip">Zip Code</label>
                                    <input type="text" id="inputZip" name="zip" class="form-control" value="{{ $address ? $address->zip : '' }}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
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
