<?php
use Illuminate\Support\Facades\Auth;
use App\Models\UserAccount;

require_once app_path('Helpers/common_helper.php');

$user_id = Auth::id();
$user = UserAccount::findOrFail($user_id);

// Only offer the profile types this user actually has a profile for
// (user_profiles is the authoritative registry — see common_helper.php).
$availableProfileTypes = getAvailableProfileTypes($user_id);

$profileType = session('profile_type', 'investor');
if (empty($availableProfileTypes[$profileType])) {
    // Session has a type this user doesn't actually have — fall back to
    // whichever available type comes first (investor, then mentor, etc.).
    $firstAvailable = array_search(true, $availableProfileTypes, true);
    $profileType = $firstAvailable ?: 'investor';
    session(['profile_type' => $profileType]);
}

$confidentialRoutes = [
    'mentor' => 'mentor.confidential.edit',
    'lender' => 'lender.confidential.edit',
    'startup' => 'startup.confidential.edit',
    'investor' => 'confidential.edit',
];
$myProfileRoutes = [
    'mentor' => 'mentor.get.user.details',
    'lender' => 'lender.get.user.details',
    'startup' => 'startup.get.user.details',
    'investor' => 'get.user.details',
];
$confidentialRouteName = $confidentialRoutes[$profileType] ?? $confidentialRoutes['investor'];
$myProfileRouteName = $myProfileRoutes[$profileType] ?? $myProfileRoutes['investor'];

// Until the currently-selected profile type has been activated, the sidebar
// only shows Dashboard / Manage / Change Password (matches the old site: an
// un-activated profile shows "ACTIVATE ACCOUNT" instead of "MY PLAN" and
// hides Profile Views / My Profile / My Interactions).
$isProfileActivated = isProfileTypeActivated($user_id, $profileType);
?>

