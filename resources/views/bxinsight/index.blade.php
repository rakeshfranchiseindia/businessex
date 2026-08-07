{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')

<!-- ==================== HERO BANNER ==================== -->
<section class="hero-banner">
    <div class="container">
        <div class="hero-content">
            <h1>'<span>Close the Deal</span>' Program Initiated to Guide Entrepreneurs, MSMEs and Others</h1>
            <p>In the program, personal limitations were identified and resolved, disempowering mindsets and beliefs...</p>
            <button class="btn-read-more" onclick="showNotification('Opening article...', 'info')">Read More</button>
        </div>
    </div>
</section>

<!-- ==================== MAIN CONTENT ==================== -->
<main class="main-content">
    <div class="container-fluid px-4">
        <div class="row">

            <!-- Left Column - Articles Grid -->
            <div class="col-lg-8">
                <h2 class="page-section-title">Articles</h2>
                <p class="section-description">
                    Discover all the relevant information you need for start-ups, businesses, investments, mentorship, brokerage, lending, & incubation right here on BusinessEx.com article division.
                </p>

                <!-- Sort/Filter Bar -->
                <div class="sort-bar">
                    <span class="sort-label">SORT BY :</span>
                    <ul class="sort-options">
                        <li><a href="#" class="active" data-sort="recent">Most Recent</a></li>
                        <li><a href="#" data-sort="read">Most Read</a></li>
                        <li><a href="#" data-sort="commented">Most Commented</a></li>
                        <li><a href="#" data-sort="alphabetical">Alphabetical</a></li>
                    </ul>
                </div>

                <!-- Articles Grid -->
                <div class="articles-grid">
                    {{-- Example loop for articles --}}
                    <?php //dd($latestArticles); ?>
                    @foreach($latestArticles as $article)
                        <article class="article-card">
                            <div class="article-image-wrapper">
                                <img src="{{ asset($article->listing_image_path) }}" alt="{{ $article->title }}" class="article-image" loading="lazy">
                            </div>
                            <div class="article-body">
                                <a href="{{ route('bxinsight.show', $article->article_id) }}" class="article-title-link">{{ $article->title }}</a>
                                <p class="article-excerpt">{{ $article->excerpt }}</p>
                                <div class="article-meta">
                                    <div>
                                        <span class="article-date">{{ $article->date }}</span>
                                        <span class="article-read-time ml-2">{{ $article->read_time }} Min Read</span>
                                    </div>
                                    <button class="btn-share" title="Share this article">
                                        <i class="fas fa-share-alt"></i> Share
                                    </button>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    {{ $articles->links() }}
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <aside class="col-lg-4 pl-lg-4">
                <div class="sidebar">
                    <!-- Latest News & Articles Widget -->
                    <div class="sidebar-widget">
                        <h3 class="sidebar-title">Latest News & Articles</h3>
                        @foreach($latestArticles as $article)
                            <div class="latest-news-item">
                                <img src="{{ asset($article->listing_image_path) }}" alt="Article" class="latest-news-image">
                                <div class="latest-news-content">
                                    <a href="{{-- route('bxinsight.show', $article->article_id) --}}" class="latest-news-title">{{ $article->article_title }}</a>
                                    <span class="latest-news-date">{{ $article->created_at->format('M j, Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </aside>

        </div>
    </div>
</main>

<!-- ==================== GROUP COMPANIES SECTION ==================== -->
{{-- <section class="group-companies-section">
    <div class="container-fluid px-4">
        <h2 class="group-companies-title">Our Group Companies</h2>
        <div class="company-logos-grid">
            @foreach($companies as $company)
                <img src="{{ $company->logo }}" alt="{{ $company->name }}" class="company-logo-img">
            @endforeach
        </div>
    </div>
</section> --}}

<!-- ==================== NEWSLETTER SECTION ==================== -->
<section class="newsletter-section">
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-md-5 mb-4 mb-md-0">
                <div class="newsletter-content">
                    <h3>Get Industry First Insights</h3>
                    <p>Sign up for our exclusive Newsletter</p>
                </div>
            </div>
            <div class="col-md-7">
                <form class="newsletter-form row no-gutters" method="POST" action="{{-- route('newsletter.subscribe') --}}">
                    @csrf
                    <div class="col-sm-6 col-md-5 pr-md-2 mb-2 mb-sm-0">
                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="col-sm-6 col-md-5 pr-md-2 mb-2 mb-sm-0">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="col-sm-6 col-md-5 pr-md-2 mt-sm-2 mt-md-0">
                        <input type="tel" name="contact" class="form-control" placeholder="Contact No.">
                    </div>
                    <div class="col-sm-6 col-md-5 mt-sm-2 mt-md-0">
                        <input type="text" name="city" class="form-control" placeholder="City">
                    </div>
                    <div class="col-12 text-center mt-3">
                        <button type="submit" class="btn-subscribe-newsletter">Subscribe Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ==================== FOOTER SOCIAL SECTION ==================== -->
<section class="footer-social-section">
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <span class="footer-social-label">Follow BusinessEx</span>
                <div class="social-links-footer d-inline-flex ml-3">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <span class="footer-stay-tuned">Stay tuned & get updated</span>
            </div>
        </div>
    </div>
</section>

@endsection