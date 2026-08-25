<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\ProfileInvestor;
use App\Models\LocPrefInvestor;
use App\Models\IndPrefInvestor;
use App\Models\ProfileLender;
use App\Models\ProfileBusiness;
use App\Models\ProfileMentor;
use App\Models\IndPrefMentor;
use App\Models\ProfileStartup;
use App\Models\IndustryCategory;
use App\Models\ConversationReply;
use App\Models\RequestContact;
use App\Models\BxCity;
use Illuminate\Support\Str;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;


require_once app_path('Helpers/common_helper.php');
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

        // Force a fresh login with the new password instead of letting the
        // old session carry on — same logout sequence as AuthController::logout.
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with(
            'success',
            'Password changed successfully. Please log in again with your new password.'
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
        Mail::to($user->email)->send(new ResetPasswordMail($resetLink));
        return back()->with(
            'success',
            'A password reset link has been sent to your email.'
        );
    }
    public function showResetPasswordForm($token)
    {
        $user = UserAccount::where('reset_token', $token)->first();
        if (!$user || $this->isResetTokenExpired($user)) {
            return redirect('/forgot-password')->with('error', 'This reset link is invalid or has expired. Please request a new one.');
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
        if (!$user || $this->isResetTokenExpired($user)) {
            return redirect('/forgot-password')->with('error', 'This reset link is invalid or has expired. Please request a new one.');
        }
        $user->password = Hash::make($request->password);
        $user->reset_token = null;
        $user->reset_token_created_at = null;
        $user->save();
        return redirect('/')->with('success', 'Password reset successfully. Please login.');
    }

    /**
     * Reset links are valid for 60 minutes from when they were issued.
     */
    private function isResetTokenExpired($user)
    {
        if (empty($user->reset_token_created_at)) {
            return true;
        }
        return Carbon::parse($user->reset_token_created_at)->addMinutes(60)->isPast();
    }

    /**
     * Every investor Manage route/tab here is keyed by a route segment that's
     * meant to double as either the account's own user_rand_id (old,
     * single-profile behaviour) OR a *specific* investor profile's own
     * inv_profile_str (needed now that a user can have several Investor
     * profiles — the dropdown passes THAT profile's str so Manage opens the
     * right one).
     */
    private function resolveUserAccount($user_rand_id)
    {
        return $this->resolveUserAccountOrNull($user_rand_id)
            ?? UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
    }

    private function resolveUserAccountOrNull($user_rand_id)
    {
        $investor = ProfileInvestor::where('inv_profile_str', $user_rand_id)->first();
        if ($investor) {
            $user = UserAccount::find($investor->user_id);
            if ($user) {
                return $user;
            }
        }
        return UserAccount::where('user_rand_id', $user_rand_id)->first();
    }
    public function getUserProfileDetails(Request $request)
    {
        $user_id = Auth::id();
        $user = UserAccount::select('name', 'email', 'location', 'company_name', 'designation', 'mobile', 'profile_pic')
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
        $user = $this->resolveUserAccount($user_rand_id);
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
        // Same source as the investor registration form's Location Preference dropdown.
        $locations = BxCity::orderBy('state')->orderBy('city')->get();
        // State filter only lists states that actually have cities in bx_cities.
        $availableStates = getAvailableStatesFromCities();
        return view('account_dashboard.investorConfidentials', compact('user', 'user_rand_id', 'investor', 'invPreference', 'indPref', 'locationPref', 'locations', 'availableStates'));
    }
    public function getConfidentialInfo($user_rand_id)
    {
        $user = $this->resolveUserAccount($user_rand_id);
        $investor = ProfileInvestor::where('inv_profile_str', $user_rand_id)->first();
        if (!$investor) {
            $investor = ProfileInvestor::where('user_id', $user->user_id)->first();
        }
        return response()->json([
            'status' => true,
            'data' => [
                'name' => $investor->inv_name ?? '',
                'mobile' => $investor->inv_mobile ?? '',
                'email' => $investor->inv_email ?? '',
                'inv_city' => $investor->inv_city ?? '',
                'inv_state' => $investor->inv_state ?? '',
                'inv_country' => $investor->inv_country ?? '',
            ]
        ]);
    }

    public function updateConfidential_info(Request $request, $user_rand_id)
    {
        // basic validation
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z .\'-]+$/'],
            'mobile' => 'required|digits:10',
            'email' => 'required|email|max:255',
            'inv_city' => 'required|string|max:255',
        ]);
        $user = $this->resolveUserAccount($user_rand_id);
        $investor = ProfileInvestor::where('inv_profile_str', $user_rand_id)->first();
        if (!$investor) {
            $investor = ProfileInvestor::where('user_id', $user->user_id)->first();
        }
        if (!$investor) {
            $investor = new ProfileInvestor();
            $investor->user_id = $user->user_id;
            $investor->inv_profile_str = $user_rand_id;
        }
        $investor->inv_name = $request->name;
        $investor->inv_mobile = $request->mobile;
        $investor->inv_email = $request->email;
        $investor->inv_city = $request->inv_city;
        $investor->inv_state = $request->inv_state;
        $investor->inv_country = $request->inv_country;
        $investor->save();

        return response()->json([
            'status' => true,
            'message' => 'Information updated successfully!',
            'data' => $investor->only(['inv_name', 'inv_mobile', 'inv_email', 'inv_city', 'inv_state', 'inv_country']),
        ]);
    }

    public function getAdvertisementDetails($user_rand_id = null)
    {
        // confidential.advert_detail (dashboard/investorAdvertisement) hits this
        // with an optional route param — fall back to the logged-in user's own
        // id so that legacy no-id link keeps working instead of erroring.
        $user_rand_id = $user_rand_id ?? Auth::user()->user_rand_id;
        $user = $this->resolveUserAccount($user_rand_id);
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
        $user = $this->resolveUserAccount($user_rand_id);
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
        $user = $this->resolveUserAccount($user_rand_id);
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
        $user = $this->resolveUserAccount($user_rand_id);
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
        $user = $this->resolveUserAccountOrNull($user_rand_id);

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
                'location_name',
                'place_id'
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
        $request->validate([
            'sectors' => 'nullable',
            'sectors.*' => 'nullable|string|max:100',
            'location_preference' => 'nullable|array',
            'location_preference.*' => 'nullable|integer',
        ]);

        // Same fallback getInvestorPreferenceDetails() (the GET counterpart) already
        // uses — inv_profile_str alone doesn't match $user_rand_id for real users
        // (it only did here by coincidence in seeded test data), so this always
        // 404'd once real profile strings were involved.
        $investorCount = ProfileInvestor::query()
            ->select('inv_profile_str', 'investor_id', 'user_id')
            ->where('inv_profile_str', '=', $user_rand_id)
            ->first();

        if (!$investorCount) {
            $user = UserAccount::where('user_rand_id', $user_rand_id)->first();
            if ($user) {
                $investorCount = ProfileInvestor::query()
                    ->select('inv_profile_str', 'investor_id', 'user_id')
                    ->where('user_id', $user->user_id)
                    ->first();
            }
        }

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
                $category = IndustryCategory::query()->whereRaw(
                    'LOWER(TRIM(category_name)) = ?',
                    [strtolower($sectorName)]
                )->first();
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
        // Location Preference: same source/shape as the investor registration
        // form — the select posts bx_cities.id values, resolved here the same
        // way InvestorProfileController::store() does (place_id/location_name/
        // loc_state/loc_country from BxCity), just synced instead of only inserted.
        $locationUpdated = false;
        if ($request->has('location_preference')) {
            $cityIds = array_filter(array_map('intval', (array) $request->input('location_preference')));

            $existingPlaceIds = [];
            foreach ($cityIds as $cityId) {
                $city = BxCity::find($cityId);
                if (!$city) {
                    continue;
                }

                $existingPlaceIds[] = (string) $city->id;

                $existingLocation = LocPrefInvestor::query()
                    ->where('investor_profile_id', $investorCount->investor_id)
                    ->where('user_id', $investorCount->user_id)
                    ->where('place_id', (string) $city->id)
                    ->exists();

                if (!$existingLocation) {
                    LocPrefInvestor::create([
                        'investor_profile_id' => $investorCount->investor_id,
                        'user_id' => $investorCount->user_id,
                        'place_id' => (string) $city->id,
                        'location_name' => $city->city . ', ' . $city->state,
                        'loc_state' => $city->state,
                        'loc_country' => 'India',
                        'loc_latitude' => '',
                        'loc_longitude' => '',
                        'profile_status' => 1,
                    ]);
                    $locationUpdated = true;
                }
            }

            $deletedLocations = LocPrefInvestor::query()
                ->where('investor_profile_id', $investorCount->investor_id)
                ->where('user_id', $investorCount->user_id)
                ->whereNotIn('place_id', $existingPlaceIds)
                ->delete();

            if ($deletedLocations > 0) {
                $locationUpdated = true;
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

    // preferences.save (dashboard/preferences/save) named a method that didn't
    // exist — 500 on every call. Route has no {user_rand_id} of its own, so this
    // delegates to the logged-in user's own investor preferences.
    public function savePreferences(Request $request)
    {
        $user = Auth::user();
        if (!$user || empty($user->user_rand_id)) {
            return response()->json(['status' => false, 'message' => 'User not found.'], 404);
        }
        return $this->updateInvestorPreferenceDetails($request, $user->user_rand_id);
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
        $categories = IndustryCategory::query()->select('cat_id', 'category_name', 'parent_id')
            ->where('category_name', 'LIKE', '%' . $search . '%')->orderBy('category_name', 'asc')->limit(20)->get()
            ->map(function ($category) {
                return ['id' => $category->cat_id, 'name' => $category->category_name, 'pid' => $category->parent_id];
            });
        return response()->json([
            'status' => true,
            'data' => $categories
        ]);
    }
    public function showBxInbox()
    {

        return view('account_dashboard.bx_inbox');
    }

    public function getBxInboxNotification(Request $request)
    {
        $user_id = auth()->user()->user_id;

        // Scoped to the specific active profile (a user can own more than one
        // profile of the same type, e.g. several Businesses) — same granularity
        // as Manage: receiver side via profile_str (the contacted listing's own
        // string), sender side via sender_profile_str (which of the user's own
        // profiles sent it). Falls back to type-only when there's no active
        // instance yet, so older rows without this context still show.
        $myProfileTypeCode = config('constants.profileTypes.' . ucfirst(session('profile_type', 'investor')));
        $activeProfileStr = session('active_profile_str');
        $matchingRequestIds = RequestContact::where(function ($q) use ($user_id, $myProfileTypeCode, $activeProfileStr) {
            $q->where('receiver', $user_id)->where('receiver_profile_type', $myProfileTypeCode);
            if ($activeProfileStr) {
                $q->where('profile_str', $activeProfileStr);
            }
        })->orWhere(function ($q) use ($user_id, $myProfileTypeCode, $activeProfileStr) {
            $q->where('sender', $user_id)->where('sender_profile_type', $myProfileTypeCode);
            if ($activeProfileStr) {
                $q->where('sender_profile_str', $activeProfileStr);
            }
        })->pluck('request_id');

        $query = ConversationReply::where('to_id', $user_id)->whereIn('request_id', $matchingRequestIds);

        $max = (clone $query)->selectRaw('MAX(id) AS id')
            ->groupBy(['from_id'])
            ->get()
            ->pluck('id')
            ->toArray();

        $results = (clone $query)->select(['id', 'from_id', 'reply as msg', 'to_id', 'timestamp', 'readstatus', 'request_id'])
            ->whereIn('id', $max)
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        $result = [];
        foreach ($results as $row) {
            $user = UserAccount::select(['profile_pic', 'name', 'location'])
                ->where('user_id', $row->from_id)->first();

            $requestContact = RequestContact::where('request_id', $row->request_id)->first();
            $profileType = ($requestContact && $requestContact->sender === $row->from_id)
                ? $requestContact->sender_profile_type
                : ($requestContact->receiver_profile_type ?? '');

            // Call helper function for profile details
            list($profileName, $profilelink, $category, $contactStatus, $listingLink) =
                self::getProfileNameAndLink($profileType, $row->from_id);

            $result[] = [
                'id' => $row->id,
                'msg' => $row->msg,
                'from_id' => $row->from_id,
                'to_id' => $row->to_id,
                'timestamp' => $row->timestamp,
                'location' => $user->location ?? '',
                'name' => $user->name ?? '',
                'profilepic' => $user->profile_pic ?? '',
                'profileType' => $profileType,
                'profileName' => $profileName,
                'profilelink' => $profilelink,
                'category' => $category,
                'contactStatus' => $contactStatus,
                'listingLink' => $listingLink,
                'request_id' => $row->request_id,
                'readstatus' => $row->readstatus,
            ];
        }

        return response()->json([
            "messages" => $result,
            "unReadNotificationcount" => $query->where('readstatus', 1)->count()
        ]);
    }

    public function updateBxinboxNotification(Request $request)
    {
        $user_id = auth()->user()->user_id;
        $contactedContacts = $request->input('contactedContacts', []);
        $requestId = array_unique($contactedContacts);

        $conversationUpdateQuery = ConversationReply::where('readstatus', 1)
            ->where('to_id', $user_id);

        if (!empty($requestId)) {
            $conversationUpdateQuery->whereIn('request_id', $requestId);
        }

        $updated = $conversationUpdateQuery->update(['readstatus' => 2]);

        return response()->json(['message' => $updated ? 200 : 400]);
    }

    /**
     * Contact requests received by the current user, under the currently-selected
     * profile type (e.g. only requests received as a Mentor, if Mentor is selected).
     */
    public function proposalsReceived()
    {
        $user_id = auth()->user()->user_id;
        $myProfileTypeCode = config('constants.profileTypes.' . ucfirst(session('profile_type', 'investor')));

        $requestsQuery = RequestContact::where('receiver', $user_id)
            ->where('receiver_profile_type', $myProfileTypeCode);

        // Scope to the specific active profile (a user can own more than one
        // profile of the same type) — same granularity as Manage. profile_str
        // already identifies which exact listing was contacted. Skipped when
        // there's no active instance yet, so older rows without this context
        // still show.
        $activeProfileStr = session('active_profile_str');
        if ($activeProfileStr) {
            $requestsQuery->where('profile_str', $activeProfileStr);
        }

        $requests = $requestsQuery->orderBy('timestamp', 'desc')->get();

        $proposals = $this->buildProposalList($requests, 'sender', 'sender_profile_type');

        return view('account_dashboard.proposals', [
            'title' => 'Proposals Received',
            'proposals' => $proposals,
        ]);
    }

    /**
     * Contact requests sent by the current user, under the currently-selected profile type.
     */
    /**
     * Ported from the old ContactHistoryController::getContactHistory() "Investor"
     * branch (Investor/Lender/Mentor all normalize to that branch, since the
     * dashboard only lets a user switch between those three profile types).
     * Shows the Businesses/Startups the current profile type has sent a contact
     * request to, as listing-style cards.
     */
    public function proposalsSent()
    {
        $userId = auth()->user()->user_id;
        $profileType = session('profile_type', 'investor');
        $senderProfileTypeCode = config('constants.profileTypes.' . ucfirst($profileType));

        $contactHistoryQuery = RequestContact::select('profile_str', 'receiver', 'receiver_profile_type', 'status', 'viewed_status')
            ->where('sender', $userId)
            ->where('sender_profile_type', $senderProfileTypeCode)
            ->where('status', config('constants.ProfileStatus.Active'));

        // Scope to the specific active profile the request was sent AS (a user
        // can own more than one profile of the same type) — same granularity
        // as Manage. Skipped when there's no active instance yet, so older
        // rows without this context still show.
        $activeProfileStr = session('active_profile_str');
        if ($activeProfileStr) {
            $contactHistoryQuery->where('sender_profile_str', $activeProfileStr);
        }

        $contactHistory = $contactHistoryQuery->orderBy('request_id', 'desc')->get();

        $proposals = [];
        foreach ($contactHistory as $row) {
            if ($row->receiver_profile_type == config('constants.profileTypes.Business')) {
                $seller = ProfileBusiness::where('business_profile_str', $row->profile_str)
                    ->where('business_profile_status', 1)
                    ->orderBy('business_id', 'desc')
                    ->first();
                if (!$seller) {
                    continue;
                }
                $proposals[] = [
                    'type' => 'Business',
                    'userId' => $seller->user_id,
                    'title' => $seller->advmt_headline,
                    'thumbimage' => (!empty($seller->seller_prof_thumb_pic) && file_exists(public_path($seller->seller_prof_thumb_pic))) ? asset($seller->seller_prof_thumb_pic) : null,
                    'catImageUrl' => randomSubCategoryImage($seller->industry_sector, 360, 202),
                    'price' => getAskingPrice($seller),
                    'priceLabel' => priceLabelBusiness($seller),
                    'industry' => config('industryCategoriesConfig.' . $seller->industry_sector . '.parent_cat'),
                    'location' => getSellerLocation($seller),
                    'profileurl' => '/business/' . Str::slug(trim(strtolower(cleanSpecialChar($seller->advmt_headline))), '-') . '/' . strtolower($seller->business_profile_str),
                    'viewedStatus' => $row->viewed_status,
                ];
            }

            if ($row->receiver_profile_type == config('constants.profileTypes.Startup')) {
                $startup = ProfileStartup::where('startup_profile_str', $row->profile_str)
                    ->where('startup_profile_status', 1)
                    ->orderBy('startup_id', 'desc')
                    ->first();
                if (!$startup) {
                    continue;
                }
                $proposals[] = [
                    'type' => 'Startup',
                    'userId' => $startup->user_id,
                    'title' => $startup->advmt_headline,
                    'thumbimage' => (!empty($startup->startup_prof_thumb_pic) && file_exists(public_path($startup->startup_prof_thumb_pic))) ? asset($startup->startup_prof_thumb_pic) : null,
                    'catImageUrl' => randomSubCategoryImage($startup->industry_sector, 360, 202),
                    'price' => getAskingPrice($startup),
                    'priceLabel' => priceLabelStartup($startup),
                    'industry' => config('industryCategoriesConfig.' . $startup->industry_sector . '.parent_cat'),
                    'location' => getSellerLocation($startup),
                    'profileurl' => '/startup/' . Str::slug(trim(strtolower(cleanSpecialChar($startup->advmt_headline))), '-') . '/' . strtolower($startup->startup_profile_str),
                    'viewedStatus' => $row->viewed_status,
                ];
            }
        }

        return view('account_dashboard.proposals_sent', [
            'title' => 'Proposal Sent for ' . ucfirst($profileType) . ' Profile',
            'proposals' => $proposals,
        ]);
    }

    /**
     * Shared helper: turn a set of RequestContact rows into a display-ready list,
     * enriched with the other party's name/profile-picture/profile-link.
     */
    private function buildProposalList($requests, $otherPartyColumn, $otherPartyTypeColumn)
    {
        $proposals = [];
        foreach ($requests as $row) {
            $otherUserId = $row->{$otherPartyColumn};
            $otherProfileType = $row->{$otherPartyTypeColumn};

            $otherUser = UserAccount::select(['name', 'email', 'profile_pic', 'location'])
                ->where('user_id', $otherUserId)->first();

            list($profileName, $profilelink, $category, $contactStatus, $listingLink) =
                self::getProfileNameAndLink($otherProfileType, $otherUserId);

            $proposals[] = [
                'request_id' => $row->request_id,
                'name' => $otherUser->name ?? '',
                'email' => $otherUser->email ?? '',
                'profilepic' => $otherUser->profile_pic ?? '',
                'location' => $otherUser->location ?? '',
                'msg' => $row->msg,
                'timestamp' => $row->timestamp,
                'status' => $row->status,
                'profileName' => $profileName,
                'profilelink' => $profilelink,
                'category' => $category,
            ];
        }
        return $proposals;
    }
    public static function getProfileNameAndLink($profileType, $userId, $regType = '')
    {
        $profileName = '';
        $profilelink = '';
        $category = '';
        $contactStatus = '';
        $listingLink = '';

        if ($profileType == config('constants.profileTypes.Investor')) {
            $investor = ProfileInvestor::where('user_id', $userId)->first();
            if ($investor) {
                $category = config("industryCategoriesConfig." . $investor->industry_sector . ".category_name");
                $profileName = "Investor";
                list($minInvestment, $maxInvestment) = getInvestmentRange($investor);
                $slugUrl = getSlugUrl($investor, $minInvestment, $maxInvestment);
                $profilelink = '/investor/' . Str::slug(
                    trim(strtolower(cleanSpecialChar($slugUrl))),
                    "-"
                ) . '/' . strtolower($investor->inv_profile_str);
                $contactStatus = $investor->contact_status;
                $listingLink = '/investorlisting';
            }
        }

        if ($profileType == config('constants.profileTypes.Mentor')) {
            $mentor = ProfileMentor::where('user_id', $userId)->first();
            if ($mentor) {
                $categoryResult = IndPrefMentor::select('sub_category_id')->where('user_id', $userId)->first();
                $category = $categoryResult ? config("industryCategoriesConfig." . $categoryResult->sub_category_id . ".category_name") : '';
                $profileName = "Mentor";
                $profilelink = '/mentor/' . Str::slug(
                    trim(strtolower(cleanSpecialChar($mentor->mentor_adv_headline))),
                    "-"
                ) . '/' . strtolower($mentor->mentor_profile_str);
                $contactStatus = $mentor->contact_status;
                $listingLink = '/mentorlisting';
            }
        }

        if ($profileType == config('constants.profileTypes.Startup')) {
            $startup = ProfileStartup::where('user_id', $userId)->first();
            if ($startup) {
                $category = config("industryCategoriesConfig." . $startup->industry_sector . ".category_name");
                $profileName = "Startup";
                $profilelink = '/startup/' . Str::slug(
                    trim(strtolower(cleanSpecialChar($startup->advmt_headline))),
                    "-"
                ) . '/' . strtolower($startup->startup_profile_str);
                $contactStatus = $startup->contact_status;
                $listingLink = '/startupslisting';
            }
        }

        if ($profileType == config('constants.profileTypes.Business')) {
            $business = ProfileBusiness::where('user_id', $userId)->first();
            if ($business) {
                $category = config("industryCategoriesConfig." . $business->industry_sector . ".category_name");
                $profileName = "Business";
                $profilelink = '/business/' . Str::slug(
                    trim(strtolower(cleanSpecialChar($business->advmt_headline))),
                    "-"
                ) . '/' . strtolower($business->business_profile_str);
                $contactStatus = $business->contact_status;
                $listingLink = '/businesslisting';
            }
        }

        if ($profileType == config('constants.profileTypes.Lender')) {
            $lender = ProfileLender::where('user_id', $userId)->first();
            if ($lender) {
                $profileName = "Lender";
                $contactStatus = $lender->contact_status;
            }
        }

        return [$profileName, $profilelink, $category, $contactStatus, $listingLink];
    }
    public function setProfileType(\Illuminate\Http\Request $request, $type, $profileStr = null)
    {
        session(['profile_type' => $type]);

        // A user can have more than one profile of the same type (multiple
        // Business/Startup/etc registrations) — resolve which specific one is
        // now active, falling back to that type's first instance when the
        // caller didn't pass one (or passed something that doesn't belong to
        // this user), so every other code path keyed off active_profile_str
        // always has a valid value once the user has any profile of this type.
        $instances = getUserProfileInstances(Auth::id())[$type] ?? [];
        $activeInstance = null;
        if ($profileStr) {
            foreach ($instances as $instance) {
                if ($instance['profile_str'] === $profileStr) {
                    $activeInstance = $instance;
                    break;
                }
            }
        }
        if (!$activeInstance && !empty($instances)) {
            $activeInstance = $instances[0];
        }
        $activeProfileStr = $activeInstance['profile_str'] ?? null;
        session(['active_profile_str' => $activeProfileStr]);

        // Fall back to the user's own rand id (old single-profile-per-type
        // behaviour) only if this type has no resolved instance at all.
        $userRandId = $activeProfileStr ?? (Auth::user()->user_rand_id ?? null);

        // AJAX callers (e.g. the dashboard-home "Top 5 Recommendations" switcher)
        // just want the session updated without navigating away — everyone else
        // (plain links) keeps the existing full-page redirect behaviour below.
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['status' => 'ok', 'profile_type' => $type, 'active_profile_str' => $activeProfileStr]);
        }

        // If the dropdown was changed while on one of the "My Interactions" tabs
        // (BX Inbox / Proposals Sent / Proposals Received / Instant Responses),
        // stay on that same tab instead of bouncing to Manage — those tabs aren't
        // tied to a specific profile type, so there's nothing to redirect to.
        $referer = $request->headers->get('referer');
        if ($referer) {
            $refererPath = rtrim(parse_url($referer, PHP_URL_PATH) ?? '', '/');
            $interactionPaths = [
                '/dashboard/myinteraction',
                '/dashboard/proposals-sent',
                '/dashboard/proposals-received',
                '/dashboard/instant-responses',
            ];
            if (in_array($refererPath, $interactionPaths, true)) {
                return redirect($referer);
            }
        }

        switch ($type) {
            case 'mentor':
                return redirect()->route('mentor.confidential.edit', ['user_rand_id' => $userRandId]);
            case 'lender':
                return redirect()->route('lender.confidential.edit', ['user_rand_id' => $userRandId]);
            case 'startup':
                return redirect()->route('startup.confidential.edit', ['user_rand_id' => $userRandId]);
            case 'business':
                return redirect()->route('business.confidential.edit', ['user_rand_id' => $userRandId]);
            case 'investor':
            default:
                return redirect()->route('confidential.edit', ['user_rand_id' => $userRandId]);
        }
    }

    public function dashboard()
    {
        $type = session('profile_type', 'investor'); // default investor

        switch ($type) {
            case 'mentor':
                return view('dashboard.mentor');
            case 'lender':
                return view('dashboard.lender');
            case 'investor':
            default:
                return view('dashboard.investor');
        }
    }





}
