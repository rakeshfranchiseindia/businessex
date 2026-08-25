@extends('layouts.app')

@section('content')
<main id="main" class="minheigh">
    <div class="container bex-main">
        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
                    action="{{ route('register.create-business') }}" 
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
                        {{-- Designation Field --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="designation">
                                Designation
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <select
                                    name="designation"
                                    id="designation"
                                    class="form-control modysel myselectclasscat {{ $errors->has('designation') ? 'is-invalid' : '' }}"
                                >
                                    <option value="" disabled {{ !old('designation') ? 'selected' : '' }}>
                                        Select Designation
                                    </option>
                                    @foreach(config('constants.designationinf') as $key => $value)
                                        <option value="{{ $key }}" {{ old('designation') == (string) $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('designation')
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
                                    @foreach(config('constants.employeeCount') as $key => $value)
                                        <option value="{{ $key }}" {{ old('employee_count') == (string) $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
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
                                    @foreach(config('constants.businessEntity') as $key => $value)
                                        <option value="{{ $key }}" {{ old('entity_type') == (string) $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
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
                                    @foreach(config('constants.businessType') as $key => $value)
                                        <option value="{{ $key }}" {{ old('business_type') == (string) $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
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
                                    @foreach($industrySeller ?? [] as $sector)
                                        <option value="{{ $sector['subIndustryid'] ?? $sector['industry_sector'] ?? $sector['subindustry'] }}" {{ old('industry_sector') == (string) ($sector['subIndustryid'] ?? $sector['industry_sector'] ?? $sector['subindustry']) ? 'selected' : '' }}>
                                            {{ $sector['subindustry'] ?? $sector['industry'] ?? 'Industry' }}
                                        </option>
                                    @endforeach
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

                         {{-- Business / Company Summary --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="company_summary_financial">
                                Describe about the Business / Company Summary
                            </label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <textarea 
                                    name="company_summary_financial" 
                                    id="company_summary_financial"
                                    class="form-control modysel height70 {{ $errors->has('company_summary_financial') ? 'is-invalid' : '' }}"
                                    placeholder="Describe about the Business / Company Summary"
                                >{{ old('company_summary_financial') }}</textarea>
                                @error('company_summary_financial')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                                
                                <input 
                                    type="text" 
                                    name="ebitda_margin" 
                                    id="ebitda_margin"
                                    class="form-control modysel"
                                    placeholder="Enter EBITDA Margin" 
                                    value="{{ old('ebitda_margin') }}"
                                >
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

                       

                        {{-- =============================== --}}
                        {{-- MANAGEMENT TEAM INFORMATION SECTION --}}
                        {{-- =============================== --}}
                        <div class="frmcheading marftop">Management Team Information</div>

                        <div class="management-team-wrap">
                            <div class="management-team-row management-team-header">
                                <div class="management-team-col">
                                    <label>Name</label>
                                </div>
                                <div class="management-team-col">
                                    <label>Designation</label>
                                </div>
                                <div class="management-team-col">
                                    <label>Email ID</label>
                                </div>
                                <div class="management-team-action"></div>
                            </div>

                            <div class="management-team-row">
                                <div class="management-team-col">
                                    <input type="text" name="team_name[]" class="form-control modysel" placeholder="Enter Name">
                                </div>
                                <div class="management-team-col">
                                    <input type="text" name="team_designation[]" class="form-control modysel" placeholder="Enter Designation">
                                </div>
                                <div class="management-team-col">
                                    <input type="email" name="team_email[]" class="form-control modysel" placeholder="Enter Email ID">
                                </div>
                                <div class="management-team-action">
                                    <button type="button" class="team-action-btn add-team-member" aria-label="Add member">+</button>
                                </div>
                            </div>

                            <div id="teamMemberExtra" class="management-team-extra" style="display:none;">
                                <div class="management-team-row">
                                    <div class="management-team-col">
                                        <input type="text" name="team_name[]" class="form-control modysel" placeholder="Enter Name">
                                    </div>
                                    <div class="management-team-col">
                                        <input type="text" name="team_designation[]" class="form-control modysel" placeholder="Enter Designation">
                                    </div>
                                    <div class="management-team-col">
                                        <input type="email" name="team_email[]" class="form-control modysel" placeholder="Enter Email ID">
                                    </div>
                                    <div class="management-team-action">
                                        <button type="button" class="team-action-btn remove-team-member" aria-label="Remove member">×</button>
                                    </div>
                                </div>
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
                                    @foreach(config('constants.designationinf') as $key => $value)
                                        <option value="{{ $key }}" {{ old('director_designation') == (string) $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Add Another Member Button --}}
                        {{--<div class="row marsettop">
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
                        </div>--}}

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

                            {{--<div class="row marsettop">
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
                            </div> --}}
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
                                <select name="city" id="city" class="form-control modysel">
                                    <option value="">Select City</option>
                                    @foreach(collect($locations ?? [])->groupBy('state')->sortKeys() as $stateName => $cities)
                                        <optgroup label="{{ stateDisplayName($stateName) }}">
                                            @foreach($cities as $cityOption)
                                                <option value="{{ $cityOption->city }}" {{ old('city') === $cityOption->city ? 'selected' : '' }}>{{ $cityOption->city }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
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
                                    inputmode="numeric"
                                    pattern="[0-9]{6}"
                                    maxlength="6"
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

                        <div class="business-requirements-wrap">
                            {{-- I am looking for Checkboxes --}}
                            <div class="row marsettop">
                                <label class="col-12 col-sm-6 col-md-4 frmtxt" for="looking_for">
                                    I am looking for
                                </label>
                                <div class="d-none d-md-block col-md-1">:</div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="looking-for-options">
                                        <label class="check-item"><input type="checkbox" name="seeking_investors" value="1" id="seeking_investors" class="requirement-checkbox"> <span>Investors for My business</span></label>
                                        <label class="check-item"><input type="checkbox" name="seeking_loan" value="1" id="seeking_loan" class="requirement-checkbox"> <span>Loan for my business</span></label>
                                        <label class="check-item"><input type="checkbox" name="seeking_incubators" value="1" id="seeking_incubators" class="requirement-checkbox"> <span>Incubators for My business</span></label>
                                        <label class="check-item"><input type="checkbox" name="seeking_buyers" value="1" id="seeking_buyers" class="requirement-checkbox"> <span>Buyers for My business</span></label>
                                        <label class="check-item"><input type="checkbox" name="seeking_mentors" value="1" id="seeking_mentors" class="requirement-checkbox"> <span>Mentorship for My business</span></label>
                                    </div>
                                </div>
                            </div>

                            {{-- FOR INVESTORS SECTION --}}
                            <div id="investors-section" class="conditional-section" style="display:none; background: #f7f7f7; padding: 20px; margin: 20px 0; border-radius: 4px;">
                                <div class="section-heading" style="font-weight: 600; font-size: 16px; margin-bottom: 15px; border-bottom: 1px solid #dfdfdf; padding-bottom: 10px;">For Partial Business Sale (investors)</div>
                                
                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt">Amount of investment you are looking for</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <input type="text" name="inv_asking_price" class="form-control modysel" placeholder="Enter Amount">
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt">Business stake of the investment</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <div style="display: flex; gap: 10px;">
                                            <input type="text" name="inv_stake" class="form-control modysel" placeholder="Enter Stake" style="flex: 1;">
                                            <span style="flex: 0 0 auto; display: flex; align-items: center; padding: 0 10px;">%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt">Reason for investment</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <textarea name="inv_reason" class="form-control modysel height70" placeholder="Enter Reason for investment"></textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- FOR LOAN SECTION --}}
                            <div id="loan-section" class="conditional-section" style="display:none; background: #f7f7f7; padding: 20px; margin: 20px 0; border-radius: 4px;">
                                <div class="section-heading" style="font-weight: 600; font-size: 16px; margin-bottom: 15px; border-bottom: 1px solid #dfdfdf; padding-bottom: 10px;">For Business Loan</div>
                                
                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt">Loan amount you are looking for</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <input type="text" name="loan_amount" class="form-control modysel" placeholder="Enter Loan Amount">
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt">Repayment period</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <input type="text" name="loan_repayment_period" class="form-control modysel" placeholder="Enter Repayment Period">
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt">Expected interest rate</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <input type="text" name="loan_interest_rate" class="form-control modysel" placeholder="Enter Interest Rate">
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt">Any existing loans</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <textarea name="loan_existing" class="form-control modysel height70" placeholder="Describe existing loans if any"></textarea>
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt">Reason for loan</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <textarea name="loan_reason" class="form-control modysel height70" placeholder="Enter Reason for loan"></textarea>
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt">Collateral details</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <textarea name="loan_collateral_details" class="form-control modysel height70" placeholder="Describe collateral details"></textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- FOR BUYERS SECTION --}}
                            <div id="buyers-section" class="conditional-section" style="display:none; background: #f7f7f7; padding: 20px; margin: 20px 0; border-radius: 4px;">
                                <div class="section-heading" style="font-weight: 600; font-size: 16px; margin-bottom: 15px; border-bottom: 1px solid #dfdfdf; padding-bottom: 10px;">For Business Sale</div>
                                
                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt">Selling price</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <input type="text" name="buyer_sell_price" class="form-control modysel" placeholder="Enter Selling Price">
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt">Reason for selling</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <textarea name="buyer_sell_reason" class="form-control modysel height70" placeholder="Enter Reason for selling"></textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- FOR INCUBATORS SECTION --}}
                            <div id="incubators-section" class="conditional-section" style="display:none; background: #f7f7f7; padding: 20px; margin: 20px 0; border-radius: 4px;">
                                <div class="section-heading" style="font-weight: 600; font-size: 16px; margin-bottom: 15px; border-bottom: 1px solid #dfdfdf; padding-bottom: 10px;">For Incubation Support</div>
                                
                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt">Incubation requirements</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <textarea name="accel_req_details" class="form-control modysel height70" placeholder="Describe your incubation requirements"></textarea>
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt">Expected investment from incubator</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <input type="text" name="accel_inv_req" class="form-control modysel" placeholder="Enter Expected Investment">
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt">Time period for incubation</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <input type="text" name="accel_time_period" class="form-control modysel" placeholder="Enter Time Period">
                                    </div>
                                </div>
                            </div>

                            {{-- FOR MENTORS SECTION --}}
                            <div id="mentors-section" class="conditional-section" style="display:none; background: #f7f7f7; padding: 20px; margin: 20px 0; border-radius: 4px;">
                                <div class="section-heading" style="font-weight: 600; font-size: 16px; margin-bottom: 15px; border-bottom: 1px solid #dfdfdf; padding-bottom: 10px;">For Mentorship</div>
                                
                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt">Mentorship requirements</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <textarea name="mentor_req_details" class="form-control modysel height70" placeholder="Describe your mentorship requirements"></textarea>
                                    </div>
                                </div>
                            </div>

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
                                        <input type="file" name="business_photos[]" class="form-control modysel" accept=".png,.jpeg,.jpg,.gif">
                                    </div>
                                    <div class="photobox">
                                        <input type="file" name="business_photos[]" class="form-control modysel" accept=".png,.jpeg,.jpg,.gif">
                                    </div>
                                    <div class="photobox">
                                        <input type="file" name="business_photos[]" class="form-control modysel" accept=".png,.jpeg,.jpg,.gif">
                                    </div>
                                    <div class="photobox">
                                        <input type="file" name="business_photos[]" class="form-control modysel" accept=".png,.jpeg,.jpg,.gif">
                                    </div>
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
                                        <input type="file" name="business_documents[]" class="form-control modysel" accept=".doc,.docx,.xls,.xlsx,.pdf">
                                    </div>
                                    <div class="photobox">
                                        <input type="file" name="business_documents[]" class="form-control modysel" accept=".doc,.docx,.xls,.xlsx,.pdf">
                                    </div>
                                    <div class="photobox">
                                        <input type="file" name="business_documents[]" class="form-control modysel" accept=".doc,.docx,.xls,.xlsx,.pdf">
                                    </div>
                                    <div class="photobox">
                                        <input type="file" name="business_documents[]" class="form-control modysel" accept=".doc,.docx,.xls,.xlsx,.pdf">
                                    </div>
                                </div>
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
                @include('includes.faqsright')
            </div>
        </div>
    </div>
</main>
  @include('includes.groupcompany')
  @include('includes.newsletter')
  @include('includes.categorylinkfooter')
@include('includes.google-location-autocomplete')

@push('scripts')
<script>
window.addEventListener('DOMContentLoaded', function () {
    // Handle Team Member Management
    const addTeamBtn = document.querySelector('.add-team-member');
    const extraMemberBlock = document.getElementById('teamMemberExtra');

    if (addTeamBtn && extraMemberBlock) {
        addTeamBtn.addEventListener('click', function () {
            extraMemberBlock.style.display = 'block';
            addTeamBtn.closest('.management-team-action').style.display = 'none';
        });
    }

    document.addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('remove-team-member')) {
            const row = event.target.closest('.management-team-row');
            if (row) {
                row.querySelectorAll('input').forEach(function (input) {
                    input.value = '';
                });
            }
            extraMemberBlock.style.display = 'none';
            const mainAction = document.querySelector('.add-team-member').closest('.management-team-action');
            if (mainAction) {
                mainAction.style.display = 'flex';
            }
        }
    });

    // Handle Business Requirements Conditional Sections
    const checkboxes = document.querySelectorAll('.requirement-checkbox');
    const sections = {
        'seeking_investors': 'investors-section',
        'seeking_loan': 'loan-section',
        'seeking_buyers': 'buyers-section',
        'seeking_incubators': 'incubators-section',
        'seeking_mentors': 'mentors-section'
    };

    function updateSections() {
        checkboxes.forEach(checkbox => {
            const sectionId = sections[checkbox.id];
            if (sectionId) {
                const section = document.getElementById(sectionId);
                if (section) {
                    section.style.display = checkbox.checked ? 'block' : 'none';
                }
            }
        });
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSections);
    });

    // Initialize on page load
    updateSections();
});
</script>
@endpush
@endsection