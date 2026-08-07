@extends('layouts.app')

@section('content')
<main id="main" class="minheigh">
    <div class="container bex-main">
        {{-- Breadcrumb --}}
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
                <ul class="brunnar">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>/</li>
                    <li>Create your Business Profile</li>  
                </ul> 
            </div>
        </div>
        
        {{-- Page Header --}}
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
                <h1 class="headblk">Create your Business Profile</h1>
                <p class="statictxt">Create your profile to fulfill all your business requirements with the help of our listings of investors, lenders, mentors, incubators. Share your business information here to receive proposals from all these counter profiles.</p>
            </div>
        </div>

        <div class="row">
            {{-- Main Form Section --}}
            <div class="col-12 col-sm-9 col-md-9 frmmodfy">
                <form 
                    class="frmall" 
                    action="{{--route('business-profiles.store') --}}" 
                    method="POST" 
                    enctype="multipart/form-data"
                >
                    @csrf
                    
                    <div class="frmback">  
                        {{-- =============================== --}}
                        {{-- CONFIDENTIAL INFORMATION SECTION --}}
                        {{-- =============================== --}}
                        <div class="frmcheading">Confidential Information</div>
                        
                        {{-- Your Name Field --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="your_name">
                                Your Name
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input 
                                    type="text" 
                                    name="your_name" 
                                    id="your_name"
                                    class="form-control modysel {{ $errors->has('your_name') ? 'is-invalid' : '' }}" 
                                    placeholder="Enter name" 
                                    value="{{ old('your_name') }}"
                                >
                                @error('your_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Email Field --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="email">
                                Email
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email"
                                    class="form-control modysel {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                    placeholder="Enter Email" 
                                    value="{{ old('email') }}"
                                >
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Mobile No. Field --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="mobile_no">
                                Mobile No.
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input 
                                    type="tel" 
                                    name="mobile_no" 
                                    id="mobile_no"
                                    class="form-control modysel {{ $errors->has('mobile_no') ? 'is-invalid' : '' }}" 
                                    placeholder="Enter Mobile" 
                                    value="{{ old('mobile_no') }}"
                                >
                                @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Company Name Field (Confidential) --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="company_name_confidential">
                                Company Name
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input 
                                    type="text" 
                                    name="company_name_confidential" 
                                    id="company_name_confidential"
                                    class="form-control modysel {{ $errors->has('company_name_confidential') ? 'is-invalid' : '' }}" 
                                    placeholder="Enter Company" 
                                    value="{{ old('company_name_confidential') }}"
                                >
                                @error('company_name_confidential')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- =============================== --}}
                        {{-- ADVERTISEMENT DETAILS SECTION --}}
                        {{-- =============================== --}}
                        <div class="frmcheading marftop">Advertisement Details</div>
                        
                        {{-- Advertisement Headline --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="advertisement_headline">
                                Advertisement Headline
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input 
                                    type="text" 
                                    name="advertisement_headline" 
                                    id="advertisement_headline"
                                    class="form-control modysel {{ $errors->has('advertisement_headline') ? 'is-invalid' : '' }}" 
                                    placeholder="Enter Advertisement Headline" 
                                    value="{{ old('advertisement_headline') }}"
                                >
                                @error('advertisement_headline')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">
                                    Select an industry or a sector in which the company operates. 
                                    E.g. Logistics Services.
                                </span>
                            </div>
                        </div>

                        {{-- Introduction --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="introduction">
                                Introduction
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6"> 
                                <textarea 
                                    name="introduction" 
                                    id="introduction"
                                    class="form-control modysel height70 {{ $errors->has('introduction') ? 'is-invalid' : '' }}"
                                >{{ old('introduction', 'Introduction') }}</textarea>
                                @error('introduction')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">
                                    Select an industry or a sector in which the company operates. 
                                    E.g. Logistics Services.
                                </span>
                            </div>
                        </div>

                        {{-- =============================== --}}
                        {{-- BUSINESS INFORMATION SECTION --}}
                        {{-- =============================== --}}
                        <div class="frmcheading">Business Information</div>
                        
                        {{-- Company Name (Business Info) --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="company_name">
                                Company Name
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input 
                                    type="text" 
                                    name="company_name" 
                                    id="company_name"
                                    class="form-control modysel {{ $errors->has('company_name') ? 'is-invalid' : '' }}"
                                    placeholder="Enter Company Name" 
                                    value="{{ old('company_name') }}"
                                >
                                @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Establishment Year --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="establishment_year">
                                Establishment Year
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <select 
                                    name="establishment_year" 
                                    id="establishment_year"
                                    class="form-control modysel myselectclasscat {{ $errors->has('establishment_year') ? 'is-invalid' : '' }}"
                                >
                                    <option value="" disabled {{ !old('establishment_year') ? 'selected' : '' }}>
                                        Establishment Year
                                    </option>
                                    @for($year = date('Y'); $year >= 1950; $year--)
                                        <option value="{{ $year }}" {{ old('establishment_year') == (string)$year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                                @error('establishment_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Employee Count --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="employee_count">
                                Employee Count
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <select 
                                    name="employee_count" 
                                    id="employee_count"
                                    class="form-control modysel myselectclasscat {{ $errors->has('employee_count') ? 'is-invalid' : '' }}"
                                >
                                    <option value="" disabled {{ !old('employee_count') ? 'selected' : '' }}>
                                        Select Employee Count
                                    </option>
                                    <option value="1-10" {{ old('employee_count') == '1-10' ? 'selected' : '' }}>1-10</option>
                                    <option value="11-50" {{ old('employee_count') == '11-50' ? 'selected' : '' }}>11-50</option>
                                    <option value="51-100" {{ old('employee_count') == '51-100' ? 'selected' : '' }}>51-100</option>
                                    <option value="101-500" {{ old('employee_count') == '101-500' ? 'selected' : '' }}>101-500</option>
                                    <option value="501-1000" {{ old('employee_count') == '501-1000' ? 'selected' : '' }}>501-1000</option>
                                    <option value="1000+" {{ old('employee_count') == '1000+' ? 'selected' : '' }}>1000+</option>
                                </select>
                                @error('employee_count')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Entity Type --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="entity_type">
                                Entity Type
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <select 
                                    name="entity_type" 
                                    id="entity_type"
                                    class="form-control modysel myselectclasscat {{ $errors->has('entity_type') ? 'is-invalid' : '' }}"
                                >
                                    <option value="" disabled {{ !old('entity_type') ? 'selected' : '' }}>
                                        Select Entity Type
                                    </option>
                                    <option value="sole_proprietorship" {{ old('entity_type') == 'sole_proprietorship' ? 'selected' : '' }}>
                                        Sole Proprietorship
                                    </option>
                                    <option value="partnership" {{ old('entity_type') == 'partnership' ? 'selected' : '' }}>
                                        Partnership
                                    </option>
                                    <option value="llp" {{ old('entity_type') == 'llp' ? 'selected' : '' }}>
                                        LLP (Limited Liability Partnership)
                                    </option>
                                    <option value="private_limited" {{ old('entity_type') == 'private_limited' ? 'selected' : '' }}>
                                        Private Limited Company
                                    </option>
                                    <option value="public_limited" {{ old('entity_type') == 'public_limited' ? 'selected' : '' }}>
                                        Public Limited Company
                                    </option>
                                    <option value="other" {{ old('entity_type') == 'other' ? 'selected' : '' }}>
                                        Other
                                    </option>
                                </select>
                                @error('entity_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Business Type --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="business_type">
                                Business Type
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <select 
                                    name="business_type" 
                                    id="business_type"
                                    class="form-control modysel myselectclasscat {{ $errors->has('business_type') ? 'is-invalid' : '' }}"
                                >
                                    <option value="" disabled {{ !old('business_type') ? 'selected' : '' }}>
                                        Select Business Type
                                    </option>
                                    <option value="b2b" {{ old('business_type') == 'b2b' ? 'selected' : '' }}>B2B</option>
                                    <option value="b2c" {{ old('business_type') == 'b2c' ? 'selected' : '' }}>B2C</option>
                                    <option value="c2c" {{ old('business_type') == 'c2c' ? 'selected' : '' }}>C2C</option>
                                    <option value="c2b" {{ old('business_type') == 'c2b' ? 'selected' : '' }}>C2B</option>
                                    <option value="both_b2b_b2c" {{ old('business_type') == 'both_b2b_b2c' ? 'selected' : '' }}>Both B2B & B2C</option>
                                </select>
                                @error('business_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Industry Sector --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="industry_sector">
                                Industry Sector
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <select 
                                    name="industry_sector" 
                                    id="industry_sector"
                                    class="form-control modysel myselectclasscat {{ $errors->has('industry_sector') ? 'is-invalid' : '' }}"
                                >
                                    <option value="" disabled {{ !old('industry_sector') ? 'selected' : '' }}>
                                        Select Industry Sector
                                    </option>
                                    {{-- Populate from config or database --}}
                                    <option value="technology" {{ old('industry_sector') == 'technology' ? 'selected' : '' }}>Technology / IT</option>
                                    <option value="healthcare" {{ old('industry_sector') == 'healthcare' ? 'selected' : '' }}>Healthcare</option>
                                    <option value="finance" {{ old('industry_sector') == 'finance' ? 'selected' : '' }}>Finance / Banking</option>
                                    <option value="manufacturing" {{ old('industry_sector') == 'manufacturing' ? 'selected' : '' }}>Manufacturing</option>
                                    <option value="retail" {{ old('industry_sector') == 'retail' ? 'selected' : '' }}>Retail / E-commerce</option>
                                    <option value="logistics" {{ old('industry_sector') == 'logistics' ? 'selected' : '' }}>Logistics Services</option>
                                    <option value="agriculture" {{ old('industry_sector') == 'agriculture' ? 'selected' : '' }}>Agriculture</option>
                                    <option value="education" {{ old('industry_sector') == 'education' ? 'selected' : '' }}>Education</option>
                                    <option value="real_estate" {{ old('industry_sector') == 'real_estate' ? 'selected' : '' }}>Real Estate</option>
                                    <option value="other" {{ old('industry_sector') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('industry_sector')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">
                                    Select an industry or a sector in which the company operates. 
                                    E.g. Logistics Services.
                                </span>
                            </div>
                        </div>

                        {{-- Business Website --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="business_website">
                                Business Website
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input 
                                    type="url" 
                                    name="business_website" 
                                    id="business_website"
                                    class="form-control modysel {{ $errors->has('business_website') ? 'is-invalid' : '' }}"
                                    placeholder="Enter Website URL" 
                                    value="{{ old('business_website') }}"
                                >
                                @error('business_website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Facilities --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="facilities">
                                Facilities
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6"> 
                                <textarea 
                                    name="facilities" 
                                    id="facilities"
                                    class="form-control modysel height70 {{ $errors->has('facilities') ? 'is-invalid' : '' }}"
                                >{{ old('facilities', 'Facilities') }}</textarea>
                                @error('facilities')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">
                                    Mention the existing facilities of your business. It can be office space / infrastructure / warehouse / equipment / plant and machinery / furniture and fixtures / building and property
                                </span>
                            </div>
                        </div>

                        {{-- =============================== --}}
                        {{-- FINANCIAL DETAILS SECTION --}}
                        {{-- =============================== --}}
                        <div class="frmcheading marftop">Financial details</div>
                        
                        {{-- Annual Sales --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="annual_sales">
                                Annual Sales
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input 
                                    type="text" 
                                    name="annual_sales" 
                                    id="annual_sales"
                                    class="form-control modysel"
                                    placeholder="Enter Annual Sales" 
                                    value="{{ old('annual_sales') }}"
                                >
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">
                                    Enter the total annual sales/revenue figure for your business.
                                </span>
                            </div>
                        </div>

                        {{-- Inventory Value --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="inventory_value">
                                Inventory Value
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input 
                                    type="text" 
                                    name="inventory_value" 
                                    id="inventory_value"
                                    class="form-control modysel"
                                    placeholder="Enter Inventory Value" 
                                    value="{{ old('inventory_value') }}"
                                >
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">
                                    Enter the total value of current inventory/stock.
                                </span>
                            </div>
                        </div>

                        {{-- Gross Income --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="gross_income">
                                Gross Income
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input 
                                    type="text" 
                                    name="gross_income" 
                                    id="gross_income"
                                    class="form-control modysel"
                                    placeholder="Enter Gross Income" 
                                    value="{{ old('gross_income') }}"
                                >
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">
                                    Enter the gross income before deductions.
                                </span>
                            </div>
                        </div>

                        {{-- EBITDA --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="ebitda">
                                EBITDA
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input 
                                    type="text" 
                                    name="ebitda" 
                                    id="ebitda"
                                    class="form-control modysel"
                                    placeholder="Enter EBITDA" 
                                    value="{{ old('ebitda') }}"
                                >
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">
                                    Earnings Before Interest, Taxes, Depreciation, and Amortization.
                                </span>
                            </div>
                        </div>

                        {{-- EBITDA Margin --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="ebitda_margin">
                                EBITDA Margin
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <select 
                                    name="ebitda_margin" 
                                    id="ebitda_margin"
                                    class="form-control modysel myselectclasscat"
                                >
                                    <option value="" disabled {{ !old('ebitda_margin') ? 'selected' : '' }}>
                                        Select EBITDA Margin
                                    </option>
                                    <option value="less_than_5" {{ old('ebitda_margin') == 'less_than_5' ? 'selected' : '' }}>Less than 5%</option>
                                    <option value="5_10" {{ old('ebitda_margin') == '5_10' ? 'selected' : '' }}>5% - 10%</option>
                                    <option value="10_15" {{ old('ebitda_margin') == '10_15' ? 'selected' : '' }}>10% - 15%</option>
                                    <option value="15_20" {{ old('ebitda_margin') == '15_20' ? 'selected' : '' }}>15% - 20%</option>
                                    <option value="20_25" {{ old('ebitda_margin') == '20_25' ? 'selected' : '' }}>20% - 25%</option>
                                    <option value="more_than_25" {{ old('ebitda_margin') == 'more_than_25' ? 'selected' : '' }}>More than 25%</option>
                                </select>
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">
                                    Select the approximate EBITDA margin percentage range.
                                </span>
                            </div>
                        </div>

                        {{-- Rentals --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="rentals">
                                Rentals
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input 
                                    type="text" 
                                    name="rentals" 
                                    id="rentals"
                                    class="form-control modysel"
                                    placeholder="Enter Rentals" 
                                    value="{{ old('rentals') }}"
                                >
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">
                                    Enter monthly/annual rental or lease expenses.
                                </span>
                            </div>
                        </div>

                        {{-- Business / Company Summary --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="company_summary">
                                Describe about the Business / Company Summary
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <textarea 
                                    name="company_summary" 
                                    id="company_summary"
                                    class="form-control modysel height70"
                                >{{ old('company_summary', 'Describe about the Business / Company Summary') }}</textarea>
                            </div>
                        </div>

                        {{-- =============================== --}}
                        {{-- DIRECTOR / CEO / OWNER INFO SECTION --}}
                        {{-- =============================== --}}
                        <div class="frmcheading marftop">Director / CEO / Owner Information</div>
                        
                        {{-- Director Name --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="director_name">
                                Name
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input 
                                    type="text" 
                                    name="director_name" 
                                    id="director_name"
                                    class="form-control modysel"
                                    placeholder="Enter Name" 
                                    value="{{ old('director_name') }}"
                                >
                            </div>
                        </div>

                        {{-- Director Email --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="director_email">
                                Email id
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input 
                                    type="email" 
                                    name="director_email" 
                                    id="director_email"
                                    class="form-control modysel"
                                    placeholder="Enter Email id" 
                                    value="{{ old('director_email') }}"
                                >
                            </div>
                        </div>

                        {{-- Director Designation --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="director_designation">
                                Designation
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <select 
                                    name="director_designation" 
                                    id="director_designation"
                                    class="form-control modysel myselectclasscat"
                                >
                                    <option value="" disabled {{ !old('director_designation') ? 'selected' : '' }}>
                                        Select Designation
                                    </option>
                                    <option value="ceo" {{ old('director_designation') == 'ceo' ? 'selected' : '' }}>CEO</option>
                                    <option value="md" {{ old('director_designation') == 'md' ? 'selected' : '' }}>Managing Director</option>
                                    <option value="director" {{ old('director_designation') == 'director' ? 'selected' : '' }}>Director</option>
                                    <option value="owner" {{ old('director_designation') == 'owner' ? 'selected' : '' }}>Owner</option>
                                    <option value="partner" {{ old('director_designation') == 'partner' ? 'selected' : '' }}>Partner</option>
                                    <option value="cfo" {{ old('director_designation') == 'cfo' ? 'selected' : '' }}>CFO</option>
                                    <option value="coo" {{ old('director_designation') == 'coo' ? 'selected' : '' }}>COO</option>
                                    <option value="other" {{ old('director_designation') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                        </div>

                        {{-- Add Another Member Button --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt"></label> 
                            <div class="d-none d-md-block col-md-1"></div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <button 
                                    type="button" 
                                    id="addMemberBtn" 
                                    class="showme"
                                    onclick="toggleAdditionalMember()"
                                >
                                    <img src="{{ asset('assets/img/addmem.svg') }}" alt="Add Member"> Add Another Member
                                </button>
                            </div>
                        </div>

                        {{-- Additional Member Fields (Hidden by default) --}}
                        <div class="showmebblk" id="additionalMemberFields" style="display:none;">
                            <div class="row marsettop">
                                <label class="col-12 col-sm-6 col-md-4 frmtxt" for="additional_member_name">
                                    Name
                                </label> 
                                <div class="d-none d-md-block col-md-1">:</div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <input 
                                        type="text" 
                                        name="additional_member_name" 
                                        id="additional_member_name"
                                        class="form-control modysel"
                                        placeholder="Enter Name" 
                                        value="{{ old('additional_member_name') }}"
                                    >
                                </div>
                            </div>

                            <div class="row marsettop">
                                <label class="col-12 col-sm-6 col-md-4 frmtxt" for="additional_member_email">
                                    Email id
                                </label> 
                                <div class="d-none d-md-block col-md-1">:</div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <input 
                                        type="email" 
                                        name="additional_member_email" 
                                        id="additional_member_email"
                                        class="form-control modysel"
                                        placeholder="Enter Email id" 
                                        value="{{ old('additional_member_email') }}"
                                    >
                                </div>
                            </div>

                            <div class="row marsettop">
                                <label class="col-12 col-sm-6 col-md-4 frmtxt" for="additional_member_designation">
                                    Designation
                                </label> 
                                <div class="d-none d-md-block col-md-1">:</div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <select 
                                        name="additional_member_designation" 
                                        id="additional_member_designation"
                                        class="form-control modysel myselectclasscat"
                                    >
                                        <option value="" disabled {{ !old('additional_member_designation') ? 'selected' : '' }}>
                                            Select Designation
                                        </option>
                                        <option value="director" {{ old('additional_member_designation') == 'director' ? 'selected' : '' }}>Director</option>
                                        <option value="manager" {{ old('additional_member_designation') == 'manager' ? 'selected' : '' }}>Manager</option>
                                        <option value="vp" {{ old('additional_member_designation') == 'vp' ? 'selected' : '' }}>Vice President</option>
                                        <option value="head" {{ old('additional_member_designation') == 'head' ? 'selected' : '' }}>Head of Department</option>
                                        <option value="other" {{ old('additional_member_designation') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row marsettop">
                                <label class="col-12 col-sm-6 col-md-4 frmtxt"></label> 
                                <div class="d-none d-md-block col-md-1"></div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <button 
                                        type="button" 
                                        id="removeMemberBtn" 
                                        class="showme"
                                        onclick="toggleAdditionalMember()"
                                    >
                                        <img src="{{ asset('assets/img/addmem.svg') }}" alt="Remove Member"> Remove Member
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- =============================== --}}
                        {{-- HEADQUARTERS / LOCATION SECTION --}}
                        {{-- =============================== --}}
                        <div class="frmcheading marftop">Headquarters / Location</div>
                        
                        {{-- Address --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="address">
                                Address
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6"> 
                                <textarea 
                                    name="address" 
                                    id="address"
                                    class="form-control modysel height70 {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                >{{ old('address', 'Address') }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- City --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="city">
                                City
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input 
                                    type="text" 
                                    name="city" 
                                    id="city"
                                    class="form-control modysel"
                                    placeholder="Enter City" 
                                    value="{{ old('city') }}"
                                >
                            </div>
                        </div>

                        {{-- Pin Code --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="pin_code">
                                Pin Code
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input 
                                    type="text" 
                                    name="pin_code" 
                                    id="pin_code"
                                    class="form-control modysel {{ $errors->has('pin_code') ? 'is-invalid' : '' }}"
                                    placeholder="Enter Pin Code" 
                                    value="{{ old('pin_code') }}"
                                >
                                @error('pin_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- =============================== --}}
                        {{-- BUSINESS REQUIREMENTS SECTION --}}
                        {{-- =============================== --}}
                        <div class="frmcheading marftop">Business Requirements</div>
                        
                        {{-- One Line Pitch --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="one_line_pitch">
                                One line pitch for your business
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6"> 
                                <textarea 
                                    name="one_line_pitch" 
                                    id="one_line_pitch"
                                    class="form-control modysel height70 {{ $errors->has('one_line_pitch') ? 'is-invalid' : '' }}"
                                >{{ old('one_line_pitch', 'Sample Pitches: My company, Airto, is developing a web-based social seating check-in platform to help air travelers see who is on board their flight and use Facebook and Linked in to assign all flight seats with one click') }}</textarea>
                                @error('one_line_pitch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">
                                    A catchy one-liner that describes your business value proposition.
                                </span>
                            </div>
                        </div>

                        {{-- Business Photos --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="business_photos">
                                Business Photo 
                                <span class="frmnote">
                                    <strong>Note:</strong> Accepted formats - png, jpeg, gif
                                </span>
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <div class="photobox">
                                    <input 
                                        type="file" 
                                        name="business_photos[]" 
                                        id="business_photos"
                                        class="form-control modysel"
                                        accept=".png,.jpeg,.jpg,.gif"
                                    >
                                </div>
                                <div class="photobox">
                                    <input 
                                        type="file" 
                                        name="business_photos[]" 
                                        class="form-control modysel"
                                        accept=".png,.jpeg,.jpg,.gif"
                                    >
                                </div>
                                <div class="photobox">
                                    <input 
                                        type="file" 
                                        name="business_photos[]" 
                                        class="form-control modysel"
                                        accept=".png,.jpeg,.jpg,.gif"
                                    >
                                </div>
                                
                                <button 
                                    type="button" 
                                    class="showmephoto"
                                    onclick="addPhotoField()"
                                >
                                    <img src="{{ asset('assets/img/pluscircle.svg') }}" alt="Add"> Add Business Photo
                                </button>

                                <div class="photobox stey" id="extraPhotoField" style="display:none;">
                                    <input 
                                        type="file" 
                                        name="business_photos[]" 
                                        class="form-control modysel"
                                        accept=".png,.jpeg,.jpg,.gif"
                                    >
                                </div>
                                <button 
                                    type="button" 
                                    class="showmephoto" 
                                    id="removePhotoBtn"
                                    style="display:none;"
                                    onclick="removePhotoField()"
                                >
                                    <img src="{{ asset('assets/img/pluscircle.svg') }}" alt="Remove"> Remove Business Photo
                                </button>
                            </div>
                        </div>

                        {{-- Business Documents --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="business_documents">
                                Business Documents
                                <span class="frmnote">
                                    <strong>Note:</strong> Accepted formats - Word Document, Excel & PDF
                                </span>
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <div class="photobox">
                                    <input 
                                        type="file" 
                                        name="business_documents[]" 
                                        id="business_documents"
                                        class="form-control modysel"
                                        accept=".doc,.docx,.xls,.xlsx,.pdf"
                                    >
                                </div>
                                <div class="photobox">
                                    <input 
                                        type="file" 
                                        name="business_documents[]" 
                                        class="form-control modysel"
                                        accept=".doc,.docx,.xls,.xlsx,.pdf"
                                    >
                                </div>
                                <div class="photobox">
                                    <input 
                                        type="file" 
                                        name="business_documents[]" 
                                        class="form-control modysel"
                                        accept=".doc,.docx,.xls,.xlsx,.pdf"
                                    >
                                </div>
                                
                                <button 
                                    type="button" 
                                    class="showmedocuments"
                                    onclick="addDocumentField()"
                                >
                                    <img src="{{ asset('assets/img/pluscircle.svg') }}" alt="Add"> Add Business Documents
                                </button>

                                <div class="photobox stey" id="extraDocumentField" style="display:none;">
                                    <input 
                                        type="file" 
                                        name="business_documents[]" 
                                        class="form-control modysel"
                                        accept=".doc,.docx,.xls,.xlsx,.pdf"
                                    >
                                </div>
                                <button 
                                    type="button" 
                                    class="showmedocuments" 
                                    id="removeDocumentBtn"
                                    style="display:none;"
                                    onclick="removeDocumentField()"
                                >
                                    <img src="{{ asset('assets/img/pluscircle.svg') }}" alt="Remove"> Remove Business Document
                                </button>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="row setborder">
                            <button type="submit" class="frmbtn">
                                Submit
                            </button>
                        </div>

                        {{-- Terms Text --}}
                        <div class="termstxt">
                            By Clicking Submit you are Accepting 
                            <a href="{{-- route('terms.conditions') --}}">Terms & Conditions</a>
                        </div>
                    </div>
                </form>
            </div>
            
            {{-- Sidebar --}}
            <div class="col-12 col-sm-3 col-md-3 frmdfy2">
                {{--@include('includes.faqsright')--}}
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script>
// Toggle Additional Member Fields
function toggleAdditionalMember() {
    const additionalFields = document.getElementById('additionalMemberFields');
    const addBtn = document.getElementById('addMemberBtn');
    
    if (additionalFields.style.display === 'none') {
        additionalFields.style.display = 'block';
        addBtn.style.display = 'none';
    } else {
        additionalFields.style.display = 'none';
        addBtn.style.display = 'inline-block';
        // Clear additional member fields
        const inputs = additionalFields.querySelectorAll('input, select');
        inputs.forEach(input => input.value = '');
    }
}

// Add Extra Photo Field
function addPhotoField() {
    document.getElementById('extraPhotoField').style.display = 'block';
    document.getElementById('removePhotoBtn').style.display = 'inline-block';
    event.target.style.display = 'none';
}

// Remove Extra Photo Field
function removePhotoField() {
    document.getElementById('extraPhotoField').style.display = 'none';
    document.getElementById('removePhotoBtn').style.display = 'none';
    
    // Find and show the add button again
    const addButtons = document.querySelectorAll('.showmephoto');
    addButtons.forEach(btn => {
        if (btn.textContent.includes('Add Business Photo')) {
            btn.style.display = 'inline-block';
        }
    });
    
    // Clear the file input
    const fileInput = document.querySelector('#extraPhotoField input[type="file"]');
    if (fileInput) fileInput.value = '';
}

// Add Extra Document Field
function addDocumentField() {
    document.getElementById('extraDocumentField').style.display = 'block';
    document.getElementById('removeDocumentBtn').style.display = 'inline-block';
    event.target.style.display = 'none';
}

// Remove Extra Document Field
function removeDocumentField() {
    document.getElementById('extraDocumentField').style.display = 'none';
    document.getElementById('removeDocumentBtn').style.display = 'none';
    
    // Find and show the add button again
    const addButtons = document.querySelectorAll('.showmedocuments');
    addButtons.forEach(btn => {
        if (btn.textContent.includes('Add Business Documents')) {
            btn.style.display = 'inline-block';
        }
    });
    
    // Clear the file input
    const fileInput = document.querySelector('#extraDocumentField input[type="file"]');
    if (fileInput) fileInput.value = '';
}
</script>
@endpush
@endsection