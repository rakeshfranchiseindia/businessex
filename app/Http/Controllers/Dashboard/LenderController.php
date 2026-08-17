<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAccount;
use App\Models\ProfileLender;
use App\Models\IndPrefLender;
use App\Models\LocPrefLender;
use App\Models\IndustryCategory;

require_once app_path('Helpers/common_helper.php');

class LenderController extends Controller
{
    /**
     * Manage Lender Information page (Confidential / Advertisement / Preferences tabs).
     */
    public function edit($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $lender = $this->findLender($user_rand_id, $user->user_id);

        $indPref = collect();
        $locationPref = collect();

        if ($lender) {
            $indPref = IndPrefLender::join('industry_categories', 'ind_pref_lenders.sub_category_id', '=', 'industry_categories.cat_id')
                ->where('ind_pref_lenders.lender_profile_id', $lender->lender_id)
                ->select('industry_categories.cat_id as id', 'industry_categories.category_name as name', 'industry_categories.parent_id as pid')
                ->get();

            $locationPref = LocPrefLender::query()->select('inv_loc_id', 'location_name')
                ->where('lender_profile_id', $lender->lender_id)
                ->orderBy('inv_loc_id', 'desc')->get();
        }

        return view('account_dashboard.lenderConfidentials', compact('user', 'lender', 'indPref', 'locationPref'));
    }

    public function getConfidentialInfo($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $lender = $this->findLender($user_rand_id, $user->user_id);
        return response()->json([
            'status' => true,
            'data' => [
                'name' => $lender->lender_name ?? '',
                'mobile' => $lender->lender_mobile ?? '',
                'email' => $lender->lender_email ?? '',
                'location' => $lender->lender_location ?? '',
            ]
        ]);
    }

