<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserAccount;

class SubscribeController extends Controller
{
    public function newsLetterSubscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'newsletter_name' => 'required|string|max:255',
            'newsletter_email' => 'required|email',
            'newsletter_phone' => 'required|regex:/^[0-9]{10}$/', 
            'newsletter_city' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('scrollTo', 'newslettersection');
        }

        $exist = UserAccount::where('email', $request->newsletter_email)->first();

        if (!$exist) {
            
            return redirect()->back()
                    ->with('error', 'User does not exist')
                    ->with('scrollTo', 'newslettersection');
        }

        CommonController::subscribeNewsLetter($exist->user_id, $request->newsletter_email);

        return redirect()->back()
                ->with('success', 'Subscribed successfully!')
                ->with('scrollTo', 'newslettersection');
    }

}