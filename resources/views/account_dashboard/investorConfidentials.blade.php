@extends('account_dashboard.accountDashboardApp')

@section('title', 'My Account')

@section('content')
@include('account_dashboard.dashboardSidebar')


<style>
    .main-content {
        background: #fff;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.06);
    }

    .page-title {
        font-size: 20px;
        font-weight: 700;
        color: #222;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    #ajaxAlert {
        display: none;
        margin-bottom: 20px;
        padding: 12px 16px;
        border-radius: 7px;
        font-size: 14px;
    }

    .custom-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        border-bottom: 1px solid #ddd;
        margin-bottom: 25px;
        padding-left: 0;
        list-style: none;
    }

    .custom-tabs .nav-item {
        margin-bottom: -1px;
    }

    .custom-tabs .nav-link {
        border: none;
        background: #f5f6f8;
        color: #555;
        font-size: 14px;
        font-weight: 600;
        padding: 13px 20px;
        border-radius: 7px 7px 0 0;
        cursor: pointer;
        transition: all .25s ease;
        text-decoration: none;
        display: block;
    }

    .custom-tabs .nav-link:hover {
        background: #e9ecef;
        color: #222;
    }

    .custom-tabs .nav-link.active {
        background: #1f4e79;
        color: #fff;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        min-height: 44px;
        border: 1px solid #dcdfe3;
        border-radius: 7px;
        padding: 10px 13px;
        font-size: 14px;
        transition: border-color .2s, box-shadow .2s;
    }

    .form-control:focus {
        border-color: #1f4e79;
        box-shadow: 0 0 0 3px rgba(31,78,121,.10);
        outline: none;
    }

    textarea.form-control {
        min-height: 110px;
        resize: vertical;
    }

    .form-section {
        margin-top: 25px;
        margin-bottom: 20px;
        padding: 14px 17px;
        background: #f7f9fb;
        border-left: 4px solid #1f4e79;
        border-radius: 5px;
    }

    .form-section h4 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #1f4e79;
    }

    .preference-checkboxes {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .checkbox-group {
        display: flex !important;
        align-items: center;
        gap: 8px;
        background: #f7f8fa;
        border: 1px solid #ddd;
        border-radius: 7px;
        padding: 10px 15px;
        cursor: pointer;
        margin: 0 !important;
        font-weight: 500 !important;
    }

    .checkbox-group input {
        width: 17px;
        height: 17px;
        cursor: pointer;
    }

    .file-upload-area {
        border: 2px dashed #d5d9de;
        border-radius: 10px;
        padding: 20px;
        background: #fafbfc;
    }

    .profile-preview {
        min-height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
    }

    .profile-preview img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #ddd;
    }

    #noProfileImage {
        color: #999;
        font-size: 14px;
    }

    .accepted-formats {
        font-size: 12px;
        color: #888;
        margin-bottom: 12px;
        text-align: center;
    }

    .browse-area {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .file-upload-btn {
        border: none;
        background: #1f4e79;
        color: #fff;
        padding: 9px 20px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 13px;
    }

    #fileName {
        font-size: 13px;
        color: #666;
    }

    .tags-container {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 7px;
        padding: 8px;
        min-height: 48px;
        border: 1px solid #ddd;
        border-radius: 7px;
    }

    .tag-item {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #e9f1f8;
        color: #1f4e79;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .remove-tag {
        cursor: pointer;
        font-size: 16px;
        line-height: 1;
    }

    .tags-input {
        flex: 1;
        min-width: 180px;
        border: none !important;
        box-shadow: none !important;
        outline: none !important;
    }

    /* Sector Search Dropdown */
    .sector-search-wrapper {
        position: relative;
        width: 100%;
    }

    .sector-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 7px;
        margin-top: 4px;
        max-height: 220px;
        overflow-y: auto;
        z-index: 9999;
        display: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.10);
    }

    .sector-dropdown-item {
        padding: 10px 13px;
        font-size: 14px;
        color: #333;
        cursor: pointer;
        border-bottom: 1px solid #f1f1f1;
    }

    .sector-dropdown-item:last-child {
        border-bottom: none;
    }

    .sector-dropdown-item:hover {
        background: #f5f8fb;
        color: #1f4e79;
    }

    .sector-dropdown-empty {
        padding: 10px 13px;
        font-size: 13px;
        color: #999;
    }

    .btn-submit {
        min-width: 130px;
        border: none;
        background: #1f4e79;
        color: #fff;
        padding: 11px 25px;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: all .2s ease;
    }

    .btn-submit:hover {
        background: #163a5c;
    }

    .btn-submit:disabled {
        opacity: .65;
        cursor: not-allowed;
    }

    @media(max-width: 767px) {

        .main-content {
            padding: 15px;
        }

        .custom-tabs {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .custom-tabs .nav-link {
            text-align: center;
            padding: 11px 8px;
            font-size: 12px;
        }

        .preference-checkboxes {
            flex-direction: column;
        }

        .checkbox-group {
            width: 100%;
        }
    }
</style>

        <div class="col-lg-8 col-md-8 dashboard-main-content">
            <div class="main-content">
                <h5 class="page-title">
                    MANAGE CONFIDENTIAL INFORMATION
                </h5>
                <div id="ajaxAlert"></div>

                <ul class="nav custom-tabs"
                    id="confidentialTabs">
                    <li class="nav-item">
                        <a href="#"
                           class="nav-link active"
                           data-tab="conf-tab1">
                            <i class="fas fa-user-secret me-1"></i>
                            Confidential Information
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#"
                           class="nav-link"
                           data-tab="conf-tab2">
                            <i class="fas fa-bullhorn me-1"></i>
                            Advertisement Details
                        </a>
                    </li>


                    <li class="nav-item">

                        <a href="#"
                           class="nav-link"
                           data-tab="conf-tab3">

                            <i class="fas fa-user me-1"></i>

                            Profile Information

                        </a>

                    </li>


                    <li class="nav-item">

                        <a href="#"
                           class="nav-link"
                           data-tab="conf-tab4">

                            <i class="fas fa-sliders-h me-1"></i>

                            Preferences

                        </a>

                    </li>

                </ul>


                {{-- ======================================================
                     TAB 1
                ======================================================= --}}

                <div id="conf-tab1"
                     class="tab-content active">

                    <form
                        action="{{ route('confidential.ajax.update', $user_rand_id) }}"
                        method="POST"
                        id="confidentialForm">

                        @csrf


                        <div class="form-group">

                            <label>
                                Your Name
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ $investor->inv_name ?? '' }}"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label>
                                Mobile Number
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="tel"
                                name="mobile"
                                class="form-control"
                                value="{{ $investor->inv_mobile ?? '' }}"
                                pattern="[0-9]{10}"
                                maxlength="10"
                                inputmode="numeric"
                                title="Enter a 10-digit mobile number"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label>
                                Email ID
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ $investor->inv_email ?? '' }}"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label>
                                City
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="inv_city"
                                class="form-control"
                                value="{{ $investor->inv_city ?? '' }}"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label>
                                State
                            </label>

                            <input
                                type="text"
                                name="inv_state"
                                class="form-control"
                                value="{{ $investor->inv_state ?? '' }}"
                            >

                        </div>


                        <div class="form-group">

                            <label>
                                Country
                            </label>

                            <input
                                type="text"
                                name="inv_country"
                                class="form-control"
                                value="{{ $investor->inv_country ?? '' }}"
                            >

                        </div>


                        <button
                            type="submit"
                            class="btn-submit">

                            SAVE CHANGES

                        </button>

                    </form>

                </div>


                {{-- ======================================================
                     TAB 2
                ======================================================= --}}

                <div id="conf-tab2"
                     class="tab-content">

                    <form
                        action="{{ route('advertisement.ajax.update', $user_rand_id) }}"
                        method="POST"
                        id="advertisementForm">

                        @csrf


                        <div class="form-group">

                            <label>
                                Advertisement Headline
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                id="inv_headline"
                                name="inv_headline"
                                class="form-control"
                                value="{{ $invAdvRecord->inv_headline ?? '' }}"
                                placeholder="Enter Advertisement Headline"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label>
                                Introduction
                            </label>

                            <textarea
                                id="inv_intro"
                                name="inv_intro"
                                class="form-control"
                                rows="5"
                                placeholder="Enter introduction details here..."
                            >{{ $invAdvRecord->inv_intro ?? '' }}</textarea>

                        </div>


                        <button
                            type="submit"
                            class="btn-submit">

                            SAVE CHANGES

                        </button>

                    </form>

                </div>


                {{-- ======================================================
                     TAB 3
                ======================================================= --}}

                <div id="conf-tab3"
                     class="tab-content">

                    <form
                        action="{{ route('investor.ajax.update', $user_rand_id) }}"
                        method="POST"
                        enctype="multipart/form-data"
                        id="investorProfileForm">

                        @csrf


                        <div class="form-group">

                            <label>
                                Company Name
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="company_name"
                                id="company_name"
                                class="form-control"
                                value="{{ $investor->company_name ?? '' }}"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label>
                                Designation
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="company_designation"
                                id="company_designation"
                                class="form-control"
                                value="{{ $investor->company_designation ?? '' }}"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label>
                                Investment Preference
                                <span class="text-danger">*</span>
                            </label>


                            <div class="preference-checkboxes">

                                <label class="checkbox-group">

                                    <input
                                        type="checkbox"
                                        name="invest_pref"
                                        id="invest_pref"
                                        value="1"
                                        {{ ($investor->invest_pref ?? 0) == 1 ? 'checked' : '' }}
                                    >

                                    <span>
                                        Investment
                                    </span>

                                </label>


                                <label class="checkbox-group">

                                    <input
                                        type="checkbox"
                                        name="full_acquisition"
                                        id="full_acquisition"
                                        value="1"
                                        {{ ($investor->full_acquisition ?? 0) == 1 ? 'checked' : '' }}
                                    >

                                    <span>
                                        Full Acquisition
                                    </span>

                                </label>

                            </div>


                            <div
                                id="preference-error"
                                class="text-danger mt-2"
                                style="display:none;">

                                Please select at least one preference.

                            </div>

                        </div>


                        {{-- INVESTMENT SECTION --}}

                        <div
                            id="investment-section"
                            style="{{ ($investor->invest_pref ?? 0) == 1 ? '' : 'display:none;' }}">

                            <div class="form-section">

                                <h4>
                                    For Investment
                                </h4>

                            </div>


                            <div class="form-group">

                                <label>
                                    Investment Size
                                </label>

                                <div class="row">

                                    <div class="col-md-6">

                                        <input
                                            type="number"
                                            name="invest_size_min"
                                            id="invest_size_min"
                                            class="form-control"
                                            placeholder="Minimum"
                                            value="{{ $investor->invest_size_min ?? '' }}"
                                        >

                                    </div>


                                    <div class="col-md-6">

                                        <input
                                            type="number"
                                            name="invest_size_max"
                                            id="invest_size_max"
                                            class="form-control"
                                            placeholder="Maximum"
                                            value="{{ $investor->invest_size_max ?? '' }}"
                                        >

                                    </div>

                                </div>

                            </div>


                            <div class="form-group">

                                <label>
                                    Investment Stake Preference (%)
                                </label>

                                <input
                                    type="number"
                                    name="invest_stake"
                                    id="invest_stake"
                                    class="form-control"
                                    min="0"
                                    max="100"
                                    value="{{ $investor->invest_stake ?? '' }}"
                                >

                            </div>

                        </div>


                        {{-- ACQUISITION SECTION --}}

                        <div
                            id="acquisition-section"
                            style="{{ ($investor->full_acquisition ?? 0) == 1 ? '' : 'display:none;' }}">

                            <div class="form-section">

                                <h4>
                                    Full Acquisition
                                </h4>

                            </div>


                            <div class="form-group">

                                <label>
                                    Purchasing Capacity
                                </label>

                                <div class="row">

                                    <div class="col-md-6">

                                        <input
                                            type="number"
                                            name="purchase_capacity_min"
                                            id="purchase_capacity_min"
                                            class="form-control"
                                            placeholder="Minimum"
                                            value="{{ $investor->purchase_capacity_min ?? '' }}"
                                        >

                                    </div>


                                    <div class="col-md-6">

                                        <input
                                            type="number"
                                            name="purchase_capacity_max"
                                            id="purchase_capacity_max"
                                            class="form-control"
                                            placeholder="Maximum"
                                            value="{{ $investor->purchase_capacity_max ?? '' }}"
                                        >

                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="form-group">

                            <label>
                                About Yourself
                                <span class="text-danger">*</span>
                            </label>

                            <textarea
                                name="inv_abt_urself"
                                id="inv_abt_urself"
                                class="form-control"
                                rows="4"
                                required
                            >{{ $investor->inv_abt_urself ?? '' }}</textarea>

                        </div>


                        {{-- IMAGE --}}

                        <div class="form-group">

                            <label>
                                Profile Picture
                            </label>


                            <div class="file-upload-area">

                                <div
                                    id="profilePreview"
                                    class="profile-preview">

                                    @if(!empty($investor->inv_profile_pic_path))

                                        <img
                                            src="{{ asset($investor->inv_profile_pic_path) }}"
                                            id="currentProfileImage"
                                            alt="Profile Picture">

                                    @else

                                        <div id="noProfileImage">
                                            No profile picture uploaded
                                        </div>

                                    @endif

                                </div>


                                <div class="accepted-formats">
                                    Accepted formats: PNG, JPG, JPEG, GIF
                                </div>


                                <div class="browse-area">

                                    <button
                                        type="button"
                                        class="file-upload-btn"
                                        id="browseProfileImage">

                                        Browse

                                    </button>


                                    <span id="fileName">
                                        No file chosen
                                    </span>


                                    <input
                                        type="file"
                                        name="inv_profile_pic_path"
                                        id="profileImage"
                                        accept=".png,.jpg,.jpeg,.gif"
                                        style="display:none;"
                                    >

                                </div>

                            </div>

                        </div>


                        <div class="form-group">

                            <label>
                                Your LinkedIn Profile
                            </label>

                            <input
                                type="url"
                                name="linkedin_profile"
                                id="linkedin_profile"
                                class="form-control"
                                placeholder="https://linkedin.com/in/..."
                                value="{{ $investor->linkedin_profile ?? '' }}"
                            >

                        </div>


                        <button
                            type="submit"
                            class="btn-submit">

                            SAVE CHANGES

                        </button>

                    </form>

                </div>


                {{-- ======================================================
                     TAB 4
                ======================================================= --}}

                <div id="conf-tab4"
                     class="tab-content">

                    <form
                        action="{{ route('preferences.ajax.update', $user_rand_id) }}"
                        method="POST"
                        id="preferencesForm">

                        @csrf


                        <div class="form-group">

                            <label>
                                Sector Preference
                            </label>


                            <div class="sector-search-wrapper">

                                <div
                                    class="tags-container"
                                    id="tagsContainer">

                                    <input
                                        type="text"
                                        class="tags-input"
                                        id="tagsInput"
                                        placeholder="Search sector..."
                                        autocomplete="off"
                                    >


                                    <input
                                        type="hidden"
                                        name="sectors"
                                        id="sectors"
                                        value=""
                                    >

                                </div>

                                <div
                                    id="sectorDropdown"
                                    class="sector-dropdown">
                                </div>

                            </div>

                        </div>


                        <div class="form-group">

                            <label>
                                Location Preference
                            </label>

                            <select name="location_preference[]" id="location_preference" class="form-control modysel" multiple>
                                @foreach(collect($locations ?? [])->groupBy(fn ($location) => $location->state ?? '')->sortKeys() as $stateName => $cities)
                                    <optgroup label="{{ stateDisplayName($stateName) ?: 'Other' }}">
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->city }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>

                        </div>


                        <button
                            type="submit"
                            class="btn-submit">

                            SAVE CHANGES

                        </button>

                    </form>

                </div>

            </div>

    
            {{-- Your page content here --}}

