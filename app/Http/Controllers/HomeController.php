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

use App\Helper\CacheHelper;
use App\Mail\InvRegVerify;
use App\Mail\ProfileCreation;
use Illuminate\Support\Str;

class HomeController extends Controller
{
     public function startupIndustrySeller()
    {
        [$businessList, $parentChild] = $this->getIndustrySeller();
        return [
            'industrySeller' => $businessList,
            'parentChildCategoryId' => $parentChild
        ];
    }

    public function getIndustrySeller()
    {
        $businessList = [];
        $industrySeller = IndustryCategory::query()
            ->select('cat_id as industry_sector')
            ->whereNotNull('parent_id')
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
}
