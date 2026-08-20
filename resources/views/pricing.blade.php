@extends('layouts.app')

@section('content')

<main id="main" class="minheigh">
    <div class="container bex-main">

        {{-- ==================== BREADCRUMB ==================== --}}
        <div class="row">
            <div class="col-12">
                <ul class="brunnar">
                    <li>
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>/</li>
                    <li>Pricing</li>
                </ul>
            </div>
        </div>

        {{-- ==================== PAGE HEADER ==================== --}}
        <div class="row">
            <div class="col-12">
                <h1 class="headblk">Choose a Plan</h1>
                <p class="statictxt">
                    Create your profile & find the correct solution for your business
                </p>
            </div>
        </div>

        {{-- ==================== PRICING FORM ==================== --}}
        <form
            class="frmall"
            action="{{-- route('pricing.purchase') --}}"
            method="POST"
            id="pricingForm"
        >

            @csrf

            {{-- ==================== PROFILE TYPE ==================== --}}
            <div class="pestion">
                <div class="prtxt">Profile Type:</div>

                <div class="lineval">

                    <div class="radio-item">
                        <input
                            type="radio"
                            id="ritema"
                            name="profile_type"
                            value="Business"
                            {{ old('profile_type', 'Business') === 'Business' ? 'checked' : '' }}
                        >
                        <label for="ritema">Business</label>
                    </div>

                    <div class="radio-item">
                        <input
                            type="radio"
                            id="id3"
                            name="profile_type"
                            value="Startup"
                            {{ old('profile_type') === 'Startup' ? 'checked' : '' }}
                        >
                        <label for="id3">Startup</label>
                    </div>

                    <div class="radio-item">
                        <input
                            type="radio"
                            id="id4"
                            name="profile_type"
                            value="Investor"
                            {{ old('profile_type') === 'Investor' ? 'checked' : '' }}
                        >
                        <label for="id4">Investor</label>
                    </div>

                    <div class="radio-item">
                        <input
                            type="radio"
                            id="ritemb"
                            name="profile_type"
                            value="Mentor"
                            {{ old('profile_type') === 'Mentor' ? 'checked' : '' }}
                        >
                        <label for="ritemb">Mentor</label>
                    </div>

                </div>
            </div>

            @error('profile_type')
                <span class="text-danger d-block mb-2">
                    {{ $message }}
                </span>
            @enderror


            {{-- ==================== NAME + MOBILE ==================== --}}
            <div class="row marsettop">

                {{-- Name --}}
                <div class="col-12 col-sm-6 col-md-6 modfy1">
                    <div class="row">

                        <label
                            class="col-12 col-sm-6 col-md-3 frmtxt mandatory"
                            for="your_name"
                        >
                            Your Name
                        </label>

                        <div class="d-none d-md-block col-md-1">:</div>

                        <div class="col-12 col-sm-6 col-md-8">
                            <input
                                type="text"
                                name="your_name"
                                id="your_name"
                                class="form-control modysel @error('your_name') is-invalid @enderror"
                                placeholder="Enter name"
                                value="{{ old('your_name') }}"
                            >

                            @error('your_name')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>


                {{-- Mobile --}}
                <div class="col-12 col-sm-6 col-md-6 modfy2">
                    <div class="row">

                        <label
                            class="col-12 col-sm-6 col-md-3 frmtxt mandatory"
                            for="mobile_no"
                        >
                            Mobile No.
                        </label>

                        <div class="d-none d-md-block col-md-1">:</div>

                        <div class="col-12 col-sm-6 col-md-8">
                            <input
                                type="tel"
                                name="mobile_no"
                                id="mobile_no"
                                class="form-control modysel @error('mobile_no') is-invalid @enderror"
                                placeholder="Enter Mobile"
                                value="{{ old('mobile_no') }}"
                            >

                            @error('mobile_no')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>

            </div>


            {{-- ==================== EMAIL + COMPANY ==================== --}}
            <div class="row marsettop">

                {{-- Email --}}
                <div class="col-12 col-sm-6 col-md-6 modfy1">
                    <div class="row">

                        <label
                            class="col-12 col-sm-6 col-md-3 frmtxt mandatory"
                            for="email_id"
                        >
                            Email ID
                        </label>

                        <div class="d-none d-md-block col-md-1">:</div>

                        <div class="col-12 col-sm-6 col-md-8">
                            <input
                                type="email"
                                name="email_id"
                                id="email_id"
                                class="form-control modysel @error('email_id') is-invalid @enderror"
                                placeholder="Enter Email ID"
                                value="{{ old('email_id') }}"
                            >

                            @error('email_id')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>


                {{-- Company --}}
                <div class="col-12 col-sm-6 col-md-6 modfy2">
                    <div class="row">

                        <label
                            class="col-12 col-sm-6 col-md-3 frmtxt mandatory"
                            for="company_name"
                        >
                            Company Name
                        </label>

                        <div class="d-none d-md-block col-md-1">:</div>

                        <div class="col-12 col-sm-6 col-md-8">
                            <input
                                type="text"
                                name="company_name"
                                id="company_name"
                                class="form-control modysel @error('company_name') is-invalid @enderror"
                                placeholder="Enter Company Name"
                                value="{{ old('company_name') }}"
                            >

                            @error('company_name')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>

            </div>


            {{-- ==================== PROMO + PAYMENT ==================== --}}
            <div class="row marsettop">

                {{-- Promo --}}
                <div class="col-12 col-sm-6 col-md-6 modfy1">
                    <div class="row">

                        <label
                            class="col-12 col-sm-6 col-md-3 frmtxt"
                            for="promo_code"
                        >
                            Promo Code
                        </label>

                        <div class="d-none d-md-block col-md-1">:</div>

                        <div class="col-12 col-sm-6 col-md-8 poss">

                            <input
                                type="text"
                                name="promo_code"
                                id="promo_code"
                                class="form-control modysel"
                                placeholder="Enter Promo Code"
                                value="{{ old('promo_code') }}"
                            >

                            <button
                                type="button"
                                class="alybtn"
                                id="applyPromoBtn"
                            >
                                Apply
                            </button>

                            <div id="promoMessage"></div>

                            @if(session('promo_error'))
                                <span class="text-danger small d-block mt-1">
                                    {{ session('promo_error') }}
                                </span>
                            @endif

                            @if(session('promo_success'))
                                <span class="text-success small d-block mt-1">
                                    {{ session('promo_success') }}
                                </span>
                            @endif

                        </div>

                    </div>
                </div>


                {{-- Payment Mode --}}
                <div class="col-12 col-sm-6 col-md-6 modfy2">
                    <div class="row">

                        <label
                            class="col-12 col-sm-6 col-md-3 frmtxt mandatory"
                            for="payment_mode"
                        >
                            Payment Mode
                        </label>

                        <div class="d-none d-md-block col-md-1">:</div>

                        <div class="col-12 col-sm-6 col-md-8">

                            <select
                                name="payment_mode"
                                id="payment_mode"
                                class="form-control myselectclasscat @error('payment_mode') is-invalid @enderror"
                                required
                            >
                                <option value="" disabled
                                    {{ old('payment_mode') ? '' : 'selected' }}>
                                    Select Payment Mode
                                </option>

                                <option value="OPTCRDC"
                                    {{ old('payment_mode') === 'OPTCRDC' ? 'selected' : '' }}>
                                    Credit Card
                                </option>

                                <option value="OPTDBCRD"
                                    {{ old('payment_mode') === 'OPTDBCRD' ? 'selected' : '' }}>
                                    Debit Card
                                </option>

                                <option value="OPTNBK"
                                    {{ old('payment_mode') === 'OPTNBK' ? 'selected' : '' }}>
                                    Net Banking
                                </option>

                                <option value="Paytm"
                                    {{ old('payment_mode') === 'Paytm' ? 'selected' : '' }}>
                                    Paytm
                                </option>

                                <option value="UPI"
                                    {{ old('payment_mode') === 'UPI' ? 'selected' : '' }}>
                                    UPI
                                </option>

                            </select>

                            @error('payment_mode')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>
                </div>

            </div>


            {{-- ==================== SELECTED PLAN ==================== --}}
            <input
                type="hidden"
                name="selected_plan"
                id="selectedPlan"
                value="{{ old('selected_plan', 'gold') }}"
            >


            {{-- ==================== PRICING CARDS ==================== --}}
            <div class="priclist">

                {{-- BASIC --}}
                <div
                    class="priclistinner {{ old('selected_plan', 'gold') === 'basic' ? 'active' : '' }}"
                    data-plan="basic"
                >

                    <div class="inhieght">

                        <div class="shead">Basic</div>

                        <del class="dll">
                            <i class="fas fa-rupee-sign"></i> 1000
                        </del>

                        <div class="mainpri">
                            <i class="fas fa-rupee-sign"></i> 500
                            <span>(+18% GST)</span>
                        </div>

                        <div class="savcol">
                            <i class="fas fa-rupee-sign"></i> 500 Savings
                        </div>

                    </div>

                    <ul class="pritxt">
                        <li>
                            <i class="fas fa-check-circle text-success"></i>
                            Profile Listing
                        </li>

                        <li>
                            <i class="fas fa-check-circle text-success"></i>
                            Continuous Email Support
                        </li>

                        <li>
                            <i class="fas fa-check-circle text-success"></i>
                            Accept Unlimited Investment Proposals from genuine users registered with BusinessEx
                        </li>
                    </ul>

                    <div class="bntls">
                        <button
                            type="button"
                            class="btnpric buy-plan"
                            data-plan="basic"
                        >
                            Buy Now
                        </button>
                    </div>

                </div>


                {{-- PREMIUM --}}
                <div
                    class="priclistinner {{ old('selected_plan', 'gold') === 'premium' ? 'active' : '' }}"
                    data-plan="premium"
                >

                    <div class="inhieght">

                        <div class="shead">Premium</div>

                        <del class="dll">
                            <i class="fas fa-rupee-sign"></i> 9,999
                        </del>

                        <div class="mainpri">
                            <i class="fas fa-rupee-sign"></i> 6,999
                            <span>(+18% GST)</span>
                        </div>

                        <div class="savcol">
                            <i class="fas fa-rupee-sign"></i> 3,000 Savings
                        </div>

                        <div class="mtxt">3 months</div>

                    </div>

                    <ul class="pritxt">

                        <li>
                            <i class="fas fa-check-circle text-success"></i>
                            Speedy Profile Activation
                        </li>

                        <li>
                            <i class="fas fa-check-circle text-success"></i>
                            Continuous Email Support
                        </li>

                        <li>
                            <i class="fas fa-check-circle text-success"></i>
                            Reach out to 50 Business Buyers/Investors registered with BusinessEx, based on your business requirement.
                        </li>

                        <li>
                            <i class="fas fa-check-circle text-success"></i>
                            Accept Unlimited Investment Proposals from genuine Business Buyers/Investors registered with BusinessEx.
                        </li>

                    </ul>

                    <div class="bntls">
                        <button
                            type="button"
                            class="btnpric buy-plan"
                            data-plan="premium"
                        >
                            Buy Now
                        </button>
                    </div>

                </div>


                {{-- GOLD --}}
                <div
                    class="priclistinner {{ old('selected_plan', 'gold') === 'gold' ? 'active' : '' }}"
                    data-plan="gold"
                >

                    <div class="topset">
                        <div class="shbbtxt">Most Recommended</div>
                    </div>

                    <div class="inhieght">

                        <div class="shead">Gold</div>

                        <del class="dll">
                            <i class="fas fa-rupee-sign"></i> 15,999
                        </del>

                        <div class="mainpri">
                            <i class="fas fa-rupee-sign"></i> 12,999
                            <span>(+18% GST)</span>
                        </div>

                        <div class="savcol">
                            <i class="fas fa-rupee-sign"></i> 3,000 Savings
                        </div>

                        <div class="mtxt">4 months</div>

                    </div>

                    <ul class="pritxt">

                        <li>
                            <i class="fas fa-check-circle text-success"></i>
                            Speedy Profile Activation
                        </li>

                        <li>
                            <i class="fas fa-check-circle text-success"></i>
                            Continuous Email Support
                        </li>

                        <li>
                            <i class="fas fa-check-circle text-success"></i>
                            Reach out to 50 Business Buyers/Investors registered with BusinessEx, based on your business requirement.
                        </li>

                        <li>
                            <i class="fas fa-check-circle text-success"></i>
                            Accept Unlimited Investment Proposals from genuine Business Buyers/Investors registered with BusinessEx.
                        </li>

                    </ul>

                    <div class="bntls">
                        <button
                            type="button"
                            class="btnpric buy-plan"
                            data-plan="gold"
                        >
                            Buy Now
                        </button>
                    </div>

                </div>


                {{-- PLATINUM --}}
                <div
                    class="priclistinner {{ old('selected_plan', 'gold') === 'platinum' ? 'active' : '' }}"
                    data-plan="platinum"
                >

                    <div class="inhieght">

                        <div class="shead">Platinum</div>

                        <del class="dll">
                            <i class="fas fa-rupee-sign"></i> 19,999
                        </del>

                        <div class="mainpri">
                            <i class="fas fa-rupee-sign"></i> 24,999
                            <span>(+18% GST)</span>
                        </div>

                        <div class="savcol">
                            <i class="fas fa-rupee-sign"></i> 3,000 Savings
                        </div>

                        <div class="mtxt">4 months</div>

                    </div>

                    <ul class="pritxt">

                        <li>
                            <i class="fas fa-check-circle text-success"></i>
                            Speedy Profile Activation
                        </li>

                        <li>
                            <i class="fas fa-check-circle text-success"></i>
                            Continuous Email Support
                        </li>

                        <li>
                            <i class="fas fa-check-circle text-success"></i>
                            Reach out to 50 Business Buyers/Investors registered with BusinessEx, based on your business requirement.
                        </li>

                        <li>
                            <i class="fas fa-check-circle text-success"></i>
                            Accept Unlimited Investment Proposals from genuine Business Buyers/Investors registered with BusinessEx.
                        </li>

                    </ul>

                    <div class="bntls">
                        <button
                            type="button"
                            class="btnpric buy-plan"
                            data-plan="platinum"
                        >
                            Buy Now
                        </button>
                    </div>

                </div>

            </div>


            {{-- ==================== COMPARISON ==================== --}}
            <div class="feblkcontainer pricing-comparison">

                <div class="feblk_head">

                    <a href="#" id="comparisonLink">
                        Full Plan Comparison
                    </a>

                    <span
                        class="cirplusminus minus"
                        id="comparisonToggle"
                    ></span>

                </div>

                <div
                    class="feblk_body"
                    id="comparisonBody"
                >

                    <ul class="priceplan">

                        {{-- Header --}}
                        <li>

                            <div class="reghead tleft">
                                Plan Features
                            </div>

                            <div class="iconblk htset tleft">
                                Unlock unlimited investment proposals
                            </div>

                            <div class="iconblk htset tleft">
                                Real time information
                            </div>

                            <div class="iconblk htset tleft">
                                Profile promotions
                            </div>

                            <div class="iconblk htset tleft">
                                Dedicated marketing campaign for promotion
                            </div>

                            <div class="iconblk htset tleft">
                                Assignment of a Key Account Manager
                            </div>

                            <div class="iconblk htset tleft">
                                Top Profiles for your requirement
                            </div>

                            <div class="iconblk htset tleft">
                                Monthly Reports
                            </div>

                            <div class="iconblk htset tleft">
                                Recommendation
                            </div>

                            <div class="iconblk htset tleft">
                                Accelerated Marketing
                            </div>

                            <div class="iconblk htset tleft">
                                Certified Business Valuation Report
                            </div>

                        </li>


                        {{-- Basic --}}
                        <li>

                            <div class="reghead">Basic</div>

                            @for($i = 0; $i < 10; $i++)
                                <div class="iconblk htset">
                                    <i class="fas fa-minus text-muted"></i>
                                </div>
                            @endfor

                        </li>


                        {{-- Premium --}}
                        <li>

                            <div class="reghead">Premium</div>

                            <div class="iconblk htset">
                                <div class="pvalue">10</div>
                            </div>

                            @for($i = 0; $i < 3; $i++)
                                <div class="iconblk htset">
                                    <i class="fas fa-check text-success"></i>
                                </div>
                            @endfor

                            @for($i = 0; $i < 6; $i++)
                                <div class="iconblk htset">
                                    <i class="fas fa-minus text-muted"></i>
                                </div>
                            @endfor

                        </li>


                        {{-- Gold --}}
                        <li>

                            <div class="reghead">Gold</div>

                            <div class="iconblk htset">
                                <div class="pvalue">20</div>
                            </div>

                            @for($i = 0; $i < 7; $i++)
                                <div class="iconblk htset">
                                    <i class="fas fa-check text-success"></i>
                                </div>
                            @endfor

                            @for($i = 0; $i < 2; $i++)
                                <div class="iconblk htset">
                                    <i class="fas fa-minus text-muted"></i>
                                </div>
                            @endfor

                        </li>


                        {{-- Platinum --}}
                        <li>

                            <div class="reghead">Platinum</div>

                            <div class="iconblk htset">
                                <div class="pvalue">30</div>
                            </div>

                            @for($i = 0; $i < 8; $i++)
                                <div class="iconblk htset">
                                    <i class="fas fa-check text-success"></i>
                                </div>
                            @endfor

                            <div class="iconblk htset">
                                <div class="pvalue">
                                    Upto 10,000 Marketing Emails
                                </div>
                            </div>

                        </li>

                    </ul>

                </div>

            </div>

        </form>

    </div>
    @include('includes.groupcompany')
    @include('includes.newsletter')
    @include('includes.categorylinkfooter')

