@extends('unsecured.layout')


@section('title')
    Home
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
            <div class="col-5">
                <h1 class="my-3 fw-bold">Welcome to Cincy Dent Repair Expert Dent Removal Services</h1>
                <p class="card-text mb-auto my-3 lh-lg">At Cincy Dent Repair, we specialize in providing top-notch, mobile dent repair solutions tailored to your needs. Whether you’re an individual car owner or a dealership.</p>
                <a class="btn text-white btn-orange my-4" href="{{ route('get-estimate.view') }}" style="">Get a quote</a>
            </div>
            <div class="col-7 d-flex justify-content-end">
                <img class="img-fluid" src="{{ asset('img/home-img-01.jpg') }}" style="width: 85%; height: auto" />
            </div>
        </div>


        <div class="row my-4" style="margin-top: 150px !important" autocomplete="off">
            <div class="col-7 d-flex justify-content-start">
                <img class="img-fluid" src="{{ asset('img/home-img-02.jpg') }}" style="width: 85%; height: auto" />
            </div>
            <div class="col-5">
                <h1 class="my-3 fw-bold">Discover Our Wide Range of Services for Customers and Dealerships</h1>
                <p class="card-text mb-auto my-3 lh-lg">We offer a comprehensive suite of services designed to meet the unique needs of both customers and dealerships. From vehicle estimates to repair, we've got you covered.</p>
                <div class="row my-4">
                    <div class="col-6">
                        <h6 class="fw-bold">For Customers</h6>
                        <p class="card-text mb-auto lh-lg">Enter your personal information and vehicle details for accurate estimates.</p>

                        <a class="btn btn-sm text-white btn-orange my-4" href="{{ route('get-estimate.view') }}"  style="">Get estimate</a>
                    </div>
                    <div class="col-6">
                        <h6 class="fw-bold">For Dealerships</h6>
                        <p class="card-text mb-auto lh-lg">Effortlessly submit multiple vehicle details and damage photos for estimates.</p>

                        <a class="btn btn-sm text-white btn-orange my-4" href="{{ route('sign-up') }}" style="">Create account</a>
                    </div>
                </div>
            </div>
        </div>



        <div class="row my-4" style="margin-top: 150px !important;">
            <div class="col">
                <div class="card border border-0">
                    <img class="img-fluid" src="{{ asset('img/timewebp.webp') }}" style="width: 100%; height: 250px"/>
                  <h5 class="card-title fw-bold mt-1 mx-2">Quick Turnaround Time: Get your vehicle back on the road in no time.</h5>
                  <div class="card-body my-0 mx-2 px-0 py-0">
                    <p class="card-text">We understand the importance of getting your vehicle repaired quickly. Our dedicated team works efficiently to ensure a fast turnaround time.</p>
                  </div>
                </div>
            </div>

            <div class="col">
                <div class="card border border-0">
                    <img class="img-fluid" src="{{ asset('img/service.jpg') }}" style="width: 100%; height: 250px" />
                  <h5 class="card-title fw-bold mt-1 mx-2">Reliable Service: Trust us with your vehicle repair needs.</h5>
                  <div class="card-body my-0 mx-2 px-0 py-0">
                    <p class="card-text">Our experienced technicians provide reliable and highquality repairs for your vehicle. You can count on us to get the job done right.</p>
                  </div>
                </div>
            </div>


            <div class="col">
                <div class="card border border-0">
                    <img class="img-fluid" src="{{ asset('img/customer-02.webp') }}" style="width: 100%; height: 250px" />
                  <h5 class="card-title fw-bold mt-1 mx-2">Exceptional Support: We're here to help every step of the way.</h5>
                  <div class="card-body my-0 mx-2 px-0 py-0">
                    <p class="card-text">Our friendly and knowledgeable customer support team is available to answer any questions or concerns you may have.</p>
                  </div>
                </div>
            </div>
        </div>



        <div class="row my-4" style="margin-top: 150px !important;">
            <div class="row bg-dark text-white d-flex align-items-center" style="height: 300px !important; background: linear-gradient(135deg, #212529, #3a3f44 25%, #7c2e24 60%, #fb4f14) !important;">
                  <div class="">
                    <h1>Get a Free Repair Estimate</h1>
                    <p>Contact us today for a fast and reliable repair estimate.</p>
                    <p><a class="btn btn-orange" href="{{ route('get-estimate.view') }}">Estimate</a> <a class="btn btn-outline-orange"  href="{{ route('about') }}">Contact</a></p>
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
    <script>
        feather.replace();
    </script>
@endsection
