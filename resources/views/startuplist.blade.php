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
                        Start-UPs Looking for Investments
                    </li>
                </ol>
            </div>

            <div class="col-md-12 pt-b15">
                <div class="bex-search-section">
                    <span>
                        <i class="fa fa-bolt" aria-hidden="true"></i> Trending Searches:
                    </span>
                    <span>
                        <ul class="bex-trending-search-tab">
                            @foreach(['Hospitality','Hotels','Management','Education','Pre-School','Restaurants','Food Parlor'] as $search)
                                <li><a href="#">{{ $search }}</a></li>
                            @endforeach
                        </ul>
                    </span>
                </div>
            </div>
        </div>

        <div class="row catfull">
            <div class="filter" id="showftr">Apply Filter</div>
            @include('includes.catleftstartup')

            <div class="col-12 col-sm-9 col-md-9 mdy">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-9 setheading">
                        <h1 class="headblk">Start-UPs Looking for Investments</h1>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 float-right setmob">
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

                <div class="row">
                    <div class="col-md-12">
                        <p>
                            BusinessEx offers 547 Start-ups in 13 various industries. Start-ups are looking to sell their business from all over India in 13 various industries. The Start-ups listed are planning to sell. The Start-ups are available in 13 various industries which includes Web & mobile development, Beauty Salons, Education Supplies etc. For listing your Start-up, we recommend creating a Startup profile in BusinessEx.
                        </p>
                    </div>
                </div>

                <div class="row setvto">
                    @if(isset($startups) && $startups->count() > 0)
                        <ul class="listop otherlist">
                            @foreach($startups as $startup)
                                <li>
                                    <div class="ribbonblk">
                                        <div class="ribbonblkinner">{{ $startup->badge }}</div>
                                    </div>

                                    <div class="fullban">
                                        <a href="#"><img src="{{ $startup->image }}" alt="Startup Image"></a>
                                    </div>

                                    <div class="fullb cattxt">
                                        <span>{{ $startup->category }}</span>
                                        {{ $startup->title }}
                                    </div>

                                    <div class="fullb contxt">
                                        {{ $startup->description }}
                                    </div>

                                    <div class="sdd">
                                        <div class="sddinner"><img src="{{ asset('assets/img/phone.svg') }}"> <span>Phone</span></div>
                                        <div class="sddinner"><img src="{{ asset('assets/img/email.svg') }}"> <span>Email</span></div>
                                    </div>

                                    <div class="fullb citytxt">
                                        {{ $startup->location }}
                                    </div>

                                    <div class="tagv">
                                        @foreach($startup->tags as $tag)
                                            <div class="tagvinner">{{ $tag }}</div>
                                        @endforeach
                                    </div>

                                    <div class="backv">
                                        <div class="inblk">Seeking Investment <span><i class="fas fa-rupee-sign"></i> {{ $startup->investment }}</span></div>
                                        <div class="inblk">Requirement <span>{{ $startup->requirement }}</span></div>
                                        <div class="inblk">Establishment year <span>{{ $startup->est_year }}</span></div>
                                        <div class="inblk">Employee count <span>{{ $startup->employee_count }}</span></div>
                                        <div class="inblk">Entity type <span>{{ $startup->entity_type }}</span></div>
                                        <div class="inblk">Business type <span>{{ $startup->business_type }}</span></div>
                                    </div>

                                    <div class="inbtn"><a href="#">Contact Business</a></div>
                                </li>
                            @endforeach
                        </ul>

                        {{ $startups->links('pagination::bootstrap-4') }}
                    @else
                        <div class="alert alert-info">No startups found at the moment.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection