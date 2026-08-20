@extends('layouts.app')

@section('content')
<main id="main">
    <div class="container bex-main">
        <div class="row">
            <div class="col-12">
                <ul class="brunnar">
                    <li><a href="#">Home</a></li>
                    <li>/</li>
                    <li><a href="#">Investor</a></li>
                    <li>/</li>
                    <li><a href="#">I am open to buy and invest in a business</a></li>
                    <li>/</li>
                    <li></li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h1 class="headblk">
                    An upcoming company in the Food & Beverage sector, one of the fast growing industry segment.
                </h1>
            </div>
        </div>

        <div class="row landpage">
            <div class="col-12 col-md-9">
                <div class="fulldetailpage iber">
                    <div class="tab-content">

                        {{-- Personal Information --}}
                        <div class="boxsect">
                            <div class="boxsecthead">Personal Information</div>
                            <div class="fullblks">
                                <div class="f1blk">
                                    <div class="showtxtc">Name <span>Rohit Purohit</span></div>
                                    <div class="showtxtc">Mobile <span><img src="{{ asset('assets/img/lock.svg') }}"> Available after Interaction</span></div>
                                    <div class="showtxtc">Email id <span><img src="{{ asset('assets/img/lock.svg') }}"> Available after Interaction</span></div>
                                    <div class="showtxtc">LinkedIn <span><img src="{{ asset('assets/img/lock.svg') }}"> Available after Interaction</span></div>
                                    <div class="showtxtc">Location <span>Gujarat, India</span></div>
                                </div>
                                <div class="f2blk">
                                    <div class="comppro">
                                        <img src="https://businessextest.s3.ap-south-1.amazonaws.com/investor/profile/202005/73081_1590489389.jpg">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Company Information --}}
                        <div class="boxsect">
                            <div class="boxsecthead">Personal Information</div>
                            <div class="fullblks">
                                <div class="f1blk">
                                    <div class="showtxtc">Name <span>Rohit Purohit</span></div>
                                    <div class="showtxtc">Mobile <span><img src="{{ asset('assets/img/lock.svg') }}"> Available after Interaction</span></div>
                                    <div class="showtxtc">Email id <span><img src="{{ asset('assets/img/lock.svg') }}"> Available after Interaction</span></div>
                                    <div class="showtxtc">LinkedIn <span><img src="{{ asset('assets/img/lock.svg') }}"> Available after Interaction</span></div>
                                    <div class="showtxtc">Location <span>Gujarat, India</span></div>
                                </div>
                                <div class="f2blk">
                                    <div class="complog">
                                        <img src="https://franchiseindia.s3.ap-south-1.amazonaws.com/tbo/11231182540492.jpg">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Investor Information --}}
                        <div class="boxsect">
                            <div class="boxsecthead">Investor Information</div>
                            <div class="fullshblk">
                                <h3 class="subchead">Investor Type (Individual/Investment Firm)</h3>

                                <div class="halkblknew">
                                    <div class="sminhead">Individual</div>
                                    <div class="indetail">Investor Company <span>Franchise India</span></div>
                                    <div class="indetail">Investor Designation <span>Sr. UI Developer</span></div>
                                    <div class="indetail setfull">Professional Summary <span>Domestic and International domain... </span></div>
                                </div>

                                <div class="halkblknew">
                                    <div class="sminhead">Investment Firm</div>
                                    <div class="indetail">Firm Type <span>Corporate/VC/PE</span></div>
                                    <div class="indetail">Company Name <span>Franchise India</span></div>
                                    <div class="indetail">Company HQ Location <span>Faridabad</span></div>
                                    <div class="indetail">Company Website <span>https://www.franchiseindia.com/</span></div>
                                    <div class="indetail setfull">Company Summary <span>Franchiseindia.com is world’s #1 franchise website...</span></div>
                                </div>
                            </div>
                        </div>

                        {{-- Preferences --}}
                        <div class="boxsect">
                            <div class="boxsecthead">Preferences</div>
                            <div class="fullshblk">
                                <div class="perset">
                                    <h3 class="subchead">1. Investment Preference (Investment/Acquisition)</h3>
                                    <div class="halkblk">
                                        <div class="sminhead">A. For Investment:</div>
                                        <div class="indetail">Investment Size <span>1 Crore - 15 Crore</span></div>
                                        <div class="indetail">Investment Stake Preference <span>60%</span></div>
                                    </div>
                                    <div class="halkblk">
                                        <div class="sminhead">B. For Acquisition:</div>
                                        <div class="indetail">Purchasing Capacity <span>70%</span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="fullshblk">
                                <div class="perset">
                                    <h3 class="subchead">2. Location Preference</h3>
                                    <ul class="prefetxt mdfy">
                                        <li><i class="fa fa-check"></i> New Delhi, Delhi</li>
                                        <li><i class="fa fa-check"></i> Gurgaon, Haryana</li>
                                        <li><i class="fa fa-check"></i> Himachal Pradesh</li>
                                        <li><i class="fa fa-check"></i> Jammu and Kashmir</li>
                                        <li><i class="fa fa-check"></i> Punjab</li>
                                        <li><i class="fa fa-check"></i> Uttaranchal</li>
                                        <li><i class="fa fa-check"></i> Noida, Uttar Pradesh</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="fullshblk">
                                <div class="perset">
                                    <h3 class="subchead">3. Sector Preference</h3>
                                    <ul class="prefetxt">
                                        <li><i class="fa fa-angle-double-right"></i> Medical supplies & equipment</li>
                                        <li><i class="fa fa-angle-double-right"></i> Ecommerce websites</li>
                                        <li><i class="fa fa-angle-double-right"></i> Food stores</li>
                                        <li><i class="fa fa-angle-double-right"></i> Software services Schools</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3">
            {{--@include('includes.bexlandingfrm') --}}
            </div>
        </div>
        @include("includes.groupcompany")
        @include("includes.newsletter")
    </div>
    @include("includes.categorylinkfooter")
</main>
@endsection