<style>
  .dashboard-sidebar {
    background: #ffffff;
    border-radius: 18px;
    box-shadow: 0 8px 30px rgba(30, 41, 59, 0.08);
    border: 1px solid #eef1f6;
    position: sticky;
    /* offset below the fixed navbar (see accountDashboardApp's #main padding-top) */
    top: 110px;
    max-height: calc(100vh - 130px);
    overflow-y: auto;
    overflow-x: hidden;
  }

  /* thin, unobtrusive scrollbar for the sidebar's own scroll area */
  .dashboard-sidebar::-webkit-scrollbar {
    width: 6px;
  }
  .dashboard-sidebar::-webkit-scrollbar-thumb {
    background: #dbe2ee;
    border-radius: 3px;
  }

  .user-profile-card {
    position: relative;
    padding: 30px 20px 25px;
    text-align: center;
    background: linear-gradient(145deg, #f8faff 0%, #ffffff 100%);
    border-bottom: 1px solid #edf0f5;
  }

  .user-profile-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, #2563eb, #7c3aed);
  }

  .profile-image-container {
    width: 100px;
    height: 100px;
    margin: 5px auto 15px;
    position: relative;
  }

  .profile-image {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #ffffff;
    box-shadow: 0 5px 18px rgba(37, 99, 235, 0.18);
  }

  .profile-image-fallback {
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    color: #ffffff;
    font-size: 38px;
    font-weight: 700;
    font-family: inherit;
  }

  .profile-edit-icon {
    position: absolute;
    right: -3px;
    bottom: 3px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #2563eb;
    color: #fff !important;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid #fff;
    font-size: 12px;
    transition: all .25s ease;
    text-decoration: none;
  }

  .profile-edit-icon:hover {
    background: #1d4ed8;
    transform: scale(1.08);
  }

  .user-name {
    margin: 8px 0 6px;
    font-size: 19px;
    font-weight: 700;
    color: #172033;
  }

  .user-location {
    font-size: 12px;
    color: #7a8497;
    margin-bottom: 15px;
  }

  .user-location i {
    color: #2563eb;
    margin-right: 5px;
  }

  .user-contact {
    margin-top: 12px;
  }

  .user-contact p {
    margin: 7px 0;
    font-size: 12px;
    color: #687386;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .user-contact i {
    width: 20px;
    color: #2563eb;
    margin-right: 5px;
  }

  /* Social */
  .social-links {
    display: flex;
    justify-content: center;
    gap: 8px;
  }

  .social-links a {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #f1f5f9;
    color: #475569;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    transition: all .25s ease;
    text-decoration: none;
  }

  .social-links a:hover {
    background: #2563eb;
    color: #fff;
    transform: translateY(-2px);
  }

  /* Profile Type */
  .profile-type-select {
    padding: 18px 20px 10px;
  }

  .profile-type-select label {
    display: block;
    margin-bottom: 7px;
    letter-spacing: .5px;
  }

  .profile-type-select select {
    width: 100%;
    height: 42px;
    border: 1px solid #e1e6ef;
    border-radius: 9px;
    padding: 0 12px;
    color: #334155;
    background: #f8fafc;
    font-size: 13px;
    font-weight: 600;
    outline: none;
    cursor: pointer;
    transition: .2s;
  }

  .profile-type-select select:focus {
    border-color: #2563eb;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, .08);
  }

  /* My Plan */
  .btn-my-plan {
    width: calc(100% - 40px);
    margin: 10px 20px 18px;
    border: none;
    border-radius: 9px;
    height: 42px;
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .5px;
    background: linear-gradient(90deg, #2563eb, #7c3aed);
    box-shadow: 0 5px 14px rgba(37, 99, 235, .18);
    transition: all .25s ease;
    cursor: pointer;
  }

  .btn-my-plan:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(37, 99, 235, .25);
  }

  /* Sidebar Menu */
  .sidebar-menu {
    list-style: none;
    padding: 0 12px 18px;
    margin: 0;
  }

  .sidebar-menu>li {
    margin: 3px 0;
  }

  .sidebar-menu li a {
    position: relative;
    display: flex;
    align-items: center;
    min-height: 43px;
    padding: 10px 13px;
    border-radius: 9px;
    color: #596579;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: all .22s ease;
  }

  .sidebar-menu li a i:first-child {
    width: 28px;
    font-size: 15px;
    color: #8a95a7;
    transition: .22s ease;
  }

  .sidebar-menu li a:hover {
    color: #2563eb;
    background: #f3f7ff;
  }

  .sidebar-menu li a:hover i:first-child {
    color: #2563eb;
  }

  /* Active */
  .sidebar-menu li a.active {
    color: #2563eb;
    background: linear-gradient(90deg,
        rgba(37, 99, 235, .10),
        rgba(124, 58, 237, .05));
    font-weight: 600;
  }

  .sidebar-menu li a.active::before {
    content: "";
    position: absolute;
    left: -12px;
    top: 8px;
    width: 3px;
    height: 27px;
    border-radius: 0 5px 5px 0;
    background: #2563eb;
  }

  .sidebar-menu li a.active i:first-child {
    color: #2563eb;
  }

  /* Badge */
  .sidebar-menu .badge {
    margin-left: auto;
    min-width: 23px;
    height: 21px;
    padding: 2px 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 20px;
    background: #eef4ff;
    color: #2563eb;
    font-size: 10px;
    font-weight: 700;
  }

  /* Submenu */
  .submenu {
    list-style: none;
    padding: 3px 0 5px 28px;
    margin: 0;
    display: none;
  }

  .submenu.show {
    display: block;
  }

  .submenu li {
    margin: 2px 0;
  }

  .submenu li a {
    min-height: 36px;
    padding: 8px 12px;
    font-size: 12px;
    color: #7b8494;
    border-radius: 7px;
  }

  .submenu li a::before {
    content: "";
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: #cbd5e1;
    margin-right: 9px;
    transition: .2s;
  }

  .submenu li a:hover::before,
  .submenu li a.active::before {
    background: #2563eb;
  }

  .submenu li a.active {
    color: #2563eb;
    background: #f3f7ff;
  }

  .submenu li a.active::after {
    display: none;
  }

  /* Chevron */
  .menu-chevron {
    margin-left: auto;
    font-size: 10px !important;
    width: auto !important;
    color: #9aa4b2 !important;
    transition: transform .25s ease;
  }

  .has-submenu.open>a .menu-chevron {
    transform: rotate(180deg);
    color: #2563eb !important;
  }

  /* Divider */
  .menu-divider {
    height: 1px;
    background: #edf0f5;
    margin: 12px 5px;
  }

  /* Main area */
  .dashboard-main-content {
    padding-left: 10px;
  }

  /* Mobile */
  @media (max-width: 991px) {
    .dashboard-sidebar {
      position: relative;
      top: 0;
      max-height: none;
      overflow-y: visible;
      margin-bottom: 25px;
    }

    .dashboard-main-content {
      padding-left: 0;
    }
  }
</style>


