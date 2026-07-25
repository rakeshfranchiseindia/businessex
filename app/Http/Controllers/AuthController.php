<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



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
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|unique:user_account,email',
            'company' => 'nullable|string|max:255',
        ]);

        

        UserAccount::create([
            'profile' => $request->profile,
            'name' => $request->name,
            'mobile' => $request->phone_number,
            'email' => $request->email,
            'company_name' => $request->company,
        ]);

        return redirect()->back()->with('success', 'Registration submitted successfully!');
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
}
