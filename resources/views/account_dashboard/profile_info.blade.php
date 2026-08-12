@extends('account_dashboard.accountDashboardApp')

@section('title', 'My Account')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        @include('partials.sidebar')
        <main class="col-lg-9">
            <div class="main-content">
                <form method="POST"
                      action="{{ route('investor.update', $investor->inv_profile_str) }}"
                      enctype="multipart/form-data"
                      class="needs-validation"
                      novalidate>
                    @csrf
                    <div class="form-group">
                        <label>Company Name*:</label>
                        <input type="text"
                               name="company_name"
                               class="form-control"
                               placeholder="Enter Company Name"
                               value="{{ old('company_name', $investor->company_name ?? '') }}"
                               required>
                        <div class="invalid-feedback">
                            Please enter company name.
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Designation*:</label>
                        <input type="text"
                               name="company_designation"
                               class="form-control"
                               placeholder="Enter your Designation"
                               value="{{ old('company_designation', $investor->company_designation ?? '') }}"
                               required>
                        <div class="invalid-feedback">
                            Please enter designation.
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Investment Preference*:</label>
                        <div class="preference-checkboxes">
                            <label class="checkbox-group">
                                <input type="checkbox"
                                       name="invest_pref"
                                       id="invest_pref"
                                       value="1"
                                       {{ old('invest_pref', $investor->invest_pref ?? 0) ? 'checked' : '' }}>
                                <span>Investment</span>
                            </label>
                            <label class="checkbox-group">
                                <input type="checkbox"
                                       name="full_acquisition"
                                       id="full_acquisition"
                                       value="1"
                                       {{ old('full_acquisition', $investor->full_acquisition ?? 0) ? 'checked' : '' }}>
                                <span>Full Acquisition</span>
                            </label>
                        </div>
                        <div id="preference-error"
                             class="text-danger"
                             style="display:none;">
                            Please Select atleast one
                        </div>
                    </div>
                    <div id="investment-section"
                         class="investment-section">
                        <h4>For Investment</h4>
                        <div class="form-group">
                            <label>Investment Size :</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="number"
                                           name="invest_size_min"
                                           id="invest_size_min"
                                           class="form-control"
                                           placeholder="0"
                                           value="{{ old('invest_size_min', $investor->invest_size_min ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <input type="number"
                                           name="invest_size_max"
                                           id="invest_size_max"
                                           class="form-control"
                                           placeholder="0"
                                           value="{{ old('invest_size_max', $investor->invest_size_max ?? '') }}">
                                </div>

                            </div>

                        </div>

                        <div class="form-group">

                            <label>Investment Stake Preference :</label>

                            <input type="number"
                                   name="invest_stake"
                                   id="invest_stake"
                                   class="form-control"
                                   placeholder="Enter %"
                                   min="0"
                                   max="100"
                                   value="{{ old('invest_stake', $investor->invest_stake ?? '') }}">

                        </div>

                    </div>

                    <div id="acquisition-section"
                         class="acquisition-section">

                        <h4>Acquisition</h4>

                        <div class="form-group">

                            <label>Purchasing Capacity :</label>

                            <div class="row">

                                <div class="col-md-6">
                                    <input type="number"
                                           name="purchase_capacity_min"
                                           id="purchase_capacity_min"
                                           class="form-control"
                                           placeholder="0"
                                           value="{{ old('purchase_capacity_min', $investor->purchase_capacity_min ?? '0') }}">
                                </div>

                                <div class="col-md-6">
                                    <input type="number" name="purchase_capacity_max" id="purchase_capacity_max" class="form-control" placeholder="0" value="{{ old('purchase_capacity_max', $investor->purchase_capacity_max ?? '0') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>About Yourself*:</label>
                        <textarea name="inv_abt_urself" class="form-control" rows="4" placeholder="Enter your Professional Summary" required>{{ old('inv_abt_urself', $investor->inv_abt_urself ?? '') }}</textarea>
                        <div class="invalid-feedback">
                            Please enter about yourself.
                        </div>
                    </div>
                  <div class="form-group">
                    <label>Profile Pictures:</label>
                    <div class="file-upload-area">
                        <div id="profilePreview" class="profile-preview">
                            @if(!empty($investor->inv_profile_pic_path))
                            <img src="{{ asset($investor->inv_profile_pic_path) }}"
                            alt="Profile Picture"
                            id="currentProfileImage"
                            style="max-width:150px; max-height:150px; object-fit:cover; border-radius:8px;">
                            @else
                            <div id="noProfileImage">
                                No profile picture uploaded
                            </div>
                            @endif
                        </div>
                        <div class="accepted-formats">
                            Accepted formats - png, jpeg, gif
                        </div>
                        <div class="browse-area">
            <button type="button"
                    class="file-upload-btn"
                    onclick="document.getElementById('profileImage').click();">
                Browse
            </button>
            <span id="fileName">
                No file chosen
            </span>
            <input type="file" name="inv_profile_pic_path" id="profileImage" accept=".png,.jpg,.jpeg,.gif" hidden>
        </div>
    </div>