</main>


{{-- ==================== STYLES ==================== --}}
@push('styles')

<style>

.priclist {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    gap: 15px;
    width: 100%;
    padding: 10px 0;
    align-items: stretch;
    overflow-x: auto;
}

.pricing-comparison {
    clear: both;
    display: block;
    margin: 20px 0 0;
    width: 100%;
}

.pricing-comparison .feblk_head,
.pricing-comparison .feblk_body {
    width: 100%;
}

.pricing-comparison .priceplan {
    align-items: stretch;
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    width: 100%;
}

.pricing-comparison .priceplan > li {
    display: block;
    float: none;
    flex: 0 0 17%;
    margin-left: 0;
    min-width: 0;
}

.pricing-comparison .priceplan > li:first-child {
    flex-basis: 32%;
}

.pricing-comparison .priceplan::after {
    clear: both;
    content: '';
    display: table;
}

.priclistinner {
    flex: 1 1 0;
    width: 25%;
    min-width: 0;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

.priclistinner.active {
    position: relative;
    transform: translateY(-3px);
}

.priclistinner .inhieght,
.priclistinner .pritxt,
.priclistinner .bntls {
    width: 100%;
    box-sizing: border-box;
}

.btnpric {
    cursor: pointer;
    transition: all 0.3s ease;
}

.btnpric:hover {
    opacity: 0.9;
}

.priceplan {
    padding: 0;
    margin: 0;
}

.priceplan > li {
    display: block;
    border-bottom: 1px solid #eee;
}

.priceplan > li:hover {
    background-color: #f8f9fa;
}

.reghead {
    font-weight: bold;
    min-width: 120px;
    flex: 1;
    padding: 10px;
    text-align: center;
}

.iconblk {
    flex: 1;
    text-align: center;
    padding: 10px;
    box-sizing: border-box;
}

.tleft {
    text-align: left !important;
}

.htset {
    min-height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pvalue {
    font-weight: 600;
    color: #007bff;
}

#comparisonBody {
    display: block;
}

#promoMessage {
    margin-top: 5px;
}

