<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvestorProfileController extends Controller
{
    public function createInvestorProfile(){
        return view('registration.create-investor-profile');
    }
}