</div>
<div class="form-group">
    <label>Your LinkedIn Profile :</label>
    <input type="url" name="linkedin_profile" class="form-control" placeholder="Enter URL" value="{{ old('linkedin_profile', $investor->linkedin_profile ?? '') }}">
</div>
<button type="submit" class="btn-submit">SUBMIT</button></form>
            </div>
        </main>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/main.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const investmentCheckbox = document.getElementById("invest_pref");
    const acquisitionCheckbox = document.getElementById("full_acquisition");
    const investmentSection = document.getElementById("investment-section");
    const acquisitionSection = document.getElementById("acquisition-section");
    const preferenceError = document.getElementById("preference-error");

    function toggleInvestment() {
        if (investmentCheckbox.checked) {
            investmentSection.style.display = "block";
        } else {
            investmentSection.style.display = "none";
            document.getElementById("invest_size_min").value = "";
            document.getElementById("invest_size_max").value = "";
            document.getElementById("invest_stake").value = "";
        }
        validatePreference();
    }
    function toggleAcquisition() {
        if (acquisitionCheckbox.checked) {
            acquisitionSection.style.display = "block";
        } else {
            acquisitionSection.style.display = "none";
            document.getElementById("purchase_capacity_min").value = "";
            document.getElementById("purchase_capacity_max").value = "";
        }
        validatePreference();
    }

    function validatePreference() {
        if (!investmentCheckbox.checked &&
            !acquisitionCheckbox.checked) {
            preferenceError.style.display = "block";
            return false;
        } else {
            preferenceError.style.display = "none";
            return true;
        }
    }
    investmentCheckbox.addEventListener("change", function () {
        toggleInvestment();
    });
    acquisitionCheckbox.addEventListener("change", function () {
        toggleAcquisition();
    });
    toggleInvestment();
    toggleAcquisition();
    const profileImage = document.getElementById("profileImage");
    const fileName = document.getElementById("fileName");
    const profilePreview = document.getElementById("profilePreview");
    if (profileImage) {
        profileImage.addEventListener("change", function () {
            if (this.files && this.files.length > 0) {
                const file = this.files[0];
                fileName.textContent = file.name;
                const reader = new FileReader();
                reader.onload = function (e) {
                    profilePreview.innerHTML =
                        '<img src="' +
                        e.target.result +
                        '" alt="Profile Picture" style="max-width:150px;">';
                };
                reader.readAsDataURL(file);
            } else {
                fileName.textContent = "No file chosen";
            }
        });
    }
    const form = document.querySelector("form");

    if (form) {
        form.addEventListener("submit", function (event) {
            const preferenceValid = validatePreference();
            if (!preferenceValid) {
                event.preventDefault();
                event.stopPropagation();
                document.getElementById("invest_pref")
                    .scrollIntoView({
                        behavior: "smooth",
                        block: "center"
                    });
                return false;
            }
            if (!form.checkValidity()) {

                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add("was-validated");
        });
    }

});

document.getElementById('profileImage').addEventListener('change', function (event) {

    const file = event.target.files[0];
    if (!file) {
        return;
    }
    document.getElementById('fileName').textContent = file.name;
    const preview = document.getElementById('profilePreview');
    const oldImage = document.getElementById('currentProfileImage');
    const noImage = document.getElementById('noProfileImage');
    if (oldImage) {
        oldImage.remove();
    }
    if (noImage) {
        noImage.remove();
    }
    const reader = new FileReader();
    reader.onload = function (e) {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.id = 'currentProfileImage';
        img.style.maxWidth = '150px';
        img.style.maxHeight = '150px';
        img.style.objectFit = 'cover';
        img.style.borderRadius = '8px';
        preview.prepend(img);
    };
    reader.readAsDataURL(file);
});
</script>
@endsection