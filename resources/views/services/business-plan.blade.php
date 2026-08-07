@extends('layouts.app')
@section('content')
<!-- ========== HERO SECTION ========== -->
  <section class="hero-section hero-plan">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-7 hero-content mb-5 mb-lg-0">
          <h1>Create a Business Plan</h1>
          <p>A GOAL without<br>a PLAN is Just a dream!</p>
        </div>
        <div class="col-lg-5">
          <div class="hero-form-card">
            <h3>Create a Business Plan</h3>
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
              <button type="submit" class="btn-submit-primary">SUBMIT</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== WHAT IS BUSINESS PLAN SECTION ========== -->
  <section class="section-padding bg-white-section">
    <div class="container">
      <div class="content-with-image">
        <div class="col content-text">
          <h2>What is a <span>BUSINESS PLAN?</span></h2>
          <p><strong>Business Plan is a powerful strategic tool for Startups and Businesses.</strong> It is one of the most significant documents to be shared with investors, lenders, buyers and team members.</p>
          
          <p>Regardless of the intent of the business plan, the type of company and the stage at which it is operating, a Business Plan is a company's roadmap to strategic growth and potential success.</p>
          
          <p>A well-crafted business plan serves as a comprehensive guide that outlines your business goals, strategies for achieving them, market analysis, financial projections, and operational plans. It helps you identify potential challenges early and develop contingency strategies to overcome them.</p>
        </div>
        
        <div class="col-auto content-image">
          <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=500&h=350&fit=crop" alt="Business Planning Meeting" class="img-fluid rounded-custom">
        </div>
      </div>
    </div>
  </section>

  <!-- ========== WHEN DO YOU NEED BUSINESS PLAN ========== -->
  <section class="section-padding" style="background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);">
    <div class="container">
      <div class="section-title">
        <h2 style="color: white;">When do you need a<br><span style="color: white;">BUSINESS PLAN?</span></h2>
      </div>
      
      <div class="icon-cards-grid">
        <div class="icon-card" style="background-color: rgba(255,255,255,0.95);">
          <i class="fas fa-hand-holding-usd"></i>
          <h5>Seeking a loan</h5>
        </div>
        
        <div class="icon-card" style="background-color: rgba(255,255,255,0.95);">
          <i class="fas fa-piggy-bank"></i>
          <h5>Looking for investment capital</h5>
        </div>
        
        <div class="icon-card" style="background-color: rgba(255,255,255,0.95);">
          <i class="fas fa-store"></i>
          <h5>Buying a new business</h5>
        </div>
        
        <div class="icon-card" style="background-color: rgba(255,255,255,0.95);">
          <i class="fas fa-shopping-cart"></i>
          <h5>Making a major Purchase</h5>
        </div>
        
        <div class="icon-card" style="background-color: rgba(255,255,255,0.95);">
          <i class="fas fa-users"></i>
          <h5>Recruiting a team member</h5>
        </div>
        
        <div class="icon-card" style="background-color: rgba(255,255,255,0.95);">
          <i class="fas fa-chess"></i>
          <h5>Planning Strategically</h5>
        </div>
        
        <div class="icon-card" style="background-color: rgba(255,255,255,0.95);">
          <i class="fas fa-expand-arrows-alt"></i>
          <h5>Expanding the Company</h5>
        </div>
        
        <div class="icon-card" style="background-color: rgba(255,255,255,0.95);">
          <i class="fas fa-exclamation-triangle"></i>
          <h5>Identifying potential weaknesses or pitfalls</h5>
        </div>
        
        <div class="icon-card" style="background-color: rgba(255,255,255,0.95);">
          <i class="fas fa-bullseye"></i>
          <h5>Goal setting for the company</h5>
        </div>
        
        <div class="icon-card" style="background-color: rgba(255,255,255,0.95);">
          <i class="fas fa-chart-line"></i>
          <h5>Tracking progress</h5>
        </div>
        
        <div class="icon-card" style="background-color: rgba(255,255,255,0.95);">
          <i class="fas fa-lock"></i>
          <h5>Securing assets</h5>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== BUSINESS PLAN DOUBLES SUCCESS ========== -->
  <section class="section-padding bg-light-section">
    <div class="container">
      <div class="content-with-image flex-row-reverse">
        <div class="col content-text">
          <h2>A Business Plan <span>DOUBLES YOUR CHANCES TO SUCCESS</span></h2>
          <p>According to a survey by Palo Alto, entrepreneurs who created and followed business plans were about twice as likely in growing their business or obtaining capital, as compared to those who did not create a plan. Creating a plan correlated with increased success in each of the goals mentioned in the study.</p>
          
          <p>The research clearly demonstrates that businesses with formalized planning processes consistently outperform their peers across multiple metrics including revenue growth, profitability, and long-term sustainability.</p>
        </div>
        
        <div class="col-auto content-image">
          <img src="https://images.unsplash.com/photo-1543286386-713bdd548da4?w=450&h=300&fit=crop" alt="Business Success Chart" class="img-fluid rounded-custom">
        </div>
      </div>
    </div>
  </section>

  <!-- ========== STUDIES HAVE SHOWN ========== -->
  <section class="stats-dark-section">
    <div class="container">
      <div class="section-title">
        <h2 style="color: white;">Different studies have shown</h2>
      </div>
      
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <ul class="stats-list">
            <li>
              <span class="stat-icon"><i class="fas fa-check"></i></span>
              <p><strong>The companies that do business planning expand 30% faster than their competitors,</strong> who do not invest in business planning. This accelerated growth comes from clearer direction, better resource allocation, and more informed decision-making.</p>
            </li>
            
            <li>
              <span class="stat-icon"><i class="fas fa-check"></i></span>
              <p><strong>92% increase in sales revenue has been found in the fastest-growing organizations who follow their business plan,</strong> across the globe. These organizations demonstrate superior market understanding and customer acquisition strategies.</p>
            </li>
            
            <li>
              <span class="stat-icon"><i class="fas fa-check"></i></span>
              <p><strong>By creating a plan for the business model, entrepreneurs increase the probability of realizing their dream venture by 152%.</strong> This dramatic improvement highlights the importance of structured thinking and strategic preparation.</p>
            </li>
            
            <li>
              <span class="stat-icon"><i class="fas fa-check"></i></span>
              <p><strong>Entrepreneurs, who formulate a business plan, are 129% surging upward and also, transiting their startup company for the next phase.</strong> The transition from startup to growth stage becomes significantly smoother with proper documentation.</p>
            </li>
            
            <li>
              <span class="stat-icon"><i class="fas fa-check"></i></span>
              <p><strong>Companies adhering to a business plan probably receive funding earlier than their counterparts who do not form any business plan.</strong> Investors appreciate well-documented strategies and clear financial projections.</p>
            </li>
            
            <li>
              <span class="stat-icon"><i class="fas fa-check"></i></span>
              <p><strong>By following a business plan, companies can attain regular goals, track their progress on time and also, make changes in the business plan according to the shifting market conditions.</strong> This adaptability ensures long-term relevance and competitiveness.</p>
            </li>
          </ul>
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
                  What is a Business Plan?
                  <i class="fas fa-chevron-down faq-icon"></i>
                </button>
              </div>
              <div id="faq1" class="collapse" data-parent="#faqAccordion">
                <div class="card-body">
                  A Business Plan is a comprehensive document that describes your business objectives, strategies, market analysis, financial projections, and operational details. It serves as a roadmap for your business's future and is essential for attracting investors, securing loans, and guiding your company's growth trajectory.
                </div>
              </div>
            </div>
            
            <div class="card">
              <div class="card-header">
                <button class="btn-faq collapsed" type="button" data-toggle="collapse" data-target="#faq2">
                  How long will it take to prepare a Business Plan by BusinessEx?
                  <i class="fas fa-chevron-down faq-icon"></i>
                </button>
              </div>
              <div id="faq2" class="collapse" data-parent="#faqAccordion">
                <div class="card-body">
                  Our team typically delivers a comprehensive Business Plan within 7-10 business days after receiving all necessary information from you. For urgent requirements, we offer expedited services that can reduce this timeline significantly.
                </div>
              </div>
            </div>
            
            <div class="card">
              <div class="card-header">
                <button class="btn-faq collapsed" type="button" data-toggle="collapse" data-target="#faq3">
                  How much does BusinessEx charge for their Business Plan service?
                  <i class="fas fa-chevron-down faq-icon"></i>
                </button>
              </div>
              <div id="faq3" class="collapse" data-parent="#faqAccordion">
                <div class="card-body">
                  Our Business Plan pricing varies based on complexity, industry, and specific requirements. We offer different tiers ranging from basic startup plans to comprehensive investor-ready documents. Contact us for a customized quote tailored to your needs.
                </div>
              </div>
            </div>
            
            <div class="card">
              <div class="card-header">
                <button class="btn-faq collapsed" type="button" data-toggle="collapse" data-target="#faq4">
                  What will happen when I make the payment at BusinessEx?
                  <i class="fas fa-chevron-down faq-icon"></i>
                </button>
              </div>
              <div id="faq4" class="collapse" data-parent="#faqAccordion">
                <div class="card-body">
                  After payment confirmation, you'll be assigned a dedicated business consultant who will guide you through the information gathering process. We'll schedule discovery calls, provide templates for financial data, and keep you updated throughout the creation process until final delivery.
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
              <p><strong>BusinessEx Solutions Private Limited,</strong><br>
              Unit No. 601, 6th Floor Pinnacle Tower Behind The Atrium,<br>
              Suraj Kund Rd,<br>
              Faridabad, Haryana 121009, India</p>
            </div>
            
            <div class="contact-item">
              <i class="fas fa-envelope"></i>
              <p><a href="mailto:support@businessex.com" style="color:white;">support@businessex.com</a></p>
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
                <li><a href="#" class="view-all-link">View All »</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Beauty, health & wellness</h6>
              <ul>
                <li><a href="#">Beauty Salons</a></li>
                <li><a href="#">Fitness Centers</a></li>
                <li><a href="#">Spa & Wellness</a></li>
                <li><a href="#">Healthcare Services</a></li>
                <li><a href="#" class="view-all-link">View All »</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Building construction & Home p...</h6>
              <ul>
                <li><a href="#">Real Estate</a></li>
                <li><a href="#">Construction</a></li>
                <li><a href="#">Interior Design</a></li>
                <li><a href="#">Home Improvement</a></li>
                <li><a href="#" class="view-all-link">View All »</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Business services</h6>
              <ul>
                <li><a href="#">Consulting</a></li>
                <li><a href="#">Marketing Agency</a></li>
                <li><a href="#">IT Services</a></li>
                <li><a href="#">BPO/KPO</a></li>
                <li><a href="#" class="view-all-link">View All »</a></li>
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
                <li><a href="#" class="view-all-link">View All »</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Food & Beverage</h6>
              <ul>
                <li><a href="#">Restaurants</a></li>
                <li><a href="#">Food Delivery</a></li>
                <li><a href="#">Cafes & Bakeries</a></li>
                <li><a href="#">Food Processing</a></li>
                <li><a href="#" class="view-all-link">View All »</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Retail</h6>
              <ul>
                <li><a href="#">Fashion Retail</a></li>
                <li><a href="#">Consumer Goods</a></li>
                <li><a href="#">Specialty Stores</a></li>
                <li><a href="#">Online Retail</a></li>
                <li><a href="#" class="view-all-link">View All »</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Services</h6>
              <ul>
                <li><a href="#">Professional Services</a></li>
                <li><a href="#">Digital Marketing</a></li>
                <li><a href="#">Logistics</a></li>
                <li><a href="#">Consulting</a></li>
                <li><a href="#" class="view-all-link">View All »</a></li>
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
                <li><a href="#" class="view-all-link">View All »</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-6 footer-category-col">
              <h6>High Growth Sectors</h6>
              <ul>
                <li><a href="#">Technology</a></li>
                <li><a href="#">Healthcare</a></li>
                <li><a href="#">Renewable Energy</a></li>
                <li><a href="#">Education</a></li>
                <li><a href="#" class="view-all-link">View All »</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Regional Focus</h6>
              <ul>
                <li><a href="#">Metro Cities</a></li>
                <li><a href="#">Tier 2 Cities</a></li>
                <li><a href="#">Emerging Markets</a></li>
                <li><a href="#">International</a></li>
                <li><a href="#" class="view-all-link">View All »</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-6 footer-category-col">
              <h6>Support Services</h6>
              <ul>
                <li><a href="#">Legal Advisory</a></li>
                <li><a href="#">Financial Due Diligence</a></li>
                <li><a href="#">Valuation Services</a></li>
                <li><a href="#">Business Planning</a></li>
                <li><a href="#" class="view-all-link">View All »</a></li>
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

