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
  @include('includes.faqlist')
  @include('includes.getintouch')
  @include('includes.groupcompany')
  @include('includes.newsletter')
  @include('includes.categorylinkfooter')
  
@endsection

