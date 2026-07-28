<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

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
        $user = User::where('email','shivani@gmail.com')->first();

        // $user = Auth::user();echo '<pre>'; print_r($user); die;
        // Check Old Password
        if(!Hash::check($request->old_password, $user->password))
        {
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

}
