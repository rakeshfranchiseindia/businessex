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
            <form class="hero-form">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name" required>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Your Email" required>
              </div>
              <div class="form-group">
                <input type="tel" class="form-control" placeholder="Your Mobile" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Company">
              </div>
              <div class="form-group">
                <select class="form-control" id="paymentMode">
                  <option value="">Select Payment Mode</option>
                  <option value="online">Online Payment</option>
                  <option value="bank">Bank Transfer</option>
                  <option value="cheque">Cheque Payment</option>
                </select>
              </div>
              <button type="submit" class="btn-submit-primary">Submit</button>
            </form>
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

  <!-- ========== FAQ SECTION ========== -->
  <section class="section-padding faq-section" id="faq">
    <div class="container">
      <div class="section-title">
        <h2>Frequently Asked Questions</h2>
      </div>
      
      <div class="row justify-content-center">
        <div class="col-lg-9">
          <div class="accordion accordion-custom" id="faqAccordion">
            
            <div class="card">
              <div class="card-header">
                <button class="btn-faq collapsed" type="button" data-toggle="collapse" data-target="#faq1">
                  What is Business Valuation?
                  <i class="fas fa-chevron-down faq-icon"></i>
                </button>
              </div>
              <div id="faq1" class="collapse" data-parent="#faqAccordion">
                <div class="card-body">
                  Business Valuation is the process of determining the economic value of a whole business or company unit. It's a comprehensive analysis that takes into account various factors including assets, liabilities, cash flow, market conditions, and future earning potential. Our valuation service uses advanced algorithms and industry databases to provide accurate, defensible valuations.
                </div>
              </div>
            </div>
            
            <div class="card">
              <div class="card-header">
                <button class="btn-faq collapsed" type="button" data-toggle="collapse" data-target="#faq2">
                  How long will it take to prepare a Business Valuation Report by BusinessEx?
                  <i class="fas fa-chevron-down faq-icon"></i>
                </button>
              </div>
              <div id="faq2" class="collapse" data-parent="#faqAccordion">
                <div class="card-body">
                  Once we receive all the required information from you, our cloud-based system can generate a comprehensive Business Valuation Report within 24-48 hours. This is significantly faster than traditional valuation methods which can take weeks or even months to complete.
                </div>
              </div>
            </div>
            
            <div class="card">
              <div class="card-header">
                <button class="btn-faq collapsed" type="button" data-toggle="collapse" data-target="#faq3">
                  What is the cost of a basic Business Valuation Report?
                  <i class="fas fa-chevron-down faq-icon"></i>
                </button>
              </div>
              <div id="faq3" class="collapse" data-parent="#faqAccordion">
                <div class="card-body">
                  Our basic Business Valuation Report is priced competitively at a fraction of the cost of traditional valuations. The exact pricing depends on the complexity and depth of analysis required. Contact us for a customized quote based on your specific needs.
                </div>
              </div>
            </div>
            
            <div class="card">
              <div class="card-header">
                <button class="btn-faq collapsed" type="button" data-toggle="collapse" data-target="#faq4">
                  How much does BusinessEx charge for their Business Valuation Report?
                  <i class="fas fa-chevron-down faq-icon"></i>
                </button>
              </div>
              <div id="faq4" class="collapse" data-parent="#faqAccordion">
                <div class="card-body">
                  BusinessEx offers transparent pricing for our Business Valuation Reports. The investment varies based on the level of detail and scope of the valuation. We offer different tiers from basic snapshot valuations to comprehensive reports suitable for M&A transactions, litigation support, or financing purposes.
                </div>
              </div>
            </div>
            
            <div class="card">
              <div class="card-header">
                <button class="btn-faq collapsed" type="button" data-toggle="collapse" data-target="#faq5">
                  Will I need to pay this amount for any type of Business Valuation Report?
                  <i class="fas fa-chevron-down faq-icon"></i>
                </button>
              </div>
              <div id="faq5" class="collapse" data-parent="#faqAccordion">
                <div class="card-body">
                  No, we offer multiple tiers of Business Valuation Reports to suit different needs and budgets. From quick estimates for internal planning purposes to full certified valuations for legal or financial transactions - there's an option that fits every requirement and budget.
                </div>
              </div>
            </div>
            
            <div class="card">
              <div class="card-header">
                <button class="btn-faq collapsed" type="button" data-toggle="collapse" data-target="#faq6">
                  What will happen when I make the payment at BusinessEx?
                  <i class="fas fa-chevron-down faq-icon"></i>
                </button>
              </div>
              <div id="faq6" class="collapse" data-parent="#faqAccordion">
                <div class="card-body">
                  Upon successful payment, you'll receive immediate access to our secure information gathering portal where you can submit the necessary details about your business. Our team will then process your information using our proprietary algorithm in partnership with BizEquity, and deliver your comprehensive valuation report within the promised timeframe.
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== CONTACT US SECTION ========== -->
  <section class="section-padding contact-section" id="contact">
    <div class="container">
      <div class="section-title">
        <h2>Contact Us</h2>
      </div>
      
      <div class="row">
        <div class="col-lg-8 mb-4 mb-lg-0">
          <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3507.05643940444!2d77.28789431508096!3d28.47413798246964!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce19b01e05c77%3A0x8e73f06c63efee7f!2sPinnacle%20Tower%2C%20Block%20A%2C%20Sector%2018%2C%20Faridabad%2C%20Haryana%20121009!5e0!3m2!1sen!2sin!4v1635000000000!5m2!1sen!2sin" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
        
        <div class="col-lg-4">
          <div class="contact-info-box">
            <h4>Get In Touch</h4>
            
            <div class="contact-item">
              <i class="fas fa-map-marker-alt"></i>
              <p>BusinessEx Solutions Private Limited,<br>
              Unit No. 601, 6th Floor Pinnacle Tower Behind The Atrium,<br>
              Suraj Kund Rd,<br>
              Faridabad, Haryana 121009, India</p>
            </div>
            
            <div class="contact-item">
              <i class="fas fa-envelope"></i>
              <p>support@businessex.com</p>
            </div>
            
            <div class="contact-item">
              <i class="fas fa-phone-alt"></i>
              <p>+91 8929353325</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== OUR GROUP COMPANIES ========== -->
  <section class="group-companies">
    <div class="container">
      <h3>Our Group Companies</h3>
      
      <div class="companies-logos">
        <div class="company-logo-item">
          <img src="https://via.placeholder.com/150x50/ffffff/ff6b00?text=FranchiseIndia" alt="Franchise India">
        </div>
        <div class="company-logo-item">
          <img src="https://via.placeholder.com/150x50/ffffff/1a237e?text=DealerIndia" alt="Dealer India">
        </div>
        <div class="company-logo-item">
          <img src="https://via.placeholder.com/150x50/ffffff/c62828?text=IndianRetailer" alt="Indian Retailer">
        </div>
        <div class="company-logo-item">
          <img src="https://via.placeholder.com/150x50/ffffff/d32f2f?text=RestaurantIndia" alt="Restaurant India">
        </div>
        <div class="company-logo-item">
          <img src="https://via.placeholder.com/150x50/ffffff/1565c0?text=FranCorp" alt="FranCorp">
        </div>
        <div class="company-logo-item">
          <img src="https://via.placeholder.com/150x50/ffffff/0277bd?text=FranGlobal" alt="FranGlobal">
        </div>
        <div class="company-logo-item">
          <img src="https://via.placeholder.com/150x50/ffffff/212121?text=Entrepreneur" alt="Entrepreneur">
        </div>
        <div class="company-logo-item">
          <img src="https://via.placeholder.com/150x50/ffffff/1976d2?text=LicenseIndia" alt="License India">
        </div>
        <div class="company-logo-item">
          <img src="https://via.placeholder.com/150x50/ffffff/37474f?text=ISFA" alt="ISFA">
        </div>
      </div>
    </div>
  </section>

  <!-- ========== NEWSLETTER SECTION ========== -->
  <section class="newsletter-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 newsletter-content mb-4 mb-lg-0">
          <h3>Get Industry First Insights</h3>
          <p>Sign up for our exclusive Newsletter</p>
        </div>
        
        <div class="col-lg-6">
          <form class="newsletter-form row">
            <div class="col-sm-6">
              <input type="text" class="form-control" placeholder="Name">
            </div>
            <div class="col-sm-6">
              <input type="email" class="form-control" placeholder="Email">
            </div>
            <div class="col-sm-6 mt-3">
              <input type="tel" class="form-control" placeholder="Contact No.">
            </div>
            <div class="col-sm-6 mt-3">
              <input type="text" class="form-control" placeholder="City">
            </div>
            <div class="col-12 mt-3">
              <button type="submit" class="btn-subscribe">Subscribe Now</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== FOOTER ========== -->
  <footer class="main-footer">
    <div class="container">
      <!-- Social Section -->
      <div class="footer-social">
        <div class="row align-items-center">
          <div class="col-md-4">
            <h5>Follow BusinessEx</h5>
          </div>
          <div class="col-md-8">
            <div class="social-links">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-linkedin-in"></i></a>
              <a href="#"><i class="fab fa-youtube"></i></a>
              <a href="#"><i class="fab fa-pinterest-p"></i></a>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Footer Tabs -->
      <div class="footer-tabs">
        <ul class="nav nav-tabs-footer" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-tab="business-tab" href="#">Business</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-tab="startup-tab" href="#">Startup</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-tab="investor-tab" href="#">Investor</a>
          </li>
        </ul>
        
        <div class="footer-categories tab-pane-footer" id="business-tab" style="display: block;">
          <div class="row">
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Automobile</h6>
              <ul>
                <li><a href="#">Automotive Dealerships</a></li>
                <li><a href="#">Car Accessories</a></li>
                <li><a href="#">Two Wheeler Dealers</a></li>
                <li><a href="#">Auto Repair Services</a></li>
                <li><a href="#">View All »</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Beauty, health & wellness</h6>
              <ul>
                <li><a href="#">Beauty Salons</a></li>
                <li><a href="#">Fitness Centers</a></li>
                <li><a href="#">Spa & Wellness</a></li>
                <li><a href="#">Healthcare Services</a></li>
                <li><a href="#">View All »</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Building construction & Home p...</h6>
              <ul>
                <li><a href="#">Real Estate</a></li>
                <li><a href="#">Construction</a></li>
                <li><a href="#">Interior Design</a></li>
                <li><a href="#">Home Improvement</a></li>
                <li><a href="#">View All »</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Business services</h6>
              <ul>
                <li><a href="#">Consulting</a></li>
                <li><a href="#">Marketing Agency</a></li>
                <li><a href="#">IT Services</a></li>
                <li><a href="#">BPO/KPO</a></li>
                <li><a href="#">View All »</a></li>
              </ul>
            </div>
          </div>
        </div>
        
        <div class="footer-categories tab-pane-footer" id="startup-tab" style="display: none;">
          <div class="row">
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Technology Startups</h6>
              <ul>
                <li><a href="#">SaaS Products</a></li>
                <li><a href="#">E-commerce Platforms</a></li>
                <li><a href="#">FinTech Solutions</a></li>
                <li><a href="#">EdTech Ventures</a></li>
                <li><a href="#">View All »</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Food & Beverage</h6>
              <ul>
                <li><a href="#">Restaurants</a></li>
                <li><a href="#">Food Delivery</a></li>
                <li><a href="#">Cafes & Bakeries</a></li>
                <li><a href="#">Food Processing</a></li>
                <li><a href="#">View All »</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Retail</h6>
              <ul>
                <li><a href="#">Fashion Retail</a></li>
                <li><a href="#">Consumer Goods</a></li>
                <li><a href="#">Specialty Stores</a></li>
                <li><a href="#">Online Retail</a></li>
                <li><a href="#">View All »</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Services</h6>
              <ul>
                <li><a href="#">Professional Services</a></li>
                <li><a href="#">Digital Marketing</a></li>
                <li><a href="#">Logistics</a></li>
                <li><a href="#">Consulting</a></li>
                <li><a href="#">View All »</a></li>
              </ul>
            </div>
          </div>
        </div>
        
        <div class="footer-categories tab-pane-footer" id="investor-tab" style="display: none;">
          <div class="row">
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Investment Opportunities</h6>
              <ul>
                <li><a href="#">Franchise Investments</a></li>
                <li><a href="#">Business Acquisitions</a></li>
                <li><a href="#">Startup Funding</a></li>
                <li><a href="#">Real Estate Investment</a></li>
                <li><a href="#">View All »</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-6 footer-category-col">
              <h6>High Growth Sectors</h6>
              <ul>
                <li><a href="#">Technology</a></li>
                <li><a href="#">Healthcare</a></li>
                <li><a href="#">Renewable Energy</a></li>
                <li><a href="#">Education</a></li>
                <li><a href="#">View All »</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Regional Focus</h6>
              <ul>
                <li><a href="#">Metro Cities</a></li>
                <li><a href="#">Tier 2 Cities</a></li>
                <li><a href="#">Emerging Markets</a></li>
                <li><a href="#">International</a></li>
                <li><a href="#">View All »</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Support Services</h6>
              <ul>
                <li><a href="#">Legal Advisory</a></li>
                <li><a href="#">Financial Due Diligence</a></li>
                <li><a href="#">Valuation Services</a></li>
                <li><a href="#">Business Planning</a></li>
                <li><a href="#">View All »</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Footer Bottom -->
      <div class="footer-bottom">
        <div class="row align-items-center">
          <div class="col-md-6">
            <p>Copyright © 2021-2025 BusinessEx</p>
          </div>
          <div class="col-md-6 text-md-right footer-bottom-links">
            <a href="#">Home</a>
            <a href="#">About Us</a>
            <a href="#">Disclaimer</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms</a>
            <a href="#">Contact</a>
            <a href="#">Sitemap</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
@endsection