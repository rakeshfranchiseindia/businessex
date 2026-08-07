<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceListingController extends Controller
{
    public function businessValuation()
    {
        return view('services.business-valuation');
    }

    public function businessPlan()
    {
        return view('services.business-plan');
    }

    public function dueDiligence()
    {
        return view('services.due-diligence');
    }

    public function certifiedBusinessBroker()
    {
        return view('services.certified-business-broker');
    }
}