    public function updateConfidentialInfo(Request $request, $user_rand_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'location' => 'required|string|max:255',
        ]);
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $lender = $this->findOrNewLender($user_rand_id, $user);
        $lender->lender_name = $request->name;
        $lender->lender_mobile = $request->mobile;
        $lender->lender_email = $request->email;
        $lender->lender_location = $request->location;
        $lender->save();

        return response()->json([
            'status' => true,
            'message' => 'Information updated successfully!',
            'data' => $lender->only(['lender_name', 'lender_mobile', 'lender_email', 'lender_location']),
        ]);
    }

    public function getAdvertisementDetails($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $lender = $this->findLender($user_rand_id, $user->user_id);
        return response()->json([
            'status' => true,
            'data' => [
                'lender_adv_headline' => $lender->lender_adv_headline ?? '',
                'lender_intro' => $lender->lender_intro ?? '',
            ]
        ]);
    }

    public function updateAdvertisementDetails(Request $request, $user_rand_id)
    {
        $request->validate([
            'lender_adv_headline' => 'required|string|max:255',
            'lender_intro' => 'nullable|string|max:255',
        ]);
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $lender = $this->findOrNewLender($user_rand_id, $user);

        $lender->lender_adv_headline = $request->lender_adv_headline;
        $lender->lender_intro = $request->lender_intro ?? '';
        $lender->lender_profile_status = 1;
        $lender->save();

        return response()->json([
            'status' => true,
            'message' => 'Advertisement details saved successfully.',
            'data' => [
                'lender_adv_headline' => $lender->lender_adv_headline,
                'lender_intro' => $lender->lender_intro,
            ]
        ]);
    }

    public function getLenderPreferenceDetails($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
                'data' => ['industries' => [], 'locations' => []],
            ], 404);
        }

        $lender = $this->findLender($user_rand_id, $user->user_id);
        if (!$lender) {
            return response()->json([
                'status' => true,
                'data' => ['industries' => [], 'locations' => []],
            ]);
        }

        $indPref = IndPrefLender::join('industry_categories', 'ind_pref_lenders.sub_category_id', '=', 'industry_categories.cat_id')
            ->where('ind_pref_lenders.lender_profile_id', $lender->lender_id)
            ->select('industry_categories.cat_id as id', 'industry_categories.category_name as name', 'industry_categories.parent_id as pid')
            ->get();

        $locationPref = LocPrefLender::query()->select('inv_loc_id', 'location_name')
            ->where('lender_profile_id', $lender->lender_id)
            ->orderBy('inv_loc_id', 'desc')->get();

        return response()->json([
            'status' => true,
            'data' => [
                'industries' => $indPref,
                'locations' => $locationPref,
            ]
        ]);
    }

    public function updateLenderPreferenceDetails(Request $request, $user_rand_id)
    {
        $lenderCount = ProfileLender::query()->select('lender_profile_str', 'lender_id', 'user_id')
            ->where('lender_profile_str', $user_rand_id)->first();

        if (!$lenderCount) {
            return response()->json([
                'status' => false,
                'message' => 'Lender profile not found.'
            ], 404);
        }

        $sectorUpdated = false;
        $unmatchedSectors = [];
        if ($request->has('sectors')) {
            $sectorsInput = $request->input('sectors');
            $sectors = is_array($sectorsInput) ? $sectorsInput : explode(',', $sectorsInput);
            $sectors = array_filter(array_map('trim', $sectors));

            $validCategoryIds = [];
            foreach ($sectors as $sectorName) {
                $category = IndustryCategory::whereRaw('LOWER(TRIM(category_name)) = ?', [strtolower($sectorName)])->first();
                if (!$category) {
                    $unmatchedSectors[] = $sectorName;
                    continue;
                }
                $validCategoryIds[] = $category->cat_id;
                $existingSector = IndPrefLender::where('lender_profile_id', $lenderCount->lender_id)
                    ->where('user_id', $lenderCount->user_id)
                    ->where('sub_category_id', $category->cat_id)->exists();
                if (!$existingSector) {
                    $industry = new IndPrefLender();
                    $industry->lender_profile_id = $lenderCount->lender_id;
                    $industry->user_id = $lenderCount->user_id;
                    $industry->parent_category_id = $category->parent_id;
                    $industry->sub_category_id = $category->cat_id;
                    $industry->profile_status = 1;
                    $industry->save();
                    $sectorUpdated = true;
                }
            }

            if (!empty($validCategoryIds)) {
                $deletedSectors = IndPrefLender::where('lender_profile_id', $lenderCount->lender_id)
                    ->where('user_id', $lenderCount->user_id)
                    ->whereNotIn('sub_category_id', $validCategoryIds)->delete();
                if ($deletedSectors > 0) {
                    $sectorUpdated = true;
                }
            } else {
                $deletedSectors = IndPrefLender::where('lender_profile_id', $lenderCount->lender_id)
                    ->where('user_id', $lenderCount->user_id)->delete();
                if ($deletedSectors > 0) {
                    $sectorUpdated = true;
                }
            }
        }

        $locationUpdated = false;
        if ($request->has('location_preference')) {
            $locationInput = $request->input('location_preference');
            $locations = is_array($locationInput) ? $locationInput : explode(',', $locationInput);
            $locations = array_filter(array_map('trim', $locations));

            $existingLocationNames = [];
            foreach ($locations as $locationName) {
                $existingLocation = LocPrefLender::where('lender_profile_id', $lenderCount->lender_id)
                    ->where('user_id', $lenderCount->user_id)
                    ->whereRaw('LOWER(TRIM(location_name)) = ?', [strtolower($locationName)])
                    ->exists();
                if (!$existingLocation) {
                    $location = new LocPrefLender();
                    $location->lender_profile_id = $lenderCount->lender_id;
                    $location->user_id = $lenderCount->user_id;
                    $location->place_id = $locationName;
                    $location->location_name = $locationName;
                    $location->loc_state = '';
                    $location->loc_country = '';
                    $location->loc_latitude = '';
                    $location->loc_longitude = '';
                    $location->profile_status = 1;
                    $location->save();
                    $locationUpdated = true;
                }
                $existingLocationNames[] = strtolower(trim($locationName));
            }

            $allLocations = LocPrefLender::where('lender_profile_id', $lenderCount->lender_id)
                ->where('user_id', $lenderCount->user_id)->get();
            foreach ($allLocations as $savedLocation) {
                if (!in_array(strtolower(trim($savedLocation->location_name)), $existingLocationNames)) {
                    $savedLocation->delete();
                    $locationUpdated = true;
                }
            }
        }

        if (!empty($unmatchedSectors)) {
            return response()->json([
                'status' => false,
                'sector_updated' => $sectorUpdated,
                'location_updated' => $locationUpdated,
                'unmatched_sectors' => array_values($unmatchedSectors),
                'message' => 'Some sector preferences could not be updated because their categories were not found.'
            ], 200);
        }

        return response()->json([
            'status' => true,
            'sector_updated' => $sectorUpdated,
            'location_updated' => $locationUpdated,
            'message' => 'Preference data updated successfully.'
        ], 200);
    }

    public function getUserProfileDetails()
    {
        $user_id = Auth::id();
        $user = UserAccount::select('name', 'email', 'location', 'company_name', 'designation', 'mobile', 'profile_pic')
            ->where('user_id', $user_id)->first();
        $profile = ProfileLender::select('lender_adv_headline', 'lender_intro')
            ->where('user_id', $user_id)->first();

        return view('account_dashboard.mylender', compact('user', 'profile'));
    }

    /**
     * Find an existing lender profile for this user (by profile string, then by user id).
     */
    private function findLender($user_rand_id, $userId)
    {
        $lender = ProfileLender::where('lender_profile_str', $user_rand_id)->first();
        if (!$lender) {
            $lender = ProfileLender::where('user_id', $userId)->first();
        }
        return $lender;
    }

    /**
     * Find an existing lender profile, or start a new one pre-filled with the account's
     * confidential info (lender_name/mobile/email are NOT NULL columns).
     */
    private function findOrNewLender($user_rand_id, UserAccount $user)
    {
        $lender = $this->findLender($user_rand_id, $user->user_id);
        if (!$lender) {
            $lender = new ProfileLender();
            $lender->user_id = $user->user_id;
            $lender->lender_profile_str = $user_rand_id;
            $lender->lender_name = $user->name;
            $lender->lender_mobile = $user->mobile;
            $lender->lender_email = $user->email;
            $lender->lender_location = $user->location;
        }
        return $lender;
    }
}
