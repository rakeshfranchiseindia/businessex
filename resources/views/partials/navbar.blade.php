<nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand text-brand" href="{{ url('/') }}">
            <img src="{{ asset('assets/img/logo.JPG') }}" alt="Logo">
        </a>
        <div class="navbar-collapse collapse" id="navbarDefault">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ url('/') }}">Bx Listings</a></li>
                <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="registrationDropdown" role="button" 
               data-bs-toggle="dropdown" aria-expanded="false">
                Registration
            </a>
            <ul class="dropdown-menu" aria-labelledby="registrationDropdown">
                <li><a class="dropdown-item" href="{{ url('/individual-registration') }}">Business</a></li>
                <li><a class="dropdown-item" href="{{ url('/business-registration') }}">Investor</a></li>
                <li><a class="dropdown-item" href="{{ url('/partner-registration') }}">Mentor</a></li>
                <li><a class="dropdown-item" href="{{ url('/partner-registration') }}">Startup</a></li>
                <li><a class="dropdown-item" href="{{ url('/partner-registration') }}">Lender</a></li>
                <li><a class="dropdown-item" href="https://www.franchiseindia.com/">Franchise</a></li>
            </ul>
        </li>
                <li class="nav-item"><a class="nav-link" href="#">Pricing</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Bx Insights</a></li>
                <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" 
       data-bs-toggle="dropdown" aria-expanded="false">
        Services
    </a>
    <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
        <li><a class="dropdown-item" href="{{ url('/business-valuation') }}">Business Valuation</a></li>
        <li><a class="dropdown-item" href="{{ url('/business-plan') }}">Business Plan</a></li>
        <li><a class="dropdown-item" href="{{ url('/due-diligence') }}">Due Diligence</a></li>
        <li><a class="dropdown-item" href="{{ url('/certified-business-broker') }}">Certified Business Broker</a></li>
    </ul>
</li>

            </ul>
        </div>
    </div>
</nav>