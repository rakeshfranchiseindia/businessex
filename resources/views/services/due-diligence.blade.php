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

  
  @include('includes.getintouch')
  @include('includes.groupcompany')
  @include('includes.newsletter')
  @include('includes.categorylinkfooter')

@section('content')
