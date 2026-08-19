{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')

<!-- ==================== HERO BANNER ==================== -->
<section class="hero-banner">
    <div class="container">
        <div class="hero-content">
            @if($featuredArticle)
                <h1><span>{{ $featuredArticle->article_title }}</span></h1>
                <p>{{ Str::limit(strip_tags($featuredArticle->short_desc), 180) }}</p>
            @else
                <h1><span>BusinessEx Insights</span></h1>
                <p>Latest insights for entrepreneurs, investors, and businesses.</p>
            @endif
                    @if($featuredArticle)
                        <a class="btn-read-more" href="{{ route('bxinsight.show', $featuredArticle->article_id) }}">Read More</a>
                    @endif
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
                        @php($sortUrl = fn ($sort) => request()->fullUrlWithQuery(['sort' => $sort, 'page' => null]))
                        <li><a href="{{ $sortUrl('recent') }}" class="{{ request('sort', 'recent') === 'recent' ? 'active' : '' }}">Most Recent</a></li>
                        <li><a href="{{ $sortUrl('read') }}" class="{{ request('sort') === 'read' ? 'active' : '' }}">Most Read</a></li>
                        <li><a href="{{ $sortUrl('commented') }}" class="{{ request('sort') === 'commented' ? 'active' : '' }}">Most Commented</a></li>
                        <li><a href="{{ $sortUrl('alpha') }}" class="{{ request('sort') === 'alpha' ? 'active' : '' }}">Alphabetical</a></li>
                    </ul>
                </div>

                <form method="GET" action="{{ route('bxinsight.index') }}" class="article-filter-form mb-4">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control" value="{{ request('search') }}" placeholder="Search articles">
                        <select name="category" class="form-control">
                            <option value="">All categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->category_slug }}" {{ request('category') === $category->category_slug ? 'selected' : '' }}>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        <button class="btn article-search-button" type="submit">Search</button>
                    </div>
                </form>

                <!-- Articles Grid -->
                <div class="articles-grid">
                    @forelse($articles as $article)
                        <article class="article-card">
                            <div class="article-image-wrapper">
                                <img src="{{ asset($article->listing_image_path) }}" alt="{{ $article->article_title }}" class="article-image" loading="lazy">
                            </div>
                            <div class="article-body">
                                <a href="{{ route('bxinsight.show', $article->article_id) }}" class="article-title-link">{{ $article->article_title }}</a>
                                <p class="article-excerpt">{{ Str::limit(strip_tags($article->short_desc), 150) }}</p>
                                <div class="article-meta">
                                    <div>
                                        <span class="article-date">{{ optional($article->created_at)->format('M j, Y') }}</span>
                                        <span class="article-read-time ml-2">{{ $article->author->author_name ?? 'BusinessEx' }}</span>
                                    </div>
                                    <a href="{{ route('bxinsight.show', $article->article_id) }}#comments" class="btn-share" title="View comments">
                                        <i class="fas fa-share-alt"></i> Share
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <p class="alert alert-info">No articles found.</p>
                    @endforelse
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
                                    <a href="{{ route('bxinsight.show', $article->article_id) }}" class="latest-news-title">{{ $article->article_title }}</a>
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

<style>
    .article-search-button {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: #fff;
    }

    .article-search-button:hover,
    .article-search-button:focus {
        background: var(--primary-dark, #d95d00);
        border-color: var(--primary-dark, #d95d00);
        color: #fff;
    }
</style>

  @include('includes.groupcompany')
  @include('includes.newsletter')
  @include('includes.categorylinkfooter')
@endsection