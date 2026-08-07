<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StartupProfileController extends Controller
{
    public function createStartupProfile()
    {
        return view('registration.create-startup-profile');
    }
}
