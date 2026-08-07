<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvestorController extends Controller
{
    public function investorListing(Request $request)
    {
        $investorlist = collect(); 
        return view('investorlist', compact('investorlist'));
    }
}
