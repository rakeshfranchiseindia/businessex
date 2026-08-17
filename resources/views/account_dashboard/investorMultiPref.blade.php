@extends('account_dashboard.accountDashboardApp')
@section('title', 'My Account')
@section('content')

<div class="container-fluid py-4">
    <div class="row">
      @include('account_dashboard.dashboardSidebar')
        <div id="conf-tab4" class="tab-content">
            <form class="needs-validation" novalidate>
                {{-- Sector Preference --}}
                <div class="form-group">
                    <label>Sector Preference *:</label>
                    <div class="tags-container">
                        @foreach($indPref as $sector)
                            <span class="tag-item" data-tag="{{ $sector->name }}">
                                <span>{{ $sector->name }}</span>
                                <span class="remove-tag">&times;</span>
                            </span>
                        @endforeach
                        <input type="text" class="tags-input form-control border-0" placeholder="Type and press Enter...">
                        <input type="hidden" name="sectors" value="{{ $indPref->pluck('name')->implode(',') }}">
                    </div>
                </div>

                {{-- Location Preference --}}
                <div class="form-group">
                    <label>Location Preference *:</label>
                    <div class="tags-container">
                        @foreach($locationPref as $loc)
                            <span class="tag-item" data-tag="{{ $loc->location_name }}">
                                <span>{{ $loc->location_name }}</span>
                                <span class="remove-tag">&times;</span>
                            </span>
                        @endforeach
                        <input type="text" class="tags-input form-control border-0" placeholder="Enter location preferences">
                        <input type="hidden" name="locations" value="{{ $locationPref->pluck('location_name')->implode(',') }}">
                    </div>
                </div>

                <button type="submit" class="btn-submit">SUBMIT</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/main.js"></script>
@endsection
