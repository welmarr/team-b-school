<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="Saquib" content="Blade">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    @yield('css')
</head>

<body class="@yield('body-class')">
    <div class="container">
        @yield('header')
        <div id="main" class="row">
            @yield('content')
        </div>

        @yield('footer')
        @yield('js-before-bootstrap')
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        @yield('js-after-bootstrap')
    </div>
</body>

</html>
