@extends('layouts.app')

@section('content')
<main id="main" class="minheigh">
    <div class="container bex-main">
        {{-- ==================== BREADCRUMB ==================== --}}
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
                <ul class="brunnar">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>/</li>
                    <li>Pricing</li>  
                </ul> 
            </div>
        </div>

        {{-- ==================== PAGE HEADER ==================== --}}
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
                <h1 class="headblk">Choose a Plan</h1>
                <p class="statictxt">Create your profile & find the correct solution for your business</p>
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

            {{-- ===== PROFILE TYPE SELECTION ===== --}}
            <div class="pestion">
                <div class="prtxt">Profile Type:</div>
                <div class="lineval">
                    <div class="radio-item">
                        <input 
                            type="radio" 
                            id="ritema" 
                            name="profile_type" 
                            value="Business" 
                            {{ old('profile_type', 'Business') == 'Business' ? 'checked' : '' }}
                        >
                        <label for="ritema">Business</label>
                    </div>

                    <div class="radio-item">
                        <input 
                            type="radio" 
                            id="id3" 
                            name="profile_type" 
                            value="Startup"
                            {{ old('profile_type') == 'Startup' ? 'checked' : '' }}
                        >
                        <label for="id3">Startup</label>
                    </div>

                    <div class="radio-item">
                        <input 
                            type="radio" 
                            id="id4" 
                            name="profile_type" 
                            value="Investor"
                            {{ old('profile_type') == 'Investor' ? 'checked' : '' }}
                        >
                        <label for="id4">Investor</label>
                    </div>

                    <div class="radio-item">
                        <input 
                            type="radio" 
                            id="ritemb" 
                            name="profile_type" 
                            value="Mentor"
                            {{ old('profile_type') == 'Mentor' ? 'checked' : '' }}
                        >
                        <label for="ritemb">Mentor</label>
                    </div>
                </div> 
            </div>
            @error('profile_type')
                <span class="text-danger d-block mb-2">{{ $message }}</span>
            @enderror

            {{-- ===== USER INFO ROW (Name & Mobile) ===== --}}
            <div class="row marsettop">
                {{-- Your Name Field --}}
                <div class="col-12 col-sm-6 col-md-6 modfy1">
                    <div class="row">
                        <label class="col-12 col-sm-6 col-md-3 frmtxt mandatory" for="your_name">
                            Your Name
                        </label> 
                        <div class="d-none d-md-block col-md-1">:</div>
                        <div class="col-12 col-sm-6 col-md-8">
                            <input 
                                type="text" 
                                name="your_name" 
                                id="your_name"
                                class="form-control modysel {{ $errors->has('your_name') ? 'is-invalid' : '' }}" 
                                placeholder="Enter name"
                                value="{{ old('your_name') }}"
                            >
                            @error('your_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Mobile No. Field --}}
                <div class="col-12 col-sm-6 col-md-6 modfy2">
                    <div class="row">
                        <label class="col-12 col-sm-6 col-md-3 frmtxt mandatory" for="mobile_no">
                            Mobile No.
                        </label> 
                        <div class="d-none d-md-block col-md-1">:</div>
                        <div class="col-12 col-sm-6 col-md-8">
                            <input 
                                type="tel" 
                                name="mobile_no" 
                                id="mobile_no"
                                class="form-control modysel {{ $errors->has('mobile_no') ? 'is-invalid' : '' }}" 
                                placeholder="Enter Mobile"
                                value="{{ old('mobile_no') }}"
                            >
                            @error('mobile_no')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== USER INFO ROW (Email & Company) ===== --}}
            <div class="row marsettop">
                {{-- Email Field --}}
                <div class="col-12 col-sm-6 col-md-6 modfy1">
                    <div class="row">
                        <label class="col-12 col-sm-6 col-md-3 frmtxt mandatory" for="email_id">
                            Email id
                        </label> 
                        <div class="d-none d-md-block col-md-1">:</div>
                        <div class="col-12 col-sm-6 col-md-8">
                            <input 
                                type="email" 
                                name="email_id" 
                                id="email_id"
                                class="form-control modysel {{ $errors->has('email_id') ? 'is-invalid' : '' }}" 
                                placeholder="Enter Email id"
                                value="{{ old('email_id') }}"
                            >
                            @error('email_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Company Name Field --}}
                <div class="col-12 col-sm-6 col-md-6 modfy2">
                    <div class="row">
                        <label class="col-12 col-sm-6 col-md-3 frmtxt mandatory" for="company_name">
                            Company Name
                        </label> 
                        <div class="d-none d-md-block col-md-1">:</div>
                        <div class="col-12 col-sm-6 col-md-8">
                            <input 
                                type="text" 
                                name="company_name" 
                                id="company_name"
                                class="form-control modysel {{ $errors->has('company_name') ? 'is-invalid' : '' }}" 
                                placeholder="Enter Company Name"
                                value="{{ old('company_name') }}"
                            >
                            @error('company_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== PAYMENT INFO ROW (Promo Code & Payment Mode) ===== --}}
            <div class="row marsettop">
                {{-- Promo Code Field --}}
                <div class="col-12 col-sm-6 col-md-6 modfy1">
                    <div class="row">
                        <label class="col-12 col-sm-6 col-md-3 frmtxt" for="promo_code">
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
                            <button type="button" class="alybtn" onclick="applyPromoCode()">
                                Apply
                            </button>
                            @if(session('promo_error'))
                                <span class="text-danger small d-block mt-1">{{ session('promo_error') }}</span>
                            @endif
                            @if(session('promo_success'))
                                <span class="text-success small d-block mt-1">{{ session('promo_success') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Payment Mode Field --}}
                <div class="col-12 col-sm-6 col-md-6 modfy2">
                    <div class="row">
                        <label class="col-12 col-sm-6 col-md-3 frmtxt mandatory" for="payment_mode">
                            Payment Mode
                        </label> 
                        <div class="d-none d-md-block col-md-1">:</div>
                        <div class="col-12 col-sm-6 col-md-8">
                            <select 
                                name="payment_mode" 
                                id="payment_mode"
                                class="form-control myselectclasscat {{ $errors->has('payment_mode') ? 'is-invalid' : '' }}" 
                                required
                            >
                                <option disabled hidden selected value="">Select Payment Mode</option>
                                <option value="OPTCRDC" {{ old('payment_mode') == 'OPTCRDC' ? 'selected' : '' }}>Credit Card</option>
                                <option value="OPTDBCRD" {{ old('payment_mode') == 'OPTDBCRD' ? 'selected' : '' }}>Debit Card</option>
                                <option value="OPTNBK" {{ old('payment_mode') == 'OPTNBK' ? 'selected' : '' }}>Net Banking</option>
                                <option value="Paytm" {{ old('payment_mode') == 'Paytm' ? 'selected' : '' }}>Paytm</option>
                                <option value="UPI" {{ old('payment_mode') == 'UPI' ? 'selected' : '' }}>UPI</option>
                            </select>
                            @error('payment_mode')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- ==================== PRICING CARDS ==================== --}}
            <div class="priclist">
                
                {{-- Hidden field for selected plan --}}
                <input type="hidden" name="selected_plan" id="selectedPlan" value="{{ old('selected_plan', 'gold') }}">

                {{-- ========== BASIC PLAN ========== --}}
                <div class="priclistinner" data-plan="basic">
                    <div class="inhieght"> 
                        <div class="shead">Basic</div>
                        <del class="dll"><i class="fas fa-rupee-sign"></i> 1000</del>
                        
                        <div class="mainpri">
                            <i class="fas fa-rupee-sign"></i> 500 
                            <span>(+18% GST)</span>
                        </div>
                        
                        <div class="savcol">
                            <i class="fas fa-rupee-sign"></i> 500 Savings
                        </div>
                    </div>
                    
                    <ul class="pritxt">
                        <li><i class="fas fa-check-circle text-success"></i> Profile Listing</li> 
                        <li><i class="fas fa-check-circle text-success"></i> Continuous Email Support</li>
                        <li><i class="fas fa-check-circle text-success"></i> Accept Unlimited Investment Proposals from genuine users registered with BusinessEx</li>
                    </ul>

                    <div class="bntls">
                        <button 
                            type="submit" 
                            class="btnpric" 
                            onclick="selectPlan('basic')"
                        >
                            Buy Now
                        </button> 
                    </div>
                </div>

                {{-- ========== PREMIUM PLAN ========== --}}
                <div class="priclistinner" data-plan="premium">
                    <div class="inhieght"> 
                        <div class="shead">Premium</div>
                        <del class="dll"><i class="fas fa-rupee-sign"></i> 9,999</del>
                        
                        <div class="mainpri">
                            <i class="fas fa-rupee-sign"></i> 6,999 
                            <span>(+18% GST)</span>
                        </div>
                        
                        <div class="savcol">
                            <i class="fas fa-rupee-sign"></i> 3000 Savings
                        </div>
                        
                        <div class="mtxt">3 months</div>
                    </div>
                    
                    <ul class="pritxt">
                        <li><i class="fas fa-check-circle text-success"></i> Speedy Profile Activation</li> 
                        <li><i class="fas fa-check-circle text-success"></i> Continuous Email Support</li>
                        <li><i class="fas fa-check-circle text-success"></i> Reach out to 50 Business Buyers/Investors registered with BusinessEx, based on your business requirement.</li>
                        <li><i class="fas fa-check-circle text-success"></i> Accept Unlimited Investment Proposals from genuine Business Buyers/Investors registered with BusinessEx.</li>
                    </ul>

                    <div class="bntls">
                        <button 
                            type="submit" 
                            class="btnpric" 
                            onclick="selectPlan('premium')"
                        >
                            Buy Now
                        </button> 
                    </div>
                </div>

                {{-- ========== GOLD PLAN (RECOMMENDED) ========== --}}
                <div class="priclistinner active" data-plan="gold">
                    <div class="topset">
                        <div class="shbbtxt">Most Recommended</div>
                    </div>

                    <div class="inhieght"> 
                        <div class="shead">Gold</div>
                        <del class="dll"><i class="fas fa-rupee-sign"></i> 15,999</del>
                        
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
                        <li><i class="fas fa-check-circle text-success"></i> Speedy Profile Activation</li> 
                        <li><i class="fas fa-check-circle text-success"></i> Continuous Email Support</li>
                        <li><i class="fas fa-check-circle text-success"></i> Reach out to 50 Business Buyers/Investors registered with BusinessEx, based on your business requirement.</li>
                        <li><i class="fas fa-check-circle text-success"></i> Accept Unlimited Investment Proposals from genuine Business Buyers/Investors registered with BusinessEx.</li>
                    </ul>

                    <div class="bntls">
                        <button 
                            type="submit" 
                            class="btnpric" 
                            onclick="selectPlan('gold')"
                        >
                            Buy Now
                        </button> 
                    </div>
                </div>

                {{-- ========== PLATINUM PLAN ========== --}}
                <div class="priclistinner" data-plan="platinum">
                    <div class="inhieght"> 
                        <div class="shead">Platinum</div>
                        <del class="dll"><i class="fas fa-rupee-sign"></i> 19,999</del>
                        
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
                        <li><i class="fas fa-check-circle text-success"></i> Speedy Profile Activation</li> 
                        <li><i class="fas fa-check-circle text-success"></i> Continuous Email Support</li>
                        <li><i class="fas fa-check-circle text-success"></i> Reach out to 50 Business Buyers/Investors registered with BusinessEx, based on your business requirement.</li>
                        <li><i class="fas fa-check-circle text-success"></i> Accept Unlimited Investment Proposals from genuine Business Buyers/Investors registered with BusinessEx.</li>
                    </ul>

                    <div class="bntls">
                        <button 
                            type="submit" 
                            class="btnpric" 
                            onclick="selectPlan('platinum')"
                        >
                            Buy Now
                        </button> 
                    </div>
                </div>

            </div>

            {{-- ==================== PLAN COMPARISON TABLE ==================== --}}
            <div class="feblkcontainer">
                <div class="feblk_head"> 
                    <a href="#" onclick="toggleComparison(event)">
                        Full Plan Comparison
                    </a> 
                    <span class="cirplusminus minus" id="comparisonToggle"></span>
                </div>

                <div class="feblk_body" id="comparisonBody" style="display: block;">
                    <ul class="priceplan"> 
                        {{-- Feature Headers Row --}}
                        <li>
                            <div class="reghead tleft">Plan Features</div>
                            <div class="iconblk htset tleft">Unlock unlimited investment proposals</div>
                            <div class="iconblk htset tleft">Real time information</div>
                            <div class="iconblk htset tleft">Profile promotions</div>
                            <div class="iconblk htset tleft">Dedicated marketing campaign for promotion</div>
                            <div class="iconblk htset tleft">Assignment of a Key Account Manager</div>
                            <div class="iconblk htset tleft">Top Profiles for your requirement</div>
                            <div class="iconblk htset tleft">Monthly Reports</div>
                            <div class="iconblk htset tleft">Recommendation</div>
                            <div class="iconblk htset tleft">Accelerated Marketing</div>
                            <div class="iconblk htset tleft">Certified Business Valuation Report</div>
                        </li>

                        {{-- Basic Plan Features --}}
                        <li>
                            <div class="reghead">Basic</div>
                            <div class="iconblk htset"> <i class="fas fa-minus text-muted"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-minus text-muted"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-minus text-muted"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-minus text-muted"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-minus text-muted"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-minus text-muted"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-minus text-muted"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-minus text-muted"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-minus text-muted"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-minus text-muted"></i> </div>
                        </li>

                        {{-- Premium Plan Features --}}
                        <li>
                            <div class="reghead">Premium</div>
                            <div class="iconblk htset"><div class="pvalue">10</div></div>
                            <div class="iconblk htset"><i class="fas fa-check text-success"></i></div>
                            <div class="iconblk htset"><i class="fas fa-check text-success"></i></div>
                            <div class="iconblk htset"><i class="fas fa-check text-success"></i></div>
                            <div class="iconblk htset"> <i class="fas fa-minus text-muted"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-minus text-muted"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-minus text-muted"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-minus text-muted"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-minus text-muted"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-minus text-muted"></i> </div>
                        </li>

                        {{-- Gold Plan Features --}}
                        <li>
                            <div class="reghead">Gold</div>
                            <div class="iconblk htset"><div class="pvalue">20</div></div>
                            <div class="iconblk htset"><i class="fas fa-check text-success"></i></div>
                            <div class="iconblk htset"><i class="fas fa-check text-success"></i></div>
                            <div class="iconblk htset"><i class="fas fa-check text-success"></i></div>
                            <div class="iconblk htset"> <i class="fas fa-check text-success"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-check text-success"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-check text-success"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-check text-success"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-minus text-muted"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-minus text-muted"></i> </div>
                        </li>

                        {{-- Platinum Plan Features --}}
                        <li>
                            <div class="reghead">Platinum</div>
                            <div class="iconblk htset"><div class="pvalue">30</div></div>
                            <div class="iconblk htset"><i class="fas fa-check text-success"></i></div>
                            <div class="iconblk htset"><i class="fas fa-check text-success"></i></div>
                            <div class="iconblk htset"><i class="fas fa-check text-success"></i></div>
                            <div class="iconblk htset"> <i class="fas fa-check text-success"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-check text-success"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-check text-success"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-check text-success"></i> </div>
                            <div class="iconblk htset"> <i class="fas fa-check text-success"></i> </div>
                            <div class="iconblk htset"> <div class="pvalue">Upto 10,000 Marketing Emails</div></div>
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

