<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerifyEmailMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    // Show registration form
    public function showRegister() {
        return view('register');
    }

    // Handle registration
    public function quickRegister(Request $request) {
        
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
        $user  = UserAccount::create([
            'profile' => $request->profile,
            'name' => $request->name,
            'mobile' => $request->phone_number,
            'email' => $request->email,
            'company_name' => $request->company,
            'verify_token' =>$token
        ]);

        // Send custom verification email
        
        try {
            Mail::to($user->email)->send(new VerifyEmailMail($token));
            return redirect()->back()->with('success', 'Registration submitted successfully!');
        
        } catch (\Exception $e) {
            return redirect()->back()->with('email_error', 'Failed to send verification email. Please try again later.');
           
        }
        
    }

    // Show login form
    public function showLogin() {
        return view('login');
    }

    // Handle login
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    // Dashboard
    public function dashboard() {
        return view('dashboard');
    }

    // Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }


    public function verifyEmail($token) {
            $user = UserAccount::where('verification_token', $token)->first();

            if (!$user) {
                return redirect('/')->with('error', 'Invalid verification link.');
            }

            $user->email_verified_at = now();
            $user->verification_token = null;
            $user->save();

            return redirect('/login')->with('success', 'Your email has been verified. You can now log in.');
    }

}
