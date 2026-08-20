<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAccount;
use App\Models\ProfileStartup;
use App\Models\ProfileStartupMgmt;
use App\Models\ProfileStartupFundRaising;
use App\Models\StartupImage;
use App\Models\IndPrefMentorStartup;
use App\Models\IndPrefIncubatorStartup;
use App\Models\IndustryCategory;
use App\Models\BxCity;

require_once app_path('Helpers/common_helper.php');

class StartupController extends Controller
{
    /**
     * Manage Startup Information page — 9 tabs (Confidential / Advertisement /
     * Business Information / Financial Details / Headquarters / Team Details /
     * Business Plan / Requirement / Attachments), ported from the old site's
     * startupConfidentials/startupAdvertisement/.../startupAttachment pages.
     */
    public function edit($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findStartup($user_rand_id, $user->user_id);

        $teamMembers = collect();
        $fundRaising = collect();
        $mentorSectors = collect();
        $incubatorSectors = collect();
        $images = collect();
        $documents = collect();

        if ($startup) {
            $teamMembers = ProfileStartupMgmt::where('startup_profile_id', $startup->startup_id)->get();
            $fundRaising = ProfileStartupFundRaising::where('startup_profile_id', $startup->startup_id)->get();

            $mentorSectors = IndPrefMentorStartup::join('industry_categories', 'ind_pref_mentor_startup.sub_category_id', '=', 'industry_categories.cat_id')
                ->where('ind_pref_mentor_startup.startup_profile_id', $startup->startup_id)
                ->select('industry_categories.cat_id as id', 'industry_categories.category_name as name', 'industry_categories.parent_id as pid')
                ->get();

            $incubatorSectors = IndPrefIncubatorStartup::join('industry_categories', 'ind_pref_incubator_startup.sub_category_id', '=', 'industry_categories.cat_id')
                ->where('ind_pref_incubator_startup.startup_profile_id', $startup->startup_id)
                ->select('industry_categories.cat_id as id', 'industry_categories.category_name as name', 'industry_categories.parent_id as pid')
                ->get();

            $images = StartupImage::where('startup_id', $startup->startup_id)->where('type', 1)->get();
            $documents = StartupImage::where('startup_id', $startup->startup_id)->where('type', 2)->get();
        }

        $categories = IndustryCategory::select('cat_id', 'category_name', 'parent_id')->orderBy('category_name')->get();

        // State dropdown only lists states that actually have cities in
        // bx_cities (it's sparse — not every Indian state is populated),
        // and City is pre-loaded for whichever state is currently saved.
        $availableStates = getAvailableStatesFromCities();
        $currentCities = collect();
        if ($startup && !empty($startup->ofc_state)) {
            $stateName = config('constants.statesIndia.' . $startup->ofc_state, $startup->ofc_state);
            $currentCities = BxCity::where('state', $stateName)->orderBy('city')->pluck('city');
        }

        return view('account_dashboard.startupConfidentials', compact(
            'user', 'startup', 'teamMembers', 'fundRaising', 'mentorSectors', 'incubatorSectors', 'images', 'documents', 'categories', 'currentCities', 'availableStates'
        ));
    }

    /**
     * City dropdown options for the given state (State -> City dependent
     * dropdown on the Headquarters tab). $stateCode is a statesIndia key
     * (e.g. "MH"); bx_cities stores the full state name, so it's resolved
     * before querying.
     */
    public function getCitiesByState($stateCode)
    {
        $stateName = config('constants.statesIndia.' . $stateCode, $stateCode);
        $cities = BxCity::where('state', $stateName)->orderBy('city')->pluck('city');

        return response()->json(['status' => true, 'cities' => $cities]);
    }

    public function getConfidentialInfo($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findStartup($user_rand_id, $user->user_id);
        return response()->json([
            'status' => true,
            'data' => [
                'name' => $startup->startup_name ?? '',
                'mobile' => $startup->startup_mobile ?? '',
                'email' => $startup->startup_email ?? '',
            ]
        ]);
    }

    public function updateConfidentialInfo(Request $request, $user_rand_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findOrNewStartup($user_rand_id, $user);
        $startup->startup_name = $request->name;
        $startup->startup_mobile = $request->mobile;
        $startup->startup_email = $request->email;
        $startup->save();

        return response()->json([
            'status' => true,
            'message' => 'Information updated successfully!',
            'data' => $startup->only(['startup_name', 'startup_mobile', 'startup_email']),
        ]);
    }

