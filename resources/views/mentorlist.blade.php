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
                                @foreach(['Location1','Location2','Location3','Location4'] as $location)
                                    <option>{{ $location }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row setvto">
                    @if(isset($mentors) && $mentors->count() > 0)
                        <ul class="listop">
                            @foreach($mentors as $mentor)
                                <li>
                                    <div class="ribbonblk">
                                        <div class="ribbonblkinner">{{ $mentor->badge }}</div>
                                    </div>

                                    <div class="fullb settmar">
                                        <div class="fbleft">
                                            <div class="cname">
                                                <div class="cnameinner">{{ $mentor->name }}</div>
                                            </div>
                                        </div>
                                        <div class="fbright">
                                            <div class="compper">
                                                <img src="{{ $mentor->image }}" alt="Mentor Image">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="fullb contxt">{{ $mentor->occupation }}</div>

                                    <div class="sdd">
                                        <div class="sddinner"><img src="{{ asset('assets/img/phone.svg') }}"> <span>Phone</span></div>
                                        <div class="sddinner"><img src="{{ asset('assets/img/email.svg') }}"> <span>Email</span></div>
                                        <div class="sddinner"><img src="{{ asset('assets/img/phone.svg') }}"> <span>LinkedIn</span></div>
                                    </div>

                                    <div class="fullb summtxt">
                                        <span>Summary</span>
                                        {{ $mentor->summary }}
                                    </div>

                                    <div class="fullb citytxt">{{ $mentor->location }}</div>

                                    <div class="tagv">
                                        @foreach($mentor->tags as $tag)
                                            <div class="tagvinner">{{ $tag }}</div>
                                        @endforeach
                                    </div>

                                    <div class="backv">
                                        <div class="inblk">Experience <span>{{ $mentor->experience }}</span></div>
                                        <div class="inblk">Expertise <span>{{ $mentor->expertise }}</span></div>
                                        <div class="inblk">Occupation <span>{{ $mentor->occupation }}</span></div>
                                        <div class="inblk">Sectors <span>{{ $mentor->sectors }}</span></div>
                                    </div>

                                    <div class="inbtn"><a href="#">Send Proposal</a></div>
                                </li>
                            @endforeach
                        </ul>

                        {{ $mentors->links('pagination::bootstrap-4') }}
                    @else
                        <div class="alert alert-info">No mentors found at the moment.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection