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
            <div class="col-12 my-2">
                <h5 class="fw-bold text-orange">Our story</h5>
                <h3 class="card-text mb-auto mt-3 fw-semibold">
                    Cincy Dent Repair: Servicing the Tri-State Area Since 2017
                </h3>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <p> Sole owner and creator of Cincy Dent Repair. This is what I do,
                    and I love what I do. I strive to provide the best service possible for all clients, but my approach
                    to my work is fun. It's so much fun, it doesn't even feel like work. I continue to work on improving my
                    processes to increase customer satisfaction across the board. Established in 2017, I absolutely felt
                    like
                    this was a service I could provide and continue to excel at, not to mention, automotive work isn't
                    really
                    work when you love cars as much as I do. The only thing I take more pride in besides my work is my
                    customer
                    and general client satisfaction with my work. High quality work at an affordable price, as well as
                    extreme
                    mobile availability to the extent of on-site dent repair is the calling card for Cincy Dent Repair.
                    <br>
                    <br>
                    The three things I focused on the most when it comes to Cincy Dent Repair are exceptional quality,
                    affordable pricing, and most importantly, mobility and travel. I'm not the first, and I won't be the
                    last, but I will always work my hardest to become better and continue to improve the quality of my work.
                    <br>
                    <br>
                    Cincy Dent Repair currently contracts to service several dealerships in the Tri-State area, to ensure
                    quality repair for a large scale of vehicles, improving and fixing imperfections for vehicles being sold
                    in the area. Make no mistake about it though, CDR offers the same repair quality for your vehicle as an
                    individual customer as they do for a vehicle being sold by a dealership.
                    <br>
                    <br>
                    I also put emphasis on the "traveling dent repair" aspect of CDR. What does that means? It means I come
                    to
                    you! Flexibility is the primary concern, and repairs are not done in a shop. They are done on site, by
                    me,
                    with my own personal tools. That means exactly what it sounds like! If you inquire about repair and are
                    comfortable with our estimated repair costs, I will willingly travel to you and perform on-site repairs.
                    I
                    even offer these services on the weekends! Whereas a lot of automotive places may not provide services
                    on
                    weekends, I am always willing to meet and perform a repair job for a customer on the weekends if that is
                    a
                    more flexible option for you. The main objectives here are quality repair and customer satisfaction.
                    <br>
                    <br>
                    Last but certainly not least, I do correctional repairs! What if you have previous damage and someone
                    else
                    has already attempted to repair it, but you are unsatisfied with their work? I can fix that! Just as a
                    matter
                    of pride, at times I see repair attempts that the customer may be satisfied with, but I'm not satisfied
                    with
                    myself. Everyone has their own different methods, and if I see a repair that could have been done a
                    different
                    way with more efficiency and effectiveness, then I will perform those corrective methods. I'd say the
                    most pride
                    I take in general in regards to a completed job is when I can effectively improve on a past repair job
                    that may
                    have been much more effectively completed in other ways.
                    <br>
                    Take a look at some of my sample work on this page, but it's just a microcosm of what is offered at
                    Cincy Dent
                    Repair. <br> <br> <span class="text-orange">Refer to our Facebook and Instagram page (links below) to see much more comprehensive, in depth
                        and detailed  descriptions and photos of past jobs before you make the choice to allow CDR to service your vehicle.</span><br>
                </p>
            </div>
        </div>


        <div class="row my-4" style="margin-top: 75px !important;">
                <img  src="{{ asset('img/christ-01.jpg') }}" style="width: 33%; max-height: 372px !important; " />

                <img src="{{ asset('img/repair1.jpg') }}" style="width: 33%; max-height: 372px !important;" />

                <img  src="{{ asset('img/repair2.jpg') }}" style="width: 33%; max-height: 372px !important;" />
        </div>
        <div class="div">
            <div class="row">
                <div class="col-12 d-flex">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="fw-bold">Chris Young</h4>
                        <div class="d-flex flex-column flex-sm-row justify-content-between"
                            style="border-top: 1px solid #eb4034 !important">
                            <ul class="list-unstyled d-flex justify-content-center w-100">
                                <li class=""><a class="link-dark"
                                        href="https://www.instagram.com/cincydentrepair?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><svg
                                            class="bi" width="16" height="16">
                                            <use xlink:href="#instagram" />
                                        </svg></a></li>
                                <li class="ms-3"><a class="link-dark"
                                        href="https://www.facebook.com/profile.php?id=61558731607535"><svg class="bi"
                                            width="16" height="16">
                                            <use xlink:href="#facebook" />
                                        </svg></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('footer')
    @include('unsecured.includes.footer')
@endsection

@section('js-after-bootstrap')
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <script>
        feather.replace();
    </script>
@endsection