    public function getAdvertisementDetails($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findStartup($user_rand_id, $user->user_id);
        return response()->json([
            'status' => true,
            'data' => [
                'advmt_headline' => $startup->advmt_headline ?? '',
                'startup_intro' => $startup->startup_intro ?? '',
            ]
        ]);
    }

    public function updateAdvertisementDetails(Request $request, $user_rand_id)
    {
        $request->validate([
            'advmt_headline' => 'required|string|max:255',
            'startup_intro' => 'nullable|string|max:255',
        ]);
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findOrNewStartup($user_rand_id, $user);
        $startup->advmt_headline = $request->advmt_headline;
        $startup->startup_intro = $request->startup_intro ?? '';
        $startup->save();

        return response()->json([
            'status' => true,
            'message' => 'Advertisement details saved successfully.',
            'data' => ['advmt_headline' => $startup->advmt_headline, 'startup_intro' => $startup->startup_intro],
        ]);
    }

    public function getBusinessInfo($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findStartup($user_rand_id, $user->user_id);
        return response()->json([
            'status' => true,
            'data' => [
                'name_of_entity' => $startup->name_of_entity ?? '',
                'business_type' => $startup->business_type ?? '',
                'nature_of_entity' => $startup->nature_of_entity ?? '',
                'industry_sector' => $startup->industry_sector ?? '',
                'estb_date' => $startup->estb_date ?? '',
                'emp_count' => $startup->emp_count ?? '',
                'business_website' => $startup->business_website ?? '',
                'facilities_desc' => $startup->facilities_desc ?? '',
                'facebook_profile' => $startup->facebook_profile ?? '',
                'twitter_profile' => $startup->twitter_profile ?? '',
                'linkedin_profile' => $startup->linkedin_profile ?? '',
            ]
        ]);
    }

    public function updateBusinessInfo(Request $request, $user_rand_id)
    {
        $request->validate([
            'name_of_entity' => 'required|string|max:255',
            'business_type' => 'required',
            'nature_of_entity' => 'required',
            'industry_sector' => 'required',
            'estb_date' => 'required',
            'emp_count' => 'required',
            'business_website' => 'nullable|url|max:255',
            'facebook_profile' => 'nullable|url|max:255',
            'twitter_profile' => 'nullable|url|max:255',
            'linkedin_profile' => 'nullable|url|max:255',
        ]);
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findOrNewStartup($user_rand_id, $user);

        $startup->name_of_entity = $request->name_of_entity;
        $startup->business_type = $request->business_type;
        $startup->nature_of_entity = $request->nature_of_entity;
        $startup->industry_sector = $request->industry_sector;
        $startup->estb_date = $request->estb_date;
        $startup->emp_count = $request->emp_count;
        $startup->business_website = $request->business_website;
        $startup->facilities_desc = $request->facilities_desc;
        $startup->facebook_profile = $request->facebook_profile;
        $startup->twitter_profile = $request->twitter_profile;
        $startup->linkedin_profile = $request->linkedin_profile;
        $startup->save();

        return response()->json(['status' => true, 'message' => 'Business information saved successfully.']);
    }

    public function getFinancialDetails($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findStartup($user_rand_id, $user->user_id);
        $fundRaising = collect();
        if ($startup) {
            $fundRaising = ProfileStartupFundRaising::where('startup_profile_id', $startup->startup_id)
                ->get(['startup_fund_id', 'fund_stage', 'fund_amount']);
        }
        return response()->json([
            'status' => true,
            'data' => [
                'annual_sales' => $startup->annual_sales ?? '',
                'inventory_value' => $startup->inventory_value ?? '',
                'gross_profit' => $startup->gross_profit ?? '',
                'ebitda' => $startup->ebitda ?? '',
                'ebitda_margin' => $startup->ebitda_margin ?? '',
                'rentals' => $startup->rentals ?? '',
                'fund_raising' => $fundRaising,
            ]
        ]);
    }

