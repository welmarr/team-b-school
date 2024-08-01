@extends('unsecured.layout')


@section('title')
    About
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/unsecured.css') }}">
@endsection


@section('header')
    @include('unsecured.includes.header')
@endsection

@section('content')
    <div class="container">
        <div class="row my-4">
            <div class="col-6">
                <h5 class="my-3 fw-bold text-orange">Our story</h5>
                <h1 class="card-text mb-auto my-3 fw-semibold">
                    Cincy Dent Repair: Where Challenges Become Solutions
                </h1>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <p>
                    Chris Young's journey into the dent repair industry is a story of determination and entrepreneurial spirit. After spending years in various jobs, Chris decided
                    to take a leap of faith. In 2017, he became his own employer and ventured into the dent repair business. Starting small, Chris built his reputation as a
                    skilled traveling dent repair specialist. Fast forward to 2024, Chris's business has flourished. He not only caters to individual customer orders for dent repair but also partners with multiple
                    dealerships. These dealerships rely on Chris for routine dent repairs across their vehicle inventory and count on him for emergency services, such as fixing damage from hailstorms that can affect numerous cars simultaneously.
                    Chris's commitment to quality service and customer satisfaction has made Cincy Dent Repair a trusted name in the industry. Whether you're an individual car owner or a dealership, Chris's expertise ensures your vehicle is in the best hands.
                </p>
            </div>
        </div>


        <div class="row my-4" style="margin-top: 150px !important">
            <div class="col-6 d-flex align-items-center">
                <div class="d-flex flex-column justify-content-center ">
                    <h4 class="fw-bold">Chris Young</h4>
                    <div class="d-flex flex-column flex-sm-row justify-content-between" style="border-top: 1px solid #eb4034 !important">
                        <ul class="list-unstyled d-flex">
                        <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="16" height="16"><use xlink:href="#twitter"/></svg></a></li>
                        <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="16" height="16"><use xlink:href="#instagram"/></svg></a></li>
                        <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="16" height="16"><use xlink:href="#facebook"/></svg></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <img class="img-fluid" src="{{ asset('img/christ-01.jpg') }}" style="width: 85%; height: auto" />
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
