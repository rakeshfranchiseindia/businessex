@extends('account_dashboard.accountDashboardApp')
@section('title', 'My Account')

@section('content')

<style>
  .investor-image-fallback {
    width: 200px;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    color: #fff;
    font-size: 72px;
    font-weight: 700;
  }
</style>

<div class="container-fluid py-4">
  <div class="row">
@include('account_dashboard.dashboardSidebar')
    <main class="col-lg-9">
      <div class="main-content">
        <h5 class="page-title">STARTUP PROFILE</h5>

        <div class="investor-profile-section">
          <div class="investor-images">
            @if(!empty($user->profile_pic) && file_exists(public_path($user->profile_pic)))
              <img src="{{ asset($user->profile_pic) }}" alt="Startup" class="investor-image-large">
            @else
              <div class="investor-image-fallback">{{ strtoupper(substr($user->name ?? 'S', 0, 1)) }}</div>
            @endif
          </div>

          <div class="investor-details">
            <h4>{{ $profile->advmt_headline ?? 'Not Set' }}</h4>
            <p class="text-muted">{{ $profile->startup_intro ?? 'Not Set' }}</p>

            <div class="detail-row"><span class="detail-label">Name:</span><span class="detail-value"> {{ $user->name ?? 'N/A' }}<i class="fas fa-map-marker-alt"></i> {{ $user->location ?? 'Location Not Set' }}</span></div>
            <div class="detail-row"><span class="detail-label">Mobile:</span><span class="detail-value">{{ $user->mobile ?? 'Not Provided' }}</span></div>
            <div class="detail-row"><span class="detail-label">Email:</span><span class="detail-value">{{ $user->email ?? 'Not Provided' }}</span></div>
            <div class="detail-row"><span class="detail-label">Entity Name:</span><span class="detail-value">{{ $profile->name_of_entity ?? 'Not Set' }}</span></div>
            <div class="detail-row"><span class="detail-label">Location:</span><span class="detail-value">{{ $profile->ofc_city ?? 'Not Set' }}</span></div>
            <div class="detail-row"><span class="detail-label">Company Summary:</span><span class="detail-value">{{ $profile->company_summary ?? 'N/A' }}</span></div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>

@endsection
