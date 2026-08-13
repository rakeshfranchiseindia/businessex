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
                                    $imageUrl = $businessImage && $businessImage->image_path ? $businessImage->image_path : asset('assets/img/default-business.jpg');
                                    $headline = $business->advmt_headline ?: $business->seller_company ?: 'Business Listing';
                                    $location = trim(($business->ofc_city ?? '') . (empty($business->ofc_city) || empty($business->ofc_state) ? '' : ', ') . ($business->ofc_state ?? ''));
                                    $annualSales = $business->annual_sales ? '₹ ' . number_format((float) $business->annual_sales, 2) : 'N/A';
                                @endphp
                                <li>
                                    <div class="ribbonblk">
                                        <div class="ribbonblkinner">
                                            {{ $business->business_type ? config('constants.businessType.' . $business->business_type) : 'Business' }}
                                        </div>
                                    </div>

                                    <div class="fullban">
                                        <a href="#"><img src="{{ $imageUrl }}" alt="Business Image"></a>
                                    </div>

                                    <div class="fullb cattxt">
                                        <span>{{ $business->seller_company ?: 'Business' }}</span>
                                        {{ $headline }}
                                    </div>

                                    <div class="fullb contxt">
                                        {{ $business->seller_intro ?: $business->company_summary ?: 'Business profile details available.' }}
                                    </div>

                                    <div class="sdd">
                                        <div class="sddinner"><img src="{{ asset('assets/img/phone.svg') }}"> <span>{{ $business->seller_mobile ?: 'Phone' }}</span></div>
                                        <div class="sddinner"><img src="{{ asset('assets/img/email.svg') }}"> <span>{{ $business->seller_email ?: 'Email' }}</span></div>
                                    </div>

                                    <div class="fullb citytxt">
                                        {{ $location ?: 'Location not specified' }}
                                    </div>

                                    <div class="backv">
                                        <div class="inblk">Asking price <span><i class="fas fa-rupee-sign"></i> {{ $business->buyer_sell_price ? number_format((float) $business->buyer_sell_price, 2) : 'N/A' }}</span></div>
                                        <div class="inblk">Annual sale <span><i class="fas fa-rupee-sign"></i> {{ $annualSales }}</span></div>
                                        <div class="inblk">Establishment year <span>{{ $business->estb_year ?: 'N/A' }}</span></div>
                                        <div class="inblk">Employee count <span>{{ $business->emp_count ?: 'N/A' }}</span></div>
                                        <div class="inblk">Entity type <span>{{ $business->entity_type ?: 'N/A' }}</span></div>
                                        <div class="inblk">Business type <span>{{ $business->business_type ?: 'N/A' }}</span></div>
                                    </div>

                                    <div class="inbtn"><a href="#">Contact Business</a></div>
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
@endsection