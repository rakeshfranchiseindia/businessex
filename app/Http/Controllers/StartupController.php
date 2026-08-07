<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StartupController extends Controller
{
    public function startupListing(Request $request)
    {
        $startuplist = collect(); 
        return view('startuplist', compact('startuplist'));
    }
}
