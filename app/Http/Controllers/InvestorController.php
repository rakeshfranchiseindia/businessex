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
        $state          = (array) $request->input('state', []);
        $city           = (array) $request->input('city', []);
        $currentPage    = (int) $request->input('currentPage', 1);
        $itemsPerPage   = (int) $request->input('itemsPerPage', 10);
        $offset         = ($currentPage - 1) * $itemsPerPage;

        $industryMain   = (array) $request->input('industrymain', []);
        $industrySub    = (array) $request->input('industrysub', []);
        $industrySector = array_unique(array_merge($industryMain, $industrySub));

        $invquery = ProfileInvestor::query()
            ->where('profile_investor.inv_profile_status', config('constants.ProfileStatus.Active'));

        // Industry filter
        if (!empty($industrySub)) {
            $invquery->join('ind_pref_investors', 'profile_investor.investor_id', '=', 'ind_pref_investors.investor_profile_id')
                    ->whereIn('ind_pref_investors.sub_category_id', $industrySector)
                    ->groupBy('profile_investor.investor_id');
        }

        // State filter
        if (!empty($state)) {
            if (count($state) > 1) {
                $invquery->whereIn('profile_investor.inv_state', $state);
            } else {
                $invquery->where('profile_investor.inv_state', 'LIKE', '%' . $state[0] . '%');
            }
        }

        // City filter
        if (!empty($city)) {
            if (count($city) > 1) {
                $invquery->whereIn('profile_investor.inv_city', $city);
            } else {
                $invquery->where('profile_investor.inv_city', 'LIKE', '%' . $city[0] . '%');
            }
        }

        // Investment size filter
        $maxInvestment = (int) $request->input('maxInvestment');
        $minInvestment = (int) $request->input('minInvestment');
        if ($maxInvestment && $maxInvestment < 1000000000) {
            $invquery->where(function ($query) use ($minInvestment, $maxInvestment) {
                $query->whereBetween('profile_investor.invest_size_min', [$minInvestment, $maxInvestment])
                    ->orWhereBetween('profile_investor.purchase_capacity_min', [$minInvestment, $maxInvestment]);
            });
        }

        // Investor type filter
        if (!empty($request->input('investorType'))) {
            $invquery->whereIn('profile_investor.inv_type', (array) $request->input('investorType'));
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

        $invquery->orderByRaw("FIELD(profile_investor.membership_plan, 3, 2, 1, 5, 0)");

        // Count before pagination
        $investorCount = $invquery->count();

        // Pagination
        $investors = $invquery->offset($offset)->limit($itemsPerPage)->get();

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
                                        : 'assets/images/profile-dflt.jpg',
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
      
        return view('investorlist', [
            'investorList'   => $investorsList,
            'investorCount'  => $investorCount,
            'offset'         => $offset,
            //'seo'            => $seo,
        ]);
    }

    

}
