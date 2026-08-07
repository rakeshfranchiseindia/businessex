<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function businessListing(Request $request)
    {
        $businesses = collect(); 
        return view('businesslist', compact('businesses'));
    }
}
