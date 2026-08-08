@extends('layouts.app')
    @section('content')
    <main style="margin-top: 70px;">
        
        <!-- Article Header Section -->
        <section class="article-header-section">
            <div class="container">
                <!-- Article Title -->
                <h1 class="article-title">'Close the Deal' Program Initiated to Guide Entrepreneurs, MSMEs and Others</h1>
                
                <!-- Article Subtitle -->
                <p class="article-subtitle">In the program, personal limitations were identified and resolved, disempowering mindsets and beliefs of an individual</p>
                
                <!-- Featured Image -->
                <div class="article-featured-image-wrapper">
                    <img 
                        src="https://media.businessex.com/article/pics/1204/1252794505.jpg" 
                        alt="Close the Deal Program - Business Meeting" 
                        class="article-featured-image"
                    >
                </div>
            </div>
        </section>

        <!-- Article Body Section -->
        <section class="article-body-section">
            <div class="container">
                <div class="row">
                    
                    <!-- Main Content Column (Left) -->
                    <div class="col-lg-9 col-md-8">
                        
                        <!-- Meta Information Bar -->
                        <div class="article-meta-bar">
                            <!-- Author Info -->
                            <div class="article-author-info">
                                <img 
                                    src="https://www.businessex.com/assets/img/team-3.jpg" 
                                    alt="Jaspreet Kaur" 
                                    class="author-avatar"
                                >
                                <div class="author-details">
                                    <h4>BY Jaspreet Kaur</h4>
                                    <p>Feature Writer, BusinessEx</p>
                                </div>
                            </div>
                            
                            <!-- Date & Read Time -->
                            <div class="article-meta-info">
                                <span><i class="far fa-calendar-alt"></i> Dec 04, 2021</span>
                                <span class="meta-separator">|</span>
                                <span class="read-time">
                                    <i class="far fa-clock"></i> 8 Mins Read
                                </span>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="article-actions">
                                <button class="action-btn" onclick="scrollToComments()">
                                    <i class="far fa-comment"></i> Comments
                                </button>
                                <button class="action-btn" onclick="shareArticle()">
                                    <i class="fas fa-share-alt"></i> Share
                                </button>
                            </div>
                        </div>

                        <!-- Article Content -->
                        <div class="article-content">
                            <p>
                                Business deals, whether small or large, are crucial opportunities for every entrepreneur. Apart from this, carrying forward a legacy is another vital thing for entrepreneurs today. Considering these areas, the 'Close the Deal' program was conducted by Antano & Harini. Various entrepreneurs, MSME leaders, and corporate professionals participated in the event.
                            </p>

                            <p>
                                In the program, personal limitations were identified and resolved, disempowering the mindsets and beliefs of an individual. The participants were equipped with required mindset shifts, capabilities, strategies to identify hidden opportunities and close the most significant deal. Participants also acquired linguistic patterns used by world leaders to win the hearts of millions, the art of framing and invoking the right emotions, amongst others.
                            </p>

                            <p>
                                "We need more entrepreneurs to revive the economy and create job opportunities in the country. Hence, Close The Deal, so that aspirants can have the required personal transformations, mindset shifts and strategies in place to launch their ventures, secure top-notch mentoring, onboard the right talent, and more," Antano Solar John, Co-Creator of EIT, said.
                            </p>

                            <p>
                                The program helps close the right deal at the right value, be it finding the right mentor, onboarding the right talent or partner, is pivotal in time-compressing legacy outcomes.
                            </p>

                            <p>
                                Some of the EIT-enabled start-ups & EIT Entrepreneurs incubated by Antano & Harini are well-established names in the field of wellness, education, media, coaching, etc.
                            </p>

                            <p>
                                "With over 50,000 breakthroughs, we are the largest one-on-one mentoring platform in the world. Instead of a 'one-size-fits-all' approach, we look at an individual and equip them with the changes that they need to personally evolve and time-compress, launching a unique legacy," Harini Ramachandran, Co-Creator of EIT, chimes in.
                            </p>

                            <p>
                                Legacy Accelerators, Antano Solar John & Harini Ramachandran are co-creators of excellence installations technology (EIT). The technology identifies and develops core capabilities one needs to launch a legacy and achieve in 3 years what would otherwise take 10-20 years.
                            </p>

                            <p>
                                The company is one of the leading mentoring platforms in the world. It claims to have worked with legends including Academy & Grammy Award winners, Padma Bhushan awardees, international-level athletes, billion dollar business owners, investors, actors, doctors, lawyers, entrepreneurs, top executives from the Fortune 500 and more.
                            </p>

                            <p>
                                They are endorsed for their experience and understanding of human excellence by the co-creator of neuro-linguistic programming, Dr. John Grinder, and received the Award of Honour by the Ministry of Social Justice and Empowerment, Government of India.
                            </p>
                        </div>

                        <!-- Tags Block -->
                        <div class="tag-block">
                            <ul class="tag-list">
                                <li><a href="/article/mentor">Mentor</a></li>
                                <li><a href="/article/entrepreneur">Entrepreneur</a></li>
                                <li><a href="/article/msme">MSME</a></li>
                            </ul>
                        </div>

                        <!-- Comment Section -->
                        <div id="comments" class="comment-section">
                            <h3 class="ttl">Please add your Comment</h3>
                            <div class="comment-box">
                                <form id="commentForm" novalidate>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    name="comment_name" 
                                                    placeholder="Enter Your Name"
                                                    required
                                                >
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input 
                                                    type="email" 
                                                    class="form-control" 
                                                    name="comment_email" 
                                                    placeholder="Enter Your Email ID"
                                                    required
                                                >
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <textarea 
                                                    class="form-control" 
                                                    name="comment_detail" 
                                                    rows="5" 
                                                    placeholder="Write your comment here..."
                                                    required
                                                ></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center mt-3">
                                            <button type="submit" class="btn btn-post-comment">
                                                <i class="fas fa-paper-plane mr-2"></i>Post Comment
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- More from Author Section -->
                        <div class="more-from-author">
                            <div class="section-title">
                                <h2>More from Jaspreet Kaur</h2>
                                <div class="viewall">
                                    <a href="#">View All <i class="fas fa-arrow-right ml-1"></i></a>
                                </div>
                            </div>
                            <ul class="bxartlist list-unstyled">
                                <div class="empty-state text-center py-5">
                                    <i class="fas fa-file-alt d-block mb-3"></i>
                                    <p class="mb-0">More articles coming soon...</p>
                                </div>
                            </ul>
                        </div>
                    </div>

                    <!-- Sidebar Column (Right) -->
                    <div class="col-lg-3 col-md-4 rightsec">
                        
                        <!-- Recommended for you Widget -->
                        <div class="rigblk">
                            <div class="section-title">
                                <h2>Recommended for you</h2>
                            </div>
                            <ul class="rlist">
                                <li>
                                    <a href="#">How to Evaluate a Business Before Purchase</a>
                                </li>
                                <li>
                                    <a href="#">Top 10 Investment Opportunities in 2024</a>
                                </li>
                                <li>
                                    <a href="#">Understanding Business Valuation Methods</a>
                                </li>
                                <li>
                                    <a href="#">Key Factors for Successful Entrepreneurship</a>
                                </li>
                                <li>
                                    <a href="#">MSME Growth Strategies for Small Businesses</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Latest News & Articles Widget -->
                        <div class="rigblk">
                            <div class="section-title">
                                <h2>Latest News & Articles</h2>
                            </div>
                            <ul class="rlist">
                                <li>
                                    <a href="#">Franchise India Expands into New Markets</a>
                                </li>
                                <li>
                                    <a href="#">Startup Funding Reaches New Heights This Quarter</a>
                                </li>
                                <li>
                                    <a href="#">Digital Transformation in SME Sector Accelerates</a>
                                </li>
                                <li>
                                    <a href="#">Government Initiatives for Entrepreneurs Announced</a>
                                </li>
                                <li>
                                    <a href="#">Emerging Trends in Business Brokerage Industry</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('includes.groupcompany')
    @include('includes.newsletter')
    @include('includes.categorylinkfooter')
@endsection