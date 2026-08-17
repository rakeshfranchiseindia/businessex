@extends('account_dashboard.accountDashboardApp')

@section('title', 'My Account')

@section('content')
@include('account_dashboard.dashboardSidebar')

<style>
    .main-content { background: #fff; border-radius: 12px; padding: 25px; margin-bottom: 30px; box-shadow: 0 3px 15px rgba(0,0,0,0.06); }
    .page-title { font-size: 20px; font-weight: 700; color: #222; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #eee; text-transform: uppercase; }
    .proposal-card { display: flex; gap: 16px; align-items: flex-start; padding: 18px 0; border-bottom: 1px solid #eee; }
    .proposal-card:last-child { border-bottom: none; }
    .proposal-card-image { width: 110px; height: 78px; border-radius: 8px; object-fit: cover; flex-shrink: 0; background: #e9f1f8; }
    .proposal-card-image-fallback {
        width: 110px; height: 78px; border-radius: 8px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, #2563eb, #7c3aed); color: #fff; font-size: 24px; font-weight: 700;
    }
    .proposal-card-body { flex: 1; min-width: 0; }
    .proposal-card-type { display: inline-block; font-size: 11px; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: #1f4e79; background: #e9f1f8; padding: 2px 8px; border-radius: 10px; margin-bottom: 6px; }
    .proposal-card-title { font-weight: 700; color: #222; margin-bottom: 4px; }
    .proposal-card-meta { font-size: 13px; color: #888; margin-bottom: 6px; }
    .proposal-card-price { font-weight: 700; color: #198754; font-size: 14px; }
    .proposal-card-price-label { font-size: 12px; color: #888; margin-left: 4px; }
    .proposal-empty { text-align: center; color: #888; padding: 40px 0; }
</style>

<div class="col-lg-8 col-md-8 dashboard-main-content">
    <div class="main-content">
        <h5 class="page-title">{{ $title }}</h5>

        @forelse($proposals as $proposal)
            <div class="proposal-card">
                @if(!empty($proposal['thumbimage']))
                    <img src="{{ $proposal['thumbimage'] }}" class="proposal-card-image" alt="{{ $proposal['title'] }}">
                @elseif(!empty($proposal['catImageUrl']))
                    <img src="{{ $proposal['catImageUrl'] }}" class="proposal-card-image" alt="{{ $proposal['title'] }}">
                @else
                    <div class="proposal-card-image-fallback">{{ strtoupper(substr($proposal['type'], 0, 1)) }}</div>
                @endif

                <div class="proposal-card-body">
                    <span class="proposal-card-type">{{ $proposal['type'] }}</span>
                    <div class="proposal-card-title">
                        <a href="{{ $proposal['profileurl'] }}" style="color:inherit; text-decoration:none;">{{ $proposal['title'] ?: 'Untitled listing' }}</a>
                    </div>
                    <div class="proposal-card-meta">{{ $proposal['location'] }}{{ $proposal['industry'] ? ' · ' . $proposal['industry'] : '' }}</div>
                    <div>
                        <span class="proposal-card-price">{{ $proposal['price'] }}</span>
                        <span class="proposal-card-price-label">{{ $proposal['priceLabel'] }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="proposal-empty">No contact history found!</div>
        @endforelse
    </div>
</div>
@endsection
