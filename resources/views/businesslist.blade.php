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
                        Businesses for Sale
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

                <div class="row setvto">
                    @if(isset($businesses) && $businesses->count() > 0)
                        <ul class="listop otherlist">
                            @foreach($businesses as $business)
                                <li>
                                    <div class="ribbonblk">
                                        <div class="ribbonblkinner">{{ $business->badge }}</div>
                                    </div>

                                    <div class="fullban">
                                        <a href="#"><img src="{{ $business->image }}" alt="Business Image"></a>
                                    </div>

                                    <div class="fullb cattxt">
                                        <span>{{ $business->category }}</span>
                                        {{ $business->title }}
                                    </div>

                                    <div class="fullb contxt">
                                        {{ $business->description }}
                                    </div>

                                    <div class="sdd">
                                        <div class="sddinner"><img src="{{ asset('assets/img/phone.svg') }}"> <span>Phone</span></div>
                                        <div class="sddinner"><img src="{{ asset('assets/img/email.svg') }}"> <span>Email</span></div>
                                    </div>

                                    <div class="fullb citytxt">
                                        {{ $business->location }}
                                    </div>

                                    <div class="tagv">
                                        @foreach($business->tags as $tag)
                                            <div class="tagvinner">{{ $tag }}</div>
                                        @endforeach
                                    </div>

                                    <div class="backv">
                                        <div class="inblk">Asking price <span><i class="fas fa-rupee-sign"></i> {{ $business->asking_price }}</span></div>
                                        <div class="inblk">Annual sale <span><i class="fas fa-rupee-sign"></i> {{ $business->annual_sale }}</span></div>
                                        <div class="inblk">Establishment year <span>{{ $business->est_year }}</span></div>
                                        <div class="inblk">Employee count <span>{{ $business->employee_count }}</span></div>
                                        <div class="inblk">Entity type <span>{{ $business->entity_type }}</span></div>
                                        <div class="inblk">Business type <span>{{ $business->business_type }}</span></div>
                                    </div>

                                    <div class="inbtn"><a href="#">Contact Business</a></div>
                                </li>
                            @endforeach
                        </ul>

                        {{ $businesses->links('pagination::bootstrap-4') }}
                    @else
                        <div class="alert alert-info">No businesses found at the moment.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection