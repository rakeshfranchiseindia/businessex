@extends('layouts.app')
<!-- ========== HERO SECTION ========== -->
  <section class="hero-section hero-due-diligence">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-5 mb-5 mb-lg-0">
          <div class="hero-form-card">
            <h3>Get Due Diligence Done Today!</h3>
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
        
        <div class="col-lg-7 hero-content">
          <div style="color: white; text-align: center;">
            <h2 style="font-size: 32px; font-weight: 700; line-height: 1.4;">It's NEVER AS BAD AS THEY SAY,<br>It's NEVER AS GOOD AS THEY SAY!</h2>
            <p style="font-size: 20px; margin-top: 25px; font-weight: 500;">Decide For Yourself. Do Your Due Diligence!</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== WHAT IS DUE DILIGENCE SECTION ========== -->
  <section class="section-padding bg-white-section">
    <div class="container">
      <div class="content-with-image">
        <div class="col-auto content-image">
          <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=450&h=320&fit=crop" alt="Due Diligence Documents" class="img-fluid rounded-custom">
        </div>
        
        <div class="col content-text">
          <h2>What is <span>DUE DILIGENCE?</span></h2>
          
          <p><strong>Due diligence refers to an investigation of the business to confirm all facts,</strong> or an authentication of the information provided before signing a contract. This includes reviewing all financial records, plus anything else deemed material.</p>
          
          <p>Due diligence is the process of research and analysis that is performed before a potential investment, acquisition, bank loan or business partnership, to enable the determination of any major issues or potential issues in the subject of the due diligence. The prospective investor or acquirer must obtain all the required information to make sure that he makes a sensible investment rather than a costly mistake!</p>
          
          <p>Investors carry out due diligence before buying a security from a company. Due diligence can be performed for mergers and acquisitions, researching hedge funds and startup investments.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== TYPES OF DUE DILIGENCE ========== -->
  <section class="dark-overlay-section">
    <div class="container">
      <div class="section-title">
        <h2 style="color: white;">What are the different types of Due Diligence?</h2>
      </div>
      
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <ul class="dd-type-list">
            
            <li>
              <strong>Financial Due Diligence:</strong><br>
              It includes a review and analysis of the Investees' or seller's tax returns, financial statements, financial trends and accounting policies. It basically serves as the starting point for the due diligence process.
            </li>
            
            <li>
              <strong>Business Due Diligence:</strong><br>
              It includes the review and analysis of strategic plans and business plans, markets and competition, and customers and products. It serves as a guidance in identifying any change that the industry is about to undergo and the target customer base of the seller, hence showcasing risk involved in the process prior to closing the transaction.
            </li>
            
            <li>
              <strong>Legal Due Diligence:</strong><br>
              It includes a thorough review and analysis of contracts and agreements and corporate documents; pending, ongoing and potential litigation; legal and regulatory compliance and environmental factors.
            </li>
            
            <li>
              <strong>Tax due diligence:</strong><br>
              It includes managing the tax risk at the time when a company goes into a merger, acquires a business or disposes off a non-core business. It is important to focus on risks and opportunities (including quantifications) while providing social security, direct and indirect taxes due diligence, and corporate tax.
            </li>
            
            <li>
              <strong>Human Resources Due Diligence:</strong><br>
              It includes looking at the employee benefits, management and personnel, organization's structure, and labor matters.
            </li>
            
            <li>
              <strong>Operations Due Diligence:</strong><br>
              It includes the review and analysis of the investees' or seller's fixed assets and facilities, technology, insurance coverage and real estate. This step also helps in looking at any significant operational risk that might affect executing the deal or pricing.
            </li>
            
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== WHY IMPORTANT & HOW WE CAN HELP ========== -->
  <section class="section-padding bg-light-section">
    <div class="container">
      <div class="two-column-info">
        
        <div class="info-column">
          <h4>Why is Due Diligence Important?</h4>
          <p style="color: var(--text-light); margin-bottom: 20px;">Due Diligence helps you get a thorough understanding of what you are actually investing in or buying. The process helps answer the following questions for you:</p>
          
          <ul>
            <li>Are the assets of the legal cases associated with the company?</li>
            <li>Are there any hidden costs involved with the business?</li>
            <li>How much potential does the company have to grow?</li>
            <li>Are there any liabilities associated with the company or product?</li>
            <li>Is the business model sustainable and scalable?</li>
            <li>What are the key risks and how can they be mitigated?</li>
          </ul>
        </div>
        
        <div class="info-column">
          <h4>How we can help</h4>
          
          <ul>
            <li>Our experienced team conducts comprehensive due diligence tailored to your specific needs and industry requirements</li>
            <li>We provide detailed reports highlighting both opportunities and risks with actionable recommendations</li>
            <li>We offer a confidential, professional service ensuring all sensitive information remains protected</li>
            <li>Our analysts have expertise across multiple sectors including technology, manufacturing, retail, healthcare, and more</li>
            <li>We deliver timely results without compromising on quality or depth of analysis</li>
            <li>We provide potential acquirers that help in reducing the risk and give assurance regarding the future of the concerned investment opportunity</li>
          </ul>
        </div>
        
      </div>
    </div>
  </section>

  <!-- ========== QUOTE BANNER ========== -->
  <section class="quote-banner">
    <div class="container">
      <blockquote>
        "DON'T DREAD THE IDEA OF SUBMITTING YOUR BUSINESS RECORDS TO DUE DILIGENCE. EMBRACE THE PROCESS!"
      </blockquote>
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

@section('content')
