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
            @include('includes.catleftstartup', ['businessType' => $businessTypeData ?? 'all'])

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
                                <li class="startup-card">
                                    <div class="ribbonblk">
                                        <div class="ribbonblkinner">{{ $startup['badge'] }}</div>
                                    </div>

                                    <div class="fullban">
                                        <a href="{{ $startup['profile_url'] }}"><img src="{{ $startup['image'] }}" alt="{{ $startup['title'] }}"></a>
                                    </div>

                                    <div class="fullb cattxt startup-card-title">
                                        <span>{{ $startup['category'] }}</span>
                                        <h3>{{ $startup['title'] }}</h3>
                                    </div>

                                    <div class="startup-investment-row">
                                        <span>Seeking Investment</span>
                                        <strong>{{ $startup['investment'] }}</strong>
                                    </div>

                                    <div class="startup-details">
                                        <div class="inblk">
                                            Annual sale
                                            <span>{{ $startup['annual_sales'] ?? 0 }}</span>
                                        </div>
                                        <div class="inblk">
                                            Establishment Year 
                                            <span>{{ $startup['est_year'] }}</span>
                                        </div>
                                        <div class="inblk">
                                            Employee Count 
                                            <span>{{ $startup['employee_count'] }}</span>
                                        </div>
                                        <div class="inblk">
                                            Entity Type 
                                            <span>{{ $startup['entity_type'] }}</span>
                                        </div>
                                        <div class="inblk">
                                            Business Type 
                                            <span>{{ $startup['business_type'] }}</span>
                                        </div>
                                    </div>

                                    <div class="startup-location">
                                        <i class="fa fa-map-marker"></i> {{ $startup['location'] }}
                                    </div>

                                    <div class="inbtn startup-contact-button">
                                        <a href="mailto:{{ $startup['contact_email'] }}">Contact Startup</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        
                    @else
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <i class="fa fa-info-circle mr-2"></i>
                            <strong>No startups found</strong> matching your filters. Try adjusting your search criteria.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    
                </div>
                <!-- Pagination -->
                <div class="row mt-4">
                    <div class="col-12">
                        {{ $startups->render('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
        @include("includes.groupcompany")
        @include("includes.newsletter")
    </div>
    @include("includes.categorylinkfooter")
</main>

<style>
    .startup-card {
        padding: 10px 13px 0 !important;
        height: auto !important;
        min-height: 0;
    }

    .startup-card .fullban {
        width: 100%;
        height: 198px;
        overflow: hidden;
    }

    .startup-card .fullban img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .startup-card-title {
        padding: 12px 0 8px;
        text-align: center;
    }

    .startup-card-title span {
        text-align: left;
        margin-bottom: 16px;
    }

    .startup-card-title h3 {
        font-size: 22px;
        line-height: 25px;
        margin: 0;
    }

    .startup-investment-row {
        align-items: center;
        background: #16a085;
        color: #fff;
        display: flex;
        font-size: 18px;
        justify-content: space-between;
        line-height: 22px;
        margin: 0 0 4px;
        padding: 6px;
    }

    .startup-investment-row strong {
        color: #fff;
        font-size: 16px;
    }

    .startup-details {
        background: #fff;
        padding: 0 0 4px;
    }

    .startup-card .startup-details .inblk {
        font-size: 16px;
        line-height: 22px;
        padding: 4px 0;
    }

    .startup-card .startup-details .inblk span {
        font-size: 16px;
    }

    .startup-location {
        background: #fbfbfb;
        color: #231f20;
        font-size: 16px;
        line-height: 22px;
        padding: 6px 0 8px;
    }

    .startup-contact-button {
        margin-top: 14px;
    }

    .startup-contact-button a {
        font-size: 16px;
        padding: 11px 10px;
    }
</style>
@endsection