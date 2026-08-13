<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProfileInvestor;
use App\Models\LocPrefInvestor;
use App\Models\IndPrefInvestor;
use App\Models\IndustryCategory;
use Illuminate\Support\Str;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmailMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function changePassword()
    {
        return view('account_dashboard.changePassword');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => [
                'required',
                'min:8',
                'confirmed'
            ]
        ]);
        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors([
                'old_password' => 'Old password is incorrect'
            ]);
        }
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        return back()->with(
            'success',
            'Password changed successfully'
        );
    }
    public function forgotPassword()
    {
        return view('profile.forgot-password');
    }
    public function forgotPasswordSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = UserAccount::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'Email address not found.');
        }
        $token = Str::random(60);
        $user->reset_token = $token;
        $user->reset_token_created_at = now();
        $user->save();
        $resetLink = route('reset.password', [
            'token' => $token
        ]);
        Mail::to($user->email)->send(new VerifyEmailMail($resetLink));
        return back()->with(
            'success',
            'Mail Send successfully.'
        );
    }
    public function showResetPasswordForm($token)
    {
        $user = UserAccount::where('reset_token', $token)->first();
        if (!$user) {
            return redirect('/forgot-password')->with('error', 'Invalid or expired reset link.');
        }
        return view('profile.reset-password', compact('token'));
    }
    public function resetPasswordSubmit(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        $user = UserAccount::where('reset_token', $request->token)->first();
        if (!$user) {
            return redirect('/forgot-password')->with('error', 'Invalid reset link.');
        }
        $user->password = Hash::make($request->password);
        $user->reset_token = null;
        $user->reset_token_created_at = null;
        $user->save();
        return redirect('/')->with('success', 'Password reset successfully. Please login.');
    }
    public function getUserProfileDetails(Request $request)
    {
        $user_id = Auth::id();
        $user = UserAccount::select('name', 'email', 'location', 'company_name', 'designation', 'mobile')
            ->where('user_id', $user_id)
            ->first();
        $profile = ProfileInvestor::select('company_summary', 'inv_headline', 'inv_intro', 'invest_size_min', 'invest_size_max', 'linkedin_profile')
            ->where('user_id', $user_id)
            ->first();

        return view('account_dashboard.myinvestor', compact('user', 'profile'));

    }
    public function userEditPage(Request $request)
    {
        $user_id = Auth::id();
        $user = UserAccount::findOrFail($user_id);
        return view('account_dashboard.profile_edit', compact('user'));
    }
    public function update(Request $request)
    {
        $user_id = Auth::id();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required|string|max:15',
            'location' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
        ]);

        $user = UserAccount::findOrFail($user_id);
        $user->update($request->all());
        return redirect()->route('user.edit.page')
            ->with('success', 'User updated successfully!');
    }
    public function edit($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $investor = ProfileInvestor::where('inv_profile_str', $user_rand_id)->first();
        if (!$investor) {
            $investor = ProfileInvestor::where('user_id', $user->user_id)->first();
        }
        $invPreference = $investor;
        $indPref = collect();
        $locationPref = collect();
        if ($invPreference) {
            $indPref = IndPrefInvestor::join('industry_categories', 'ind_pref_investors.sub_category_id', '=', 'industry_categories.cat_id')
                ->where('ind_pref_investors.investor_profile_id', $invPreference->investor_id)->select('industry_categories.cat_id as id', 'industry_categories.category_name as name', 'industry_categories.parent_id as pid')
                ->get();
            $locationPref = LocPrefInvestor::query()->select('inv_loc_id', 'location_name')->where('investor_profile_id', $invPreference->investor_id)
                ->orderBy('inv_loc_id', 'desc')->get();
        }
        return view('account_dashboard.investorConfidentials', compact('user', 'investor', 'invPreference', 'indPref', 'locationPref'));
    }
    public function getConfidentialInfo($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        return response()->json([
            'status' => true,
            'data' => [
                'name' => $user->name ?? '',
                'mobile' => $user->mobile ?? '',
                'email' => $user->email ?? '',
                'location' => $user->location ?? '',
            ]
        ]);
    }

    public function updateConfidential_info(Request $request, $user_rand_id)
    {
        // basic validation
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'location' => 'required|string|max:255',
        ]);
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $user->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'location' => $request->location,
        ]);
        return redirect()
            ->route('confidential.edit', [
                'user_rand_id' => $user_rand_id
            ])
            ->with('success', 'Information updated successfully!');
    }

    public function getAdvertisementDetails($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $profile = ProfileInvestor::where('inv_profile_str', $user_rand_id)->first();
        if (!$profile) {
            $profile = ProfileInvestor::where('user_id', $user->user_id)->first();
        }
        return response()->json([
            'status' => true,
            'data' => [
                'inv_headline' => $profile->inv_headline ?? '',
                'inv_intro' => $profile->inv_intro ?? '',
            ]
        ]);
    }

    public function updateInvestorProfileDetails(Request $request, $user_rand_id)
    {
        $request->validate(['inv_headline' => 'required|string|max:255', 'inv_intro' => 'nullable|string',]);
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $profile = ProfileInvestor::where('inv_profile_str', $user_rand_id)->first();
        if (!$profile) {
            $profile = ProfileInvestor::where('user_id', $user->user_id)->first();
        }
        if (!$profile) {
            $profile = new ProfileInvestor();
            $profile->user_id = $user->user_id;
            $profile->inv_profile_str = $user_rand_id;
        }
        $profile->inv_headline = $request->inv_headline;
        $profile->inv_intro = $request->inv_intro;
        $profile->inv_profile_status = 1;
        $profile->save();
        return response()->json([
            'status' => true,
            'message' => 'Advertisement details saved successfully.',
            'data' => ['inv_headline' => $profile->inv_headline, 'inv_intro' => $profile->inv_intro,]
        ]);
    }

    //   public function getInvestorPreferenceDetails($user_rand_id)
