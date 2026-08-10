@extends('layouts.app')

@section('title', 'My Account')

@section('content')

<div class="container-fluid py-4">
  <div class="row">
    <aside class="col-lg-3 mb-4">
      <div class="dashboard-sidebar">
        <div class="user-profile-card">
          <div class="profile-image-container"><img src="https://via.placeholder.com/100" alt="Profile" class="profile-image"><div class="profile-edit-icon"><i class="fas fa-pencil-alt"></i></div></div>
          <p class="user-location"><i class="fas fa-map-marker-alt"></i> North Delhi</p>
          <h5 class="user-name">Billiehic Billiehic</h5>
          <div class="user-contact"><p><i class="far fa-envelope"></i> techsupport@franchiseindia.com</p><p><i class="fas fa-phone"></i> 9899811050</p></div>
          <div class="social-links mt-3"><a href="#"><i class="fab fa-facebook-f"></i></a><a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a><a href="#" style="background:#1da1f2"><i class="fa-brands fa-x-twitter"></i></a></div>
        </div>
        <div class="profile-type-select"><label style="font-size:12px; font-weight:600; color:#666;">PROFILE</label><select onchange="changeProfileType(this)"><option value="investor" selected>Investor</option><option value="mentor">Mentor</option><option value="lender">Lender</option></select></div>
        <button class="btn-my-plan">MY PLAN</button>
        <ul class="sidebar-menu">
          <li><a href="myaccount.html"><i class="fas fa-th-large"></i> Dashboard</a></li>
          <li><a href="profileview.html"><i class="far fa-eye"></i> Profile Views <span class="badge">0</span></a></li>
          <li><a href="myinvestor.html"><i class="far fa-user"></i> My Profile</a></li>
          <li class="has-submenu"><a href="#" onclick="toggleSubmenu(this)" class="active"><i class="far fa-comments"></i> My Interactions <i class="fas fa-chevron-down float-right mt-1"></i></a><ul class="submenu show"><li><a href="contactHistory.html">Contact History</a></li><li><a href="instaResponse.html">Insta Response</a></li><li><a href="bxproposal.html" class="active">BX Proposal</a></li></ul></li>
                    <li class="has-submenu"><a href="#" onclick="toggleSubmenu(this)" class="active">
                      <i class="far fa-comments">
                      </i> My Interactions <i class="fas fa-chevron-down float-right mt-1"></i>
                    </a><ul class="submenu show"><li><a href="contactHistory.html">Confidential Info</a></li>
                    <li><a href="instaResponse.html">Advert Detail</a></li>
                    <li><a href="instaResponse.html">Preferences</a></li>
                    <li><a href="bxproposal.html" class="active">Profile Info</a></li></ul></li>

          <li><a href="#"><i class="fas fa-lock"></i> Change Password</a></li>
        </ul>
      </div>
    </aside>

    <main class="col-lg-9">
      <div class="main-content">
        <h5 class="page-title">BUSINESS EX PROPOSAL</h5>
        
        <div class="empty-state">
          <i class="far fa-file-alt"></i>
          <h5>No Bx Proposal data found !</h5>
        </div>

        <div class="recommendations-section mt-4">
          <h5>TOP 5 RECOMMENDATIONS</h5>
          <div class="recommendation-item"><img src="https://via.placeholder.com/70x55" alt="Business"><div class="recommendation-info"><h6>Looking For...</h6><p>15 Crores Investment</p></div></div>
          <div class="recommendation-item"><img src="https://via.placeholder.com/70x55" alt="Business"><div class="recommendation-info"><h6>Profitable...</h6><p>1.5 Crores Seeking Investment</p></div></div>
          <div class="recommendation-item"><img src="https://via.placeholder.com/70x55" alt="Business"><div class="recommendation-info"><h6>Publishing...</h6><p>1 Cr SEEKING INVESTMENT</p></div></div>
          <div class="recommendation-item"><img src="https://via.placeholder.com/70x55" alt="Business"><div class="recommendation-info"><h6>Featured Business</h6><p>Best Email... NA</p></div></div>
          <div class="recommendation-item"><img src="https://via.placeholder.com/70x55" alt="Business"><div class="recommendation-info"><h6>Looking For...</h6><p>35 Lakhs INVESTMENT</p></div></div>
        </div>
      </div>
    </main>
  </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/main.js"></script>
@endsection