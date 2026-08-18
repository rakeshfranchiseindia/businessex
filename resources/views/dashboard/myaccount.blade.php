@extends('layouts.app')
<?php
use Illuminate\Support\Facades\Auth;
?>
@section('title', 'My Account')

@section('content')
    <div class="container-fluid" style="padding-top: 100px;">
        <div class="row">
            <!-- Sidebar -->
           @include('account_dashboard.dashboardSidebar')

            <!-- Main Content -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">My Profiles <small class="text-muted">(Create | Edit)</small></h5>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-3">
                            <li class="nav-item"><a class="nav-link active" href="#">New Listings</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Saved Searches</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Search History</a></li>
                        </ul>

                        <!-- Listing 1 -->
                        <div class="media mb-4">
                            <img src="{{ asset('assets/images/category/small/6.jpg') }}" class="mr-3 rounded" width="100"
                                alt="Listing">
                            <div class="media-body">
                                <h6 class="mt-0">Profitable CA Cold Storage Facility on 7 Acres</h6>
                                <p class="text-muted mb-1">Food & Beverage | Lalru</p>
                                <p><strong>₹17 Crores</strong> — Seeking Investment</p>
                                <a href="#" class="btn btn-outline-success btn-sm">Contact Business</a>
                            </div>
                        </div>

                        <!-- Listing 2 -->
                        <div class="media mb-4">
                            <img src="{{ asset('assets/images/category/small/10.jpg') }}" class="mr-3 rounded" width="100"
                                alt="Listing">
                            <div class="media-body">
                                <h6 class="mt-0">CUMA is a unisex salon combined with an authentic coffee café</h6>
                                <p class="text-muted mb-1">Delhi, Delhi</p>
                                <p><strong>Undisclosed</strong></p>
                                <a href="#" class="btn btn-outline-success btn-sm">Contact Business</a>
                            </div>
                        </div>

                        <!-- Listing 3 -->
                        <div class="media mb-4">
                            <img src="{{ asset('assets/images/category/small/5.jpg') }}" class="mr-3 rounded" width="100"
                                alt="Listing">
                            <div class="media-body">
                                <h6 class="mt-0">New Center Application</h6>
                                <p class="text-muted mb-1">Noida, Uttar Pradesh</p>
                                <p><strong>Undisclosed</strong></p>
                                <a href="#" class="btn btn-outline-success btn-sm">Contact Business</a>
                            </div>
                        </div>

                        <!-- Listing 4 -->
                        <div class="media mb-4">
                            <img src="{{ asset('assets/images/category/small/5.jpg') }}" class="mr-3 rounded" width="100"
                                alt="Listing">
                            <div class="media-body">
                                <h6 class="mt-0">Preschool cum daycare for sale</h6>
                                <p class="text-muted mb-1">Gurgaon, Haryana</p>
                                <p><strong>Undisclosed</strong></p>
                                <a href="#" class="btn btn-outline-success btn-sm">Contact Business</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="mb-0">Top 5 Recommendations</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="media mb-3">
                                <img src="{{ asset('assets/images/category/small/6.jpg') }}" class="mr-3 rounded" width="60"
                                    alt="Recommendation">
                                <div class="media-body">
                                    <strong>Property...</strong><br>
                                    <span class="text-muted">NA</span>
                                </div>
                            </li>
                            <li class="media mb-3">
                                <img src="{{ asset('assets/images/category/small/10.jpg') }}" class="mr-3 rounded"
                                    width="60" alt="Recommendation">
                                <div class="media-body">
                                    <strong>Wireless...</strong><br>
                                    <span class="text-muted">35 Crores — Seeking Investment</span>
                                </div>
                            </li>
                            <li class="media mb-3">
                                <img src="{{ asset('assets/images/category/small/5.jpg') }}" class="mr-3 rounded" width="60"
                                    alt="Recommendation">
                                <div class="media-body">
                                    <strong>Seeking...</strong><br>
                                    <span class="text-muted">NA</span>
                                </div>
                            </li>
                            <li class="media mb-3">
                                <img src="{{ asset('assets/images/category/small/6.jpg') }}" class="mr-3 rounded" width="60"
                                    alt="Recommendation">
                                <div class="media-body">
                                    <strong>Seeking...</strong><br>
                                    <span class="text-muted">7.5 Crores — Seeking Investment</span>
                                </div>
                            </li>
                            <li class="media">
                                <img src="{{ asset('assets/images/category/small/10.jpg') }}" class="mr-3 rounded"
                                    width="60" alt="Recommendation">
                                <div class="media-body">
                                    <strong>Application...</strong><br>
                                    <span class="text-muted">25 Lakhs — Asking Price</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection