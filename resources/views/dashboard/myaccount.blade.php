@extends('layouts.app')
<?php
use Illuminate\Support\Facades\Auth;
?>
@section('title', 'My Account')

@section('content')
    <div class="container-fluid" style="padding-top: 100px;">
        <div class="row">
            <!-- Sidebar -->
           @include('account_dashboard.dashboardSidebar')

            <!-- Main Content -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">My Profiles <small class="text-muted">(Create | Edit)</small></h5>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-3" id="myProfilesTabs">
                            <li class="nav-item"><a class="nav-link active" href="#" data-mp-tab="new-listings">New Listings</a></li>
                            <li class="nav-item"><a class="nav-link" href="#" data-mp-tab="saved-searches">Saved Searches</a></li>
                            <li class="nav-item"><a class="nav-link" href="#" data-mp-tab="search-history">Search History</a></li>
                        </ul>

                        <div id="myProfilesList">
                            <p class="text-muted small text-center py-3">Loading...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="mb-0">Top 5 Recommendations</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0" id="topRecommendationsList">
                            <li class="text-muted small text-center py-3">Loading recommendations...</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #topRecommendationsList .media img {
            object-fit: cover;
            height: 45px;
        }
        #topRecommendationsList .reco-badge {
            font-size: 10px;
            font-weight: 700;
            padding: 1px 6px;
            border-radius: 3px;
            margin-left: 6px;
            vertical-align: middle;
        }
        #topRecommendationsList .reco-badge.sponsored { background: #fff3cd; color: #8a6d00; }
        #topRecommendationsList .reco-badge.premium { background: #e7f1ff; color: #1f4e79; }
        #topRecommendationsList .reco-badge.gold { background: #fdf3d8; color: #a67c00; }
        #topRecommendationsList .reco-badge.platinum { background: #eaeaf7; color: #4b3f8f; }
    </style>

    <script>
        var membershipPlanLabels = { 1: 'Premium', 2: 'Gold', 3: 'Platinum' };
        var fallbackRecoImage = '{{ asset("assets/images/category/small/6.jpg") }}';

        function renderRecommendations(data) {
            var list = document.getElementById('topRecommendationsList');
            var items = (data && data.top5) ? data.top5 : [];

            if (!items.length) {
                list.innerHTML = '<li class="text-muted small text-center py-3">No recommendations available right now.</li>';
                return;
            }

            list.innerHTML = items.map(function (item, idx) {
                var planLabel = item.membership_paid ? (membershipPlanLabels[item.membership_plan] || '') : '';
                var badges = (item.isSponsored ? '<span class="reco-badge sponsored">FEATURED</span>' : '') +
                    (planLabel ? '<span class="reco-badge ' + planLabel.toLowerCase() + '">' + planLabel + '</span>' : '');
                var isLast = idx === items.length - 1;
                var title = item.title ? item.title.substring(0, 20) + (item.title.length > 20 ? '...' : '') : 'Untitled';
                var img = document.createElement('img');
                img.src = item.thumbimage;
                img.className = 'mr-3 rounded';
                img.width = 60;
                img.alt = 'Recommendation';
                img.onerror = function () { img.onerror = null; img.src = fallbackRecoImage; };

                var wrap = document.createElement('li');
                wrap.className = 'media' + (isLast ? '' : ' mb-3');

                var link = document.createElement('a');
                link.href = item.profileurl;
                link.className = 'text-dark';
                link.innerHTML = '<strong>' + title + '</strong>' + badges;

                var body = document.createElement('div');
                body.className = 'media-body';
                body.appendChild(link);
                body.appendChild(document.createElement('br'));
                var priceSpan = document.createElement('span');
                priceSpan.className = 'text-muted';
                priceSpan.textContent = item.price + (item.priceLabel ? ' - ' + item.priceLabel : '');
                body.appendChild(priceSpan);

                wrap.appendChild(img);
                wrap.appendChild(body);
                return wrap.outerHTML;
            }).join('');
        }

        function fetchRecommendations(profileType) {
            var list = document.getElementById('topRecommendationsList');
            list.innerHTML = '<li class="text-muted small text-center py-3">Loading recommendations...</li>';

            fetch('{{ url("/dashboard/recommendations") }}/' + profileType, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(function (res) { return res.json(); })
                .then(renderRecommendations)
                .catch(function () {
                    list.innerHTML = '<li class="text-muted small text-center py-3">Could not load recommendations.</li>';
                });
        }

        // Registered so changeProfileType() (public/assets/js/user_main.js) updates
        // this widget in place instead of doing its normal full-page navigation --
        // this is the "no reload on profile type switch" behaviour for this page only.
        window.__handleProfileTypeChange = function (value) {
            fetch('{{ url("/set-profile-type") }}/' + value, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(function () { fetchRecommendations(value); })
                .catch(function () { fetchRecommendations(value); });
        };

        document.addEventListener('DOMContentLoaded', function () {
            fetchRecommendations('{{ session("profile_type", "investor") }}');
        });
    </script>

    <script>
        var myProfilesRoutes = {
            'new-listings': '{{ url("/dashboard/myprofiles/new-listings") }}',
            'saved-searches': '{{ url("/dashboard/myprofiles/saved-searches") }}',
            'search-history': '{{ url("/dashboard/myprofiles/search-history") }}'
        };
        var myProfilesEmptyText = {
            'new-listings': 'No new listings right now.',
            'saved-searches': 'No saved searches yet.',
            'search-history': 'No profiles viewed yet.'
        };

        function renderMyProfilesList(tab, data) {
            var container = document.getElementById('myProfilesList');
            var items = (data && data.listings) ? data.listings : [];

            if (!items.length) {
                container.innerHTML = '<p class="text-muted small text-center py-3">' + myProfilesEmptyText[tab] + '</p>';
                return;
            }

            container.innerHTML = items.map(function (item) {
                var priceLine = item.price
                    ? '<p><strong>' + item.price + '</strong>' + (item.priceLabel ? ' &mdash; ' + item.priceLabel : '') + '</p>'
                    : (item.investmentRange ? '<p><strong>' + item.investmentRange + '</strong> Investment Size</p>' : '');
                var img = document.createElement('img');
                img.src = item.thumbimage || '{{ asset("assets/images/category/small/6.jpg") }}';
                var imgHtml = '<img src="' + img.src + '" class="mr-3 rounded" width="100" alt="' + (item.profileTypeStr || 'Listing') + '" onerror="this.src=\'{{ asset("assets/images/category/small/6.jpg") }}\'">';
                return '' +
                    '<div class="media mb-4">' +
                        imgHtml +
                        '<div class="media-body">' +
                            '<span class="badge badge-secondary mb-1">' + (item.profileTypeStr || '') + '</span>' +
                            '<h6 class="mt-0">' + (item.title || 'Untitled') + '</h6>' +
                            '<p class="text-muted mb-1">' + (item.location || '') + '</p>' +
                            priceLine +
                            '<a href="' + (item.profileurl || '#') + '" class="btn btn-outline-success btn-sm">View Profile</a>' +
                        '</div>' +
                    '</div>';
            }).join('');
        }

        function loadMyProfilesTab(tab) {
            var container = document.getElementById('myProfilesList');
            container.innerHTML = '<p class="text-muted small text-center py-3">Loading...</p>';

            fetch(myProfilesRoutes[tab], { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(function (res) { return res.json(); })
                .then(function (data) { renderMyProfilesList(tab, data); })
                .catch(function () {
                    container.innerHTML = '<p class="text-muted small text-center py-3">Could not load this tab.</p>';
                });
        }

        document.addEventListener('DOMContentLoaded', function () {
            var tabLinks = document.querySelectorAll('#myProfilesTabs [data-mp-tab]');
            tabLinks.forEach(function (link) {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    tabLinks.forEach(function (l) { l.classList.remove('active'); });
                    this.classList.add('active');
                    loadMyProfilesTab(this.dataset.mpTab);
                });
            });

            loadMyProfilesTab('new-listings');
        });
    </script>
@endsection
