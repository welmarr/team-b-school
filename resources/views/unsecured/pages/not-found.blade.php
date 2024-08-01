@extends('unsecured.layout')


@section('title')
    404 - Not found
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/unsecured.css') }}">

    <style>
        html,
        body {
        height: 100%;
        }
        .container {
            display: flex;
            flex-direction: column !important;
            justify-content: space-between;
        }
        #form-section{
            display: flex;
            justify-content: center;
        }
        svg.feather {
            width: 16px !important;
        }


        
    </style>

@endsection


@section('content')
    <div class="w-100"  id="form-section">
        <div class="mt-4" style="max-width: 400px;">
            <div class="container text-center mt-5">
                <img src="{{ asset("img/not-found-img.png")}}" alt="Funny 404 Image" class="img-fluid my-4">
                <p class="lead">Well, this is awkward... It seems like you've discovered a page that doesn't exist!</p>
                <div class="my-4">
                    <a class="w-100 btn btn-orange btn-lg" href="{{ route('unsecured.home') }}">Back to Home page</a>
                </div>
                <p class="fs-6">If all else fails, perhaps our missing page is off exploring the internet. If you need help, <a href="#" class="text-orange underline-orange">contact us</a>, and we'll track it down!</p>
            </div>
        </div>
    </div>
@endsection

