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
                        Investors
                    </li>
                </ol>
            </div>

            <div class="col-md-12 pt-b15">
            </div>
        </div>

        <div class="row catfull">
            @include('includes.catleft')

            <div class="col-12 col-sm-9 col-md-9 mdy">
                <div class="row">
                    <div class="col-12 col-sm-9 col-md-9 setheading">
                        <h1 class="headblk">Business Investment opportunities in India</h1>
                    </div>
                    <div class="col-12 col-sm-3 col-md-3 float-right setmob">
                        <div class="form-group">
                            <select class="form-control modysel myselectclass" id="sortby" onchange="const params = new URLSearchParams(window.location.search); params.set('sortby', this.value); params.delete('currentPage'); window.location = '{{ route('investor.listing') }}?' + params.toString();">
                                <option value="">Sort By</option>
                                <option value="asc" {{ request('sortby') === 'asc' ? 'selected' : '' }}>Listed first asc</option>
                                <option value="desc" {{ request('sortby') === 'desc' ? 'selected' : '' }}>Listed first desc</option>
                                
                            </select>
                        </div>
                    </div>
                </div>
                <p>Looking for a perfect investor for your business? BusinessEx provides a 296 of investors with investment preferences in 13 various industries having Daman and Diu,Delhi,Andhra Pradesh as their preferred location(s) for investment. We recommended to create a Investor profile in BusinessEx.</p>

                <div class="row setvto">
                    @if(isset($investorList) && count($investorList) > 0)
                        <ul class="listop">
                            @foreach($investorList as $investor)
                            <?php //print_r($investor); exit?>
                                <li>
                                    <div class="ribbonblk">
                                        <div class="ribbonblkinner">{{ $investor['investorPlan'] }}</div>
                                    </div>

                                    <div class="fullb settmar">
                                        <div class="fbleft">
                                            <div class="cname">
                                                <div class="cnameinner">{{ $investor['investorName'] }}</div>
                                            </div>
                                        </div>
                                        <div class="fbright">
                                            <div class="compper">
                                                <img src="{{ $investor['investorProfPic'] }}" alt="Investor Image">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="fullb contxt">{{ $investor['investorTitle'] }}</div>

                                    <div class="sdd">
                                        <div class="sddinner"><img src="{{ asset('assets/img/phone.svg') }}"> <span>Phone</span></div>
                                        <div class="sddinner"><span class="fa fa-envelope"></span> <span>Email</span></div>
                                        <div class="sddinner"><img src="{{ asset('assets/img/phone.svg') }}"> <span>LinkedIn</span></div>
                                    </div>

                                    <div class="fullb summtxt">
                                        <span>Summary</span>
                                        {{ $investor['investorSummary'] }}
                                    </div>

                                    <div class="fullb citytxt">{{ $investor['locations'] }}</div>

                                    <div class="tagv">
                                        {{--@foreach($investor->tags as $tag)
                                            <div class="tagvinner">{{ $tag }}</div>
                                        @endforeach --}}
                                    </div>

                                    <div class="backv">
                                        <div class="inblk">Investment Preference <span>{{ $investor['investmentPref'] }}</span></div>
                                        <div class="inblk">Investment Size <span>{{ $investor['minInvestment'] }} - {{ $investor['maxInvestment'] }}</span></div>
                                        <div class="inblk">Industry Preference <span>{{ $investor['sectorPref'] }}</span></div>
                                        <div class="inblk">Location Preference <span>{{ $investor['locations'] }}</span></div>
                                    </div>

                                    <div class="inbtn">
                                        @auth
                                            <a href="{{ route('investor.detail', $investor['investorId']) }}">Send Proposal</a>
                                        @else
                                            <a href="#login" data-toggle="modal" data-target="#login">Send Proposal</a>
                                        @endauth
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        {{ $investors->appends(request()->except('currentPage'))->links('pagination::bootstrap-4') }}
                    @else
                        <div class="alert alert-info">No investors found at the moment.</div>
                    @endif
                </div>
            </div>
        </div>
        @include("includes.groupcompany")
        @include("includes.newsletter")
    </div>
    @include("includes.categorylinkfooter")
</main>
@endsection
