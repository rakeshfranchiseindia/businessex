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
                    <li>Create your Start-up Profile</li>  
                </ul> 
            </div>
        </div>
        
        {{-- ==================== PAGE HEADER ==================== --}}
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
                <h1 class="headblk">Create your Start-up Profile</h1>
                <p class="statictxt">Create your startup profile to fulfill all your requirements with the help of our listings of investors, lenders, mentors, incubators. Share your startup information here to receive proposals from these counter profiles.</p>
            </div>
        </div>

        {{-- ==================== MAIN CONTENT ROW ==================== --}}
        <div class="row">
            {{-- ========== FORM COLUMN (9 cols) ========== --}}
            <div class="col-12 col-sm-9 col-md-9 frmmodfy">
                <form 
                    class="frmall" 
                    action="{{-- route('startups.store') --}}" 
                    method="POST" 
                    enctype="multipart/form-data"
                >
                    @csrf
                    
                    <div class="frmback">  
                        {{-- ===== CONFIDENTIAL INFORMATION ===== --}}
                        <div class="frmcheading">Confidential Information</div>
                        
                        {{-- Your Name --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="your_name">Your Name</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="text" name="your_name" id="your_name" class="form-control modysel {{ $errors->has('your_name') ? 'is-invalid' : '' }}" placeholder="Enter name" value="{{ old('your_name') }}">
                                @error('your_name')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="email">Email</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="email" name="email" id="email" class="form-control modysel {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Enter Email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Mobile No. --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="mobile_no">Mobile No.</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="text" name="mobile_no" id="mobile_no" class="form-control modysel {{ $errors->has('mobile_no') ? 'is-invalid' : '' }}" placeholder="Enter Mobile" value="{{ old('mobile_no') }}">
                                @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Designation --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="designation">Designation</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="text" name="designation" id="designation" class="form-control modysel {{ $errors->has('designation') ? 'is-invalid' : '' }}" placeholder="Enter Designation" value="{{ old('designation') }}">
                                @error('designation')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- ===== ADVERTISEMENT DETAILS ===== --}}
                        <div class="frmcheading marftop">Advertisement Details</div>
                        
                        {{-- Advertisement Headline --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="advertisement_headline">Advertisement Headline</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="text" name="advertisement_headline" id="advertisement_headline" class="form-control modysel {{ $errors->has('advertisement_headline') ? 'is-invalid' : '' }}" placeholder="Enter Advertisement Headline" value="{{ old('advertisement_headline') }}">
                                @error('advertisement_headline')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">Select an industry or a sector in which the company operates. E.g. Logistics Services.</span>
                            </div>
                        </div>

                        {{-- Introduction --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="introduction">Introduction</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6"> 
                                <textarea name="introduction" id="introduction" class="form-control modysel height70 {{ $errors->has('introduction') ? 'is-invalid' : '' }}">{{ old('introduction', 'Introduction') }}</textarea>
                                @error('introduction')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">Select an industry or a sector in which the company operates. E.g. Logistics Services.</span>
                            </div>
                        </div>

                        {{-- ===== COMPANY INFORMATION ===== --}}
                        <div class="frmcheading">Company Information</div>
                        
                        {{-- Name of Entity --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="name_of_entity">Name of Entity</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="text" name="name_of_entity" id="name_of_entity" class="form-control modysel {{ $errors->has('name_of_entity') ? 'is-invalid' : '' }}" placeholder="Enter Company Name" value="{{ old('name_of_entity') }}">
                                @error('name_of_entity')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Business Type --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="business_type">Business Type</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <select name="business_type" id="business_type" class="form-control modysel myselectclasscat {{ $errors->has('business_type') ? 'is-invalid' : '' }}">
                                    <option disabled hidden selected value="">Select Business Type</option>
                                    <option value="1" {{ old('business_type') == '1' ? 'selected' : '' }}>B2B</option>
                                    <option value="2" {{ old('business_type') == '2' ? 'selected' : '' }}>B2C</option>
                                    <option value="3" {{ old('business_type') == '3' ? 'selected' : '' }}>C2C</option>
                                    <option value="4" {{ old('business_type') == '4' ? 'selected' : '' }}>C2B</option>
                                </select>
                                @error('business_type')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Nature Of Entity --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="nature_of_entity">Nature Of Entity</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <select name="nature_of_entity" id="nature_of_entity" class="form-control modysel myselectclasscat {{ $errors->has('nature_of_entity') ? 'is-invalid' : '' }}">
                                    <option value="">Select Nature Of Entity</option>
                                    {{-- Add options dynamically from controller or config --}}
                                </select>
                                @error('nature_of_entity')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Industry Sector --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="industry_sector">Industry Sector</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <select name="industry_sector" id="industry_sector" class="form-control modysel myselectclasscat {{ $errors->has('industry_sector') ? 'is-invalid' : '' }}">
                                    <option value="">Select Industry Sector</option>
                                    {{-- Add options dynamically --}}
                                </select>
                                @error('industry_sector')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">Select an industry or a sector in which the company operates. E.g. Logistics Services.</span>
                            </div>
                        </div>

                        {{-- Establishment Year --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="establishment_year">Establishment Year</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <select name="establishment_year" id="establishment_year" class="form-control modysel myselectclasscat {{ $errors->has('establishment_year') ? 'is-invalid' : '' }}">
                                    <option value="">Select Establishment Year</option>
                                    @for($year = date('Y'); $year >= 1990; $year--)
                                        <option value="{{ $year }}" {{ old('establishment_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endfor
                                </select>
                                @error('establishment_year')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Number Of Employees --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="number_of_employees">Number Of Employees</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <select name="number_of_employees" id="number_of_employees" class="form-control modysel myselectclasscat {{ $errors->has('number_of_employees') ? 'is-invalid' : '' }}">
                                    <option disabled hidden selected value="">Select Number Of Employees</option>
                                    <option value="1" {{ old('number_of_employees') == '1' ? 'selected' : '' }}>less than 10</option>
                                    <option value="2" {{ old('number_of_employees') == '2' ? 'selected' : '' }}>10-50</option>
                                    <option value="3" {{ old('number_of_employees') == '3' ? 'selected' : '' }}>50-100</option>
                                    <option value="4" {{ old('number_of_employees') == '4' ? 'selected' : '' }}>100-500</option>
                                    <option value="5" {{ old('number_of_employees') == '5' ? 'selected' : '' }}>500-1000</option>
                                    <option value="6" {{ old('number_of_employees') == '6' ? 'selected' : '' }}>more than 1000</option>
                                </select>
                                @error('number_of_employees')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Certification of incorporation --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="certification_incorporation">Certification of incorporation</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="file" name="certification_incorporation" id="certification_incorporation" class="form-control modysel {{ $errors->has('certification_incorporation') ? 'is-invalid' : '' }}" accept=".png,.jpeg,.jpg,.gif">
                                @error('certification_incorporation')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Website --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="website">Website</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="url" name="website" id="website" class="form-control modysel {{ $errors->has('website') ? 'is-invalid' : '' }}" placeholder="Enter the Website" value="{{ old('website') }}">
                                @error('website')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Facilities --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="facilities">Facilities</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6"> 
                                <textarea name="facilities" id="facilities" class="form-control modysel height70">{{ old('facilities', 'Facilities') }}</textarea>
                            </div>
                        </div>

                        {{-- ===== FINANCIAL DETAILS ===== --}}
                        <div class="frmcheading marftop">Financial details</div>
                        
                        {{-- Annual Sales --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="annual_sales">Annual Sales</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="text" name="annual_sales" id="annual_sales" class="form-control modysel" placeholder="Enter Annual Sales" value="{{ old('annual_sales') }}">
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">Enter the annual sales figure for your company.</span>
                            </div>
                        </div>

                        {{-- Inventory Value --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="inventory_value">Inventory Value</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="text" name="inventory_value" id="inventory_value" class="form-control modysel" placeholder="Enter Inventory Value" value="{{ old('inventory_value') }}">
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">Enter the total inventory value.</span>
                            </div>
                        </div>

                        {{-- Gross Income --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="gross_income">Gross Income</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="text" name="gross_income" id="gross_income" class="form-control modysel" placeholder="Enter Gross Income" value="{{ old('gross_income') }}">
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">Enter the gross income amount.</span>
                            </div>
                        </div>

                        {{-- EBITDA --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="ebitda">EBITDA</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="text" name="ebitda" id="ebitda" class="form-control modysel" placeholder="Enter EBITDA" value="{{ old('ebitda') }}">
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">Earnings Before Interest, Taxes, Depreciation, and Amortization.</span>
                            </div>
                        </div>

                        {{-- EBITDA Margin --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="ebitda_margin">EBITDA Margin</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <select name="ebitda_margin" id="ebitda_margin" class="form-control modysel myselectclasscat">
                                    <option value="">Select EBITDA Margin</option>
                                    {{-- Add options dynamically --}}
                                </select>
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">Select the EBITDA margin percentage range.</span>
                            </div>
                        </div>

                        {{-- Rentals --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="rentals">Rentals</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="text" name="rentals" id="rentals" class="form-control modysel" placeholder="Enter Rentals" value="{{ old('rentals') }}">
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">Enter rental/lease expenses.</span>
                            </div>
                        </div>

                        {{-- ===== SOCIAL MEDIA LINKS ===== --}}
                        <div class="frmcheading marftop">Social media links</div>
                        
                        {{-- Facebook --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="facebook_url">Facebook</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6 pos">
                                <input type="url" name="facebook_url" id="facebook_url" class="form-control modysel" placeholder="Enter URL" value="{{ old('facebook_url') }}">
                                <i class="fab fa-facebook-f"></i>
                            </div>
                        </div>

                        {{-- Twitter --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="twitter_url">Twitter</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6 pos">
                                <input type="url" name="twitter_url" id="twitter_url" class="form-control modysel" placeholder="Enter URL" value="{{ old('twitter_url') }}">
                                <i class="fab fa-twitter"></i>
                            </div>
                        </div>

                        {{-- LinkedIn --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="linkedin_url">Linkedin</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6 pos">
                                <input type="url" name="linkedin_url" id="linkedin_url" class="form-control modysel" placeholder="Enter URL" value="{{ old('linkedin_url') }}">
                                <i class="fab fa-linkedin-in"></i>
                            </div>
                        </div>

                        {{-- ===== HEADQUARTERS / LOCATION ===== --}}
                        <div class="frmcheading marftop">Headquarters / Location</div>
                        
                        {{-- Address --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="address">Address</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6"> 
                                <textarea name="address" id="address" class="form-control modysel height70 {{ $errors->has('address') ? 'is-invalid' : '' }}">{{ old('address', 'Address') }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- City --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="city">City</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="text" name="city" id="city" class="form-control modysel" placeholder="Enter City" value="{{ old('city') }}">
                            </div>
                        </div>

                        {{-- Pin Code --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="pin_code">Pin Code</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="text" name="pin_code" id="pin_code" class="form-control modysel {{ $errors->has('pin_code') ? 'is-invalid' : '' }}" placeholder="Enter Pin Code" value="{{ old('pin_code') }}">
                                @error('pin_code')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- ===== DIRECTOR / CEO / OWNER INFO ===== --}}
                        <div class="frmcheading marftop">Director / CEO / Owner Information</div>
                        
                        {{-- Director Name --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="director_name">Name</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="text" name="director_name" id="director_name" class="form-control modysel" placeholder="Enter Name" value="{{ old('director_name') }}">
                            </div>
                        </div>

                        {{-- Director Email --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="director_email">Email id</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="email" name="director_email" id="director_email" class="form-control modysel" placeholder="Enter Email id" value="{{ old('director_email') }}">
                            </div>
                        </div>

                        {{-- Director Designation --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="director_designation">Designation</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <select name="director_designation" id="director_designation" class="form-control modysel myselectclasscat">
                                    <option value="">Select Designation</option>
                                    {{-- Add options dynamically --}}
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            
        </div>
        

                        {{-- ===== MANAGEMENT TEAM INFO ===== --}}
                        @include('includes.groupcompany')
                        @include('includes.newsletter')
                        @include('includes.categorylinkfooter')
                    @endsection
