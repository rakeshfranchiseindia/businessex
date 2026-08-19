@extends('layouts.app')

@section('content')
    <!-- ========== HERO SECTION ========== -->
  <section class="hero-section hero-valuation">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-7 hero-content mb-5 mb-lg-0">
          <h1>BusinessEx has Partnered with BizEquity</h1>
          <p>The world's only patented and the largest provider of business valuations, having valued over 33 Million+ Private Businesses globally.</p>
        </div>
        <div class="col-lg-5">
          <div class="hero-form-card">
            <h3>Value your Business today!</h3>
            @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
              <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form class="hero-form" method="POST" action="{{ route('service.payment.initiate') }}">
              @csrf
              <input type="hidden" name="service_type" value="1">
              <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}" required>
              </div>
              <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Your Email" value="{{ old('email') }}" required>
              </div>
              <div class="form-group">
                <input type="tel" name="mobile" class="form-control" placeholder="Your Mobile" value="{{ old('mobile') }}" required>
              </div>
              <div class="form-group">
                <input type="text" name="company" class="form-control" placeholder="Your Company" value="{{ old('company') }}" required>
              </div>
              <div class="form-group">
                <select class="form-control" name="payment_mode" id="paymentMode" required>
                  <option value="">Select Payment Mode</option>
                  <option value="OPTCRDC">Credit Card</option>
                  <option value="OPTDBCRD">Debit Card</option>
                  <option value="OPTNBK">Net Banking</option>
                </select>
              </div>
              <button type="submit" class="btn-submit-primary">Submit</button>
            </form>
            @if($errors->any())
              <div class="alert alert-danger mt-3">{{ $errors->first() }}</div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== WHAT'S YOUR BUSINESS WORTH SECTION ========== -->
  <section class="section-padding bg-light-section">
    <div class="container">
      <div class="section-title">
        <h2>What's your Business Worth?</h2>
      </div>
      
      <div class="row align-items-center">
        <div class="col-lg-5 mb-4 mb-lg-0">
          <div class="info-boxes">
            <div class="info-box">
              <div class="info-icon">
                <i class="fas fa-chart-line"></i>
              </div>
              <div class="info-content">
                <h4>Mystery of Your Largest Asset</h4>
                <p>If you are like <strong>98% of business owners</strong>, the value of your largest asset is a mystery. You wouldn't start to plan your retirement 30 days before you retire, so why wait to find out what your business is worth, right before you sell.</p>
              </div>
            </div>
            
            <div class="info-box">
              <div class="info-icon">
                <i class="fas fa-cloud"></i>
              </div>
              <div class="info-content">
                <h4>Cloud-Based Valuation Service</h4>
                <p>Our <strong>cloud-based valuation service</strong> harnesses the power of big data to deliver accurate valuations in a fraction of the time and expense of a traditional valuation.</p>
              </div>
            </div>
            
            <div class="info-box">
              <div class="info-icon">
                <i class="fas fa-database"></i>
              </div>
              <div class="info-content">
                <h4>Comprehensive Comparison</h4>
                <p>Our service system compares your business to <strong>17 million</strong> others in over <strong>30 key areas</strong>. We provide insights that save you time and money while making it easier to plan for the future of your business and your life.</p>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-lg-7">
          <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=800&h=500&fit=crop" alt="Business Valuation" class="img-fluid rounded shadow-custom w-100">
        </div>
      </div>
    </div>
  </section>

  <!-- ========== WHEN DO YOU NEED BUSINESS VALUATION ========== -->
  <section class="section-padding bg-white-section">
    <div class="container">
      <div class="section-title">
        <h2>When do you need a Business Valuation?</h2>
      </div>
      
      <div class="feature-cards-grid">
        <div class="feature-card">
          <div class="icon-wrapper">
            <i class="fas fa-hand-holding-usd"></i>
          </div>
          <h4>Selling Your Business</h4>
          <p>Determine the fair market value to set an appropriate asking price for your business sale.</p>
        </div>
        
        <div class="feature-card">
          <div class="icon-wrapper">
            <i class="fas fa-shopping-cart"></i>
          </div>
          <h4>Buying a Business</h4>
          <p>Assess whether the asking price is fair and understand the true value of your potential acquisition.</p>
        </div>
        
        <div class="feature-card">
          <div class="icon-wrapper">
            <i class="fas fa-money-bill-wave"></i>
          </div>
          <h4>Seeking Funding</h4>
          <p>Present accurate valuation reports to investors, banks, or other funding sources.</p>
        </div>
        
        <div class="feature-card">
          <div class="icon-wrapper">
            <i class="fas fa-umbrella-beach"></i>
          </div>
          <h4>Planning Your Retirement</h4>
          <p>Understand your business value as part of your overall retirement planning strategy.</p>
        </div>
        
        <div class="feature-card">
          <div class="icon-wrapper">
            <i class="fas fa-file-invoice-dollar"></i>
          </div>
          <h4>Tax Purposes</h4>
          <p>Establish documented values for estate planning, gift tax, or other tax-related requirements.</p>
        </div>
        
        <div class="feature-card">
          <div class="icon-wrapper">
            <i class="fas fa-gavel"></i>
          </div>
          <h4>Litigation Checks</h4>
          <p>Support legal proceedings with professionally prepared valuation documentation.</p>
        </div>
        
        <div class="feature-card">
          <div class="icon-wrapper">
            <i class="fas fa-building"></i>
          </div>
          <h4>Liquidation of Your Company</h4>
          <p>Determine asset values in case of business dissolution or liquidation scenarios.</p>
        </div>
        
        <div class="feature-card">
          <div class="icon-wrapper">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h4>Protecting Your Business & Family</h4>
          <p>Safeguard your legacy with proper valuation for buy-sell agreements and succession planning.</p>
        </div>
        
        <div class="feature-card">
          <div class="icon-wrapper">
            <i class="fas fa-search-dollar"></i>
          </div>
          <h4>To gain Better Understanding of Your Business</h4>
          <p>Get insights into strengths, weaknesses, and growth opportunities through detailed analysis.</p>
        </div>
        
        <div class="feature-card">
          <div class="icon-wrapper">
            <i class="fas fa-exchange-alt"></i>
          </div>
          <h4>Planning a Transition Strategy for the Future of Your Business</h4>
          <p>Prepare for management transitions, partnerships, or generational transfers with clear valuations.</p>
        </div>
      </div>
    </div>
  </section>

  @include('includes.faqlist')
  @include('includes.getintouch')
  @include('includes.groupcompany')
  @include('includes.newsletter')
  @include('includes.categorylinkfooter')

  <style>
    .hero-valuation {
      min-height: 650px;
      background-size: cover;
      background-position: center;
    }

    .hero-valuation .hero-form-card {
      max-width: 510px;
      margin-left: auto;
      padding: 22px 24px;
    }

    .hero-valuation .hero-form-card h3 {
      font-size: 24px;
      line-height: 30px;
      margin-bottom: 16px;
    }

    .hero-valuation .hero-form .form-group {
      margin-bottom: 12px;
    }

    .hero-valuation .hero-form-card .form-control {
      height: 48px;
      padding: 10px 13px;
      font-size: 15px;
    }

    .hero-valuation .btn-submit-primary {
      padding: 10px 32px;
      font-size: 16px;
    }

    .hero-valuation .alert {
      margin-bottom: 12px;
      padding: 8px 12px;
    }

    @media (max-width: 991px) {
      .hero-valuation {
        min-height: auto;
        padding: 55px 0;
      }

      .hero-valuation .hero-form-card {
        margin: 24px auto 0;
      }
    }

    @media (max-width: 575px) {
      .hero-valuation {
        padding: 35px 0;
      }

      .hero-valuation .hero-form-card {
        padding: 18px;
      }

      .hero-valuation .hero-form-card h3 {
        font-size: 22px;
        line-height: 27px;
      }
    }
  </style>

      
@endsection