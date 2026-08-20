<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserAccount;

class SubscribeController extends Controller
{
    /**
     * Handle newsletter subscription requests.
     */
    public function newsLetterSubscribe(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'newsletter_name'   => 'required|string|max:255',
            'newsletter_email'  => 'required|email',
            'newsletter_phone'  => 'required|regex:/^[0-9]{10}$/',
            'newsletter_city'   => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check if user exists
        $exist = UserAccount::where('email', $request->newsletter_email)->first();

        if (!$exist) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => 'User does not exist'
                ], 404);
            }

            return redirect()
                ->back()
                ->with('error', 'User does not exist');
        }

        // Subscribe user to newsletter
        CommonController::subscribeNewsLetter($exist->user_id, $request->newsletter_email);

        if ($request->ajax()) {
            return response()->json([
                'success' => 'Subscribed successfully!'
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Subscribed successfully!');
    }
}