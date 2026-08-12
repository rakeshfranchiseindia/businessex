<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function priceListing(Request $request)
    {
            $membership = $request->query('membership');
            if (!$membership) {
                return view('pricing');
            }

            // Allowed memberships
            $allowed = ['platinum', 'gold', 'premium'];

            if (!in_array($membership, $allowed)) {
                abort(404);
            }
            return view('pricing', compact('membership'));
    }
}
