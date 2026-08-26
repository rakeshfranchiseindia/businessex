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
                        Businesses
                    </li>
                </ol>
            </div>

           
        </div>

        <div class="row catfull">
            @include('includes.catleftbusinesses')

            <div class="col-12 col-sm-9 col-md-9 mdy setheading">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12">
                        <h1 class="headblk">Businesses For Sale and Buy in India</h1>
                        <p>BusinessEx offers 1863 Businesses and 14 industries Businesses For Sale and Buy in India as on Aug 11, 2026. These include Businesses looking to Exit, Seek Investment or Loan. To sell your Business or raise funding at BusinessEx, we recommend you to create a Business Profile on BusinessEx .</p>
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

                                <a href="{{ route('business.listing') }}" class="btn btn-sm btn-outline-secondary ml-auto">Reset</a>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row setvto">
                    @if(isset($businesses) && $businesses->count() > 0)
                        <ul class="listop otherlist">
                            @foreach($businesses as $business)
                                @php
                                    $businessImage = $business->images()->first();
                                    $imageUrl = !empty($businessImage?->image_path) ? $businessImage->image_path : asset('assets/img/default-business.jpg');
                                    $headline = $business->advmt_headline ?: $business->seller_company ?: 'Business Listing';
                                    $industryFilterItem = collect($industrySeller ?? [])->first(function ($item) use ($business) {
                                        return (int) ($item['subIndustryid'] ?? 0) === (int) $business->industry_sector;
                                    });
                                    $industryCategory = $industryFilterItem['subindustry']
                                        ?? config('industryCategoriesConfig.' . $business->industry_sector . '.category_name', $business->industry_sector ?: 'Business');
                                    $location = trim(($business->ofc_city ?? '') . (empty($business->ofc_city) || empty($business->ofc_state) ? '' : ', ') . stateDisplayName($business->ofc_state ?? ''));
                                    $annualSales = $business->annual_sales ? number_format((float) $business->annual_sales / 10000000, 2) . ' cr' : 'N/A';
                                    $askingAmount = $business->buyer_sell_price ? number_format((float) $business->buyer_sell_price / 10000000, 2) . ' Crores' : 'N/A';
                                @endphp
                                <li class="business-list-card">
                                    <div class="ribbonblk">
                                        <div class="ribbonblkinner">
                                            {{ $business->business_type ? config('constants.businessType.' . $business->business_type) : 'Business' }}
                                        </div>
                                    </div>

                                    <div class="fullban">
                                        <a href="#"><img src="{{ $imageUrl }}" alt="Business Image"></a>
                                    </div>

                                    <div class="fullb cattxt business-card-title">
                                        <div class="business-card-category">{{ $industryCategory }}</div>
                                        <span>{{ $business->seller_company ?: 'Business' }}</span>
                                        <h3>{{ $headline }}</h3>
                                    </div>

                                    <div class="business-investment-row">
                                        <span>Seeking Investment</span>
                                        <strong>{{ $askingAmount }}</strong>
                                    </div>

                                    <div class="business-card-details">
                                        <div class="inblk">Annual sale <span>{{ $annualSales }}</span></div>
                                        <div class="inblk">Establishment year <span>{{ $business->estb_year ?: 'N/A' }}</span></div>
                                        <div class="inblk">Employee count <span>{{ $business->emp_count ?: 'N/A' }}</span></div>
                                        <div class="inblk">Entity type <span>{{ $business->entity_type ? config('constants.businessEntity.' . $business->entity_type) : 'N/A' }}</span></div>
                                        <div class="inblk">Business type <span>{{ $business->business_type ? config('constants.businessType.' . $business->business_type) : 'N/A' }}</span></div>
                                    </div>

                                    <div class="business-card-location"><i class="fa fa-map-marker"></i> {{ $location ?: 'Location not specified' }}</div>

                                    <div class="inbtn business-card-contact">
                                        @auth
                                            <a href="{{ route('business.detail', $business->business_id) }}">Contact Business</a>
                                        @else
                                            <a href="#login" data-toggle="modal" data-target="#login">Contact Business</a>
                                        @endauth
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <div class="col-12 mt-3">
                            {{ $businesses->links('pagination::bootstrap-4') }}
                        </div>
                    @else
                        <div class="alert alert-info">No businesses found at the moment.</div>
                    @endif
                </div>
                
            </div>
        </div>
        @include("includes.groupcompany")
        @include("includes.newsletter")
    </div>
    @include("includes.categorylinkfooter")
</main>

<style>
    .business-list-card {
        height: auto !important;
        min-height: 0;
        padding: 10px 13px 0 !important;
    }

    .business-list-card .fullban {
        height: 198px;
        overflow: hidden;
        width: 100%;
    }

    .business-list-card .fullban img {
        height: 100%;
        object-fit: cover;
        width: 100%;
    }

    .business-card-title {
        padding: 12px 0 8px;
        text-align: center;
    }

    .business-card-title span {
        display: block;
        margin-bottom: 5px;
        text-align: left;
    }

    .business-card-category {
        color: #16a085;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 5px;
        text-align: left;
        text-transform: uppercase;
    }

    .business-card-title h3 {
        font-size: 22px;
        line-height: 25px;
        margin: 0;
    }

    .business-investment-row {
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

    .business-investment-row strong {
        color: #fff;
        font-size: 16px;
    }

    .business-card-details {
        padding: 0 0 4px;
    }

    .business-list-card .business-card-details .inblk {
        font-size: 16px;
        line-height: 22px;
        padding: 4px 0;
    }

    .business-list-card .business-card-details .inblk span {
        font-size: 16px;
    }

    .business-card-location {
        background: #fbfbfb;
        color: #231f20;
        font-size: 16px;
        line-height: 22px;
        padding: 6px 0 8px;
    }

    .business-card-contact {
        margin-top: 14px;
    }

    .business-card-contact a {
        font-size: 16px;
        padding: 11px 10px;
    }
</style>
@endsection