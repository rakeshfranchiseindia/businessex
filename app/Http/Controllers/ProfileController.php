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
        $user = UserAccount::select('name','email','location','company_name','designation','mobile')
        ->where('user_id', $user_id)
        ->first();
        return view('profile.investor-profile',compact('user'));

    }

}
