@extends('layouts.app')

@section('content')
<main id="main">
    <div class="container bex-main">
        <div class="row">
            <div class="col-12">
                <ul class="brunnar">
                    <li><a href="#">Home</a></li>
                    <li>/</li>
                    <li><a href="#">Mentor</a></li>
                    <li>/</li>
                    <li><a href="#">Business & Leadership Coach for SME Entrepreneurs</a></li>
                    <li>/</li>
                    <li></li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h1 class="headblk">
                    Business & Leadership Coach for SME Entrepreneurs
                </h1>
            </div>
        </div>

        <div class="row landpage">
            <div class="col-12 col-md-9">
                <div class="fulldetailpage iber">
                    <div class="tab-content">
                        <div class="boxsect">
                            <div class="boxsecthead">Personal Information</div>
                            <div class="fullblks">
                                <div class="f1blk">
                                    <div class="showtxtc">
                                        <span class="sh1">Name</span>
                                        <span class="sh2">Rohit Purohit</span>
                                    </div>
                                    <div class="showtxtc">
                                        <span class="sh1">Mobile</span>
                                        <span class="sh2">
                                            <img src="{{ asset('assets/img/lock.svg') }}">
                                            Available after Interaction
                                        </span>
                                    </div>
                                    <div class="showtxtc">
                                        <span class="sh1">Email id</span>
                                        <span class="sh2">
                                            <img src="{{ asset('assets/img/lock.svg') }}">
                                            Available after Interaction
                                        </span>
                                    </div>
                                    <div class="showtxtc">
                                        <span class="sh1">LinkedIn</span>
                                        <span class="sh2">
                                            <img src="{{ asset('assets/img/lock.svg') }}">
                                            Available after Interaction
                                        </span>
                                    </div>
                                    <div class="showtxtc">
                                        <span class="sh1">Location</span>
                                        <span class="sh2">Gujarat, India</span>
                                    </div>
                                </div>
                                <div class="f2blk">
                                    <div class="comppro">
                                        <img src="https://businessextest.s3.ap-south-1.amazonaws.com/investor/profile/202005/73081_1590489389.jpg">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="boxsect">
                            <div class="boxsecthead">Mentor Information</div>
                            <div class="fullshblk">
                                <div class="indetailmodfy">
                                    <span class="ds1">Mentor Type</span>
                                    <span class="ds2">Corporate professional OR Education Professional</span>
                                </div>
                                <div class="indetailmodfy">
                                    <span class="ds1">Company / Institution</span>
                                    <span class="ds2">BusinessEx Solutions Pvt. Ltd.</span>
                                </div>
                                <div class="indetailmodfy">
                                    <span class="ds1">Designation / Title</span>
                                    <span class="ds2">Sr. UI Developer</span>
                                </div>
                                <div class="indetailmodfy">
                                    <span class="ds1">Professional Experience</span>
                                    <span class="ds2">
                                        <div class="inafter">
                                            <ul class="innerlab mexp">
                                                <li><label>Sector</label></li>
                                                <li><label>Years</label></li>
                                            </ul>
                                            <ul class="innerlab mexp">
                                                <li>Bathroom fixtures</li>
                                                <li>7 Years</li>
                                            </ul>
                                            <ul class="innerlab mexp">
                                                <li>Water treatment plant & equipment</li>
                                                <li>7 Years</li>
                                            </ul>
                                            <ul class="innerlab mexp">
                                                <li>Consumer electronics</li>
                                                <li>10 Years</li>
                                            </ul>
                                        </div>
                                    </span>
                                </div>
                                <div class="indetailmodfy">
                                    <span class="ds1">Subject Expertise</span>
                                    <span class="ds2">
                                        <ul class="prefetxt subexp">
                                            <li><i class="fa fa-angle-double-right"></i> Retail and Consumer Sales</li>
                                            <li><i class="fa fa-angle-double-right"></i> Marketing Strategy</li>
                                            <li><i class="fa fa-angle-double-right"></i> Financial Planning</li>
                                        </ul>
                                    </span>
                                </div>
                                <div class="indetailmodfy">
                                    <span class="ds1">Sector Preference</span>
                                    <span class="ds2">
                                        <ul class="prefetxt subexp">
                                            <li><i class="fa fa-angle-double-right"></i> Medical supplies & equipment</li>
                                            <li><i class="fa fa-angle-double-right"></i> Ecommerce websites</li>
                                            <li><i class="fa fa-angle-double-right"></i> Food stores</li>
                                            <li><i class="fa fa-angle-double-right"></i> Software services Schools</li>
                                        </ul>
                                    </span>
                                </div>
                                <div class="indetailmodfy">
                                    <span class="ds1">Professional Summary</span>
                                    <span class="ds2">
                                        I have 40 Years of Business experience of which 15 years is as CEO at Mahindra leading a very senior leadership team.
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3">
                {{--@include('includes.bexlandingfrmmentor') --}}
            </div>
        </div>
        @include("includes.groupcompany")
        @include("includes.newsletter")
    </div>
    @include("includes.categorylinkfooter")
</main>
@endsection