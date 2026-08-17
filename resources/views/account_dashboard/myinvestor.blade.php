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
        <h5 class="page-title">INVESTOR PROFILE</h5>

        <div class="investor-profile-section">
          <div class="investor-images">
            @if(!empty($user->profile_pic) && file_exists(public_path($user->profile_pic)))
              <img src="{{ asset($user->profile_pic) }}" alt="Investor" class="investor-image-large">
            @else
              <div class="investor-image-fallback">{{ strtoupper(substr($user->name ?? 'I', 0, 1)) }}</div>
            @endif
          </div>
          
          <div class="investor-details">
            <h4>{{ $profile->inv_headline ?? 'Not Set' }}</h4>
            <p class="text-muted">{{ $profile->inv_intro ?? 'Not Set' }}</p>
            
            <div class="detail-row"><span class="detail-label">Name:</span><span class="detail-value"> {{ $user->name ?? 'N/A' }}<i class="fas fa-map-marker-alt"></i> {{ $user->location ?? 'Location Not Set' }}</span></div>
            <div class="detail-row"><span class="detail-label">Mobile:</span><span class="detail-value">{{ $user->mobile ?? 'Not Provided' }}</span></div>
            <div class="detail-row"><span class="detail-label">Email:</span><span class="detail-value">{{ $user->email ?? 'Not Provided' }}</span></div>
            <div class="detail-row"><span class="detail-label">Investor Type:</span><span class="detail-value">Individual Investor</span></div>
            <div class="detail-row"><span class="detail-label">Company Sector:</span><span class="detail-value">{{ $user->company_name ?? 'Not Set' }}</span></div>
            <div class="detail-row"><span class="detail-label">Company Summary</span><span class="detail-value"></span>{{ $profile->company_summary ?? 'N/A' }}</span></div>
            <div class="detail-row"><span class="detail-label">Professional Summary</span></div>
            <div class="detail-row"><span class="detail-label">Investment Size:</span><span class="detail-value">{{ $profile->invest_size_min?? 'N/A' }}</span></div>
            <div class="detail-row"><span class="detail-label">Investment Stake Preference:</span><span class="detail-value">%</span></div>
            <div class="detail-row"><span class="detail-label">Investment Preference:</span><span class="detail-value">Investment</span></div>
            <div class="detail-row"><span class="detail-label">Sector Preference</span></div>
            <div class="detail-row"><span class="detail-label">Location Preference</span></div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>

<footer class="footer-section">
  <div class="container-fluid">
    <div class="group-companies"><h4>Our Group Companies</h4><div class="company-logos"><img src="https://via.placeholder.com/150x60/fff/d32f2f?text=franchiseindia.com" class="company-logo"><img src="https://via.placeholder.com/150x60/673ab7/fff?text=Dealer+India" class="company-logo"><img src="https://via.placeholder.com/150x60/fff/c62828?text=IndianRetailer" class="company-logo"><img src="https://via.placeholder.com/150x60/fff/d32f2f?text=RESTAURANT+INDIA" class="company-logo"><img src="https://via.placeholder.com/150x60/fff/1976d2?text=FranCorp" class="company-logo"><img src="https://via.placeholder.com/150x60/fff/00897b?text=FranGlobal" class="company-logo"><img src="https://via.placeholder.com/150x60/212121/fff?text=Entrepreneur" class="company-logo"><img src="https://via.placeholder.com/150x60/fff/0277bd?text=LICENSE+INDIA" class="company-logo"><img src="https://via.placeholder.com/150x60/fff/455a64?text=ISFA" class="company-logo"></div></div>
    <div class="newsletter-section"><div class="row align-items-center"><div class="col-md-6"><h3>Get Industry First Insights</h3><p>Sign up for our exclusive Newsletter</p></div><div class="col-md-6"><form class="newsletter-form row"><div class="col-sm-6 mb-2"><input type="text" class="form-control" placeholder="Name"></div><div class="col-sm-6 mb-2"><input type="email" class="form-control" placeholder="Email"></div><div class="col-sm-6 mb-2"><input type="tel" class="form-control" placeholder="Contact No."></div><div class="col-sm-6 mb-2"><input type="text" class="form-control" placeholder="City"></div><div class="col-12 text-center mt-2"><button type="submit" class="btn-subscribe">Subscribe Now</button></div></form></div></div></div>
    <div class="footer-bottom"><div class="container-fluid"><div class="row align-items-center"><div class="col-md-6"><strong>Follow BusinessEx</strong><div class="social-links-footer mt-2"><a href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i class="fab fa-twitter"></i></a><a href="#"><i class="fab fa-instagram"></i></a><a href="#"><i class="fab fa-linkedin-in"></i></a><a href="#"><i class="fab fa-youtube"></i></a></div></div><div class="col-md-6 text-right"><span>Stay tuned & get updated</span></div></div></div></div>
    <div class="copyright"><p>Copyright © 2021 to 2025 BusinessEx</p></div>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/main.js"></script>
@endsection
