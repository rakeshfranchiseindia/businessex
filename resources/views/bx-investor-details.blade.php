@extends('layouts.app')

@php
    $investorTitle = $investor->inv_headline ?: 'Investor Profile';
    $investorLocation = trim(collect([$investor->inv_city, config('constants.statesIndia.' . $investor->inv_state), $investor->inv_country])->filter()->implode(', '));
    $companyLocation = trim(collect([$investor->company_city, config('constants.statesIndia.' . $investor->company_state), $investor->company_country])->filter()->implode(', '));
    $investorImage = !empty($investor->inv_profile_pic_path)
        ? rtrim(config('constants.ImageCDN'), '/') . '/' . ltrim($investor->inv_profile_pic_path, '/')
        : asset('assets/img/profile-dflt.jpg');
    $companyLogo = !empty($investor->company_logo_path)
        ? rtrim(config('constants.ImageCDN'), '/') . '/' . ltrim($investor->company_logo_path, '/')
        : asset('assets/img/profile-dflt.jpg');
    $industryPreferences = $investor->industryPreferences
        ->map(fn ($preference) => config('industryCategoriesConfig.' . $preference->sub_category_id . '.category_name'))
        ->filter();
@endphp

@section('title', $investorTitle)

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
                    <li><a href="#">{{ $investorTitle }}</a></li>
                    <li>/</li>
                    <li>{{ $investor->inv_name ?: 'Investor' }}</li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h1 class="headblk">
                    {{ $investorTitle }}
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
                                    <div class="showtxtc">Name <span>{{ $investor->inv_name ?: 'N/A' }}</span></div>
                                    <div class="showtxtc">Mobile <span class="fa fa-lock"> Available after Interaction</span></div>
                                    <div class="showtxtc">Email id <span class="fa fa-lock">Available after Interaction</span></div>
                                    <div class="showtxtc">LinkedIn <span class="fa fa-lock">Available after Interaction</span></div>
                                    <div class="showtxtc">Location <span>{{ $investorLocation ?: 'N/A' }}</span></div>
                                </div>
                                <div class="f2blk">
                                    <div class="comppro">
                                        <img src="{{ $investorImage }}" alt="{{ $investor->inv_name ?: 'Investor' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Company Information --}}
                        <div class="boxsect">
                            <div class="boxsecthead">Company Information</div>
                            <div class="fullblks">
                                <div class="f1blk">
                                    <div class="showtxtc">Name <span>{{ $investor->company_name ?: 'N/A' }}</span></div>
                                    <div class="showtxtc">Mobile <span class="fa fa-lock">Available after Interaction</span></div>
                                    <div class="showtxtc">Email id <span class="fa fa-lock">Available after Interaction</span></div>
                                    <div class="showtxtc">LinkedIn <span class="fa fa-lock">Available after Interaction</span></div>
                                    <div class="showtxtc">Location <span>{{ $companyLocation ?: 'N/A' }}</span></div>
                                </div>
                                <div class="f2blk">
                                    <div class="complog">
                                        <img src="{{ $companyLogo }}" alt="{{ $investor->company_name ?: 'Company' }}">
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
                                    <div class="indetail">Investor Company <span>{{ $investor->company_name ?: 'N/A' }}</span></div>
                                    <div class="indetail">Investor Designation <span>{{ $investor->company_designation ?: 'N/A' }}</span></div>
                                    <div class="indetail setfull">Professional Summary <span>{{ $investor->inv_abt_urself ?: $investor->inv_intro ?: 'N/A' }}</span></div>
                                </div>

                                <div class="halkblknew">
                                    <div class="sminhead">Investment Firm</div>
                                    <div class="indetail">Firm Type <span>{{ config('constants.investorFirmType.' . $investor->firm_type, 'N/A') }}</span></div>
                                    <div class="indetail">Company Name <span>{{ $investor->company_name ?: 'N/A' }}</span></div>
                                    <div class="indetail">Company HQ Location <span>{{ $companyLocation ?: 'N/A' }}</span></div>
                                    <div class="indetail">Company Website <span>{{ $investor->company_website ?: 'N/A' }}</span></div>
                                    <div class="indetail setfull">Company Summary <span>{{ $investor->company_summary ?: 'N/A' }}</span></div>
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
                                        <div class="indetail">Investment Size <span>{{ number_format((float) $investor->invest_size_min, 2) }} - {{ number_format((float) $investor->invest_size_max, 2) }}</span></div>
                                        <div class="indetail">Investment Stake Preference <span>{{ $investor->invest_stake !== null ? $investor->invest_stake . '%' : 'N/A' }}</span></div>
                                    </div>
                                    <div class="halkblk">
                                        <div class="sminhead">B. For Acquisition:</div>
                                        <div class="indetail">Purchasing Capacity <span>{{ $investor->purchase_capacity_max ? number_format((float) $investor->purchase_capacity_max, 2) : 'N/A' }}</span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="fullshblk">
                                <div class="perset">
                                    <h3 class="subchead">2. Location Preference</h3>
                                    <ul class="prefetxt mdfy">
                                        @forelse($investor->locationPreferences as $preference)
                                            <li><i class="fa fa-check"></i> {{ $preference->location_name }}</li>
                                        @empty
                                            <li>No location preferences specified</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>

                            <div class="fullshblk">
                                <div class="perset">
                                    <h3 class="subchead">3. Sector Preference</h3>
                                    <ul class="prefetxt">
                                        @forelse($industryPreferences as $industry)
                                            <li><i class="fa fa-angle-double-right"></i> {{ $industry }}</li>
                                        @empty
                                            <li>No sector preferences specified</li>
                                        @endforelse
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