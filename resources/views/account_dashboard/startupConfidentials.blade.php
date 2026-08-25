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
    .custom-tabs .nav-link { border: none; background: #f5f6f8; color: #555; font-size: 13px; font-weight: 600; padding: 11px 16px; border-radius: 7px 7px 0 0; cursor: pointer; transition: all .25s ease; text-decoration: none; display: block; }
    .custom-tabs .nav-link:hover { background: #e9ecef; color: #222; }
    .custom-tabs .nav-link.active { background: #1f4e79; color: #fff; }
    .tab-content { display: none; }
    .tab-content.active { display: block; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-size: 14px; font-weight: 600; color: #333; margin-bottom: 8px; }
    .form-control { width: 100%; min-height: 44px; border: 1px solid #dcdfe3; border-radius: 7px; padding: 10px 13px; font-size: 14px; }
    .form-control:focus { border-color: #1f4e79; box-shadow: 0 0 0 3px rgba(31,78,121,.10); outline: none; }
    textarea.form-control { min-height: 90px; resize: vertical; }
    .form-section { margin-top: 25px; margin-bottom: 20px; padding: 14px 17px; background: #f7f9fb; border-left: 4px solid #1f4e79; border-radius: 5px; }
    .form-section h4 { margin: 0; font-size: 15px; font-weight: 700; color: #1f4e79; }
    .preference-checkboxes { display: flex; flex-wrap: wrap; gap: 12px; }
    .checkbox-group { display: flex !important; align-items: center; gap: 8px; background: #f7f8fa; border: 1px solid #ddd; border-radius: 7px; padding: 10px 15px; cursor: pointer; margin: 0 !important; font-weight: 500 !important; }
    .checkbox-group input { width: 17px; height: 17px; cursor: pointer; }
    .repeatable-row { display: flex; gap: 10px; margin-bottom: 10px; align-items: center; flex-wrap: wrap; }
    .repeatable-row input, .repeatable-row select { flex: 1; min-width: 130px; }
    .remove-row { cursor: pointer; font-size: 20px; line-height: 1; color: #c0392b; padding: 0 6px; }
    .tags-container { display: flex; align-items: center; flex-wrap: wrap; gap: 7px; padding: 8px; min-height: 48px; border: 1px solid #ddd; border-radius: 7px; }
    .tag-item { display: inline-flex; align-items: center; gap: 8px; background: #e9f1f8; color: #1f4e79; padding: 6px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }
    .remove-tag { cursor: pointer; font-size: 16px; line-height: 1; }
    .tags-input { flex: 1; min-width: 180px; border: none !important; box-shadow: none !important; outline: none !important; }
    .sector-search-wrapper { position: relative; width: 100%; }
    .sector-dropdown { position: absolute; top: 100%; left: 0; right: 0; background: #fff; border: 1px solid #ddd; border-radius: 7px; margin-top: 4px; max-height: 220px; overflow-y: auto; z-index: 9999; display: none; box-shadow: 0 4px 12px rgba(0,0,0,0.10); }
    .sector-dropdown-item { padding: 10px 13px; font-size: 14px; color: #333; cursor: pointer; border-bottom: 1px solid #f1f1f1; }
    .sector-dropdown-item:hover { background: #f5f8fb; color: #1f4e79; }
    .sector-dropdown-empty { padding: 10px 13px; font-size: 13px; color: #999; }
    .attachment-list { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 15px; }
    .attachment-item { border: 1px solid #ddd; border-radius: 7px; padding: 8px; text-align: center; width: 120px; position: relative; }
    .attachment-item img { width: 100px; height: 70px; object-fit: cover; border-radius: 5px; }
    .attachment-item .attachment-name { font-size: 11px; color: #666; margin-top: 5px; word-break: break-word; }
    .attachment-item .remove-attachment { position: absolute; top: -8px; right: -8px; background: #c0392b; color: #fff; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 12px; cursor: pointer; }
    .btn-submit { min-width: 130px; border: none; background: #1f4e79; color: #fff; padding: 11px 25px; border-radius: 7px; font-size: 13px; font-weight: 700; cursor: pointer; }
    .btn-submit:hover { background: #163a5c; }
    .btn-submit:disabled { opacity: .65; cursor: not-allowed; }
    .file-upload-btn { border: none; background: #1f4e79; color: #fff; padding: 9px 20px; border-radius: 6px; cursor: pointer; font-size: 13px; }
    @media(max-width: 767px) {
        .main-content { padding: 15px; }
        .custom-tabs { display: grid; grid-template-columns: 1fr 1fr; }
        .custom-tabs .nav-link { text-align: center; padding: 10px 6px; font-size: 11px; }
    }
</style>

<div class="col-lg-8 col-md-8 dashboard-main-content">
    <div class="main-content">
        <h5 class="page-title">MANAGE STARTUP INFORMATION</h5>
        <div id="ajaxAlert"></div>

        <ul class="nav custom-tabs" id="confidentialTabs">
            <li class="nav-item"><a href="#" class="nav-link active" data-tab="tab1">Confidential Information</a></li>
            <li class="nav-item"><a href="#" class="nav-link" data-tab="tab2">Advertisement Details</a></li>
            <li class="nav-item"><a href="#" class="nav-link" data-tab="tab3">Business Information</a></li>
            <li class="nav-item"><a href="#" class="nav-link" data-tab="tab4">Financial Details</a></li>
            <li class="nav-item"><a href="#" class="nav-link" data-tab="tab5">Headquarters</a></li>
            <li class="nav-item"><a href="#" class="nav-link" data-tab="tab6">Team Details</a></li>
            <li class="nav-item"><a href="#" class="nav-link" data-tab="tab7">Business Plan</a></li>
            <li class="nav-item"><a href="#" class="nav-link" data-tab="tab8">Requirement</a></li>
            <li class="nav-item"><a href="#" class="nav-link" data-tab="tab9">Attachments</a></li>
        </ul>

        {{-- TAB 1: CONFIDENTIAL INFORMATION --}}
        <div id="tab1" class="tab-content active">
            <form action="{{ route('startup.confidential.ajax.update', $user_rand_id) }}" method="POST" id="confidentialForm">
                @csrf
                <div class="form-group"><label>Your Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ $startup->startup_name ?? '' }}" required></div>
                <div class="form-group"><label>Mobile Number <span class="text-danger">*</span></label>
                    <input type="tel" name="mobile" class="form-control" value="{{ $startup->startup_mobile ?? '' }}" pattern="[0-9]{10}" maxlength="10" inputmode="numeric" title="Enter a 10-digit mobile number" required></div>
                <div class="form-group"><label>Email ID <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ $startup->startup_email ?? '' }}" required></div>
                <button type="submit" class="btn-submit">SUBMIT</button>
            </form>
        </div>

        {{-- TAB 2: ADVERTISEMENT DETAILS --}}
        <div id="tab2" class="tab-content">
            <form action="{{ route('startup.advertisement.ajax.update', $user_rand_id) }}" method="POST" id="advertisementForm">
                @csrf
                <div class="form-group"><label>Advertisement Headline <span class="text-danger">*</span></label>
                    <input type="text" id="advmt_headline" name="advmt_headline" class="form-control" value="{{ $startup->advmt_headline ?? '' }}" required></div>
                <div class="form-group"><label>Introduction</label>
                    <textarea id="startup_intro" name="startup_intro" class="form-control" rows="4">{{ $startup->startup_intro ?? '' }}</textarea></div>
                <button type="submit" class="btn-submit">SUBMIT</button>
            </form>
        </div>

        {{-- TAB 3: BUSINESS INFORMATION --}}
        <div id="tab3" class="tab-content">
            <form action="{{ route('startup.business.ajax.update', $user_rand_id) }}" method="POST" id="businessInfoForm">
                @csrf
                <div class="form-group"><label>Name of Entity <span class="text-danger">*</span></label>
                    <input type="text" id="name_of_entity" name="name_of_entity" class="form-control" value="{{ $startup->name_of_entity ?? '' }}" required></div>
                <div class="form-group"><label>Business Type <span class="text-danger">*</span></label>
                    <select id="business_type" name="business_type" class="form-control" required>
                        <option value="">Select</option>
                        @foreach(config('constants.businessType', []) as $key => $label)
                            <option value="{{ $key }}" {{ ($startup->business_type ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select></div>
                <div class="form-group"><label>Nature of Entity <span class="text-danger">*</span></label>
                    <select id="nature_of_entity" name="nature_of_entity" class="form-control" required>
                        <option value="">Select</option>
                        @foreach(config('constants.entityType', []) as $key => $label)
                            <option value="{{ $key }}" {{ ($startup->nature_of_entity ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select></div>
                <div class="form-group"><label>Industry Sector <span class="text-danger">*</span></label>
                    <select id="industry_sector" name="industry_sector" class="form-control" required>
                        <option value="">Select</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->cat_id }}" {{ ($startup->industry_sector ?? '') == $cat->cat_id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                        @endforeach
                    </select></div>
                <div class="form-group"><label>Establishment Date <span class="text-danger">*</span></label>
                    <select id="estb_date" name="estb_date" class="form-control" required>
                        <option value="">Select Year</option>
                        @for($y = date('Y'); $y >= 1950; $y--)
                            <option value="{{ $y }}" {{ ($startup->estb_date ?? '') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select></div>
                <div class="form-group"><label>Employee Count <span class="text-danger">*</span></label>
                    <select id="emp_count" name="emp_count" class="form-control" required>
                        <option value="">Select</option>
                        @foreach(config('constants.employeeCount', []) as $key => $label)
                            <option value="{{ $key }}" {{ ($startup->emp_count ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select></div>
                <div class="form-group"><label>Business Website</label>
                    <input type="url" id="business_website" name="business_website" class="form-control" placeholder="Enter Website Url" value="{{ $startup->business_website ?? '' }}"></div>
                <div class="form-group"><label>Facilities</label>
                    <textarea id="facilities_desc" name="facilities_desc" class="form-control" rows="3" placeholder="Enter your Business Facilities Ex: Shop, Machine Info">{{ $startup->facilities_desc ?? '' }}</textarea></div>
                <div class="form-section"><h4>Social Media Links</h4></div>
                <div class="form-group"><label>Facebook Link</label>
                    <input type="url" id="facebook_profile" name="facebook_profile" class="form-control" placeholder="Enter Facebook Url" value="{{ $startup->facebook_profile ?? '' }}"></div>
                <div class="form-group"><label>Twitter Link</label>
                    <input type="url" id="twitter_profile" name="twitter_profile" class="form-control" placeholder="Enter Twitter Url" value="{{ $startup->twitter_profile ?? '' }}"></div>
                <div class="form-group"><label>Linkedin Link</label>
                    <input type="url" id="linkedin_profile" name="linkedin_profile" class="form-control" placeholder="Enter Linkedin Url" value="{{ $startup->linkedin_profile ?? '' }}"></div>
                <button type="submit" class="btn-submit">SUBMIT</button>
            </form>
        </div>

        {{-- TAB 4: FINANCIAL DETAILS --}}
        <div id="tab4" class="tab-content">
            <form action="{{ route('startup.financial.ajax.update', $user_rand_id) }}" method="POST" id="financialForm">
                @csrf
                <div class="row">
                    <div class="col-md-4 form-group"><label>Annual Sales <span class="text-danger">*</span></label>
                        <input type="number" id="annual_sales" name="annual_sales" class="form-control" value="{{ $startup->annual_sales ?? '' }}"></div>
                    <div class="col-md-4 form-group"><label>Inventory Value <span class="text-danger">*</span></label>
                        <input type="number" id="inventory_value" name="inventory_value" class="form-control" value="{{ $startup->inventory_value ?? '' }}"></div>
                    <div class="col-md-4 form-group"><label>Gross Income <span class="text-danger">*</span></label>
                        <input type="number" id="gross_profit" name="gross_profit" class="form-control" value="{{ $startup->gross_profit ?? '' }}"></div>
                    <div class="col-md-4 form-group"><label>EBITDA <span class="text-danger">*</span></label>
                        <input type="number" id="ebitda" name="ebitda" class="form-control" value="{{ $startup->ebitda ?? '' }}"></div>
                    <div class="col-md-4 form-group"><label>EBITDA Margin <span class="text-danger">*</span></label>
                        <input type="number" id="ebitda_margin" name="ebitda_margin" class="form-control" value="{{ $startup->ebitda_margin ?? '' }}"></div>
                    <div class="col-md-4 form-group"><label>Rentals <span class="text-danger">*</span></label>
                        <input type="number" id="rentals" name="rentals" class="form-control" value="{{ $startup->rentals ?? '' }}"></div>
                </div>

                <div class="form-group">
                    <label>Fund Raising Information</label>
                    <div id="fundRaisingRows">
                        @forelse($fundRaising as $fund)
                            <div class="repeatable-row">
                                <input type="text" name="fund_stages[]" class="form-control" placeholder="Fund Stage (e.g. Seed Funding)" value="{{ $fund->fund_stage }}">
                                <input type="number" name="fund_amounts[]" class="form-control" placeholder="Amount" value="{{ $fund->fund_amount }}">
                                <span class="remove-row" title="Remove">&times;</span>
                            </div>
                        @empty
                            <div class="repeatable-row">
                                <input type="text" name="fund_stages[]" class="form-control" placeholder="Fund Stage (e.g. Seed Funding)">
                                <input type="number" name="fund_amounts[]" class="form-control" placeholder="Amount">
                                <span class="remove-row" title="Remove">&times;</span>
                            </div>
                        @endforelse
                    </div>
                    <button type="button" class="file-upload-btn" id="addFundRow">+ Add Fund Stage</button>
                </div>
                <button type="submit" class="btn-submit">SUBMIT</button>
            </form>
        </div>

        {{-- TAB 5: HEADQUARTERS --}}
        <div id="tab5" class="tab-content">
            <form action="{{ route('startup.headquarters.ajax.update', $user_rand_id) }}" method="POST" id="headquartersForm">
                @csrf
                <div class="form-group"><label>Address <span class="text-danger">*</span></label>
                    <textarea id="ofc_address" name="ofc_address" class="form-control" rows="3" placeholder="Enter Office Address" required>{{ $startup->ofc_address ?? '' }}</textarea></div>
                <div class="row">
                    <div class="col-md-4 form-group"><label>Country</label>
                        <select id="ofc_country" name="ofc_country" class="form-control">
                            <option value="India" selected>India</option>
                        </select></div>
                    <div class="col-md-4 form-group"><label>State</label>
                        <select id="ofc_state" name="ofc_state" class="form-control">
                            <option value="">Select State</option>
                            @foreach($availableStates as $stateCode => $stateName)
                                <option value="{{ $stateCode }}" {{ ($startup->ofc_state ?? '') == $stateCode ? 'selected' : '' }}>{{ $stateName }}</option>
                            @endforeach
                        </select></div>
                    <div class="col-md-4 form-group"><label>City <span class="text-danger">*</span></label>
                        <select id="ofc_city" name="ofc_city" class="form-control" required>
                            <option value="">Select City</option>
                            @foreach($currentCities as $cityName)
                                <option value="{{ $cityName }}" {{ ($startup->ofc_city ?? '') == $cityName ? 'selected' : '' }}>{{ $cityName }}</option>
                            @endforeach
                            @if(!empty($startup->ofc_city ?? '') && !$currentCities->contains($startup->ofc_city))
                                <option value="{{ $startup->ofc_city }}" selected>{{ $startup->ofc_city }}</option>
                            @endif
                        </select></div>
                </div>
                <div class="form-group"><label>PIN Code <span class="text-danger">*</span></label>
                    <input type="text" id="ofc_pincode" name="ofc_pincode" class="form-control" placeholder="Enter Pin Code" value="{{ $startup->ofc_pincode ?? '' }}" required></div>
                <button type="submit" class="btn-submit">SUBMIT</button>
            </form>
        </div>

        {{-- TAB 6: TEAM DETAILS --}}
        <div id="tab6" class="tab-content">
            <form action="{{ route('startup.team.ajax.update', $user_rand_id) }}" method="POST" id="teamForm">
                @csrf
                <div class="form-group"><label>Name <span class="text-danger">*</span></label>
                    <input type="text" id="director_name" name="director_name" class="form-control" placeholder="Enter Your Name" value="{{ $startup->director_name ?? '' }}" required></div>
                <div class="form-group"><label>Email ID <span class="text-danger">*</span></label>
                    <input type="email" id="director_email" name="director_email" class="form-control" placeholder="Enter Your Email" value="{{ $startup->director_email ?? '' }}" required></div>
                <div class="form-group"><label>Designation <span class="text-danger">*</span></label>
                    <select id="director_designation" name="director_designation" class="form-control" required>
                        <option value="">Select</option>
                        @foreach(config('constants.designationinf', []) as $key => $label)
                            <option value="{{ $key }}" {{ ($startup->director_designation ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select></div>

                <div class="form-section"><h4>Management Team Information</h4></div>
                <div id="teamRows">
                    @forelse($teamMembers as $member)
                        <div class="repeatable-row">
                            <input type="text" name="mgmt_names[]" class="form-control" placeholder="Enter Name" value="{{ $member->mgmt_name }}">
                            <input type="text" name="mgmt_designations[]" class="form-control" placeholder="Enter Designation" value="{{ $member->mgmt_designation }}">
                            <input type="email" name="mgmt_emails[]" class="form-control" placeholder="Enter Email ID" value="{{ $member->mgmt_email }}">
                            <span class="remove-row" title="Remove">&times;</span>
                        </div>
                    @empty
                        <div class="repeatable-row">
                            <input type="text" name="mgmt_names[]" class="form-control" placeholder="Enter Name">
                            <input type="text" name="mgmt_designations[]" class="form-control" placeholder="Enter Designation">
                            <input type="email" name="mgmt_emails[]" class="form-control" placeholder="Enter Email ID">
                            <span class="remove-row" title="Remove">&times;</span>
                        </div>
                    @endforelse
                </div>
                <button type="button" class="file-upload-btn" id="addTeamRow">+ Add Team Member</button>
                <br><br>
                <button type="submit" class="btn-submit">SUBMIT</button>
            </form>
        </div>

        {{-- TAB 7: BUSINESS PLAN --}}
        <div id="tab7" class="tab-content">
            <form action="{{ route('startup.plan.ajax.update', $user_rand_id) }}" method="POST" id="planForm">
                @csrf
                <div class="form-group"><label>Select your Company stage <span class="text-danger">*</span></label>
                    <select id="company_stage" name="company_stage" class="form-control" required>
                        <option value="">Select</option>
                        @foreach(config('constants.companyStage', []) as $key => $label)
                            <option value="{{ $key }}" {{ ($startup->company_stage ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select></div>
                <div class="form-group"><label>Describe the customer problem your start-up will solve <span class="text-danger">*</span></label>
                    <textarea id="customer_problem" name="customer_problem" class="form-control" rows="3" required>{{ $startup->customer_problem ?? '' }}</textarea></div>
                <div class="form-group"><label>Describe the product or service that you will sell <span class="text-danger">*</span></label>
                    <textarea id="product_service" name="product_service" class="form-control" rows="3" required>{{ $startup->product_service ?? '' }}</textarea></div>
                <div class="form-group"><label>Describe your target customer segment <span class="text-danger">*</span></label>
                    <textarea id="customer_segment" name="customer_segment" class="form-control" rows="3" required>{{ $startup->customer_segment ?? '' }}</textarea></div>
                <div class="form-group"><label>Describe your target market <span class="text-danger">*</span></label>
                    <textarea id="target_market" name="target_market" class="form-control" rows="3" required>{{ $startup->target_market ?? '' }}</textarea></div>
                <div class="form-group"><label>Competitors</label>
                    <textarea id="competitors" name="competitors" class="form-control" rows="2">{{ $startup->competitors ?? '' }}</textarea></div>
                <div class="form-group"><label>Competitive Advantage</label>
                    <textarea id="competitive_advantage" name="competitive_advantage" class="form-control" rows="2">{{ $startup->competitive_advantage ?? '' }}</textarea></div>
                <div class="form-group"><label>Sales & Marketing Strategy</label>
                    <textarea id="sales_marketing" name="sales_marketing" class="form-control" rows="2">{{ $startup->sales_marketing ?? '' }}</textarea></div>
                <div class="form-group"><label>Company Summary</label>
                    <textarea id="company_summary" name="company_summary" class="form-control" rows="2">{{ $startup->company_summary ?? '' }}</textarea></div>
                <div class="form-group"><label>One line pitch for your business</label>
                    <textarea id="business_pitch" name="business_pitch" class="form-control" rows="2">{{ $startup->business_pitch ?? '' }}</textarea></div>
                <button type="submit" class="btn-submit">SUBMIT</button>
            </form>
        </div>

        {{-- TAB 8: REQUIREMENT --}}
        <div id="tab8" class="tab-content">
            <form action="{{ route('startup.requirement.ajax.update', $user_rand_id) }}" method="POST" id="requirementForm">
                @csrf
                <div class="form-group">
                    <label>I am looking for</label>
                    <div class="preference-checkboxes">
                        <label class="checkbox-group"><input type="checkbox" name="seeking_investors" id="seeking_investors" value="1" {{ ($startup->seeking_investors ?? 0) == 1 ? 'checked' : '' }}> <span>Investors for my business</span></label>
                        <label class="checkbox-group"><input type="checkbox" name="seeking_mentorship" id="seeking_mentorship" value="1" {{ ($startup->seeking_mentorship ?? 0) == 1 ? 'checked' : '' }}> <span>Mentorship for my business</span></label>
                        <label class="checkbox-group"><input type="checkbox" name="seeking_acquirers" id="seeking_acquirers" value="1" {{ ($startup->seeking_acquirers ?? 0) == 1 ? 'checked' : '' }}> <span>Acquirers for my startup</span></label>
                        <label class="checkbox-group"><input type="checkbox" name="seeking_loan" id="seeking_loan" value="1" {{ ($startup->seeking_loan ?? 0) == 1 ? 'checked' : '' }}> <span>Loan for my business</span></label>
                        <label class="checkbox-group"><input type="checkbox" name="seeking_incubators" id="seeking_incubators" value="1" {{ ($startup->seeking_incubators ?? 0) == 1 ? 'checked' : '' }}> <span>Incubators / Accelerators for my startup</span></label>
                    </div>
                </div>

                <div id="investorSection" class="form-section-wrap" style="{{ ($startup->seeking_investors ?? 0) == 1 ? '' : 'display:none;' }}">
                    <div class="form-section"><h4>For Investor Search</h4></div>
                    <div class="form-group"><label>Amount of investment you are looking for</label>
                        <input type="number" id="inv_asking_price" name="inv_asking_price" class="form-control" value="{{ $startup->inv_asking_price ?? '' }}"></div>
                    <div class="form-group"><label>Business stake of the investment</label>
                        <input type="text" id="inv_stake" name="inv_stake" class="form-control" placeholder="Enter Stake" value="{{ $startup->inv_stake ?? '' }}"></div>
                    <div class="form-group"><label>Reason for investment</label>
                        <input type="text" id="inv_reason" name="inv_reason" class="form-control" placeholder="Enter Your Reason for Investment" value="{{ $startup->inv_reason ?? '' }}"></div>
                </div>

                <div id="loanSection" class="form-section-wrap" style="{{ ($startup->seeking_loan ?? 0) == 1 ? '' : 'display:none;' }}">
                    <div class="form-section"><h4>For Loans Seeking</h4></div>
                    <div class="form-group"><label>Collateral details</label>
                        <input type="text" id="loan_collateral_details" name="loan_collateral_details" class="form-control" placeholder="Enter details" value="{{ $startup->loan_collateral_details ?? '' }}"></div>
                    <div class="form-group"><label>Loan amount seeking</label>
                        <input type="number" id="loan_amount" name="loan_amount" class="form-control" value="{{ $startup->loan_amount ?? '' }}"></div>
                    <div class="form-group"><label>Possible repayment period</label>
                        <select id="loan_repayment_period" name="loan_repayment_period" class="form-control">
                            <option value="">Select</option>
                            @foreach(config('constants.loanRepaymentPeriod', []) as $key => $label)
                                <option value="{{ $key }}" {{ ($startup->loan_repayment_period ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select></div>
                    <div class="form-group"><label>Expected Interest Rate</label>
                        <input type="text" id="loan_interest_rate" name="loan_interest_rate" class="form-control" placeholder="e.g. 10%" value="{{ $startup->loan_interest_rate ?? '' }}"></div>
                    <div class="form-group"><label>Reason for loan</label>
                        <input type="text" id="loan_reason" name="loan_reason" class="form-control" placeholder="Enter Reason" value="{{ $startup->loan_reason ?? '' }}"></div>
                </div>

                <div id="acquirersSection" class="form-section-wrap" style="{{ ($startup->seeking_acquirers ?? 0) == 1 ? '' : 'display:none;' }}">
                    <div class="form-section"><h4>For Acquirers</h4></div>
                    <div class="form-group"><label>Selling (Asking) Price</label>
                        <input type="number" id="buyer_sell_price" name="buyer_sell_price" class="form-control" value="{{ $startup->buyer_sell_price ?? '' }}"></div>
                    <div class="form-group"><label>Reason for Selling</label>
                        <input type="text" id="buyer_sell_reason" name="buyer_sell_reason" class="form-control" placeholder="Enter Your Reason for selling" value="{{ $startup->buyer_sell_reason ?? '' }}"></div>
                </div>

                <div id="mentorSection" class="form-section-wrap" style="{{ ($startup->seeking_mentorship ?? 0) == 1 ? '' : 'display:none;' }}">
                    <div class="form-section"><h4>For Mentor Search</h4></div>
                    <div class="form-group"><label>Mentorship Requirement Details</label>
                        <textarea id="mentor_req_details" name="mentor_req_details" class="form-control" rows="2">{{ $startup->mentor_req_details ?? '' }}</textarea></div>
                    <div class="form-group"><label>Field of Mentorship</label>
                        <div class="sector-search-wrapper">
                            <div class="tags-container" id="mentorTagsContainer">
                                @foreach($mentorSectors as $item)
                                    <span class="tag-item" data-tag="{{ $item->name }}"><span>{{ $item->name }}</span><span class="remove-tag">&times;</span></span>
                                @endforeach
                                <input type="text" class="tags-input" id="mentorTagsInput" placeholder="Search sector..." autocomplete="off">
                                <input type="hidden" name="mentor_sectors" id="mentor_sectors" value="{{ $mentorSectors->pluck('name')->implode(',') }}">
                            </div>
                            <div id="mentorSectorDropdown" class="sector-dropdown"></div>
                        </div></div>
                </div>

                <div id="incubatorSection" class="form-section-wrap" style="{{ ($startup->seeking_incubators ?? 0) == 1 ? '' : 'display:none;' }}">
                    <div class="form-section"><h4>For Incubators / Accelerator</h4></div>
                    <div class="form-group"><label>Accelerator requirement details</label>
                        <input type="text" id="accel_req_details" name="accel_req_details" class="form-control" placeholder="Enter your Req" value="{{ $startup->accel_req_details ?? '' }}"></div>
                    <div class="form-group"><label>Investment Requirement</label>
                        <input type="number" id="accel_inv_req" name="accel_inv_req" class="form-control" value="{{ $startup->accel_inv_req ?? '' }}"></div>
                    <div class="form-group"><label>Field of support needed</label>
                        <div class="sector-search-wrapper">
                            <div class="tags-container" id="incubatorTagsContainer">
                                @foreach($incubatorSectors as $item)
                                    <span class="tag-item" data-tag="{{ $item->name }}"><span>{{ $item->name }}</span><span class="remove-tag">&times;</span></span>
                                @endforeach
                                <input type="text" class="tags-input" id="incubatorTagsInput" placeholder="Search sector..." autocomplete="off">
                                <input type="hidden" name="incubator_sectors" id="incubator_sectors" value="{{ $incubatorSectors->pluck('name')->implode(',') }}">
                            </div>
                            <div id="incubatorSectorDropdown" class="sector-dropdown"></div>
                        </div></div>
                    <div class="form-group"><label>Time period of support needed</label>
                        <input type="text" id="accel_time_period" name="accel_time_period" class="form-control" value="{{ $startup->accel_time_period ?? '' }}"></div>
                </div>

                <button type="submit" class="btn-submit">SUBMIT</button>
            </form>
        </div>

        {{-- TAB 9: ATTACHMENTS --}}
        <div id="tab9" class="tab-content">
            <div class="form-group">
                <label>Business Photo:</label>
                <div class="attachment-list" id="imageList">
                    @foreach($images as $img)
                        <div class="attachment-item" data-id="{{ $img->startup_image_id }}">
                            <img src="{{ asset($img->startup_img_path) }}" alt="photo">
                            <div class="attachment-name">{{ $img->startup_img_name }}</div>
                            <span class="remove-attachment" data-id="{{ $img->startup_image_id }}">&times;</span>
                        </div>
                    @endforeach
                </div>
                @for($i = 1; $i <= 5; $i++)
                    <div class="accepted-formats" style="font-size:12px;color:#888;margin-bottom:4px;">Accepted formats - png, jpeg, gif</div>
                    <input type="file" name="business_photos[]" class="form-control photo-input" accept=".png,.jpg,.jpeg,.gif" style="margin-bottom:14px;">
                @endfor
            </div>

            <div class="form-group" style="margin-top:25px;">
                <label>Business Documents:</label>
                <div class="attachment-list" id="documentList">
                    @foreach($documents as $doc)
                        <div class="attachment-item" data-id="{{ $doc->startup_image_id }}">
                            <div class="attachment-name">{{ $doc->startup_img_name }}</div>
                            <span class="remove-attachment" data-id="{{ $doc->startup_image_id }}">&times;</span>
                        </div>
                    @endforeach
                </div>
                @for($i = 1; $i <= 5; $i++)
                    <div class="accepted-formats" style="font-size:12px;color:#888;margin-bottom:4px;">Accepted formats - Word Document, Excel & PDF</div>
                    <input type="file" name="business_documents[]" class="form-control document-input" accept=".doc,.docx,.xls,.xlsx,.pdf" style="margin-bottom:14px;">
                @endfor
            </div>

            <button type="button" class="btn-submit" id="uploadAttachmentsBtn" style="margin-top:20px;">UPLOAD</button>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

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

    function setButtonLoading(button, loading) {
        if (!button) return;
        if (loading) {
            button.dataset.oldText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = 'Saving...';
        } else {
            button.disabled = false;
            button.innerHTML = button.dataset.oldText || 'SUBMIT';
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
            if (!response.ok || !data.status) {
                showMessage(data.message || 'Something went wrong.', 'danger');
                return null;
            }
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
        tabContents.forEach(function (c) { c.classList.remove('active'); c.style.display = 'none'; });
        tabLinks.forEach(function (l) { l.classList.remove('active'); });
        const content = document.getElementById(tabId);
        const link = document.querySelector('#confidentialTabs .nav-link[data-tab="' + tabId + '"]');
        if (content) { content.classList.add('active'); content.style.display = 'block'; }
        if (link) link.classList.add('active');
    }

    tabLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const tabId = this.getAttribute('data-tab');
            if (tabId) activateTab(tabId);
        });
    });
    activateTab('tab1');

    // ============ Fund Raising repeatable rows ============
    document.getElementById('addFundRow')?.addEventListener('click', function () {
        const container = document.getElementById('fundRaisingRows');
        const row = document.createElement('div');
        row.className = 'repeatable-row';
        row.innerHTML = '<input type="text" name="fund_stages[]" class="form-control" placeholder="Fund Stage (e.g. Seed Funding)">' +
            '<input type="number" name="fund_amounts[]" class="form-control" placeholder="Amount">' +
            '<span class="remove-row" title="Remove">&times;</span>';
        container.appendChild(row);
        row.querySelector('.remove-row').addEventListener('click', function () {
            if (document.querySelectorAll('#fundRaisingRows .repeatable-row').length > 1) row.remove();
        });
    });
    document.querySelectorAll('#fundRaisingRows .remove-row').forEach(function (btn) {
        btn.addEventListener('click', function () {
            if (document.querySelectorAll('#fundRaisingRows .repeatable-row').length > 1) btn.closest('.repeatable-row').remove();
        });
    });

    // ============ Team repeatable rows ============
    document.getElementById('addTeamRow')?.addEventListener('click', function () {
        const container = document.getElementById('teamRows');
        const row = document.createElement('div');
        row.className = 'repeatable-row';
        row.innerHTML = '<input type="text" name="mgmt_names[]" class="form-control" placeholder="Enter Name">' +
            '<input type="text" name="mgmt_designations[]" class="form-control" placeholder="Enter Designation">' +
            '<input type="email" name="mgmt_emails[]" class="form-control" placeholder="Enter Email ID">' +
            '<span class="remove-row" title="Remove">&times;</span>';
        container.appendChild(row);
        row.querySelector('.remove-row').addEventListener('click', function () {
            if (document.querySelectorAll('#teamRows .repeatable-row').length > 1) row.remove();
        });
    });
    document.querySelectorAll('#teamRows .remove-row').forEach(function (btn) {
        btn.addEventListener('click', function () {
            if (document.querySelectorAll('#teamRows .repeatable-row').length > 1) btn.closest('.repeatable-row').remove();
        });
    });

    // ============ Requirement checkboxes toggle sections ============
    function bindToggle(checkboxId, sectionId) {
        const checkbox = document.getElementById(checkboxId);
        const section = document.getElementById(sectionId);
        if (!checkbox || !section) return;
        checkbox.addEventListener('change', function () {
            section.style.display = checkbox.checked ? 'block' : 'none';
        });
    }
    bindToggle('seeking_investors', 'investorSection');
    bindToggle('seeking_loan', 'loanSection');
    bindToggle('seeking_acquirers', 'acquirersSection');
    bindToggle('seeking_mentorship', 'mentorSection');
    bindToggle('seeking_incubators', 'incubatorSection');

    // ============ Tag inputs (Mentor / Incubator sectors) ============
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

    function setupSectorSearch(inputId, dropdownId, containerId, hiddenId) {
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
                const response = await fetch(@json(route('preferences.ajax.sectors')) + '?search=' + encodeURIComponent(text), {
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
    setupSectorSearch('mentorTagsInput', 'mentorSectorDropdown', 'mentorTagsContainer', 'mentor_sectors');
    setupSectorSearch('incubatorTagsInput', 'incubatorSectorDropdown', 'incubatorTagsContainer', 'incubator_sectors');

    // ============ Attachments (5 individual photo inputs + 5 individual document inputs) ============
    document.getElementById('uploadAttachmentsBtn')?.addEventListener('click', async function () {
        const photoInputs = Array.from(document.querySelectorAll('.photo-input')).filter(function (i) { return i.files.length > 0; });
        const documentInputs = Array.from(document.querySelectorAll('.document-input')).filter(function (i) { return i.files.length > 0; });

        if (!photoInputs.length && !documentInputs.length) {
            showMessage('Choose at least one photo or document first.', 'danger');
            return;
        }

        const formData = new FormData();
        photoInputs.forEach(function (input) { formData.append('business_photos[]', input.files[0]); });
        documentInputs.forEach(function (input) { formData.append('business_documents[]', input.files[0]); });

        setButtonLoading(this, true);
        try {
            const response = await fetch(@json(route('startup.attachments.ajax.update', $user_rand_id)), {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: formData
            });
            const data = await response.json();
            if (!response.ok || !data.status) {
                showMessage(data.message || 'Upload failed.', 'danger');
                return;
            }
            showMessage('Attachments uploaded successfully.', 'success');
            document.querySelectorAll('.photo-input, .document-input').forEach(function (input) { input.value = ''; });
            await loadAttachments();
        } catch (error) {
            console.error('UPLOAD ERROR:', error);
            showMessage('Server error during upload.', 'danger');
        } finally {
            setButtonLoading(this, false);
        }
    });

    async function loadAttachments() {
        const data = await getData(@json(route('startup.attachments.ajax.get', $user_rand_id)));
        if (!data) return;
        const imageList = document.getElementById('imageList');
        const documentList = document.getElementById('documentList');
        imageList.innerHTML = '';
        documentList.innerHTML = '';
        (data.data.images || []).forEach(function (img) {
            imageList.innerHTML += '<div class="attachment-item" data-id="' + img.id + '"><img src="' + img.url + '" alt="photo"><div class="attachment-name">' + (img.name || '') + '</div><span class="remove-attachment" data-id="' + img.id + '">&times;</span></div>';
        });
        (data.data.documents || []).forEach(function (doc) {
            documentList.innerHTML += '<div class="attachment-item" data-id="' + doc.id + '"><div class="attachment-name">' + (doc.name || '') + '</div><span class="remove-attachment" data-id="' + doc.id + '">&times;</span></div>';
        });
        bindRemoveAttachmentButtons();
    }

    function bindRemoveAttachmentButtons() {
        document.querySelectorAll('.remove-attachment').forEach(function (btn) {
            btn.addEventListener('click', async function () {
                const id = this.dataset.id;
                const url = @json(route('startup.attachments.ajax.delete', 999999)).replace('999999', id);
                try {
                    await fetch(url, {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    this.closest('.attachment-item').remove();
                } catch (error) {
                    console.error('DELETE ERROR:', error);
                }
            });
        });
    }
    bindRemoveAttachmentButtons();

    // ============ Form submit bindings ============
    function bindFormSubmit(formId) {
        const form = document.getElementById(formId);
        if (!form) return;
        form.addEventListener('submit', async function (event) {
            event.preventDefault();
            const button = this.querySelector('button[type="submit"]');
            await submitForm(this, this.action, button);
        });
    }
    ['confidentialForm', 'advertisementForm', 'businessInfoForm', 'financialForm', 'headquartersForm', 'teamForm', 'planForm', 'requirementForm'].forEach(bindFormSubmit);

    // ============ Headquarters: State -> City dependent dropdown ============
    const stateSelect = document.getElementById('ofc_state');
    const citySelect = document.getElementById('ofc_city');
    if (stateSelect && citySelect) {
        stateSelect.addEventListener('change', function () {
            const stateCode = this.value;
            citySelect.innerHTML = '<option value="">Loading...</option>';
            if (!stateCode) {
                citySelect.innerHTML = '<option value="">Select City</option>';
                return;
            }
            fetch('{{ url("/dashboard/startupConfidentials/cities-by-state") }}/' + stateCode, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(function (res) { return res.json(); })
                .then(function (data) {
                    const cities = (data && data.cities) ? data.cities : [];
                    citySelect.innerHTML = '<option value="">Select City</option>' +
                        cities.map(function (city) {
                            return '<option value="' + city + '">' + city + '</option>';
                        }).join('');
                })
                .catch(function () {
                    citySelect.innerHTML = '<option value="">Select City</option>';
                });
        });
    }
});
</script>
@endpush