</div>




    </div>

</div>

@endsection


@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | BASIC DATA
    |--------------------------------------------------------------------------
    */

    const userRandId =
        @json($user_rand_id);

    const csrfToken =
        document.querySelector(
            'meta[name="csrf-token"]'
        )?.getAttribute('content');



    /*
    |--------------------------------------------------------------------------
    | URLS
    |--------------------------------------------------------------------------
    */

    const urls = {

        confidentialGet:
            @json(route(
                'confidential.ajax.get',
                $user_rand_id
            )),

        confidentialUpdate:
            @json(route(
                'confidential.ajax.update',
                $user_rand_id
            )),


        advertisementGet:
            @json(route(
                'advertisement.ajax.get',
                $user_rand_id
            )),

        advertisementUpdate:
            @json(route(
                'advertisement.ajax.update',
                $user_rand_id
            )),


        profileGet:
            @json(route(
                'investor.ajax.get',
                $user_rand_id
            )),

        profileUpdate:
            @json(route(
                'investor.ajax.update',
                $user_rand_id
            )),


        preferencesGet:
            @json(route(
                'preferences.ajax.get',
                $user_rand_id
            )),

        preferencesUpdate:
            @json(route(
                'preferences.ajax.update',
                $user_rand_id
            ))
    };


    /*
    |--------------------------------------------------------------------------
    | IMAGE BASE URL
    |--------------------------------------------------------------------------
    */

    const assetBaseUrl =
        @json(asset(''));


    /*
    |--------------------------------------------------------------------------
    | MESSAGE
    |--------------------------------------------------------------------------
    */

    function showMessage(
        message,
        type = 'success'
    ) {

        const box =
            document.getElementById(
                'ajaxAlert'
            );

        if (!box) {
            return;
        }


        box.style.display = 'block';

        box.style.background =
            type === 'success'
                ? '#e9f8ef'
                : '#fff0f0';

        box.style.color =
            type === 'success'
                ? '#198754'
                : '#dc3545';

        box.style.border =
            type === 'success'
                ? '1px solid #b7e4c7'
                : '1px solid #f1b0b7';

        box.innerHTML = message;


        clearTimeout(
            window.ajaxMessageTimer
        );


        window.ajaxMessageTimer =
            setTimeout(function () {

                box.style.display =
                    'none';

            }, 4000);
    }


    /*
    |--------------------------------------------------------------------------
    | ESCAPE HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(value) {

        const div =
            document.createElement('div');

        div.textContent =
            value ?? '';

        return div.innerHTML;
    }


    /*
    |--------------------------------------------------------------------------
    | VALIDATION ERROR
    |--------------------------------------------------------------------------
    */

    function showValidationErrors(
        errors
    ) {

        let html =
            '<ul style="margin:0;padding-left:20px;">';


        Object.keys(
            errors || {}
        ).forEach(function (field) {

            const messages =
                errors[field] || [];


            messages.forEach(function (message) {

                html +=
                    '<li>' +
                    escapeHtml(message) +
                    '</li>';

            });

        });


        html += '</ul>';


        showMessage(
            html,
            'danger'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | BUTTON LOADING
    |--------------------------------------------------------------------------
    */

    function setButtonLoading(
        button,
        loading
    ) {

        if (!button) {
            return;
        }


        if (loading) {

            button.dataset.oldText =
                button.innerHTML;

            button.disabled = true;

            button.innerHTML =
                'Saving...';

        } else {

            button.disabled = false;

            button.innerHTML =
                button.dataset.oldText ||
                'SAVE CHANGES';
        }
    }


    /*
    |--------------------------------------------------------------------------
    | AJAX POST
    |--------------------------------------------------------------------------
    */

    async function submitForm(
        form,
        url,
        button
    ) {

        setButtonLoading(
            button,
            true
        );


        try {

            const formData =
                new FormData(form);


            const response =
                await fetch(
                    url,
                    {
                        method: 'POST',

                        headers: {
                            'X-CSRF-TOKEN':
                                csrfToken,

                            'Accept':
                                'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest'
                        },

                        body: formData
                    }
                );


            const data =
                await response.json();


            if (response.status === 422) {

                showValidationErrors(
                    data.errors
                );

                return null;
            }


            if (
                !response.ok ||
                !data.status
            ) {

                showMessage(
                    data.message ||
                    'Something went wrong.',
                    'danger'
                );

                return null;
            }


            showMessage(
                data.message ||
                'Saved successfully.',
                'success'
            );


            return data;

        } catch (error) {

            console.error(
                'AJAX ERROR:',
                error
            );


            showMessage(
                'Server error. Please try again.',
                'danger'
            );


            return null;

        } finally {

            setButtonLoading(
                button,
                false
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | AJAX GET
    |--------------------------------------------------------------------------
    */

    async function getData(url) {

        try {

            const response =
                await fetch(
                    url,
                    {
                        method: 'GET',

                        headers: {
                            'Accept':
                                'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest'
                        }
                    }
                );


            const data =
                await response.json();


            if (
                !response.ok ||
                !data.status
            ) {

                throw new Error(
                    data.message ||
                    'Unable to load data.'
                );
            }


            return data;

        } catch (error) {

            console.error(
                'GET ERROR:',
                error
            );


            // showMessage(
            //     'Unable to load data.',
            //     'danger'
            // );


            return null;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | TAB ELEMENTS
    |--------------------------------------------------------------------------
    */

    const tabLinks =
        document.querySelectorAll(
            '#confidentialTabs .nav-link'
        );


    const tabContents =
        document.querySelectorAll(
            '.tab-content'
        );


    /*
    |--------------------------------------------------------------------------
    | ACTIVATE TAB
    |--------------------------------------------------------------------------
    */

    function activateTab(
        tabId
    ) {

        tabContents.forEach(
            function (content) {

                content.classList.remove(
                    'active'
                );

                content.style.display =
                    'none';
            }
        );


        tabLinks.forEach(
            function (link) {

                link.classList.remove(
                    'active'
                );
            }
        );


        const selectedContent =
            document.getElementById(
                tabId
            );


        const selectedLink =
            document.querySelector(
                '#confidentialTabs .nav-link[data-tab="' +
                tabId +
                '"]'
            );


        if (selectedContent) {

            selectedContent.classList.add(
                'active'
            );

            selectedContent.style.display =
                'block';
        }


        if (selectedLink) {

            selectedLink.classList.add(
                'active'
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | TAB CLICK
    |--------------------------------------------------------------------------
    */

    tabLinks.forEach(
        function (link) {

            link.addEventListener(
                'click',
                async function (event) {

                    event.preventDefault();


                    const tabId =
                        this.getAttribute(
                            'data-tab'
                        );


                    if (!tabId) {
                        return;
                    }


                    /*
                    | First change tab
                    */

                    activateTab(
                        tabId
                    );


                    /*
                    | Then load latest data
                    */

                    if (
                        tabId ===
                        'conf-tab1'
                    ) {

                        await loadConfidential();
                    }


                    if (
                        tabId ===
                        'conf-tab2'
                    ) {

                        await loadAdvertisement();
                    }


                    if (
                        tabId ===
                        'conf-tab3'
                    ) {

                        await loadProfile();
                    }


                    if (
                        tabId ===
                        'conf-tab4'
                    ) {

                        await loadPreferences();
                    }

                }
            );
        }
    );


    /*
    |--------------------------------------------------------------------------
    | CONFIDENTIAL LOAD
    |--------------------------------------------------------------------------
    */

    async function loadConfidential() {

        const data =
            await getData(
                urls.confidentialGet
            );


        if (!data) {
            return;
        }


        const info =
            data.data || {};


        const form =
            document.getElementById(
                'confidentialForm'
            );


        if (!form) {
            return;
        }


        form.elements.name.value =
            info.name || '';


        form.elements.mobile.value =
            info.mobile || '';


        form.elements.email.value =
            info.email || '';


        form.elements.inv_city.value =
            info.inv_city || '';


        form.elements.inv_state.value =
            info.inv_state || '';


        form.elements.inv_country.value =
            info.inv_country || '';
    }


    /*
    |--------------------------------------------------------------------------
    | ADVERTISEMENT LOAD
    |--------------------------------------------------------------------------
    */

    async function loadAdvertisement() {

        const data =
            await getData(
                urls.advertisementGet
            );


        if (!data) {
            return;
        }


        const info =
            data.data || {};


        const headline =
            document.getElementById(
                'inv_headline'
            );


        const intro =
            document.getElementById(
                'inv_intro'
            );


        if (headline) {

            headline.value =
                info.inv_headline || '';
        }


        if (intro) {

            intro.value =
                info.inv_intro || '';
        }
    }


    /*
    |--------------------------------------------------------------------------
    | PROFILE LOAD
    |--------------------------------------------------------------------------
    */

    async function loadProfile() {

        const data =
            await getData(
                urls.profileGet
            );


        if (!data) {
            return;
        }


        const info =
            data.data || {};


        setValue(
            'company_name',
            info.company_name
        );


        setValue(
            'company_designation',
            info.company_designation
        );


        setValue(
            'invest_size_min',
            info.invest_size_min
        );


        setValue(
            'invest_size_max',
            info.invest_size_max
        );


        setValue(
            'invest_stake',
            info.invest_stake
        );


        setValue(
            'purchase_capacity_min',
            info.purchase_capacity_min
        );


        setValue(
            'purchase_capacity_max',
            info.purchase_capacity_max
        );


        setValue(
            'inv_abt_urself',
            info.inv_abt_urself
        );


        setValue(
            'linkedin_profile',
            info.linkedin_profile
        );


        const investmentCheckbox =
            document.getElementById(
                'invest_pref'
            );


        const acquisitionCheckbox =
            document.getElementById(
                'full_acquisition'
            );


        if (investmentCheckbox) {

            investmentCheckbox.checked =
                Number(
                    info.invest_pref
                ) === 1;
        }


        if (acquisitionCheckbox) {

            acquisitionCheckbox.checked =
                Number(
                    info.full_acquisition
                ) === 1;
        }


        toggleInvestment();

        toggleAcquisition();


        /*
        |--------------------------------------------------------------------------
        | IMAGE
        |--------------------------------------------------------------------------
        */

        if (
            info.inv_profile_pic_path
        ) {

            updateProfileImage(
                info.inv_profile_pic_path
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | SET VALUE
    |--------------------------------------------------------------------------
    */

    function setValue(
        id,
        value
    ) {

        const element =
            document.getElementById(
                id
            );


        if (element) {

            element.value =
                value ?? '';
        }
    }


    /*
    |--------------------------------------------------------------------------
    | PROFILE IMAGE
    |--------------------------------------------------------------------------
    */

    function updateProfileImage(
        path
    ) {

        const preview =
            document.getElementById(
                'profilePreview'
            );


        if (!preview || !path) {
            return;
        }


        preview.innerHTML =
            '<img src="' +
            escapeHtml(
                assetBaseUrl +
                path
            ) +
            '?t=' +
            Date.now() +
            '" ' +
            'id="currentProfileImage" ' +
            'alt="Profile Picture">';
    }


    /*
    |--------------------------------------------------------------------------
    | PREFERENCES LOAD
    |--------------------------------------------------------------------------
    */

    async function loadPreferences() {

        const data =
            await getData(
                urls.preferencesGet
            );


        if (!data) {
            return;
        }


        const industries =
            data.data?.industries || [];


        const locations =
            data.data?.locations || [];


        /*
        |--------------------------------------------------------------------------
        | CLEAR TAGS
        |--------------------------------------------------------------------------
        */

        const container =
            document.getElementById(
                'tagsContainer'
            );


        const input =
            document.getElementById(
                'tagsInput'
            );


        const hidden =
            document.getElementById(
                'sectors'
            );


        if (
            container &&
            input &&
            hidden
        ) {

            container
                .querySelectorAll(
                    '.tag-item'
                )
                .forEach(
                    function (tag) {

                        tag.remove();
                    }
                );


            hidden.value = '';


            industries.forEach(
                function (industry) {

                    addTag(
                        industry.name
                    );
                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | LOCATION (same select + optgroup markup as the investor
        | registration form — value is the bx_cities.id, matched here
        | against each saved preference's place_id)
        |--------------------------------------------------------------------------
        */

        const locationSelect =
            document.getElementById(
                'location_preference'
            );

        if (locationSelect) {

            const savedPlaceIds =
                locations.map(
                    function (item) {
                        return String(item.place_id || '');
                    }
                );

            Array.from(locationSelect.options).forEach(
                function (option) {
                    option.selected = savedPlaceIds.includes(
                        String(option.value)
                    );
                }
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | TAG ADD
    |--------------------------------------------------------------------------
    */

    function addTag(
        text
    ) {

        text =
            String(text || '').trim();


        if (!text) {
            return;
        }


        const container =
            document.getElementById(
                'tagsContainer'
            );


        const input =
            document.getElementById(
                'tagsInput'
            );


        const hidden =
            document.getElementById(
                'sectors'
            );


        if (
            !container ||
            !input ||
            !hidden
        ) {
            return;
        }


        let sectors =
            hidden.value
                ? hidden.value
                    .split(',')
                    .map(
                        item => item.trim()
                    )
                    .filter(Boolean)
                : [];


        /*
        |--------------------------------------------------------------------------
        | DUPLICATE CHECK
        |--------------------------------------------------------------------------
        */

        const exists =
            sectors.some(
                function (item) {

                    return item.toLowerCase() ===
                        text.toLowerCase();
                }
            );


        if (exists) {
            return;
        }


        sectors.push(text);


        hidden.value =
            sectors.join(',');


        const tag =
            document.createElement(
                'span'
            );


        tag.className =
            'tag-item';


        const nameSpan =
            document.createElement(
                'span'
            );


        nameSpan.textContent =
            text;


        const removeSpan =
            document.createElement(
                'span'
            );


        removeSpan.className =
            'remove-tag';


        removeSpan.innerHTML =
            '&times;';


        tag.appendChild(
            nameSpan
        );


        tag.appendChild(
            removeSpan
        );


        container.insertBefore(
            tag,
            input
        );


        removeSpan.addEventListener(
            'click',
            function () {

                let current =
                    hidden.value
                        .split(',')
                        .map(
                            item => item.trim()
                        )
                        .filter(
                            Boolean
                        );


                current =
                    current.filter(
                        function (item) {

                            return item !==
                                text;
                        }
                    );


                hidden.value =
                    current.join(',');


                tag.remove();
            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SECTOR SEARCH DROPDOWN
    |--------------------------------------------------------------------------
    */

    const tagsInput =
        document.getElementById(
            'tagsInput'
        );


    const sectorDropdown =
        document.getElementById(
            'sectorDropdown'
        );


    let sectorSearchTimer = null;


    function hideSectorDropdown() {

        if (!sectorDropdown) {
            return;
        }


        sectorDropdown.style.display =
            'none';


        sectorDropdown.innerHTML =
            '';
    }


    function showSectorDropdown() {

        if (!sectorDropdown) {
            return;
        }


        sectorDropdown.style.display =
            'block';
    }


    async function searchSectors(searchText) {

        if (!sectorDropdown) {
            return;
        }


        searchText =
            String(searchText || '').trim();


        if (!searchText) {
            hideSectorDropdown();
            return;
        }


        sectorDropdown.innerHTML =
            '<div class="sector-dropdown-empty">Searching...</div>';


        showSectorDropdown();


        try {

            const response =
                await fetch(
                    "{{ route('preferences.ajax.sectors') }}?search=" +
                    encodeURIComponent(searchText),
                    {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }
                );


            if (!response.ok) {
                throw new Error('Sector search failed.');
            }


            const data =
                await response.json();


            const categories =
                data.data || [];


            const hidden =
                document.getElementById('sectors');


            const selectedSectors =
                hidden && hidden.value
                    ? hidden.value
                        .split(',')
                        .map(function (item) {
                            return item.trim().toLowerCase();
                        })
                        .filter(Boolean)
                    : [];


            sectorDropdown.innerHTML = '';


            categories.forEach(function (category) {

                const categoryName =
                    String(category.name || '').trim();


                if (!categoryName) {
                    return;
                }


                if (
                    selectedSectors.includes(
                        categoryName.toLowerCase()
                    )
                ) {
                    return;
                }


                const item =
                    document.createElement('div');


                item.className =
                    'sector-dropdown-item';


                item.textContent =
                    categoryName;


                item.addEventListener(
                    'click',
                    function () {

                        addTag(categoryName);

                        tagsInput.value = '';

                        hideSectorDropdown();

                        tagsInput.focus();
                    }
                );


                sectorDropdown.appendChild(item);
            });


            if (!sectorDropdown.children.length) {

                sectorDropdown.innerHTML =
                    '<div class="sector-dropdown-empty">No matching sector found</div>';
            }


            showSectorDropdown();


        } catch (error) {

            console.error(
                'SECTOR SEARCH ERROR:',
                error
            );


            sectorDropdown.innerHTML =
                '<div class="sector-dropdown-empty">Unable to search sectors</div>';


            showSectorDropdown();
        }
    }


    if (tagsInput) {

        tagsInput.addEventListener(
            'input',
            function () {

                const value =
                    this.value.trim();


                clearTimeout(
                    sectorSearchTimer
                );


                if (!value) {
                    hideSectorDropdown();
                    return;
                }


                sectorSearchTimer =
                    setTimeout(function () {

                        searchSectors(value);

                    }, 300);
            }
        );


        tagsInput.addEventListener(
            'keydown',
            function (event) {

                if (event.key === 'Escape') {
                    hideSectorDropdown();
                    return;
                }


                /*
                | Only existing database categories can be added.
                | Enter does not add arbitrary text.
                */

                if (event.key === 'Enter') {
                    event.preventDefault();

                    const value =
                        this.value.trim();

                    if (value) {
                        searchSectors(value);
                    }
                }
            }
        );
    }


    document.addEventListener(
        'click',
        function (event) {

            if (
                tagsInput &&
                sectorDropdown &&
                !tagsInput.contains(event.target) &&
                !sectorDropdown.contains(event.target)
            ) {
                hideSectorDropdown();
            }
        }
    );


    // Location Preference uses the same select + optgroup as the investor
    // registration form (see loadPreferences() above for how saved
    // preferences get pre-selected).


    /*
    |--------------------------------------------------------------------------
    | INVESTMENT TOGGLE
    |--------------------------------------------------------------------------
    */

    const investmentCheckbox =
        document.getElementById(
            'invest_pref'
        );


    const acquisitionCheckbox =
        document.getElementById(
            'full_acquisition'
        );


    const investmentSection =
        document.getElementById(
            'investment-section'
        );


    const acquisitionSection =
        document.getElementById(
            'acquisition-section'
        );


    function toggleInvestment() {

        if (
            !investmentCheckbox ||
            !investmentSection
        ) {
            return;
        }


        investmentSection.style.display =
            investmentCheckbox.checked
                ? 'block'
                : 'none';
    }


    function toggleAcquisition() {

        if (
            !acquisitionCheckbox ||
            !acquisitionSection
        ) {
            return;
        }


        acquisitionSection.style.display =
            acquisitionCheckbox.checked
                ? 'block'
                : 'none';
    }


    if (investmentCheckbox) {

        investmentCheckbox.addEventListener(
            'change',
            toggleInvestment
        );
    }


    if (acquisitionCheckbox) {

        acquisitionCheckbox.addEventListener(
            'change',
            toggleAcquisition
        );
    }


    /*
    |--------------------------------------------------------------------------
    | IMAGE BROWSE
    |--------------------------------------------------------------------------
    */

    const browseButton =
        document.getElementById(
            'browseProfileImage'
        );


    const profileImage =
        document.getElementById(
            'profileImage'
        );


    if (
        browseButton &&
        profileImage
    ) {

        browseButton.addEventListener(
            'click',
            function () {

                profileImage.click();
            }
        );


        profileImage.addEventListener(
            'change',
            function () {

                const file =
                    this.files[0];


                if (!file) {
                    return;
                }


                const fileName =
                    document.getElementById(
                        'fileName'
                    );


                if (fileName) {

                    fileName.textContent =
                        file.name;
                }


                const reader =
                    new FileReader();


                reader.onload =
                    function (event) {

                        const preview =
                            document.getElementById(
                                'profilePreview'
                            );


                        if (!preview) {
                            return;
                        }


                        preview.innerHTML =
                            '<img src="' +
                            event.target.result +
                            '" ' +
                            'style="width:150px;height:150px;object-fit:cover;border-radius:10px;" ' +
                            'alt="Profile Picture">';
                    };


                reader.readAsDataURL(
                    file
                );
            }
        );
    }
    const confidentialForm =
        document.getElementById(
            'confidentialForm'
        );


    if (confidentialForm) {

        confidentialForm.addEventListener(
            'submit',
            async function (event) {

                event.preventDefault();


                const button =
                    this.querySelector(
                        'button[type="submit"]'
                    );


                const result =
                    await submitForm(
                        this,
                        urls.confidentialUpdate,
                        button
                    );


                if (result) {

                    await loadConfidential();

                    activateTab(
                        'conf-tab1'
                    );
                }
            }
        );
    }

    const advertisementForm =
        document.getElementById(
            'advertisementForm'
        );


    if (advertisementForm) {

        advertisementForm.addEventListener(
            'submit',
            async function (event) {

                event.preventDefault();


                const button =
                    this.querySelector(
                        'button[type="submit"]'
                    );


                const result =
                    await submitForm(
                        this,
                        urls.advertisementUpdate,
                        button
                    );


                if (result) {

                    await loadAdvertisement();

                    activateTab(
                        'conf-tab2'
                    );
                }
            }
        );
    }
    const investorProfileForm =
        document.getElementById(
            'investorProfileForm'
        );


    if (investorProfileForm) {

        investorProfileForm.addEventListener(
            'submit',
            async function (event) {

                event.preventDefault();


                const investmentChecked =
                    investmentCheckbox?.checked;


                const acquisitionChecked =
                    acquisitionCheckbox?.checked;


                if (
                    !investmentChecked &&
                    !acquisitionChecked
                ) {

                    showMessage(
                        'Please select at least one investment preference.',
                        'danger'
                    );


                    activateTab(
                        'conf-tab3'
                    );


                    return;
                }


                const button =
                    this.querySelector(
                        'button[type="submit"]'
                    );


                const result =
                    await submitForm(
                        this,
                        urls.profileUpdate,
                        button
                    );


                if (result) {

                    await loadProfile();

                    activateTab(
                        'conf-tab3'
                    );


                    if (
                        result.data &&
                        result.data.inv_profile_pic_path
                    ) {

                        updateProfileImage(
                            result.data.inv_profile_pic_path
                        );
                    }
                }
            }
        );
    }

    const preferencesForm =
        document.getElementById(
            'preferencesForm'
        );


    if (preferencesForm) {

        preferencesForm.addEventListener(
            'submit',
            async function (event) {

                event.preventDefault();


                const button =
                    this.querySelector(
                        'button[type="submit"]'
                    );


                const result =
                    await submitForm(
                        this,
                        urls.preferencesUpdate,
                        button
                    );


                if (result) {

                    await loadPreferences();

                    activateTab(
                        'conf-tab4'
                    );
                }
            }
        );
    }

    activateTab(
        'conf-tab1'
    );

    loadConfidential();

});

</script>

@endpush
