@extends('layouts.app')

@section('content')
<main class="article-detail-page">
    <section class="article-header-section">
        <div class="container">
            <h1 class="article-title">{{ $article->article_title }}</h1>
            <p class="article-subtitle">{{ $article->short_desc }}</p>
            <div class="article-featured-image-wrapper">
                <img src="{{ asset($article->image_path) }}" alt="{{ $article->article_title }}" class="article-featured-image">
            </div>
        </div>
    </section>

    <section class="article-body-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    <div class="article-meta-bar">
                        <div class="article-author-info">
                            <img src="{{ asset($article->author->author_image ?? 'assets/img/team-3.jpg') }}" alt="{{ $article->author->author_name ?? 'BusinessEx' }}" class="author-avatar">
                            <div class="author-details">
                                <h4>BY {{ $article->author->author_name ?? 'BusinessEx' }}</h4>
                                <p>{{ $article->author->author_desig ?? 'BusinessEx' }}</p>
                            </div>
                        </div>
                        <div class="article-meta-info">
                            <span><i class="far fa-calendar-alt"></i> {{ optional($article->created_at)->format('M j, Y') }}</span>
                            <span class="meta-separator">|</span>
                            <span><i class="far fa-eye"></i> {{ number_format((int) $article->article_views) }} views</span>
                        </div>
                        <div class="article-actions">
                            <button type="button" class="action-btn" onclick="document.getElementById('comments').scrollIntoView({behavior: 'smooth'})"><i class="far fa-comment"></i> {{ $article->comments->count() }} Comments</button>
                            <button type="button" class="action-btn" onclick="openArticleShare()"><i class="fas fa-share-alt"></i> Share</button>
                        </div>
                    </div>

                    <div class="article-content">{!! $article->article_content !!}</div>

                    @php($tags = array_filter(array_map('trim', explode(',', (string) $article->article_tags))))
                    @if($tags)
                        <div class="tag-block"><ul class="tag-list">
                            @foreach($tags as $tag)<li><a href="{{ route('bxinsight.index', ['search' => $tag]) }}">{{ $tag }}</a></li>@endforeach
                        </ul></div>
                    @endif

                    <div id="comments" class="comment-section">
                        <h3 class="ttl">Please add your Comment</h3>
                        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                        @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
                        <div class="comment-box">
                            <form method="POST" action="{{ route('bxinsight.comments.store', $article->article_id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6"><input type="text" class="form-control" name="comment_name" value="{{ old('comment_name') }}" placeholder="Enter Your Name" required></div>
                                    <div class="col-sm-6"><input type="email" class="form-control" name="comment_email" value="{{ old('comment_email') }}" placeholder="Enter Your Email ID" required></div>
                                    <div class="col-12 mt-3"><textarea class="form-control" name="comment_detail" rows="5" placeholder="Write your comment here..." required>{{ old('comment_detail') }}</textarea></div>
                                    <div class="col-12 text-center mt-3"><button type="submit" class="btn btn-post-comment"><i class="fas fa-paper-plane mr-2"></i>Post Comment</button></div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if($article->comments->isNotEmpty())
                        <div class="article-comments-list mt-4"><h3 class="ttl">Comments</h3>
                            @foreach($article->comments as $comment)
                                <div class="comment-item mb-3"><strong>{{ $comment->comment_name }}</strong><small class="d-block text-muted">{{ optional($comment->created_at)->format('M j, Y') }}</small><p class="mb-0">{{ $comment->comment_detail }}</p></div>
                            @endforeach
                        </div>
                    @endif

                    <div class="more-from-author">
                        <div class="section-title"><h2>More from {{ $article->author->author_name ?? 'BusinessEx' }}</h2></div>
                        <ul class="bxartlist list-unstyled">
                            @forelse($relatedArticles as $related)<li><a href="{{ route('bxinsight.show', $related->article_id) }}">{{ $related->article_title }}</a></li>@empty<li>No related articles found.</li>@endforelse
                        </ul>
                    </div>
                </div>

                <aside class="col-lg-3 col-md-4 rightsec">
                    <div class="rigblk article-sidebar-widget">
                        <div class="section-title"><h2>Recommended for you</h2></div>
                        <ul class="rlist article-sidebar-list">
                            @forelse($recommendedArticles as $recommended)
                                @php($recommendedImage = $recommended->listing_image_path ?: $recommended->image_path)
                                <li class="article-sidebar-item">
                                    <a href="{{ route('bxinsight.show', $recommended->article_id) }}" class="article-sidebar-link">
                                        <img src="{{ Str::startsWith($recommendedImage, ['http://', 'https://']) ? $recommendedImage : asset($recommendedImage) }}" alt="{{ $recommended->article_title }}">
                                        <span class="article-sidebar-copy">
                                            <strong>{{ Str::limit($recommended->article_title, 48) }}</strong>
                                            <small>{{ optional($recommended->created_at)->format('F d, Y') }}</small>
                                        </span>
                                    </a>
                                </li>
                            @empty
                                <li class="article-sidebar-empty">No recommendations found.</li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="rigblk article-sidebar-widget">
                        <div class="section-title"><h2>Latest News &amp; Articles</h2></div>
                        <ul class="rlist article-sidebar-list">
                            @forelse($latestArticles as $latest)
                                @php($latestImage = $latest->listing_image_path ?: $latest->image_path)
                                <li class="article-sidebar-item">
                                    <a href="{{ route('bxinsight.show', $latest->article_id) }}" class="article-sidebar-link">
                                        <img src="{{ Str::startsWith($latestImage, ['http://', 'https://']) ? $latestImage : asset($latestImage) }}" alt="{{ $latest->article_title }}">
                                        <span class="article-sidebar-copy">
                                            <strong>{{ Str::limit($latest->article_title, 48) }}</strong>
                                            <small>{{ optional($latest->created_at)->format('F d, Y') }}</small>
                                        </span>
                                    </a>
                                </li>
                            @empty
                                <li class="article-sidebar-empty">No latest articles found.</li>
                            @endforelse
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</main>
@include('includes.groupcompany')
@include('includes.newsletter')
@include('includes.categorylinkfooter')

