<?php

namespace App\Http\Controllers;

use App\Models\ProfileBusiness;
use App\Models\BxCity;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function businessListing(Request $request)
{
    $perPage = config('constants.pagination.items_per_page');
    
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
        $locationNames = BxCity::query()
            ->whereIn('id', $selectedLocations)
            ->get(['city', 'state'])
            ->flatMap(fn ($location) => [$location->city, $location->state])
            ->filter()
            ->unique()
            ->values();

        if ($locationNames->isEmpty()) {
            $query->whereRaw('1 = 0');
        } else {
            $query->where(function ($locationQuery) use ($locationNames) {
                $locationQuery
                    ->whereIn('ofc_city', $locationNames)
                    ->orWhereIn('ofc_state', $locationNames);
            });
        }
    }

    // Industry filter
    if (!empty($selectedIndustries)) {
        $query->whereIn('industry_sector', $selectedIndustries);
    }

    // Price range filter

    if (!empty($selectedRange_min) && !empty($selectedRange_max)) {
    $query->whereRaw('CAST(buyer_sell_price AS DECIMAL(20, 2)) BETWEEN ? AND ?', [(float) $selectedRange_min, (float) $selectedRange_max]);
    } elseif (!empty($selectedRange_min)) {
        $query->whereRaw('CAST(buyer_sell_price AS DECIMAL(20, 2)) >= ?', [(float) $selectedRange_min]);
    } elseif (!empty($selectedRange_max)) {
        $query->whereRaw('CAST(buyer_sell_price AS DECIMAL(20, 2)) <= ?', [(float) $selectedRange_max]);
    }

    
    // Annual Sale range filter
    if (!is_null($annualSaleMin) && !is_null($annualSaleMax)) {
    $query->whereRaw('CAST(annual_sales AS DECIMAL(20, 2)) BETWEEN ? AND ?', [(float) $annualSaleMin, (float) $annualSaleMax]);
    } elseif (!empty($annualSaleMin)) {
        $query->whereRaw('CAST(annual_sales AS DECIMAL(20, 2)) >= ?', [(float) $annualSaleMin]);
    } elseif (!empty($annualSaleMax)) {
        $query->whereRaw('CAST(annual_sales AS DECIMAL(20, 2)) <= ?', [(float) $annualSaleMax]);
    }
    
     


    //dd($query->toSql(), $query->getBindings());
    $businesses = $query
        ->orderByDesc('activated_at')
        ->orderByDesc('last_login_at')
        ->paginate($perPage)
        ->appends($request->except('page'));

    return view('businesslist', compact('businesses', 'businessType'));
}

        public function businessDetail($business_profile)
        {
            $business = ProfileBusiness::with(['images', 'management'])
                ->where('business_profile_status', config('constants.ProfileStatus.Active'))
                ->where('business_id', $business_profile)
                ->firstOrFail();

            return view('bx-business-details', compact('business'));
        }

}
