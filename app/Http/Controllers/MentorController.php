<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Models\ProfileMentor;
use App\Models\IndPrefMentor;
use App\Models\MobileVerification;
use App\Models\ProfileMentorProfExp;
use App\Models\IndPrefMentorExpertise;
use App\Models\Seo;
use Illuminate\Support\Str;

class MentorController extends Controller
{
    // Extract filters from request
    public function mentorListing(Request $request)
    {
    $states              = (array) $request->input('state', []);
    $cities              = (array) $request->input('city', []);
    $selectedOccupations = (array) $request->input('occupation', []);
    $selectedLocations   = (array) $request->input('location', []);
    $sortby              = $request->input('sortby');
    $itemsPerPage        = (int) $request->input('itemsPerPage', 10);

    

    // Base query
    $mentorQuery = ProfileMentor::query()
        ->where('mentor_profile_status', config('constants.ProfileStatus.Active'));

    // State filter
    if (!empty($states)) {
        $mentorQuery->whereIn('mentor_state', $states);
    }

    // City filter
    if (!empty($selectedLocations) && count($selectedLocations) > 0) {
        $mentorQuery->whereIn('mentor_city', $selectedLocations);
    }

    // Occupation filter
    if (!empty($selectedOccupations)) {
        $mentorQuery->whereIn('mentor_occupation', $selectedOccupations);
    }

    // Sorting
    if (empty($sortby)) {
        $mentorQuery->orderBy('membership_paid', 'desc')
                    ->orderByRaw("FIELD(membership_plan, 3, 2, 1, 5, 0)")
                    ->orderBy('created_at', 'DESC');
    } elseif ($sortby === 'asc') {
        $mentorQuery->orderBy('created_at', 'ASC');
    } else {
        
        $mentorQuery->orderBy('created_at', 'DESC');
    }

    // Paginate
    $mentors = $mentorQuery->paginate($itemsPerPage);

    // Transform collection while preserving pagination
    $mentorListData = $mentors->getCollection()->map(function ($mentor) use ($selectedOccupations) {
        return [
            'mentorProfileStr'   => strtolower($mentor->mentor_profile_str),
            'mentorCity'         => $mentor->mentor_city,
            'mentorState'        => config('constants.statesIndia.' . $mentor->mentor_state),
            'mentorHeadline'     => $mentor->mentor_adv_headline,
            'mentorOccupation'   => config('constants.mentorOccupation.' . $mentor->mentor_occupation),
            'mentorOccupationid' => $mentor->mentor_occupation,
            'mentorSector'       => $this->getMentorSectors($mentor->mentor_id),
            'mentorExp'          => $this->getProfessionalExperience($mentor->mentor_id),
            'mentorDesignation'  => $mentor->mentor_designation,
            'mentorCompany'      => $mentor->mentor_company,
            'mentorCountry'      => $mentor->mentor_country,
            'mentorSummary'      => $mentor->mentor_profile_summary,
            'profilePic'         => ($mentor->membership_paid && $mentor->mentor_profile_pic)
                                    ? config('constants.ImageCDN') . '/' . $mentor->mentor_profile_pic
                                    : 'assets/img/defaultProfile.jpg',
            'subExpStr'          => $this->getMentorSubjectExpertise($mentor->mentor_id),
            'mentorurl'          => Str::slug(CommonController::cleanSpecialChar($mentor->mentor_adv_headline), '-'),
            'mobVerifyStatus'    => MobileVerification::isMobileNoVerified($mentor->user_id),
            'profilePicName'     => $mentor->mentor_profile_pic_name,
            'membership_paid'    => $mentor->membership_paid,
            'membership_plan'    => $mentor->membership_plan,
            'mentorPlan'         => config('constants.planType.' . $mentor->membership_plan),
            'mentorName'         => $mentor->mentor_name
        ];
    });
    // Re-wrap into paginator
    $mentorListData = new \Illuminate\Pagination\LengthAwarePaginator(
        $mentorListData,
        $mentors->total(),
        $mentors->perPage(),
        $mentors->currentPage(),
        ['path' => request()->url(), 'query' => request()->query()]
    );

    $mentorCount = $mentors->total();

    return view('mentorlist', compact('mentorListData', 'mentorCount','selectedOccupations','selectedLocations'));
}


    public function getMentorSectors($mentorId)
    {
        $sectorPref = IndPrefMentor::query()
            ->join('industry_categories', 'ind_pref_mentors.sub_category_id', '=', 'industry_categories.cat_id')
            ->where('ind_pref_mentors.mentor_profile_id', $mentorId)
            ->pluck('industry_categories.category_name')
            ->toArray();

        return implode(', ', $sectorPref);
    }

    private function getProfessionalExperience($mentorId)
    {
        return ProfileMentorProfExp::query()
            ->where('mentor_profile_id', $mentorId)
            ->sum('exp_year');
    }

    public function getMentorSubjectExpertise($mentorId)
    {
        $subjectExp = IndPrefMentorExpertise::query()
            ->join('mentor_categories', 'ind_pref_mentor_expertise.sub_category_id', '=', 'mentor_categories.mentor_category_id')
            ->where('ind_pref_mentor_expertise.mentor_profile_id', $mentorId)
            ->pluck('mentor_categories.mentor_category_name')
            ->toArray();

        return implode(', ', $subjectExp);
    }

    private function getDefaultSeo($industrymain, $state, $city, $totalItems, $seo)
    {
        $categoryName   = '';
        $stateName      = 'India';
        $keyword        = 'Mentors, Mentors Listing';

        if (count($industrymain) === 1) {
            $categoryName = config("constants.mentorOccupation." . $industrymain[0]);
        } elseif (count($industrymain) > 1) {
            $categoryName = implode(',', config("constants.mentorOccupation"));
        }

        if (is_array($state) && count($state) === 1) {
            $stateName = (count($city) === 1) ? $city[0] : config('constants.statesIndia.' . $state[0]);
        }

        $mentorUrl = count($industrymain) > 0 ? 'from ' . $categoryName : '';

        $description = sprintf(
            'BusinessEx offers %s Mentors as on %s. These Mentors are looking to provide guidance in areas like Accounting & Finance, Business Strategy, Sales & Marketing, IT, Legal, etc. For mentoring startups, create a <a href="/create-mentor-profile">Mentor profile</a> in BusinessEx.',
            $totalItems,
            now()->format('M d, Y')
        );

        $title = sprintf('Mentors %s in %s', $mentorUrl, $stateName);

        if (!empty($seo['description'])) {
            $description = $seo['description'];
        }

        $find    = ['BUSINESS_COUNT', 'TODAY_DATE', 'CREATE_PROFILE_LINK'];
        $replace = [$totalItems, now()->format('M d, Y'), '<a href="/create-mentor-profile">Mentor Profile</a> in BusinessEx'];
        $description = str_replace($find, $replace, $description);
        $metaDescription = $description;

        return [$title, $keyword, $description, $metaDescription];
    }


    public function mentorDetail(){

      return view('bx-mentor-details');

    }
}