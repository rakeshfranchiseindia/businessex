@extends('account_dashboard.accountDashboardApp')

@section('title', 'My Account')

@section('content')
@include('account_dashboard.dashboardSidebar')

<style>
    .main-content { background: #fff; border-radius: 12px; padding: 25px; margin-bottom: 30px; box-shadow: 0 3px 15px rgba(0,0,0,0.06); }
    .page-title { font-size: 20px; font-weight: 700; color: #222; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #eee; }
    #ajaxAlert { display: none; margin-bottom: 20px; padding: 12px 16px; border-radius: 7px; font-size: 14px; }
    .custom-tabs { display: flex; flex-wrap: wrap; gap: 5px; border-bottom: 1px solid #ddd; margin-bottom: 25px; padding-left: 0; list-style: none; }
    .custom-tabs .nav-item { margin-bottom: -1px; }
    .custom-tabs .nav-link { border: none; background: #f5f6f8; color: #555; font-size: 14px; font-weight: 600; padding: 13px 20px; border-radius: 7px 7px 0 0; cursor: pointer; transition: all .25s ease; text-decoration: none; display: block; }
    .custom-tabs .nav-link:hover { background: #e9ecef; color: #222; }
    .custom-tabs .nav-link.active { background: #1f4e79; color: #fff; }
    .tab-content { display: none; }
    .tab-content.active { display: block; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-size: 14px; font-weight: 600; color: #333; margin-bottom: 8px; }
    .form-control { width: 100%; min-height: 44px; border: 1px solid #dcdfe3; border-radius: 7px; padding: 10px 13px; font-size: 14px; transition: border-color .2s, box-shadow .2s; }
    .form-control:focus { border-color: #1f4e79; box-shadow: 0 0 0 3px rgba(31,78,121,.10); outline: none; }
    textarea.form-control { min-height: 110px; resize: vertical; }
    .file-upload-area { border: 2px dashed #d5d9de; border-radius: 10px; padding: 20px; background: #fafbfc; }
    .profile-preview { min-height: 160px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; }
    .profile-preview img { width: 150px; height: 150px; object-fit: cover; border-radius: 10px; border: 1px solid #ddd; }
    #noProfileImage { color: #999; font-size: 14px; }
    .accepted-formats { font-size: 12px; color: #888; margin-bottom: 12px; text-align: center; }
    .browse-area { display: flex; justify-content: center; align-items: center; gap: 12px; flex-wrap: wrap; }
    .file-upload-btn { border: none; background: #1f4e79; color: #fff; padding: 9px 20px; border-radius: 6px; cursor: pointer; font-size: 13px; }
    #fileName { font-size: 13px; color: #666; }
    .tags-container { display: flex; align-items: center; flex-wrap: wrap; gap: 7px; padding: 8px; min-height: 48px; border: 1px solid #ddd; border-radius: 7px; }
    .tag-item { display: inline-flex; align-items: center; gap: 8px; background: #e9f1f8; color: #1f4e79; padding: 6px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }
    .remove-tag { cursor: pointer; font-size: 16px; line-height: 1; }
    .tags-input { flex: 1; min-width: 180px; border: none !important; box-shadow: none !important; outline: none !important; }
    .sector-search-wrapper { position: relative; width: 100%; }
    .sector-dropdown { position: absolute; top: 100%; left: 0; right: 0; background: #fff; border: 1px solid #ddd; border-radius: 7px; margin-top: 4px; max-height: 220px; overflow-y: auto; z-index: 9999; display: none; box-shadow: 0 4px 12px rgba(0,0,0,0.10); }
    .sector-dropdown-item { padding: 10px 13px; font-size: 14px; color: #333; cursor: pointer; border-bottom: 1px solid #f1f1f1; }
    .sector-dropdown-item:last-child { border-bottom: none; }
    .sector-dropdown-item:hover { background: #f5f8fb; color: #1f4e79; }
    .sector-dropdown-empty { padding: 10px 13px; font-size: 13px; color: #999; }
    .experience-row { display: flex; gap: 10px; margin-bottom: 10px; align-items: center; flex-wrap: wrap; }
    .experience-row select { flex: 1; min-width: 140px; }
    .experience-row .exp-year { max-width: 110px; flex: 0 0 110px; }
    .remove-exp-row { cursor: pointer; font-size: 20px; line-height: 1; color: #c0392b; padding: 0 6px; }
    .btn-submit { min-width: 130px; border: none; background: #1f4e79; color: #fff; padding: 11px 25px; border-radius: 7px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all .2s ease; }
    .btn-submit:hover { background: #163a5c; }
    .btn-submit:disabled { opacity: .65; cursor: not-allowed; }
    @media(max-width: 767px) {
        .main-content { padding: 15px; }
        .custom-tabs { display: grid; grid-template-columns: 1fr 1fr; }
        .custom-tabs .nav-link { text-align: center; padding: 11px 8px; font-size: 12px; }
    }
</style>

<div class="col-lg-8 col-md-8 dashboard-main-content">
    <div class="main-content">
        <h5 class="page-title">MANAGE MENTOR INFORMATION</h5>
        <div id="ajaxAlert"></div>

        <ul class="nav custom-tabs" id="confidentialTabs">
            <li class="nav-item"><a href="#" class="nav-link active" data-tab="conf-tab1"><i class="fas fa-user-secret me-1"></i> Confidential Information</a></li>
            <li class="nav-item"><a href="#" class="nav-link" data-tab="conf-tab2"><i class="fas fa-bullhorn me-1"></i> Advertisement Details</a></li>
            <li class="nav-item"><a href="#" class="nav-link" data-tab="conf-tab3"><i class="fas fa-user me-1"></i> Profile Information</a></li>
            <li class="nav-item"><a href="#" class="nav-link" data-tab="conf-tab4"><i class="fas fa-sliders-h me-1"></i> Preferences</a></li>
        </ul>

        {{-- TAB 1 : CONFIDENTIAL INFORMATION --}}
        <div id="conf-tab1" class="tab-content active">
            <form action="{{ route('mentor.confidential.ajax.update', $user_rand_id) }}" method="POST" id="confidentialForm">
                @csrf
                <div class="form-group">
                    <label>Your Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ $mentor->mentor_name ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Mobile Number <span class="text-danger">*</span></label>
                    <input type="tel" name="mobile" class="form-control" value="{{ $mentor->mentor_mobile ?? '' }}" pattern="[0-9]{10}" maxlength="10" inputmode="numeric" title="Enter a 10-digit mobile number" required>
                </div>
                <div class="form-group">
                    <label>Email ID <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ $mentor->mentor_email ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Location <span class="text-danger">*</span></label>
                    <input type="text" name="location" class="form-control" value="{{ $mentor->mentor_location ?? '' }}" required>
                </div>
                <button type="submit" class="btn-submit">SAVE CHANGES</button>
            </form>
        </div>

        {{-- TAB 2 : ADVERTISEMENT DETAILS --}}
        <div id="conf-tab2" class="tab-content">
            <form action="{{ route('mentor.advertisement.ajax.update', $user_rand_id) }}" method="POST" id="advertisementForm">
                @csrf
                <div class="form-group">
                    <label>Advertisement Headline <span class="text-danger">*</span></label>
                    <input type="text" id="mentor_adv_headline" name="mentor_adv_headline" class="form-control" value="{{ $mentor->mentor_adv_headline ?? '' }}" placeholder="Enter Advertisement Headline" required>
                </div>
                <div class="form-group">
                    <label>Introduction</label>
                    <textarea id="mentor_intro" name="mentor_intro" class="form-control" rows="5" placeholder="Enter introduction details here...">{{ $mentor->mentor_intro ?? '' }}</textarea>
                </div>
                <button type="submit" class="btn-submit">SAVE CHANGES</button>
            </form>
        </div>

        {{-- TAB 3 : PROFILE INFORMATION (FOR MENTOR) --}}
        <div id="conf-tab3" class="tab-content">
            <form action="{{ route('mentor.profile.ajax.update', $user_rand_id) }}" method="POST" enctype="multipart/form-data" id="mentorProfileForm">
                @csrf
                <div class="form-group">
                    <label>Occupation <span class="text-danger">*</span></label>
                    <select name="mentor_occupation" id="mentor_occupation" class="form-control" required>
                        <option value="">Select Occupation</option>
                        @foreach(config('constants.mentorOccupation', []) as $key => $label)
                            <option value="{{ $key }}" {{ ($mentor->mentor_occupation ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Company / Institute <span class="text-danger">*</span></label>
                    <input type="text" name="mentor_company" id="mentor_company" class="form-control" value="{{ $mentor->mentor_company ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Designation / Title <span class="text-danger">*</span></label>
                    <input type="text" name="mentor_designation" id="mentor_designation" class="form-control" value="{{ $mentor->mentor_designation ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Professional Summary <span class="text-danger">*</span></label>
                    <textarea name="mentor_profile_summary" id="mentor_profile_summary" class="form-control" rows="4" required>{{ $mentor->mentor_profile_summary ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>Upload Image</label>
                    <div class="file-upload-area">
                        <div id="profilePreview" class="profile-preview">
                            @if(!empty($mentor->mentor_profile_pic) && file_exists(public_path($mentor->mentor_profile_pic)))
                                <img src="{{ asset($mentor->mentor_profile_pic) }}" id="currentProfileImage" alt="Profile Picture">
                            @else
                                <div id="noProfileImage">No profile picture uploaded</div>
                            @endif
                        </div>
                        <div class="accepted-formats">Accepted formats: PNG, JPG, JPEG, GIF</div>
                        <div class="browse-area">
                            <button type="button" class="file-upload-btn" id="browseProfileImage">Browse</button>
                            <span id="fileName">No file chosen</span>
                            <input type="file" name="mentor_profile_pic" id="profileImage" accept=".png,.jpg,.jpeg,.gif" style="display:none;">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>LinkedIn Profile</label>
                    <input type="url" name="mentor_linkedin" id="mentor_linkedin" class="form-control" placeholder="https://linkedin.com/in/..." value="{{ $mentor->mentor_linkedin ?? '' }}">
                </div>
                <button type="submit" class="btn-submit">SAVE CHANGES</button>
            </form>
        </div>

        {{-- TAB 4 : PREFERENCES --}}
        <div id="conf-tab4" class="tab-content">
            <form action="{{ route('mentor.preferences.ajax.update', $user_rand_id) }}" method="POST" id="preferencesForm">
                @csrf

                <div class="form-group">
                    <label>Subject Expertise <span class="text-danger">*</span></label>
                    <div class="sector-search-wrapper">
                        <div class="tags-container" id="expertiseTagsContainer">
                            @foreach($expertisePref as $item)
                                <span class="tag-item" data-tag="{{ $item->name }}"><span>{{ $item->name }}</span><span class="remove-tag">&times;</span></span>
                            @endforeach
                            <input type="text" class="tags-input" id="expertiseTagsInput" placeholder="Search expertise..." autocomplete="off">
                            <input type="hidden" name="expertise" id="expertise" value="{{ $expertisePref->pluck('name')->implode(',') }}">
                        </div>
                        <div id="expertiseDropdown" class="sector-dropdown"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Sector Preference <span class="text-danger">*</span></label>
                    <div class="sector-search-wrapper">
                        <div class="tags-container" id="tagsContainer">
                            @foreach($indPref as $item)
                                <span class="tag-item" data-tag="{{ $item->name }}"><span>{{ $item->name }}</span><span class="remove-tag">&times;</span></span>
                            @endforeach
                            <input type="text" class="tags-input" id="tagsInput" placeholder="Search sector..." autocomplete="off">
                            <input type="hidden" name="sectors" id="sectors" value="{{ $indPref->pluck('name')->implode(',') }}">
                        </div>
                        <div id="sectorDropdown" class="sector-dropdown"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Professional Experience <span class="text-danger">*</span></label>
                    <div id="experienceRows">
                        @forelse($experience as $row)
                            <div class="experience-row">
                                <select class="form-control exp-year" name="exp_years[]">
                                    @for($y = 1; $y <= 30; $y++)
                                        <option value="{{ $y }}" {{ $row->exp_year == $y ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>
                                <select class="form-control exp-sector" name="exp_sectors[]">
                                    <option value="">Select Sector</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->cat_id }}" {{ $row->sector_id == $cat->cat_id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                                <span class="remove-exp-row" title="Remove">&times;</span>
                            </div>
                        @empty
                            <div class="experience-row">
                                <select class="form-control exp-year" name="exp_years[]">
                                    @for($y = 1; $y <= 30; $y++)
                                        <option value="{{ $y }}">{{ $y }}</option>
                                    @endfor
                                </select>
                                <select class="form-control exp-sector" name="exp_sectors[]">
                                    <option value="">Select Sector</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->cat_id }}">{{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                                <span class="remove-exp-row" title="Remove">&times;</span>
                            </div>
                        @endforelse
                    </div>
                    <button type="button" class="file-upload-btn" id="addExperienceRow" style="{{ $experience->count() >= 2 ? 'display:none;' : '' }}">+ Add Experience</button>
                </div>

                <button type="submit" class="btn-submit">SAVE CHANGES</button>
            </form>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const assetBaseUrl = @json(asset(''));
    const categoryList = @json($categories->map(function ($c) { return ['id' => $c->cat_id, 'name' => $c->category_name]; })->values());
    const MAX_EXPERIENCE_ROWS = 2;

    function showMessage(message, type = 'success') {
        const box = document.getElementById('ajaxAlert');
        if (!box) return;
        box.style.display = 'block';
        box.style.background = type === 'success' ? '#e9f8ef' : '#fff0f0';
        box.style.color = type === 'success' ? '#198754' : '#dc3545';
        box.style.border = type === 'success' ? '1px solid #b7e4c7' : '1px solid #f1b0b7';
        box.innerHTML = message;
        clearTimeout(window.ajaxMessageTimer);
        window.ajaxMessageTimer = setTimeout(function () { box.style.display = 'none'; }, 4000);
    }

    function escapeHtml(value) {
        const div = document.createElement('div');
        div.textContent = value ?? '';
        return div.innerHTML;
    }

    function showValidationErrors(errors) {
        let html = '<ul style="margin:0;padding-left:20px;">';
        Object.keys(errors || {}).forEach(function (field) {
            (errors[field] || []).forEach(function (message) { html += '<li>' + escapeHtml(message) + '</li>'; });
        });
        html += '</ul>';
        showMessage(html, 'danger');
    }

    function setButtonLoading(button, loading) {
        if (!button) return;
        if (loading) {
            button.dataset.oldText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = 'Saving...';
        } else {
            button.disabled = false;
            button.innerHTML = button.dataset.oldText || 'SAVE CHANGES';
        }
    }

    async function submitForm(form, url, button) {
        setButtonLoading(button, true);
        try {
            const formData = new FormData(form);
            const response = await fetch(url, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: formData
            });
            const data = await response.json();
            if (response.status === 422) { showValidationErrors(data.errors); return null; }
            if (!response.ok || !data.status) { showMessage(data.message || 'Something went wrong.', 'danger'); return null; }
            showMessage(data.message || 'Saved successfully.', 'success');
            return data;
        } catch (error) {
            console.error('AJAX ERROR:', error);
            showMessage('Server error. Please try again.', 'danger');
            return null;
        } finally {
            setButtonLoading(button, false);
        }
    }

    async function getData(url) {
        try {
            const response = await fetch(url, { method: 'GET', headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } });
            const data = await response.json();
            if (!response.ok || !data.status) throw new Error(data.message || 'Unable to load data.');
            return data;
        } catch (error) {
            console.error('GET ERROR:', error);
            return null;
        }
    }

    const tabLinks = document.querySelectorAll('#confidentialTabs .nav-link');
    const tabContents = document.querySelectorAll('.tab-content');

    function activateTab(tabId) {
        tabContents.forEach(function (content) { content.classList.remove('active'); content.style.display = 'none'; });
        tabLinks.forEach(function (link) { link.classList.remove('active'); });
        const selectedContent = document.getElementById(tabId);
        const selectedLink = document.querySelector('#confidentialTabs .nav-link[data-tab="' + tabId + '"]');
        if (selectedContent) { selectedContent.classList.add('active'); selectedContent.style.display = 'block'; }
        if (selectedLink) selectedLink.classList.add('active');
    }

    tabLinks.forEach(function (link) {
        link.addEventListener('click', async function (event) {
            event.preventDefault();
            const tabId = this.getAttribute('data-tab');
            if (!tabId) return;
            activateTab(tabId);
            if (tabId === 'conf-tab1') await loadConfidential();
            if (tabId === 'conf-tab2') await loadAdvertisement();
            if (tabId === 'conf-tab3') await loadProfile();
            if (tabId === 'conf-tab4') await loadPreferences();
        });
    });

    const urls = {
        confidentialGet: @json(route('mentor.confidential.ajax.get', $user_rand_id)),
        confidentialUpdate: @json(route('mentor.confidential.ajax.update', $user_rand_id)),
        advertisementGet: @json(route('mentor.advertisement.ajax.get', $user_rand_id)),
        advertisementUpdate: @json(route('mentor.advertisement.ajax.update', $user_rand_id)),
        profileGet: @json(route('mentor.profile.ajax.get', $user_rand_id)),
        profileUpdate: @json(route('mentor.profile.ajax.update', $user_rand_id)),
        preferencesGet: @json(route('mentor.preferences.ajax.get', $user_rand_id)),
        preferencesUpdate: @json(route('mentor.preferences.ajax.update', $user_rand_id)),
        sectorSearch: @json(route('preferences.ajax.sectors')),
        expertiseSearch: @json(route('mentor.categories.ajax.search'))
    };

    async function loadConfidential() {
        const data = await getData(urls.confidentialGet);
        if (!data) return;
        const info = data.data || {};
        const form = document.getElementById('confidentialForm');
        if (!form) return;
        form.elements.name.value = info.name || '';
        form.elements.mobile.value = info.mobile || '';
        form.elements.email.value = info.email || '';
        form.elements.location.value = info.location || '';
    }

    async function loadAdvertisement() {
        const data = await getData(urls.advertisementGet);
        if (!data) return;
        const info = data.data || {};
        const headline = document.getElementById('mentor_adv_headline');
        const intro = document.getElementById('mentor_intro');
        if (headline) headline.value = info.mentor_adv_headline || '';
        if (intro) intro.value = info.mentor_intro || '';
    }

    function updateProfileImage(path) {
        const preview = document.getElementById('profilePreview');
        if (!preview || !path) return;
        preview.innerHTML = '<img src="' + escapeHtml(assetBaseUrl + path) + '?t=' + Date.now() + '" id="currentProfileImage" alt="Profile Picture">';
    }

    async function loadProfile() {
        const data = await getData(urls.profileGet);
        if (!data) return;
        const info = data.data || {};
        setValue('mentor_occupation', info.mentor_occupation);
        setValue('mentor_company', info.mentor_company);
        setValue('mentor_designation', info.mentor_designation);
        setValue('mentor_profile_summary', info.mentor_profile_summary);
        setValue('mentor_linkedin', info.mentor_linkedin);
        if (info.mentor_profile_pic) updateProfileImage(info.mentor_profile_pic);
    }

    function setValue(id, value) {
        const element = document.getElementById(id);
        if (element) element.value = value ?? '';
    }

    function updateAddButtonVisibility() {
        const addBtn = document.getElementById('addExperienceRow');
        if (!addBtn) return;
        const count = document.querySelectorAll('.experience-row').length;
        addBtn.style.display = count >= MAX_EXPERIENCE_ROWS ? 'none' : '';
    }

    function addExperienceRow(year, sectorId) {
        const container = document.getElementById('experienceRows');
        if (!container) return;
        if (document.querySelectorAll('.experience-row').length >= MAX_EXPERIENCE_ROWS) return;

        const row = document.createElement('div');
        row.className = 'experience-row';

        const yearSelect = document.createElement('select');
        yearSelect.className = 'form-control exp-year';
        yearSelect.name = 'exp_years[]';
        for (let y = 1; y <= 30; y++) {
            const opt = document.createElement('option');
            opt.value = y;
            opt.textContent = y;
            if (Number(year) === y) opt.selected = true;
            yearSelect.appendChild(opt);
        }

        const sectorSelect = document.createElement('select');
        sectorSelect.className = 'form-control exp-sector';
        sectorSelect.name = 'exp_sectors[]';
        const blankOption = document.createElement('option');
        blankOption.value = '';
        blankOption.textContent = 'Select Sector';
        sectorSelect.appendChild(blankOption);
        categoryList.forEach(function (cat) {
            const opt = document.createElement('option');
            opt.value = cat.id;
            opt.textContent = cat.name;
            sectorSelect.appendChild(opt);
        });
        sectorSelect.value = sectorId || '';

        const remove = document.createElement('span');
        remove.className = 'remove-exp-row';
        remove.title = 'Remove';
        remove.innerHTML = '&times;';
        remove.addEventListener('click', function () {
            if (document.querySelectorAll('.experience-row').length > 1) {
                row.remove();
                updateAddButtonVisibility();
            }
        });

        row.appendChild(yearSelect);
        row.appendChild(sectorSelect);
        row.appendChild(remove);
        container.appendChild(row);
        updateAddButtonVisibility();
    }

    document.querySelectorAll('.remove-exp-row').forEach(function (btn) {
        btn.addEventListener('click', function () {
            if (document.querySelectorAll('.experience-row').length > 1) {
                btn.closest('.experience-row').remove();
                updateAddButtonVisibility();
            }
        });
    });
    updateAddButtonVisibility();

    const addExperienceBtn = document.getElementById('addExperienceRow');
    if (addExperienceBtn) addExperienceBtn.addEventListener('click', function () { addExperienceRow(1, ''); });

    async function loadPreferences() {
        const data = await getData(urls.preferencesGet);
        if (!data) return;
        const industries = data.data?.industries || [];
        const expertise = data.data?.expertise || [];
        const experience = data.data?.experience || [];

        fillTags('tagsContainer', 'tagsInput', 'sectors', industries.map(function (i) { return i.name; }));
        fillTags('expertiseTagsContainer', 'expertiseTagsInput', 'expertise', expertise.map(function (i) { return i.name; }));

        const container = document.getElementById('experienceRows');
        if (container) {
            container.innerHTML = '';
            if (experience.length) {
                experience.forEach(function (row) { addExperienceRow(row.exp_year, row.sector_id); });
            } else {
                addExperienceRow(1, '');
            }
        }
    }

    function fillTags(containerId, inputId, hiddenId, values) {
        const container = document.getElementById(containerId);
        const input = document.getElementById(inputId);
        const hidden = document.getElementById(hiddenId);
        if (!container || !input || !hidden) return;
        container.querySelectorAll('.tag-item').forEach(function (tag) { tag.remove(); });
        hidden.value = '';
        values.forEach(function (name) { addTag(containerId, inputId, hiddenId, name); });
    }

    function addTag(containerId, inputId, hiddenId, text) {
        text = String(text || '').trim();
        if (!text) return;
        const container = document.getElementById(containerId);
        const input = document.getElementById(inputId);
        const hidden = document.getElementById(hiddenId);
        if (!container || !input || !hidden) return;

        let values = hidden.value ? hidden.value.split(',').map(function (v) { return v.trim(); }).filter(Boolean) : [];
        if (values.some(function (v) { return v.toLowerCase() === text.toLowerCase(); })) return;
        values.push(text);
        hidden.value = values.join(',');

        const tag = document.createElement('span');
        tag.className = 'tag-item';
        const nameSpan = document.createElement('span');
        nameSpan.textContent = text;
        const removeSpan = document.createElement('span');
        removeSpan.className = 'remove-tag';
        removeSpan.innerHTML = '&times;';
        tag.appendChild(nameSpan);
        tag.appendChild(removeSpan);
        container.insertBefore(tag, input);

        removeSpan.addEventListener('click', function () {
            let current = hidden.value.split(',').map(function (v) { return v.trim(); }).filter(Boolean);
            current = current.filter(function (v) { return v !== text; });
            hidden.value = current.join(',');
            tag.remove();
        });
    }

    function setupSectorSearch(inputId, dropdownId, containerId, hiddenId, searchUrl) {
        const input = document.getElementById(inputId);
        const dropdown = document.getElementById(dropdownId);
        let timer = null;

        function hide() { if (dropdown) { dropdown.style.display = 'none'; dropdown.innerHTML = ''; } }
        function show() { if (dropdown) dropdown.style.display = 'block'; }

        async function search(text) {
            if (!dropdown) return;
            text = String(text || '').trim();
            if (!text) { hide(); return; }
            dropdown.innerHTML = '<div class="sector-dropdown-empty">Searching...</div>';
            show();
            try {
                const response = await fetch(searchUrl + '?search=' + encodeURIComponent(text), {
                    method: 'GET', headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                });
                if (!response.ok) throw new Error('Search failed.');
                const data = await response.json();
                const categories = data.data || [];
                const hidden = document.getElementById(hiddenId);
                const selected = hidden && hidden.value ? hidden.value.split(',').map(function (v) { return v.trim().toLowerCase(); }).filter(Boolean) : [];
                dropdown.innerHTML = '';
                categories.forEach(function (category) {
                    const name = String(category.name || '').trim();
                    if (!name || selected.includes(name.toLowerCase())) return;
                    const item = document.createElement('div');
                    item.className = 'sector-dropdown-item';
                    item.textContent = name;
                    item.addEventListener('click', function () {
                        addTag(containerId, inputId, hiddenId, name);
                        input.value = '';
                        hide();
                        input.focus();
                    });
                    dropdown.appendChild(item);
                });
                if (!dropdown.children.length) dropdown.innerHTML = '<div class="sector-dropdown-empty">No matching sector found</div>';
                show();
            } catch (error) {
                console.error('SECTOR SEARCH ERROR:', error);
                dropdown.innerHTML = '<div class="sector-dropdown-empty">Unable to search sectors</div>';
                show();
            }
        }

        if (input) {
            input.addEventListener('input', function () {
                clearTimeout(timer);
                const value = this.value.trim();
                if (!value) { hide(); return; }
                timer = setTimeout(function () { search(value); }, 300);
            });
            input.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') { hide(); return; }
                if (event.key === 'Enter') {
                    event.preventDefault();
                    const value = this.value.trim();
                    if (value) search(value);
                }
            });
        }

        document.addEventListener('click', function (event) {
            if (input && dropdown && !input.contains(event.target) && !dropdown.contains(event.target)) hide();
        });
    }

    setupSectorSearch('tagsInput', 'sectorDropdown', 'tagsContainer', 'sectors', urls.sectorSearch);
    setupSectorSearch('expertiseTagsInput', 'expertiseDropdown', 'expertiseTagsContainer', 'expertise', urls.expertiseSearch);

    const browseButton = document.getElementById('browseProfileImage');
    const profileImage = document.getElementById('profileImage');
    if (browseButton && profileImage) {
        browseButton.addEventListener('click', function () { profileImage.click(); });
        profileImage.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            const fileName = document.getElementById('fileName');
            if (fileName) fileName.textContent = file.name;
            const reader = new FileReader();
            reader.onload = function (event) {
                const preview = document.getElementById('profilePreview');
                if (!preview) return;
                preview.innerHTML = '<img src="' + event.target.result + '" style="width:150px;height:150px;object-fit:cover;border-radius:10px;" alt="Profile Picture">';
            };
            reader.readAsDataURL(file);
        });
    }

    const confidentialForm = document.getElementById('confidentialForm');
    if (confidentialForm) {
        confidentialForm.addEventListener('submit', async function (event) {
            event.preventDefault();
            const button = this.querySelector('button[type="submit"]');
            const result = await submitForm(this, urls.confidentialUpdate, button);
            if (result) { await loadConfidential(); activateTab('conf-tab1'); }
        });
    }

    const advertisementForm = document.getElementById('advertisementForm');
    if (advertisementForm) {
        advertisementForm.addEventListener('submit', async function (event) {
            event.preventDefault();
            const button = this.querySelector('button[type="submit"]');
            const result = await submitForm(this, urls.advertisementUpdate, button);
            if (result) { await loadAdvertisement(); activateTab('conf-tab2'); }
        });
    }

    const mentorProfileForm = document.getElementById('mentorProfileForm');
    if (mentorProfileForm) {
        mentorProfileForm.addEventListener('submit', async function (event) {
            event.preventDefault();
            const button = this.querySelector('button[type="submit"]');
            const result = await submitForm(this, urls.profileUpdate, button);
            if (result) {
                await loadProfile();
                activateTab('conf-tab3');
                if (result.data && result.data.mentor_profile_pic) updateProfileImage(result.data.mentor_profile_pic);
            }
        });
    }

    const preferencesForm = document.getElementById('preferencesForm');
    if (preferencesForm) {
        preferencesForm.addEventListener('submit', async function (event) {
            event.preventDefault();
            const button = this.querySelector('button[type="submit"]');
            const result = await submitForm(this, urls.preferencesUpdate, button);
            if (result) { await loadPreferences(); activateTab('conf-tab4'); }
        });
    }

    activateTab('conf-tab1');
    loadConfidential();
});
</script>
@endpush
