<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Models\Testimonial;
use App\Models\IndustryCategory;
use App\Models\BxArticle;

use App\Http\Controllers\CommonController; 
use Illuminate\Auth\Middleware\Authenticate;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $testimonials = Testimonial::all();
        $homepageArticles = BxArticle::with('author')->published()
            ->latest('created_at')
            ->take(4)
            ->get();
        
        [$businessList, $parentChild] = $this->getIndustrySeller();
        View::share([
            'industrySeller' => $businessList,
            'parentChildCategoryId' => $parentChild,
            'testimonials' => $testimonials,
            'homepageArticles' => $homepageArticles
        ]);
        
        Authenticate::redirectUsing(function ($request) {
            return '/';
        });
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
}
