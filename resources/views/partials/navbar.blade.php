@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp


<nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand text-brand" href="{{ url('/') }}">
            <img src="{{ asset('assets/img/logo.JPG') }}" alt="Logo">
        </a>

        <!-- Navbar Links -->
        <div class="navbar-collapse collapse" id="navbarDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link active" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="bxlistingDropdown" role="button"
                        data-toggle="dropdown" aria-expanded="false">
                        Bx Listings
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="bxlistingDropdown">
                        <li><a class="dropdown-item" href="{{ url('/businesslisting') }}">Business</a></li>
                        <li><a class="dropdown-item" href="{{ url('/startuplisting') }}">Startup</a></li>
                        <li><a class="dropdown-item" href="{{ url('/investorlisting') }}">Investor</a></li>
                        <li><a class="dropdown-item" href="{{ url('/mentorlisting') }}">Mentor</a></li>
                        <li><a class="dropdown-item" href="https://www.franchiseindia.com/">Franchise</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="registrationDropdown" role="button"
                        data-toggle="dropdown" aria-expanded="false">
                        Registration
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="registrationDropdown">
                        <li><a class="dropdown-item"
                                href="{{ url('/registration/create-business-profile') }}">Business</a></li>
                        <li><a class="dropdown-item"
                                href="{{ url('/registration/create-investor-profile') }}">Investor</a></li>
                        <li><a class="dropdown-item" href="{{ url('/registration/create-mentor-profile') }}">Mentor</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ url('/registration/create-startup-profile') }}">Startup</a></li>
                        <li><a class="dropdown-item" href="{{ url('/registration/create-lender-profile') }}">Lender</a>
                        </li>
                        <li><a class="dropdown-item" href="https://www.franchiseindia.com/">Franchise</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/pricing') }}">Pricing</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/articles') }}">Bx Insights</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button"
                        data-toggle="dropdown" aria-expanded="false">
                        Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                        <li><a class="dropdown-item" href="{{ url('/service/business-valuation') }}">Business
                                Valuation</a></li>
                        <li><a class="dropdown-item" href="{{ url('/service/business-plan') }}">Business Plan</a></li>
                        <li><a class="dropdown-item" href="{{ url('/service/due-diligence') }}">Due Diligence</a></li>
                        <li><a class="dropdown-item" href="{{ url('/service/certified-business-broker') }}">Certified
                                Business
                                Broker</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Right Corner Button -->
            <div class="ml-auto">
                @auth
                            <!-- Logged in: show profile image -->
                            <a href="javascript:void(0)" onclick="openSidebar()">
                                <img src="{{ Auth::user()->profile_image
                    ? asset(Auth::user()->profile_image)
                    : asset('assets/img/mentor.png') }}" alt="User Profile" class="userpro rounded-circle"
                                    width="40">
                            </a>
                @endauth

                @guest
                    <!-- If not logged in: show login button -->
                    <button type="button" id="profileSidebar" class="btn btn-b-n mob1" data-toggle="modal"
                        data-target="#login">
                        <img src="{{ asset('assets/img/account_circle-24px.svg') }}" alt="Login">
                    </button>
                @endguest
            </div>

        </div>
    </div>
</nav>

<!-- User Profile Sidebar -->
<div id="userSidebar" class="sidebar bg-white shadow-lg p-3" style="width:300px; position:fixed; top:0; right:-300px; height:100%; 
            overflow-y:auto; transition:right 0.3s; z-index:1050;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('myaccount') }}" class="btn btn-success btn-sm">
            Dashboard
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-success btn-sm">Logout</button>
        </form>
        <button class="btn btn-link text-dark" onclick="closeSidebar()">
            <i class="fa fa-times fa-lg"></i>
        </button>
    </div>

    <div class="text-center">
        <img src="{{ asset('images/default-mentor.jpg') }}" class="rounded mb-2" width="120" alt="Profile">
        <p class="mb-0"><i class="fa fa-map-marker"></i>{{ $user->location ?? 'Not Set' }}</p>
        <h6 class="font-weight-bold">{{ $user->name ?? 'N/A' }}</h6>
    </div>

    <div class="mt-3 p-3 bg-light rounded">
        <p class="mb-1"><i class="fa fa-envelope"></i> <strong>Email</strong></p>
        <p class="text-muted mb-2">{{ $user->email ?? 'N/A' }}</p>

        <p class="mb-1"><i class="fa fa-phone"></i> <strong>Phone</strong></p>
        <p class="text-muted mb-2">{{ $user->mobile ?? 'N/A' }}</p>

        <div class="mt-2">
            <a href="#" class="text-success mr-2"><i class="fa fa-facebook"></i></a>
            <a href="#" class="text-success mr-2"><i class="fa fa-google-plus"></i></a>
            <a href="#" class="text-success"><i class="fa fa-linkedin"></i></a>
        </div>
    </div>
</div>

<!-- Overlay -->
<div id="sidebarOverlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
     background:rgba(0,0,0,0.5); z-index:1040;" onclick="closeSidebar()"></div>

<!-- Sidebar Toggle Script -->
<script>
    function openSidebar() {
        document.getElementById('userSidebar').style.right = '0';
        document.getElementById('sidebarOverlay').style.display = 'block';
    }
    function closeSidebar() {
        document.getElementById('userSidebar').style.right = '-300px';
        document.getElementById('sidebarOverlay').style.display = 'none';
    }
</script>