    public function updateFinancialDetails(Request $request, $user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findOrNewStartup($user_rand_id, $user);

        $startup->annual_sales = $request->input('annual_sales') ?: 0;
        $startup->inventory_value = $request->input('inventory_value') ?: 0;
        $startup->gross_profit = $request->input('gross_profit') ?: 0;
        $startup->ebitda = $request->input('ebitda') ?: 0;
        $startup->ebitda_margin = $request->input('ebitda_margin') ?: 0;
        $startup->rentals = $request->input('rentals') ?: 0;
        $startup->save();

        // Fund raising rows — full replace, same pattern as Mentor's Professional Experience.
        $fundStages = (array) $request->input('fund_stages', []);
        $fundAmounts = (array) $request->input('fund_amounts', []);
        ProfileStartupFundRaising::where('startup_profile_id', $startup->startup_id)->delete();
        foreach ($fundStages as $index => $stage) {
            $amount = $fundAmounts[$index] ?? null;
            if (empty($stage) && empty($amount)) {
                continue;
            }
            $row = new ProfileStartupFundRaising();
            $row->startup_profile_id = $startup->startup_id;
            $row->user_id = $startup->user_id;
            $row->fund_stage = $stage;
            $row->fund_amount = $amount ?: 0;
            $row->save();
        }

        return response()->json(['status' => true, 'message' => 'Financial details saved successfully.']);
    }

    public function getHeadquarters($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findStartup($user_rand_id, $user->user_id);
        return response()->json([
            'status' => true,
            'data' => [
                'ofc_address' => $startup->ofc_address ?? '',
                'ofc_city' => $startup->ofc_city ?? '',
                'ofc_state' => $startup->ofc_state ?? '',
                'ofc_country' => $startup->ofc_country ?? '',
                'ofc_pincode' => $startup->ofc_pincode ?? '',
            ]
        ]);
    }

    public function updateHeadquarters(Request $request, $user_rand_id)
    {
        $request->validate([
            'ofc_address' => 'required|string',
            'ofc_city' => 'required|string|max:255',
            'ofc_pincode' => 'required|string|max:15',
        ]);
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findOrNewStartup($user_rand_id, $user);

        $startup->ofc_address = $request->ofc_address;
        $startup->ofc_city = $request->ofc_city;
        $startup->ofc_state = $request->ofc_state;
        $startup->ofc_country = $request->ofc_country;
        $startup->ofc_pincode = $request->ofc_pincode;
        $startup->save();

        return response()->json(['status' => true, 'message' => 'Headquarters / location saved successfully.']);
    }

    public function getTeamDetails($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findStartup($user_rand_id, $user->user_id);
        $teamMembers = collect();
        if ($startup) {
            $teamMembers = ProfileStartupMgmt::where('startup_profile_id', $startup->startup_id)
                ->get(['startup_mgmt_id', 'mgmt_name', 'mgmt_designation', 'mgmt_email']);
        }
        return response()->json([
            'status' => true,
            'data' => [
                'director_name' => $startup->director_name ?? '',
                'director_email' => $startup->director_email ?? '',
                'director_designation' => $startup->director_designation ?? '',
                'team' => $teamMembers,
            ]
        ]);
    }

    public function updateTeamDetails(Request $request, $user_rand_id)
    {
        $request->validate([
            'director_name' => 'required|string|max:255',
            'director_email' => 'required|email|max:255',
            'director_designation' => 'required',
        ]);
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findOrNewStartup($user_rand_id, $user);

        $startup->director_name = $request->director_name;
        $startup->director_email = $request->director_email;
        $startup->director_designation = $request->director_designation;
        $startup->save();

        // Management team rows — full replace.
        $names = (array) $request->input('mgmt_names', []);
        $designations = (array) $request->input('mgmt_designations', []);
        $emails = (array) $request->input('mgmt_emails', []);
        ProfileStartupMgmt::where('startup_profile_id', $startup->startup_id)->delete();
        foreach ($names as $index => $name) {
            $designation = $designations[$index] ?? '';
            $email = $emails[$index] ?? '';
            if (empty($name) && empty($email)) {
                continue;
            }
            $row = new ProfileStartupMgmt();
            $row->startup_profile_id = $startup->startup_id;
            $row->user_id = $startup->user_id;
            $row->mgmt_name = $name;
            $row->mgmt_designation = $designation;
            $row->mgmt_email = $email;
            $row->save();
        }

        return response()->json(['status' => true, 'message' => 'Team details saved successfully.']);
    }

