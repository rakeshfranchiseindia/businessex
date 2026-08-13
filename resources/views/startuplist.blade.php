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
                        Start-ups
                    </li>
                </ol>
            </div>

           
        </div>

        <div class="row catfull">
            @include('includes.catleftstartup')

            <div class="col-12 col-sm-9 col-md-9 mdy setheading">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12">
                        <h1 class="headblk">Startups in India</h1>
                        <p>BusinessEx offers 678 Start-ups in 13 various industries .These promising Startups are looking to Raise Funds for their Growth or Expansion. To seek Investment, Loan, Mentors, Incubators or Accelerators for your Startup, we recommend you to create a Startup Profile on BusinessEx, we recommend to create a Startup profile in BusinessEx.</p>
                    </div>
                    
                </div>

                @php
                    $selectedLocationIds = collect(request()->input('location', []))->map(fn ($value) => (int) $value)->all();
                    $selectedIndustryIds = collect(request()->input('industry', []))->map(fn ($value) => (int) $value)->all();

                    $selectedLocationNames = collect($locations ?? [])->filter(function ($item) use ($selectedLocationIds) {
                        $id = (int) ($item->id ?? $item['id'] ?? 0);
                        return in_array($id, $selectedLocationIds, true);
                    })->map(function ($item) {
                        return trim((string) ($item->city ?? $item['city'] ?? ''));
                    })->filter()->values()->all();

                    $selectedIndustryNames = collect($industrySeller ?? [])->filter(function ($item) use ($selectedIndustryIds) {
                        $id = (int) ($item['subIndustryid'] ?? 0);
                        return in_array($id, $selectedIndustryIds, true);
                    })->map(function ($item) {
                        return trim((string) ($item['subindustry'] ?? ''));
                    })->filter()->values()->all();

                    $selectedFilters = array_merge(
                        $selectedLocationNames,
                        $selectedIndustryNames
                    );
                @endphp

                @if(!empty($selectedFilters) || ($businessType ?? 'all') !== 'all')
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="d-flex flex-wrap align-items-center gap-2 p-3 border rounded bg-light">
                                <strong class="mr-2">Selected filters:</strong>

                                @if(($businessType ?? 'all') !== 'all')
                                    <span class="badge badge-primary mr-2">{{ ucfirst($businessType) }}</span>
                                @endif

                                @foreach($selectedFilters as $selectedFilter)
                                    <span class="badge badge-secondary mr-2">{{ $selectedFilter }}</span>
                                @endforeach

                                <a href="{{ route('startup.listing') }}" class="btn btn-sm btn-outline-secondary ml-auto">Reset</a>
                            </div>
                        </div>
                    </div>
                @endif

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
        @include("includes.groupcompany")
        @include("includes.newsletter")
    </div>
    @include("includes.categorylinkfooter")
</main>
@endsection