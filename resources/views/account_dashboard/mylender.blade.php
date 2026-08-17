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
        <h5 class="page-title">LENDER PROFILE</h5>

        <div class="investor-profile-section">
          <div class="investor-images">
            @if(!empty($user->profile_pic) && file_exists(public_path($user->profile_pic)))
              <img src="{{ asset($user->profile_pic) }}" alt="Lender" class="investor-image-large">
            @else
              <div class="investor-image-fallback">{{ strtoupper(substr($user->name ?? 'L', 0, 1)) }}</div>
            @endif
          </div>

          <div class="investor-details">
            <h4>{{ $profile->lender_adv_headline ?? 'Not Set' }}</h4>
            <p class="text-muted">{{ $profile->lender_intro ?? 'Not Set' }}</p>

            <div class="detail-row"><span class="detail-label">Name:</span><span class="detail-value"> {{ $user->name ?? 'N/A' }}<i class="fas fa-map-marker-alt"></i> {{ $user->location ?? 'Location Not Set' }}</span></div>
            <div class="detail-row"><span class="detail-label">Mobile:</span><span class="detail-value">{{ $user->mobile ?? 'Not Provided' }}</span></div>
            <div class="detail-row"><span class="detail-label">Email:</span><span class="detail-value">{{ $user->email ?? 'Not Provided' }}</span></div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>

@endsection
