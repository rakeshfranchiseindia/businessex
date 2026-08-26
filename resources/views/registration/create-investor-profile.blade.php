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
            {{--<div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>--}}
        @endif

        <!-- Breadcrumb -->
        <div class="row">
            <div class="col-12">
                <ul class="brunnar">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>/</li>
                    <li>Create your Investor Profile</li>
                </ul>
            </div>
        </div>

        <!-- Heading -->
        <div class="row">
            <div class="col-12">
                <h1 class="headblk">Create your Business Profile</h1>
                <p class="statictxt">
                    Create your investor profile and surf through our listings of startups and businesses from all across India in multiple industries to invest into or buy completely. Fill in your investment preferences for suitable businesses and startups to connect with you.
                </p>
            </div>
        </div>

        <!-- Form Section -->
        <div class="row">
            <div class="col-12 col-sm-9 col-md-9 frmmodfy">
                <form class="frmall" method="POST" action="{{route('register.create-investor') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="frmback">
                        <!-- Confidential Information -->
                        <div class="frmcheading">Confidential Information</div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Your Name</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control modysel @error('name') is-invalid @enderror" placeholder="Enter name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Email</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control modysel @error('email') is-invalid @enderror" placeholder="Enter Email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Mobile No.</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="tel" name="mobile" class="form-control modysel @error('mobile') is-invalid @enderror" placeholder="Enter Mobile" value="{{ old('mobile') }}" inputmode="numeric" pattern="[0-9]{10}" maxlength="10" required>
                                @error('mobile')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Location</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="location" class="form-control modysel @error('location') is-invalid @enderror" placeholder="Select Location from Google" value="{{ old('location') }}" data-google-location data-place-id-field="#investor_location_place_id" required>
                                <input type="hidden" name="location_place_id" id="investor_location_place_id" value="{{ old('location_place_id') }}">
                                @error('location')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Advertisement Details -->
                        <div class="frmcheading marftop">Advertisement Details</div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt">Advertisement Headline</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="headline" class="form-control modysel @error('headline') is-invalid @enderror" placeholder="Enter Advertisement Headline" value="{{ old('headline') }}" minlength="25" maxlength="255">
                                @error('headline')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">Brief headline describing your investment focus</span>
                            </div>
                        </div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt">Introduction</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <textarea name="introduction" class="form-control modysel height70 @error('introduction') is-invalid @enderror" placeholder="Tell about yourself..." minlength="25" maxlength="255">{{ old('introduction') }}</textarea>
                                @error('introduction')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">Brief information about yourself and investment experience</span>
                            </div>
                        </div>

                        <!-- Profile Details -->
                        <div class="frmcheading marftop">Profile Details</div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Investor Type</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <select name="inv_type" class="form-control myselectclasscat @error('inv_type') is-invalid @enderror" id="invType" required>
                                    <option value="" disabled selected>Select Investor Type</option>
                                    <option value="Individual Investor" {{ old('inv_type') == 'Individual Investor' ? 'selected' : '' }}>Individual Investor</option>
                                    <option value="Investment Firm" {{ old('inv_type') == 'Investment Firm' ? 'selected' : '' }}>Investment Firm</option>
                                </select>
                                @error('inv_type')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt">Your LinkedIn Profile</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="url" name="linkedin_profile" class="form-control modysel @error('linkedin_profile') is-invalid @enderror" placeholder="https://www.linkedin.com/in/your-profile" value="{{ old('linkedin_profile') }}">
                                @error('linkedin_profile')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt">Location Preference</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <select name="location_preference[]" class="form-control modysel @error('location_preference') is-invalid @enderror" multiple>
                                    @foreach(collect($locations ?? [])->groupBy(fn ($location) => $location->state ?? $location['state'] ?? '')->sortKeys() as $stateName => $cities)
                                        <optgroup label="{{ stateDisplayName($stateName) }}">
                                            @foreach($cities as $city)
                                                <option value="{{ $city->id ?? $city['id'] }}" {{ in_array((string) ($city->id ?? $city['id']), array_map('strval', (array) old('location_preference', [])), true) ? 'selected' : '' }}>{{ $city->city ?? $city['city'] }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                @error('location_preference')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt">Sector Preference</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <select name="sector_preference[]" class="form-control modysel @error('sector_preference') is-invalid @enderror" multiple>
                                    @foreach(collect($industrySeller ?? [])->groupBy('industry')->sortKeys() as $industryName => $industryItems)
                                        <optgroup label="{{ $industryName }}">
                                            @foreach($industryItems as $industry)
                                                <option value="{{ $industry['subIndustryid'] }}_{{ $industry['parentCatId'] }}" {{ in_array((string) $industry['subIndustryid'] . '_' . $industry['parentCatId'], array_map('strval', (array) old('sector_preference', [])), true) ? 'selected' : '' }}>{{ $industry['subindustry'] }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                @error('sector_preference')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt">Investment Preference</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <label class="d-flex align-items-center gap-2 mb-0">
                                        <input type="checkbox" name="invest_pref" value="1" id="invest_pref">
                                        <span>Investment</span>
                                    </label>
                                    <label class="d-flex align-items-center gap-2 mb-0">
                                        <input type="checkbox" name="full_acquisition" value="1" id="full_acquisition">
                                        <span>Full Acquisition</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row marsettop investment-size-group" style="display: none;">
                            <label class="col-md-4 frmtxt">Investment Size</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="number" name="invest_size_min" class="form-control modysel @error('invest_size_min') is-invalid @enderror" placeholder="Min Investment" value="{{ old('invest_size_min') }}">
                                        @error('invest_size_min')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="invest_size_max" class="form-control modysel @error('invest_size_max') is-invalid @enderror" placeholder="Max Investment" value="{{ old('invest_size_max') }}">
                                        @error('invest_size_max')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row marsettop purchase-capacity-group" style="display: none;">
                            <label class="col-md-4 frmtxt">Purchasing Capacity</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="number" name="purchase_capacity_min" class="form-control modysel @error('purchase_capacity_min') is-invalid @enderror" placeholder="Min Capacity" value="{{ old('purchase_capacity_min') }}">
                                        @error('purchase_capacity_min')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="purchase_capacity_max" class="form-control modysel @error('purchase_capacity_max') is-invalid @enderror" placeholder="Max Capacity" value="{{ old('purchase_capacity_max') }}">
                                        @error('purchase_capacity_max')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt">About Yourself</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <textarea name="inv_abt_urself" class="form-control modysel height70 @error('inv_abt_urself') is-invalid @enderror" placeholder="Tell us about yourself...">{{ old('inv_abt_urself') }}</textarea>
                                @error('inv_abt_urself')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt">Company Name</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="company_name" class="form-control modysel @error('company_name') is-invalid @enderror" placeholder="Enter Company Name" value="{{ old('company_name') }}">
                                @error('company_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt">Designation</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="company_designation" class="form-control modysel @error('company_designation') is-invalid @enderror" placeholder="Enter Designation" value="{{ old('company_designation') }}">
                                @error('company_designation')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Profile Picture (for Individual Investor) -->
                        <div class="row marsettop" id="profilePicDiv" style="display: none;">
                            <label class="col-md-4 frmtxt">Profile Picture</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="file" name="inv_profile_pic_path" class="form-control modysel @error('inv_profile_pic_path') is-invalid @enderror" accept="image/*">
                                @error('inv_profile_pic_path')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">Upload a professional profile picture (JPG, PNG)</span>
                            </div>
                        </div>

                        <!-- Company Logo (for Investment Firm) -->
                        <div class="row marsettop" id="companyLogoDiv" style="display: none;">
                            <label class="col-md-4 frmtxt">Company Logo</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="file" name="company_logo_path" class="form-control modysel @error('company_logo_path') is-invalid @enderror" accept="image/*">
                                @error('company_logo_path')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">Upload your company logo (JPG, PNG)</span>
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

            <!-- Right Column -->
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

<script>
// Toggle visibility of profile picture and company logo based on investor type
document.addEventListener('DOMContentLoaded', function() {
    const invTypeSelect = document.getElementById('invType');
    const profilePicDiv = document.getElementById('profilePicDiv');
    const companyLogoDiv = document.getElementById('companyLogoDiv');
    const investmentPreference = document.getElementById('invest_pref');
    const fullAcquisitionPreference = document.getElementById('full_acquisition');
    const investmentSizeGroup = document.querySelector('.investment-size-group');
    const purchaseCapacityGroup = document.querySelector('.purchase-capacity-group');

    function updateFileFields() {
        const value = invTypeSelect.value;
        if (value === 'Individual Investor') {
            profilePicDiv.style.display = 'flex';
            companyLogoDiv.style.display = 'none';
        } else if (value === 'Investment Firm') {
            profilePicDiv.style.display = 'none';
            companyLogoDiv.style.display = 'flex';
        } else {
            profilePicDiv.style.display = 'none';
            companyLogoDiv.style.display = 'none';
        }
    }

    function updateInvestmentPreferenceFields() {
        const isInvestmentSelected = investmentPreference && investmentPreference.checked;
        const isFullAcquisitionSelected = fullAcquisitionPreference && fullAcquisitionPreference.checked;

        if (investmentSizeGroup) {
            investmentSizeGroup.style.display = isInvestmentSelected ? 'flex' : 'none';
        }

        if (purchaseCapacityGroup) {
            purchaseCapacityGroup.style.display = isFullAcquisitionSelected ? 'flex' : 'none';
        }
    }

    if (invTypeSelect) {
        invTypeSelect.addEventListener('change', updateFileFields);
        if (invTypeSelect.value) {
            updateFileFields();
        }
    }

    if (investmentPreference) {
        investmentPreference.addEventListener('change', function() {
            if (this.checked) {
                fullAcquisitionPreference.checked = false;
            }
            updateInvestmentPreferenceFields();
        });
    }

    if (fullAcquisitionPreference) {
        fullAcquisitionPreference.addEventListener('change', function() {
            if (this.checked) {
                investmentPreference.checked = false;
            }
            updateInvestmentPreferenceFields();
        });
    }

    updateInvestmentPreferenceFields();
});
</script>
@endsection