<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cities;
use App\Models\IndustryCategory;
use App\Models\IndustrySectorIncubatorStartup;
use App\Models\IndustrySectorMentorBusiness;
use App\Models\IndustrySectorMentorStartup;
use App\Models\ProfileStartupFundRaising;
use App\Models\ProfileStartupMgmt;
use App\Models\Seo;
use App\Models\Startup;
use App\Models\StartupImage;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\MobileVerification;
use App\Models\BxNews;
use App\Models\ProfileInvestor;
use App\Models\ProfileBusiness;
use App\Models\ProfileStartup;
use App\Models\ProfileMentor;
use App\Models\ProfileMentorProfExp;
use App\Models\IndPrefMentorExpertise;
use App\Models\IndPrefMentor;
use App\Models\BxAuthor;
use App\Models\BxArticle;
use App\Models\Testimonial;
use Carbon\Carbon;


use Illuminate\Support\Facades\Http;


use App\Helper\CacheHelper;
use App\Mail\InvRegVerify;
use App\Mail\ProfileCreation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{

    public function home()
    {
         $testimonials = Testimonial::all();
        //return view('index', compact('testimonials'));
        //return $this->getBxNewsHomeListing();
        [$businessList, $parentChild] = $this->getIndustrySeller();
        return view('index', [
            'industrySeller' => $businessList,
            'parentChildCategoryId' => $parentChild,
            'testimonials' => $testimonials
        ]);

    }
        
    

    // Get industry category list for home page
    public function getIndustrySeller()
    {
        $businessList = [];
        $industrySeller = IndustryCategory::query()
            ->select('cat_id as industry_sector')
            ->where('parent_id','!=',0)
            ->get();

            //dd($industrySeller->toArray());

        $parentChild = [];

        foreach ($industrySeller as $item) {
            $sectorId = $item['industry_sector'];

            $subIndustry   = config("industryCategoriesConfig.$sectorId.category_name");
            $subIndustryId = config("industryCategoriesConfig.$sectorId.cat_id");
            $industry      = config("industryCategoriesConfig.$sectorId.parent_cat");
            $subCatSlug    = config("industryCategoriesConfig.$sectorId.category_slug");
            $parentCatId   = config("industryCategoriesConfig.$sectorId.parent_id");

            $parentChild[$parentCatId][$subIndustryId] = $subIndustryId;

            $businessList[] = [
                'industry'        => $industry,
                'industrySlug'    => Str::slug(
                    trim(strtolower(CommonController::cleanSpecialChar($industry))),
                    '-'
                ),
                'industryid'      => $parentCatId,
                'subindustry'     => $subIndustry,
                'subIndustrySlug' => Str::slug(
                    trim(strtolower(CommonController::cleanSpecialChar($subIndustry))),
                    '-'
                ),
                'subIndustryid'   => $subIndustryId,
                'parentCatId'     => $parentCatId
            ];
        }

        foreach ($parentChild as $key => $value) {
            sort($value);
            $parentChild[$key] = implode('-', $value);
        }

        return [$businessList, $parentChild];
    }


    // Featured Investors data for home page
    public function getFeaturedInvestors()
    {
        // Check cache first
        if (config('constants.isCachingOn')) {
            $featuredInvestors = Cache::get('featured_investors');
            if (!empty($featuredInvestors)) {
                return response()->json([
                    'featuredInvestorsData' => $featuredInvestors
                ]);
            }
        }

        // Count total active investors
        $totalInvestors = ProfileInvestor::where('inv_profile_status', config('constants.ProfileStatus.Active'))
            ->count();

        // Fetch featured investors
        $investors = ProfileInvestor::select(
                'investor_id', 'user_id', 'inv_profile_str', 'inv_name', 'inv_state', 'inv_city',
                'inv_headline', 'inv_type', 'invest_pref', 'full_acquisition', 'company_name',
                'company_designation', 'invest_size_min', 'invest_size_max', 'purchase_capacity_min',
                'purchase_capacity_max', 'company_logo_path', 'inv_profile_pic_path', 'inv_country',
                'inv_abt_urself', 'membership_paid', 'membership_plan', 'last_login_at'
            )
            ->where('inv_profile_status', config('constants.ProfileStatus.Active'))
            ->whereIn('inv_profile_str', [
                '5l1xvp','jcahys','zuiizc','kmebfr','h0un4g','r7unm0',
                'nwyawl','4idnbw','sucyej','zpjzfi','n29zph','6zhvhj'
            ])
            ->orderByDesc('last_login_at')
            ->orderByDesc('invest_size_max')
            ->limit(12)
            ->get();

        $featuredInvestors = $investors->map(function ($investor) {
            [$minInvestment, $maxInvestment] = CommonController::getInvestmentRange($investor);
            $slugUrl = CommonController::getSlugUrl($investor, $minInvestment, $maxInvestment);

            return [
                'investorName'     => $investor->inv_name,
                'investorType'     => config('constants.investorType.' . $investor->inv_type),
                'invheadline'      => $investor->inv_headline,
                'locations'        => '',
                'locationDetails'  => '',
                'sectorPreference' => '',
                'investorCountry'  => $investor->inv_country,
                'companyName'      => $investor->company_name,
                'designation'      => $investor->company_designation,
                'investmentPref'   => CommonController::getInvestmentPreference($investor),
                'minInvestment'    => $minInvestment,
                'maxInvestment'    => $maxInvestment,
                'investorStr'      => strtolower($investor->inv_profile_str),
                'investorCity'     => $investor->inv_city,
                'investorSate'     => config('constants.statesIndia.' . $investor->inv_state),
                'investorSummary'  => $investor->inv_abt_urself,
                'investorProfPic'  => ($investor->membership_paid == 1 && $investor->inv_profile_pic_path)
                    ? config('constants.ImageCDN') . '/' . $investor->inv_profile_pic_path
                    : 'assets/images/profile-dflt.jpg',
                'companyLogo'      => !empty($investor->company_logo_path)
                    ? config('constants.ImageCDN') . '/' . $investor->company_logo_path
                    : '',
                'membership_paid'  => $investor->membership_paid,
                'membership_plan'  => $investor->membership_plan,
                'lastLogin'        => $investor->last_login_at,
                'investorPlan'     => config('constants.planType.' . $investor->membership_plan),
                'mobVerifyStatus'  => MobileVerification::isMobileNoVerified($investor->user_id),
                'investorurl'      => Str::slug(trim(strtolower(CommonController::cleanSpecialChar($slugUrl))), "-"),
            ];
        });

        // Store in cache
        if (config('constants.isCachingOn')) {
            Cache::put('featured_investors', $featuredInvestors, now()->addMinutes(30));
        }

        return response()->json([
            'featuredInvestorsData' => $featuredInvestors,
            'total' => $totalInvestors
        ]);
    }



    /*
   *  Get featured business/seller according to Geo Location for home page
   */
    public function getGeoFeaturedSellersRegion(Request $request)
    {
        $userCurrentLocation = [];
        $geoSellerCount = 0;
        $geoData = [];

        // Determine location
        if (empty($request->input('cityName')) || empty($request->input('stateShortName'))) {
            $ipAddress = request()->ip() === "127.0.0.1" ? '103.55.88.122' : request()->ip();

            $response = Http::get('https://api.ipinfodb.com/v3/ip-city/', [
                'key'    => config('services.ipinfodb.key'), // move API key to config/services.php
                'ip'     => $ipAddress,
                'format' => 'json',
            ]);

            $geoData = $response->json();
            $region = 'DL';

            if (!empty($geoData['regionName']) && $geoData['regionName'] !== '-') {
                $stateName = array_flip(config('constants.statesIndia'));
                if (isset($stateName[$geoData['regionName']])) {
                    $region = $stateName[$geoData['regionName']];
                }
            }

            $userCurrentLocation = [
                'city'  => $geoData['cityName'] ?? '',
                'state' => $region,
            ];
        } else {
            $region = $request->input('stateShortName');
            $geoData['cityName']   = $request->input('cityName');
            $geoData['statusCode'] = 'OK';
        }

        // Region-wise sellers
        $sellersRegionViseState = config('constants.regionViseStates.' . $region);

        if (($geoData['statusCode'] ?? '') === 'OK') {
            $geoSellerCount = ProfileBusiness::where('ofc_state', $region)
                ->where('business_profile_status', config('constants.ProfileStatus.Active'))
                ->count();
        }

        // Seller query
        $Sellerquery = ProfileBusiness::query()
            ->where('business_profile_status', 1);

        if ($geoSellerCount < 4) {
            $Sellerquery->whereIn('ofc_state', $sellersRegionViseState);
        } else {
            if (!empty($geoData['cityName']) && in_array($geoData['cityName'], [
                'Faridabad', 'New Delhi', 'Ghaziabad', 'Gurgaon', 'Noida'
            ])) {
                $Sellerquery->whereIn('ofc_state', $sellersRegionViseState);
            } else {
                $Sellerquery->where('ofc_state', $region);
            }
        }

        

        $sellers = $Sellerquery->where('business_profile_str', '!=', 'epjukt')
            ->orderByDesc('membership_paid')
            ->orderByDesc('membership_plan')
            ->orderByDesc('business_id')
            ->limit(12)
            ->get();
        

        $totalsellers = ProfileBusiness::where('business_profile_status', config('constants.ProfileStatus.Active'))
            ->count();

        $featureSellers = $sellers->map(function ($seller) {
            [$seekingStr, $seekingDetails] = $this->getSeekingDetails($seller);

            return [
                'id'              => $seller->business_id,
                'title'           => $seller->advmt_headline,
                'image'           => $seller->seller_prof_pic,
                'thumbimage'      => !empty($seller->seller_prof_thumb_pic)
                    ? config('constants.ImageCDN') . '/' . $seller->seller_prof_thumb_pic
                    : CommonController::randomSubCategoryImage($seller->industry_sector, "360", "202"),
                'membership_paid' => $seller->membership_paid,
                'membership_plan' => $seller->membership_plan,
                'state'           => $seller->ofc_state,
                'price'           => CommonController::getAskingPrice($seller),
                'seekingDetails'  => $seekingDetails,
                'seekingStr'      => rtrim($seekingStr, ','),
                'location'        => CommonController::getSellerLocation($seller),
                'categorySlug'    => config("industryCategoriesConfig.{$seller->industry_sector}.category_slug"),
                'sellerurl'       => Str::slug(trim(strtolower(CommonController::cleanSpecialChar($seller->advmt_headline))), "-"),
                'profileStr'      => strtolower($seller->business_profile_str),
                'parentCatId'     => config("industryCategoriesConfig.{$seller->industry_sector}.parent_id"),
                'industry'        => config("industryCategoriesConfig.{$seller->industry_sector}.parent_cat"),
                'ParentIndustry'  => config("industryCategoriesConfig.{$seller->industry_sector}.category_name"),
                'catImage'        => CommonController::randomImage(config("industryCategoriesConfig.{$seller->industry_sector}.parent_id")),
                'priceLabel'      => CommonController::priceLabelBusiness($seller),
            ];
        })->shuffle()->values();

        return response()->json([
            'sellerdatalist'     => $featureSellers,
            'userCurrentLocation'=> $userCurrentLocation,
            'total'              => $totalsellers,
        ]);
    }

    private function getSeekingDetails($seller)
    {
        $seekingStr = "";

        if ($seller->seeking_investors == 1) {
            $seekingStr .= "Investment,";
        }
        if ($seller->seeking_buyers == 1) {
            $seekingStr .= "Buyer,";
        }
        if ($seller->seeking_loan == 1) {
            $seekingStr .= "Lender,";
        }
        if ($seller->seeking_mentors == 1) {
            $seekingStr .= "Mentorship,";
        }
        if ($seller->seeking_accelerators == 1) {
            $seekingStr .= "Incubation,";
        }

        $seekingArr = array_filter(explode(',', $seekingStr));
        $seekingDetails = $seekingArr[0] ?? '';

        if (count($seekingArr) > 1) {
            $seekingDetails = $seekingArr[0] . ' +' . (count($seekingArr) - 1) . ' more';
        }

        return [$seekingStr, $seekingDetails];
    }


     public function getFeaturedStartup()
    {
        // Check cache first
        if (config('constants.isCachingOn')) {
            $featureSellers = Cache::get('featured_startup');
            if (!empty($featureSellers)) {
                return response()->json(['sellerdatalist' => $featureSellers]);
            }
        }

        //  Count total active startups
        $totalStartups = ProfileStartup::where('startup_profile_status', config('constants.ProfileStatus.Active'))
            ->count();

        //  Fetch featured startups
        $sellers = ProfileStartup::select(
                'startup_id', 'startup_profile_str', 'advmt_headline', 'ofc_city', 'ofc_state', 'industry_sector',
                'seeking_investors', 'seeking_acquirers', 'seeking_loan', 'seeking_mentorship', 'seeking_incubators',
                'buyer_sell_price', 'inv_asking_price', 'loan_amount', 'accel_inv_req',
                'startup_prof_pic', 'startup_prof_thumb_pic', 'membership_paid', 'membership_plan'
            )
            ->where('startup_profile_status', config('constants.ProfileStatus.Active'))
            ->orderByDesc('membership_paid')
            ->orderByDesc('membership_plan')
            ->orderByDesc('startup_id')
            ->limit(12)
            ->get();

        $featureSellers = $sellers->map(function ($seller) {
            $seekingStr = CommonController::getSeekingString($seller);
            $seekingArr = array_filter(explode(',', $seekingStr));
            $seekingDetails = $seekingArr[0] ?? '';
            if (count($seekingArr) > 1) {
                $seekingDetails = $seekingArr[0] . ' +' . (count($seekingArr) - 1) . ' more';
            }
            $seekingStr = rtrim($seekingStr, ',');

            $sellersState = config('constants.statesIndia.' . $seller->ofc_state);
            $location = $sellersState
                ? $seller->ofc_city . ', ' . $sellersState
                : $seller->ofc_city . ', ' . $seller->ofc_state;

            $priceLabel = CommonController::priceLabelStartup($seller);

            return [
                'title'           => $seller->advmt_headline,
                'image'           => $seller->startup_prof_pic,
                'thumbimage'      => !empty($seller->startup_prof_thumb_pic)
                    ? config('constants.ImageCDN') . '/' . $seller->startup_prof_thumb_pic
                    : CommonController::randomSubCategoryImage($seller->industry_sector, "360", "202"),
                'price'           => ($priceLabel !== 'Seeking Mentor')
                    ? CommonController::getAskingPrice($seller)
                    : '',
                'seekingDetails'  => $seekingDetails,
                'seekingStr'      => $seekingStr,
                'location'        => $location,
                'categorySlug'    => config("industryCategoriesConfig.{$seller->industry_sector}.category_slug"),
                'startupurl'      => Str::slug(trim(strtolower(CommonController::cleanSpecialChar($seller->advmt_headline))), "-"),
                'profileStr'      => strtolower($seller->startup_profile_str),
                'membership_paid' => $seller->membership_paid,
                'membership_plan' => $seller->membership_plan,
                'parentCatId'     => config("industryCategoriesConfig.{$seller->industry_sector}.parent_id"),
                'catImage'        => CommonController::randomImage(config("industryCategoriesConfig.{$seller->industry_sector}.parent_id")),
                'priceLabel'      => $priceLabel,
                'industry'        => config("industryCategoriesConfig.{$seller->industry_sector}.parent_cat"),
                'ParentIndustry'  => config("industryCategoriesConfig.{$seller->industry_sector}.category_name"),
            ];
        })->shuffle()->values();

        //  Store in cache
        if (config('constants.isCachingOn')) {
            Cache::put('featured_startup', $featureSellers, now()->addMinutes(30));
        }

        return response()->json([
            'featureSellers' => $featureSellers,
            'total'          => $totalStartups,
        ]);
    }


    public function getFeaturedMentor()
    {
        //  Check cache first
        if (config('constants.isCachingOn')) {
            $mentorListData = Cache::get('featured_mentors');
            if (!empty($mentorListData)) {
                return response()->json(['mentorList' => $mentorListData]);
            }
        }

        //  Count total active mentors
        $totalMentors = ProfileMentor::where('mentor_profile_status', config('constants.ProfileStatus.Active'))
            ->count();

        //  Fetch featured mentors
        $mentors = ProfileMentor::where('mentor_profile_status', config('constants.ProfileStatus.Active'))
            ->orderByDesc('membership_paid')
            ->orderByDesc('membership_plan')
            ->limit(12)
            ->get();

        $mentorListData = $mentors->map(function ($mentor) {
            return [
                'mentorProfileStr'  => strtolower($mentor->mentor_profile_str),
                'mentorCity'        => $mentor->mentor_city,
                'mentorState'       => config('constants.statesIndia.' . $mentor->mentor_state),
                'mentorHeadline'    => $mentor->mentor_adv_headline,
                'mentorOccupation'  => config('constants.mentorOccupation.' . $mentor->mentor_occupation),
                'mentorSector'      => $this->getMentorSectors($mentor->mentor_id),
                'mentorExp'         => $this->getProfessionalExperience($mentor->mentor_id),
                'mentorDesignation' => ucwords($mentor->mentor_designation),
                'mentorCompany'     => ucwords($mentor->mentor_company),
                'mentorCountry'     => $mentor->mentor_country,
                'mentorSummary'     => $mentor->mentor_profile_summary,
                'profilePic'        => ($mentor->membership_paid && $mentor->mentor_profile_pic)
                    ? config('constants.ImageCDN') . '/' . $mentor->mentor_profile_pic
                    : 'assets/images/profile-dflt.jpg',
                'subExpStr'         => $this->getMentorSubjectExpertise($mentor->mentor_id),
                'mentorurl'         => Str::slug(trim(strtolower(CommonController::cleanSpecialChar($mentor->mentor_adv_headline))), "-"),
                'mobVerifyStatus'   => MobileVerification::isMobileNoVerified($mentor->user_id),
                'membership_paid'   => $mentor->membership_paid,
                'membership_plan'   => $mentor->membership_plan,
                'mentor_name'       => $mentor->mentor_name,
            ];
        })->toArray();

        //  Store in cache
        if (config('constants.isCachingOn')) {
            Cache::put('featured_mentors', $mentorListData, now()->addMinutes(30));
        }

        return response()->json([
            'mentorList' => $mentorListData,
            'total'      => $totalMentors,
        ]);
    }


    public function getMentorSectors($mentorId)
    {
        $indPrefStr = '';
        $sectorPref = IndPrefMentor::query()->join('industry_categories', 'ind_pref_mentors.sub_category_id', '=', 'industry_categories.cat_id')
            ->where('ind_pref_mentors.mentor_profile_id', '=', $mentorId)
            ->select('industry_categories.category_name AS category_name')
            ->get()->toArray();

        if (count($sectorPref) > 0) {
            $oneDimArr = array_column($sectorPref, 'category_name');
            $indPrefStr = implode(', ', $oneDimArr);
        }
        return $indPrefStr;
    }


    public function getMentorSubjectExpertise($mentorId)
    {
        $subExpStr = '';
        $subjectExp = IndPrefMentorExpertise::query()->join('mentor_categories', 'ind_pref_mentor_expertise.sub_category_id', '=', 'mentor_categories.mentor_category_id')
            ->where('ind_pref_mentor_expertise.mentor_profile_id', '=', $mentorId)
            ->select('mentor_categories.mentor_category_name AS mentor_category_name')
            ->get()->toArray();

        if (count($subjectExp) > 0) {
            $oneDimArr = array_column($subjectExp, 'mentor_category_name');
            $subExpStr = implode(', ', $oneDimArr);
        }
        return $subExpStr;
    }

    private function getProfessionalExperience($mentorId)
    {
        $mentorExperience = '';
        $mentorIndustry = ProfileMentorProfExp::query()->select('exp_year', 'exp_sector')
            ->where('mentor_profile_id', $mentorId)
            ->get()->toArray();
        if (count($mentorIndustry) > 0) {
            // Professional experience total
            $mentorExperience = array_sum(array_column($mentorIndustry, 'exp_year'));
        }
        return $mentorExperience;
    }


    public function getBxArticleHomeListing()
    {
        //  Check cache first
        if (config('constants.isCachingOn')) {
            $articleHome = Cache::get('home_article');
            if (!empty($articleHome)) {
                return response()->json(['bxarticlehomedata' => $articleHome]);
            }
        }

        //  Fetch latest active articles
        $articles = BxArticle::select(
                'article_id', 'article_title', 'short_desc', 'article_content',
                'author_id', 'image_path', 'listing_image_path',
                'article_views', 'article_comments', 'created_at'
            )
            ->where('article_status', config('constants.ProfileStatus.Active'))
            ->orderByDesc('article_id')
            ->limit(4)
            ->get();

        if ($articles->isEmpty()) {
            return response()->json(['code' => 200, 'message' => 'No records found'], 200);
        }

        $articleHome = $articles->map(function ($article) {
            $author = BxAuthor::select('author_name')
                ->where('author_id', $article->author_id)
                ->first();

            return [
                'article_id' => $article->article_id,
                'title'      => $article->article_title,
                'url'        => Str::slug(trim(strtolower(CommonController::cleanSpecialChar($article->article_title))), "-"),
                'shortDesc'  => $article->short_desc,
                'content'    => $article->article_content,
                'author'     => $author->author_name ?? '',
                'image'      => empty($article->listing_image_path)
                    ? config('constants.ImageCDN') . '/' . $article->image_path
                    : config('constants.ImageCDN') . '/' . $article->listing_image_path,
                'views'      => $article->article_views,
                'comments'   => $article->article_comments,
                'time' => Carbon::parse($article['created_at'])->format('M d, Y'),
            ];
        })->toArray();

        //  Store in cache
        if (config('constants.isCachingOn')) {
            Cache::put('home_article', $articleHome, now()->addMinutes(30));
        }

        return response()->json(['bxarticlehomedata' => $articleHome]);
    }


    public function getBxNewsHomeListing()
    {
        //  Check cache first
        if (config('constants.isCachingOn')) {
            $newsHome = Cache::get('home_news');
            if (!empty($newsHome)) {
                return response()->json(['bxnewshomedata' => $newsHome]);
            }
        }

        //  Fetch latest active news
        $newsItems = BxNews::select(
                'news_id', 'news_title', 'short_desc', 'news_content',
                'author_id', 'image_path', 'listing_image_path',
                'news_views', 'news_comments', 'created_at'
            )
            ->where('news_status', config('constants.ProfileStatus.Active'))
            ->orderByDesc('news_id')
            ->limit(4)
            ->get();

        if ($newsItems->isEmpty()) {
            return response()->json(['code' => 200, 'message' => 'No records found'], 200);
        }

        $newsHome = $newsItems->map(function ($news) {
            $author = BxAuthor::select('author_name')
                ->where('author_id', $news->author_id)
                ->first();

            return [
                'news_id'    => $news->news_id,
                'title'      => $news->news_title,
                'url'        => Str::slug(trim(strtolower(CommonController::cleanSpecialChar($news->news_title))), "-"),
                'shortDesc'  => $news->short_desc,
                'content'    => $news->news_content,
                'author'     => $author->author_name ?? '',
                'image'      => empty($news->listing_image_path)
                    ? config('constants.ImageCDN') . '/' . $news->image_path
                    : config('constants.ImageCDN') . '/' . $news->listing_image_path,
                'views'      => $news->news_views,
                'comments'   => $news->news_comments,
                'time' => Carbon::parse($news->created_at)->format('M d, Y'),
            ];
        })->toArray();

        //  Store in cache
        if (config('constants.isCachingOn')) {
            Cache::put('home_news', $newsHome, now()->addMinutes(30));
        }

        return response()->json(['bxnewshomedata' => $newsHome]);
    }

}
