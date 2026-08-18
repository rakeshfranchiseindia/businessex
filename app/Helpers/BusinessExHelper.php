<?php

namespace App\Helpers;
use App\Models\IndustryCategory;
use App\Models\ProfileMentorProfExp;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Str;


class BusinessExHelper
{

    // Get industry category list 
    public static function getIndustrySeller()
    {
        $businessList = [];
        $industrySeller = IndustryCategory::query()
            ->select('cat_id as industry_sector')
            ->where('parent_id','!=',0)
            ->get();


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

    public static function getDefaultSeo($industrymain, $state, $city, $totalItems, $seo)
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

    public static function saveProfessionalExperience(array $professionalExperience, int $mentorProfileId, int $userId): ?\App\Models\ProfileMentorProfExp
        {
            $profile = null;

            if (!empty($professionalExperience)) {
                // Delete old records for this mentor profile
                ProfileMentorProfExp::where('mentor_profile_id', $mentorProfileId)->delete();

                foreach ($professionalExperience as $pExperience) {
                    $pExperience = (array) $pExperience;

                    // Skip invalid or incomplete entries
                    if (empty($pExperience['prof_exp_year'])) {
                        continue;
                    }

                    $profile = ProfileMentorProfExp::create([
                        'mentor_profile_id' => $mentorProfileId,
                        'user_id'           => $userId,
                        'exp_year'          => $pExperience['prof_exp_year'],
                        'exp_sector'        => $pExperience['mentor_sector_expertise'] ?? null,
                    ]);
                }
            }

            return $profile;
        }

}
