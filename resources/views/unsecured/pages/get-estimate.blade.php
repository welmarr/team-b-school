@extends('unsecured.layout')


@section('title')
    Get estimate
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/unsecured.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filepond.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filepond-plugin-image-preview.css') }}">

    <style>
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
    @include('unsecured.includes.header')
@endsection

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-6 col-sm-12">
                <h1 class="card-text mb-auto mt-3 fw-semibold">
                    Get a Quick and Accurate Vehicle Repair Estimate
                </h1>
            </div>
            <div class="col-md-6 mt-md-4 col-sm-12 mt-sm-2">
                <p>
                    Save time and money with our hassle-free dent repair estimate service. Simply provide your vehicle
                    details and upload pictures of the damage for a quick and accurate estimate.
                    With our efficient process, you can restore your vehicle's appearance faster and with less hassle. Trust
                    Cincy Dent Repair for reliable, quick, and cost-effective dent repair solutions.
                </p>
            </div>
        </div>

        <div class="row my-4  mx-md-5 px-md-5">
            <div class="col-12">
                <span class="badge text-bg-orange">Repair estimate form</span>
                <span class="mb-4 d-block">Fill in the form below to receive a precise quotation for your vehicle repair.
                    <br />Fields with <span class="fw-bold text-orange">*</span> are mandatory.</span>

                <form class="needs-validation" enctype="multipart/form-data" method="POST"
                    action="{{ route('unsecured.get-estimate.post') }}">
                    @csrf

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
                    <div class="row g-3">
                        <div class="col-sm-12 col-md-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <label for="firstName" class="form-label">First name <span
                                            class="text-orange">*</span></label>
                                    <input type="text" class="form-control" id="firstName" placeholder="Jon"
                                        value="{{ old('firstname') }}" required name="firstname">

                                    @error('firstname')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <label for="lastName" class="form-label">Last name <span
                                            class="text-orange">*</span></label>
                                    <input type="text" class="form-control" id="lastName" placeholder="Doe"
                                        value="{{ old('lastname') }}" required name="lastname">

                                    @error('lastname')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <label for="email" class="form-label">Email <span
                                            class="text-orange">*</span></label>
                                    <input type="email" class="form-control" id="email"
                                        placeholder="example@example.com" value="" name="email" required
                                        {{ old('email') }}>

                                    @error('email')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <label for="phonenumber" class="form-label">Phone <span
                                            class="text-orange">*</span></label>
                                    <input type="text" class="form-control" id="phonenumber" placeholder="123456789"
                                        {{ old('phonenumber') }} value="" name="phonenumber" required>

                                    @error('phone')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="col-12 mt-4">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" placeholder="1234 Main St"
                                        required name="address1" value="{{ old('address1') }}">
                                    <div class="invalid-feedback">
                                        Please enter your shipping address.
                                    </div>
                                </div>


                                <div class="col-12">
                                    <label for="address2" class="form-label">Address 2 <span
                                            class="text-body-secondary">(Optional)</span></label>
                                    <input type="text" class="form-control" id="address2" name="address2"
                                        placeholder="Apartment or suite" value="{{ old('address2') }}">
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <label for="state" class="form-label">State <span
                                            class="text-orange">*</span></label>
                                    <select class="form-select my-select" id="state" required data-live-search="true"
                                        name="state">
                                        <option value="">Choose...</option>
                                        @foreach ($states as $stateAbbreviation => $stateName)
                                            <option value="{{ $stateAbbreviation }}">{{ $stateName }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>


                                <div class="col-sm-12 col-md-5">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" placeholder="City"
                                        name="city" value="{{ old('city') }}">
                                </div>

                                <div class="col-sm-12 col-md-3">
                                    <label for="zip" class="form-label">Zip code <span
                                            class="text-orange">*</span></label>
                                    <input type="text" class="form-control" id="zip" placeholder="" required
                                        name="zipcode" value="{{ old('zipcode') }}">
                                    <div class="invalid-feedback">
                                        Zip code required.
                                    </div>
                                </div>


                                <div class="col-sm-12 col-md-4 mt-sm-0 mt-md-4">
                                    <label for="vehicle-brand" class="form-label">Vehicle Brand <span
                                            class="text-orange">*</span></label>
                                    <select class="form-select my-select" aria-label="" id="vehicle-brand"
                                        data-live-search="true" name="brand" id="car-brand">
                                        <option value="">Select the vehicle brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('brand')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-sm-12 col-md-4 mt-sm-0 mt-md-4">
                                    <label for="vehicle-year" class="form-label">Vehicle Year <span
                                            class="text-orange">*</span></label>
                                    <select class="form-select my-select" aria-label="" id="vehicle-year"
                                        data-live-search="true" name="year" id="car-year">
                                        <option value="">Select the vehicle year</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>

                                    @error('year')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="col-sm-12 col-md-4 mt-sm-0 mt-md-4">
                                    <label for="vehicle-model" class="form-label">Vehicle Model <span
                                            class="text-orange">*</span></label>
                                    <select class="form-select my-select" aria-label="" id="vehicle-model"
                                        data-live-search="true" name="model" id="car-model">
                                        <option selected value="">Select the vehicle model</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" rows="5" name="memo"></textarea>
                                </div>

                                <div class="col-12 mt-4">
                                    <label for="filepond" class="form-label">Add photos of impacted areas <span
                                            class="text-orange">*</span></label>
                                    <input type="file" class="filepond" name="filepond[]" multiple id="filepond"
                                        required />


                                    @error('filepond')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <hr class="my-4">
                        <div class="col-md-4 offset-md-4 col-sm-10 offset-sm-1">
                            <button class="w-100 btn btn-orange" type="submit">Submit information</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>


        <div class="row my-4" style="margin-top: 150px !important;">
            <h1 class="card-text mb-auto my-4 fw-semibold d-flex align-items-center justify-content-center">
                We're Here to Help
            </h1>
            <div class="row my-4" style="margin-top: 100px !important;">
                <div class="col-sm-12 col-md-4 d-flex align-items-center flex-column mt-md-1">
                    <i class="text-orange" data-feather="mail" style="width: 64px; height: 64px;"></i>
                    <h4 class="my-2 fw-bold">Email</h4>
                    <p class="mb-3">If you have any questions or issues, please feel free reach out to our customer
                        support team.</p>
                    <span class="underline-orange">test@test.test</span>
                </div>

                <div class="col-sm-12 col-md-4 d-flex align-items-center flex-column mt-sm-4 mt-md-1">
                    <i class="text-orange" data-feather="phone" style="width: 64px; height: 64px;"></i>
                    <h4 class="my-2 fw-bold">Phone</h4>
                    <p class="mb-2">You can contact us by phone during our business hours.</p>
                    <span class="underline-orange" style="margin-top: 2rem !important;">123456789</span>
                </div>


                <div class="col-sm-12 col-md-4 d-flex align-items-center flex-column mt-sm-4 mt-md-1">
                    <i class="text-orange" data-feather="map-pin" style="width: 64px; height: 64px;"></i>
                    <h4 class="my-2 fw-bold">Office</h4>
                    <p>Our office is open for in-person inquiries.</p>
                    <span class="underline-orange" style="margin-top: 1.5rem !important;">123 Sample St, Sydney NSW 2000
                        AU</span>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer')
    @include('unsecured.includes.footer')
@endsection

@section('js-before-bootstrap')
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
@endsection

@section('js-after-bootstrap')
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/filepond.js') }}"></script>
    <script src="{{ asset('js/filepond-plugin-image-preview.js') }}"></script>
    <script>
        $(document).ready(function() {


            feather.replace();

            // Initialize select picker
            $('.my-select').selectpicker();
            // Register the plugin
            //FilePond.registerPlugin(FilePondPluginImagePreview);

            // Init a FilePond instance
            const inputElement = document.querySelector('input[type="file"]');
            const pond = FilePond.create(inputElement);

            FilePond.setOptions({
                server: {
                    process: '/api/unsecure/images/upload',
                    revert: '/api/unsecure/images/delete',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            });

            // Function to fetch vehicle models based on selected year and brand
            function fetchModels() {
                var year = $('#vehicle-year').val();
                var brand = $('#vehicle-brand').val();

                if (year !== "0" && brand !== "0") {
                    $.ajax({
                        url: '/api/unsecure/models/' + brand + '/in/' + year,
                        method: 'GET',
                        success: function(response) {
                            // Clear and populate the vehicle model dropdown
                            $('#vehicle-model').empty().append(
                                '<option selected value="0">Select the vehicle model</option>');
                            response.models.forEach(function(model) {
                                $('#vehicle-model').append(new Option(model.name, model.id));
                            });
                            // Refresh the select picker
                            $('#vehicle-model').selectpicker('destroy');
                            $('#vehicle-model').selectpicker('render');
                        },
                        error: function() {
                            alert('Failed to fetch models. Please try again.');
                        }
                    });
                } else {
                    // Disable and reset the vehicle model dropdown if year or brand is not selected
                    $('#vehicle-model').prop('disabled', true).empty().append(
                        '<option selected value="0">Select the vehicle model</option>');
                }
            }

            // Event listener for vehicle year and brand change
            $('#vehicle-year, #vehicle-brand').change(fetchModels);
        });
    </script>
@endsection
