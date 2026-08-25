@extends('layouts.app')

@section('content')
<main id="main" class="minheigh">
    <div class="container bex-main">
        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
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
                    <li>Create your Mentor Profile</li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h1 class="headblk">Create your Mentor Profile</h1>
                <p class="statictxt">
                    Create your profile and be a mentor to multiple startups and businesses from all across India in multiple industries and enhance your own skillset and industry expertise. Fill in your industry experience and preferences for suitable businesses and startups to connect with you.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-9 col-md-9 frmmodfy">
                <form class="frmall" method="POST" action="{{ route('register.create-mentor') }}" enctype="multipart/form-data">
                    @csrf
                    @auth
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    @endauth

                    <div class="frmback">
                        <div class="frmcheading">Confidential Information</div>

                        <!-- Name -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Your Name</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="mentor_name" class="form-control modysel" placeholder="Enter name" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Email</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="email" name="mentor_email" class="form-control modysel" placeholder="Enter Email" required>
                            </div>
                        </div>

                        <!-- Mobile -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Mobile No.</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="tel" name="mentor_mobile" class="form-control modysel" placeholder="Enter Mobile" inputmode="numeric" pattern="[0-9]{10}" maxlength="10" required>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Location</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="mentor_location" class="form-control modysel" placeholder="Select Location from Google" data-google-location data-place-id-field="#mentor_location_place_id" required>
                                <input type="hidden" name="mentor_location_place_id" id="mentor_location_place_id" value="{{ old('mentor_location_place_id') }}">
                            </div>
                        </div>

                        <!-- City -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">City</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <select name="mentor_city" class="form-control modysel" required>
                                    <option value="">Select City</option>
                                    @foreach(collect($locations ?? [])->groupBy('state')->sortKeys() as $stateName => $cities)
                                        <optgroup label="{{ stateDisplayName($stateName) }}">
                                            @foreach($cities as $cityOption)
                                                <option value="{{ $cityOption->city }}" {{ old('mentor_city') === $cityOption->city ? 'selected' : '' }}>{{ $cityOption->city }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="frmcheading marftop">Advertisement Details</div>

                        <!-- Headline -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Advertisement Headline</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="mentor_adv_headline" class="form-control modysel" placeholder="Enter Advertisement Headline" minlength="25" maxlength="255" required>
                            </div>
                        </div>

                        <!-- Introduction -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Introduction</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <textarea name="mentor_intro" class="form-control modysel height70" placeholder="Introduction" minlength="25" maxlength="255" required></textarea>
                            </div>
                        </div>

                        <div class="frmcheading">Profile Details</div>

                        <!-- Occupation -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Occupation</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <select name="mentor_occupation" class="form-control myselectclasscat" required>
                                    <option value="" disabled selected>Select Occupation</option>
                                    <option value="2">Corporate Professional</option>
                                    <option value="1">Educational Professional</option>
                                </select>
                            </div>
                        </div>

                        <!-- Company -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Company</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="mentor_company" class="form-control modysel" placeholder="Enter Company">
                            </div>
                        </div>

                        <!-- Designation -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Designation</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="mentor_designation" class="form-control modysel" placeholder="Enter Designation">
                            </div>
                        </div>

                        <!-- Professional Summary -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Professional Summary</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <textarea name="mentor_profile_summary" class="form-control modysel height70" placeholder="Professional Summary"></textarea>
                            </div>
                        </div>

                        <!-- Experience -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Professional Experience</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <div id="experienceRows">
                                    <div class="experience-row" style="margin-bottom: 12px;">
                                        <div class="row gx-2 align-items-center">
                                            <div class="col-md-5">
                                                <select name="experience_years[]" class="form-control" required>
                                                    <option value="" selected>Number Of Years</option>
                                                    @for($i=1; $i<=20; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                @php
                                                    $groupedIndustries = collect($industrySeller ?? [])->groupBy('industry');
                                                @endphp
                                                <select name="sector_expertise[]" class="form-control myselectclasscat" required>
                                                    <option value="">Sectors of Expertise</option>
                                                    @foreach($groupedIndustries as $category => $subCategories)
                                                        <optgroup label="{{ $category }}">
                                                            @foreach($subCategories as $subCategory)
                                                                <option value="{{ $subCategory['subIndustryid'] ?? '' }}">
                                                                    {{ $subCategory['subindustry'] ?? '' }}
                                                                </option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2 d-flex justify-content-end align-items-center">
                                                <button type="button" class="team-action-btn add-experience-row" aria-label="Add experience" style="display:inline-flex; align-items:center; justify-content:center;">+</button>
                                                <button type="button" class="team-action-btn remove-experience-row" aria-label="Remove experience" style="display:none; align-items:center; justify-content:center;">×</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Subject Expertise -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Subject Expertise</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="mentor_subject_expertise" class="form-control modysel" placeholder="Enter Subject Expertise">
                            </div>
                        </div>

                        <!-- Sector Preference -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Sector Preference</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="mentor_sector_preference" class="form-control modysel" placeholder="Enter Sector Preference">
                            </div>
                        </div>

                        <!-- Upload Image -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Upload Image</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="file" name="mentor_profile_pic" class="form-control modysel">
                            </div>
                        </div>

                        <!-- LinkedIn -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">LinkedIn Profile</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="url" name="mentor_linkedin" class="form-control modysel" placeholder="Enter LinkedIn Profile URL">
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
    @include('includes.google-location-autocomplete')

@push('scripts')
<script>
window.addEventListener('DOMContentLoaded', function () {
    const experienceRows = document.getElementById('experienceRows');
    if (!experienceRows) return;

    function resetSelects(row) {
        row.querySelectorAll('select').forEach(function (select) {
            select.selectedIndex = 0;
        });
    }

    experienceRows.addEventListener('click', function (event) {
        const addBtn = event.target.closest('.add-experience-row');
        if (addBtn) {
            const currentRow = addBtn.closest('.experience-row');
            const newRow = currentRow.cloneNode(true);

            newRow.querySelector('.add-experience-row').style.display = 'none';
            newRow.querySelector('.remove-experience-row').style.display = 'inline-flex';
            resetSelects(newRow);

            experienceRows.appendChild(newRow);
            return;
        }

        const removeBtn = event.target.closest('.remove-experience-row');
        if (removeBtn) {
            const currentRow = removeBtn.closest('.experience-row');
            const rows = experienceRows.querySelectorAll('.experience-row');
            if (rows.length > 1) {
                currentRow.remove();
            }
        }
    });
});
</script>
@endpush
@endsection