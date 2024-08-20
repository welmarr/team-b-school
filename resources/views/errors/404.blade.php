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
                <p class="lead">Oops! The resource you're looking for isn't here.</p>
                <div class="my-4">
                    <a class="w-100 btn btn-orange btn-lg" href="{{ route('home') }}">Back to Home page</a>
                </div>
            </div>
        </div>
    </div>
@endsection