@media screen and (max-width: 1200px) {

    .priclistinner .shead {
        font-size: 18px;
    }

    .priclistinner .mainpri {
        font-size: 22px;
    }

    .priclistinner .pritxt li {
        font-size: 12px;
        line-height: 1.4;
    }
}

@media screen and (max-width: 992px) {

    .priclist {
        gap: 10px;
    }

    .priclistinner .shead {
        font-size: 16px;
    }

    .priclistinner .mainpri {
        font-size: 20px;
    }

    .priclistinner .pritxt li {
        font-size: 11px;
        padding: 5px 0;
    }

    .priclistinner .dll,
    .priclistinner .savcol,
    .priclistinner .mtxt {
        font-size: 12px;
    }
}

@media screen and (max-width: 768px) {

    .priclist {
        flex-wrap: nowrap;
        overflow-x: auto;
        justify-content: flex-start;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
    }

    .priclistinner {
        flex: 0 0 260px;
        width: 260px;
        min-width: 260px;
        max-width: 260px;
        scroll-snap-align: start;
    }

    .priclist::-webkit-scrollbar {
        height: 4px;
    }

    .priclist::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 2px;
    }

    .priceplan {
        overflow-x: auto;
    }

    .priceplan > li {
        flex-basis: 180px;
        min-width: 180px;
    }

    .pricing-comparison .priceplan > li:first-child {
        flex-basis: 260px;
        min-width: 260px;
    }
}

