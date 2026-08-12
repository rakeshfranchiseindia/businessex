@extends('layouts.app')

@section('content')
<main id="main">
    <!-- ======= Intro Section ======= -->
    <section id="hero" class="section-t8 d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <div class="row">
                <div class="col-xl-8 bex-hero-section section-t4">
                    <h1>LEADING <span class="bex-hero-section-hed">BUSINESS</span> EXCHANGE NETWORK</h1>
                    <h2>
                        <b>1500+</b> Businesses, <b>1400+</b> Startups, <b>1800+</b> Investors, <b>200+</b> Mentors and <b>50+</b>
                        Incubators are registered in our community so far!
                    </h2>
                    <h3>Why wait, create your profile now</h3>
                    <!-- <a href="#about" class="btn-get-started scrollto">Get Started</a> -->
                    <div class="row">
                        <div class="col-xl-6 offset-xs-12 offset-md-12 offset-lg-12 offset-xl-3 align-self-center bex-form-control">
                            <form>
                                <div class="input-group input-group-hero-main mb-3">
                                    <select id="inputState" class="form-control">
                                        <option selected>Select a profile...</option>
                                        <option value="1">Business | Looking To Sell</option>
                                        <option value="2">Startup | Looking For Funds</option>
                                        <option value="3">Investor | Looking To Invest/Buy</option>
                                        <option value="4">Mentor | Looking To Guide/Coach</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn bex-btn-primary" type="button" id="button-addon2">CREATE PROFILE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="bex-card-main">
                            <div class="bex-form-section-main">
                                <h5>REGISTER FOR FREE</h5>
                                @if(session('email_error'))
                                    <div class="text-danger">{{ session('email_error') }}</div>
                                @endif
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="bex-form-section">
                                <form id="quick-registration" name="quick-registration" method="POST" action="{{ route('quick.register') }}">
                                    @csrf

                                    <!-- Profile -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="./assets/img/doc-file.png" alt="Profile">
                                            </span>
                                        </div>
                                        <select id="inputState" name="profile" class="form-control" required>
                                            <option selected>Select a profile...</option>
                                            <option value="1">Business | Looking To Sell</option>
                                            <option value="2">Startup | Looking For Funds</option>
                                            <option value="3">Investor | Looking To Invest/Buy</option>
                                            <option value="4">Mentor | Looking To Guide/Coach</option>
                                        </select>
                                    </div>
                                    @error('profile')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <!-- Name -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="./assets/img/person.png" alt="Name">
                                            </span>
                                        </div>
                                        <input name="name" type="text" class="form-control" placeholder="Enter Your Name" required>
                                    </div>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <!-- Phone -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="./assets/img/telephone.png" alt="Phone">
                                            </span>
                                        </div>
                                        <input name="phone_number" type="tel" class="form-control" placeholder="Enter Your Mobile No." required>
                                    </div>
                                    @error('phone_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <!-- Email -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="./assets/img/mail.png" alt="Email">
                                            </span>
                                        </div>
                                        <input name="email" type="email" class="form-control" placeholder="Enter Your Email ID" required>
                                    </div>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <!-- Company -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="./assets/img/company.png" alt="Company">
                                            </span>
                                        </div>
                                        <input name="company" type="text" class="form-control" placeholder="Enter Company Name" required>
                                    </div>
                                    @error('company')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <!-- Submit -->
                                    <div class="bex-form-top-btn">
                                        <button type="submit" class="btn btn-outline-secondary btn-outline-secondary-main">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Intro Section -->

    <!-- ======= Why Business-Ex Section ======= -->
    <section class="section-business-ex section-t2 nav-arrow-a">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                            <h2 class="bex-title-a">Why Business-Ex</h2>
                            <h5>Businessex- Exit, Exchange, Excel</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div id="bex-bussiness-carousel" class="owl-carousel owl-arrow card bex-card-margin bex-main-text-aling">
                <div class="carousel-item-a">
                    <div class="business-ex-box">
                        <div class="bex-bussiness-section">
                            <img src="{{ asset('assets/img/business-ex.jpg') }}" alt="Business Ex">
                            <h4>Single Platform For Entire Ecosystem</h4>
                            <p>
                                An online interactive platform connecting Businesses, Startups, Investos, Mentors,
                                Lenders, Incubators and Brokers, across industries and geographies.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item-a">
                    <div class="business-ex-box">
                        <div class="bex-bussiness-section">
                            <img src="{{ asset('assets/img/help-companies-scale-upnew.svg') }}" alt="Business Ex">
                            <h4>Help Companies Scale Up</h4>
                            <p>
                                BusinessEx offers a platform for high-growth potential companies to promote their
                                investment opportunities to investors or to gain expertise from renowned mentors,
                                in a secure environment.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item-a">
                    <div class="business-ex-box">
                        <div class="bex-bussiness-section">
                            <img src="{{ asset('assets/img/a-connected-networknew.svg') }}" alt="Business Ex">
                            <h4>A Connected Network</h4>
                            <p>
                                Provides an opportunity to connect to a broader network to share deals and grow
                                your connections, while keeping your important details confidential.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item-a">
                    <div class="business-ex-box">
                        <div class="bex-bussiness-section">
                            <img src="{{ asset('assets/img/fully-customizable-platformnew.svg') }}" alt="Business Ex">
                            <h4>Put Your Mark On It</h4>
                            <p>
                                Our platform is fully customizable. You decide the information you want to share.
                                Automatically receive recommendations based on your profile and preferences.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item-a">
                    <div class="business-ex-box">
                        <div class="bex-bussiness-section">
                            <img src="{{ asset('assets/img/authentic-communitynew.svg') }}" alt="Business Ex">
                            <h4>Authentic Community</h4>
                            <p>
                                Meet and interact with genuine and interested customers registered with BusinessEx,
                                and deepen relationship.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item-a">
                    <div class="business-ex-box">
                        <div class="bex-bussiness-section">
                            <img src="./assets/img/portfolio-managementnew.svg" alt="">
                            <h4>Portfolio Management Made Easy</h4>
                            <p>
                                Keep track of all your conversations and proposals in one place. Track user
                                preferences (location, industry, investment) and receive curated opportunities.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End business-ex Section -->

    <!-- ======= Business For Sale Opportunities Section ======= -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="font-weight-bold mb-0">Business For Sale Opportunities</h2>
                    <h5 class="text-muted mb-0">
                        BusinessEx offers 1863 businesses in 16 industries as on Jul 27, 2026
                    </h5>
                </div>
                <a href="{{ url('/businesslisting') }}" class="text-success font-weight-bold">View All</a>
            </div>

            <!-- Carousel -->
            <div id="businessSaleCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="row">
                            <!-- Card 1 -->
                            <div class="col-md-3">
                                <div class="card shadow-sm">
                                    <div class="position-relative">
                                        <img src="{{ asset('assets/img/1830542474.jpg') }}" class="card-img-top" alt="Coffee Vending Solutions">
                                        <span class="badge badge-warning position-absolute" style="top:10px;left:10px;">Gold</span>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted mb-1">Food & Beverage / Tea and Coffee</p>
                                        <h6 class="font-weight-bold">Seeking Investment For Coffee Vending Solutions Company Across...</h6>
                                        <p class="mb-1"><strong>Asking Price:</strong> ₹ 6 Crores</p>
                                        <p class="text-muted mb-2">
                                            <i class="fa fa-phone"></i> Phone
                                            <i class="fa fa-envelope"></i> Email
                                            <i class="fa fa-map-marker"></i> Delhi
                                        </p>
                                        <a href="#" class="btn btn-outline-success btn-block">Contact Business</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="col-md-3">
                                <div class="card shadow-sm">
                                    <img src="{{ asset('assets/img/shutterstock_1030032883.jpg') }}" class="card-img-top" alt="Interior Design Company">
                                    <div class="card-body">
                                        <p class="text-muted mb-1">Building Construction & Home Products / Interior Design</p>
                                        <h6 class="font-weight-bold">Interior Design and Architectural Services Company</h6>
                                        <p class="mb-1"><strong>Asking Price:</strong> Undisclosed</p>
                                        <p class="text-muted mb-2">
                                            <i class="fa fa-phone"></i> Phone
                                            <i class="fa fa-envelope"></i> Email
                                            <i class="fa fa-map-marker"></i> New Delhi
                                        </p>
                                        <a href="#" class="btn btn-outline-success btn-block">Contact Business</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="col-md-3">
                                <div class="card shadow-sm">
                                    <div class="position-relative">
                                        <img src="{{ asset('assets/img/shutterstock_531055792.jpg') }}" class="card-img-top" alt="Healthcare Business">
                                        <span class="badge badge-primary position-absolute" style="top:10px;left:10px;">Platinum</span>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted mb-1">FMCG / Medical Products</p>
                                        <h6 class="font-weight-bold">Seeking Investment For Established Healthcare Business</h6>
                                        <p class="mb-1"><strong>Seeking Investment:</strong> ₹ 5 Crores</p>
                                        <p class="text-muted mb-2">
                                            <i class="fa fa-phone"></i> Phone
                                            <i class="fa fa-envelope"></i> Email
                                            <i class="fa fa-map-marker"></i> New Delhi
                                        </p>
                                        <a href="#" class="btn btn-outline-success btn-block">Contact Business</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="col-md-3">
                                <div class="card shadow-sm">
                                    <img src="{{ asset('assets/img/98789996.jpg') }}" class="card-img-top" alt="Gamers Assemble">
                                    <div class="card-body">
                                        <p class="text-muted mb-1">Food & Beverage / Aquaculture</p>
                                        <h6 class="font-weight-bold">Gamers Assemble</h6>
                                        <p class="mb-1"><strong>Seeking Investment:</strong> ₹ 5 Crores</p>
                                        <p class="text-muted mb-2">
                                            <i class="fa fa-phone"></i> Phone
                                            <i class="fa fa-envelope"></i> Email
                                            <i class="fa fa-map-marker"></i> New Delhi
                                        </p>
                                        <a href="#" class="btn btn-outline-success btn-block">Contact Business</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 (duplicate or dynamic data) -->
                    <div class="carousel-item">
                        <div class="row">
                            <!-- Add more cards or loop dynamically -->
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <a class="carousel-control-prev" href="#businessSaleCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#businessSaleCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>
    <!-- End Business For Sale Opportunities Section -->

    <!-- ======= Upcoming & Past Events Section ======= -->
    <section class="section-business-ex section-t2 nav-arrow-a">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                            <h2 class="bex-title-a">Upcoming & Past Events</h2>
                            <h5>Put Some Base Line Here</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div id="bex-upcoming-past-events-carousel" class="owl-carousel owl-arrow bex-card-margin">
                @for($i = 0; $i < 6; $i++)
                    <div class="carousel-item-a">
                        <div class="business-ex-box">
                            <div class="card bex-card-padding-tblr">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <img src="./assets/img/upcomming-events.JPG" alt="">
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="bex-main-info-card">
                                            <p>Learning Series - BEx Scale</p>
                                        </div>
                                        <div class="bex-main-info-card-timing">
                                            <span class="bex-main-info-card-timing-img">
                                                <img src="./assets/img/calendar.svg" alt=""> 11 July
                                            </span>
                                            <span class="bex-main-info-card-timing-img">
                                                <img src="./assets/img/clock.svg" alt=""> 11 July
                                            </span>
                                        </div>
                                        <div class="bex-main-info-summury-main">
                                            <p class="bex-main-info-summury">
                                                In BEx Scale Series, we help in formulating Entrepreneur mindset
                                                strategies that will build excellence in enterprise, leading to
                                                growth and expansion. We shed light upon the commitment and
                                                skillset required.
                                            </p>
                                        </div>
                                        <div class="bex-business-author">
                                            <p class="bex-author-name-info">Gaurav Marya</p>
                                            <p class="bex-author-conpany-info">Chairman, Franchise India Group</p>
                                        </div>
                                        <div class="bex-business-main-btn">
                                            <a href="#">REGISTER NOW</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>
    <!-- End Upcoming & Past Events Section -->

    <!-- ======= Featured Investors Section ======= -->
    <section class="section-business-ex section-t2 nav-arrow-a">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                            <h2 class="bex-title-a">Featured Investors</h2>
                            <h5>Business-Ex Offers 511 Start-Ups In 13 Various Industries</h5>
                            <a href="/investorlisting" class="bex-view-all-section">View All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="bex-featured-investors-carousel" class="owl-carousel owl-arrow bex-card-margin">
                @foreach($featuredInvestors['featuredInvestorsData'] as $investor)
                    <div class="carousel-item-a">
                        <div class="business-ex-box">
                            <div class="bex-bussiness-section card">
                                <div class="bex-features-section-main">
                                    <div id="ribbon-container">
                                        <a href="#" id="ribbon">PLATINUM</a>
                                    </div>
                                    <div class="bex-mentor-section-main">
                                        <div class="row">
                                            <div class="col-sm-8 col-md-8">
                                                <div class="bex-mentor-section-info">
                                                    <h6>{{ $investor['investorName'] }}</h6>
                                                    <p>{{ $investor['companyName'] }}</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <img src="{{ $investor['investorProfPic'] ?? asset('assets/img/mentor.png') }}"
                                                    alt="Investor Profile"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="col-sm-12 col-md-12">
                                                <div class="bex-bussiness-section-info-main">
                                                    <div class="bex-main-info-card-timing">
                                                        <p class="text-muted">
                                                            <i class="fa fa-phone"></i> Phone
                                                            <i class="fa fa-envelope"></i> Email
                                                            <i class="fa fa-map-marker"></i> Location
                                                        </p>
                                                    </div>
                                                    <div class="bex-summary">Summary</div>
                                                    <div class="bex-summary-info">
                                                        {{ $investor['investorSummary'] }}
                                                    </div>
                                                    <p>
                                                        <a href="#">{{ $investor['investorCity'] }}</a>,
                                                        <a href="#">{{ $investor['investorState'] }}</a>
                                                    </p>
                                                    <ul class="bex-service-tags">
                                                        <li>{{ $investor['investorCity'] }}, {{ $investor['investorState'] }}</li>
                                                    </ul>
                                                </div>
                                                <div class="bex-primary-btn">
                                                    <a href="#">Send Proposal</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Featured Investors Section -->

    <!-- ======= Top Franchise Opportunities Section ======= -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="font-weight-bold mb-0">Top Franchise Opportunities</h2>
                <a href="https://www.franchiseindia.com/" target="_blank" class="text-success font-weight-bold">View All</a>
            </div>

            <!-- Carousel -->
            <div id="franchiseCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="row">
                            <!-- Card 1 -->
                            <div class="col-md-3">
                                <div class="card shadow-sm h-100">
                                    <a href="https://www.franchiseindia.com/brands/kathi-junction-foods.6140" target="_blank">
                                        <img src="https://franchiseindia.s3.ap-south-1.amazonaws.com/uploads/franchisor/kathi-junction-foods_1.jpg" class="card-img-top" alt="Kathi Junction">
                                    </a>
                                    <div class="card-body">
                                        <p class="text-muted mb-1">Quick Service Restaurants</p>
                                        <h6 class="font-weight-bold">
                                            <a href="https://www.franchiseindia.com/brands/kathi-junction-foods.6140" target="_blank">Kathi Junction</a>
                                        </h6>
                                        <p><strong>Investment Range:</strong> ₹5 Lakh – 10 Lakh</p>
                                        <p><strong>Space Required:</strong> 100 – 1500 Sq.ft</p>
                                        <p class="text-muted">Delhi, Haryana, Himachal Pradesh, +16 More</p>
                                        <a href="https://www.franchiseindia.com/brands/kathi-junction-foods.6140" target="_blank" class="btn btn-outline-success btn-block">Know More</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="col-md-3">
                                <div class="card shadow-sm h-100">
                                    <a href="https://www.franchiseindia.com/brands/podar-smarter-schools.72358" target="_blank">
                                        <img src="https://franchiseindia.s3.ap-south-1.amazonaws.com/uploads/franchisor/podar-smarter-schools_1.jpg" class="card-img-top" alt="Podar Smarter Schools">
                                    </a>
                                    <div class="card-body">
                                        <p class="text-muted mb-1">Schools</p>
                                        <h6 class="font-weight-bold">
                                            <a href="https://www.franchiseindia.com/brands/podar-smarter-schools.72358" target="_blank">Podar Smarter Schools</a>
                                        </h6>
                                        <p><strong>Investment Range:</strong> 2 Cr – 5 Cr</p>
                                        <p><strong>Space Required:</strong> 65000 – 90000 Sq.ft</p>
                                        <p class="text-muted">Haryana, Rajasthan, Chhattisgarh, +16 More</p>
                                        <a href="https://www.franchiseindia.com/brands/podar-smarter-schools.72358" target="_blank" class="btn btn-outline-success btn-block">Know More</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="col-md-3">
                                <div class="card shadow-sm h-100">
                                    <a href="https://www.franchiseindia.com/brands/Sankalp.12355" target="_blank">
                                        <img src="https://franchiseindia.s3.ap-south-1.amazonaws.com/uploads/franchisor/Sankalp_1.gif" class="card-img-top" alt="Sankalp Group">
                                    </a>
                                    <div class="card-body">
                                        <p class="text-muted mb-1">Fine Dine Restaurants</p>
                                        <h6 class="font-weight-bold">
                                            <a href="https://www.franchiseindia.com/brands/Sankalp.12355" target="_blank">Sankalp Group</a>
                                        </h6>
                                        <p><strong>Investment Range:</strong> 50 Lakh – 1 Cr</p>
                                        <p><strong>Space Required:</strong> 1500 – 2500 Sq.ft</p>
                                        <p class="text-muted">Delhi, Haryana, Himachal Pradesh, Punjab, +11 More</p>
                                        <a href="https://www.franchiseindia.com/brands/Sankalp.12355" target="_blank" class="btn btn-outline-success btn-block">Know More</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="col-md-3">
                                <div class="card shadow-sm h-100">
                                    <a href="https://www.franchiseindia.com/brands/Prestige-Smart-Kitchen.2219" target="_blank">
                                        <img src="https://franchiseindia.s3.ap-south-1.amazonaws.com/uploads/franchisor/Prestige-Smart-Kitchen_1.jpg" class="card-img-top" alt="TTK Prestige">
                                    </a>
                                    <div class="card-body">
                                        <p class="text-muted mb-1">Kitchen</p>
                                        <h6 class="font-weight-bold">
                                            <a href="https://www.franchiseindia.com/brands/Prestige-Smart-Kitchen.2219" target="_blank">TTK Prestige</a>
                                        </h6>
                                        <p><strong>Investment Range:</strong> 20 Lakh – 30 Lakh</p>
                                        <p><strong>Space Required:</strong> 400 – 1000 Sq.ft</p>
                                        <p class="text-muted">Delhi, Haryana, Himachal Pradesh, Jammu & Kashmir, +15 More</p>
                                        <a href="https://www.franchiseindia.com/brands/Prestige-Smart-Kitchen.2219" target="_blank" class="btn btn-outline-success btn-block">Know More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <div class="row">
                            <!-- Add more franchise cards here or loop dynamically -->
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <a class="carousel-control-prev" href="#franchiseCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#franchiseCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>
    <!-- End Top Franchise Opportunities Section -->

    <!-- ======= High Growth Potential Startups Section ======= -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="font-weight-bold mb-0">High Growth Potential Startups</h2>
                    <h5 class="text-muted mb-0">
                        BusinessEx offers 678 startups in 16 industries as on Jul 27, 2026
                    </h5>
                </div>
                <a href="{{ url('/startupslisting') }}" class="text-success font-weight-bold">View All</a>
            </div>

            <!-- Carousel -->
            <div id="startupCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="row">
                            @foreach($highGrowthStartups as $startup)
                                <div class="col-md-3">
                                    <div class="card shadow-sm h-100">
                                        <img src="{{ $startup->images[0]->startup_img_name ?? asset('images/default_startup.jpg') }}"
                                            class="card-img-top"
                                            alt="Commercial Real Estate Rental Solutions">
                                        <div class="card-body">
                                            <p class="text-muted mb-1">{{ $startup->industrySector->category_name }}</p>
                                            <h6 class="font-weight-bold">{{ $startup->advmt_headline }}</h6>
                                            <p><strong>Seeking Investment:</strong> {{ $startup->inventory_value }}</p>
                                            <p class="text-muted">
                                                <i class="fa fa-phone"></i> Phone
                                                <i class="fa fa-envelope"></i> Email
                                                <i class="fa fa-map-marker"></i> Mumbai
                                            </p>
                                            <a href="{{ url('/startup/looking-for-an-investor-for-commercial-real-estate-rental-solutions/jm3ak7') }}"
                                                class="btn btn-outline-success btn-block">Enquire Now</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="carousel-control-prev" href="#startupCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#startupCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End High Growth Potential Startups Section -->

    <!-- ======= World Class Mentors Section ======= -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="font-weight-bold mb-0">World Class Mentors</h2>
                    <h5 class="text-muted mb-0">
                        BusinessEx offers 194 mentors as on Jul 27, 2026
                    </h5>
                </div>
                <a href="{{ url('/mentorlisting') }}" class="text-success font-weight-bold">View All</a>
            </div>

            <!-- Carousel -->
            <div id="mentorCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="row">
                            @foreach($worldClassMentors as $mentor)
                                <div class="col-md-3">
                                    <div class="card shadow-sm h-100 text-center">
                                        <span class="badge badge-primary position-absolute" style="top:10px;left:10px;">Platinum</span>
                                        <img src="{{ $mentor->mentor_profile_pic ?: asset('images/default-mentor.jpg') }}"
                                            class="rounded-circle mx-auto mt-3" width="100"
                                            alt="{{ $mentor->mentor_name }}">
                                        <div class="card-body">
                                            <h6 class="font-weight-bold">{{ $mentor->mentor_name }}</h6>
                                            <p class="text-muted mb-1">{{ $mentor->mentor_adv_headline }}</p>
                                            <p class="text-muted">
                                                <i class="fa fa-phone"></i> Phone
                                                <i class="fa fa-envelope"></i> Email
                                                <i class="fa fa-map-marker"></i> Location
                                            </p>
                                            <p class="small">{{ $mentor->mentor_profile_summary }}</p>
                                            <a href="{{ url('/mentor/moving-your-business-from-good-to-awesome/kyu1as') }}"
                                                class="btn btn-outline-success btn-block">Send Proposal</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <div class="row">
                            <!-- Add more mentor cards here or loop dynamically -->
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <a class="carousel-control-prev" href="#mentorCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#mentorCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>
    <!-- End World Class Mentors Section -->

    <!-- ======= All Popular Business Opportunities Section ======= -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="title-box mb-4">
                <h2 class="font-weight-bold">All Popular Business Opportunities</h2>
            </div>

            <!-- View Opportunities By Industry -->
            <div class="industry-section mb-5">
                <h3 class="h5 font-weight-bold mb-3">View Opportunities By Industry</h3>
                <ul class="list-unstyled d-flex flex-wrap gap-2">
                    @php
                        $groupedIndustries = collect($industrySeller)->groupBy('industry');
                    @endphp
                    @foreach($groupedIndustries as $industryName => $subIndustries)
                        <li>
                            <a href="{{ url('/businesslisting/energy-environment-businesses-for-sale/12/s0/st0') }}"
                                class="industry-btn">{{ $industryName }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- View Opportunities By Location -->
            <div class="industry-section mb-5">
                <h3 class="h5 font-weight-bold mb-3">View Opportunities By Location</h3>
                <ul class="list-unstyled d-flex flex-wrap gap-2">
                    @foreach($locations as $location)
                        <li>
                            <a href="{{ url('/businesslisting/energy-environment-businesses-for-sale/12/s0/st0') }}"
                                class="industry-btn">{{ $location->state }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- View Opportunities By Investment -->
            <div class="industry-section mb-5">
                <h3 class="h5 font-weight-bold mb-3">View Opportunities By Investment</h3>
                <ul class="list-unstyled d-flex flex-wrap gap-2">
                    <li><a href="{{ url('/businesslisting/energy-environment-businesses-for-sale/12/s0/st0') }}" class="industry-btn">₹50K - ₹2Lakh</a></li>
                    <li><a href="{{ url('/businesslisting/business-services-businesses-for-sale/5/s0/st0') }}" class="industry-btn">₹2Lakh - ₹5Lakh</a></li>
                    <li><a href="{{ url('/businesslisting/retail-businesses-for-sale/14/s0/st0') }}" class="industry-btn">₹5Lakh - ₹10Lakh</a></li>
                    <li><a href="{{ url('/businesslisting/finance-businesses-for-sale/11/s0/st0') }}" class="industry-btn">₹10Lakh - ₹20Lakh</a></li>
                    <li><a href="{{ url('/businesslisting/food-beverage-businesses-for-sale/6/s0/st0') }}" class="industry-btn">₹20Lakh - ₹30Lakh</a></li>
                    <li><a href="{{ url('/businesslisting/travel-tourism-businesses-for-sale/9/s0/st0') }}" class="industry-btn">₹30Lakh - ₹50Lakh</a></li>
                    <li><a href="{{ url('/businesslisting/construction-maintenance-businesses-for-sale/10/s0/st0') }}" class="industry-btn">₹50Lakh - ₹1Cr</a></li>
                    <li><a href="{{ url('/businesslisting/automobile-businesses-for-sale/1/s0/st0') }}" class="industry-btn">₹1Cr - ₹2Cr</a></li>
                    <li><a href="{{ url('/businesslisting/fmcg-businesses-for-sale/15/s0/st0') }}" class="industry-btn">₹2Cr - ₹5Cr</a></li>
                    <li><a href="{{ url('/businesslisting/fmcg-businesses-for-sale/15/s0/st0') }}" class="industry-btn">₹5Cr - ₹10Cr</a></li>
                    <li><a href="{{ url('/businesslisting/fmcg-businesses-for-sale/15/s0/st0') }}" class="industry-btn">₹10Cr - ₹20Cr</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End All Popular Business Opportunities Section -->

    <!-- ======= Bx Insights Section ======= -->
    <section id="bx-insight" class="bx-insight section-bg">
        <div class="container-fluid" data-aos="fade-up">
            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-md-12">
                    <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                            <h2 class="bex-title-a">Bx Insights</h2>
                            <a href="/articles" class="bex-view-all-section2">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="News-tab" data-toggle="tab" href="#News"
                                role="tab" aria-controls="News" aria-selected="true">Articles</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <!-- Articles Tab (active) -->
                        <div class="tab-pane fade show active" id="News" role="tabpanel" aria-labelledby="News-tab">
                            <div class="row">
                                @foreach($homepageArticles as $article)
                                    <div class="col-md-3">
                                        <div class="card bex-card-padding-tblr">
                                            <div class="card-box-b card-shadow news-box">
                                                <div class="img-box-b">
                                                    <a href="{{ route('bxinsight.show', $article->article_id) }}">
                                                        <img src="{{ asset($article->image_path) }}" alt="" class="img-b img-fluid">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="bex-card-info-main">
                                                <p class="bex-author-timeline">{{ $article->created_at->format('d M Y') }}</p>
                                                <p>{{ $article->short_desc }}</p>
                                                <p class="bex-author-timeline">{{ $article->author->author_name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Articles Tab (static placeholder) -->
                        <div class="tab-pane fade" id="Articles" role="tabpanel" aria-labelledby="Articles-tab">
                            <div class="row">
                                @for($i = 0; $i < 4; $i++)
                                    <div class="col-md-3">
                                        <div class="card bex-card-padding-tblr">
                                            <div class="card-box-b card-shadow news-box">
                                                <div class="img-box-b">
                                                    <img src="assets/img/post-4.jpg" alt="" class="img-b img-fluid">
                                                </div>
                                            </div>
                                            <div class="bex-card-info-main">
                                                <p class="bex-author-timeline">23 July 2020</p>
                                                <p>
                                                    BusinessEx defines Business Valuation as a process of obtaining a
                                                    fair economic value of a business. This will benefit in figuring out
                                                    sale value, pitching to investors and developing business strategies…
                                                </p>
                                                <p class="bex-author-timeline">By Jaspreet kaur</p>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <!-- Testimonials Tab (static placeholder) -->
                        <div class="tab-pane fade" id="Testimonials" role="tabpanel" aria-labelledby="Testimonials-tab">
                            <div class="row">
                                @for($i = 0; $i < 4; $i++)
                                    <div class="col-md-3">
                                        <div class="card bex-card-padding-tblr">
                                            <div class="card-box-b card-shadow news-box">
                                                <div class="img-box-b">
                                                    <img src="assets/img/post-4.jpg" alt="" class="img-b img-fluid">
                                                </div>
                                            </div>
                                            <div class="bex-card-info-main">
                                                <p class="bex-author-timeline">23 July 2020</p>
                                                <p>
                                                    BusinessEx defines Business Valuation as a process of obtaining a
                                                    fair economic value of a business. This will benefit in figuring out
                                                    sale value, pitching to investors and developing business strategies…
                                                </p>
                                                <p class="bex-author-timeline">By Jaspreet kaur</p>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End bx-insight Section -->

    <!-- ======= Bx Services Section ======= -->
    <section class="section-business-ex section-t2 nav-arrow-a">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                            <h2 class="bex-title-a">Bx Services</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bex-card-margin justify-content-center bex-all-popular-bussiness-main">
                <div class="row">
                    <!-- Service Card 1 -->
                    <div class="col-md-4">
                        <div class="card bex-card-padding-tblr">
                            <div class="card-box-b card-shadow news-box">
                                <div class="img-box-b">
                                    <img src="assets/img/post-4.jpg" alt="" class="img-b img-fluid">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-header-b bse-btn-overlay-w">
                                        <div class="card-title-b">
                                            <a class="btn btn-outline-bse" href="{{ route('service.business-valuation') }}">
                                                + EXPLORE MORE
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bex-card-info-main">
                                <h5>Business Valuation Calculator</h5>
                                <p>
                                    BusinessEx defines Business Valuation as a process of obtaining a fair
                                    economic value of a business. This will benefit in figuring out sale value,
                                    pitching to investors and developing business strategies…
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Service Card 2 -->
                    <div class="col-md-4">
                        <div class="card bex-card-padding-tblr">
                            <div class="card-box-b card-shadow news-box">
                                <div class="img-box-b">
                                    <img src="assets/img/post-4.jpg" alt="" class="img-b img-fluid">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-header-b bse-btn-overlay-w">
                                        <div class="card-title-b">
                                            <a class="btn btn-outline-bse" href="{{ route('service.business-plan') }}">
                                                + EXPLORE MORE
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bex-card-info-main">
                                <h5>Business Plan</h5>
                                <p>
                                    BusinessEx defines Business Valuation as a process of obtaining a fair
                                    economic value of a business. This will benefit in figuring out sale value,
                                    pitching to investors and developing business strategies…
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Service Card 3 -->
                    <div class="col-md-4">
                        <div class="card bex-card-padding-tblr">
                            <div class="card-box-b card-shadow news-box">
                                <div class="img-box-b">
                                    <img src="assets/img/post-4.jpg" alt="" class="img-b img-fluid">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-header-b bse-btn-overlay-w">
                                        <div class="card-title-b">
                                            <a class="btn btn-outline-bse" href="{{ route('service.due-diligence') }}">
                                                + EXPLORE MORE
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bex-card-info-main">
                                <h5>Due Diligence</h5>
                                <p>
                                    Due diligence refers to an investigation of the business to confirm all facts,
                                    or an authentication of the information provided before signing a contract…
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Bx Services Section -->

    <!-- ======= Membership Plans Section ======= -->
    <section class="section-business-ex section-t2 section-b2 nav-arrow-a">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="title-wrap justify-content-between">
                        <div class="title-box">
                            <h1 class="bex-title-a">Membership Plans</h1>
                            <h5>Choose The Right One For You</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bex-card-margin justify-content-center bex-all-popular-bussiness-main">
                <div class="row">
                    <!-- Premium Plan -->
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="bex-card-margin bex-plans-main">
                                <h4>Premium</h4>
                                <p><s>&#8377; 4,999</s></p>
                                <h1>&#8377; 2999</h1>
                                <p>3 months</p>
                            </div>
                            <div class="bex-plans-card-bottom">
                                <p class="bex-most-popular-text">
                                    <b>Reach-out to 50</b><br>
                                    <b>Businesses/Startups/Investors/Mentors Accept Unlimited Investment</b><br>
                                    <b>Proposals from registered users</b><br>
                                    <br>
                                    Unlock 10 Proposals from website visitors
                                </p>
                            </div>
                            <div class="bex-plans-btn">
                                <a class="btn btn-outline-secondary btn-md" href="/pricing?membership=premium">
                                    <i class="fa fa-plus"></i> EXPLORE MORE
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Gold Plan -->
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="bex-most-popular">
                                <span>Most Popular</span>
                            </div>
                            <div class="bex-card-margin bex-plans-main bex-premium-price-main">
                                <h4>Gold</h4>
                                <p><s>&#8377; 7,499</s></p>
                                <h1 class="bex-premium-price">&#8377; 4999</h1>
                                <p>12 months</p>
                            </div>
                            <div class="bex-plans-card-bottom">
                                <p class="bex-most-popular-text">
                                    <b>Reach out to 100</b><br>
                                    <b>Businesses/Startups/Investors/Mentors Accept Unlimited Investment</b><br>
                                    <b>Proposals from registered users</b><br>
                                    <br>
                                    Unlock 20 Proposals from website visitors
                                </p>
                            </div>
                            <div class="bex-plans-btn">
                                <a class="btn btn-light btn-md" href="/pricing?membership=gold">
                                    <i class="fa fa-plus"></i> EXPLORE MORE
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Platinum Plan -->
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="bex-card-margin bex-plans-main">
                                <h4>Platinum</h4>
                                <p><s>&#8377; 15,000</s></p>
                                <h1>&#8377; 7999</h1>
                                <p>12 months</p>
                            </div>
                            <div class="bex-plans-card-bottom">
                                <p class="bex-most-popular-text">
                                    <b>Reach out to unlimited</b><br>
                                    <b>Businesses/Startups/Investors/Mentors Accept Unlimited Investment</b><br>
                                    <b>Proposals from registered users</b><br>
                                    <br>
                                    Unlock Unlimited Proposals from website visitors
                                </p>
                            </div>
                            <div class="bex-plans-btn">
                                <a class="btn btn-outline-secondary btn-md" href="/pricing?membership=platinum">
                                    <i class="fa fa-plus"></i> EXPLORE MORE
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Membership Plans Section -->

    <!-- ======= Did You Find Anything Interested Section ======= -->
    <section class="section-business-ex section-t2 section-b2 nav-arrow-a b-white">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="title-wrap justify-content-between">
                        <div class="title-box">
                            <h1 class="bex-title-a">Did You Find Anything Interested ?</h1>
                            <h5>Why Wait, Create Your Profile Now.</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bex-card-margin justify-content-center bex-all-popular-bussiness-main">
                <div class="row">
                    <div class="col-xl-6 offset-xs-12 offset-md-12 offset-lg-12 offset-xl-3 align-self-center">
                        <form id="profileForm">
                            <div class="input-group">
                                <select class="custom-select" id="profileSelect" aria-label="Select profile type">
                                    <option value="" selected>Select a profile...</option>
                                    <option value="business">Business | Looking To Sell</option>
                                    <option value="startup">Startup | Looking For Funds</option>
                                    <option value="investor">Investor | Looking To Invest/Buy</option>
                                    <option value="mentor">Mentor | Looking To Guide/Coach</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-success-main" type="button" id="createProfileBtn">
                                        CREATE PROFILE
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Did You Find Anything Interested Section -->

    <!-- ======= Testimonials Section ======= -->
    <section class="section-business-ex section-t2 section-b2 nav-arrow-a">
        <div class="container-fluid">
            <div class="title-box text-center mb-4">
                <h2 class="bex-title-a">What Our Clients Say</h2>
            </div>
            <div id="clientssay" class="owl-carousel owl-theme">
                @foreach($testimonials as $testimonial)
                    <div class="item d-flex flex-wrap">
                        <div class="card shadow-sm" style="background:#fff; border-radius:8px; padding:20px;">
                            <div class="card-body">
                                <p class="card-text mb-3" style="font-style: italic; color:#333;">
                                    "{{ $testimonial['text'] }}"
                                </p>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6 class="mb-0" style="font-weight:600;">{{ $testimonial['name'] }}</h6>
                                        <small class="text-muted">{{ $testimonial['designation'] }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Testimonials Section -->

    @include('includes.groupcompany')
    @include('includes.newsletter')
    @include('includes.categorylinkfooter')
</main>

@push('styles')
<style>
    .industry-section {
        background-color: #fff;
        padding: 20px;
    }

    .industry-btn {
        display: inline-block;
        background-color: #fbe6d4; /* soft beige tone */
        color: #000;
        padding: 8px 16px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
        margin: 5px; /* adds space between buttons */
    }

    .industry-btn:hover {
        background-color: #f3d6b8;
        color: #000;
        text-decoration: none;
    }
</style>
@endpush

@push('scripts')
<script>
    // Expose authentication status to JavaScript
    window.isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

    document.addEventListener('DOMContentLoaded', function () {
        const createProfileBtn = document.getElementById('createProfileBtn');
        const profileSelect = document.getElementById('profileSelect');

        if (!createProfileBtn || !profileSelect) {
            return;
        }

        createProfileBtn.addEventListener('click', function () {
            const selected = profileSelect.value;

            if (!window.isLoggedIn) {
                const loginModal = new bootstrap.Modal(document.getElementById('login'));
                loginModal.show();
            } else {
                let url = '/registration/create-startup-profile';

                switch (selected) {
                    case 'startup':
                        url = '/registration/create-startup-profile';
                        break;
                    case 'business':
                        url = '/registration/create-business-profile';
                        break;
                    case 'investor':
                        url = '/registration/create-investor-profile';
                        break;
                    case 'mentor':
                        url = '/registration/create-mentor-profile';
                        break;
                    default:
                        url = '/registration/create-startup-profile';
                }

                window.location.href = url;
            }
        });
    });
</script>
@endpush
@endsection