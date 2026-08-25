@extends('layouts.app');
@php
    $businessTitle = $business->advmt_headline ?: $business->seller_company ?: 'Business Listing';
    $businessLocation = trim(($business->ofc_city ?? '') . (empty($business->ofc_city) || empty($business->ofc_state) ? '' : ', ') . stateDisplayName($business->ofc_state ?? ''));
    $businessImages = $business->images->filter(fn ($image) => !empty($image->business_img_path));
@endphp

@section('title', $businessTitle)

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
                <a href="#">{{ $businessLocation ?: 'Business' }}</a>
            </li>
            <li>/</li>
            <li>
                <a href="#">{{ $business->seller_company ?: 'Business' }}</a>
            </li>
            <li>/</li>
            <li>
                {{ $businessTitle }}
            </li>
        </ul>
    </div>
</div>

{{-- Short Description --}}
<div class="shortdes">
    <div class="container">

        <h1 class="headblk">
            {{ $businessTitle }}
        </h1>

        <p class="statictxt">
            {{ $business->seller_intro ?: $business->company_summary ?: 'Business profile details.' }}
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
                        {{ $business->inv_asking_price ? 'INR ' . number_format((float) $business->inv_asking_price, 2) : 'N/A' }}
                    </li>

                    <li class="linesh">|</li>

                    <li>
                        <span>Annual Sales/Turnover</span>
                        {{ $business->annual_sales ? number_format((float) $business->annual_sales, 2) : 'N/A' }}
                    </li>

                    <li class="linesh">|</li>

                    <li>
                        <span>Gross Income</span>
                        {{ $business->gross_profit ? number_format((float) $business->gross_profit, 2) : 'N/A' }}
                    </li>
                </ul>

                {{-- Carousel --}}
                <div id="carouselExampleIndicators"
                     class="carousel slide"
                     data-ride="carousel">

                    @if($businessImages->isNotEmpty())
                        <ol class="carousel-indicators">
                            @foreach($businessImages as $index => $image)
                                <li data-target="#carouselExampleIndicators"
                                    data-slide-to="{{ $index }}"
                                    class="{{ $index === 0 ? 'active' : '' }}">
                                </li>
                            @endforeach
                        </ol>
                    @endif

                    <div class="carousel-inner">
                        @forelse($businessImages as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img
                                    src="{{ filter_var($image->business_img_path, FILTER_VALIDATE_URL) ? $image->business_img_path : asset($image->business_img_path) }}"
                                    class="d-block w-100"
                                    alt="{{ $businessTitle }}"
                                >
                            </div>
                        @empty
                            <div class="carousel-item active">
                                <img
                                    src="{{ asset('assets/img/default-business.jpg') }}"
                                    class="d-block w-100"
                                    alt="{{ $businessTitle }}"
                                >
                            </div>
                        @endforelse
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
                                                {{ $business->estb_year ?: 'N/A' }}
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Employees
                                            </span>

                                            <span class="ds2">
                                                {{ $business->emp_count ?: 'N/A' }}
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Entity Type
                                            </span>

                                            <span class="ds2">
                                                {{ $business->entity_type ?: 'N/A' }}
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Business Sector
                                            </span>

                                            <span class="ds2">
                                                {{ $business->industry_sector ?: 'N/A' }}
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Business Type
                                            </span>

                                            <span class="ds2">
                                                {{ $business->business_type ? config('constants.businessType.' . $business->business_type) : 'N/A' }}
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
                                                {{ $business->annual_sales ? number_format((float) $business->annual_sales, 2) : 'N/A' }}
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                EBITDA
                                            </span>

                                            <span class="ds2">
                                                <i class="fas fa-rupee-sign"></i>
                                                {{ $business->ebitda ? number_format((float) $business->ebitda, 2) : 'N/A' }}
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                EBITDA Margin
                                            </span>

                                            <span class="ds2">
                                                {{ $business->ebitda_margin ? number_format((float) $business->ebitda_margin, 2) . '%' : 'N/A' }}
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Inventory Value
                                            </span>

                                            <span class="ds2">
                                                <i class="fas fa-rupee-sign"></i>
                                                {{ $business->inventory_value ? number_format((float) $business->inventory_value, 2) : 'N/A' }}
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Rentals
                                            </span>

                                            <span class="ds2">
                                                <i class="fas fa-rupee-sign"></i>
                                                {{ $business->rentals ? number_format((float) $business->rentals, 2) : 'N/A' }}
                                            </span>
                                        </div>

                                        <div class="indetailmodfy">
                                            <span class="ds1">
                                                Gross Income
                                            </span>

                                            <span class="ds2">
                                                <i class="fas fa-rupee-sign"></i>
                                                {{ $business->gross_profit ? number_format((float) $business->gross_profit, 2) : 'N/A' }}
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
                                Contact Business
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