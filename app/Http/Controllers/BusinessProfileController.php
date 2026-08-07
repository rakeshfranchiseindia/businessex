<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessProfileController extends Controller
{
    public function createBusinessProfile()
    {
        return view('registration.create-business-profile');
    }
}
