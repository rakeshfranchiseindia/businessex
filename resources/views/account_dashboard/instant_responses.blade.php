@extends('account_dashboard.accountDashboardApp')

@section('title', 'My Account')

@section('content')
@include('account_dashboard.dashboardSidebar')

<style>
    .main-content { background: #fff; border-radius: 12px; padding: 25px; margin-bottom: 30px; box-shadow: 0 3px 15px rgba(0,0,0,0.06); }
    .page-title { font-size: 20px; font-weight: 700; color: #222; margin-bottom: 0; padding-bottom: 15px; border-bottom: 1px solid #eee; text-transform: uppercase; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
    .credits-summary { font-size: 13px; font-weight: 600; color: #555; text-transform: none; }
    .upgrade-block { text-align: center; padding: 50px 20px 30px; }
    .upgrade-block p { color: #555; margin-bottom: 20px; }
    .btn-upgrade { display: inline-block; background: #1f9d76; color: #fff; padding: 13px 35px; border-radius: 7px; font-weight: 700; text-decoration: none; letter-spacing: .03em; }
    .btn-upgrade:hover { background: #167a5c; color: #fff; }
    .insta-empty { text-align: center; color: #888; padding: 30px 0; }
    .insta-item { padding: 16px 0; border-bottom: 1px solid #eee; }
    .insta-item:last-child { border-bottom: none; }
    .insta-item-name { font-weight: 700; color: #222; }
    .insta-item-company { color: #666; font-size: 13px; }
    .insta-item-meta { font-size: 13px; color: #555; margin-top: 6px; }
    .insta-item-meta span { display: inline-flex; align-items: center; gap: 5px; margin-right: 18px; }
    .insta-item-comment { font-size: 13px; color: #444; margin-top: 8px; font-style: italic; }
    .insta-item-time { font-size: 12px; color: #999; margin-top: 6px; }
    .blurred { filter: blur(4px); user-select: none; }
    .btn-reveal { border: none; background: #1f4e79; color: #fff; padding: 6px 16px; border-radius: 6px; font-size: 12px; font-weight: 700; cursor: pointer; margin-top: 8px; }
    .btn-reveal:disabled { opacity: .6; cursor: not-allowed; }
</style>

<div class="col-lg-8 col-md-8 dashboard-main-content">
    <div class="main-content">
        <h5 class="page-title">
            <span>Insta Response</span>
            <span class="credits-summary" id="creditsSummary">Total Credits: 0, Revealed Credits: 0</span>
        </h5>

        <div id="upgradeBlock" class="upgrade-block" style="display:none;">
            <p>You don't have any insta credits. Please upgrade account to reveal insta contacts.</p>
            <a href="{{ route('pricing.listing') }}" class="btn-upgrade">UPGRADE ACCOUNT</a>
        </div>

        <div id="instaList"></div>
        <div id="instaEmpty" class="insta-empty" style="display:none;">No Instant Response Found!</div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    let totalCredits = 0;
    let revealedCount = 0;

    async function postJson(url) {
        const response = await fetch(url, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        });
        return response.json();
    }

    function escapeHtml(value) {
        const div = document.createElement('div');
        div.textContent = value ?? '';
        return div.innerHTML;
    }

    async function loadCredits() {
        const data = await postJson(@json(route('instaresponse.count')));
        totalCredits = data.total || 0;
        revealedCount = data.count || 0;
        document.getElementById('creditsSummary').textContent = 'Total Credits: ' + totalCredits + ', Revealed Credits: ' + revealedCount;
        document.getElementById('upgradeBlock').style.display = totalCredits > 0 ? 'none' : 'block';
    }

    async function loadList() {
        const listEl = document.getElementById('instaList');
        const emptyEl = document.getElementById('instaEmpty');
        listEl.innerHTML = '';

        const response = await fetch(@json(route('instaresponse.list')), {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        });
        const data = await response.json();

        if (!Array.isArray(data) || data.length === 0) {
            emptyEl.style.display = 'block';
            return;
        }
        emptyEl.style.display = 'none';

        data.forEach(function (item) {
            const isViewed = Number(item.contact_viewed) === 1;
            const canReveal = !isViewed && revealedCount < totalCredits;

            const row = document.createElement('div');
            row.className = 'insta-item';
            row.innerHTML = `
                <div class="insta-item-name">${escapeHtml(item.contact_name)}</div>
                ${item.contact_company ? '<div class="insta-item-company">' + escapeHtml(item.contact_company) + '</div>' : ''}
                <div class="insta-item-meta ${isViewed ? '' : 'blurred'}">
                    <span><i class="fas fa-phone"></i> ${escapeHtml(item.contact_mobile)}</span>
                    <span><i class="fas fa-envelope"></i> ${escapeHtml(item.contact_email)}</span>
                    ${item.contact_investment ? '<span>' + escapeHtml(String(item.contact_investment)) + '</span>' : ''}
                </div>
                ${item.contact_comment ? '<div class="insta-item-comment">"' + escapeHtml(item.contact_comment) + '"</div>' : ''}
                <div class="insta-item-time">${escapeHtml(item.created_at)}</div>
                ${!isViewed ? '<button type="button" class="btn-reveal" data-contact-id="' + item.contact_id + '" ' + (canReveal ? '' : 'disabled') + '>' + (canReveal ? 'Reveal Contact' : 'No Credits Left') + '</button>' : ''}
            `;
            listEl.appendChild(row);
        });

        listEl.querySelectorAll('.btn-reveal').forEach(function (btn) {
            btn.addEventListener('click', async function () {
                if (this.disabled) return;
                const contactId = this.dataset.contactId;
                this.disabled = true;
                this.textContent = 'Revealing...';
                try {
                    const formData = new FormData();
                    formData.append('contact_id', contactId);
                    await fetch(@json(route('instaresponse.view-update')), {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                        body: formData
                    });
                    await loadCredits();
                    await loadList();
                } catch (error) {
                    console.error('Reveal failed:', error);
                    this.disabled = false;
                    this.textContent = 'Reveal Contact';
                }
            });
        });
    }

    (async function init() {
        await loadCredits();
        await loadList();
    })();
});
</script>
@endpush
