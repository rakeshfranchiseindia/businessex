<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmailMail;


class ProfileController extends Controller
{

    public function changePassword()
    {
        return view('profile.change-password');
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
        return view('profile.investor-profile', compact('user'));

    }
    public function userEditPage(Request $request)
    {
        $user_id = Auth::id();
        $user = UserAccount::findOrFail($user_id);
        return view('profile.userEdit', compact('user'));
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
        return view('profile.confidential_info', compact('user'));

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
    public function advert_detail($user_rand_id)
    {
        $user = UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
        return view('profile.confidential_advert', compact('user'));
    }
    public function advertisement_add(Request $request, $user_rand_id)
    {
        // $request->validate([
        //     'headline' => 'required|string|max:255',
        //     'introduction' => 'nullable|string|max:1000',
        // ]);

        // $advertisement = ::where('user_rand_id', $user_rand_id)->firstOrFail();

        // $advertisement->advertisement_headline = $request->headline;
        // $advertisement->advertisement_intro = $request->introduction;
        // $advertisement->save();
        // return redirect()->back()->with('success', 'Advertisement details updated successfully!');
    }


}