<div id="articleShareModal" class="article-share-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="articleShareTitle">
    <div class="article-share-backdrop" data-close-share></div>
    <div class="article-share-dialog">
        <button type="button" class="article-share-close" aria-label="Close share dialog" data-close-share>&times;</button>
        <h2 id="articleShareTitle">Share</h2>
        <div class="article-share-options">
            <a id="shareFacebook" class="article-share-option facebook" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-facebook-f"></i><span>Facebook</span>
            </a>
            <a id="shareTwitter" class="article-share-option twitter" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-twitter"></i><span>Twitter</span>
            </a>
            <a id="shareLinkedIn" class="article-share-option linkedin" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-linkedin-in"></i><span>LinkedIn</span>
            </a>
            <a id="shareWhatsApp" class="article-share-option whatsapp" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-whatsapp"></i><span>WhatsApp</span>
            </a>
        </div>
    </div>
</div>

<script>
    function openArticleShare() {
        const modal = document.getElementById('articleShareModal');
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent(document.title);
        const text = encodeURIComponent(document.querySelector('.article-title')?.textContent.trim() || document.title);

        document.getElementById('shareFacebook').href = 'https://www.facebook.com/sharer/sharer.php?u=' + url;
        document.getElementById('shareTwitter').href = 'https://twitter.com/intent/tweet?url=' + url + '&text=' + text;
        document.getElementById('shareLinkedIn').href = 'https://www.linkedin.com/sharing/share-offsite/?url=' + url;
        document.getElementById('shareWhatsApp').href = 'https://api.whatsapp.com/send?text=' + text + '%20' + url;

        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('article-share-open');
        modal.querySelector('.article-share-close').focus();
    }

    function closeArticleShare() {
        const modal = document.getElementById('articleShareModal');
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('article-share-open');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('articleShareModal');
        modal.querySelectorAll('[data-close-share]').forEach(function (element) {
            element.addEventListener('click', closeArticleShare);
        });
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && modal.classList.contains('is-open')) closeArticleShare();
        });
    });
