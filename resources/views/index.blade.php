{{-- resources/views/businessex/index.blade.php --}}
@extends('layouts.app')

@section('content')
      <!-- ======= Search Section ======= -->
      <div class="click-closed"></div>
      <!--/ Form Search Star /-->
      <div class="box-collapse">
         <div class="title-box-d">
            <h3 class="title-d">Search Section</h3>
         </div>
         <span class="close-box-collapse right-boxed ion-ios-close"></span>
         <div class="box-collapse-wrap form">
            <ol class="breadcrumb">
               <li class="breadcrumb-item">
                  <a href="#">Home</a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">
                  Search
               </li>
            </ol>
            <form class="form-a">
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <!-- <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</button> -->
                     <select class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                     </select>
                  </div>
                  <input type="text" class="form-control" aria-label="Text input with dropdown button">
                  <div class="input-group-append">
                     <button class="btn btn-outline-secondary-filter" type="button" type="button" data-toggle="collapse"
                        data-target="#filter" aria-expanded="false" aria-controls="filter"><i class="fa fa-filter"
                        aria-hidden="true"></i><span class="bex-filter">Filters</span></button>
                  </div>
                  <div class="collapse filter-main" id="filter">
                     <div class="card card-body card-mt15">
                        <div class="row">
                           <div class="col-md-4 mb-2">
                              <div class="form-group">
                                 <label for="Industry">Location</label>
                                 <select class="form-control form-control-lg form-control-a" id="Industry">
                                    <option>Location1</option>
                                    <option>Location2</option>
                                    <option>Location3</option>
                                    <option>Location4</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4 mb-2">
                              <div class="form-group">
                                 <label for="Industry">Industry</label>
                                 <select class="form-control form-control-lg form-control-a" id="Industry">
                                    <option>Industry1</option>
                                    <option>Industry2</option>
                                    <option>Industry3</option>
                                    <option>Industry4</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4 mb-2">
                              <div class="form-group">
                                 <label for="bedrooms">Investment Range</label>
                                 <input type="range" class="form-control-range" id="formControlRange" min="2500000" max="2000000000"
                                    value="50" step="5" value="4500000">
                                 <div class="bex-range-here">
                                    <span class="fl">&#8377; 25 Lakhs</span>
                                    <span class="fr">&#8377; 200 Crores</span>
                                 </div>
                              </div>
                              <div class="bex-input-range-output">
                                 <div class="bex-minmax-imput">
                                    <input type="text" class="form-control form-control-lg form-control-a" placeholder="522200">
                                 </div>
                                 <div class="bex-minmax-imput">
                                    <input type="text" class="form-control form-control-lg form-control-a" placeholder="522200">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
            <div class="bex-search-section">
               <span>
               <i class="fa fa-bolt" aria-hidden="true"></i> Trending Searches:
               </span>
               <span>
                  <ul class="bex-trending-search-tab">
                     <li>Hospitality</li>
                     <li>Hotels</li>
                     <li>Management</li>
                     <li>Education</li>
                     <li>Pre-School</li>
                     <li>Restaurants</li>
                     <li>Food Parlor</li>
                  </ul>
               </span>
            </div>
            <section class="section-business-ex section-t2 nav-arrow-a card card-body mt20px">
               <div class="row">
                  <div class="col-md-12">
                     <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                           <h2 class="bex-title-a">Popular Categories</h2>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row fnt-16px">
                  <div class="col-md-3">
                     <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                           <h5 class="bex-title-a">Business</h5>
                           <p class="bex-heading-main">Automobile</p>
                           <ul class="bex-popular-categories">
                              <li>Automobile Maintanance & Repair</li>
                              <li>Automobile Parts</li>
                              <li>Automobile Wash</li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                           <h5 class="bex-title-a">Business</h5>
                           <p class="bex-heading-main">Automobile</p>
                           <ul class="bex-popular-categories">
                              <li>Automobile Maintanance & Repair</li>
                              <li>Automobile Parts</li>
                              <li>Automobile Wash</li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                           <h5 class="bex-title-a">Business</h5>
                           <p class="bex-heading-main">Automobile</p>
                           <ul class="bex-popular-categories">
                              <li>Automobile Maintanance & Repair</li>
                              <li>Automobile Parts</li>
                              <li>Automobile Wash</li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                           <h5 class="bex-title-a">Business</h5>
                           <p class="bex-heading-main">Automobile</p>
                           <ul class="bex-popular-categories">
                              <li>Automobile Maintanance & Repair</li>
                              <li>Automobile Parts</li>
                              <li>Automobile Wash</li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
      <!-- Search Section -->>
      <!-- ======= Header/Navbar ======= -->
      <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
         <div class="container-fluid">
         <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
            aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
         <span></span>
         <span></span>
         <span></span>
         </button>
         <a class="navbar-brand text-brand" href="index.html"><img src="./assets/img/logo.JPG" /></span></a>
         <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none" data-toggle="collapse"
            data-target="#navbarTogglerDemo01" aria-expanded="false">
         <span class="fa fa-search" aria-hidden="true"></span>
         </button>
         <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none" data-toggle="collapse"
            data-target="#navbarTogglerDemo01" aria-expanded="false">
         <span class="fa fa-user" aria-hidden="true"></span>
         </button>
         <div class="navbar-collapse collapse" id="navbarDefault">
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link active" href="index.html">Bx Listings</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#">Bx Insights</a>
               </li>
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false">
                  demo
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                     <a class="dropdown-item" href="#">demo</a>
                     <a class="dropdown-item" href="#">demo</a>
                     <a class="dropdown-item" href="#">demo</a>
                     <a class="dropdown-item" href="#">demo</a>
                  </div>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#">Services</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#">Pricing</a>
               </li>
            </ul>
         </div>
         <div class="btn-group" role="group" aria-label="Basic example"><button type="button"
            class="btn btn-b-n navbar-toggle-box-collapse d-none d-md-block" data-toggle="collapse"
            data-target="#navbarTogglerDemo01" aria-expanded="false">
            <span class="fa fa-search" aria-hidden="true"></span>
            </button>
            <button type="button" class="btn btn-b-n navbar-toggle-box-collapse d-none d-md-block" data-toggle="collapse"
               data-target="#navbarTogglerDemo01" aria-expanded="false">
            <span class="fa fa-user" aria-hidden="true"></span>
            </button>
         </div>
      </nav>
      <!-- End Header/Navbar -->
      <!-- ======= Intro Section ======= -->
      <section id="hero" class=" section-t8 d-flex align-items-center">
         <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <div class="row">
               <div class="col-xl-8 bex-hero-section section-t4">
                  <h1>LEADING <span class="bex-hero-section-hed">BUSINESS</span> EXCHANGE NETWORK</h1>
                  <h2><b>1500+</b> Businesses, <b>1400+</b> Startups, <b>1800+</b> Investors, <b>200+</b> Mentors and <b>50+</b>
                     Incubators are registered in our community so far!
                  </h2>
                  <h3>Why wait, create your profile now</h3>
                  <!-- <a href="#about" class="btn-get-started scrollto">Get Started</a>  -->
                  <div class="row">
                     <div class="col-xl-6 offset-xs-12 offset-md-12 offset-lg-12 offset-xl-3 align-self-center bex-form-control">
                        <form>
                           <div class="input-group input-group-hero-main mb-3">
                              <select id="inputState" class="form-control">
                                <option selected>Select a profile...</option>
                                <option value="1">Business | Looking To Sell</option>
                                <option value="2">Startup | Looking For Funds</option>
                                <option value="3">Investor | Looking To Invest/Buy</option>
                                <option value="4">Mentor | Looking To Guide/Coach </option>
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
                                        <span class="input-group-text" id="basic-addon1"><img src="./assets/img/doc-file.png" /></span>
                                    </div>
                                    <select id="inputState" name="profile" class="form-control" required>
                                        <option selected>Select a profile...</option>
                                        <option value="1">Business | Looking To Sell</option>
                                        <option value="2">Startup | Looking For Funds</option>
                                        <option value="3">Investor | Looking To Invest/Buy</option>
                                        <option value="4">Mentor | Looking To Guide/Coach </option>
                                    </select>
                                </div>
                                @error('profile')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <!-- Name -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><img src="./assets/img/person.png" /></span>
                                    </div>
                                    <input name="name" type="text" class="form-control" placeholder="Enter Your Name" required>
                                </div>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <!-- Phone -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><img src="./assets/img/telephone.png" /></span>
                                    </div>
                                    <input name="phone_number" type="tel" class="form-control" placeholder="Enter Your Mobile No." required>
                                </div>
                                @error('phone_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <!-- Email -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><img src="./assets/img/mail.png" /></span>
                                    </div>
                                    <input name="email" type="email" class="form-control" placeholder="Enter Your Email ID" required>
                                </div>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <!-- Company -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><img src="./assets/img/company.png" /></span>
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
                           <img src="{{ asset('assets/img/business-ex.jpg') }}" alt="Business Ex" />
                           <h4>Single Platform For Entire Ecosystem</h4>
                           <p>An online interactive platform connecting Businesses, Startups, Investos, Mentors, Lenders, Incubators and Brokers, across industries and geographies.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="bex-bussiness-section">
                           <img src="{{ asset('assets/img/help-companies-scale-upnew.svg') }}" alt="Business Ex" />
                           <h4>Help Companies Scale Up</h4>
                           <p>BusinessEx offers a platform for high-growth potential companies to promote their investment opportunities to investors or to gain expertise from renowned mentors, in a secure environment</p>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="bex-bussiness-section">
                           <img src="{{ asset('assets/img/a-connected-networknew.svg') }}" alt="Business Ex" />
                           <h4>A Connected Network</h4>
                           <p>Provides an opportunity to connect to a broader network to share deals and grow your connections, while keeping your important details confidential.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="bex-bussiness-section">
                           <img src="{{ asset('assets/img/fully-customizable-platformnew.svg') }}" alt="Business Ex" />
                           <h4>Put Your Mark On It</h4>
                           <p>Our platform is fully customizable. You decide the information you want to share. Automatically receive recommendations based on your profile and preferences.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="bex-bussiness-section">
                           <img src="{{ asset('assets/img/authentic-communitynew.svg') }}" alt="Business Ex" />
                           <h4>Authentic Community</h4>
                           <p>Meet and interact with genuine and interested customers registered with BusinessEx, and deepen relationship</p>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="bex-bussiness-section">
                           <img src="./assets/img/portfolio-managementnew.svg" alt="" />
                           <h4>Portfolio Management Made Easy</h4>
                           <p>Keep track of all your conversations and proposals in one place. Track user preferences (location, industry, investment) and receive curated opportunities.
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- End business-ex Section -->


         <!-- Business For Sale Opportunities Section -->
<!-- Business For Sale Opportunities Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="font-weight-bold mb-0">Business For Sale Opportunities</h2>
                <h5 class="text-muted mb-0">
                    BusinessEx offers 1863 businesses in 16 industries as on Jul 27, 2026
                </h5>
            </div>
            <a href="{{ url('/businesslisting') }}" class="text-success font-weight-bold">View All</a>
        </div>

        <!-- Carousel -->
        <div id="businessSaleCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner">

                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="row">
                        <!-- Card 1 -->
                        <div class="col-md-3">
                            <div class="card shadow-sm">
                                <div class="position-relative">
                                    <img src="{{ asset('assets/img/1830542474.jpg') }}" class="card-img-top" alt="Coffee Vending Solutions">
                                    <span class="badge badge-warning position-absolute" style="top:10px;left:10px;">Gold</span>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted mb-1">Food & Beverage / Tea and Coffee</p>
                                    <h6 class="font-weight-bold">Seeking Investment For Coffee Vending Solutions Company Across...</h6>
                                    <p class="mb-1"><strong>Asking Price:</strong> ₹ 6 Crores</p>
                                    <p class="text-muted mb-2"><i class="fa fa-phone"></i> Phone  <i class="fa fa-envelope"></i> Email  <i class="fa fa-map-marker"></i> Delhi</p>
                                    <a href="#" class="btn btn-outline-success btn-block">Contact Business</a>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-md-3">
                            <div class="card shadow-sm">
                                <img src="{{ asset('assets/img/shutterstock_1030032883.jpg') }}" class="card-img-top" alt="Interior Design Company">
                                <div class="card-body">
                                    <p class="text-muted mb-1">Building Construction & Home Products / Interior Design</p>
                                    <h6 class="font-weight-bold">Interior Design and Architectural Services Company</h6>
                                    <p class="mb-1"><strong>Asking Price:</strong> Undisclosed</p>
                                    <p class="text-muted mb-2"><i class="fa fa-phone"></i> Phone  <i class="fa fa-envelope"></i> Email  <i class="fa fa-map-marker"></i> New Delhi</p>
                                    <a href="#" class="btn btn-outline-success btn-block">Contact Business</a>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="col-md-3">
                            <div class="card shadow-sm">
                                <div class="position-relative">
                                    <img src="{{ asset('assets/img/shutterstock_531055792.jpg') }}" class="card-img-top" alt="Healthcare Business">
                                    <span class="badge badge-primary position-absolute" style="top:10px;left:10px;">Platinum</span>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted mb-1">FMCG / Medical Products</p>
                                    <h6 class="font-weight-bold">Seeking Investment For Established Healthcare Business</h6>
                                    <p class="mb-1"><strong>Seeking Investment:</strong> ₹ 5 Crores</p>
                                    <p class="text-muted mb-2"><i class="fa fa-phone"></i> Phone  <i class="fa fa-envelope"></i> Email  <i class="fa fa-map-marker"></i> New Delhi</p>
                                    <a href="#" class="btn btn-outline-success btn-block">Contact Business</a>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="col-md-3">
                            <div class="card shadow-sm">
                                <img src="{{ asset('assets/img/98789996.jpg') }}" class="card-img-top" alt="Gamers Assemble">
                                <div class="card-body">
                                    <p class="text-muted mb-1">Food & Beverage / Aquaculture</p>
                                    <h6 class="font-weight-bold">Gamers Assemble</h6>
                                    <p class="mb-1"><strong>Seeking Investment:</strong> ₹ 5 Crores</p>
                                    <p class="text-muted mb-2"><i class="fa fa-phone"></i> Phone  <i class="fa fa-envelope"></i> Email  <i class="fa fa-map-marker"></i> New Delhi</p>
                                    <a href="#" class="btn btn-outline-success btn-block">Contact Business</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 (duplicate or dynamic data) -->
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
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="card bex-card-padding-tblr">
                           <div class="row">
                              <div class="col-sm-6 col-md-6">
                                 <img src="./assets/img/upcomming-events.JPG" alt="" />
                              </div>
                              <div class="col-sm-6 col-md-6">
                                 <div class="bex-main-info-card">
                                    <p>Learning Series - BEx Scale</p>
                                 </div>
                                 <div class="bex-main-info-card-timing">
                                    <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg" /> 11
                                    July</span>
                                    <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg" /> 11
                                    July</span>
                                 </div>
                                 <div class="bex-main-info-summury-main">
                                    <p class="bex-main-info-summury">In BEx Scale Series, we help in formulating
                                       Entrepreneur mindset strategies that will build
                                       excellence in enterprise, leading to growth and
                                       expansion. We shed light upon the commitment and
                                       skillset required
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
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="card bex-card-padding-tblr">
                           <div class="row">
                              <div class="col-sm-6 col-md-6">
                                 <img src="./assets/img/upcomming-events.JPG" alt="" />
                              </div>
                              <div class="col-sm-6 col-md-6">
                                 <div class="bex-main-info-card">
                                    <p>Learning Series - BEx Scale</p>
                                 </div>
                                 <div class="bex-main-info-card-timing">
                                    <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg" /> 11
                                    July</span>
                                    <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg" /> 11
                                    July</span>
                                 </div>
                                 <div class="bex-main-info-summury-main">
                                    <p class="bex-main-info-summury">In BEx Scale Series, we help in formulating
                                       Entrepreneur mindset strategies that will build
                                       excellence in enterprise, leading to growth and
                                       expansion. We shed light upon the commitment and
                                       skillset required
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
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="card bex-card-padding-tblr">
                           <div class="row">
                              <div class="col-sm-6 col-md-6">
                                 <img src="./assets/img/upcomming-events.JPG" alt="" />
                              </div>
                              <div class="col-sm-6 col-md-6">
                                 <div class="bex-main-info-card">
                                    <p>Learning Series - BEx Scale</p>
                                 </div>
                                 <div class="bex-main-info-card-timing">
                                    <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg" /> 11
                                    July</span>
                                    <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg" /> 11
                                    July</span>
                                 </div>
                                 <div class="bex-main-info-summury-main">
                                    <p class="bex-main-info-summury">In BEx Scale Series, we help in formulating
                                       Entrepreneur mindset strategies that will build
                                       excellence in enterprise, leading to growth and
                                       expansion. We shed light upon the commitment and
                                       skillset required
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
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="card bex-card-padding-tblr">
                           <div class="row">
                              <div class="col-sm-6 col-md-6">
                                 <img src="./assets/img/upcomming-events.JPG" alt="" />
                              </div>
                              <div class="col-sm-6 col-md-6">
                                 <div class="bex-main-info-card">
                                    <p>Learning Series - BEx Scale</p>
                                 </div>
                                 <div class="bex-main-info-card-timing">
                                    <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg" /> 11
                                    July</span>
                                    <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg" /> 11
                                    July</span>
                                 </div>
                                 <div class="bex-main-info-summury-main">
                                    <p class="bex-main-info-summury">In BEx Scale Series, we help in formulating
                                       Entrepreneur mindset strategies that will build
                                       excellence in enterprise, leading to growth and
                                       expansion. We shed light upon the commitment and
                                       skillset required
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
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="card bex-card-padding-tblr">
                           <div class="row">
                              <div class="col-sm-6 col-md-6">
                                 <img src="./assets/img/upcomming-events.JPG" alt="" />
                              </div>
                              <div class="col-sm-6 col-md-6">
                                 <div class="bex-main-info-card">
                                    <p>Learning Series - BEx Scale</p>
                                 </div>
                                 <div class="bex-main-info-card-timing">
                                    <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg" /> 11
                                    July</span>
                                    <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg" /> 11
                                    July</span>
                                 </div>
                                 <div class="bex-main-info-summury-main">
                                    <p class="bex-main-info-summury">In BEx Scale Series, we help in formulating
                                       Entrepreneur mindset strategies that will build
                                       excellence in enterprise, leading to growth and
                                       expansion. We shed light upon the commitment and
                                       skillset required
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
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="card bex-card-padding-tblr">
                           <div class="row">
                              <div class="col-sm-6 col-md-6">
                                 <img src="./assets/img/upcomming-events.JPG" alt="" />
                              </div>
                              <div class="col-sm-6 col-md-6">
                                 <div class="bex-main-info-card">
                                    <p>Learning Series - BEx Scale</p>
                                 </div>
                                 <div class="bex-main-info-card-timing">
                                    <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg" /> 11
                                    July</span>
                                    <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg" /> 11
                                    July</span>
                                 </div>
                                 <div class="bex-main-info-summury-main">
                                    <p class="bex-main-info-summury">In BEx Scale Series, we help in formulating
                                       Entrepreneur mindset strategies that will build
                                       excellence in enterprise, leading to growth and
                                       expansion. We shed light upon the commitment and
                                       skillset required
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
               </div>
            </div>
         </section>
         <!-- ======= Upcoming & Past Events Section ======= -->

         <!-- ======= Featured Investors Section ======= -->
         <section class="section-business-ex section-t2 nav-arrow-a">
            <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="title-wrap d-flex justify-content-between">
                     <div class="title-box">
                        <h2 class="bex-title-a">Featured Investors</h2>
                        <h5>Business-Ex Offers 511 Start-Ups In 13 Various Industries</h5>
                        <a href="#" class="bex-view-all-section">View All</a>
                     </div>
                  </div>
               </div>
            </div>
            <div id="bex-featured-investors-carousel" class="owl-carousel owl-arrow bex-card-margin">
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
                                       <h6>Anand Naresh Motwani</h6>
                                       <p>Business Coach, Expandus Business Coaching Pvt. Ltd.</p>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-4">
                                    <img src="./assets/img/mentor.png" alt="..." class="rounded-circle">
                                 </div>
                                 <div class="col-sm-12 col-md-12">
                                    <div class="bex-bussiness-section-info-main">
                                       <div class="bex-main-info-card-timing">
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                       </div>
                                       <div class="bex-summary">Summary</div>
                                       <div class="bex-summary-info">Over 40 years of experience in Electrical Manufacturing
                                          industry.
                                       </div>
                                       <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                                       <ul class="bex-service-tags">
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
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
                                       <h6>Anand Naresh Motwani</h6>
                                       <p>Business Coach, Expandus Business Coaching Pvt. Ltd.</p>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-4">
                                    <img src="./assets/img/mentor.png" alt="..." class="rounded-circle">
                                 </div>
                                 <div class="col-sm-12 col-md-12">
                                    <div class="bex-bussiness-section-info-main">
                                       <div class="bex-main-info-card-timing">
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                       </div>
                                       <div class="bex-summary">Summary</div>
                                       <div class="bex-summary-info">Over 40 years of experience in Electrical Manufacturing
                                          industry.
                                       </div>
                                       <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                                       <ul class="bex-service-tags">
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
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
                                       <h6>Anand Naresh Motwani</h6>
                                       <p>Business Coach, Expandus Business Coaching Pvt. Ltd.</p>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-4">
                                    <img src="./assets/img/mentor.png" alt="..." class="rounded-circle">
                                 </div>
                                 <div class="col-sm-12 col-md-12">
                                    <div class="bex-bussiness-section-info-main">
                                       <div class="bex-main-info-card-timing">
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                       </div>
                                       <div class="bex-summary">Summary</div>
                                       <div class="bex-summary-info">Over 40 years of experience in Electrical Manufacturing
                                          industry.
                                       </div>
                                       <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                                       <ul class="bex-service-tags">
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
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
                                       <h6>Anand Naresh Motwani</h6>
                                       <p>Business Coach, Expandus Business Coaching Pvt. Ltd.</p>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-4">
                                    <img src="./assets/img/mentor.png" alt="..." class="rounded-circle">
                                 </div>
                                 <div class="col-sm-12 col-md-12">
                                    <div class="bex-bussiness-section-info-main">
                                       <div class="bex-main-info-card-timing">
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                       </div>
                                       <div class="bex-summary">Summary</div>
                                       <div class="bex-summary-info">Over 40 years of experience in Electrical Manufacturing
                                          industry.
                                       </div>
                                       <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                                       <ul class="bex-service-tags">
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
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
                                       <h6>Anand Naresh Motwani</h6>
                                       <p>Business Coach, Expandus Business Coaching Pvt. Ltd.</p>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-4">
                                    <img src="./assets/img/mentor.png" alt="..." class="rounded-circle">
                                 </div>
                                 <div class="col-sm-12 col-md-12">
                                    <div class="bex-bussiness-section-info-main">
                                       <div class="bex-main-info-card-timing">
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                       </div>
                                       <div class="bex-summary">Summary</div>
                                       <div class="bex-summary-info">Over 40 years of experience in Electrical Manufacturing
                                          industry.
                                       </div>
                                       <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                                       <ul class="bex-service-tags">
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
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
                                       <h6>Anand Naresh Motwani</h6>
                                       <p>Business Coach, Expandus Business Coaching Pvt. Ltd.</p>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-4">
                                    <img src="./assets/img/mentor.png" alt="..." class="rounded-circle">
                                 </div>
                                 <div class="col-sm-12 col-md-12">
                                    <div class="bex-bussiness-section-info-main">
                                       <div class="bex-main-info-card-timing">
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                       </div>
                                       <div class="bex-summary">Summary</div>
                                       <div class="bex-summary-info">Over 40 years of experience in Electrical Manufacturing
                                          industry.
                                       </div>
                                       <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                                       <ul class="bex-service-tags">
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
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
                                       <h6>Anand Naresh Motwani</h6>
                                       <p>Business Coach, Expandus Business Coaching Pvt. Ltd.</p>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-4">
                                    <img src="./assets/img/mentor.png" alt="..." class="rounded-circle">
                                 </div>
                                 <div class="col-sm-12 col-md-12">
                                    <div class="bex-bussiness-section-info-main">
                                       <div class="bex-main-info-card-timing">
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                       </div>
                                       <div class="bex-summary">Summary</div>
                                       <div class="bex-summary-info">Over 40 years of experience in Electrical Manufacturing
                                          industry.
                                       </div>
                                       <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                                       <ul class="bex-service-tags">
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
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
                                       <h6>Anand Naresh Motwani</h6>
                                       <p>Business Coach, Expandus Business Coaching Pvt. Ltd.</p>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-4">
                                    <img src="./assets/img/mentor.png" alt="..." class="rounded-circle">
                                 </div>
                                 <div class="col-sm-12 col-md-12">
                                    <div class="bex-bussiness-section-info-main">
                                       <div class="bex-main-info-card-timing">
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                       </div>
                                       <div class="bex-summary">Summary</div>
                                       <div class="bex-summary-info">Over 40 years of experience in Electrical Manufacturing
                                          industry.
                                       </div>
                                       <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                                       <ul class="bex-service-tags">
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
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
                                       <h6>Anand Naresh Motwani</h6>
                                       <p>Business Coach, Expandus Business Coaching Pvt. Ltd.</p>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-4">
                                    <img src="./assets/img/mentor.png" alt="..." class="rounded-circle">
                                 </div>
                                 <div class="col-sm-12 col-md-12">
                                    <div class="bex-bussiness-section-info-main">
                                       <div class="bex-main-info-card-timing">
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                       </div>
                                       <div class="bex-summary">Summary</div>
                                       <div class="bex-summary-info">Over 40 years of experience in Electrical Manufacturing
                                          industry.
                                       </div>
                                       <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                                       <ul class="bex-service-tags">
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
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
            </div>
         </section>
         <!-- ======= End Featured Investors Section ======= -->


         <!-- Top Franchise Opportunities Section -->
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


<!-- High Growth Potential Startups Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="font-weight-bold mb-0">High Growth Potential Startups</h2>
                <h5 class="text-muted mb-0">
                    BusinessEx offers 678 startups in 16 industries as on Jul 27, 2026
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
                        <!-- Card 1 -->
                        <div class="col-md-3">
                            <div class="card shadow-sm h-100">
                                <img src="https://media.businessex.com/business/pics/0127/1536978455.jpg" class="card-img-top" alt="Commercial Real Estate Rental Solutions">
                                <div class="card-body">
                                    <p class="text-muted mb-1">Business services / Financial services</p>
                                    <h6 class="font-weight-bold">Looking For An Investor For Commercial Real Estate Rental Solutions</h6>
                                    <p><strong>Seeking Investment:</strong> ₹7.5 Crores</p>
                                    <p class="text-muted"><i class="fa fa-phone"></i> Phone <i class="fa fa-envelope"></i> Email <i class="fa fa-map-marker"></i> Mumbai</p>
                                    <a href="{{ url('/startup/looking-for-an-investor-for-commercial-real-estate-rental-solutions/jm3ak7') }}" class="btn btn-outline-success btn-block">Enquire Now</a>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-md-3">
                            <div class="card shadow-sm h-100">
                                <img src="https://media.businessex.com/subCatImages/29/360_x_202/shutterstock_401309230.jpg" class="card-img-top" alt="Healthcare Industry">
                                <div class="card-body">
                                    <p class="text-muted mb-1">FMCG / Healthcare products</p>
                                    <h6 class="font-weight-bold">Looking For An Investor For Health Care Industry</h6>
                                    <p><strong>Seeking Investment:</strong> ₹20 Lakhs</p>
                                    <p class="text-muted"><i class="fa fa-phone"></i> Phone <i class="fa fa-envelope"></i> Email <i class="fa fa-map-marker"></i> Hyderabad</p>
                                    <a href="{{ url('/startup/looking-for-an-investor-for-health-care-industry/sibsjr') }}" class="btn btn-outline-success btn-block">Enquire Now</a>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="col-md-3">
                            <div class="card shadow-sm h-100">
                                <img src="https://media.businessex.com/subCatImages/170/360_x_202/shutterstock_559856737.jpg" class="card-img-top" alt="E Sports Arena">
                                <div class="card-body">
                                    <p class="text-muted mb-1">Leisure & Entertainment / Entertainment centres</p>
                                    <h6 class="font-weight-bold">E Sports Arena starting from ₹70 Per person</h6>
                                    <p><strong>Asking Price:</strong> ₹25 Crores</p>
                                    <p class="text-muted"><i class="fa fa-phone"></i> Phone <i class="fa fa-envelope"></i> Email <i class="fa fa-map-marker"></i> Delhi</p>
                                    <a href="{{ url('/startup/e-sports-arena-starting-from-70-per-person/fyrgy5') }}" class="btn btn-outline-success btn-block">Enquire Now</a>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="col-md-3">
                            <div class="card shadow-sm h-100">
                                <img src="https://media.businessex.com/business/pics/0204/49626903.jpg" class="card-img-top" alt="Cloud Kitchen">
                                <div class="card-body">
                                    <p class="text-muted mb-1">FMCG / Food & Beverage products</p>
                                    <h6 class="font-weight-bold">Looking For An Investor For Cloud Kitchen</h6>
                                    <p><strong>Seeking Investment:</strong> ₹1 Crore</p>
                                    <p class="text-muted"><i class="fa fa-phone"></i> Phone <i class="fa fa-envelope"></i> Email <i class="fa fa-map-marker"></i> Navi Mumbai</p>
                                    <a href="{{ url('/startup/looking-for-an-investor-for-cloud-kitchen/spjweq') }}" class="btn btn-outline-success btn-block">Enquire Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="row">
                        <!-- Add more startup cards here or loop dynamically -->
                    </div>
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
</section>

<!-- World Class Mentors Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="font-weight-bold mb-0">World Class Mentors</h2>
                <h5 class="text-muted mb-0">
                    BusinessEx offers 194 mentors as on Jul 27, 2026
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
                        <!-- Mentor Card 1 -->
                        <div class="col-md-3">
                            <div class="card shadow-sm h-100 text-center">
                                <span class="badge badge-primary position-absolute" style="top:10px;left:10px;">Platinum</span>
                                <img src="https://media.businessex.com/mentor/profile/202412/5772_1733199695.png" class="rounded-circle mx-auto mt-3" width="100" alt="Manish Jain">
                                <div class="card-body">
                                    <h6 class="font-weight-bold">Manish Jain</h6>
                                    <p class="text-muted mb-1">ActionCOACH, ICF-ACC...</p>
                                    <p class="text-muted"><i class="fa fa-phone"></i> Phone <i class="fa fa-envelope"></i> Email <i class="fa fa-map-marker"></i> Location</p>
                                    <p class="small">35+ years of international experience, helping clients worldwide...</p>
                                    <a href="{{ url('/mentor/moving-your-business-from-good-to-awesome/kyu1as') }}" class="btn btn-outline-success btn-block">Send Proposal</a>
                                </div>
                            </div>
                        </div>

                        <!-- Mentor Card 2 -->
                        <div class="col-md-3">
                            <div class="card shadow-sm h-100 text-center">
                                <span class="badge badge-warning position-absolute" style="top:10px;left:10px;">Gold</span>
                                <img src="https://media.businessex.com/mentor/profile/202303/84364_1679389330.JPG" class="rounded-circle mx-auto mt-3" width="100" alt="Vinayak Gaonkar">
                                <div class="card-body">
                                    <h6 class="font-weight-bold">Vinayak Gaonkar</h6>
                                    <p class="text-muted mb-1">Vinayak Gaonkar & Co.</p>
                                    <p class="text-muted"><i class="fa fa-phone"></i> Phone <i class="fa fa-envelope"></i> Email <i class="fa fa-map-marker"></i> Thane</p>
                                    <p class="small">House of professionals like Chartered Accountants...</p>
                                    <a href="{{ url('/mentor/business-growth-partner/8mp9zg') }}" class="btn btn-outline-success btn-block">Send Proposal</a>
                                </div>
                            </div>
                        </div>

                        <!-- Mentor Card 3 -->
                        <div class="col-md-3">
                            <div class="card shadow-sm h-100 text-center">
                                <img src="{{ asset('assets/images/profile-dflt.jpg') }}" class="rounded-circle mx-auto mt-3" width="100" alt="Vikram Maini">
                                <div class="card-body">
                                    <h6 class="font-weight-bold">Vikram Maini</h6>
                                    <p class="text-muted mb-1">Silver Oak Hospitality...</p>
                                    <p class="text-muted"><i class="fa fa-phone"></i> Phone <i class="fa fa-envelope"></i> Email <i class="fa fa-map-marker"></i> Mumbai</p>
                                    <p class="small">Experienced hospitality professional...</p>
                                    <a href="{{ url('/mentor/i-am-a-corporate-professional-having-16-years-of-experience-in-different-business-sectors/zgw8sj') }}" class="btn btn-outline-success btn-block">Send Proposal</a>
                                </div>
                            </div>
                        </div>

                        <!-- Mentor Card 4 -->
                        <div class="col-md-3">
                            <div class="card shadow-sm h-100 text-center">
                                <img src="{{ asset('assets/images/profile-dflt.jpg') }}" class="rounded-circle mx-auto mt-3" width="100" alt="SaiKalyan Chakravarthy">
                                <div class="card-body">
                                    <h6 class="font-weight-bold">SaiKalyan Chakravarthy</h6>
                                    <p class="text-muted mb-1">Filesie Systems (India)...</p>
                                    <p class="text-muted"><i class="fa fa-phone"></i> Phone <i class="fa fa-envelope"></i> Email <i class="fa fa-map-marker"></i> Hyderabad</p>
                                    <p class="small">15 years of experience guiding startups...</p>
                                    <a href="{{ url('/mentor/i-am-a-corporate-professional-in-sales-and-marketing-any-startups-or-smes-can-contact-for-guidance/klputt') }}" class="btn btn-outline-success btn-block">Send Proposal</a>
                                </div>
                            </div>
                        </div>
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


<!-- All Popular Business Opportunities Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="title-box mb-4">
            <h2 class="font-weight-bold">All Popular Business Opportunities</h2>
        </div>

        <!-- View Opportunities By Industry -->
        <div class="mb-5">
            <h3 class="h5 font-weight-bold mb-3">View Opportunities By Industry</h3>
            <ul class="list-unstyled row">
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/food-beverage-businesses-for-sale/6/s0/st0') }}">Food & Beverage</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/industrial-machinery-manufacturing-businesses-for-sale/13/s0/st0') }}">Machinery & Manufacturing</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/energy-environment-businesses-for-sale/12/s0/st0') }}">Energy & Environment</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/education-businesses-for-sale/3/s0/st0') }}">Education</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/beauty-health-wellness-businesses-for-sale/4/s0/st0') }}">Beauty, Health & Wellness</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/automobile-businesses-for-sale/1/s0/st0') }}">Automobile</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/finance-businesses-for-sale/11/s0/st0') }}">Finance</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/business-services-businesses-for-sale/5/s0/st0') }}">Business Services</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/retail-businesses-for-sale/14/s0/st0') }}">Retail</a></li>
            </ul>
        </div>

        <!-- View Opportunities By Location -->
        <div class="mb-5">
            <h3 class="h5 font-weight-bold mb-3">View Opportunities By Location</h3>
            <ul class="list-unstyled row">
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting') }}">All India (1500+)</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/businesses-for-sale-in-delhi/c0/s0/DL') }}">Delhi (150+)</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/businesses-for-sale-in-maharashtra/c0/s0/MH') }}">Maharashtra (200+)</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/businesses-for-sale-in-karnataka/c0/s0/KA') }}">Karnataka (190+)</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/businesses-for-sale-in-tamil-nadu/c0/s0/TN') }}">Tamil Nadu (100+)</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/businesses-for-sale-in-uttar-pradesh/c0/s0/UP') }}">Uttar Pradesh (80+)</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/businesses-for-sale-in-haryana/c0/s0/HR') }}">Haryana (80+)</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/businesses-for-sale-in-west-bengal/c0/s0/WB') }}">West Bengal (20+)</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/businesses-for-sale-in-rajasthan/c0/s0/RJ') }}">Rajasthan (20+)</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/businesses-for-sale-in-kerala/c0/s0/KL') }}">Kerala (15+)</a></li>
                <!-- Add more states as needed -->
            </ul>
        </div>

        <!-- View Opportunities By Investment -->
        <div>
            <h3 class="h5 font-weight-bold mb-3">View Opportunities By Investment</h3>
            <ul class="list-unstyled row">
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/business-opportunities/business-under-50k-2lakh') }}">₹50K – ₹2 Lakh</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/business-opportunities/business-under-2lakh-5lakh') }}">₹2 Lakh – ₹5 Lakh</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/business-opportunities/business-under-5lakh-10lakh') }}">₹5 Lakh – ₹10 Lakh</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/business-opportunities/business-under-10lakh-20lakh') }}">₹10 Lakh – ₹20 Lakh</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/business-opportunities/business-under-20lakh-30lakh') }}">₹20 Lakh – ₹30 Lakh</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/business-opportunities/business-under-30lakh-50lakh') }}">₹30 Lakh – ₹50 Lakh</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/business-opportunities/business-under-50lakh-1cr') }}">₹50 Lakh – ₹1 Cr</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/business-opportunities/business-under-1cr-2cr') }}">₹1 Cr – ₹2 Cr</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/business-opportunities/business-under-2cr-5cr') }}">₹2 Cr – ₹5 Cr</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/business-opportunities/business-under-5cr-10cr') }}">₹5 Cr – ₹10 Cr</a></li>
                <li class="col-md-3 mb-2"><a href="{{ url('/businesslisting/business-opportunities/business-under-10cr-20cr') }}">₹10 Cr – ₹20 Cr</a></li>
            </ul>
        </div>
    </div>
