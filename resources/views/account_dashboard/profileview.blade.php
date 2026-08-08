
@extends('account_dashboard.accountDashboardApp')
@section('title', 'My Account')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <!-- Sidebar -->
     
@include('partials.sidebar')

    <!-- Main Content -->
    <main class="col-lg-9">
      <div class="main-content">
        <h5 class="page-title">PROFILE VIEW</h5>
        
        <div class="profile-view-chart">
          <div class="chart-placeholder">
            <div style="display:flex; justify-content:center; gap:50px;">
              <div style="text-align:center;">
                <div style="font-size:24px; color:#ccc;"><i class="far fa-eye"></i></div>
                <div style="font-size:12px; color:#999;">0</div>
              </div>
              <div style="text-align:center;">
                <div style="font-size:24px; color:#1abc9c;"><i class="fas fa-eye"></i></div>
                <div style="font-size:14px; font-weight:600;">0</div>
              </div>
            </div>
            <div class="mt-4">
              <svg width="400" height="150" viewBox="0 0 400 150">
                <line x1="20" y1="130" x2="380" y2="130" stroke="#eee" stroke-width="1"/>
                <line x1="20" y1="10" x2="20" y2="130" stroke="#eee" stroke-width="1"/>
                <polyline points="50,120 100,115 150,125 200,110 250,118 300,105 350,115" fill="none" stroke="#1abc9c" stroke-width="2"/>
                <circle cx="200" cy="110" r="4" fill="#1abc9c"/>
                <text x="190" y="95" font-size="11" fill="#1abc9c">Series 1</text>
              </svg>
            </div>
          </div>
        </div>

        <div class="mt-4 p-3 bg-light rounded text-center">
          <strong>TOTAL PROFILE VISITS: 0</strong>
        </div>

        <div class="empty-state mt-4">
          <i class="fas fa-users"></i>
          <h5>Profile owners viewed your profile.</h5>
        </div>
      </div>
    </main>
  </div>
</div>

<footer class="footer-section">
  <div class="container-fluid">
    <div class="group-companies">
      <h4>Our Group Companies</h4>
      <div class="company-logos">
        <img src="https://via.placeholder.com/150x60/fff/d32f2f?text=franchiseindia.com" class="company-logo">
        <img src="https://via.placeholder.com/150x60/673ab7/fff?text=Dealer+India" class="company-logo">
        <img src="https://via.placeholder.com/150x60/fff/c62828?text=IndianRetailer" class="company-logo">
        <img src="https://via.placeholder.com/150x60/fff/d32f2f?text=RESTAURANT+INDIA" class="company-logo">
        <img src="https://via.placeholder.com/150x60/fff/1976d2?text=FranCorp" class="company-logo">
        <img src="https://via.placeholder.com/150x60/fff/00897b?text=FranGlobal" class="company-logo">
        <img src="https://via.placeholder.com/150x60/212121/fff?text=Entrepreneur" class="company-logo">
        <img src="https://via.placeholder.com/150x60/fff/0277bd?text=LICENSE+INDIA" class="company-logo">
        <img src="https://via.placeholder.com/150x60/fff/455a64?text=ISFA" class="company-logo">
      </div>
    </div>
    <div class="newsletter-section">
      <div class="row align-items-center">
        <div class="col-md-6"><h3>Get Industry First Insights</h3><p>Sign up for our exclusive Newsletter</p></div>
        <div class="col-md-6">
          <form class="newsletter-form row">
            <div class="col-sm-6 mb-2"><input type="text" class="form-control" placeholder="Name"></div>
            <div class="col-sm-6 mb-2"><input type="email" class="form-control" placeholder="Email"></div>
            <div class="col-sm-6 mb-2"><input type="tel" class="form-control" placeholder="Contact No."></div>
            <div class="col-sm-6 mb-2"><input type="text" class="form-control" placeholder="City"></div>
            <div class="col-12 text-center mt-2"><button type="submit" class="btn-subscribe">Subscribe Now</button></div>
          </form>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-md-6"><strong>Follow BusinessEx</strong><div class="social-links-footer mt-2"><a href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i class="fab fa-twitter"></i></a><a href="#"><i class="fab fa-instagram"></i></a><a href="#"><i class="fab fa-linkedin-in"></i></a><a href="#"><i class="fab fa-youtube"></i></a></div></div>
          <div class="col-md-6 text-right"><span>Stay tuned & get updated</span></div>
        </div>
      </div>
    </div>
    <div class="copyright"><p>Copyright © 2021 to 2025 BusinessEx</p></div>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/main.js"></script>
@endsection