<div class="container-fluid">
  <div class="row">

    <!-- ================= SIDEBAR ================= -->
    <aside class="col-lg-3 col-md-4 mb-4">

      <div class="dashboard-sidebar">

        <!-- Profile Card -->
        <div class="user-profile-card">

          <div class="profile-image-container">

            @if(!empty($user->profile_pic) && file_exists(public_path($user->profile_pic)))
              <img src="{{ asset($user->profile_pic) }}" alt="Profile" class="profile-image">
            @else
              <div class="profile-image profile-image-fallback">{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}</div>
            @endif

            <a href="{{ route('user.edit.page') }}" class="profile-edit-icon" title="Edit Profile">
              <i class="fas fa-pencil-alt"></i>
            </a>

          </div>

          <p class="user-location">
            <i class="fas fa-map-marker-alt"></i>
            {{ $user->location ?? 'Not Set' }}
          </p>

          <h5 class="user-name">
            {{ $user->name ?? 'Not Set' }}
          </h5>

          <div class="user-contact">

            <p title="{{ $user->email ?? 'Not Set' }}">
              <i class="far fa-envelope"></i>
              {{ $user->email ?? 'Not Set' }}
            </p>

            <p>
              <i class="fas fa-phone"></i>
              {{ $user->mobile ?? 'N/A' }}
            </p>

          </div>

          <div class="social-links mt-3">

            <a href="#" title="Facebook">
              <i class="fab fa-facebook-f"></i>
            </a>

            <a href="#" title="LinkedIn">
              <i class="fab fa-linkedin-in"></i>
            </a>

            <a href="#" title="Twitter / X">
              <i class="fa-brands fa-x-twitter"></i>
            </a>

          </div>

        </div>


        <!-- Profile Type -->
        <div class="profile-type-select">

          <label>
            PROFILE TYPE
          </label>

          <select onchange="changeProfileType(this)">
            @if($availableProfileTypes['investor'])
              <option value="investor" {{ $profileType === 'investor' ? 'selected' : '' }}>Investor</option>
            @endif
            @if($availableProfileTypes['mentor'])
              <option value="mentor" {{ $profileType === 'mentor' ? 'selected' : '' }}>Mentor</option>
            @endif
            @if($availableProfileTypes['lender'])
              <option value="lender" {{ $profileType === 'lender' ? 'selected' : '' }}>Lender</option>
            @endif
            @if($availableProfileTypes['startup'])
              <option value="startup" {{ $profileType === 'startup' ? 'selected' : '' }}>Startup</option>
            @endif
          </select>

        </div>


        <!-- My Plan / Activate Account -->
        @if($isProfileActivated)
          <button class="btn-my-plan">
            <i class="fas fa-crown mr-2"></i>
            MY PLAN
          </button>
        @else
          <button class="btn-my-plan">
            <i class="fas fa-bolt mr-2"></i>
            ACTIVATE ACCOUNT
          </button>
        @endif


        <!-- ================= MENU ================= -->
        <ul class="sidebar-menu">

          <!-- Dashboard -->
          <li>
            <a href="{{ route('myaccount') }}">
              <i class="fas fa-th-large"></i>
              <span>Dashboard</span>
            </a>
          </li>


          @if($isProfileActivated)
            <!-- Profile Views -->
            <li>
              <a href="{{ route('profileview') }}">
                <i class="far fa-eye"></i>
                <span>Profile Views</span>

                <span class="badge">
                  0
                </span>
              </a>
            </li>


            <!-- My Profile -->
            <li>
              <a href="{{ route($myProfileRouteName) }}">
                <i class="far fa-user"></i>
                <span>My Profile</span>
              </a>
            </li>
          @endif


          <div class="menu-divider"></div>


          <!-- Change Password -->
          <li>
            <a href="{{ route('change.password') }}">
              <i class="fas fa-lock"></i>
              <span>Change Password</span>
            </a>
          </li>


          @if($isProfileActivated)
            <!-- My Interactions -->
            <li class="has-submenu">

              <a href="javascript:void(0)" onclick="toggleSubmenu(this)">

                <i class="far fa-comments"></i>

                <span>My Interactions</span>

                <i class="fas fa-chevron-down menu-chevron"></i>

              </a>

              <ul class="submenu">

                <li>
                  <a href="{{ route('myinteraction.index') }}">
                    BX Inbox
                  </a>
                </li>

                <li>
                  <a href="{{ route('myinteraction.proposals-sent') }}">
                    Proposals Sent
                  </a>
                </li>

                <li>
                  <a href="{{ route('myinteraction.instant-responses') }}">
                    Instant Responses
                  </a>
                </li>

                <li>
                  <a href="{{ route('myinteraction.proposals-received') }}">
                    Proposals Received
                  </a>
                </li>

              </ul>

            </li>
          @endif


          <!-- Manage -->
          <li class="has-submenu open">

            <a href="javascript:void(0)" onclick="toggleSubmenu(this)" class="active">

              <i class="fas fa-sliders-h"></i>

              <span>Manage</span>

              <i class="fas fa-chevron-down menu-chevron"></i>

            </a>


            <ul class="submenu show">

              <!-- Confidential -->
              <li>
                <a href="{{ route($confidentialRouteName, [
  'user_rand_id' => auth()->user()->user_rand_id
]) }}">
                  Confidential Info
                </a>
              </li>


            </ul>

      </div>


    </aside>

    <script>
      function changeProfileType(select) {
    let type = select.value;
    window.location.href = "/set-profile-type/" + type;
}

      function toggleSubmenu(element) {

        const parent = element.closest('.has-submenu');
        const submenu = parent.querySelector('.submenu');

        if (!submenu) {
          return;
        }

        parent.classList.toggle('open');
        submenu.classList.toggle('show');
      }

      
    </script>