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
            <div class="alert alert-danger mt-3" role="alert">
                <strong>Please correct the highlighted fields.</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
                    action="{{route('register.create-startup') }}" 
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
                                <input type="tel" name="mobile_no" id="mobile_no" class="form-control modysel {{ $errors->has('mobile_no') ? 'is-invalid' : '' }}" placeholder="Enter Mobile" value="{{ old('mobile_no') }}" inputmode="numeric" pattern="[0-9]{10}" maxlength="10">
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
                                <textarea name="introduction" id="introduction" class="form-control modysel height70 {{ $errors->has('introduction') ? 'is-invalid' : '' }}" minlength="25" maxlength="255">{{ old('introduction') }}</textarea>
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
                                    @foreach(config('constants.businessType') as $key => $value)
                                        <option value="{{ $key }}" {{ old('business_type') == (string) $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
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
                                    @foreach(config('constants.businessEntity') as $key => $value)
                                        <option value="{{ $key }}" {{ old('nature_of_entity') == (string) $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
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
                                    @foreach($industrySeller ?? [] as $sector)
                                        <option value="{{ $sector['subIndustryid'] ?? $sector['industry_sector'] ?? $sector['subindustry'] }}" {{ old('industry_sector') == (string) ($sector['subIndustryid'] ?? $sector['industry_sector'] ?? $sector['subindustry']) ? 'selected' : '' }}>
                                            {{ $sector['subindustry'] ?? $sector['industry'] ?? 'Industry' }}
                                        </option>
                                    @endforeach
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
                                    @foreach(config('constants.employeeCount') as $key => $value)
                                        <option value="{{ $key }}" {{ old('number_of_employees') == (string) $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
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
                                <textarea name="facilities" id="facilities" class="form-control modysel height70 {{ $errors->has('facilities') ? 'is-invalid' : '' }}" minlength="25" maxlength="55">{{ old('facilities') }}</textarea>
                                @error('facilities')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- Company Summary --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="company_summary">Company Summary</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <textarea 
                                    name="company_summary" 
                                    id="company_summary" 
                                    class="form-control modysel height70 {{ $errors->has('company_summary') ? 'is-invalid' : '' }}" 
                                    placeholder="Enter Company Summary"
                                >{{ old('company_summary') }}</textarea>
                                @error('company_summary')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        {{-- ===== FINANCIAL DETAILS ===== --}}
                        <div class="frmcheading marftop">Financial details</div>
                        
                        {{-- Annual Sales --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt" for="annual_sales">Annual Sales</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="number" name="annual_sales" id="annual_sales" class="form-control modysel {{ $errors->has('annual_sales') ? 'is-invalid' : '' }}" placeholder="Enter Annual Sales" value="{{ old('annual_sales') }}" step="1">
                                @error('annual_sales')<span class="invalid-feedback d-block" role="alert">{{ $message }}</span>@enderror
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
                                <input type="number" name="inventory_value" id="inventory_value" class="form-control modysel {{ $errors->has('inventory_value') ? 'is-invalid' : '' }}" placeholder="Enter Inventory Value" value="{{ old('inventory_value') }}" step="1">
                                @error('inventory_value')<span class="invalid-feedback d-block" role="alert">{{ $message }}</span>@enderror
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
                                <input type="number" name="gross_income" id="gross_income" class="form-control modysel {{ $errors->has('gross_income') ? 'is-invalid' : '' }}" placeholder="Enter Gross Income" value="{{ old('gross_income') }}" step="1">
                                @error('gross_income')<span class="invalid-feedback d-block" role="alert">{{ $message }}</span>@enderror
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
                                <input type="number" name="ebitda" id="ebitda" class="form-control modysel {{ $errors->has('ebitda') ? 'is-invalid' : '' }}" placeholder="Enter EBITDA" value="{{ old('ebitda') }}" step="1">
                                @error('ebitda')<span class="invalid-feedback d-block" role="alert">{{ $message }}</span>@enderror
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
                                
                                <input type="number" name="ebitda_margin" id="ebitda_margin" class="form-control modysel {{ $errors->has('ebitda_margin') ? 'is-invalid' : '' }}" placeholder="Enter EBITDA Margin" value="{{ old('ebitda_margin') }}" step="1">
                                @error('ebitda_margin')<span class="invalid-feedback d-block" role="alert">{{ $message }}</span>@enderror
                                
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
                                <input type="number" name="rentals" id="rentals" class="form-control modysel {{ $errors->has('rentals') ? 'is-invalid' : '' }}" placeholder="Enter Rentals" value="{{ old('rentals') }}" step="1">
                                @error('rentals')<span class="invalid-feedback d-block" role="alert">{{ $message }}</span>@enderror
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
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="pin_code">Pin Code</label> 
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <input type="text" name="pin_code" id="pin_code" class="form-control modysel {{ $errors->has('pin_code') ? 'is-invalid' : '' }}" placeholder="Enter Pin Code" value="{{ old('pin_code') }}" inputmode="numeric" pattern="[0-9]{6}" maxlength="6">
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
                                    @foreach(config('constants.designationinf') as $key => $value)
                                        <option value="{{ $key }}" {{ old('director_designation') == (string) $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
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

                            {{-- First Team Member Row --}}
                            <div class="management-team-row">
                                <div class="management-team-col">
                                    <input type="text" name="team_member_name[]" class="form-control modysel team-name-input" placeholder="Enter Name" value="{{ old('team_member_name.0') }}">
                                </div>
                                <div class="management-team-col">
                                    <input type="text" name="team_member_designation[]" class="form-control modysel team-designation-input" placeholder="Enter Designation" value="{{ old('team_member_designation.0') }}">
                                </div>
                                <div class="management-team-col">
                                    <input type="email" name="team_member_email[]" class="form-control modysel team-email-input" placeholder="Enter Email ID" value="{{ old('team_member_email.0') }}">
                                </div>
                                <div class="management-team-action">
                                    <button type="button" class="team-action-btn add-team-member" aria-label="Add member">+</button>
                                </div>
                            </div>

                            {{-- Container for additional team members --}}
                            <div id="teamMembersContainer"></div>
                        </div>

                        {{-- ===== BUSINESS PLAN ===== --}}
                        <div class="frmcheading marftop">Business Plan</div>

                        {{-- Company Stage --}}
                        <div class="row marsettop">
                            <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="company_stage">Select your Company Stage</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <select name="company_stage" id="company_stage" class="form-control modysel myselectclasscat {{ $errors->has('company_stage') ? 'is-invalid' : '' }}">
                                    <option value="">Select your Company stage</option>
                                    @foreach(config('constants.companyStage') as $key => $value)
                                        <option value="{{ $key }}" {{ old('company_stage') == (string) $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('company_stage')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

{{-- Customer Problem & Solution --}}
<div class="row marsettop">
    <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="customer_problem_solution">Customer Problem & Solution</label>
    <div class="d-none d-md-block col-md-1">:</div>
    <div class="col-12 col-sm-6 col-md-6">
        <textarea name="customer_problem_solution" id="customer_problem_solution" class="form-control modysel height70 {{ $errors->has('customer_problem_solution') ? 'is-invalid' : '' }}" placeholder="Describe the problem and your solution">{{ old('customer_problem_solution') }}</textarea>
        @error('customer_problem_solution')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>
</div>

{{-- Start-up Product / Service --}}
<div class="row marsettop">
    <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="startup_product">Start-up's Product / Service</label>
    <div class="d-none d-md-block col-md-1">:</div>
    <div class="col-12 col-sm-6 col-md-6">
        <textarea name="startup_product" id="startup_product" class="form-control modysel height70 {{ $errors->has('startup_product') ? 'is-invalid' : '' }}" placeholder="Describe your product or service">{{ old('startup_product') }}</textarea>
        @error('startup_product')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>
</div>

{{-- Target Customer Segment --}}
<div class="row marsettop">
    <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="target_customer_segment">Target Customer Segment</label>
    <div class="d-none d-md-block col-md-1">:</div>
    <div class="col-12 col-sm-6 col-md-6">
        <textarea name="target_customer_segment" id="target_customer_segment" class="form-control modysel height70 {{ $errors->has('target_customer_segment') ? 'is-invalid' : '' }}" placeholder="Describe your target customers">{{ old('target_customer_segment') }}</textarea>
        @error('target_customer_segment')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>
</div>

{{-- Target Market --}}
<div class="row marsettop">
    <label class="col-12 col-sm-6 col-md-4 frmtxt mandatory" for="target_market">Target Market</label>
    <div class="d-none d-md-block col-md-1">:</div>
    <div class="col-12 col-sm-6 col-md-6">
        <textarea name="target_market" id="target_market" class="form-control modysel height70 {{ $errors->has('target_market') ? 'is-invalid' : '' }}" placeholder="Describe your target market">{{ old('target_market') }}</textarea>
        @error('target_market')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>
</div>

{{-- Competitors --}}
<div class="row marsettop">
    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="competitors">Competitors</label>
    <div class="d-none d-md-block col-md-1">:</div>
    <div class="col-12 col-sm-6 col-md-6">
        <textarea name="competitors" id="competitors" class="form-control modysel height70" placeholder="Mention your competitors">{{ old('competitors') }}</textarea>
    </div>
</div>

{{-- Competitive Advantage --}}
<div class="row marsettop">
    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="competitive_advantage">Competitive Advantage</label>
    <div class="d-none d-md-block col-md-1">:</div>
    <div class="col-12 col-sm-6 col-md-6">
        <textarea name="competitive_advantage" id="competitive_advantage" class="form-control modysel height70" placeholder="Mention your competitive advantage">{{ old('competitive_advantage') }}</textarea>
    </div>
</div>

{{-- Sales & Marketing Strategy --}}
<div class="row marsettop">
    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="sales_marketing_strategy">Sales & Marketing Strategy</label>
    <div class="d-none d-md-block col-md-1">:</div>
    <div class="col-12 col-sm-6 col-md-6">
        <textarea name="sales_marketing_strategy" id="sales_marketing_strategy" class="form-control modysel height70" placeholder="Describe your marketing strategy">{{ old('sales_marketing_strategy') }}</textarea>
    </div>
</div>

                {{-- Fund Raising Information --}}
                <div class="row marsettop align-items-center">
                    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="funding_round">Fund raising information</label>
                    <div class="d-none d-md-block col-md-1">:</div>
                    <div class="col-12 col-sm-6 col-md-6 d-flex align-items-center gap-3">
                        <select name="funding_round" id="funding_round" class="form-control modysel myselectclasscat" style="flex:1; min-width: 180px;">
                            <option value="">Round of funding</option>
                            <option value="seed">Seed</option>
                            <option value="series_a">Series A</option>
                            <option value="series_b">Series B</option>
                            <option value="series_c">Series C</option>
                            <option value="pre_seed">Pre-Seed</option>
                            <option value="bootstrapped">Bootstrapped</option>
                        </select>
                        <input type="text" name="investment_amount" id="investment_amount" class="form-control modysel" style="flex:1; min-width: 180px;" placeholder="Investment amount" value="{{ old('investment_amount') }}">
                        <button type="button" class="btn btn-dark rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; padding: 0; border: 0; font-size: 18px; line-height: 1;" aria-label="Information">
                            <span>i</span>
                        </button>
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
                                        <label class="check-item"><input type="checkbox" name="seeking_investors" value="1" id="seeking_investors" class="requirement-checkbox" data-target="investors-section"> <span>Investors for My business</span></label>
                                        <label class="check-item"><input type="checkbox" name="seeking_loan" value="1" id="seeking_loan" class="requirement-checkbox" data-target="loan-section"> <span>Loan for my business</span></label>
                                        <label class="check-item"><input type="checkbox" name="seeking_incubators" value="1" id="seeking_incubators" class="requirement-checkbox" data-target="incubators-section"> <span>Incubators for My business</span></label>
                                        <label class="check-item"><input type="checkbox" name="seeking_buyers" value="1" id="seeking_buyers" class="requirement-checkbox" data-target="buyers-section"> <span>Buyers for My business</span></label>
                                        <label class="check-item"><input type="checkbox" name="seeking_mentors" value="1" id="seeking_mentors" class="requirement-checkbox" data-target="mentors-section"> <span>Mentorship for My business</span></label>
                                    </div>
                                </div>
                            </div>

                            {{-- FOR INVESTORS SECTION --}}
                            <div id="investors-section" class="conditional-section" style="display:none; background: #f7f7f7; padding: 20px; margin: 20px 0; border-radius: 4px;">
                                <div class="section-heading" style="font-weight: 600; font-size: 16px; margin-bottom: 15px; border-bottom: 1px solid #dfdfdf; padding-bottom: 10px;">For Partial Business Sale (investors)</div>
                                
                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="investor_investment_amount">Amount of investment you are looking for</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <input type="text" name="investor_investment_amount" id="investor_investment_amount" class="form-control modysel" placeholder="Enter Amount" value="{{ old('investor_investment_amount') }}">
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="investor_business_stake">Business stake of the investment</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <div style="display: flex; gap: 10px;">
                                            <input type="text" name="investor_business_stake" id="investor_business_stake" class="form-control modysel" placeholder="Enter Stake" style="flex: 1;" value="{{ old('investor_business_stake') }}">
                                            <span style="flex: 0 0 auto; display: flex; align-items: center; padding: 0 10px;">%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="investor_investment_reason">Reason for investment</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <textarea name="investor_investment_reason" id="investor_investment_reason" class="form-control modysel height70" placeholder="Enter Reason for investment">{{ old('investor_investment_reason') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- FOR LOAN SECTION --}}
                            <div id="loan-section" class="conditional-section" style="display:none; background: #f7f7f7; padding: 20px; margin: 20px 0; border-radius: 4px;">
                                <div class="section-heading" style="font-weight: 600; font-size: 16px; margin-bottom: 15px; border-bottom: 1px solid #dfdfdf; padding-bottom: 10px;">For Business Loan</div>
                                
                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="loan_amount">Loan amount you are looking for</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <input type="text" name="loan_amount" id="loan_amount" class="form-control modysel" placeholder="Enter Loan Amount" value="{{ old('loan_amount') }}">
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="loan_repayment_period">Repayment period</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <input type="text" name="loan_repayment_period" id="loan_repayment_period" class="form-control modysel" placeholder="Enter Repayment Period" value="{{ old('loan_repayment_period') }}">
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="loan_interest_rate">Expected interest rate</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <input type="text" name="loan_interest_rate" id="loan_interest_rate" class="form-control modysel" placeholder="Enter Interest Rate" value="{{ old('loan_interest_rate') }}">
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="loan_existing_details">Any existing loans</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <textarea name="loan_existing_details" id="loan_existing_details" class="form-control modysel height70" placeholder="Describe existing loans if any">{{ old('loan_existing_details') }}</textarea>
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="loan_reason">Reason for loan</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <textarea name="loan_reason" id="loan_reason" class="form-control modysel height70" placeholder="Enter Reason for loan">{{ old('loan_reason') }}</textarea>
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="loan_collateral_details">Collateral details</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <textarea name="loan_collateral_details" id="loan_collateral_details" class="form-control modysel height70" placeholder="Describe collateral details">{{ old('loan_collateral_details') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- FOR BUYERS SECTION --}}
                            <div id="buyers-section" class="conditional-section" style="display:none; background: #f7f7f7; padding: 20px; margin: 20px 0; border-radius: 4px;">
                                <div class="section-heading" style="font-weight: 600; font-size: 16px; margin-bottom: 15px; border-bottom: 1px solid #dfdfdf; padding-bottom: 10px;">For Business Sale</div>
                                
                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="buyer_selling_price">Selling price</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <input type="text" name="buyer_selling_price" id="buyer_selling_price" class="form-control modysel" placeholder="Enter Selling Price" value="{{ old('buyer_selling_price') }}">
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="buyer_selling_reason">Reason for selling</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <textarea name="buyer_selling_reason" id="buyer_selling_reason" class="form-control modysel height70" placeholder="Enter Reason for selling">{{ old('buyer_selling_reason') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- FOR INCUBATORS SECTION --}}
                            <div id="incubators-section" class="conditional-section" style="display:none; background: #f7f7f7; padding: 20px; margin: 20px 0; border-radius: 4px;">
                                <div class="section-heading" style="font-weight: 600; font-size: 16px; margin-bottom: 15px; border-bottom: 1px solid #dfdfdf; padding-bottom: 10px;">For Incubation Support</div>
                                
                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="incubator_requirements">Incubation requirements</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <textarea name="incubator_requirements" id="incubator_requirements" class="form-control modysel height70" placeholder="Describe your incubation requirements">{{ old('incubator_requirements') }}</textarea>
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="incubator_expected_investment">Expected investment from incubator</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <input type="text" name="incubator_expected_investment" id="incubator_expected_investment" class="form-control modysel" placeholder="Enter Expected Investment" value="{{ old('incubator_expected_investment') }}">
                                    </div>
                                </div>

                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="incubator_time_period">Time period for incubation</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <input type="text" name="incubator_time_period" id="incubator_time_period" class="form-control modysel" placeholder="Enter Time Period" value="{{ old('incubator_time_period') }}">
                                    </div>
                                </div>
                            </div>

                            {{-- FOR MENTORS SECTION --}}
                            <div id="mentors-section" class="conditional-section" style="display:none; background: #f7f7f7; padding: 20px; margin: 20px 0; border-radius: 4px;">
                                <div class="section-heading" style="font-weight: 600; font-size: 16px; margin-bottom: 15px; border-bottom: 1px solid #dfdfdf; padding-bottom: 10px;">For Mentorship</div>
                                
                                <div class="row marsettop">
                                    <label class="col-12 col-sm-6 col-md-4 frmtxt" for="mentor_requirements">Mentorship requirements</label>
                                    <div class="d-none d-md-block col-md-1">:</div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <textarea name="mentor_requirements" id="mentor_requirements" class="form-control modysel height70" placeholder="Describe your mentorship requirements">{{ old('mentor_requirements') }}</textarea>
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
        

                        {{-- ===== MANAGEMENT TEAM INFO ===== --}}
                        @include('includes.groupcompany')
                        @include('includes.newsletter')
                        @include('includes.categorylinkfooter')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle collapse/expand functionality for "I am looking for" checkboxes
    const checkboxes = document.querySelectorAll('.requirement-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const targetId = this.dataset.target;
            const targetSection = document.getElementById(targetId);
            
            if (targetSection) {
                if (this.checked) {
                    // Show section with animation
                    targetSection.style.display = 'block';
                    targetSection.style.animation = 'fadeIn 0.3s ease-in';
                } else {
                    // Hide section
                    targetSection.style.display = 'none';
                }
            }
        });
    });

    // Management Team Add/Remove functionality
    const addTeamMemberBtn = document.querySelector('.add-team-member');
    const container = document.getElementById('teamMembersContainer');
    let memberCount = 1;

    function createTeamMemberRow() {
        const rowHTML = `
            <div class="management-team-row">
                <div class="management-team-col">
                    <input type="text" name="team_member_name[]" class="form-control modysel team-name-input" placeholder="Enter Name">
                </div>
                <div class="management-team-col">
                    <input type="text" name="team_member_designation[]" class="form-control modysel team-designation-input" placeholder="Enter Designation">
                </div>
                <div class="management-team-col">
                    <input type="email" name="team_member_email[]" class="form-control modysel team-email-input" placeholder="Enter Email ID">
                </div>
                <div class="management-team-action">
                    <button type="button" class="team-action-btn remove-team-member" aria-label="Remove member">×</button>
                </div>
            </div>
        `;
        return rowHTML;
    }

    if (addTeamMemberBtn) {
        addTeamMemberBtn.addEventListener('click', function(e) {
            e.preventDefault();
            memberCount++;
            container.insertAdjacentHTML('beforeend', createTeamMemberRow());
            attachRemoveListener();
        });
    }

    function attachRemoveListener() {
        const removeButtons = document.querySelectorAll('.remove-team-member');
        removeButtons.forEach(btn => {
            btn.onclick = function(e) {
                e.preventDefault();
                this.closest('.management-team-row').remove();
                memberCount--;
            };
        });
    }

    // Initial attach for any pre-existing remove buttons
    attachRemoveListener();
});

// Add fade-in animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);

const validationErrors = @json($errors->messages());
Object.entries(validationErrors).forEach(([fieldName, messages]) => {
    const arrayFieldName = fieldName.replace(/\.\d+$/, '[]');
    const field = document.querySelector(`[name="${fieldName}"], [name="${arrayFieldName}"]`);

    if (!field) {
        return;
    }

    field.classList.add('is-invalid');
    const fieldContainer = field.closest('.col-12, .management-team-col') || field.parentElement;

    if (!fieldContainer.querySelector('.invalid-feedback')) {
        const feedback = document.createElement('span');
        feedback.className = 'invalid-feedback d-block';
        feedback.setAttribute('role', 'alert');
        feedback.textContent = messages[0];
        fieldContainer.appendChild(feedback);
    }

    const conditionalSection = field.closest('.conditional-section');
    if (conditionalSection) {
        conditionalSection.style.display = 'block';
    }
});
</script>
@include('includes.google-location-autocomplete')
                    @endsection
