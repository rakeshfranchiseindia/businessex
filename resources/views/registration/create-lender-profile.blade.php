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

        <div class="row">
            <div class="col-12">
                <ul class="brunnar">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>/</li>
                    <li>Lender Registration</li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h1 class="headblk">Create your Lender Profile</h1>
                <p class="statictxt">
                    Create your Lender profile and surf through our listings of startups and businesses from all across India in multiple industries to invest into or buy completely. Fill in your investment preferences for suitable businesses and startups to connect with you.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-9 col-md-9 frmmodfy">
                <form class="frmall" method="POST" action="{{ route('register.create-lender') }}" enctype="multipart/form-data">
                    @csrf
                    @auth
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    @endauth

                    <div class="frmback">
                        <div class="frmcheading">Confidential Information</div>

                        <!-- Name -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory" for="name">Your Name</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="name" id="name" class="form-control modysel {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Enter name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Mobile -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory" for="mobile">Mobile No.</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="tel" name="mobile" id="mobile" class="form-control modysel {{ $errors->has('mobile') ? 'is-invalid' : '' }}" placeholder="Enter Mobile" value="{{ old('mobile') }}" inputmode="numeric" pattern="[0-9]{10}" maxlength="10" required>
                                @error('mobile')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory" for="email">Email</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="email" name="email" id="email" class="form-control modysel {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Enter Email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory" for="location">Location</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="location" id="location" class="form-control modysel {{ $errors->has('location') ? 'is-invalid' : '' }}" placeholder="Select Location from Google" value="{{ old('location') }}" data-google-location data-place-id-field="#lender_location_place_id" required>
                                <input type="hidden" name="location_place_id" id="lender_location_place_id" value="{{ old('location_place_id') }}">
                                @error('location')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="frmcheading marftop">Advertisement Details</div>

                        <!-- Headline -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory" for="advertisement_headline">Advertisement Headline</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="advertisement_headline" id="advertisement_headline" class="form-control modysel {{ $errors->has('advertisement_headline') ? 'is-invalid' : '' }}" placeholder="Enter Advertisement Headline" value="{{ old('advertisement_headline') }}" minlength="25" maxlength="255" required>
                                @error('advertisement_headline')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Introduction -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory" for="introduction">Introduction</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <textarea name="introduction" id="introduction" class="form-control modysel height70 {{ $errors->has('introduction') ? 'is-invalid' : '' }}" placeholder="Introduction" minlength="25" maxlength="255" required>{{ old('introduction') }}</textarea>
                                @error('introduction')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="frmcheading">Profile Details</div>

                        <!-- Lender Type -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Lender Type</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <select name="lender_type" id="lender_type" class="form-control myselectclasscat {{ $errors->has('lender_type') ? 'is-invalid' : '' }}" required>
                                    <option value="" disabled {{ old('lender_type') ? '' : 'selected' }}>Select Lender Type</option>
                                    <option value="Private Lender" {{ old('lender_type') == 'Private Lender' ? 'selected' : '' }}>Private Lender</option>
                                    <option value="NBFC Personnel" {{ old('lender_type') == 'NBFC Personnel' ? 'selected' : '' }}>NBFC Personnel</option>
                                </select>
                                @error('lender_type')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Occupation -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt" for="occupation">Occupation</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <textarea name="occupation" id="occupation" class="form-control modysel height70 {{ $errors->has('occupation') ? 'is-invalid' : '' }}" placeholder="Enter Your Occupation">{{ old('occupation') }}</textarea>
                                @error('occupation')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Lending Interest Rate -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt" for="lending_interest_rate">Lending Interest Rate</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <div style="display: flex; gap: 10px;">
                                    <input type="number" name="lending_interest_rate" id="lending_interest_rate" class="form-control modysel {{ $errors->has('lending_interest_rate') ? 'is-invalid' : '' }}" placeholder="Enter Lending Interest Rate" step="0.01" min="0" max="100" value="{{ old('lending_interest_rate') }}">
                                    <span style="flex: 0 0 auto; display: flex; align-items: center; padding: 0 10px;">%</span>
                                </div>
                                @error('lending_interest_rate')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Sector Preference -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt" for="sector_preference">Sector Preference</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="sector_preference" id="sector_preference" class="form-control modysel {{ $errors->has('sector_preference') ? 'is-invalid' : '' }}" placeholder="Enter Sector Preference" value="{{ old('sector_preference') }}">
                                @error('sector_preference')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">Select sectors where you prefer to lend (e.g., Technology, Healthcare, Finance)</span>
                            </div>
                        </div>

                        <!-- Profile Pictures -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt" for="profile_pictures">Profile Pictures</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="file" name="profile_pictures" id="profile_pictures" class="form-control modysel {{ $errors->has('profile_pictures') ? 'is-invalid' : '' }}" accept=".png,.jpeg,.jpg,.gif">
                                @error('profile_pictures')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Professional Summary -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt" for="professional_summary">Professional Summary</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <textarea name="professional_summary" id="professional_summary" class="form-control modysel height70 {{ $errors->has('professional_summary') ? 'is-invalid' : '' }}" placeholder="Enter Your Professional Summary">{{ old('professional_summary') }}</textarea>
                                @error('professional_summary')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Location Preference -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt" for="location_preference">Location Preference</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="location_preference" id="location_preference" class="form-control modysel {{ $errors->has('location_preference') ? 'is-invalid' : '' }}" placeholder="Enter Location Preference" value="{{ old('location_preference') }}">
                                @error('location_preference')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="row setborder">
                            <input type="submit" value="Submit" class="frmbtn"/>
                        </div>

                        <div class="termstxt">
                            By Clicking Submit you are Accepting <a href="#">Terms & Conditions</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12 col-sm-3 col-md-3 frmdfy2">
                    @include('includes.faqsright')  
            </div>
        </div>
    </div>
</main>
  @include('includes.groupcompany')
  @include('includes.newsletter')
  @include('includes.categorylinkfooter')

@endsection
@include('includes.google-location-autocomplete')