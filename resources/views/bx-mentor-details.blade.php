@extends('layouts.app')

@php
    $mentorTitle = $mentor->mentor_adv_headline ?: 'Mentor Profile';
    $mentorLocation = collect([
        $mentor->mentor_city,
        config('constants.statesIndia.' . $mentor->mentor_state),
        $mentor->mentor_country,
    ])->filter()->implode(', ');
    $mentorImage = $mentor->mentor_profile_pic
        ? rtrim(config('constants.ImageCDN'), '/') . '/' . ltrim($mentor->mentor_profile_pic, '/')
        : asset('assets/img/defaultProfile.jpg');
    $mentorOccupation = config('constants.mentorOccupation.' . $mentor->mentor_occupation, $mentor->mentor_occupation ?: 'N/A');
    $mentorExpertiseItems = collect(explode(',', $mentorExpertise))->map('trim')->filter();
    $mentorSectorItems = collect(explode(',', $mentorSectors))->map('trim')->filter();
@endphp

@section('title', $mentorTitle)

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
                    <li><a href="#">{{ $mentorTitle }}</a></li>
                    <li>/</li>
                    <li>{{ $mentor->mentor_name ?: 'Mentor' }}</li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h1 class="headblk">
                    {{ $mentorTitle }}
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
                                        <span class="sh2">{{ $mentor->mentor_name ?: 'N/A' }}</span>
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
                                        <span class="sh2">{{ $mentorLocation ?: 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="f2blk">
                                    <div class="comppro">
                                        <img src="{{ $mentorImage }}" alt="{{ $mentor->mentor_name ?: 'Mentor' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="boxsect">
                            <div class="boxsecthead">Mentor Information</div>
                            <div class="fullshblk">
                                <div class="indetailmodfy">
                                    <span class="ds1">Mentor Type</span>
                                    <span class="ds2">{{ $mentorOccupation }}</span>
                                </div>
                                <div class="indetailmodfy">
                                    <span class="ds1">Company / Institution</span>
                                    <span class="ds2">{{ $mentor->mentor_company ?: 'N/A' }}</span>
                                </div>
                                <div class="indetailmodfy">
                                    <span class="ds1">Designation / Title</span>
                                    <span class="ds2">{{ $mentor->mentor_designation ?: 'N/A' }}</span>
                                </div>
                                <div class="indetailmodfy">
                                    <span class="ds1">Professional Experience</span>
                                    <span class="ds2">
                                        <div class="inafter">
                                            <ul class="innerlab mexp">
                                                <li><label>Sector</label></li>
                                                <li><label>Years</label></li>
                                            </ul>
                                            @forelse($mentor->experience as $experience)
                                                <ul class="innerlab mexp">
                                                    <li>{{ $experience->exp_sector ?: 'N/A' }}</li>
                                                    <li>{{ $experience->exp_year ?: 0 }} Years</li>
                                                </ul>
                                            @empty
                                                <ul class="innerlab mexp">
                                                    <li>N/A</li>
                                                    <li>N/A</li>
                                                </ul>
                                            @endforelse
                                        </div>
                                    </span>
                                </div>
                                <div class="indetailmodfy">
                                    <span class="ds1">Subject Expertise</span>
                                    <span class="ds2">
                                        <ul class="prefetxt subexp">
                                            @forelse($mentorExpertiseItems as $expertise)
                                                <li><i class="fa fa-angle-double-right"></i> {{ $expertise }}</li>
                                            @empty
                                                <li>No subject expertise specified</li>
                                            @endforelse
                                        </ul>
                                    </span>
                                </div>
                                <div class="indetailmodfy">
                                    <span class="ds1">Sector Preference</span>
                                    <span class="ds2">
                                        <ul class="prefetxt subexp">
                                            @forelse($mentorSectorItems as $sector)
                                                <li><i class="fa fa-angle-double-right"></i> {{ $sector }}</li>
                                            @empty
                                                <li>No sector preference specified</li>
                                            @endforelse
                                        </ul>
                                    </span>
                                </div>
                                <div class="indetailmodfy">
                                    <span class="ds1">Professional Summary</span>
                                    <span class="ds2">
                                        {{ $mentor->mentor_profile_summary ?: $mentor->mentor_intro ?: 'N/A' }}
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