    public function getBusinessPlan($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findStartup($user_rand_id, $user->user_id);
        return response()->json([
            'status' => true,
            'data' => [
                'company_stage' => $startup->company_stage ?? '',
                'customer_problem' => $startup->customer_problem ?? '',
                'product_service' => $startup->product_service ?? '',
                'customer_segment' => $startup->customer_segment ?? '',
                'target_market' => $startup->target_market ?? '',
                'competitors' => $startup->competitors ?? '',
                'competitive_advantage' => $startup->competitive_advantage ?? '',
                'sales_marketing' => $startup->sales_marketing ?? '',
                'company_summary' => $startup->company_summary ?? '',
                'business_pitch' => $startup->business_pitch ?? '',
            ]
        ]);
    }

    public function updateBusinessPlan(Request $request, $user_rand_id)
    {
        $request->validate([
            'company_stage' => 'required',
            'customer_problem' => 'required|string',
            'product_service' => 'required|string',
            'customer_segment' => 'required|string',
            'target_market' => 'required|string',
        ]);
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findOrNewStartup($user_rand_id, $user);

        $startup->company_stage = $request->company_stage;
        $startup->customer_problem = $request->customer_problem;
        $startup->product_service = $request->product_service;
        $startup->customer_segment = $request->customer_segment;
        $startup->target_market = $request->target_market;
        $startup->competitors = $request->competitors;
        $startup->competitive_advantage = $request->competitive_advantage;
        $startup->sales_marketing = $request->sales_marketing;
        $startup->company_summary = $request->company_summary;
        $startup->business_pitch = $request->business_pitch;
        $startup->save();

        return response()->json(['status' => true, 'message' => 'Business plan saved successfully.']);
    }

    public function getRequirement($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findStartup($user_rand_id, $user->user_id);

        $mentorSectors = collect();
        $incubatorSectors = collect();
        if ($startup) {
            $mentorSectors = IndPrefMentorStartup::join('industry_categories', 'ind_pref_mentor_startup.sub_category_id', '=', 'industry_categories.cat_id')
                ->where('ind_pref_mentor_startup.startup_profile_id', $startup->startup_id)
                ->select('industry_categories.cat_id as id', 'industry_categories.category_name as name')
                ->get();
            $incubatorSectors = IndPrefIncubatorStartup::join('industry_categories', 'ind_pref_incubator_startup.sub_category_id', '=', 'industry_categories.cat_id')
                ->where('ind_pref_incubator_startup.startup_profile_id', $startup->startup_id)
                ->select('industry_categories.cat_id as id', 'industry_categories.category_name as name')
                ->get();
        }

        return response()->json([
            'status' => true,
            'data' => [
                'seeking_investors' => (int) ($startup->seeking_investors ?? 0),
                'seeking_mentorship' => (int) ($startup->seeking_mentorship ?? 0),
                'seeking_loan' => (int) ($startup->seeking_loan ?? 0),
                'seeking_acquirers' => (int) ($startup->seeking_acquirers ?? 0),
                'seeking_incubators' => (int) ($startup->seeking_incubators ?? 0),
                'inv_asking_price' => $startup->inv_asking_price ?? '',
                'inv_stake' => $startup->inv_stake ?? '',
                'inv_reason' => $startup->inv_reason ?? '',
                'loan_collateral_details' => $startup->loan_collateral_details ?? '',
                'loan_amount' => $startup->loan_amount ?? '',
                'loan_repayment_period' => $startup->loan_repayment_period ?? '',
                'loan_interest_rate' => $startup->loan_interest_rate ?? '',
                'loan_reason' => $startup->loan_reason ?? '',
                'buyer_sell_price' => $startup->buyer_sell_price ?? '',
                'buyer_sell_reason' => $startup->buyer_sell_reason ?? '',
                'mentor_req_details' => $startup->mentor_req_details ?? '',
                'mentor_sectors' => $mentorSectors,
                'accel_req_details' => $startup->accel_req_details ?? '',
                'accel_inv_req' => $startup->accel_inv_req ?? '',
                'accel_time_period' => $startup->accel_time_period ?? '',
                'incubator_sectors' => $incubatorSectors,
            ]
        ]);
    }

