@extends('layouts.app');
@section('title', 'Prominent Branded Gym Chain Franchise For Sale')

@section('content')

{{-- Running / Breadcrumb --}}
<div class="runbg">
    <div class="container bex-main">
        <ul class="brunnar">
            <li>
                <a href="{{ url('/') }}">Home</a>
            </li>
            <li>/</li>
            <li>
                <a href="#">Business</a>
            </li>
            <li>/</li>
            <li>
                <a href="#">Health</a>
            </li>
            <li>/</li>
            <li>
                <a href="#">Old gym for Sale</a>
            </li>
            <li>/</li>
            <li>
                Prominent Branded Gym Chain Franchise For Sale
            </li>
        </ul>
    </div>
</div>

{{-- Short Description --}}
<div class="shortdes">
    <div class="container">

        <h1 class="headblk">
            Prominent Branded Gym Chain Franchise For Sale
        </h1>

        <p class="statictxt">
            Focuses on providing its customers with a healthy snacking option
            along with its eco-friendly and hygienic packaging, with negligible
            usage of plastics.
        </p>

    </div>
</div>

{{-- Tab Navigation --}}
<div class="tobnavblk" id="landfix">
    <div class="container">
        <ul class="tabScroll">

            <li>
                <a href="#businesssaleoverview"
                   id="businesssaleoverview_tab"
                   onclick="setPos('businesssaleoverview', this.id)">
                    Overview
                </a>
            </li>

            <li>
                <a href="#businesssaledetails"
                   id="businesssaledetails_tab"
                   onclick="setPos('businesssaledetails', this.id)">
                    Details
                </a>
            </li>

            <li>
                <a href="#businesssalefinancials"
                   id="businesssalefinancials_tab"
                   onclick="setPos('businesssalefinancials', this.id)">
                    Financials
                </a>
            </li>

            <li>
                <a href="#businesssalerequirement"
                   id="businesssalerequirement_tab"
                   onclick="setPos('businesssalerequirement', this.id)">
                    Requirement
                </a>
            </li>

        </ul>
    </div>
</div>

