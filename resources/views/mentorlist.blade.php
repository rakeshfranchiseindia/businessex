@extends('layouts.app')

@section('content')
<main id="main">
    <div class="container bex-main">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Mentors
                    </li>
                </ol>
            </div>

            <div class="col-md-12 pt-b15">
            </div>
        </div>

        <div class="row catfull">
            @include('includes.catmentorsleft')

            <div class="col-12 col-sm-9 col-md-9 mdy">
                <div class="row">
                    <div class="col-12 col-sm-9 col-md-9 setheading">
                        <h1 class="headblk">Mentors In India</h1>
                    </div>
                    <div class="col-12 col-sm-3 col-md-3 mfer float-right setmob">
                        <div class="form-group">
                            <select class="form-control modysel myselectclass" id="Industry">
                                <option>Recently Listed</option>
                                    <option>Recently Listed</option>
                                
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row setvto">
                    @if(isset($mentorListData) && count($mentorListData) > 0)
                        <ul class="listop">
                            @foreach($mentorListData as $mentor)
                                <li>
                                    <div class="ribbonblk">
                                        <div class="ribbonblkinner">{{ $mentor['mentorPlan'] }}</div>
                                    </div>

                                    <div class="fullb settmar">
                                        <div class="fbleft">
                                            <div class="cname">
                                                <div class="cnameinner">{{ $mentor['mentorName'] }}</div>
                                            </div>
                                        </div>
                                        <div class="fbright">
                                            <div class="compper">
                                                <img src="{{ $mentor['profilePic'] }}" alt="Mentor Image">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="fullb contxt">{{ $mentor['mentorOccupation'] }}</div>

                                    <div class="sdd">
                                        <div class="sddinner"><img src="{{ asset('assets/img/phone.svg') }}"> <span>Phone</span></div>
                                        <div class="sddinner"><img src="{{ asset('assets/img/email.svg') }}"> <span>Email</span></div>
                                        <div class="sddinner"><img src="{{ asset('assets/img/phone.svg') }}"> <span>LinkedIn</span></div>
                                    </div>

                                    <div class="fullb summtxt">
                                        <span>Summary</span>
                                        {{ $mentor['mentorSummary'] }}
                                    </div>

                                    <div class="fullb citytxt">{{ $mentor['mentorCity'] }}</div>

                                    <div class="tagv">
                                       {{-- @foreach($mentor->tags as $tag)
                                            <div class="tagvinner">{{ $tag }}</div>
                                        @endforeach--}}
                                    </div>

                                    <div class="backv">
                                        <div class="inblk">Experience <span>{{ $mentor['mentorExp'] }}</span></div>
                                        <div class="inblk">Expertise <span>{{ $mentor['subExpStr'] }}</span></div>
                                        <div class="inblk">Occupation <span>{{ $mentor['mentorOccupation'] }}</span></div>
                                        <div class="inblk">Sectors <span>{{ $mentor['mentorSector'] }}</span></div>
                                    </div>

                                    <div class="inbtn"><a href="#">Send Proposal</a></div>
                                </li>
                            @endforeach
                        </ul>

                        
                    @else
                        <div class="alert alert-info">No mentors found at the moment.</div>
                    @endif
                </div>
                {{ $mentorListData->links('pagination::bootstrap-4') }}
            </div>
            @include("includes.groupcompany")
            @include("includes.newsletter")
        </div>
    </div>
    @include("includes.categorylinkfooter")
</main>
@endsection