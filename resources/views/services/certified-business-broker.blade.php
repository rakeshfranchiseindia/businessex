@extends('layouts.app')
@section('content')
    <!-- ========== HERO SECTION ========== -->
  <section class="hero-section hero-broker">
    <div class="container">
      <div class="row align-items-center w-100">
        <div class="col-lg-7 broker-hero-content mb-5 mb-lg-0">
          <h1>Certified Business Broker (CBB)</h1>
          <p>A Professional Certification Program On Business Brokerage</p>
        </div>
        <div class="col-lg-5">
          <div class="hero-form-card">
            <h3>Become a Certified Business Broker</h3>
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
            <form class="hero-form" method="POST" action="{{ route('service.payment.initiate') }}">
              @csrf
              <input type="hidden" name="service_type" value="5">
              <div class="form-group"><input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}" required></div>
              <div class="form-group"><input type="email" name="email" class="form-control" placeholder="Your Email" value="{{ old('email') }}" required></div>
              <div class="form-group"><input type="tel" name="mobile" class="form-control" placeholder="Your Mobile" value="{{ old('mobile') }}" required></div>
              <div class="form-group"><input type="text" name="company" class="form-control" placeholder="Your Company" value="{{ old('company') }}" required></div>
              <div class="form-group">
                <select class="form-control" name="payment_mode" required>
                  <option value="">Select Payment Mode</option>
                  <option value="OPTCRDC">Credit Card</option>
                  <option value="OPTDBCRD">Debit Card</option>
                  <option value="OPTNBK">Net Banking</option>
                </select>
              </div>
              <button type="submit" class="btn-submit-primary">SUBMIT</button>
            </form>
            @if($errors->any())<div class="alert alert-danger mt-3">{{ $errors->first() }}</div>@endif
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== ABOUT CBB PROGRAM ========== -->
  <section class="section-padding bg-white-section">
    <div class="container">
      <div class="content-with-image">
        <div class="col-auto content-image">
          <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=450&h=320&fit=crop" alt="CBB Program Training" class="img-fluid rounded-custom">
        </div>
        
        <div class="col content-text">
          <h2>About CBB Program</h2>
          
          <p><strong>Certified Business Broker (CBB) Program is a professional certification program tailored to fit the schedules of busy professionals / individuals with our intense Training Module.</strong> This program comprises of instructional syllabus covering the best practices, fundamentals and insights including interviews with industry experts.</p>
          
          <p>The program will help to raise your level of Business Brokerage Knowledge in order to increase your ability to work quickly and effectively. This Program will play an essential role in enhancing your skills and developing your abilities towards Broking.</p>
          
          <p style="margin-top: 20px;"><strong>The Certified Business Broker Program includes:</strong></p>
          
          <ul style="list-style: none; padding-left: 0;">
            <li style="padding: 8px 0; padding-left: 25px; position: relative;">
              <span style="position: absolute; left: 0; color: var(--primary-color);">•</span>
              A theoretical framework for Business Brokering and the importance of good broking in the development of robust, efficient and innovative business deals
            </li>
            <li style="padding: 8px 0; padding-left: 25px; position: relative;">
              <span style="position: absolute; left: 0; color: var(--primary-color);">•</span>
              Brokering skills development in resource-mapping, relationship-management, partnering negotiations, facilitation and reviewing to reach final agreement
            </li>
            <li style="padding: 8px 0; padding-left: 25px; position: relative;">
              <span style="position: absolute; left: 0; color: var(--primary-color);">•</span>
              Exploration of common brokering challenges
            </li>
            <li style="padding: 8px 0; padding-left: 25px; position: relative;">
              <span style="position: absolute; left: 0; color: var(--primary-color);">•</span>
              Action planning for individual applications
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== 5R'S STRATEGY ========== -->
  <section class="section-padding bg-light-section">
    <div class="container">
      <div class="section-title">
        <h2>5R'S Strategy</h2>
      </div>
      
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <ol class="strategy-list">
            <li>Realize and learn how to develop a strategy</li>
            <li>Register different techniques</li>
            <li>Recognize and discuss the leading practices</li>
            <li>Review the latest trends and developments</li>
            <li>Refine and rebuild your approach</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== CBB PROGRAM ADVANTAGES ========== -->
  <section class="section-padding bg-white-section">
    <div class="container">
      <div class="section-title">
        <h2>CBB Program – Advantages</h2>
      </div>
      
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <p style="color: var(--text-light); font-size: 16px; line-height: 1.8; margin-bottom: 25px;">
            <strong>Certified Business Broker (CBB) Program covers all basic Business Brokerage fundamentals and advanced techniques which are used to attain success in the highly prestigious, multi-crore Business Brokerage industry.</strong>
          </p>
          
          <p style="color: var(--text-light); font-size: 16px; line-height: 1.8; margin-bottom: 25px;">
            Certified Business Broker training program is designed to train individuals to start their own Business Brokerage or to enhance the existing Brokerage Business and become a successful Entrepreneur.
          </p>
          
          <p style="color: var(--text-light); font-size: 16px; line-height: 1.8; margin-bottom: 25px;">
            A Certified Business Broker is qualified to join BusinessEx broker network and will get an opportunity to become a member of Indian Business Brokers Association.
          </p>
          
          <h4 style="font-size: 20px; font-weight: 700; color: var(--secondary-color); margin-top: 35px; margin-bottom: 20px;">Key Takeaways</h4>
          
          <ul style="list-style: none; padding-left: 0;">
            <li style="padding: 10px 0; padding-left: 25px; position: relative; color: var(--text-dark);">
              <span style="position: absolute; left: 0; color: var(--primary-color); font-weight: bold;">•</span>
              Advance your Business Brokerage career
            </li>
            <li style="padding: 10px 0; padding-left: 25px; position: relative; color: var(--text-dark);">
              <span style="position: absolute; left: 0; color: var(--primary-color); font-weight: bold;">•</span>
              Speak the Business Brokerage language
            </li>
            <li style="padding: 10px 0; padding-left: 25px; position: relative; color: var(--text-dark);">
              <span style="position: absolute; left: 0; color: var(--primary-color); font-weight: bold;">•</span>
              Add the Certification from BusinessEx to Your Professional Career
            </li>
            <li style="padding: 10px 0; padding-left: 25px; position: relative; color: var(--text-dark);">
              <span style="position: absolute; left: 0; color: var(--primary-color); font-weight: bold;">•</span>
              Practical experience to enhance Business Brokering skills & analytical capabilities with an aptitude for working with diverse groups
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== TRAINING MODULE ========== -->
  <section class="section-padding bg-light-section">
    <div class="container">
      <div class="section-title">
        <h2>Training Module</h2>
      </div>
      
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <p style="color: var(--text-light); font-size: 18px; line-height: 1.7; margin-bottom: 15px;">
            <strong>A 4-day Training and Professional Development Program</strong>
          </p>
          
          <p style="color: var(--text-light); font-size: 15px; line-height: 1.8; margin-bottom: 30px;">
            The Training Program would be an in-house extensive session led by our experienced team of consultants and sales professionals. The program has been designed to equip you with the appropriate tools and market knowledge to be successful. The first three and half days would be for class-room training program. On the last day of training, we will have half day dedicated for an informal networking session followed by Cocktails and Dinner.
          </p>
          
          <p style="color: var(--secondary-color); font-size: 16px; font-weight: 600; margin-bottom: 25px;">
            The Training Program shall cover the following aspects but shall not be limited to below:
          </p>
          
          <!-- Day 1 -->
          <div class="training-day">
            <h5>Day 1</h5>
            
            <h6>Introduction</h6>
            <ul>
              <li>About Franchise India: Group Companies & Our Products</li>
              <li>About Business Ex: Our Role, Mission & Vision</li>
              <li>About Biz Equity: Its Valuation Tools</li>
            </ul>
            
            <h6>Understanding the Business Brokerage space</h6>
            <ul>
              <li>The Eco System of Business Brokerage</li>
              <li>Indian Business Brokerage Industry</li>
              <li>Market Size</li>
              <li>Merger & Acquisition</li>
              <li>Opportunity with BusinessEx</li>
              <li>Need Gap Analysis</li>
            </ul>
          </div>
          
          <!-- Day 2 -->
          <div class="training-day">
            <h5>Day 2</h5>
            
            <h6>Valuation & Deal Making</h6>
            <ul>
              <li>Fundamentals of Business Brokerage</li>
              <li>Business Valuation & Pricing</li>
              <li>Understanding Financials: Fundamentals, Analysis</li>
              <li>Market Conditions & Market Price</li>
              <li>Knowing Competitive Advantage of Business Asset</li>
              <li>Setting Expectations</li>
              <li>Due Diligence</li>
              <li>Negotiation Techniques</li>
              <li>Deal Structuring & Transaction Management</li>
              <li>Deal Closing</li>
              <li>Legal Framework</li>
            </ul>
          </div>
          
          <!-- Day 3 -->
          <div class="training-day">
            <h5>Day 3</h5>
            
            <h6>How to Run Successful Brokerage Business: Building Operational Knowledge</h6>
            <ul>
              <li>Local Market Analysis</li>
              <li>Presentation to Business Seller</li>
              <li>Database Creation</li>
              <li>Building Quality Inventory</li>
              <li>Sales Process</li>
              <li>On boarding of Asset & Activation</li>
              <li>Strategic Marketing - Generating Buyer & Seller Leads</li>
              <li>Business Listings</li>
              <li>Leveraging Business Ex Marketing Platforms</li>
              <li>Leveraging Business Ex Infrastructure</li>
              <li>Sales Tools & Resources</li>
            </ul>
          </div>
          
          <!-- Day 4 -->
          <div class="training-day">
            <h5>Day 4</h5>
            
            <h6>Post CBB Certification Knowledge Base: Building Sustainable Business</h6>
            <ul>
              <li>Understanding Commission Structures</li>
              <li>Managing Client Relationships</li>
              <li>Ethics in Business Brokerage</li>
              <li>Legal Compliance & Documentation</li>
              <li>Using Technology Effectively</li>
              <li>Networking Strategies</li>
              <li>Growing Your Brokerage Practice</li>
            </ul>
            
            <h6>Post CBB Benefits</h6>
            <ul>
              <li>Access to BusinessEx's extensive database of listings</li>
              <li>Ongoing support and mentorship from industry experts</li>
              <li>Exclusive invitations to networking events and conferences</li>
              <li>Marketing support and co-branding opportunities</li>
              <li>Continuing education resources and updates</li>
            </ul>
          </div>
          
          <!-- Additional Sections -->
          <div class="training-day">
            <h5>Buying & Selling Events</h5>
            <ul>
              <li>BusinessEx organizes regular buying and selling events across major cities</li>
              <li>CBB certified brokers get priority access and discounted participation rates</li>
              <li>These events provide excellent networking opportunities with potential buyers and sellers</li>
              <li>Learn from real deal-making scenarios and case studies</li>
            </ul>
          </div>
          
          <div class="training-day">
            <h5>Eligibility</h5>
            <ul>
              <li>Graduate in any discipline from a recognized university</li>
              <li>Minimum 2 years of experience in business/sales/marketing (preferred)</li>
              <li>Strong communication and interpersonal skills</li>
              <li>Entrepreneurial mindset and passion for business brokerage</li>
              <li>Basic understanding of financial statements (beneficial)</li>
            </ul>
          </div>
          
          <div class="training-day">
            <h5>Due CBB is comprehensively & extensively specialized</h5>
            <p style="color: var(--text-light); font-size: 14px; line-height: 1.7; margin: 0;">
              Our certification program is designed by industry veterans who bring decades of hands-on experience in business brokerage. The curriculum is regularly updated to reflect current market trends, regulatory changes, and best practices. Upon completion, you'll have both theoretical knowledge and practical skills to excel in this dynamic field.
            </p>
          </div>
          
        </div>
      </div>
    </div>
  </section>

  @include('includes.getintouch')
  @include('includes.groupcompany')
  @include('includes.newsletter')
  @include('includes.categorylinkfooter')

<style>
  .hero-broker { min-height: 650px; background-size: cover; background-position: center; }
  .hero-broker .hero-form-card { max-width: 510px; margin-left: auto; padding: 22px 24px; }
  .hero-broker .hero-form-card h3 { font-size: 24px; line-height: 30px; margin-bottom: 16px; }
  .hero-broker .hero-form .form-group { margin-bottom: 12px; }
  .hero-broker .hero-form-card .form-control { height: 48px; padding: 10px 13px; font-size: 15px; }
  .hero-broker .btn-submit-primary { padding: 10px 32px; font-size: 16px; }
  .hero-broker .alert { margin-bottom: 12px; padding: 8px 12px; }
  @media (max-width: 991px) { .hero-broker { min-height: auto; padding: 55px 0; } .hero-broker .hero-form-card { margin: 24px auto 0; } }
  @media (max-width: 575px) { .hero-broker { padding: 35px 0; } .hero-broker .hero-form-card { padding: 18px; } .hero-broker .hero-form-card h3 { font-size: 22px; line-height: 27px; } }
</style>
@endsection
