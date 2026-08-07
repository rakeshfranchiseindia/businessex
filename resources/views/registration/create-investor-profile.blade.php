@extends('layouts.app')

@section('content')
<main id="main" class="minheigh">
    <div class="container bex-main">
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
                <form class="frmall" method="POST" action="{{-- route('investor.store') --}}">
                    @csrf

                    <div class="frmback">
                        <!-- Confidential Information -->
                        <div class="frmcheading">Confidential Information</div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Your Name</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control modysel" placeholder="Enter name" required>
                            </div>
                        </div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Email</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control modysel" placeholder="Enter Email" required>
                            </div>
                        </div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Mobile No.</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="mobile" class="form-control modysel" placeholder="Enter Mobile" required>
                            </div>
                        </div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Location</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="location" class="form-control modysel" placeholder="Enter Location" required>
                            </div>
                        </div>

                        <!-- Advertisement Details -->
                        <div class="frmcheading marftop">Advertisement Details</div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Advertisement Headline</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <input type="text" name="headline" class="form-control modysel" placeholder="Enter Advertisement Headline" required>
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">Select an industry or a sector in which the company operates. E.g. Logistics Services.</span>
                            </div>
                        </div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Introduction</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <textarea name="introduction" class="form-control modysel height70" placeholder="Introduction"></textarea>
                            </div>
                            <div class="tooltipfrm">
                                <i class="fas fa-info-circle"></i>
                                <span class="tooltiptextfrm">Select an industry or a sector in which the company operates. E.g. Logistics Services.</span>
                            </div>
                        </div>

                        <!-- Profile Details -->
                        <div class="frmcheading">Profile Details</div>

                        <div class="row marsettop">
                            <label class="col-md-4 frmtxt mandatory">Investor Type</label>
                            <div class="d-none d-md-block col-md-1">:</div>
                            <div class="col-md-6">
                                <select name="inv_type" class="form-control myselectclasscat" required>
                                    <option value="" disabled selected>Select Investor Type</option>
                                    <option value="Individual Investor">Individual Investor</option>
                                    <option value="Investment Firm">Investment Firm</option>
                                </select>
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
                {{--@include('includes.faqsright')--}}
            </div>
        </div>
    </div>
</main>
@endsection