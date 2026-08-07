<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MentorProfileController extends Controller
{
    public function createMentorProfile()
    {
        return view('registration.create-mentor-profile');
    }
}
