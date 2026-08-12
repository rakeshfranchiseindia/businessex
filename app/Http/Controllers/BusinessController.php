<?php

namespace App\Http\Controllers;

use App\Models\ProfileBusiness;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function businessListing(Request $request)
    {
        $businessType = $request->input('business_type', 'all');
        $selectedLocations = array_filter(array_map('intval', (array) $request->input('location', [])));
        $selectedIndustries = array_filter(array_map('intval', (array) $request->input('industry', [])));

        $query = ProfileBusiness::query();

        if (config('constants.ProfileStatus.Active')) {
            $query->where('business_profile_status', config('constants.ProfileStatus.Active'));
        }

        switch ($businessType) {
            case 'sale':
                $query->where('seeking_buyers', 1);
                break;
            case 'investor':
                $query->where('seeking_investors', 1);
                break;
            case 'loan':
                $query->where('seeking_loan', 1);
                break;
            case 'all':
            default:
                break;
        }

        if (!empty($selectedLocations)) {
            $query->whereIn('business_location', $selectedLocations);
        }

        if (!empty($selectedIndustries)) {
            $query->whereIn('business_industry', $selectedIndustries);
        }

        $businesses = $query
            ->orderByDesc('activated_at')
            ->orderByDesc('last_login_at')
            ->paginate(2)
            ->appends($request->except('page'));

        return view('businesslist', compact('businesses', 'businessType'));
    }
}
