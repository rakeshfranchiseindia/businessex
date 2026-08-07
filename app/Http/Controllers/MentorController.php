<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function mentorListing(Request $request)
    {
        $mentorlist = collect(); 
        return view('mentorlist', compact('mentorlist'));
    }
}
