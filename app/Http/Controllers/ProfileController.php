<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProfileInvestor;
use App\Models\LocPrefInvestor;
use App\Models\IndPrefInvestor;
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
        $user = User::where('email', 'shivani@gmail.com')->first();
        // $user = Auth::user();echo '<pre>'; print_r($user); die;
        // Check Old Password
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
        return redirect('/forgot-password')->with('success', 'Password reset successfully. Please login.');
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
        // return view('profile.confidential_info', compact('user'));
        return view('account_dashboard.investorConfidentials', compact('user'));

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
        return redirect()->back()->with('success', 'Information updated successfully!');
    }

    public function getInvestorAdvertisementDetails($investorUniqueId = null)
    {
        $invAdvRecord = ProfileInvestor::select(
            'inv_profile_str',
            'inv_headline',
            'inv_intro'
        )
            ->where('inv_profile_str', $investorUniqueId)
            ->first();

        $user = UserAccount::where('user_id', Auth::id())->firstOrFail();
        return view('account_dashboard.investorAdvertisement', compact('invAdvRecord', 'user'));
    }
    public function updateInvestorProfileDetails(Request $request, $uniqueid = null)
    {
        $request->validate([
            'inv_headline' => 'required|string|max:255',
            'inv_intro' => 'nullable|string',
        ]);
        $user = UserAccount::where('user_id', Auth::id())->firstOrFail();
        $profile = ProfileInvestor::where('user_id', Auth::id())
            ->where('inv_profile_str', $uniqueid ?? $user->user_rand_id)
            ->first();
        if ($profile) {
            // Update
            $profile->update([
                'inv_headline' => $request->inv_headline,
                'inv_intro' => $request->inv_intro,
                'inv_profile_status' => 1,
            ]);
            $message = 'Investor Profile Updated Successfully';
        } else {
            ProfileInvestor::create([
                'user_id' => Auth::id(),
                'inv_profile_str' => $uniqueid ?? $user->user_rand_id,
                'inv_headline' => $request->inv_headline,
                'inv_intro' => $request->inv_intro,
                'inv_profile_status' => 1,
            ]);
            $message = 'Investor Profile Created Successfully';
        }
        return redirect()->back()->with('success', $message);
    }
    public function getInvestorPreferenceDetails($user_rand_id)
    {
        $invPreference = ProfileInvestor::query()->select('investor_id', 'inv_profile_str')->where('inv_profile_str', $user_rand_id)->first();
        if (!$invPreference) {
            return redirect()->back()->with('success', 'No Data Found');
        }
        $indPref = IndPrefInvestor::join(
            'industry_categories','ind_pref_investors.sub_category_id','=','industry_categories.cat_id')->where('ind_pref_investors.investor_profile_id',
            $invPreference->investor_id)->select('industry_categories.cat_id as id','industry_categories.category_name as name','industry_categories.parent_id as pid')->get();
            
            $locationPref = LocPrefInvestor::query()->select('location_name')->where('investor_profile_id', $invPreference->investor_id)
            ->orderBy('inv_loc_id', 'desc')
            ->get();
        return view('account_dashboard.investorMultiPref', compact('invPreference','indPref','locationPref'));
    }
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
    public function investorUpdate(Request $request)
    {
        $uniqueid = Auth::user()->user_rand_id;
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
        $investmentSelected = $request->has('invest_pref');
        $acquisitionSelected = $request->has('full_acquisition');

        if (!$investmentSelected && !$acquisitionSelected) {
            return back()
                ->withInput()
                ->withErrors([
                    'invest_pref' => 'Please Select atleast one'
                ]);
        }
        $investor = ProfileInvestor::where(
            'inv_profile_str',
            $uniqueid
        )->first();

        $investSizeMin = $investmentSelected
            ? ($request->input('invest_size_min') ?: 0)
            : 0;

        $investSizeMax = $investmentSelected
            ? ($request->input('invest_size_max') ?: 0)
            : 0;

        $investStake = $investmentSelected
            ? ($request->input('invest_stake') ?: 0)
            : 0;

        $purchaseCapacityMin = $acquisitionSelected
            ? ($request->input('purchase_capacity_min') ?: 0)
            : 0;

        $purchaseCapacityMax = $acquisitionSelected
            ? ($request->input('purchase_capacity_max') ?: 0)
            : 0;
        $data = [
            'inv_profile_str' => $uniqueid,
            'company_name' => $request->input('company_name'),
            'company_designation' => $request->input('company_designation'),
            'invest_pref' => $investmentSelected ? 1 : 0,
            'full_acquisition' => $acquisitionSelected ? 1 : 0,
            'invest_size_min' => $investSizeMin,
            'invest_size_max' => $investSizeMax,
            'invest_stake' => $investStake,
            'purchase_capacity_min' => $purchaseCapacityMin,
            'purchase_capacity_max' => $purchaseCapacityMax,
            'inv_abt_urself' => $request->input('inv_abt_urself'),
            'linkedin_profile' => $request->input('linkedin_profile'),
        ];
        if ($request->hasFile('inv_profile_pic_path')) {

            $imagePic = $request->file('inv_profile_pic_path');

            $imgExt = $imagePic->getClientOriginalExtension();

            $investorProfile = config(
                'constants.InvestorProfileImagePath'
            );
            $imgProfilePath = sprintf(
                $investorProfile,
                date('Ym'),
                random_int(100, 99999) . '_' . time(),
                $imgExt
            );
            $imageName = $this->imageUploadPost(
                $imgProfilePath,
                $imagePic
            );
            if (!$imageName) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'inv_profile_pic_path' => 'Profile image upload failed.'
                    ]);
            }

            if ($investor && !empty($investor->inv_profile_pic_path)) {
                $this->deleteUploadedImage(
                    $investor->inv_profile_pic_path
                );
            }

            $data['inv_profile_pic_path'] = $imageName;
        }

        ProfileInvestor::updateOrCreate(
            [
                'inv_profile_str' => $uniqueid
            ],
            $data
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Individual Investor Details Updated Successfully'
            );
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


}