    public function updateRequirement(Request $request, $user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findOrNewStartup($user_rand_id, $user);

        $seekingInvestors = $request->boolean('seeking_investors');
        $seekingMentorship = $request->boolean('seeking_mentorship');
        $seekingLoan = $request->boolean('seeking_loan');
        $seekingAcquirers = $request->boolean('seeking_acquirers');
        $seekingIncubators = $request->boolean('seeking_incubators');

        $startup->seeking_investors = $seekingInvestors ? 1 : 0;
        $startup->seeking_mentorship = $seekingMentorship ? 1 : 0;
        $startup->seeking_loan = $seekingLoan ? 1 : 0;
        $startup->seeking_acquirers = $seekingAcquirers ? 1 : 0;
        $startup->seeking_incubators = $seekingIncubators ? 1 : 0;

        $startup->inv_asking_price = $seekingInvestors ? ($request->input('inv_asking_price') ?: 0) : 0;
        $startup->inv_stake = $seekingInvestors ? ($request->input('inv_stake') ?: 0) : 0;
        $startup->inv_reason = $seekingInvestors ? $request->input('inv_reason') : null;

        $startup->loan_collateral_details = $seekingLoan ? $request->input('loan_collateral_details') : null;
        $startup->loan_amount = $seekingLoan ? ($request->input('loan_amount') ?: 0) : 0;
        $startup->loan_repayment_period = $seekingLoan ? $request->input('loan_repayment_period') : null;
        $startup->loan_interest_rate = $seekingLoan ? $request->input('loan_interest_rate') : null;
        $startup->loan_reason = $seekingLoan ? $request->input('loan_reason') : null;

        $startup->buyer_sell_price = $seekingAcquirers ? ($request->input('buyer_sell_price') ?: 0) : 0;
        $startup->buyer_sell_reason = $seekingAcquirers ? $request->input('buyer_sell_reason') : null;

        $startup->mentor_req_details = $seekingMentorship ? $request->input('mentor_req_details') : null;

        $startup->accel_req_details = $seekingIncubators ? $request->input('accel_req_details') : null;
        $startup->accel_inv_req = $seekingIncubators ? ($request->input('accel_inv_req') ?: 0) : 0;
        $startup->accel_time_period = $seekingIncubators ? $request->input('accel_time_period') : null;

        $startup->save();

        $unmatched = [];
        if ($request->has('mentor_sectors')) {
            $this->syncCategoryTags($request->input('mentor_sectors'), IndPrefMentorStartup::class, $startup->startup_id, $startup->user_id, $unmatched);
        }
        if ($request->has('incubator_sectors')) {
            $this->syncCategoryTags($request->input('incubator_sectors'), IndPrefIncubatorStartup::class, $startup->startup_id, $startup->user_id, $unmatched);
        }

        if (!empty($unmatched)) {
            return response()->json([
                'status' => false,
                'unmatched_sectors' => array_values($unmatched),
                'message' => 'Some preferences could not be matched to a category.',
            ]);
        }

        return response()->json(['status' => true, 'message' => 'Requirement details saved successfully.']);
    }

    public function getAttachments($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findStartup($user_rand_id, $user->user_id);
        $images = collect();
        $documents = collect();
        if ($startup) {
            $images = StartupImage::where('startup_id', $startup->startup_id)->where('type', 1)
                ->get(['startup_image_id', 'startup_img_path', 'startup_img_name']);
            $documents = StartupImage::where('startup_id', $startup->startup_id)->where('type', 2)
                ->get(['startup_image_id', 'startup_img_path', 'startup_img_name']);
        }
        return response()->json([
            'status' => true,
            'data' => [
                'images' => $images->map(function ($img) {
                    return ['id' => $img->startup_image_id, 'url' => asset($img->startup_img_path), 'name' => $img->startup_img_name];
                }),
                'documents' => $documents->map(function ($doc) {
                    return ['id' => $doc->startup_image_id, 'url' => asset($doc->startup_img_path), 'name' => $doc->startup_img_name];
                }),
            ]
        ]);
    }