</script>

<style>
    body.article-share-open {
        overflow: hidden;
    }

    .article-share-modal {
        display: none;
        inset: 0;
        position: fixed;
        z-index: 2000;
    }

    .article-share-modal.is-open {
        display: block;
    }

    .article-share-backdrop {
        background: rgba(0, 0, 0, 0.45);
        inset: 0;
        position: absolute;
    }

    .article-share-dialog {
        background: #fff;
        border-radius: 0 0 18px 18px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
        left: 50%;
        max-width: 410px;
        padding: 14px 20px 24px;
        position: absolute;
        top: 0;
        transform: translateX(-50%);
        width: calc(100% - 30px);
    }

    .article-share-dialog h2 {
        color: #111;
        font-size: 30px;
        font-weight: 400;
        line-height: 38px;
        margin: 0 0 14px;
    }

    .article-share-close {
        background: #34495e;
        border: 0;
        border-radius: 50%;
        color: #fff;
        cursor: pointer;
        font-size: 25px;
        height: 27px;
        line-height: 22px;
        padding: 0;
        position: absolute;
        right: 18px;
        top: 17px;
        width: 27px;
    }

    .article-share-options {
        display: grid;
        gap: 14px 18px;
        grid-template-columns: 1fr 1fr;
    }

    .article-share-option {
        align-items: center;
        color: #080808;
        display: flex;
        font-size: 18px;
        font-weight: 700;
        gap: 20px;
        min-height: 42px;
        padding: 6px 12px;
        text-decoration: none !important;
    }

    .article-share-option i {
        color: #050505;
        font-size: 23px;
        text-align: center;
        width: 24px;
    }

    .article-share-option:first-child {
        border: 3px solid #222;
        border-radius: 5px;
    }

    .article-share-option:hover {
        color: #fe7806;
    }

    @media (max-width: 420px) {
        .article-share-dialog {
            width: 100%;
        }
    }

    .article-detail-page .rightsec {
        padding-top: 0;
    }

    .article-detail-page .article-sidebar-widget {
        background: #f7f7f7;
        border: 0;
        border-radius: 0;
        box-shadow: none;
        padding: 0;
    }

    .article-detail-page .article-sidebar-widget .section-title {
        border-bottom: 1px solid #d9d9d9;
        margin-bottom: 12px;
        padding: 0 0 22px;
        position: relative;
    }

    .article-detail-page .article-sidebar-widget .section-title::after {
        background: #fe7806;
        bottom: -1px;
        content: '';
        height: 2px;
        left: 0;
        position: absolute;
        width: 135px;
    }

    .article-detail-page .article-sidebar-widget .section-title h2 {
        color: #111;
        font-size: 28px;
        font-weight: 400;
        line-height: 32px;
        margin: 0;
    }

    .article-detail-page .article-sidebar-list {
        margin: 0 0 26px;
        padding: 0;
    }

    .article-detail-page .article-sidebar-item {
        border-bottom: 1px solid #d9d9d9;
        list-style: none;
        margin: 0;
        padding: 12px 0;
    }

    .article-detail-page .article-sidebar-link {
        align-items: flex-start;
        display: flex;
        gap: 14px;
        text-decoration: none;
    }

    .article-detail-page .article-sidebar-link img {
        background: #fff;
        border: 1px solid #d9d9d9;
        border-radius: 6px;
        flex: 0 0 148px;
        height: 86px;
        object-fit: cover;
        padding: 6px;
        width: 148px;
    }

    .article-detail-page .article-sidebar-copy {
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .article-detail-page .article-sidebar-copy strong {
        color: #080808;
        font-size: 19px;
        line-height: 22px;
    }

    .article-detail-page .article-sidebar-copy small {
        color: #999;
        font-size: 16px;
        line-height: 20px;
        margin-top: 8px;
    }

    .article-detail-page .article-sidebar-empty {
        color: #777;
        list-style: none;
        padding: 12px 0 20px;
    }

    @media (max-width: 991px) {
        .article-detail-page .rightsec {
            margin-top: 30px;
        }
    }
</style>
@endsection
