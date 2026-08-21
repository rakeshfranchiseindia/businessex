@extends('layouts.app')
@php
    $startupTitle = $startup->advmt_headline ?: $startup->startup_name ?: 'Startup Profile';
    $startupLocation = trim(collect([$startup->ofc_city, $startup->ofc_state, $startup->ofc_country])->filter()->implode(', '));
    $startupImages = $startup->images->filter(fn ($image) => $image->type == 1 && $image->is_active && !empty($image->startup_img_path));
    $industryName = config('industryCategoriesConfig.' . $startup->industry_sector . '.category_name', 'N/A');
    $entityName = config('constants.entityType.' . $startup->nature_of_entity, $startup->nature_of_entity ?: 'N/A');
    $businessTypeName = config('constants.businessType.' . $startup->business_type, $startup->business_type ?: 'N/A');
    $companyStage = config('constants.companyStage.' . $startup->company_stage, $startup->company_stage ?: 'N/A');
@endphp

@section('title', $startupTitle)
@section("content")
<main id="main">
    <div class="container bex-main">
        <div class="row">
            <div class="col-12">
                <ul class="brunnar">
                    <li><a href="#">Home</a></li>
                    <li>/</li>
                    <li><a href="#">Business</a></li>
                    <li>/</li>
                    <li><a href="#">{{ $industryName }}</a></li>
                    <li>/</li>
                    <li><a href="#">{{ $startup->startup_name ?: 'Startup' }}</a></li>
                    <li>/</li>
                    <li>{{ $startupTitle }}</li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h1 class="headblk">
                    {{ $startupTitle }}
                </h1>
                <p class="statictxt">
                    {{ $startup->startup_intro ?: $startup->company_summary ?: 'Startup profile details.' }}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <ul class="bexdlist">
                    <li><span class="fa-lock-icon">Business Name (Available after interaction)</span></li>
                    <li class="linesh">|</li>
                    <li><span class="fa-lock-icon">{{ $startupLocation ?: 'Location not specified' }}</span></li>
                    <li class="linesh">|</li>
                    <li>Profile Listed By: Owner</li>
                </ul>
            </div>
        </div>

        <div class="row landpage">
            <div class="col-12 col-md-9">
                {{-- Carousel --}}
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    @if($startupImages->isNotEmpty())
                        <ol class="carousel-indicators">
                            @foreach($startupImages as $index => $image)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>
                    @endif
                    <div class="carousel-inner">
                        <?php //print_r($startupImages); die;?>
                        @forelse($startupImages as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset('assets/img/shutterstock_130517294.jpg') }}" class="d-block w-100" alt="{{ $startupTitle }}">
                            </div>
                        @empty
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/img/placeholder-startup.png') }}" class="d-block w-100" alt="{{ $startupTitle }}">
                            </div>
                        @endforelse
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                {{-- Business Details --}}
                <ul class="mainsecdet">
                    <li><span>Seeking Investment</span> {{ $startup->inv_asking_price ? 'INR ' . number_format((float) $startup->inv_asking_price, 2) : 'N/A' }}</li>
                    <li class="linesh">|</li>
                    <li><span>Annual Sales/Turnover</span> {{ $startup->annual_sales ? number_format((float) $startup->annual_sales, 2) : 'N/A' }}</li>
                    <li class="linesh">|</li>
                    <li><span>Gross Income</span> {{ $startup->gross_profit ? number_format((float) $startup->gross_profit, 2) : 'N/A' }}</li>
                </ul>

                {{-- Tabs --}}
                <div class="fulldetailpage">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#BusinessD">Business</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Financial">Financials</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#BusinessPlan">Business Plan</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#BusinessRequirement">Business Requirement</a></li>
                    </ul>

                    <div class="tab-content">
                        {{-- Business Tab --}}
                        <div class="tab-pane active" id="BusinessD">
                            <p>{{ $startup->company_summary ?: $startup->startup_intro ?: 'N/A' }}</p>
                            <div class="bexdetailsh">Director / CEO information <span class="lock-icon"> Available after Interaction</span></div>
                            <div class="bexdetailsh">Management Team information <span class="lock-icon"> Available after Interaction</span></div>
                            <div class="bexdetailsh">One line Business Pitch <span>{{ $startup->business_pitch ?: 'N/A' }}</span></div>
                            <div class="bexdetailsh">Business Overview <span>{{ $startup->company_summary ?: 'N/A' }}</span></div>
                            <div class="bexdetailsh">Facilities
                                <span>
                                    <ul>
                                        @if($startup->facilities_desc)
                                            <li>{{ $startup->facilities_desc }}</li>
                                        @else
                                            <li>N/A</li>
                                        @endif
                                    </ul>
                                </span>
                            </div>
                        </div>

                        {{-- Financials Tab --}}
                        <div class="tab-pane" id="Financial">
                            <ul class="bexshowdt">
                                <li><span class="b1">Annual Sales</span><span class="b2">:</span><span class="b3">{{ $startup->annual_sales ? number_format((float) $startup->annual_sales, 2) : 'N/A' }}</span></li>
                                <li><span class="b1">EBITDA</span><span class="b2">:</span><span class="b3">{{ $startup->ebitda ? number_format((float) $startup->ebitda, 2) : 'N/A' }}</span></li>
                                <li><span class="b1">Gross Income</span><span class="b2">:</span><span class="b3">{{ $startup->gross_profit ? number_format((float) $startup->gross_profit, 2) : 'N/A' }}</span></li>
                            </ul>
                        </div>

                        {{-- Business Plan Tab --}}
                        <div class="tab-pane" id="BusinessPlan">
                            <div class="bexdetailsh">Select your Company stage <span>{{ $companyStage }}</span></div>
                            <div class="bexdetailsh">Company Summary <span>{{ $startup->company_summary ?: 'N/A' }}</span></div>
                        </div>

                        {{-- Business Requirement Tab --}}
                        <div class="tab-pane" id="BusinessRequirement">
                            <div class="bexdetailsh">Business Requirement</div>
                            <ul class="bexshowdt">
                                <li><span class="b1">Looking For</span><span class="b2">:</span><span class="b3">{{ $startup->seeking_investors ? 'Investment' : 'N/A' }}</span></li>
                                <li><span class="b1">Amount</span><span class="b2">:</span><span class="b3">{{ $startup->inv_asking_price ? number_format((float) $startup->inv_asking_price, 2) . ' at ' . ($startup->inv_stake ?: 0) . '% stake' : 'N/A' }}</span></li>
                                <li><span class="b1">Reason</span><span class="b2">:</span><span class="b3">{{ $startup->inv_reason ?: 'N/A' }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
@endsection