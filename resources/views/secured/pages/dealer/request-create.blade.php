@extends('secured.layout')

@php
    $label = [
        'admin' => 'Admin',
        'dealer' => 'Dealer',
        'dealer-admin' => 'Dealer',
        'simple-customer' => 'Customer',
    ];
@endphp

@section('title', 'Request creation - ' . $label[Auth::user()->role])

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
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

        .my-select button.btn.dropdown-toggle.btn-light {
            background-color: white !important;
        }
    </style>
@endsection


@section('header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bulk Request creation</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('secured.dealers.requests.index') }}"
                                class="text-orange">Requests</a></li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="content">



        <div class="card">
            <div class="card-header">
                <h3 class="card-title pt-2">Bulk Request Form</h3>
                <div class=" float-right">
                    <button class="btn btn-success rounded-circle" type="button" id="add-new-car"><i
                            class="fas fa-plus"></i></button>
                    <button class="btn btn-success rounded-circle" type="button" id="switch-list-grid"><i
                            class="fas fa-th-large"></i></button>
                </div>
            </div>

            <div class="card-body p-0">
                <form action="{{ route('secured.dealers.requests.store') }}" method="POST" id="form-bulk-submission"
                    class="row">

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
                    @csrf
                    <div class="row element-class mx-3 mt-3  col-md-12" id="element-1">
                        <div class="">
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Car #1</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="col-12">
                                        <label for="vehicle-brand-1" class="form-label">Vehicle Brand <span
                                                class="text-orange">*</span></label>
                                        <select class="form-select my-select" aria-label="" id="vehicle-brand-1"
                                            data-live-search="true" name="cars[1][brand]" required>
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

                                    <div class="col-12">
                                        <label for="vehicle-year-1" class="form-label">Vehicle Year <span
                                                class="text-orange">*</span></label>
                                        <select class="form-select my-select" aria-label="" id="vehicle-year-1"
                                            data-live-search="true" name="cars[1][year]" required>
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


                                    <div class="col-12">
                                        <label for="vehicle-model-1" class="form-label">Vehicle Model <span
                                                class="text-orange">*</span></label>
                                        <select class="form-select my-select" aria-label="" id="vehicle-model-1"
                                            data-live-search="true" name="cars[1][model]" required>
                                            <option selected value="">Select the vehicle model</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label for="message" class="form-label">Message</label>
                                        <textarea class="form-control" id="message" rows="5" name="cars[1][memo]"></textarea>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <label for="filepond-1" class="form-label">Add photos of impacted areas <span
                                                class="text-orange">*</span></label>
                                        <input type="file" class="filepond" name="cars[1][filepond][]" multiple
                                            id="filepond-1" required />


                                        @error('filepond')
                                            <div class="text-danger mb-3">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-footer d-flex justify-content-end">
                <button class="btn btn-success mt-4 mr-3" type="submit" id="start-work-form-button"
                    form="form-bulk-submission">Submit</button>
            </div>
        </div>

    </section>
@endsection

@section('footer')
    @include('secured.includes.footer')
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
@endsection


@section('js-after-bootstrap')
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/filepond.js') }}"></script>
    <script src="{{ asset('js/filepond-plugin-image-preview.js') }}"></script>
@endsection

@section('js-before-bootstrap')

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.my-select').selectpicker();

            $('#add-new-car').on('click', function() {
                addNewCar();
            });

            $('#switch-list-grid').on('click', function() {

                console.log("fkfkfkf")
                $('div.element-class').each(function(i) {
                    console.log(i, $(this))
                    if ($(this).hasClass('col-md-12')) {
                        $(this).removeClass('col-md-12').addClass('col-md-5');
                        console.log("WORK")
                    } else if ($(this).hasClass('col-md-5')) {
                        $(this).removeClass('col-md-5').addClass('col-md-12');
                        console.log("REMOVED")
                    }
                });

            });

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

            function addNewCar() {
                let carIndex = ($('div.element-class-added').length) + 2;
                let newCarForm = `
                <div class="row mx-3 mt-3 element-class-added element-class ${$('#element-1').hasClass('col-md-12') ? 'col-md-12' : 'col-md-5'}" id="element-${carIndex}">
                    <div class="">
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Car #${carIndex}</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"
                                        onclick="removeCar(${carIndex})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="col-12">
                                    <label for="vehicle-brand-${carIndex}" class="form-label">Vehicle Brand <span
                                            class="text-orange">*</span></label>
                                    <select class="form-select my-select" aria-label="" id="vehicle-brand-${carIndex}"
                                        data-live-search="true" name="cars[${carIndex}][brand]" required>
                                        <option value="">Select the vehicle brand</option>
                                        @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 ">
                                    <label for="vehicle-year-${carIndex}" class="form-label">Vehicle Year <span
                                            class="text-orange">*</span></label>
                                    <select class="form-select my-select" aria-label="" id="vehicle-year-${carIndex}"
                                        data-live-search="true" name="cars[${carIndex}][year]" required>
                                        <option value="">Select the vehicle year</option>
                                        @foreach ($years as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 ">
                                    <label for="vehicle-model-${carIndex}" class="form-label">Vehicle Model <span
                                            class="text-orange">*</span></label>
                                    <select class="form-select my-select" aria-label="" id="vehicle-model-${carIndex}"
                                        data-live-search="true" name="cars[${carIndex}][model]" required>
                                        <option selected value="">Select the vehicle model</option>
                                    </select>
                                </div>

                                <div class="col-12 ">
                                    <label for="message-${carIndex}" class="form-label">Message</label>
                                    <textarea class="form-control" id="message-${carIndex}" rows="5"
                                        name="cars[${carIndex}][memo]"></textarea>
                                </div>

                                <div class="col-12 mt-4">
                                    <label for="filepond-${carIndex}" class="form-label">Add photos of impacted areas <span
                                            class="text-orange">*</span></label>
                                    <input type="file" class="filepond" name="cars[${carIndex}][filepond][]" multiple
                                        id="filepond-${carIndex}" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `;

                $('#form-bulk-submission').append(newCarForm);
                $(`#element-${carIndex} .my-select`).selectpicker();
                // Attach change event listener to the new vehicle year and brand selectors
                $(`#vehicle-year-${carIndex}, #vehicle-brand-${carIndex}`).change(function() {
                    fetchModels(carIndex);
                });
                let elt = document.querySelector(`#filepond-${carIndex}`);
                FilePond.create(elt);

            }

            window.removeCar = function(index) {
                console.log('Remove ' + '#element-' + index);
                $('#element-' + index).remove();
                updateCarIndexes();
            }

            function updateCarIndexes() {
                $('div.element-class-added').each(function(i) {
                    // 1 for the default form and one due to the fact that index i start by 0
                    let newIndex = i + 2;
                    $(this).attr('id', 'element-' + newIndex);
                    $(this).find('.card-title').text('Car #' + newIndex);


                    $(this).find('[data-card-widget="remove"]').each(function() {
                        $(this).attr('onclick', 'removeCar(' + newIndex + ')');
                    });

                    // Update all input fields to match the new index
                    $(this).find('.form-select, .form-control').each(function() {
                        let nameAttr = $(this).attr('name');
                        if (nameAttr) {
                            let newName = nameAttr.replace(/\[.*?\]/, '[' + newIndex + ']');
                            $(this).attr('name', newName);
                        }

                        let idAttr = $(this).attr('id');
                        if (idAttr) {
                            let newId = idAttr.replace(/-\d+/, '-' + newIndex);
                            $(this).attr('id', newId);
                            $(this).prev('label').attr('for',
                                newId); // Update the label's "for" attribute
                        }
                    });
                    // Re-initialize selectpicker on updated selects
                    $(this).find('.my-select').selectpicker('refresh');


                    // Update filepond fields attr
                    $(this).find('.filepond--root').each(function() {
                        let idAttr = $(this).attr('id');
                        if (idAttr) {
                            let newId = idAttr.replace(/-\d+/, '-' + newIndex);
                            $(this).attr('id', newId);
                            $(this).prev('label').attr('for',
                                newId); // Update the label's "for" attribute
                        }
                    })

                    $(this).find('.filepond--data input[type="hidden"]').each(function() {
                        let nameAttr = $(this).attr('name');
                        if (nameAttr) {
                            let newName = nameAttr.replace(/\[.*?\]/, '[' + newIndex + ']');
                            $(this).attr('name', newName);
                        }
                    })

                });
            }

            // Function to fetch vehicle models based on selected year and brand
            function fetchModels(index) {
                var year = $(`#vehicle-year-${index}`).val();
                var brand = $(`#vehicle-brand-${index}`).val();
                console.log("year = " + year + " | brand = " + brand)

                if ((typeof year !== 'undefined') && (typeof brand !== 'undefined') && year !== "0" && brand !==
                    "0") {
                    $.ajax({
                        url: "{{ route('api.unsecure.model.by.brand.year', ['brand' => ':brand', 'year' => ':year']) }}"
                            .replace(':brand', brand).replace(':year', year),
                        method: 'GET',
                        success: function(response) {
                            console.log(year, brand, "++++++++++++++++++++++++++++++++++++")
                            // Clear and populate the vehicle model dropdown
                            console.log(response)
                            $(`#vehicle-model-${index}`).empty().append(
                                '<option selected value="0">Select the vehicle model</option>');
                            response.models.forEach(function(model) {
                                $(`#vehicle-model-${index}`).append(new Option(model.name, model
                                    .id));
                            });
                            // Refresh the select picker
                            $(`#vehicle-model-${index}`).selectpicker('destroy');
                            $(`#vehicle-model-${index}`).selectpicker('render');
                        },
                        error: function() {
                            alert('Failed to fetch models. Please try again.');
                        }
                    });
                } else {
                    console.log("---------------------------")
                    // Disable and reset the vehicle model dropdown if year or brand is not selected
                    $(`#vehicle-model-${index}`).prop('disabled', true).empty().append(
                        '<option selected value="0">Select the vehicle model</option>');
                }
            }

            // Event listener for vehicle year and brand change
            $('#vehicle-year-1, #vehicle-brand-1').change(function() {
                fetchModels(1);
            });
        });
    </script>
@endsection