//     {
//         $user = UserAccount::where('user_rand_id',$user_rand_id)->firstOrFail();
//         $invPreference = ProfileInvestor::where('inv_profile_str',$user_rand_id)->first();
//         if (!$invPreference) {
//             $invPreference = ProfileInvestor::where('user_id',$user->user_id)->first();
//         }
//         if (!$invPreference) {
//             return response()->json([
//                 'status' => true,
//                 'data' => ['industries' => [],'locations' => [],]]);
//         }
//         $indPref = IndPrefInvestor::join('industry_categories','ind_pref_investors.sub_category_id','=','industry_categories.cat_id')
//         ->where('ind_pref_investors.investor_profile_id',$invPreference->investor_id)->select('industry_categories.cat_id as id','industry_categories.category_name as name','industry_categories.parent_id as pid')
//         ->get();
//         $locationPref = LocPrefInvestor::query()->select('inv_loc_id','location_name')->where('investor_profile_id',$invPreference->investor_id)
//         ->orderBy('inv_loc_id','desc')->get();
//         return response()->json(['status' => true,'data' => ['industries' =>$indPref,'locations' => $locationPref,]
//         ]);
//     }
    public function getVisitor(Request $request)
    {
        $userId = Auth::id();
        $visitor = DB::table('profile_visitors as pv')
            ->join('user_profiles as up', function ($join) {
                $join->on('up.profile_str', '=', 'pv.profile_str')
                    ->on('up.profile_type', '=', 'pv.profile_type');
            })
            ->where('up.user_id', $userId)
            ->where('pv.user_id', $userId)
            ->selectRaw('COUNT(DISTINCT pv.profile_id) AS unique_profile_visitors')
            ->first();
        return view('account_dashboard.profileview', compact('visitor'));
    }
    public function profileInfo($user_rand_id)
    {
        $investor = ProfileInvestor::where('inv_profile_str', $user_rand_id)->first();
        if (count([$investor]) === 0 || $investor === null) {
            return redirect()->back()->with('success', 'No Data Found');
        }
        return view('account_dashboard.profile_info', compact('investor'));
    }
    public function getInvestorProfileDetails($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $investor = ProfileInvestor::where('inv_profile_str', $user_rand_id)->first();
        if (!$investor) {
            $investor = ProfileInvestor::where('user_id', $user->user_id)->first();
        }
        return response()->json([
            'status' => true,
            'data' => [
                'company_name' => $investor->company_name ?? '',
                'company_designation' => $investor->company_designation ?? '',
                'invest_pref' => (int) ($investor->invest_pref ?? 0),
                'full_acquisition' => (int) ($investor->full_acquisition ?? 0),
                'invest_size_min' => $investor->invest_size_min ?? '',
                'invest_size_max' => $investor->invest_size_max ?? '',
                'invest_stake' => $investor->invest_stake ?? '',
                'purchase_capacity_min' => $investor->purchase_capacity_min ?? '',
                'purchase_capacity_max' => $investor->purchase_capacity_max ?? '',
                'inv_abt_urself' => $investor->inv_abt_urself ?? '',
                'linkedin_profile' => $investor->linkedin_profile ?? '',
                'inv_profile_pic_path' => $investor->inv_profile_pic_path ?? '',
            ]
        ]);
    }

    public function investorUpdate(Request $request, $user_rand_id)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_designation' => 'required|string|max:255',
            'inv_abt_urself' => 'required|string',
            'invest_size_min' => 'nullable|numeric',
            'invest_size_max' => 'nullable|numeric',
            'invest_stake' => 'nullable|numeric|min:0|max:100',
            'purchase_capacity_min' => 'nullable|numeric',
            'purchase_capacity_max' => 'nullable|numeric',
            'linkedin_profile' => 'nullable|url|max:500',
            'inv_profile_pic_path' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
        ]);
        $investmentSelected = $request->boolean('invest_pref');
        $acquisitionSelected = $request->boolean('full_acquisition');
        if (!$investmentSelected && !$acquisitionSelected) {
            return response()->json([
                'status' => false,
                'message' => 'Please select at least one investment preference.',
                'errors' => [
                    'invest_pref' => [
                        'Please select at least one preference.'
                    ]
                ]
            ], 422);
        }
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        $investor = ProfileInvestor::where('inv_profile_str', $user_rand_id)->first();
        if (!$investor) {
            $investor = ProfileInvestor::where('user_id', $user->user_id)->first();
        }
        if (!$investor) {
            $investor = new ProfileInvestor();
            $investor->user_id = $user->user_id;
        }

        $investor->inv_profile_str = $user_rand_id;
        $investor->user_id = $user->user_id;
        $investor->company_name = $request->company_name;
        $investor->company_designation = $request->company_designation;
        $investor->invest_pref = $investmentSelected ? 1 : 0;
        $investor->full_acquisition = $acquisitionSelected ? 1 : 0;
        $investor->invest_size_min = $investmentSelected ? ($request->input('invest_size_min') ?: 0) : 0;
        $investor->invest_size_max = $investmentSelected ? ($request->input('invest_size_max') ?: 0) : 0;
        $investor->invest_stake = $investmentSelected ? ($request->input('invest_stake') ?: 0) : 0;
        $investor->purchase_capacity_min = $acquisitionSelected ? ($request->input('purchase_capacity_min') ?: 0) : 0;
        $investor->purchase_capacity_max = $acquisitionSelected ? ($request->input('purchase_capacity_max') ?: 0) : 0;
        $investor->inv_abt_urself = $request->inv_abt_urself;
        $investor->linkedin_profile = $request->linkedin_profile;
        $investor->inv_profile_status = 1;

        if ($request->hasFile('inv_profile_pic_path')) {
            $imagePic = $request->file('inv_profile_pic_path');
            $imgExt = strtolower($imagePic->getClientOriginalExtension());
            $investorProfile = config('constants.InvestorProfileImagePath');
            $imgProfilePath = sprintf($investorProfile, date('Ym'), random_int(100, 99999) . '_' . time(), $imgExt);
            $oldImage = $investor->inv_profile_pic_path;
            $imageName = $this->imageUploadPost($imgProfilePath, $imagePic);
            if (!$imageName) {
                return response()->json(['status' => false, 'message' => 'Profile image upload failed.'], 500);
            }
            if (!empty($oldImage)) {
                $oldFile = public_path($oldImage);
                if (file_exists($oldFile)) {
                    @unlink($oldFile);
                }
            }
            $investor->inv_profile_pic_path = $imageName;
        }
        $investor->save();
        return response()->json([
            'status' => true,
            'message' => 'Investor profile updated successfully.',
            'data' => [
                'company_name' => $investor->company_name,
                'company_designation' => $investor->company_designation,
                'inv_profile_pic_path' => $investor->inv_profile_pic_path,
                'invest_pref' => (int) $investor->invest_pref,
                'full_acquisition' => (int) $investor->full_acquisition,
            ]
        ]);
    }



    private function imageUploadPost($imagePath, $imagePic)
    {
        $directory = public_path('uploads/' . dirname($imagePath));

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $fileName = basename($imagePath);

        $imagePic->move($directory, $fileName);

        return 'uploads/' . $imagePath;
    }

    private function deleteUploadedImage($imagePath)
    {
        $disk = config('filesystems.default');

        Storage::disk($disk)->delete($imagePath);
    }
    public function getInvestorPreferenceDetails($user_rand_id)
    {
        // Find user
        $user = UserAccount::where('user_rand_id', $user_rand_id)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
                'data' => [
                    'industries' => [],
                    'locations' => [],
                ]
            ], 404);
        }

        // Find investor profile using unique ID
        $invPreference = ProfileInvestor::where('inv_profile_str', $user_rand_id)->first();

        // If not found, find using user_id
        if (!$invPreference) {
            $invPreference = ProfileInvestor::where('user_id', $user->user_id)->first();
        }

        // Investor profile not found
        if (!$invPreference) {
            return response()->json([
                'status' => true,
                'data' => [
                    'industries' => [],
                    'locations' => [],
                ]
            ]);
        }

        // Get investor's industry preferences
        $indPref = IndPrefInvestor::join(
            'industry_categories',
            'ind_pref_investors.sub_category_id',
            '=',
            'industry_categories.cat_id'
        )
            ->where(
                'ind_pref_investors.investor_profile_id',
                $invPreference->investor_id
            )
            ->select(
                'industry_categories.cat_id as id',
                'industry_categories.category_name as name',
                'industry_categories.parent_id as pid'
            )
            ->get();

        // Get investor's location preferences
        $locationPref = LocPrefInvestor::query()
            ->select(
                'inv_loc_id',
                'location_name'
            )
            ->where(
                'investor_profile_id',
                $invPreference->investor_id
            )
            ->orderBy('inv_loc_id', 'desc')
            ->get();

        // Return response
        return response()->json([
            'status' => true,
            'data' => [
                'industries' => $indPref,
                'locations' => $locationPref,
            ]
        ]);
    }
  public function updateInvestorPreferenceDetails(Request $request, $user_rand_id)
{
    $investorCount = ProfileInvestor::query()
        ->select('inv_profile_str', 'investor_id', 'user_id')
        ->where('inv_profile_str', '=', $user_rand_id)
        ->first();

    if (!$investorCount) {
        return response()->json([
            'status' => false,
            'message' => 'Investor profile not found.'
        ], 404);
    }
    $sectorUpdated = false;
    $unmatchedSectors = [];
    if ($request->has('sectors')) {
        $sectorsInput = $request->input('sectors');
        if (is_array($sectorsInput)) {
            $sectors = $sectorsInput;
        } else {
            $sectors = explode(',', $sectorsInput);
        }
        $sectors = array_map('trim', $sectors);
        $sectors = array_filter($sectors, function ($sector) {
            return !empty($sector);
        });
        $validCategoryIds = [];
        foreach ($sectors as $sectorName) {
            $category = IndustryCategory::query()->whereRaw('LOWER(TRIM(category_name)) = ?',
            [strtolower($sectorName)])->first();
            if (!$category) {
                $unmatchedSectors[] = $sectorName;
                continue;
            }
            $validCategoryIds[] = $category->cat_id;
            $existingSector = IndPrefInvestor::query()->where('investor_profile_id', $investorCount->investor_id)
            ->where('user_id', $investorCount->user_id)->where('sub_category_id', $category->cat_id)->exists();
            if (!$existingSector) {
                $industry = new IndPrefInvestor();
                $industry->investor_profile_id = $investorCount->investor_id;
                $industry->user_id = $investorCount->user_id;
                $industry->parent_category_id = $category->parent_id;
                $industry->sub_category_id = $category->cat_id;
                $industry->profile_status = 1;
                $industry->save();
                $sectorUpdated = true;
            }
        }
        if (!empty($validCategoryIds)) {
            $deletedSectors = IndPrefInvestor::query()->where('investor_profile_id', $investorCount->investor_id)
            ->where('user_id', $investorCount->user_id)->whereNotIn('sub_category_id', $validCategoryIds)->delete();
            if ($deletedSectors > 0) {
                $sectorUpdated = true;
            }
        } else {
            $deletedSectors = IndPrefInvestor::query()
                ->where('investor_profile_id', $investorCount->investor_id)
                ->where('user_id', $investorCount->user_id)
                ->delete();

            if ($deletedSectors > 0) {
                $sectorUpdated = true;
            }
        }
    }
    $locationUpdated = false;
    if ($request->has('location_preference')) {
        $locationInput = $request->input('location_preference');
        if (is_array($locationInput)) {
            $locations = $locationInput;
        } else {
            $locations = explode(',', $locationInput);
        }
        $locations = array_map('trim', $locations);
        $locations = array_filter($locations, function ($location) {
            return !empty($location);
        });
        $existingLocationNames = [];
        foreach ($locations as $locationName) {
            $existingLocation = LocPrefInvestor::query()
                ->where('investor_profile_id', $investorCount->investor_id)
                ->where('user_id', $investorCount->user_id)
                ->whereRaw(
                    'LOWER(TRIM(location_name)) = ?',
                    [strtolower($locationName)]
                )
                ->exists();
            if (!$existingLocation) {
                $location = new LocPrefInvestor();
                $location->investor_profile_id = $investorCount->investor_id;
                $location->user_id = $investorCount->user_id;
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
        $allLocations = LocPrefInvestor::query()->where('investor_profile_id', $investorCount->investor_id)
            ->where('user_id', $investorCount->user_id)
            ->get();
        foreach ($allLocations as $savedLocation) {
            if (!in_array(
                strtolower(trim($savedLocation->location_name)),
                $existingLocationNames
            )) {
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
            'message' =>
                'Some sector preferences could not be updated because their categories were not found.'
        ], 200);
    }

    return response()->json([
        'status' => true,
        'sector_updated' => $sectorUpdated,
        'location_updated' => $locationUpdated,
        'message' => 'Preference data updated successfully.'
    ], 200);
}


public function searchInvestorSectors(Request $request)
{
    $search = trim($request->input('search', ''));
    if ($search === '') {
        return response()->json([
            'status' => true,
            'data' => []
        ]);
    }
    $categories = IndustryCategory::query()->select('cat_id','category_name','parent_id')
    ->where('category_name','LIKE','%' . $search . '%')->orderBy('category_name','asc')->limit(20)->get()
    ->map(function ($category) {
        return ['id' => $category->cat_id,'name' => $category->category_name,'pid' => $category->parent_id];
        });
    return response()->json([
        'status' => true,
        'data' => $categories
    ]);
}


}