</section>




         <!-- ======= Featured Start-Ups Section ======= -->
         <section class="section-business-ex section-t2 nav-arrow-a">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-md-12">
                     <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                           <h2 class="bex-title-a">Featured Start-Ups</h2>
                           <h5>Business-Ex Offers 511 Start-Ups In 13 Various Industries</h5>
                           <a href="#" class="bex-view-all-section">View All</a>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="bex-Featured-Start-Ups-carousel" class="owl-carousel owl-arrow bex-card-margin">
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="bex-bussiness-section card">
                           <div class="bex-features-section-main">
                              <div id="ribbon-container">
                                 <a href="#" id="ribbon">PLATINUM</a>
                              </div>
                              <img src="./assets/img/bex-main-why.jpg" alt="" />
                           </div>
                           <div class="bex-bussiness-section-info">
                              <p>Food Parlors</p>
                              <h6>Established & Renowned Milkshake Franchise for Sale</h6>
                           </div>
                           <div class="bex-bussiness-section-info-main">
                              <div class="bex-main-info-card-timing">
                                 <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                 July</span>
                                 <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                 July</span>
                              </div>
                              <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                              <ul class="bex-service-tags">
                                 <li>Hospitality</li>
                                 <li>Hospitality</li>
                                 <li>Hospitality</li>
                              </ul>
                           </div>
                           <div class="bex-primary-btn">
                              <a href="#">ENQUIRE NOW</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="bex-bussiness-section card">
                           <div class="bex-features-section-main">
                              <div id="ribbon-container">
                                 <a href="#" id="ribbon">PLATINUM</a>
                              </div>
                              <img src="./assets/img/bex-main-why.jpg" alt="" />
                           </div>
                           <div class="bex-bussiness-section-info">
                              <p>Food Parlors</p>
                              <h6>Established & Renowned Milkshake Franchise for Sale</h6>
                           </div>
                           <div class="bex-bussiness-section-info-main">
                              <div class="bex-main-info-card-timing">
                                 <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                 July</span>
                                 <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                 July</span>
                              </div>
                              <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                              <ul class="bex-service-tags">
                                 <li>Hospitality</li>
                                 <li>Hospitality</li>
                                 <li>Hospitality</li>
                              </ul>
                           </div>
                           <div class="bex-primary-btn">
                              <a href="#">ENQUIRE NOW</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="bex-bussiness-section card">
                           <div class="bex-features-section-main">
                              <div id="ribbon-container">
                                 <a href="#" id="ribbon">PLATINUM</a>
                              </div>
                              <img src="./assets/img/bex-main-why.jpg" alt="" />
                           </div>
                           <div class="bex-bussiness-section-info">
                              <p>Food Parlors</p>
                              <h6>Established & Renowned Milkshake Franchise for Sale</h6>
                           </div>
                           <div class="bex-bussiness-section-info-main">
                              <div class="bex-main-info-card-timing">
                                 <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                 July</span>
                                 <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                 July</span>
                              </div>
                              <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                              <ul class="bex-service-tags">
                                 <li>Hospitality</li>
                                 <li>Hospitality</li>
                                 <li>Hospitality</li>
                              </ul>
                           </div>
                           <div class="bex-primary-btn">
                              <a href="#">ENQUIRE NOW</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="bex-bussiness-section card">
                           <div class="bex-features-section-main">
                              <div id="ribbon-container">
                                 <a href="#" id="ribbon">PLATINUM</a>
                              </div>
                              <img src="./assets/img/bex-main-why.jpg" alt="" />
                           </div>
                           <div class="bex-bussiness-section-info">
                              <p>Food Parlors</p>
                              <h6>Established & Renowned Milkshake Franchise for Sale</h6>
                           </div>
                           <div class="bex-bussiness-section-info-main">
                              <div class="bex-main-info-card-timing">
                                 <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                 July</span>
                                 <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                 July</span>
                              </div>
                              <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                              <ul class="bex-service-tags">
                                 <li>Hospitality</li>
                                 <li>Hospitality</li>
                                 <li>Hospitality</li>
                              </ul>
                           </div>
                           <div class="bex-primary-btn">
                              <a href="#">ENQUIRE NOW</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="bex-bussiness-section card">
                           <div class="bex-features-section-main">
                              <div id="ribbon-container">
                                 <a href="#" id="ribbon">PLATINUM</a>
                              </div>
                              <img src="./assets/img/bex-main-why.jpg" alt="" />
                           </div>
                           <div class="bex-bussiness-section-info">
                              <p>Food Parlors</p>
                              <h6>Established & Renowned Milkshake Franchise for Sale</h6>
                           </div>
                           <div class="bex-bussiness-section-info-main">
                              <div class="bex-main-info-card-timing">
                                 <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                 July</span>
                                 <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                 July</span>
                              </div>
                              <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                              <ul class="bex-service-tags">
                                 <li>Hospitality</li>
                                 <li>Hospitality</li>
                                 <li>Hospitality</li>
                              </ul>
                           </div>
                           <div class="bex-primary-btn">
                              <a href="#">ENQUIRE NOW</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="bex-bussiness-section card">
                           <div class="bex-features-section-main">
                              <div id="ribbon-container">
                                 <a href="#" id="ribbon">PLATINUM</a>
                              </div>
                              <img src="./assets/img/bex-main-why.jpg" alt="" />
                           </div>
                           <div class="bex-bussiness-section-info">
                              <p>Food Parlors</p>
                              <h6>Established & Renowned Milkshake Franchise for Sale</h6>
                           </div>
                           <div class="bex-bussiness-section-info-main">
                              <div class="bex-main-info-card-timing">
                                 <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                 July</span>
                                 <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                 July</span>
                              </div>
                              <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                              <ul class="bex-service-tags">
                                 <li>Hospitality</li>
                                 <li>Hospitality</li>
                                 <li>Hospitality</li>
                              </ul>
                           </div>
                           <div class="bex-primary-btn">
                              <a href="#">ENQUIRE NOW</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="bex-bussiness-section card">
                           <div class="bex-features-section-main">
                              <div id="ribbon-container">
                                 <a href="#" id="ribbon">PLATINUM</a>
                              </div>
                              <img src="./assets/img/bex-main-why.jpg" alt="" />
                           </div>
                           <div class="bex-bussiness-section-info">
                              <p>Food Parlors</p>
                              <h6>Established & Renowned Milkshake Franchise for Sale</h6>
                           </div>
                           <div class="bex-bussiness-section-info-main">
                              <div class="bex-main-info-card-timing">
                                 <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                 July</span>
                                 <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                 July</span>
                              </div>
                              <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                              <ul class="bex-service-tags">
                                 <li>Hospitality</li>
                                 <li>Hospitality</li>
                                 <li>Hospitality</li>
                              </ul>
                           </div>
                           <div class="bex-primary-btn">
                              <a href="#">ENQUIRE NOW</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="bex-bussiness-section card">
                           <div class="bex-features-section-main">
                              <div id="ribbon-container">
                                 <a href="#" id="ribbon">PLATINUM</a>
                              </div>
                              <img src="./assets/img/bex-main-why.jpg" alt="" />
                           </div>
                           <div class="bex-bussiness-section-info">
                              <p>Food Parlors</p>
                              <h6>Established & Renowned Milkshake Franchise for Sale</h6>
                           </div>
                           <div class="bex-bussiness-section-info-main">
                              <div class="bex-main-info-card-timing">
                                 <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                 July</span>
                                 <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                 July</span>
                              </div>
                              <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                              <ul class="bex-service-tags">
                                 <li>Hospitality</li>
                                 <li>Hospitality</li>
                                 <li>Hospitality</li>
                              </ul>
                           </div>
                           <div class="bex-primary-btn">
                              <a href="#">ENQUIRE NOW</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item-a">
                     <div class="business-ex-box">
                        <div class="bex-bussiness-section card">
                           <div class="bex-features-section-main">
                              <div id="ribbon-container">
                                 <a href="#" id="ribbon">PLATINUM</a>
                              </div>
                              <img src="./assets/img/bex-main-why.jpg" alt="" />
                           </div>
                           <div class="bex-bussiness-section-info">
                              <p>Food Parlors</p>
                              <h6>Established & Renowned Milkshake Franchise for Sale</h6>
                           </div>
                           <div class="bex-bussiness-section-info-main">
                              <div class="bex-main-info-card-timing">
                                 <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                 July</span>
                                 <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                 July</span>
                              </div>
                              <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                              <ul class="bex-service-tags">
                                 <li>Hospitality</li>
                                 <li>Hospitality</li>
                                 <li>Hospitality</li>
                              </ul>
                           </div>
                           <div class="bex-primary-btn">
                              <a href="#">ENQUIRE NOW</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
        <!-- ======= End Featured Start-Ups Section ======= -->

        <!-- ======= Featured Mentors Section ======= -->
         <section class="section-business-ex section-t2 nav-arrow-a">
            <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="title-wrap d-flex justify-content-between">
                     <div class="title-box">
                        <h2 class="bex-title-a">Featured Mentors</h2>
                        <h5>Business-Ex Offers 150 Mentors As On Date…</h5>
                        <a href="#" class="bex-view-all-section">View All</a>
                     </div>
                  </div>
               </div>
            </div>
            <div id="bex-Featured-mentors-carousel" class="owl-carousel owl-arrow bex-card-margin">
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
                                       <h6>Anand Naresh Motwani</h6>
                                       <p>Business Coach, Expandus Business Coaching Pvt. Ltd.</p>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-4">
                                    <img src="./assets/img/mentor.png" alt="..." class="rounded-circle">
                                 </div>
                                 <div class="col-sm-12 col-md-12">
                                    <div class="bex-bussiness-section-info-main">
                                       <div class="bex-main-info-card-timing">
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                       </div>
                                       <div class="bex-summary">Summary</div>
                                       <div class="bex-summary-info">Over 40 years of experience in Electrical Manufacturing
                                          industry.
                                       </div>
                                       <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                                       <ul class="bex-service-tags">
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
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
                                       <h6>Anand Naresh Motwani</h6>
                                       <p>Business Coach, Expandus Business Coaching Pvt. Ltd.</p>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-4">
                                    <img src="./assets/img/mentor.png" alt="..." class="rounded-circle">
                                 </div>
                                 <div class="col-sm-12 col-md-12">
                                    <div class="bex-bussiness-section-info-main">
                                       <div class="bex-main-info-card-timing">
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                       </div>
                                       <div class="bex-summary">Summary</div>
                                       <div class="bex-summary-info">Over 40 years of experience in Electrical Manufacturing
                                          industry.
                                       </div>
                                       <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                                       <ul class="bex-service-tags">
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
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
                                       <h6>Anand Naresh Motwani</h6>
                                       <p>Business Coach, Expandus Business Coaching Pvt. Ltd.</p>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-4">
                                    <img src="./assets/img/mentor.png" alt="..." class="rounded-circle">
                                 </div>
                                 <div class="col-sm-12 col-md-12">
                                    <div class="bex-bussiness-section-info-main">
                                       <div class="bex-main-info-card-timing">
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                       </div>
                                       <div class="bex-summary">Summary</div>
                                       <div class="bex-summary-info">Over 40 years of experience in Electrical Manufacturing
                                          industry.
                                       </div>
                                       <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                                       <ul class="bex-service-tags">
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
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
                                       <h6>Anand Naresh Motwani</h6>
                                       <p>Business Coach, Expandus Business Coaching Pvt. Ltd.</p>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-4">
                                    <img src="./assets/img/mentor.png" alt="..." class="rounded-circle">
                                 </div>
                                 <div class="col-sm-12 col-md-12">
                                    <div class="bex-bussiness-section-info-main">
                                       <div class="bex-main-info-card-timing">
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                       </div>
                                       <div class="bex-summary">Summary</div>
                                       <div class="bex-summary-info">Over 40 years of experience in Electrical Manufacturing
                                          industry.
                                       </div>
                                       <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                                       <ul class="bex-service-tags">
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
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
                                       <h6>Anand Naresh Motwani</h6>
                                       <p>Business Coach, Expandus Business Coaching Pvt. Ltd.</p>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-md-4">
                                    <img src="./assets/img/mentor.png" alt="..." class="rounded-circle">
                                 </div>
                                 <div class="col-sm-12 col-md-12">
                                    <div class="bex-bussiness-section-info-main">
                                       <div class="bex-main-info-card-timing">
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/calendar.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                          <span class="bex-main-info-card-timing-img"><img src="./assets/img/clock.svg"> 11
                                          July</span>
                                       </div>
                                       <div class="bex-summary">Summary</div>
                                       <div class="bex-summary-info">Over 40 years of experience in Electrical Manufacturing
                                          industry.
                                       </div>
                                       <p><a href="#">Gurgaon</a>, <a href="#">Haryana</a></p>
                                       <ul class="bex-service-tags">
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
                                          <li>Hospitality</li>
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
            </div>
         </section>
         <!-- End Featured Mentors Section -->

         <!-- ======= All Popular Business Opportunities Section ======= -->
         <section class="section-business-ex section-t2 nav-arrow-a">
            <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="title-wrap d-flex justify-content-between">
                     <div class="title-box">
                        <h2 class="bex-title-a">All Popular Business Opportunities</h2>
                     </div>
                  </div>
               </div>
            </div>
            <div class="bex-card-margin justify-content-center bex-all-popular-bussiness-main">
            <div class="row">
               <div class="bex-card-margin justify-content-center bex-all-popular-bussiness-main">
                  <div class="row">
                     <div class="col-md-4">
                        <div class="card-box-b card-shadow news-box">
                           <div class="img-box-b">
                              <img src="assets/img/post-4.jpg" alt="" class="img-b img-fluid">
                           </div>
                           <div class="card-overlay">
                              <div class="card-header-b bse-btn-overlay-w">
                                 <div class="card-title-b">
                                    <button type="button" class="btn btn-outline-bse">BY INDUSTRY</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="card-box-b card-shadow news-box">
                           <div class="img-box-b">
                              <img src="assets/img/post-4.jpg" alt="" class="img-b img-fluid">
                           </div>
                           <div class="card-overlay">
                              <div class="card-header-b bse-btn-overlay-w">
                                 <div class="card-title-b">
                                    <button type="button" class="btn btn-outline-bse">BY LOCATION</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="card-box-b card-shadow news-box">
                           <div class="img-box-b">
                              <img src="assets/img/post-4.jpg" alt="" class="img-b img-fluid">
                           </div>
                           <div class="card-overlay">
                              <div class="card-header-b bse-btn-overlay-w">
                                 <div class="card-title-b">
                                    <button type="button" class="btn btn-outline-bse">BY INVESTMENT</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>

         <!-- ======= End All Popular Business Opportunities Section ======= -->

         <!-- Start bx-insight Section -->
         <section id="bx-insight" class="bx-insight section-bg">
            <div class="container-fluid" data-aos="fade-up">
               <div class="row" data-aos="fade-up" data-aos-delay="100">
                  <div class="col-md-12">
                     <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                           <h2 class="bex-title-a">Bx Insights</h2>
                           <a href="#" class="bex-view-all-section2">View All</a>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="News-tab" data-toggle="tab" href="#News" role="tab" aria-controls="News" aria-selected="true">News</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="Articles-tab" data-toggle="tab" href="#Articles" role="tab" aria-controls="Articles" aria-selected="false">Articles</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="Testimonials-tab" data-toggle="tab" href="#Testimonials" role="tab" aria-controls="Testimonials" aria-selected="false">Testimonials</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="News" role="tabpanel" aria-labelledby="News-tab">.
                           <div class="row">
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
                                       <p class="bex-author-timeline"> By Jaspreet kaur</p>
                                    </div>
                                 </div>
                              </div>
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
                                       <p class="bex-author-timeline"> By Jaspreet kaur</p>
                                    </div>
                                 </div>
                              </div>
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
                                       <p class="bex-author-timeline"> By Jaspreet kaur</p>
                                    </div>
                                 </div>
                              </div>
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
                                       <p class="bex-author-timeline"> By Jaspreet kaur</p>
                                    </div>
                                 </div>
                              </div>
                              
                           </div>
                        </div>
                        <div class="tab-pane fade" id="Articles" role="tabpanel" aria-labelledby="Articles-tab">
                           <div class="row">
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
                                       <p class="bex-author-timeline"> By Jaspreet kaur</p>
                                    </div>
                                 </div>
                              </div>
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
                                       <p class="bex-author-timeline"> By Jaspreet kaur</p>
                                    </div>
                                 </div>
                              </div>
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
                                       <p class="bex-author-timeline"> By Jaspreet kaur</p>
                                    </div>
                                 </div>
                              </div>
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
                                       <p class="bex-author-timeline"> By Jaspreet kaur</p>
                                    </div>
                                 </div>
                              </div>
                              
                           </div>
                        </div>
                        <div class="tab-pane fade" id="Testimonials" role="tabpanel" aria-labelledby="Testimonials-tab">
                           <div class="row">
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
                                       <p class="bex-author-timeline"> By Jaspreet kaur</p>
                                    </div>
                                 </div>
                              </div>
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
                                       <p class="bex-author-timeline"> By Jaspreet kaur</p>
                                    </div>
                                 </div>
                              </div>
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
                                       <p class="bex-author-timeline"> By Jaspreet kaur</p>
                                    </div>
                                 </div>
                              </div>
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
                                       <p class="bex-author-timeline"> By Jaspreet kaur</p>
                                    </div>
                                 </div>
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
               <div class="bex-card-margin justify-content-center bex-all-popular-bussiness-main">
                  <div class="row">
                     <div class="col-md-4">
                        <div class="card bex-card-padding-tblr">
                           <div class="card-box-b card-shadow news-box">
                              <div class="img-box-b">
                                 <img src="assets/img/post-4.jpg" alt="" class="img-b img-fluid">
                              </div>
                              <div class="card-overlay">
                                 <div class="card-header-b bse-btn-overlay-w">
                                    <div class="card-title-b">
                                       <button type="button" class="btn btn-outline-bse">CALCULATE BUSINESS VALUE
                                       </button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="bex-card-info-main">
                              <h5>Business Valuation Calculator</h5>
                              <p>
                                 BusinessEx defines Business Valuation as a process of obtaining a
                                 fair economic value of a business. This will benefit in figuring out
                                 sale value, pitching to investors and developing business strategies…
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="card bex-card-padding-tblr">
                           <div class="card-box-b card-shadow news-box">
                              <div class="img-box-b">
                                 <img src="assets/img/post-4.jpg" alt="" class="img-b img-fluid">
                              </div>
                              <div class="card-overlay">
                                 <div class="card-header-b bse-btn-overlay-w">
                                    <div class="card-title-b">
                                       <button type="button" class="btn btn-outline-bse">CALCULATE BUSINESS VALUE
                                       </button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="bex-card-info-main">
                              <h5>Business Plan
                              </h5>
                              <p>
                                 BusinessEx defines Business Valuation as a process of obtaining a
                                 fair economic value of a business. This will benefit in figuring out
                                 sale value, pitching to investors and developing business strategies…
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="card bex-card-padding-tblr">
                           <div class="card-box-b card-shadow news-box">
                              <div class="img-box-b">
                                 <img src="assets/img/post-4.jpg" alt="" class="img-b img-fluid">
                              </div>
                              <div class="card-overlay">
                                 <div class="card-header-b bse-btn-overlay-w">
                                    <div class="card-title-b">
                                       <button type="button" class="btn btn-outline-bse">GET DUE DILIGENCE DONE
                                       </button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="bex-card-info-main">
                              <h5>Due Diligence</h5>
                              <p>
                                 Due diligence refers to an investigation of the business to confirm all
                                 facts, or an authentication of the information provided before signing
                                 a contract…
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
                     <div class="title-box ">
                        <h1 class="bex-title-a">Membership Plans
                        </h1>
                        <h5>Choose The Right One For You
                        </h5>
                     </div>
                  </div>
               </div>
            </div>
            <div class="bex-card-margin justify-content-center bex-all-popular-bussiness-main">
            <div class="row">
               <div class="col-md-4">
                  <div class="card text-center">
                     <div class=" bex-card-margin bex-plans-main">
                        <h4>Premium</h4>
                        <p>
                           <s> &#8377; 4,999</s>
                        </p>
                        <h1>
                           &#8377; 2999
                        </h1>
                        <p>
                           3 months
                        </p>
                     </div>
                     <div class="bex-plans-card-bottom">
                        <p class="bex-most-popular-text">
                           <b>Reach-out to 50 Business</b><br />
                           <b>Buyers / Investors</b><br />
                           10 Investment proposals<br />
                           Email support
                        </p>
                     </div>
                     <div class="bex-plans-btn">
                        <button type="button" class="btn btn-outline-secondary btn-md"> <i class="fa fa-plus"></i> EXPLORE
                        MORE
                        </button>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="card text-center">
                     <div class="bex-most-popular">
                        <span>Most Popular</span>
                     </div>
                     <div class=" bex-card-margin bex-plans-main bex-premium-price-main">
                        <h4>Premium</h4>
                        <p>
                           <s> &#8377; 7,499</s>
                        </p>
                        <h1 class="bex-premium-price">
                           &#8377; 4999
                        </h1>
                        <p>
                           6 months
                        </p>
                     </div>
                     <div class="bex-plans-card-bottom">
                        <p class="bex-most-popular-text">
                           <b>Reach-out to 50 Business</b><br />
                           <b>Buyers / Investors</b><br />
                           10 Investment proposals<br />
                           Email support
                        </p>
                     </div>
                     <div class="bex-plans-btn">
                        <button type="button" class="btn btn-light btn-md"> <i class="fa fa-plus"></i> EXPLORE MORE
                        </button>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="card text-center">
                     <div class=" bex-card-margin bex-plans-main">
                        <h4>Premium</h4>
                        <p>
                           <s> &#8377; 15,000</s>
                        </p>
                        <h1>
                           &#8377; 7999
                        </h1>
                        <p>
                           12 months
                        </p>
                     </div>
                     <div class="bex-plans-card-bottom">
                        <p class="bex-most-popular-text">
                           <b>Reach-out to 50 Business</b><br />
                           <b>Buyers / Investors</b><br />
                           10 Investment proposals<br />
                           Email support
                        </p>
                     </div>
                     <div class="bex-plans-btn">
                        <button type="button" class="btn btn-outline-secondary btn-md"> <i class="fa fa-plus"></i> EXPLORE
                        MORE
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- Membership Plans Section -->
         <!-- ======= Did You Find Anything Interested Section ======= -->
         <section class="section-business-ex section-t2 section-b2 nav-arrow-a b-white">
            <div class="container-fluid">
            <div class="row">
               <div class="col-md-12 text-center">
                  <div class="title-wrap justify-content-between">
                     <div class="title-box ">
                        <h1 class="bex-title-a">Did You Find Anything Interested ?
                        </h1>
                        <h5>Why Wait, Create Your Profile Now.</h5>
                     </div>
                  </div>
               </div>
            </div>
            <div class="bex-card-margin justify-content-center bex-all-popular-bussiness-main">
            <div class="row">
               <div class="col-xl-6 offset-xs-12 offset-md-12 offset-lg-12 offset-xl-3 align-self-center">
                  <form>
                     <div class="input-group">
                        <select class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                           <option selected>Select a profile...</option>
                           <option value="1">Business | Looking To Sell</option>
                           <option value="2">Startup | Looking For Funds</option>
                           <option value="3">Investor | Looking To Invest/Buy</option>
                           <option value="4">Mentor | Looking To Guide/Coach </option>
                        </select>
                        <div class="input-group-append">
                           <button class="btn  btn-success-main" type="button">CREATE PROFILE</button>
                        </div>
                  </form>
                  </div>
               </div>
            </div>
         </section>
         <!-- Did You Find Anything Interested Section -->
         <!-- ======= Did You Find Anything Interested Section ======= -->
         <section class="section-business-ex section-t2 section-b2 nav-arrow-a b-white">
            <div class="container-fluid">
               <div class="bex-card-margin justify-content-center bex-all-popular-bussiness-main">
                  <div class="row">
                     <div class="col-xs-12 col-sm-12 col-md-6 footer-newsletter">
                        <div class="text-sm-center text-md-center text-lg-left text-xl-left">
                           <h2>Subscribe Now</h2>
                           <p>Get updated through our mails</p>
                           <form action=" " method="post">
                              <input type="email" name="email"><input type="submit" value="Subscribe">
                           </form>
                        </div>
                     </div>
                     <div class="col-xs-12 col-sm-12 col-md-6 ">
                        <div class="text-sm-center text-md-center text-lg-right text-xl-right">
                           <h2>Follow Business-Ex</h2>
                           <p>Stay tuned & get updated</p>
                           <div class="social-links text-center text-md-right pt-3 pt-md-0">
                              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                              <a href="#" class="google-plus"><i class="fa fa-youtube"></i></a>
                              <!-- <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a> -->
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- Did You Find Anything Interested Section -->
         <!-- ======= About us Section ======= -->
         <section class="section-business-ex section-t2 nav-arrow-a">
            <div class="container-fluid">
            <div class="bex-card-margin justify-content-center bex-all-popular-bussiness-main about-us">
            <div class="row">
               <div class="col-md-12">
                  <p><b>About Business Ex</b></p>
                  BusinessEx is an online interactive platform to connect Businesses and Startups with Investors, Mentors,
                  Incubators, Lenders and Brokers, across industries and geographies.<br />
                  1500+ Businesses, 1400+ Startups, 1800+ Investors, 200+ Mentors and 50+ Incubators are registered in our
                  community so far!<br />
                  In addition, we also provide Business Services such as B-Plan assistance, Business Valuations, Due
                  Diligence and Legal Checks. BusinessEx has partnered with BizEquity - the world’s only patented and the
                  largest provider of business valuations, having valued over 33 Million Private Businesses
                  globally.<br /><br />
                  We have also ventured into events with our flagship event called BEx Guruwaar, held every Thursday in
                  major cities across India. BEx Guruwaar is aimed at bringing together the startup community and
                  celebrating the power of entrepreneurship. Our mission is to help early stage startups and aspiring
                  entrepreneurs by providing them with the guidance, mentorship and support that they need to turn their
                  entrepreneurial dreams into reality.
               </div>
            </div>
         </section>
         <!-- About us Section -->
         <!-- ======= footer widget Section ======= -->
         <section class="section-business-ex section-t2 nav-arrow-a">
            <div class="container-fluid">
            <div class="bex-card-margin justify-content-center bex-all-popular-bussiness-main about-us">
            <div class="row">
               <div class="col-md-2">
                  <p><b>Business</b></p>
                  <ul class="bex-listing-section">
                     <li>Investment seekers </li>
                     <li>Acquisition seekers </li>
                     <li>Lending seekers </li>
                     <li>Mentorship seekers</li>
                     <li>Incubation seekers</li>
                  </ul>
               </div>
               <div class="col-md-2">
                  <p><b>Business</b></p>
                  <ul class="bex-listing-section">
                     <li>Investment seekers </li>
                     <li>Acquisition seekers </li>
                     <li>Lending seekers </li>
                     <li>Mentorship seekers</li>
                     <li>Incubation seekers</li>
                  </ul>
               </div>
               <div class="col-md-2">
                  <p><b>Business</b></p>
                  <ul class="bex-listing-section">
                     <li>Investment seekers </li>
                     <li>Acquisition seekers </li>
                     <li>Lending seekers </li>
                     <li>Mentorship seekers</li>
                     <li>Incubation seekers</li>
                  </ul>
               </div>
               <div class="col-md-2">
                  <p><b>Business</b></p>
                  <ul class="bex-listing-section">
                     <li>Investment seekers </li>
                     <li>Acquisition seekers </li>
                     <li>Lending seekers </li>
                     <li>Mentorship seekers</li>
                     <li>Incubation seekers</li>
                  </ul>
               </div>
               <div class="col-md-2">
                  <p><b>Business</b></p>
                  <ul class="bex-listing-section">
                     <li>Investment seekers </li>
                     <li>Acquisition seekers </li>
                     <li>Lending seekers </li>
                     <li>Mentorship seekers</li>
                     <li>Incubation seekers</li>
                  </ul>
               </div>
               <div class="col-md-2">
                  <p><b>Business</b></p>
                  <ul class="bex-listing-section">
                     <li>Investment seekers </li>
                     <li>Acquisition seekers </li>
                     <li>Lending seekers </li>
                     <li>Mentorship seekers</li>
                     <li>Incubation seekers</li>
                  </ul>
               </div>
            </div>
         </section>

         <!-- footer widget Section -->
         <!-- ======= footer widget Section ======= -->
         <section class="section-business-ex section-t2 section-b2 nav-arrow-a">
            <div class="container-fluid">
            <div class="bex-card-margin justify-content-center bex-all-popular-bussiness-main about-us">
            <div class="row">
               <div class="col-md-12">
                  <p><b>Popular Searches</b></p>
                  <ul class="bex-popular-search-section">
                     <li> <a href="#">Automobile</a></li>
                     <li> <a href="#">Business Services </a></li>
                     <li> <a href="#">Fmcg </a></li>
                     <li> <a href="#">Education </a></li>
                     <li> <a href="#">Beauty, Health & Wellness </a></li>
                     <li> <a href="#">Food & Beverage </a></li>
                     <li> <a href="#">Fashion </a></li>
                     <li> <a href="#">Building Construction & Home Products </a></li>
                     <li> <a href="#">Travel & Tourism </a></li>
                     <li> <a href="#">Leisure & Entertainment </a></li>
                     <li> <a href="#">Finance </a></li>
                     <li> <a href="#">Industrial Machinery & Manufacturing </a></li>
                     <li> <a href="#">Retail </a></li>
                  </ul>
               </div>
            </div>
         </section>
         <!-- end footer widget Section -->
