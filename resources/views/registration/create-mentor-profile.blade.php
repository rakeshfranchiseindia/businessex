@extends('layouts.app')

@section('content')
<main id="main" class="minheigh">
    <div class="container bex-main">
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
                <form class="frmall" method="POST" action="{{-- route('mentor.store') --}}" enctype="multipart/form-data">
                    @csrf

                    <div class="frmback">
                        <div class="frmcheading">Confidential Information</div>

                        <!-- Name -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Your Name</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control modysel" placeholder="Enter name" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Email</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control modysel" placeholder="Enter Email" required>
                            </div>
                        </div>

                        <!-- Mobile -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Mobile No.</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="mobile" class="form-control modysel" placeholder="Enter Mobile" required>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Location</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="location" class="form-control modysel" placeholder="Enter Location" required>
                            </div>
                        </div>

                        <div class="frmcheading marftop">Advertisement Details</div>

                        <!-- Headline -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Advertisement Headline</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="headline" class="form-control modysel" placeholder="Enter Advertisement Headline" required>
                            </div>
                        </div>

                        <!-- Introduction -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Introduction</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <textarea name="introduction" class="form-control modysel height70" placeholder="Introduction"></textarea>
                            </div>
                        </div>

                        <div class="frmcheading">Profile Details</div>

                        <!-- Occupation -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Occupation</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <select name="occupation" class="form-control myselectclasscat" required>
                                    <option value="" disabled selected>Select Occupation</option>
                                    <option value="Corporate Professional">Corporate Professional</option>
                                    <option value="Educational Professional">Educational Professional</option>
                                </select>
                            </div>
                        </div>

                        <!-- Company -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Company</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="company" class="form-control modysel" placeholder="Enter Company">
                            </div>
                        </div>

                        <!-- Designation -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Designation</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="designation" class="form-control modysel" placeholder="Enter Designation">
                            </div>
                        </div>

                        <!-- Professional Summary -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Professional Summary</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <textarea name="summary" class="form-control modysel height70" placeholder="Professional Summary"></textarea>
                            </div>
                        </div>

                        <!-- Experience -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Professional Experience</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="experience_years" class="form-control" required>
                                            <option value="" disabled selected>Number Of Years</option>
                                            @for($i=1; $i<=20; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="sector_expertise" class="form-control myselectclasscat" required>
                                            <option value="">Sectors of Expertise</option>
                                            {{-- @foreach($sectors as $sector)
                                                <option value="{{ $sector }}">{{ $sector }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Subject Expertise -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Subject Expertise</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="subject_expertise" class="form-control modysel" placeholder="Enter Subject Expertise">
                            </div>
                        </div>

                        <!-- Sector Preference -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Sector Preference</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="sector_preference" class="form-control modysel" placeholder="Enter Sector Preference">
                            </div>
                        </div>

                        <!-- Upload Image -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Upload Image</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="file" name="image" class="form-control modysel">
                            </div>
                        </div>

                        <!-- LinkedIn -->
                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">LinkedIn Profile</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="url" name="linkedin" class="form-control modysel" placeholder="Enter LinkedIn Profile URL">
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

            <div
        <!-- Right Column -->
            <div class="col-12 col-sm-3 col-md-3 frmdfy2">
                {{--@include('includes.faqsright')--}}
            </div>
        </div>
    </div>
</main>
@endsection