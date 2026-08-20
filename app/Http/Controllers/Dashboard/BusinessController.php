<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAccount;
use App\Models\ProfileBusiness;
use App\Models\ProfileBusinessMgmt;
use App\Models\BusinessImage;
use App\Models\IndPrefMentorBusiness;
use App\Models\IndPrefIncubatorBusiness;
use App\Models\IndustryCategory;
use App\Models\BxCity;

require_once app_path('Helpers/common_helper.php');

class BusinessController extends Controller
{
   
    public function edit($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $business = $this->findBusiness($user_rand_id, $user->user_id);

        $teamMembers = collect();
        $mentorSectors = collect();
        $incubatorSectors = collect();
        $images = collect();
        $documents = collect();

        if ($business) {
            $teamMembers = ProfileBusinessMgmt::where('business_profile_id', $business->business_id)->get();

            $mentorSectors = IndPrefMentorBusiness::join('industry_categories', 'ind_pref_mentor_business.sub_category_id', '=', 'industry_categories.cat_id')
                ->where('ind_pref_mentor_business.business_profile_id', $business->business_id)
                ->select('industry_categories.cat_id as id', 'industry_categories.category_name as name', 'industry_categories.parent_id as pid')
                ->get();

            $incubatorSectors = IndPrefIncubatorBusiness::join('industry_categories', 'ind_pref_incubator_business.sub_category_id', '=', 'industry_categories.cat_id')
                ->where('ind_pref_incubator_business.business_profile_id', $business->business_id)
                ->select('industry_categories.cat_id as id', 'industry_categories.category_name as name', 'industry_categories.parent_id as pid')
                ->get();

            $images = BusinessImage::where('business_id', $business->business_id)->where('type', BusinessImage::TYPE_IMAGE)->get();
            $documents = BusinessImage::where('business_id', $business->business_id)->where('type', BusinessImage::TYPE_DOCUMENT)->get();
        }

        $categories = IndustryCategory::select('cat_id', 'category_name', 'parent_id')->orderBy('category_name')->get();

        // State dropdown only lists states that actually have cities in
        // bx_cities (it's sparse — not every Indian state is populated),
        // and City is pre-loaded for whichever state is currently saved.
        $availableStates = getAvailableStatesFromCities();
        $currentCities = collect();
        if ($business && !empty($business->ofc_state)) {
            $stateName = config('constants.statesIndia.' . $business->ofc_state, $business->ofc_state);
            $currentCities = BxCity::where('state', $stateName)->orderBy('city')->pluck('city');
        }

        return view('account_dashboard.businessConfidentials', compact(
            'user', 'business', 'teamMembers', 'mentorSectors', 'incubatorSectors', 'images', 'documents', 'categories', 'currentCities', 'availableStates'
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
        $business = $this->findBusiness($user_rand_id, $user->user_id);
        return response()->json([
            'status' => true,
            'data' => [
                'name' => $business->seller_name ?? '',
                'designation' => $business->seller_designation ?? '',
                'mobile' => $business->seller_mobile ?? '',
                'email' => $business->seller_email ?? '',
            ]
        ]);
    }

    public function updateConfidentialInfo(Request $request, $user_rand_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $business = $this->findOrNewBusiness($user_rand_id, $user);
        $business->seller_name = $request->name;
        $business->seller_designation = $request->designation;
        $business->seller_mobile = $request->mobile;
        $business->seller_email = $request->email;
        $business->save();

        return response()->json([
            'status' => true,
            'message' => 'Information updated successfully!',
            'data' => $business->only(['seller_name', 'seller_designation', 'seller_mobile', 'seller_email']),
        ]);
    }

    public function getAdvertisementDetails($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $business = $this->findBusiness($user_rand_id, $user->user_id);
        return response()->json([
            'status' => true,
            'data' => [
                'advmt_headline' => $business->advmt_headline ?? '',
                'seller_intro' => $business->seller_intro ?? '',
            ]
        ]);
    }

    public function updateAdvertisementDetails(Request $request, $user_rand_id)
    {
        $request->validate([
            'advmt_headline' => 'required|string|max:255',
            'seller_intro' => 'nullable|string|max:255',
        ]);
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $business = $this->findOrNewBusiness($user_rand_id, $user);
        $business->advmt_headline = $request->advmt_headline;
        $business->seller_intro = $request->seller_intro ?? '';
        $business->save();

        return response()->json([
            'status' => true,
            'message' => 'Advertisement details saved successfully.',
            'data' => ['advmt_headline' => $business->advmt_headline, 'seller_intro' => $business->seller_intro],
        ]);
    }

    public function getBusinessInfo($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $business = $this->findBusiness($user_rand_id, $user->user_id);
        return response()->json([
            'status' => true,
            'data' => [
                'seller_company' => $business->seller_company ?? '',
                'estb_year' => $business->estb_year ?? '',
                'emp_count' => $business->emp_count ?? '',
                'entity_type' => $business->entity_type ?? '',
                'business_type' => $business->business_type ?? '',
                'industry_sector' => $business->industry_sector ?? '',
                'business_website' => $business->business_website ?? '',
                'facilities_desc' => $business->facilities_desc ?? '',
                'company_summary' => $business->company_summary ?? '',
            ]
        ]);
    }

    public function updateBusinessInfo(Request $request, $user_rand_id)
    {
        $request->validate([
            'seller_company' => 'required|string|max:255',
            'estb_year' => 'required',
            'emp_count' => 'required',
            'entity_type' => 'required',
            'business_type' => 'required',
            'industry_sector' => 'required',
            'business_website' => 'nullable|url|max:255',
        ]);
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $business = $this->findOrNewBusiness($user_rand_id, $user);

        $business->seller_company = $request->seller_company;
        $business->estb_year = $request->estb_year;
        $business->emp_count = $request->emp_count;
        $business->entity_type = $request->entity_type;
        $business->business_type = $request->business_type;
        $business->industry_sector = $request->industry_sector;
        $business->business_website = $request->business_website;
        $business->facilities_desc = $request->facilities_desc;
        $business->company_summary = $request->company_summary;
        $business->save();

        return response()->json(['status' => true, 'message' => 'Business information saved successfully.']);
    }

    public function getFinancialDetails($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $business = $this->findBusiness($user_rand_id, $user->user_id);
        return response()->json([
            'status' => true,
            'data' => [
                'annual_sales' => $business->annual_sales ?? '',
                'inventory_value' => $business->inventory_value ?? '',
                'gross_profit' => $business->gross_profit ?? '',
                'ebitda' => $business->ebitda ?? '',
                'ebitda_margin' => $business->ebitda_margin ?? '',
                'rentals' => $business->rentals ?? '',
            ]
        ]);
    }

    public function updateFinancialDetails(Request $request, $user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $business = $this->findOrNewBusiness($user_rand_id, $user);

        $business->annual_sales = $request->input('annual_sales') ?: 0;
        $business->inventory_value = $request->input('inventory_value') ?: 0;
        $business->gross_profit = $request->input('gross_profit') ?: 0;
        $business->ebitda = $request->input('ebitda') ?: 0;
        $business->ebitda_margin = $request->input('ebitda_margin') ?: 0;
        $business->rentals = $request->input('rentals') ?: 0;
        $business->save();

        return response()->json(['status' => true, 'message' => 'Financial details saved successfully.']);
    }

    public function getTeamDetails($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $business = $this->findBusiness($user_rand_id, $user->user_id);
        $teamMembers = collect();
        if ($business) {
            $teamMembers = ProfileBusinessMgmt::where('business_profile_id', $business->business_id)
                ->get(['business_mgmt_id', 'mgmt_name', 'mgmt_designation', 'mgmt_email']);
        }
        return response()->json([
            'status' => true,
            'data' => [
                'director_name' => $business->director_name ?? '',
                'director_email' => $business->director_email ?? '',
                'director_designation' => $business->director_designation ?? '',
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
        $business = $this->findOrNewBusiness($user_rand_id, $user);

        $business->director_name = $request->director_name;
        $business->director_email = $request->director_email;
        $business->director_designation = $request->director_designation;
        $business->save();

        // Management team rows — full replace.
        $names = (array) $request->input('mgmt_names', []);
        $designations = (array) $request->input('mgmt_designations', []);
        $emails = (array) $request->input('mgmt_emails', []);
        ProfileBusinessMgmt::where('business_profile_id', $business->business_id)->delete();
        foreach ($names as $index => $name) {
            $designation = $designations[$index] ?? '';
            $email = $emails[$index] ?? '';
            if (empty($name) && empty($email)) {
                continue;
            }
            $row = new ProfileBusinessMgmt();
            $row->business_profile_id = $business->business_id;
            $row->user_id = $business->user_id;
            $row->mgmt_name = $name;
            $row->mgmt_designation = $designation;
            $row->mgmt_email = $email;
            $row->save();
        }

        return response()->json(['status' => true, 'message' => 'Team details saved successfully.']);
    }

    public function getHeadquarters($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $business = $this->findBusiness($user_rand_id, $user->user_id);
        return response()->json([
            'status' => true,
            'data' => [
                'ofc_address' => $business->ofc_address ?? '',
                'ofc_city' => $business->ofc_city ?? '',
                'ofc_state' => $business->ofc_state ?? '',
                'ofc_country' => $business->ofc_country ?? '',
                'ofc_pincode' => $business->ofc_pincode ?? '',
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
        $business = $this->findOrNewBusiness($user_rand_id, $user);

        $business->ofc_address = $request->ofc_address;
        $business->ofc_city = $request->ofc_city;
        $business->ofc_state = $request->ofc_state;
        $business->ofc_country = $request->ofc_country;
        $business->ofc_pincode = $request->ofc_pincode;
        $business->save();

        return response()->json(['status' => true, 'message' => 'Headquarters / location saved successfully.']);
    }

    public function getRequirement($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $business = $this->findBusiness($user_rand_id, $user->user_id);

        $mentorSectors = collect();
        $incubatorSectors = collect();
        if ($business) {
            $mentorSectors = IndPrefMentorBusiness::join('industry_categories', 'ind_pref_mentor_business.sub_category_id', '=', 'industry_categories.cat_id')
                ->where('ind_pref_mentor_business.business_profile_id', $business->business_id)
                ->select('industry_categories.cat_id as id', 'industry_categories.category_name as name')
                ->get();
            $incubatorSectors = IndPrefIncubatorBusiness::join('industry_categories', 'ind_pref_incubator_business.sub_category_id', '=', 'industry_categories.cat_id')
                ->where('ind_pref_incubator_business.business_profile_id', $business->business_id)
                ->select('industry_categories.cat_id as id', 'industry_categories.category_name as name')
                ->get();
        }

        return response()->json([
            'status' => true,
            'data' => [
                'seeking_investors' => (int) ($business->seeking_investors ?? 0),
                'seeking_loan' => (int) ($business->seeking_loan ?? 0),
                'seeking_accelerators' => (int) ($business->seeking_accelerators ?? 0),
                'seeking_buyers' => (int) ($business->seeking_buyers ?? 0),
                'seeking_mentors' => (int) ($business->seeking_mentors ?? 0),
                'business_pitch' => $business->business_pitch ?? '',
                'inv_asking_price' => $business->inv_asking_price ?? '',
                'inv_stake' => $business->inv_stake ?? '',
                'inv_reason' => $business->inv_reason ?? '',
                'loan_collateral_details' => $business->loan_collateral_details ?? '',
                'loan_amount' => $business->loan_amount ?? '',
                'loan_repayment_period' => $business->loan_repayment_period ?? '',
                'loan_interest_rate' => $business->loan_interest_rate ?? '',
                'loan_reason' => $business->loan_reason ?? '',
                'accel_req_details' => $business->accel_req_details ?? '',
                'accel_inv_req' => $business->accel_inv_req ?? '',
                'accel_time_period' => $business->accel_time_period ?? '',
                'incubator_sectors' => $incubatorSectors,
                'buyer_sell_price' => $business->buyer_sell_price ?? '',
                'buyer_sell_reason' => $business->buyer_sell_reason ?? '',
                'mentor_req_details' => $business->mentor_req_details ?? '',
                'mentor_sectors' => $mentorSectors,
            ]
        ]);
    }

    public function updateRequirement(Request $request, $user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $business = $this->findOrNewBusiness($user_rand_id, $user);

        $seekingInvestors = $request->boolean('seeking_investors');
        $seekingLoan = $request->boolean('seeking_loan');
        $seekingAccelerators = $request->boolean('seeking_accelerators');
        $seekingBuyers = $request->boolean('seeking_buyers');
        $seekingMentors = $request->boolean('seeking_mentors');

        $business->seeking_investors = $seekingInvestors ? 1 : 0;
        $business->seeking_loan = $seekingLoan ? 1 : 0;
        $business->seeking_accelerators = $seekingAccelerators ? 1 : 0;
        $business->seeking_buyers = $seekingBuyers ? 1 : 0;
        $business->seeking_mentors = $seekingMentors ? 1 : 0;

        $business->business_pitch = $request->input('business_pitch');

        $business->inv_asking_price = $seekingInvestors ? ($request->input('inv_asking_price') ?: 0) : 0;
        $business->inv_stake = $seekingInvestors ? $request->input('inv_stake') : null;
        $business->inv_reason = $seekingInvestors ? $request->input('inv_reason') : null;

        $business->loan_collateral_details = $seekingLoan ? $request->input('loan_collateral_details') : null;
        $business->loan_amount = $seekingLoan ? ($request->input('loan_amount') ?: 0) : 0;
        $business->loan_repayment_period = $seekingLoan ? $request->input('loan_repayment_period') : null;
        $business->loan_interest_rate = $seekingLoan ? $request->input('loan_interest_rate') : null;
        $business->loan_reason = $seekingLoan ? $request->input('loan_reason') : null;

        $business->accel_req_details = $seekingAccelerators ? $request->input('accel_req_details') : null;
        $business->accel_inv_req = $seekingAccelerators ? ($request->input('accel_inv_req') ?: 0) : 0;
        $business->accel_time_period = $seekingAccelerators ? $request->input('accel_time_period') : null;

        $business->buyer_sell_price = $seekingBuyers ? ($request->input('buyer_sell_price') ?: 0) : 0;
        $business->buyer_sell_reason = $seekingBuyers ? $request->input('buyer_sell_reason') : null;

        $business->mentor_req_details = $seekingMentors ? $request->input('mentor_req_details') : null;

        $business->save();

        $unmatched = [];
        if ($request->has('mentor_sectors')) {
            $this->syncCategoryTags($request->input('mentor_sectors'), IndPrefMentorBusiness::class, $business->business_id, $business->user_id, $unmatched);
        }
        if ($request->has('incubator_sectors')) {
            $this->syncCategoryTags($request->input('incubator_sectors'), IndPrefIncubatorBusiness::class, $business->business_id, $business->user_id, $unmatched);
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
        $business = $this->findBusiness($user_rand_id, $user->user_id);
        $images = collect();
        $documents = collect();
        if ($business) {
            $images = BusinessImage::where('business_id', $business->business_id)->where('type', BusinessImage::TYPE_IMAGE)
                ->get(['business_image_id', 'business_img_path', 'business_img_name']);
            $documents = BusinessImage::where('business_id', $business->business_id)->where('type', BusinessImage::TYPE_DOCUMENT)
                ->get(['business_image_id', 'business_img_path', 'business_img_name']);
        }
        return response()->json([
            'status' => true,
            'data' => [
                'images' => $images->map(function ($img) {
                    return ['id' => $img->business_image_id, 'url' => asset($img->business_img_path), 'name' => $img->business_img_name];
                }),
                'documents' => $documents->map(function ($doc) {
                    return ['id' => $doc->business_image_id, 'url' => asset($doc->business_img_path), 'name' => $doc->business_img_name];
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
        $business = $this->findOrNewBusiness($user_rand_id, $user);
        $business->save();

        if ($request->hasFile('business_photos')) {
            foreach ($request->file('business_photos') as $photo) {
                if (!$photo) {
                    continue;
                }
                $imgExt = strtolower($photo->getClientOriginalExtension());
                $path = sprintf(config('constants.BusinessProfileImagePath'), date('Ym'), random_int(100, 99999) . '_' . time(), $imgExt);
                $savedPath = $this->imageUploadPost($path, $photo);
                $image = new BusinessImage();
                $image->business_id = $business->business_id;
                $image->type = BusinessImage::TYPE_IMAGE;
                $image->business_img_path = $savedPath;
                $image->business_img_name = $photo->getClientOriginalName();
                $image->is_active = 1;
                $image->save();

                if (empty($business->seller_prof_pic)) {
                    $business->seller_prof_pic = $savedPath;
                    $business->save();
                }
            }
        }

        if ($request->hasFile('business_documents')) {
            foreach ($request->file('business_documents') as $document) {
                if (!$document) {
                    continue;
                }
                $docExt = strtolower($document->getClientOriginalExtension());
                $path = sprintf(config('constants.BusinessProfileDocPath'), date('Ym'), random_int(100, 99999) . '_' . time(), $docExt);
                $savedPath = $this->imageUploadPost($path, $document);
                $doc = new BusinessImage();
                $doc->business_id = $business->business_id;
                $doc->type = BusinessImage::TYPE_DOCUMENT;
                $doc->business_img_path = $savedPath;
                $doc->business_img_name = $document->getClientOriginalName();
                $doc->is_active = 1;
                $doc->save();
            }
        }

        return response()->json(['status' => true, 'message' => 'Attachments uploaded successfully.']);
    }

    public function deleteAttachment(Request $request, $business_image_id)
    {
        $image = BusinessImage::find($business_image_id);
        if (!$image) {
            return response()->json(['status' => false, 'message' => 'Attachment not found.'], 404);
        }
        $filePath = public_path($image->business_img_path);
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
        $profile = ProfileBusiness::where('user_id', $user_id)->first();

        return view('account_dashboard.mybusiness', compact('user', 'profile'));
    }

    private function findBusiness($user_rand_id, $userId)
    {
        $business = ProfileBusiness::where('business_profile_str', $user_rand_id)->first();
        if (!$business) {
            $business = ProfileBusiness::where('user_id', $userId)->first();
        }
        return $business;
    }

    private function findOrNewBusiness($user_rand_id, UserAccount $user)
    {
        $business = $this->findBusiness($user_rand_id, $user->user_id);
        if (!$business) {
            $business = new ProfileBusiness();
            $business->user_id = $user->user_id;
            $business->business_profile_str = $user_rand_id;
            $business->seller_name = $user->name;
            $business->seller_mobile = $user->mobile;
            $business->seller_email = $user->email;
            $business->business_profile_status = 1;
            $business->save();
        }
        return $business;
    }

    private function syncCategoryTags($input, $modelClass, $businessProfileId, $userId, array &$unmatched)
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
            $exists = $modelClass::where('business_profile_id', $businessProfileId)
                ->where('user_id', $userId)
                ->where('sub_category_id', $category->cat_id)
                ->exists();
            if (!$exists) {
                $row = new $modelClass();
                $row->business_profile_id = $businessProfileId;
                $row->user_id = $userId;
                $row->parent_category_id = $category->parent_id;
                $row->sub_category_id = $category->cat_id;
                $row->profile_status = 1;
                $row->save();
            }
        }

        if (!empty($validCategoryIds)) {
            $modelClass::where('business_profile_id', $businessProfileId)
                ->where('user_id', $userId)
                ->whereNotIn('sub_category_id', $validCategoryIds)
                ->delete();
        } else {
            $modelClass::where('business_profile_id', $businessProfileId)
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