    public function updateAttachments(Request $request, $user_rand_id)
    {
        $request->validate([
            'business_photos.*' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:5120',
            'business_documents.*' => 'nullable|mimes:doc,docx,xls,xlsx,pdf|max:10240',
        ]);
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $startup = $this->findOrNewStartup($user_rand_id, $user);
        $startup->save();

        if ($request->hasFile('business_photos')) {
            foreach ($request->file('business_photos') as $photo) {
                if (!$photo) {
                    continue;
                }
                $imgExt = strtolower($photo->getClientOriginalExtension());
                $path = sprintf(config('constants.StartupProfileImagePath'), date('Ym'), random_int(100, 99999) . '_' . time(), $imgExt);
                $savedPath = $this->imageUploadPost($path, $photo);
                $image = new StartupImage();
                $image->startup_id = $startup->startup_id;
                $image->type = 1;
                $image->startup_img_path = $savedPath;
                $image->startup_img_name = $photo->getClientOriginalName();
                $image->is_active = 1;
                $image->save();

                if (empty($startup->startup_prof_pic)) {
                    $startup->startup_prof_pic = $savedPath;
                    $startup->save();
                }
            }
        }

        if ($request->hasFile('business_documents')) {
            foreach ($request->file('business_documents') as $document) {
                if (!$document) {
                    continue;
                }
                $docExt = strtolower($document->getClientOriginalExtension());
                $path = sprintf(config('constants.StartupProfileDocPath'), date('Ym'), random_int(100, 99999) . '_' . time(), $docExt);
                $savedPath = $this->imageUploadPost($path, $document);
                $doc = new StartupImage();
                $doc->startup_id = $startup->startup_id;
                $doc->type = 2;
                $doc->startup_img_path = $savedPath;
                $doc->startup_img_name = $document->getClientOriginalName();
                $doc->is_active = 1;
                $doc->save();
            }
        }

        return response()->json(['status' => true, 'message' => 'Attachments uploaded successfully.']);
    }

    public function deleteAttachment(Request $request, $startup_image_id)
    {
        $image = StartupImage::find($startup_image_id);
        if (!$image) {
            return response()->json(['status' => false, 'message' => 'Attachment not found.'], 404);
        }
        $filePath = public_path($image->startup_img_path);
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
        $image->delete();
        return response()->json(['status' => true, 'message' => 'Attachment removed.']);
    }

    public function getUserProfileDetails()
    {
        $user_id = Auth::id();
        $user = UserAccount::select('name', 'email', 'location', 'company_name', 'designation', 'mobile', 'profile_pic')
            ->where('user_id', $user_id)->first();
        $profile = ProfileStartup::where('user_id', $user_id)->first();

        return view('account_dashboard.mystartup', compact('user', 'profile'));
    }

    private function findStartup($user_rand_id, $userId)
    {
        $startup = ProfileStartup::where('startup_profile_str', $user_rand_id)->first();
        if (!$startup) {
            $startup = ProfileStartup::where('user_id', $userId)->first();
        }
        return $startup;
    }

    private function findOrNewStartup($user_rand_id, UserAccount $user)
    {
        $startup = $this->findStartup($user_rand_id, $user->user_id);
        if (!$startup) {
            $startup = new ProfileStartup();
            $startup->user_id = $user->user_id;
            $startup->startup_profile_str = $user_rand_id;
            $startup->startup_name = $user->name;
            $startup->startup_mobile = $user->mobile;
            $startup->startup_email = $user->email;
            $startup->startup_profile_status = 1;
            $startup->save();
        }
        return $startup;
    }

    private function syncCategoryTags($input, $modelClass, $startupProfileId, $userId, array &$unmatched)
    {
        $tags = is_array($input) ? $input : explode(',', $input);
        $tags = array_filter(array_map('trim', $tags));

        $validCategoryIds = [];
        foreach ($tags as $tagName) {
            $category = IndustryCategory::whereRaw('LOWER(TRIM(category_name)) = ?', [strtolower($tagName)])->first();
            if (!$category) {
                $unmatched[] = $tagName;
                continue;
            }
            $validCategoryIds[] = $category->cat_id;
            $exists = $modelClass::where('startup_profile_id', $startupProfileId)
                ->where('user_id', $userId)
                ->where('sub_category_id', $category->cat_id)
                ->exists();
            if (!$exists) {
                $row = new $modelClass();
                $row->startup_profile_id = $startupProfileId;
                $row->user_id = $userId;
                $row->parent_category_id = $category->parent_id;
                $row->sub_category_id = $category->cat_id;
                $row->profile_status = 1;
                $row->save();
            }
        }

        if (!empty($validCategoryIds)) {
            $modelClass::where('startup_profile_id', $startupProfileId)
                ->where('user_id', $userId)
                ->whereNotIn('sub_category_id', $validCategoryIds)
                ->delete();
        } else {
            $modelClass::where('startup_profile_id', $startupProfileId)
                ->where('user_id', $userId)
                ->delete();
        }
    }

    private function imageUploadPost($imagePath, $file)
    {
        $directory = public_path('uploads/' . dirname($imagePath));
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        $fileName = basename($imagePath);
        $file->move($directory, $fileName);
        return 'uploads/' . $imagePath;
    }
}