</style>

@endpush


{{-- ==================== JAVASCRIPT ==================== --}}
@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('pricingForm');
    const selectedPlanInput = document.getElementById('selectedPlan');

    /*
    |--------------------------------------------------------------------------
    | Select Plan
    |--------------------------------------------------------------------------
    */
    function selectPlan(planName) {

        if (!planName) {
            return;
        }

        // Remove active class
        document.querySelectorAll('.priclistinner').forEach(function (card) {
            card.classList.remove('active');
        });

        // Add active class
        const selectedCard = document.querySelector(
            '.priclistinner[data-plan="' + planName + '"]'
        );

        if (selectedCard) {
            selectedCard.classList.add('active');
        }

        // Update hidden input
        selectedPlanInput.value = planName;
    }


    /*
    |--------------------------------------------------------------------------
    | Buy Now Buttons
    |--------------------------------------------------------------------------
    */
    document.querySelectorAll('.buy-plan').forEach(function (button) {

        button.addEventListener('click', function () {

            const planName = this.dataset.plan;

            selectPlan(planName);

            // Submit form after selecting plan
            form.submit();

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Initial Plan
    |--------------------------------------------------------------------------
    */
    const initialPlan = selectedPlanInput.value || 'gold';

    selectPlan(initialPlan);


    /*
    |--------------------------------------------------------------------------
    | Comparison Toggle
    |--------------------------------------------------------------------------
    */
    const comparisonLink = document.getElementById('comparisonLink');
    const comparisonBody = document.getElementById('comparisonBody');
    const comparisonToggle = document.getElementById('comparisonToggle');

    comparisonLink.addEventListener('click', function (event) {

        event.preventDefault();

        const isHidden =
            comparisonBody.style.display === 'none';

        if (isHidden) {

            comparisonBody.style.display = 'block';

            comparisonToggle.classList.remove('plus');
            comparisonToggle.classList.add('minus');

        } else {

            comparisonBody.style.display = 'none';

            comparisonToggle.classList.remove('minus');
            comparisonToggle.classList.add('plus');

        }

    });


    /*
    |--------------------------------------------------------------------------
    | Promo Code
    |--------------------------------------------------------------------------
    */
    const promoButton = document.getElementById('applyPromoBtn');

    promoButton.addEventListener('click', function () {

        const promoInput = document.getElementById('promo_code');
        const promoCode = promoInput.value.trim();
        const promoMessage = document.getElementById('promoMessage');

        if (!promoCode) {

            promoMessage.innerHTML =
                '<span class="text-danger small">Please enter a promo code.</span>';

            promoInput.focus();

            return;
        }

        promoButton.disabled = true;
        promoButton.innerText = 'Checking...';

        fetch('{{-- route("pricing.validate-promo") --}}', {

            method: 'POST',

            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },

            body: JSON.stringify({

                promo_code: promoCode,

                profile_type:
                    document.querySelector(
                        'input[name="profile_type"]:checked'
                    )?.value || 'Business',

                selected_plan:
                    selectedPlanInput.value

            })

        })

        .then(function (response) {

            if (!response.ok) {
                throw new Error('Server returned an error.');
            }

            return response.json();

        })

        .then(function (data) {

            if (data.success) {

                promoMessage.innerHTML =
                    '<span class="text-success small">' +
                    (data.message || 'Promo code applied successfully.') +
                    '</span>';

                /*
                 * If your controller returns updated price information,
                 * update the price here.
                 */

                if (data.redirect) {
                    window.location.href = data.redirect;
                }

            } else {

                promoMessage.innerHTML =
                    '<span class="text-danger small">' +
                    (data.message || 'Invalid promo code.') +
                    '</span>';

            }

        })

        .catch(function (error) {

            console.error(error);

            promoMessage.innerHTML =
                '<span class="text-danger small">' +
                'Unable to validate promo code. Please try again.' +
                '</span>';

        })

        .finally(function () {

            promoButton.disabled = false;
            promoButton.innerText = 'Apply';

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Form Validation
    |--------------------------------------------------------------------------
    */
    form.addEventListener('submit', function (event) {

        let isValid = true;

        const requiredFields = [
            'your_name',
            'mobile_no',
            'email_id',
            'company_name',
            'payment_mode'
        ];

        requiredFields.forEach(function (fieldName) {

            const field =
                document.querySelector(
                    '[name="' + fieldName + '"]'
                );

            if (!field) {
                return;
            }

            if (!field.value.trim()) {

                field.classList.add('is-invalid');

                isValid = false;

            } else {

                field.classList.remove('is-invalid');

            }

        });


        /*
        |--------------------------------------------------------------------------
        | Email Validation
        |--------------------------------------------------------------------------
        */
        const emailField =
            document.getElementById('email_id');

        if (
            emailField &&
            emailField.value.trim() &&
            !emailField.checkValidity()
        ) {

            emailField.classList.add('is-invalid');

            isValid = false;

        }


        /*
        |--------------------------------------------------------------------------
        | Mobile Validation
        |--------------------------------------------------------------------------
        */
        const mobileField =
            document.getElementById('mobile_no');

        if (mobileField && mobileField.value.trim()) {

            const mobile =
                mobileField.value.trim();

            if (!/^[0-9]{10}$/.test(mobile)) {

                mobileField.classList.add('is-invalid');

                isValid = false;

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Profile Type
        |--------------------------------------------------------------------------
        */
        const profileType =
            document.querySelector(
                'input[name="profile_type"]:checked'
            );

        if (!profileType) {

            alert('Please select a profile type.');

            isValid = false;

        }


        /*
        |--------------------------------------------------------------------------
        | Selected Plan
        |--------------------------------------------------------------------------
        */
        if (!selectedPlanInput.value) {

            alert('Please select a plan.');

            isValid = false;

        }


        if (!isValid) {

            event.preventDefault();

            const firstError =
                document.querySelector('.is-invalid');

            if (firstError) {

                firstError.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

                firstError.focus();

            }

        }

    });


    /*
    |--------------------------------------------------------------------------
    | Remove Validation Error While Typing
    |--------------------------------------------------------------------------
    */
    document.querySelectorAll('.form-control').forEach(function (input) {

        input.addEventListener('input', function () {

            if (this.value.trim()) {
                this.classList.remove('is-invalid');
            }

        });

        input.addEventListener('change', function () {

            if (this.value.trim()) {
                this.classList.remove('is-invalid');
            }

        });

    });

});

</script>

@endpush

@endsection