@push('styles')
<style>
    /* ========== FORCE ALL CARDS IN SINGLE ROW - IMPORTANT ========== */
.priclist {
    display: flex !important;
    flex-direction: row !important;
    flex-wrap: nowrap !important;      /* CRITICAL: No wrapping allowed */
    gap: 15px !important;
    overflow-x: auto !important;       /* Scroll horizontally if needed */
    justify-content: center !important;
    align-items: stretch !important;   /* Make all cards same height */
    padding: 10px 0 !important;
    width: 100% !important;
}

/* Force each card to fit within available space */
.priclistinner {
    flex: 0 1 auto !important;         /* Don't grow, allow shrink */
    min-width: 0 !important;           /* Remove min-width constraint */
    max-width: 25% !important;         /* Max 25% = 4 cards per row exactly */
    width: calc(25% - 12px) !important; /* Calculate exact width minus gap */
    
    /* Ensure content doesn't overflow */
    overflow: hidden !important;
    
    /* Keep existing styles */
    transition: all 0.3s ease;
    cursor: pointer;
}

/* Make internal elements responsive */
.priclistinner .inhieght,
.priclistinner .pritxt,
.priclistinner .bntls {
    width: 100% !important;
    box-sizing: border-box !important;
    padding: 10px !important;
}

/* Reduce font sizes slightly on smaller screens */
@media screen and (max-width: 1200px) {
    .priclistinner {
        max-width: 25% !important;
        width: calc(25% - 12px) !important;
    }
    
    .priclistinner .shead {
        font-size: 18px !important;
    }
    
    .priclistinner .mainpri {
        font-size: 22px !important;
    }
    
    .priclistinner .pritxt li {
        font-size: 12px !important;
        line-height: 1.4 !important;
    }
}