{{-- Detail Part --}}
<div class="detailcontent">
    <div class="container">

        <div class="row">

            {{-- Main Content --}}
            <div class="col-12 col-sm-12 col-md-9">

                {{-- Summary --}}
                <ul class="mainsecdet">
                    <li>
                        <span>Seeking Investment</span>
                        INR 1 Cr - 2 Cr
                    </li>

                    <li class="linesh">|</li>

                    <li>
                        <span>Annual Sales/Turnover</span>
                        N/A
                    </li>

                    <li class="linesh">|</li>

                    <li>
                        <span>Gross Income</span>
                        N/A
                    </li>
                </ul>

                {{-- Carousel --}}
                <div id="carouselExampleIndicators"
                     class="carousel slide"
                     data-ride="carousel">

                    <ol class="carousel-indicators">

                        <li data-target="#carouselExampleIndicators"
                            data-slide-to="0"
                            class="active">
                        </li>

                        <li data-target="#carouselExampleIndicators"
                            data-slide-to="1">
                        </li>

                        <li data-target="#carouselExampleIndicators"
                            data-slide-to="2">
                        </li>

                        <li data-target="#carouselExampleIndicators"
                            data-slide-to="3">
                        </li>

                        <li data-target="#carouselExampleIndicators"
                            data-slide-to="4">
                        </li>

                    </ol>

                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <img
                                src="https://s3.ap-south-1.amazonaws.com/businessextest/subCatImages/66/1000_x_562/shutterstock_289585190.jpg"
                                class="d-block w-100"
                                alt="Gym"
                            >
                        </div>

                        <div class="carousel-item">
                            <img
                                src="https://s3.ap-south-1.amazonaws.com/businessextest/subCatImages/66/1000_x_562/shutterstock_523768063.jpg"
                                class="d-block w-100"
                                alt="Gym"
                            >
                        </div>

                        <div class="carousel-item">
                            <img
                                src="https://s3.ap-south-1.amazonaws.com/businessextest/subCatImages/66/1000_x_562/shutterstock_531055792.jpg"
                                class="d-block w-100"
                                alt="Gym"
                            >
                        </div>

                        <div class="carousel-item">
                            <img
                                src="https://s3.ap-south-1.amazonaws.com/businessextest/subCatImages/66/1000_x_562/shutterstock_560271130.jpg"
                                class="d-block w-100"
                                alt="Gym"
                            >
                        </div>

                        <div class="carousel-item">
                            <img
                                src="https://s3.ap-south-1.amazonaws.com/businessextest/subCatImages/66/1000_x_562/shutterstock_1113163970.jpg"
                                class="d-block w-100"
                                alt="Gym"
                            >
                        </div>

                    </div>

                    <a class="carousel-control-prev"
                       href="#carouselExampleIndicators"
                       role="button"
                       data-slide="prev">

                        <span class="carousel-control-prev-icon"
                              aria-hidden="true">
                        </span>

                        <span class="sr-only">
                            Previous
                        </span>
                    </a>

                    <a class="carousel-control-next"
                       href="#carouselExampleIndicators"
                       role="button"
                       data-slide="next">

                        <span class="carousel-control-next-icon"
                              aria-hidden="true">
                        </span>

                        <span class="sr-only">
                            Next
                        </span>
                    </a>

                </div>

                {{-- Full Detail --}}
                <div class="fulldetailpage">

                    <div class="tab-content">

                        {{-- =========================
                             OVERVIEW
                        ========================== --}}
                        <div id="businesssaleoverview">

                            <div class="boxsect">

                                <div class="boxsecthead">
                                    Overview
                                </div>

                                <div class="fullshblk">

                                    <div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Summary
                                            </span>

                                            <span class="ds2">
                                                The company is into the transportation.
                                                We have 5 cars; 2 tempo vans.
                                                There are 3 cars which are 5 seater
                                                and 2 cars which is 10 seater.
                                                The tempo is a 22 seater.
                                                All the vehicles are 4 to 7 years old.
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Facilities
                                            </span>

                                            <span class="ds2">
                                                This is good and very good.
                                                <br>
                                                Serves Health Club service and Group Classes.
                                                <br>
                                                Premium machines and decor, as per brand standards.
                                            </span>
                                        </div>

                                        {{-- Director --}}
                                        <div class="indetailmodfy">

                                            <span class="ds1">
                                                Director/CEO Information
                                            </span>

                                            <span class="ds2">

                                                <i class="fa fa-unlock"
                                                   aria-hidden="true">
                                                </i>

                                                Available after Interaction

                                                <br>

                                                <div class="inafter">

                                                    <ul class="innerlab">
                                                        <li>
                                                            <label>Name</label>
                                                        </li>
                                                        <li>
                                                            <label>Designation</label>
                                                        </li>
                                                        <li>
                                                            <label>Email ID</label>
                                                        </li>
                                                    </ul>

                                                    <ul class="innerlab">
                                                        <li>
                                                            Sunil Gupta
                                                        </li>
                                                        <li>
                                                            Director
                                                        </li>
                                                        <li>
                                                            <a href="mailto:sunilyadav@gmail.com">
                                                                sunil@franchiseindia.net
                                                            </a>
                                                        </li>
                                                    </ul>

                                                </div>

                                            </span>

                                        </div>

                                        {{-- Management --}}
                                        <div class="indetailmodfy">

                                            <span class="ds1">
                                                Management Information
                                            </span>

                                            <span class="ds2">

                                                <i class="fa fa-unlock"
                                                   aria-hidden="true">
                                                </i>

                                                Available after Interaction

                                                <div class="inafter">

                                                    <ul class="innerlab">
                                                        <li>
                                                            <label>Name</label>
                                                        </li>
                                                        <li>
                                                            <label>Designation</label>
                                                        </li>
                                                        <li>
                                                            <label>Email ID</label>
                                                        </li>
                                                    </ul>

                                                    <ul class="innerlab">
                                                        <li>
                                                            Sunil Gupta
                                                        </li>
                                                        <li>
                                                            Director
                                                        </li>
                                                        <li>
                                                            <a href="mailto:sunilyadav@gmail.com">
                                                                sunil@franchiseindia.net
                                                            </a>
                                                        </li>
                                                    </ul>

                                                    <ul class="innerlab">
                                                        <li>
                                                            Sunil Rashmi kant Kumar Gupta
                                                        </li>
                                                        <li>
                                                            Managing Director
                                                        </li>
                                                        <li>
                                                            <a href="mailto:sunilyadav@gmail.com">
                                                                sunilkumargupta@franchiseindia.net
                                                            </a>
                                                        </li>
                                                    </ul>

                                                    <ul class="innerlab">
                                                        <li>
                                                            Vikash Gupta
                                                        </li>
                                                        <li>
                                                            Director
                                                        </li>
                                                        <li>
                                                            <a href="mailto:sunilyadav@gmail.com">
                                                                vikash.guppta@franchise.net
                                                            </a>
                                                        </li>
                                                    </ul>

                                                </div>

                                            </span>

                                        </div>

                                        <div class="indetailmodfy">

                                            <span class="ds1">
                                                Business Documents
                                            </span>

                                            <span class="ds2">

                                                <i class="fa fa-lock"
                                                   aria-hidden="true">
                                                </i>

                                                Available after Interaction

                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- =========================
                             DETAILS
                        ========================== --}}
                        <div id="businesssaledetails">

                            <div class="boxsect">

                                <div class="boxsecthead">
                                    Details
                                </div>

                                <div class="fullshblk">

                                    <div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Establishment Year
                                            </span>

                                            <span class="ds2">
                                                2011
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Employees
                                            </span>

                                            <span class="ds2">
                                                101-500
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Entity Type
                                            </span>

                                            <span class="ds2">
                                                Private Limited Company
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Business Sector
                                            </span>

                                            <span class="ds2">
                                                Coaching & training institutes
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Business Type
                                            </span>

                                            <span class="ds2">
                                                Business to Customer
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Website
                                            </span>

                                            <span class="ds2">
                                                <i class="fa fa-lock"
                                                   aria-hidden="true">
                                                </i>

                                                Available after Interaction
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Social Media Links
                                            </span>

                                            <span class="ds2">
                                                <i class="fa fa-lock"
                                                   aria-hidden="true">
                                                </i>

                                                Available after Interaction
                                            </span>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- =========================
                             FINANCIALS
                        ========================== --}}
                        <div id="businesssalefinancials">

                            <div class="boxsect">

                                <div class="boxsecthead">
                                    Financial
                                </div>

                                <div class="fullshblk">

                                    <div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Annual Sales
                                            </span>

                                            <span class="ds2">
                                                <i class="fas fa-rupee-sign"></i>
                                                100000000
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                EBITDA
                                            </span>

                                            <span class="ds2">
                                                <i class="fas fa-rupee-sign"></i>
                                                9,000,000.00
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                EBITDA Margin
                                            </span>

                                            <span class="ds2">
                                                21,122.00%
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Inventory Value
                                            </span>

                                            <span class="ds2">
                                                <i class="fas fa-rupee-sign"></i>
                                                300,000.00
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Rentals
                                            </span>

                                            <span class="ds2">
                                                <i class="fas fa-rupee-sign"></i>
                                                40,000.00
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Gross Income
                                            </span>

                                            <span class="ds2">
                                                <i class="fas fa-rupee-sign"></i>
                                                100000000
                                            </span>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- =========================
                             REQUIREMENT
                        ========================== --}}
                        <div id="businesssalerequirement">

                            <div class="boxsect">

                                <div class="boxsecthead">
                                    Business Requirement
                                </div>

                                <div class="fullshblk">

                                    {{-- Business Pitch --}}
                                    <div class="halkblknew">

                                        <div class="indetailmodfy">

                                            <span class="ds1">
                                                One-line Business Pitch
                                            </span>

                                            <span class="ds2">
                                                We are sure about our product
                                                and service and we are going
                                                to rock in an year or two.
                                            </span>

                                        </div>

                                    </div>

                                    {{-- Requirement 1 --}}
                                    <div class="halkblknew">

                                        <div class="sminhead">
                                            Requirement 1
                                        </div>

                                        <div class="indetailmodfy">

                                            <span class="ds1">
                                                Looking For
                                            </span>

                                            <span class="ds2">
                                                <i class="fas fa-rupee-sign"></i>
                                                Investment
                                            </span>

                                        </div>

                                        <div class="indetailmodfy">

                                            <span class="ds1">
                                                Amount
                                            </span>

                                            <span class="ds2">
                                                <i class="fas fa-rupee-sign"></i>
                                                40000000 at 0 % stake
                                            </span>

                                        </div>

                                        <div class="indetailmodfy">

                                            <span class="ds1">
                                                Reason
                                            </span>

                                            <span class="ds2">
                                                We are looking to expand our
                                                business. We have more plans
                                                to open branches.
                                            </span>

                                        </div>

                                    </div>

                                    {{-- Requirement 2 --}}
                                    <div class="halkblknew">

                                        <div class="sminhead">
                                            Requirement 2
                                        </div>

                                        <div class="indetailmodfy">

                                            <span class="ds1">
                                                Looking For
                                            </span>

                                            <span class="ds2">
                                                Mentorship
                                            </span>

                                        </div>

                                        <div class="indetailmodfy">

                                            <span class="ds1">
                                                Field of Support
                                            </span>

                                            <span class="ds2">
                                                Accounting Bookkeeping
                                            </span>

                                        </div>

                                        <div class="indetailmodfy">

                                            <span class="ds1">
                                                Support Req.
                                            </span>

                                            <span class="ds2">
                                                Looking mentors for my business
                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- Contact Button --}}
                        <div class="btnconatblk">
                            <a href="#contactfrm"
                               class="btnconat">
                                Contact Startup
                            </a>
                        </div>

                    </div>

                </div>

            </div>


            {{-- Right Sidebar --}}
            <div class="col-12 col-sm-12 col-md-3">

                {{--@include('includes.bexlandingfrmseller')--}}

            </div>

        </div>

    </div>
</div>