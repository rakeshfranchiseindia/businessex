@extends('layouts.app')
@section("content");
<main id="main">
    <div class="container bex-main">
        <div class="row">
            <div class="col-12">
                <ul class="brunnar">
                    <li><a href="#">Home</a></li>
                    <li>/</li>
                    <li><a href="#">Business</a></li>
                    <li>/</li>
                    <li><a href="#">Health</a></li>
                    <li>/</li>
                    <li><a href="#">Old gym for Sale</a></li>
                    <li>/</li>
                    <li>An upcoming company in the Food & Beverage sector, one of the fast growing industry segment.</li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h1 class="headblk">
                    An upcoming company in the Food & Beverage sector, one of the fast growing industry segment.
                </h1>
                <p class="statictxt">
                    Focuses on providing its customers with a healthy snacking option along with its eco-friendly and hygienic packaging, with negligible usage of plastics.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <ul class="bexdlist">
                    <li><img src="{{ asset('assets/img/lock.svg') }}"> Business Name (Available after interaction)</li>
                    <li class="linesh">|</li>
                    <li><img src="{{ asset('assets/img/lock.svg') }}"> Dwarka Delhi India</li>
                    <li class="linesh">|</li>
                    <li>Profile Listed By: Owner</li>
                </ul>
            </div>
        </div>

        <div class="row landpage">
            <div class="col-12 col-md-9">
                {{-- Carousel --}}
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://s3.ap-south-1.amazonaws.com/businessextest/subCatImages/28/1000_x_562/shutterstock_204535609.jpg" class="d-block w-100" alt="a">
                        </div>
                        <div class="carousel-item">
                            <img src="https://s3.ap-south-1.amazonaws.com/businessextest/subCatImages/28/1000_x_562/shutterstock_389790181.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://s3.ap-south-1.amazonaws.com/businessextest/subCatImages/28/1000_x_562/shutterstock_566591296.jpg" class="d-block w-100" alt="b">
                        </div>
                        <div class="carousel-item">
                            <img src="https://s3.ap-south-1.amazonaws.com/businessextest/subCatImages/28/1000_x_562/shutterstock_761077030.jpg" class="d-block w-100" alt="b">
                        </div>
                        <div class="carousel-item">
                            <img src="https://s3.ap-south-1.amazonaws.com/businessextest/subCatImages/66/1000_x_562/shutterstock_1113163970.jpg" class="d-block w-100" alt="b">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                {{-- Business Details --}}
                <ul class="mainsecdet">
                    <li><span>Seeking Investment</span> INR 1 Cr - 2 Cr</li>
                    <li class="linesh">|</li>
                    <li><span>Annual Sales/Turnover</span> N/A</li>
                    <li class="linesh">|</li>
                    <li><span>Gross Income</span> N/A</li>
                </ul>

                {{-- Tabs --}}
                <div class="fulldetailpage">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#BusinessD">Business</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Financial">Financials</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#BusinessPlan">Business Plan</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#BusinessRequirement">Business Requirement</a></li>
                    </ul>

                    <div class="tab-content">
                        {{-- Business Tab --}}
                        <div class="tab-pane active" id="BusinessD">
                            <p>The Gym in consideration is one year old... Premium machines and decor, as per brand standards.</p>
                            <div class="bexdetailsh">Director / CEO information <span><img src="{{ asset('assets/img/lock.svg') }}"> Available after Interaction</span></div>
                            <div class="bexdetailsh">Management Team information <span><img src="{{ asset('assets/img/lock.svg') }}"> Available after Interaction</span></div>
                            <div class="bexdetailsh">One line Business Pitch <span>Sit back and relax. We'll take care of your travel requirements for business.</span></div>
                            <div class="bexdetailsh">Business Overview <span>Focuses on providing its customers with a healthier snacking options...</span></div>
                            <div class="bexdetailsh">Facilities
                                <span>
                                    <ul>
                                        <li>(a) Baked snacks</li>
                                        <li>(b) Roasted snacks</li>
                                        <li>(c) Fried snacks</li>
                                    </ul>
                                </span>
                            </div>
                        </div>

                        {{-- Financials Tab --}}
                        <div class="tab-pane" id="Financial">
                            <ul class="bexshowdt">
                                <li><span class="b1">Annual Sales</span><span class="b2">:</span><span class="b3">B2C</span></li>
                                <li><span class="b1">EBITDA</span><span class="b2">:</span><span class="b3">Undisclosed</span></li>
                                <li><span class="b1">Gross Income</span><span class="b2">:</span><span class="b3">100000000</span></li>
                            </ul>
                        </div>

                        {{-- Business Plan Tab --}}
                        <div class="tab-pane" id="BusinessPlan">
                            <div class="bexdetailsh">Select your Company stage <span>Concept Stage</span></div>
                            <div class="bexdetailsh">Company Summary <span>Are you hearing too much about dark/cloud kitchen?...</span></div>
                        </div>

                        {{-- Business Requirement Tab --}}
                        <div class="tab-pane" id="BusinessRequirement">
                            <div class="bexdetailsh">Business Requirement</div>
                            <ul class="bexshowdt">
                                <li><span class="b1">Looking For</span><span class="b2">:</span><span class="b3">Investment</span></li>
                                <li><span class="b1">Amount</span><span class="b2">:</span><span class="b3">40000000 at 0 % stake</span></li>
                                <li><span class="b1">Reason</span><span class="b2">:</span><span class="b3">We are looking to expand our business...</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
@endsection