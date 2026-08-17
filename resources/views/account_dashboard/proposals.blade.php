@extends('account_dashboard.accountDashboardApp')

@section('title', 'My Account')

@section('content')
@include('account_dashboard.dashboardSidebar')

<style>
    .main-content { background: #fff; border-radius: 12px; padding: 25px; margin-bottom: 30px; box-shadow: 0 3px 15px rgba(0,0,0,0.06); }
    .page-title { font-size: 20px; font-weight: 700; color: #222; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #eee; }
    .proposal-item { display: flex; gap: 15px; align-items: flex-start; padding: 16px 0; border-bottom: 1px solid #eee; }
    .proposal-item:last-child { border-bottom: none; }
    .proposal-avatar { width: 48px; height: 48px; border-radius: 50%; object-fit: cover; background: #e9f1f8; flex-shrink: 0; }
    .proposal-body { flex: 1; min-width: 0; }
    .proposal-name { font-weight: 700; color: #222; margin-bottom: 2px; }
    .proposal-meta { font-size: 12px; color: #888; margin-bottom: 6px; }
    .proposal-msg { font-size: 14px; color: #444; }
    .proposal-empty { text-align: center; color: #888; padding: 40px 0; }
    .proposal-avatar-fallback {
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        color: #fff;
        font-size: 18px;
        font-weight: 700;
    }
</style>

<div class="col-lg-8 col-md-8 dashboard-main-content">
    <div class="main-content">
        <h5 class="page-title">{{ strtoupper($title) }}</h5>

        @forelse($proposals as $proposal)
            <div class="proposal-item">
                @if(!empty($proposal['profilepic']) && file_exists(public_path($proposal['profilepic'])))
                    <img src="{{ asset($proposal['profilepic']) }}" class="proposal-avatar" alt="{{ $proposal['name'] }}">
                @else
                    <div class="proposal-avatar proposal-avatar-fallback">{{ strtoupper(substr($proposal['name'] ?: 'U', 0, 1)) }}</div>
                @endif
                <div class="proposal-body">
                    <div class="proposal-name">{{ $proposal['name'] ?: 'Unknown user' }} <span style="font-weight:400;color:#888;">&middot; {{ $proposal['profileName'] }}</span></div>
                    <div class="proposal-meta">{{ $proposal['location'] }}{{ $proposal['category'] ? ' · ' . $proposal['category'] : '' }}</div>
                    <div class="proposal-msg">{{ $proposal['msg'] }}</div>
                </div>
            </div>
        @empty
            <div class="proposal-empty">No {{ strtolower($title) }} yet.</div>
        @endforelse
    </div>
</div>
@endsection
