<?php

namespace App\Http\Controllers;

use App\Models\ProfileBusiness;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function businessListing(Request $request)
{
    $businessType = $request->input('business_type', 'all');
    $selectedLocations  = array_filter(array_map('intval', (array) $request->input('location', [])));
    $selectedIndustries = array_filter(array_map('intval', (array) $request->input('industry', [])));
    $selectedRange_min  = $request->input('min');
    $selectedRange_max  = $request->input('max');
    $annualSaleMin  = $request->input('annual_sale_min');
    $annualSaleMax  = $request->input('annual_sale_max');
    

    $query = ProfileBusiness::query();

    // Apply active status filter
    $query->where('business_profile_status', config('constants.ProfileStatus.Active'));

    // Business type filter
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

    // Location filter
    if (!empty($selectedLocations)) {
        $query->whereIn('business_location', $selectedLocations);
    }

    // Industry filter
    if (!empty($selectedIndustries)) {
        $query->whereIn('business_industry', $selectedIndustries);
    }

    // Price range filter

    if (!empty($selectedRange_min) && !empty($selectedRange_max)) {
    $query->whereBetween('buyer_sell_price', [(float)$selectedRange_min, (float)$selectedRange_max]);
    } elseif (!empty($selectedRange_min)) {
        $query->where('buyer_sell_price', '>=', (float)$selectedRange_min);
    } elseif (!empty($selectedRange_max)) {
        $query->where('buyer_sell_price', '<=', (float)$selectedRange_max);
    }

    
    // Annual Sale range filter
    if (!is_null($annualSaleMin) && !is_null($annualSaleMax)) {
    $query->whereBetween('annual_sales', [(float)$annualSaleMin, (float)$annualSaleMax]);
    } elseif (!empty($annualSaleMin)) {
        $query->where('annual_sales', '>=', (float)$annualSaleMin);
    } elseif (!empty($annualSaleMax)) {
        $query->where('annual_sales', '<=', (float)$annualSaleMax);
    }
    
     


    //dd($query->toSql(), $query->getBindings());
    $businesses = $query
        ->orderByDesc('activated_at')
        ->orderByDesc('last_login_at')
        ->paginate(2)
        ->appends($request->except('page'));

    return view('businesslist', compact('businesses', 'businessType'));
}

}
