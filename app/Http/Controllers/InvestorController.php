<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Helpers\BusinessExHelper;
use Illuminate\Http\Request;
use App\Models\ProfileInvestor;
use App\Models\LocPrefInvestor;
use App\Models\MobileVerification;
use App\Models\IndPrefInvestor;
use App\Models\IndPrefMentorExpertise;
use App\Models\Seo;
use Illuminate\Support\Str;

class InvestorController extends Controller
{
        public function investorListing(Request $request)
    {
        $state          = collect((array) $request->input('state', []))->filter()->values()->all();
        $city           = collect((array) $request->input('city', []))->filter()->values()->all();
        $currentPage    = max(1, (int) $request->input('currentPage', 1));
        $itemsPerPage   = 3;

        $industryMain   = collect((array) $request->input('industrymain', []))->map(fn ($value) => (int) $value)->filter()->values()->all();
        $industrySub    = collect((array) $request->input('industrysub', []))->map(fn ($value) => (int) $value)->filter()->values()->all();
        $industrySector = array_unique(array_merge($industryMain, $industrySub));

        $invquery = ProfileInvestor::query()
            ->where('profile_investor.inv_profile_status', config('constants.ProfileStatus.Active'));

        // Industry filter
        if (!empty($industrySector)) {
            $invquery->whereHas('industryPreferences', function ($query) use ($industrySector) {
                $query->whereIn('sub_category_id', $industrySector);
            });
        }

        // Location filter uses the investor's preferred locations from the sidebar.
        $locationFilters = array_values(array_unique(array_merge($state, $city)));
        if (!empty($locationFilters)) {
            $invquery->whereHas('locationPreferences', function ($query) use ($locationFilters) {
                $query->where(function ($locationQuery) use ($locationFilters) {
                    foreach ($locationFilters as $location) {
                        $locationQuery->orWhere('location_name', 'LIKE', '%' . $location . '%')
                            ->orWhere('loc_state', 'LIKE', '%' . $location . '%');
                    }
                });
            });
        }

        // Investment size filter
        $maxInvestment = (int) $request->input('maxInvestment', 1000000000);
        $minInvestment = (int) $request->input('minInvestment', 0);
        if ($minInvestment > 0 || $maxInvestment < 1000000000) {
            $invquery->where(function ($query) use ($minInvestment, $maxInvestment) {
                foreach ([
                    ['min' => 'invest_size_min', 'max' => 'invest_size_max'],
                    ['min' => 'purchase_capacity_min', 'max' => 'purchase_capacity_max'],
                ] as $range) {
                    $query->orWhere(function ($rangeQuery) use ($range, $minInvestment, $maxInvestment) {
                        $rangeQuery
                            ->whereRaw('CAST(profile_investor.' . $range['max'] . ' AS DECIMAL(20, 2)) >= ?', [$minInvestment])
                            ->whereRaw('CAST(profile_investor.' . $range['min'] . ' AS DECIMAL(20, 2)) <= ?', [$maxInvestment]);
                    });
                }
            });
        }

        // Investor type filter
        $investorTypes = collect((array) $request->input('investorType', []))
            ->map(fn ($value) => (int) $value)
            ->filter()
            ->values()
            ->all();
        if (!empty($investorTypes)) {
            $invquery->whereIn('profile_investor.inv_type', $investorTypes);
        }

        // Sorting
        $sortby = $request->input('sortby');
        if (empty($sortby)) {
            $invquery->orderBy('profile_investor.membership_paid', 'DESC');
        } elseif ($sortby === 'desc') {
            $invquery->orderBy('profile_investor.invest_size_max', 'DESC');
        } elseif ($sortby === 'asc') {
            $invquery->orderBy('profile_investor.invest_size_max', 'ASC');
        } elseif ($sortby === 'created_at') {
            $invquery->orderBy('profile_investor.created_at', 'DESC');
        }

        $invquery->orderByRaw("CASE profile_investor.membership_plan WHEN 3 THEN 1 WHEN 2 THEN 2 WHEN 1 THEN 3 WHEN 5 THEN 4 WHEN 0 THEN 5 ELSE 6 END");

        // Paginate after all filters and sorting have been applied.
        $investors = $invquery->paginate($itemsPerPage, ['*'], 'currentPage', $currentPage);
        $investorCount = $investors->total();

        $investorsList = [];
        foreach ($investors as $investor) {
            // Location preferences
            $locationPref = LocPrefInvestor::select('location_name')
                ->where('investor_profile_id', $investor->investor_id)
                ->orderBy('inv_loc_id', 'desc')
                ->get();

            $locPrefStr = $locationPref->pluck('location_name')->implode(', ');
            $locDetails = $locationPref->count() > 1
                ? $locationPref[0]->location_name . ' +' . ($locationPref->count() - 1) . ' more'
                : ($locationPref->count() === 1 ? $locationPref[0]->location_name : '');

            // Industry preferences
            $result = IndPrefInvestor::select('sub_category_id')
                ->where('investor_profile_id', $investor->investor_id)
                ->get();

            $catName = $result->pluck('sub_category_id')
                ->map(fn($id) => config('industryCategoriesConfig.' . $id . '.category_name'))
                ->implode(',');

            // Firm type
            $investorfirmType = $investor->inv_type == 1
                ? config('constants.investorFirmType.' . $investor->firm_type)
                : '';

            [$minInvestment, $maxInvestment] = CommonController::getInvestmentRange($investor);
            $invTitleLoc = $investor->inv_city ?: 'India';
            $slugUrl = $investor->inv_headline ?: sprintf(config('constants.InvestorTitlePattern'), $invTitleLoc, $minInvestment, $maxInvestment);

            $investorsList[] = [
                'investorId'         => $investor->investor_id,
                'investorName'       => $investor->inv_name,
                'investorTitle'      => sprintf(config('constants.InvestorTitlePattern'), $invTitleLoc, $minInvestment, $maxInvestment),
                'locations'          => $locPrefStr,
                'investorType'       => config('constants.investorType.' . $investor->inv_type),
                'investorfirmType'   => $investorfirmType,
                'locationDetails'    => $locDetails,
                'sectorPref'         => $catName,
                'mobVerifyStatus'    => MobileVerification::isMobileNoVerified($investor->user_id),
                'investorCountry'    => $investor->inv_country,
                'companyName'        => $investor->company_name,
                'designation'        => $investor->company_designation,
                'investmentPref'     => CommonController::getInvestmentPreference($investor),
                'minInvestment'      => $minInvestment,
                'maxInvestment'      => $maxInvestment,
                'investorStr'        => strtolower($investor->inv_profile_str),
                'investorCity'       => $investor->inv_city,
                'investorState'      => config('constants.statesIndia.' . $investor->inv_state),
                'investorSummary'    => $investor->inv_abt_urself,
                'investorProfPic'    => $investor->inv_profile_pic_path
                                        ? config('constants.ImageCDN') . '/' . $investor->inv_profile_pic_path
                                        : 'assets/img/profile-dflt.jpg',
                'investorurl'        => Str::slug(CommonController::cleanSpecialChar($slugUrl), '-'),
                'companyLogo'        => $investor->company_logo_path
                                        ? config('constants.ImageCDN') . '/' . $investor->company_logo_path
                                        : '',
                'investorProfPicName'=> $investor->inv_profile_pic_name,
                'membership_paid'    => $investor->membership_paid,
                'membership_plan'    => $investor->membership_plan,
                'investorPlan'       => config('constants.planType.' . $investor->membership_plan),
            ];
        }

        $industries =  BusinessExHelper::getIndustrySeller();
        // $seo = Seo::getSeoContent($industryMain, $industrySub, $industries[1], config('constants.profileTypes.Investor'));
        // [$title, $keyword, $description, $metaDescription] = BusinessExHelper::getDefaultSeo(
        //     $industryMain, $industrySub, $industries, $state, $city, $investorCount, $seo
        // );

        // $seo['title']           = $seo['title'] ?: $title;
        // $seo['keyword']         = $seo['keyword'] ?: $keyword;
        // $seo['description']     = $description;
        // $seo['meta_description']= $metaDescription;
       
      //print_r($investorsList); exit;
        return view('investorlist', [
            'investorList'   => $investorsList,
            'investorCount'  => $investorCount,
            'offset'         => $investors->firstItem() ? $investors->firstItem() - 1 : 0,
            'investors'      => $investors,
            //'seo'            => $seo,
        ]);
    }

    public function investorDetail($investor_profile)
    {
        $investor = ProfileInvestor::with(['industryPreferences', 'locationPreferences'])
            ->where('inv_profile_status', config('constants.ProfileStatus.Active'))
            ->where('investor_id', $investor_profile)
            ->firstOrFail();

        return view('bx-investor-details', compact('investor'));
    }

}
