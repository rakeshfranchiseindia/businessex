<?php 
use Illuminate\Support\Facades\Auth;
use App\Models\UserAccount;
$user_id = Auth::id();
$user = UserAccount::findOrFail($user_id);

?>

<aside class="col-lg-3 mb-4">
  <div class="dashboard-sidebar">
    <div class="user-profile-card">
      <div class="profile-image-container"><img src="https://via.placeholder.com/100" alt="Profile"
          class="profile-image">
        <a href="{{ route('user.edit.page') }}" class="profile-edit-icon">
          <i class="fas fa-pencil-alt"></i>
        </a>
      </div>
      <p class="user-location"><i class="fas fa-map-marker-alt"></i>{{ $user->location ?? 'Not Set' }}</p>
      <h5 class="user-name">{{ $user->name ?? 'Not Set' }}</h5>
      <div class="user-contact">
        <p><i class="far fa-envelope"></i>{{ $user->email ?? 'Not Set' }}</p>
        <p><i class="fas fa-phone"></i>{{ $user->mobile ?? 'N/A' }}</p>
      </div>
      <div class="social-links mt-3"><a href="#"><i class="fab fa-facebook-f"></i></a><a href="#" class="linkedin"><i
            class="fab fa-linkedin-in"></i></a><a href="#" style="background:#1da1f2"><i
            class="fa-brands fa-x-twitter"></i></a></div>
    </div>
    <div class="profile-type-select"><label style="font-size:12px; font-weight:600; color:#666;">PROFILE</label><select
        onchange="changeProfileType(this)">
        <option value="investor" selected>Investor</option>
        <option value="mentor">Mentor</option>
        <option value="lender">Lender</option>
      </select></div>
    <button class="btn-my-plan">MY PLAN</button>
    <ul class="sidebar-menu">
      <li><a href="{{ route('myaccount') }}"><i class="fas fa-th-large"></i> Dashboard</a></li>
      <li><a href="{{ route('profileview') }}"><i class="far fa-eye"></i> Profile Views <span class="badge">0</span></a></li>
      <li><a href="{{ route('get.user.details') }}"><i class="far fa-user"></i> My Profile</a></li>
      <li class="has-submenu"><a href="#" onclick="toggleSubmenu(this)"><i class="far fa-comments"></i> My Interactions
          <i class="fas fa-chevron-down float-right mt-1"></i></a>
        <ul class="submenu">
          <li><a href="contactHistory.html">Contact History</a></li>
          <li><a href="instaResponse.html">Insta Response</a></li>
          <li><a href="bxproposal.html">BX Proposal</a></li>
        </ul>
      </li>
      <li class="has-submenu"><a href="#" onclick="toggleSubmenu(this)" class="active"><i class="far fa-comments"></i>
          My Interactions <i class="fas fa-chevron-down float-right mt-1"></i></a>
        <ul class="submenu show">
          <li><a href="contactHistory.html">Contact History</a></li>
          <li><a href="instaResponse.html">Insta Response</a></li>
          <li><a href="bxproposal.html" class="active">BX Proposal</a></li>
        </ul>
      </li>
      <li class="has-submenu"><a href="#" onclick="toggleSubmenu(this)" class="active">
          <i class="far fa-comments">
          </i> Manage <i class="fas fa-chevron-down float-right mt-1"></i>
          <a href="{{ route('confidential.edit', ['user_rand_id' => auth()->user()->user_rand_id]) }}">
            Confidential Info
          </a>
      <li><a href="{{ route('confidential.advert_detail', ['user_rand_id' => auth()->user()->user_rand_id]) }}">Advert
          Detail</a></li>
      <li><a href="instaResponse.html">Preferences</a></li>
      <li><a href="bxproposal.html" class="active">Profile Info</a></li>
    </ul>
    </li>
    <li><a href="{{ route('change.password') }}"><i class="fas fa-lock"></i> Change Password</a></li>
    </ul>
  </div>
</aside>