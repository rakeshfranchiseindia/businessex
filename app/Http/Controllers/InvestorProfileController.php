<?php
namespace App\Http\Controllers;

use App\Models\ProfileInvestor;
use App\Models\IndPrefInvestor;
use App\Models\LocPrefInvestor;
use App\Models\UserAccount;
use App\Models\UserProfile;
use App\Models\BxCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\ProfileCreation;

class InvestorProfileController extends Controller
{
    /**
     * Display the investor profile creation form
     */
    public function createInvestorProfile()
    {
        $locations = BxCity::orderBy('state')->orderBy('city')->get();
        return view('registration.create-investor-profile', compact('locations'));
    }

    /**
     * Store the investor profile data
     */
    public function createInvestor(Request $request)
    {
        return $this->store($request);
    }

    public function store(Request $request)
    {
        // ✅ Validate form input
        $validated = $request->validate([
            'name'                  => ['required', 'string', 'regex:/^[A-Za-z][A-Za-z .\'-]*$/', 'max:255'],
            'email'                 => ['required', 'email', 'not_regex:/@(sample\.com|example\.com|test\.com)$/i', 'max:100', 'unique:profile_investor,inv_email'],
            'mobile'                => 'required|digits:10',
            'location'              => 'required|string|max:255',
            'location_place_id'     => 'required|string|max:255',
            'headline'              => 'nullable|string|min:25|max:255',
            'introduction'          => 'nullable|string|min:25|max:255',
            'inv_type'              => 'required|in:Individual Investor,Investment Firm',
            'linkedin_profile'      => 'nullable|url|max:255',
            'location_preference'   => 'nullable|array',
            'location_preference.*' => 'integer|exists:bx_cities,id',
            'sector_preference'     => 'nullable|array',
            'sector_preference.*'   => ['string', 'regex:/^\d+_\d+$/'],
            'invest_pref'           => 'nullable|in:1',
            'full_acquisition'      => 'nullable|in:1',
            'invest_size_min'       => 'nullable|numeric|min:0',
            'invest_size_max'       => 'nullable|numeric|min:0',
            'purchase_capacity_min' => 'nullable|numeric|min:0',
            'purchase_capacity_max' => 'nullable|numeric|min:0',
            'inv_abt_urself'       => 'nullable|string',
            'company_name'          => 'nullable|string|min:15|max:50',
            'company_designation'   => 'nullable|string|max:100',
        ]);

        $investmentSelected = $request->has('invest_pref');
        $acquisitionSelected = $request->has('full_acquisition');

        // Get authenticated user ID
        $userId = Auth::id();
        if (!$userId) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'User not authenticated. Please login first.']);
        }

        $invProfileStr = CommonController::profileUniqueStr();

        $companyLogo = null;
        $imageName   = null;

        // ✅ Handle uploads based on investor type
        if ($request->hasFile('company_logo_path') && $request->input('inv_type') === 'Investment Firm') {
            $imagePic = $request->file('company_logo_path');
            $imgExt   = $imagePic->getClientOriginalExtension();
            $companyLogoName = config('constants.InvestorLogoImagePath');
            $companyLogoPath = sprintf($companyLogoName, date('Ym'), random_int(100, 99999) . '_' . time(), $imgExt);
            $companyLogo     = CommonController::imageUploadPost($companyLogoPath, $imagePic);
        }

        if ($request->hasFile('inv_profile_pic_path') && $request->input('inv_type') === 'Individual Investor') {
            $imagePic = $request->file('inv_profile_pic_path');
            $imgExt   = $imagePic->getClientOriginalExtension();
            $investorProfile = config('constants.InvestorProfileImagePath');
            $imgProfilePath  = sprintf($investorProfile, date('Ym'), random_int(100, 99999) . '_' . time(), $imgExt);
            $imageName       = CommonController::imageUploadPost($imgProfilePath, $imagePic);
        }

        DB::beginTransaction();

        try {
            // ✅ Determine investor type (2 = Individual, 1 = Firm)
            $invTypeCode = ($request->input('inv_type') === 'Investment Firm') ? 1 : 2;

            // ✅ Save Investor Profile
            $investor = new ProfileInvestor();
            $investor->fill([
                'inv_profile_str'       => $invProfileStr,
                'user_id'               => $userId,
                'inv_name'              => $request->input('name'),
                'inv_email'             => $request->input('email'),
                'inv_mobile'            => $request->input('mobile'),
                'inv_city'              => trim($request->input('location'), '"'),
                'inv_headline'          => $request->input('headline'),
                'inv_intro'             => $request->input('introduction'),
                'inv_type'              => $invTypeCode,
                'invest_pref'           => $investmentSelected ? 1 : 0,
                'full_acquisition'      => $acquisitionSelected ? 1 : 0,
                'invest_size_min'       => $investmentSelected ? ($request->input('invest_size_min') ?? 0) : 0,
                'invest_size_max'       => $investmentSelected ? ($request->input('invest_size_max') ?? 0) : 0,
                'purchase_capacity_min' => $acquisitionSelected ? ($request->input('purchase_capacity_min') ?? 0) : 0,
                'purchase_capacity_max' => $acquisitionSelected ? ($request->input('purchase_capacity_max') ?? 0) : 0,
                'inv_abt_urself'       => $request->input('inv_abt_urself'),
                'linkedin_profile'      => $request->input('linkedin_profile'),
                'company_name'          => $request->input('company_name'),
                'company_designation'   => $request->input('company_designation'),
                'inv_profile_pic_path'  => $imageName,
                'company_logo_path'     => $companyLogo,
                'inv_profile_status'    => config('constants.ProfileStatus.Awaiting'),
            ]);
            $investor->save();

            $lastInsertId = $investor->investor_id;

            // ✅ Industry Preferences
            $sectorPreferences = $request->input('sector_preference', $request->input('industry_pref', []));
            if (!empty($sectorPreferences)) {
                foreach ((array) $sectorPreferences as $pref) {
                    $pref = trim($pref);
                    if (!empty($pref)) {
                        $parts = explode('_', $pref);
                        IndPrefInvestor::create([
                            'investor_profile_id' => $lastInsertId,
                            'user_id'             => $userId,
                            'parent_category_id'  => $parts[1] ?? null,
                            'sub_category_id'     => $parts[0] ?? null,
                            'profile_status'      => config('constants.ProfileStatus.Awaiting'),
                        ]);
                    }
                }
            }

            // ✅ Location Preferences
            $locationPreference = $request->input('location_preference', $request->input('location_pref', []));
            foreach ((array) $locationPreference as $cityId) {
                $city = BxCity::find($cityId);
                if ($city) {
                    LocPrefInvestor::create([
                        'investor_profile_id' => $lastInsertId,
                        'user_id'             => $userId,
                        'place_id'            => (string) $city->id,
                        'location_name'       => $city->city . ', ' . $city->state,
                        'loc_state'           => $city->state,
                        'loc_country'         => 'India',
                        'loc_latitude'        => '',
                        'loc_longitude'       => '',
                        'profile_status'     => config('constants.ProfileStatus.Awaiting'),
                    ]);
                }
            }

            // ✅ Update User & UserProfile
            $user = UserAccount::find($userId);
            if ($user && $user->reg_profile === null) {
                $user->update(['reg_profile' => 'Investor']);
            }

            UserProfile::create([
                'user_id'        => $userId,
                'profile_id'     => $lastInsertId,
                'profile_type'   => config('constants.profileTypes.Investor'),
                'profile_str'    => $invProfileStr,
                'profile_status' => config('constants.ProfileStatus.Awaiting'),
            ]);

            DB::commit();

            // ✅ Send Mail
            try {
                $MailData = [$request->input('name'), 'Investor', $request->input('inv_type')];
                Mail::to($user->email)->send(new ProfileCreation($MailData));
            } catch (\Exception $e) {
                Log::alert("Mail sending failed for {$user->email} -- {$e->getMessage()}");
            }

            return redirect()
                ->back()
                ->with('success', 'Investor Profile Registration Successful. Please check your email for confirmation.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Investor Registration Failed: " . $e->getMessage());
            if ($imageName) {
                try {
                    Storage::disk('s3')->delete($imageName);
                } catch (\Exception $ex) {
                    Log::warning("Failed to delete profile image: {$ex->getMessage()}");
                }
            }
            if ($companyLogo) {
                try {
                    Storage::disk('s3')->delete($companyLogo);
                } catch (\Exception $ex) {
                    Log::warning("Failed to delete company logo: {$ex->getMessage()}");
                }
            }

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Investor registration failed: ' . $e->getMessage()]);
        }
    }
}