/* Tablet - Still keep single row with smaller text */
@media screen and (max-width: 992px) {
    .priclistinner {
        max-width: 25% !important;
        width: calc(25% - 10px) !important;
    }
    
    .priclistinner .shead {
        font-size: 16px !important;
    }
    
    .priclistinner .mainpri {
        font-size: 20px !important;
    }
    
    .priclistinner .pritxt li {
        font-size: 11px !important;
        padding: 5px 0 !important;
    }
    
    .priclistinner .dll,
    .priclistinner .savcol,
    .priclistinner .mtxt {
        font-size: 12px !important;
    }
}

/* Mobile - Horizontal scroll or smaller cards */
@media screen and (max-width: 768px) {
    .priclist {
        flex-wrap: nowrap !important;
        overflow-x: auto !important;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
    }
    
    .priclistinner {
        flex: 0 0 auto !important;
        min-width: 260px !important;
        max-width: 260px !important;
        width: 260px !important;
        scroll-snap-align: start;
    }
    
    /* Hide scrollbar for cleaner look */
    .priclist::-webkit-scrollbar {
        height: 4px;
    }
    
    .priclist::-webkit-scrollbar-thumb {
        background: rgba(0,0,0,0.2);
        border-radius: 2px;
    }
}
    
    .btnpric {
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    .btnpric:hover {
        opacity: 0.9;
    }
    
    /* Comparison table styles */
    .priceplan li {
        display: flex;
        align-items: center;
        border-bottom: 1px solid #eee;
    }
    
    .priceplan li:hover {
        background-color: #f8f9fa;
    }
    
    .reghead {
        font-weight: bold;
        min-width: 120px;
    }
    
    .iconblk {
        flex: 1;
        text-align: center;
        padding: 10px;
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
</style>
@endpush

@push('scripts')
<script>
// ==========================================
// PRICING PAGE JAVASCRIPT FUNCTIONALITY
// ==========================================

/**
 * Select a plan and update hidden input
 */
function selectPlan(planName) {
    // Remove active class from all cards
    document.querySelectorAll('.priclistinner').forEach(card => {
        card.classList.remove('active');
    });
    
    // Add active class to selected card
    const selectedCard = document.querySelector(`[data-plan="${planName}"]`);
    if (selectedCard) {
        selectedCard.classList.add('active');
    }
    
    // Update hidden input value
    document.getElementById('selectedPlan').value = planName;
    
    // Scroll to top of form
    document.getElementById('pricingForm').scrollIntoView({ behavior: 'smooth' });
}

/**
 * Toggle comparison table visibility
 */
function toggleComparison(event) {
    event.preventDefault();
    
    const body = document.getElementById('comparisonBody');
    const toggle = document.getElementById('comparisonToggle');
    
    if (body.style.display === 'none') {
        body.style.display = 'block';
        toggle.classList.remove('plus');
        toggle.classList.add('minus');
    } else {
        body.style.display = 'none';
        toggle.classList.remove('minus');
        toggle.classList.add('plus');
    }
}

/**
 * Apply promo code via AJAX
 */
function applyPromoCode() {
    const promoInput = document.getElementById('promo_code');
    const promoCode = promoInput.value.trim();
    
    if (!promoCode) {
        alert('Please enter a promo code');
        return;
    }
    
    // AJAX call to validate promo code
    fetch('{{--route("pricing.validate-promo") --}}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            promo_code: promoCode,
            profile_type: document.querySelector('input[name="profile_type"]:checked')?.value || 'Business'
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message - you can also update prices here
            alert(data.message || 'Promo code applied successfully!');
            
            // Optionally reload to show updated prices or update DOM directly
            if (data.redirect) {
                window.location.href = data.redirect;
            }
        } else {
            alert(data.message || 'Invalid promo code');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while validating the promo code.');
    });
}

/**
 * Initialize on page load
 */
document.addEventListener('DOMContentLoaded', function() {
    // Set initial active state based on hidden input
    const initialPlan = document.getElementById('selectedPlan').value;
    if (initialPlan) {
        selectPlan(initialPlan);
    }
    
    // Form validation before submit
    document.getElementById('pricingForm').addEventListener('submit', function(e) {
        // Validate required fields
        const requiredFields = ['your_name', 'mobile_no', 'email_id', 'company_name', 'payment_mode'];
        let isValid = true;
        
        requiredFields.forEach(fieldName => {
            const field = document.querySelector(`[name="${fieldName}"]`);
            if (field && !field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else if (field) {
                field.classList.remove('is-invalid');
            }
        });
        
        // Check profile type selection
        const profileTypeSelected = document.querySelector('input[name="profile_type"]:checked');
        if (!profileTypeSelected) {
            alert('Please select a profile type');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            // Scroll to first error
            const firstError = document.querySelector('.is-invalid');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
        }
    });
    
    // Real-time validation on input
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
        
        // Remove error on focus
        input.addEventListener('focus', function() {
            this.classList.remove('is-invalid');
        });
    });
});
</script>
@endpush
@endsection