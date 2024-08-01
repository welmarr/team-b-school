@extends('unsecured.layout')


@section('title')
    Track your repair
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/unsecured.css') }}">
@endsection


@section('header')
    @include('unsecured.includes.header')
@endsection

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="offset-3 col-6">
                <h1 class="card-text mb-auto mt-3 fw-semibold">
                    Track the request update
                </h1>
            </div>
        </div>

        <div class="row my-4">
            <div class="offset-3 col-6">
              <span class="badge text-bg-orange">Repair request update history</span>
              <span class="mb-4 d-block">Enter your request code in the field below to see the latest updates.

              <form class="needs-validation" novalidate>
                <div class="row g-3">
                  <div class="col-12">
                    <label for="requestnumber" class="form-label">Request number</label>
                    <input type="text" class="form-control" id="requestnumber" placeholder="M575665ON" value="" required name="requestnumber">
                  </div>

                <hr class="my-4">
                <div class="row">
                    <div class="offset-3 col-6">
                        <button class="w-100 btn btn-orange btn-lg" type="submit">Display update</button>
                    </div>
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

@section('js-after-bootstrap')
<script  src="{{ asset('js/feather.min.js') }}"></script>
<script>
    feather.replace();
</script>
@endsection
