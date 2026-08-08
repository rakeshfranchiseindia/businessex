@extends('account_dashboard.accountDashboardApp')
@section('title', 'My Account')

@section('content')

    <div class="container-fluid py-4">
        <div class="row">
            @include('partials.sidebar')

            <main class="col-lg-9">
                <div class="main-content">
                    <h5 class="page-title">MANAGE CONFIDENTIAL INFORMATION</h5>

                    <!-- Tabs -->
                    <ul class="nav custom-tabs">
                        <li class="nav-item">
                            <a class="nav-link active"
                                href="{{ route('confidential.edit', ['user_rand_id' => auth()->user()->user_rand_id]) }}"
                                onclick="switchTab('conf-tab1')">
                                Confidential Information
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="switchTab('conf-tab2')">
                                Advertisement Details
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#conf-tab3" data-tab="conf-tab3" onclick="switchTab('conf-tab3')">
                                Profile Information
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#conf-tab4" data-tab="conf-tab4" onclick="switchTab('conf-tab4')">
                                Preferences
                            </a>
                        </li>
                    </ul>

                    <!-- Tab Content 1 -->
                    <div id="conf-tab1" class="tab-content">
                        <form action="{{ route('confidential.update', $user->user_rand_id) }}" method="POST">
                            @csrf
                            <div class="form-group"><label>Your Name*</label><input type="text" name="name"
                                    class="form-control" value="{{ old('name', $user->name) }}" required></div>
                            <div class="form-group"><label>Mobile Number*</label><input type="tel" name="mobile"
                                    class="form-control" value="{{ old('mobile', $user->mobile) }}" required></div>
                            <div class="form-group"><label>Email ID*</label><input type="email" name="email"
                                    class="form-control" value="{{ old('email', $user->email) }}" required></div>
                            <div class="form-group"><label>Location*</label><input type="text" name="location"
                                    class="form-control" value="{{ old('location', $user->location) }}" required></div>
                            <button type="submit" class="btn-submit">SUBMIT</button>
                        </form>
                    </div>

                    <!-- Tab Content 2 -->
                    <div id="conf-tab2" class="tab-content" style="display:none;">
                        <form action="{{ route('advertisement.save', $user->user_rand_id) }}" method="POST">
                            @csrf
                            <div class="form-group"><label>Advertisement Headline*</label> <input type="text" name="inv_headline" class="form-control"
                        value="{{ old('inv_headline', $invAdvRecord->inv_headline ?? '') }}"
                        placeholder="Enter Advertisement Headline" required></div>
                            <div class="form-group"><label>Introduction :</label><textarea name="inv_intro" class="form-control" rows="4"
                        placeholder="Enter introduction details here...">{{ old('inv_intro', $invAdvRecord->inv_intro ?? '') }}</textarea></div>
                            <button type="submit" class="btn-submit">SUBMIT</button>
                        </form>
                    </div>

                    <!-- Tab Content 3 -->
                    <div id="conf-tab3" class="tab-content" style="display:none;">
                        <form class="needs-validation" novalidate>
                            <div class="form-group"><label>Company Name*</label><input type="text" class="form-control"
                                    placeholder="Enter Company Name" required></div>
                            <div class="form-group"><label>Designation*</label><input type="text" class="form-control"
                                    placeholder="Enter your Designation" required></div>
                            <div class="form-group">
                                <label class="checkbox-group"><input type="checkbox" checked> Investment Preference</label>
                                <label class="checkbox-group ml-4"><input type="checkbox"> Full Acquisition</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"><label>For Investment</label>
                                        <div class="input-group"><input type="number" class="form-control" placeholder="0"
                                                value="0">
                                            <div class="input-group-append"><span class="input-group-text">₹</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><label>&nbsp;</label>
                                        <div class="input-group"><input type="number" class="form-control" placeholder="0"
                                                value="0">
                                            <div class="input-group-append"><span class="input-group-text">₹</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group"><label>Investment Stake Preference</label><input type="text"
                                    class="form-control" placeholder="Enter %"></div>
                            <div class="form-group"><label>About Yourself:</label><textarea class="form-control" rows="4"
                                    placeholder="Enter your Professional Summary"></textarea></div>
                            <div class="form-group"><label>Profile Pictures:</label>
                                <div class="file-upload-area"><i class="far fa-image"></i>
                                    <p>Click or drag files here to upload</p><input type="file" accept="image/*"
                                        hidden><button type="button" class="file-upload-btn">Choose File</button><small
                                        class="text-muted d-block mt-2">Accepted formats: .png, .jpg, .gif</small>
                                </div>
                            </div>
                            <div class="form-group"><label>Your LinkedIn Profile:</label><input type="url"
                                    class="form-control" placeholder="Enter URL"></div>
                            <button type="submit" class="btn-submit">SUBMIT</button>
                        </form>
                    </div>

                    <!-- Tab Content 4 -->
                    <div id="conf-tab4" class="tab-content" style="display:none;">
                        <form class="needs-validation" novalidate>
                            <div class="form-group"><label>Sector Preference *:</label>
                                <div class="tags-container"><span class="tag-item" data-tag="Beauty equipments"><span>Beauty
                                            equipments</span><span class="remove-tag">&times;</span></span><span
                                        class="tag-item" data-tag="Business research"><span>Business research</span><span
                                            class="remove-tag">&times;</span></span><span class="tag-item"
                                        data-tag="Entertainment services"><span>Entertainment services</span><span
                                            class="remove-tag">&times;</span></span><input type="text"
                                        class="tags-input form-control border-0"
                                        placeholder="Type and press Enter..."><input type="hidden" name="sectors"
                                        value="Beauty equipments,Business research,Entertainment services"></div>
                            </div>
                            <div class="form-group"><label>Location Preference *:</label><input type="text"
                                    class="form-control" placeholder="Enter location preferences"></div>
                            <button type="submit" class="btn-submit">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/main.js"></script>
@endsection


<script>
    function switchTab(tabId) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(function (tab) {
            tab.style.display = 'none';
        });

        // Remove active class from all nav links
        document.querySelectorAll('.nav-link').forEach(function (link) {
            link.classList.remove('active');
        });

        // Show the selected tab
        document.getElementById(tabId).style.display = 'block';

        // Add active class to the clicked nav link
        document.querySelector('[data-tab="' + tabId + '"]').classList.add('active');
    }
</script>