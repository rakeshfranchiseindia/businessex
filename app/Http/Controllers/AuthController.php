<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerifyEmailMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

require_once app_path('Helpers/common_helper.php');

class AuthController extends Controller
{
    // Show registration form
    public function showRegister()
    {
        return view('register');
    }

    // Handle registration
    public function quickRegister(Request $request)
    {

        $request->validate([
            'profile' => 'required|in:1,2,3,4',
            'name' => 'required|string|max:255',
            'phone_number' => [
                'required',
                'regex:/^[6-9]\d{9}$/'
            ],
            'email' => 'required|email|unique:user_account,email',
            'company' => 'nullable|string|max:255',
        ]);
        $token = Str::random(32);
        $password = Str::random(10);
        $user = UserAccount::create([
            'profile' => $request->profile,
            'name' => $request->name,
            'mobile' => $request->phone_number,
            'email' => $request->email,
            'company_name' => $request->company,
            'verify_token' => $token,
            'user_rand_id' => strtolower(Str::random(6)),
            'password' => Hash::make($password),
        ]);
        // Send custom verification email
        try {
            Mail::to($user->email)->send(new VerifyEmailMail($token));
            return redirect()->back()->with('success', 'Registration submitted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('email_error', 'Failed to send verification email. Please try again later.');

        }

    }
    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard/myaccount');
        }

        return back()->withErrors(['login_email' => 'Invalid email address or password'])->onlyInput('email');
    }

    // My Account
    public function myaccount()
    {
        return view('dashboard.myaccount', ['user' => Auth::user()]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function verifyEmail($token)
    {
        $user = UserAccount::where('verify_token', $token)->first();
        if (!$user) {
            return redirect('/')->with('error', 'Invalid verification link.');
        }
        $user->email_verified_at = now();
        $user->verify_token = null;
        $user->save();
        return redirect('/login')->with('success', 'Your email has been verified. You can now log in.');
    }

}
