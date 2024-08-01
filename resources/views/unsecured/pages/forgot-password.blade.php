@extends('unsecured.layout')


@section('title')
    Forgot password
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


    </style>

@endsection


@section('content')

<div class="w-100"  id="form-section">
    <div class="mt-4" style="">
        <form>
            <h4 class="my-4 fw-bold text-orange">Forgot password</h4>


            <div class="row my-2">
                <div class="col-12">
                    <label for="email" class="form-label">Email <span class="text-orange">*</span></label>
                    <input type="email" class="form-control" id="email" placeholder="you@example.com" required>
                  </div>
            </div>


              <hr class="mt-4 mb-3">
              <div class="row">
                <button class="w-100 btn btn-orange btn-lg" type="submit">Reset password</button>
                <p class="mt-2 d-flex justify-content-center"> <a href="{{route("unsecured.login")}}" class="text-orange">Login</a>&nbsp; | 	&nbsp;<a href="{{route("unsecured.sign-up")}}" class="text-orange">Create account</a></p>
              </div>
    </form>
    </div>
</div>

        <div class="row" style="">
            <div class="col-12">

            </div>

        </div>
@endsection


@section('footer')
    @include('unsecured.includes.footer')
@endsection
