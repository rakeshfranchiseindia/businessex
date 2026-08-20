<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\IndPrefInvestor;
use App\Models\IndPrefMentor;
use App\Models\LocPrefInvestor;
use App\Models\ProfileBusiness;
use App\Models\ProfileInvestor;
use App\Models\ProfileMentor;
use App\Models\ProfileStartup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RecommendationController extends Controller
{
    public function getRecommendations(Request $request, $profileType = 'investor')
    {
        $userId = Auth::id();

        [$industry, $location, $investmentMinMax] = $this->getViewerPreferences($userId, $profileType);

        [$sponsoredSellers, $recommendSellers] = $this->recommendBusinesses($industry, $location, $investmentMinMax);
        [$sponsoredStartups, $recommendStartups] = $this->recommendStartups($industry, $location, $investmentMinMax);

        $top5 = array_slice(
            array_merge($sponsoredSellers, $sponsoredStartups, $recommendSellers, $recommendStartups),
            0,
            5
        );

        return response()->json([
            'seller' => array_merge($sponsoredSellers, $recommendSellers),
            'startup' => array_merge($sponsoredStartups, $recommendStartups),
            'top5' => $top5,
        ]);
    }


    private function getViewerPreferences($userId, $profileType)
    {
        $industry = [];
        $location = [];
        $investmentMinMax = [];

        if ($profileType === 'investor') {
            $industry = IndPrefInvestor::where('user_id', $userId)->pluck('sub_category_id')->toArray();
            $location = LocPrefInvestor::where('user_id', $userId)->get()
                ->map(function ($item) {
                    $exploded = explode(',', (string) $item->location_name);
                    return trim($exploded[0]);
                })->filter()->toArray();

            $investor = ProfileInvestor::where('user_id', $userId)
                ->select('invest_size_min', 'invest_size_max')->first();
            if ($investor && $investor->invest_size_min !== null && $investor->invest_size_max !== null) {
                $investmentMinMax = [$investor->invest_size_min, $investor->invest_size_max];
            }
        } elseif ($profileType === 'mentor') {
            $industry = IndPrefMentor::where('user_id', $userId)->pluck('sub_category_id')->toArray();
            $location = ProfileMentor::where('user_id', $userId)->whereNotNull('mentor_city')
                ->pluck('mentor_city')->filter()->toArray();
        }

        return [$industry, $location, $investmentMinMax];
    }

    private function recommendBusinesses($industry, $location, $investmentMinMax)
    {
        $baseQuery = ProfileBusiness::query()
            ->select('business_id', 'business_profile_str', 'advmt_headline', 'industry_sector',
                'buyer_sell_price', 'inv_asking_price', 'loan_amount', 'accel_inv_req', 'seller_prof_thumb_pic',
                'membership_paid', 'membership_plan', 'last_login_at', 'seeking_accelerators', 'seeking_loan',
                'seeking_investors', 'seeking_buyers', 'seeking_mentors')
            ->where('business_profile_status', 1);

        $paidBusinessIds = getTopRecommendationAddOnProfiles(config('constants.profileTypes.Business'));

        $sponsoredQuery = clone $baseQuery;
        if (!empty($paidBusinessIds)) {
            $baseQuery->whereNotIn('business_id', $paidBusinessIds);
        }
        $baseQuery = $this->applyPreference($industry, $location, $investmentMinMax, $baseQuery);

        $sponsored = $sponsoredQuery->whereIn('business_id', $paidBusinessIds)
            ->orderBy('business_id', 'desc')->take(1)->get();

        $limit = $sponsored->isEmpty() ? 3 : 2;

        $recommended = $baseQuery->orderBy('membership_paid', 'desc')
            ->orderBy('last_login_at', 'desc')
            ->orderBy('business_id', 'desc')
            ->take($limit)->get();

        return [$this->formatSellers($sponsored, true), $this->formatSellers($recommended)];
    }

    private function recommendStartups($industry, $location, $investmentMinMax)
    {
        $baseQuery = ProfileStartup::query()
            ->select('startup_id', 'startup_profile_str', 'advmt_headline', 'industry_sector',
                'buyer_sell_price', 'inv_asking_price', 'loan_amount', 'accel_inv_req', 'startup_prof_thumb_pic',
                'membership_paid', 'membership_plan', 'seeking_incubators', 'seeking_acquirers', 'seeking_loan',
                'seeking_mentorship', 'seeking_investors', 'last_login_at')
            ->where('startup_profile_status', 1);

        $paidStartupIds = getTopRecommendationAddOnProfiles(config('constants.profileTypes.Startup'));

        $sponsoredQuery = clone $baseQuery;
        if (!empty($paidStartupIds)) {
            $baseQuery->whereNotIn('startup_id', $paidStartupIds);
        }
        $baseQuery = $this->applyPreference($industry, $location, $investmentMinMax, $baseQuery);

        $sponsored = $sponsoredQuery->whereIn('startup_id', $paidStartupIds)
            ->orderBy('startup_id', 'desc')->take(1)->get();

        $limit = $sponsored->isEmpty() ? 2 : 3;

        $recommended = $baseQuery->orderBy('membership_paid', 'desc')
            ->orderBy('startup_id', 'desc')->take($limit)->get();

        return [$this->formatStartups($sponsored, true), $this->formatStartups($recommended)];
    }

    private function formatSellers($sellers, $isSponsored = false)
    {
        $out = [];
        foreach ($sellers as $seller) {
            $arr = $seller->toArray();
            $out[] = [
                'type' => 'business',
                'title' => $seller->advmt_headline,
                'price' => getAskingPrice($arr),
                'priceLabel' => priceLabelBusiness($arr),
                'thumbimage' => !empty($seller->seller_prof_thumb_pic)
                    ? config('constants.ImageCDN') . '/' . $seller->seller_prof_thumb_pic
                    : randomSubCategoryImage($seller->industry_sector, '70', '55'),
                'profileurl' => '/business/' . Str::slug(trim(strtolower(cleanSpecialChar((string) $seller->advmt_headline))), '-') . '/' . strtolower($seller->business_profile_str),
                'membership_paid' => (bool) $seller->membership_paid,
                'membership_plan' => $seller->membership_plan,
                'isSponsored' => $isSponsored,
            ];
        }
        return $out;
    }

    private function formatStartups($startups, $isSponsored = false)
    {
        $out = [];
        foreach ($startups as $startup) {
            $arr = $startup->toArray();
            $out[] = [
                'type' => 'startup',
                'title' => $startup->advmt_headline,
                'price' => getAskingPrice($arr),
                'priceLabel' => priceLabelStartup($arr),
                'thumbimage' => !empty($startup->startup_prof_thumb_pic)
                    ? $startup->startup_prof_thumb_pic
                    : randomSubCategoryImage($startup->industry_sector, '70', '55'),
                'profileurl' => '/startup/' . Str::slug(trim(strtolower(cleanSpecialChar((string) $startup->advmt_headline))), '-') . '/' . strtolower($startup->startup_profile_str),
                'membership_paid' => (bool) $startup->membership_paid,
                'membership_plan' => $startup->membership_plan,
                'isSponsored' => $isSponsored,
            ];
        }
        return $out;
    }

      private function applyPreference($industry, $location, $investmentMinMax, $queryObject)
    {
        $hasIndustry = !empty($industry);
        $hasLocation = !empty($location);
        $hasInvestment = !empty($investmentMinMax);

        if ($hasIndustry && $hasLocation && $hasInvestment) {
            $queryObject->where(function ($query) use ($industry, $location, $investmentMinMax) {
                $query->where(function ($q) use ($industry, $location, $investmentMinMax) {
                    $q->whereIn('industry_sector', $industry)
                        ->whereIn('ofc_city', $location)
                        ->where(function ($q2) use ($investmentMinMax) {
                            $q2->whereBetween('buyer_sell_price', $investmentMinMax)
                                ->orWhereBetween('inv_asking_price', $investmentMinMax)
                                ->orWhereBetween('loan_amount', $investmentMinMax)
                                ->orWhereBetween('accel_inv_req', $investmentMinMax);
                        });
                })
                    ->orWhere(function ($q) use ($industry, $investmentMinMax) {
                        $q->whereIn('industry_sector', $industry)
                            ->where(function ($q2) use ($investmentMinMax) {
                                $q2->whereBetween('buyer_sell_price', $investmentMinMax)
                                    ->orWhereBetween('inv_asking_price', $investmentMinMax)
                                    ->orWhereBetween('loan_amount', $investmentMinMax)
                                    ->orWhereBetween('accel_inv_req', $investmentMinMax);
                            });
                    })
                    ->orWhere(function ($q) use ($location, $investmentMinMax) {
                        $q->whereIn('ofc_city', $location)
                            ->where(function ($q2) use ($investmentMinMax) {
                                $q2->whereBetween('buyer_sell_price', $investmentMinMax)
                                    ->orWhereBetween('inv_asking_price', $investmentMinMax)
                                    ->orWhereBetween('loan_amount', $investmentMinMax)
                                    ->orWhereBetween('accel_inv_req', $investmentMinMax);
                            });
                    })
                    ->orWhere(function ($q) use ($industry, $location) {
                        $q->whereIn('ofc_city', $location)->whereIn('industry_sector', $industry);
                    })
                    ->orWhere(function ($q) use ($investmentMinMax) {
                        $q->whereBetween('buyer_sell_price', $investmentMinMax)
                            ->orWhereBetween('inv_asking_price', $investmentMinMax)
                            ->orWhereBetween('loan_amount', $investmentMinMax)
                            ->orWhereBetween('accel_inv_req', $investmentMinMax);
                    })
                    ->orWhere(function ($q) use ($industry) {
                        $q->whereIn('industry_sector', $industry);
                    })
                    ->orWhere(function ($q) use ($location) {
                        $q->whereIn('ofc_city', $location);
                    });
            });
        } elseif ($hasIndustry && $hasInvestment) {
            $queryObject->where(function ($query) use ($industry, $investmentMinMax) {
                $query->where(function ($q) use ($industry, $investmentMinMax) {
                    $q->whereIn('industry_sector', $industry)
                        ->where(function ($q2) use ($investmentMinMax) {
                            $q2->whereBetween('buyer_sell_price', $investmentMinMax)
                                ->orWhereBetween('inv_asking_price', $investmentMinMax)
                                ->orWhereBetween('loan_amount', $investmentMinMax)
                                ->orWhereBetween('accel_inv_req', $investmentMinMax);
                        });
                })
                    ->orWhere(function ($q) use ($investmentMinMax) {
                        $q->whereBetween('buyer_sell_price', $investmentMinMax)
                            ->orWhereBetween('inv_asking_price', $investmentMinMax)
                            ->orWhereBetween('loan_amount', $investmentMinMax)
                            ->orWhereBetween('accel_inv_req', $investmentMinMax);
                    })
                    ->orWhere(function ($q) use ($industry) {
                        $q->whereIn('industry_sector', $industry);
                    });
            });
        } elseif ($hasLocation && $hasInvestment) {
            $queryObject->where(function ($query) use ($location, $investmentMinMax) {
                $query->where(function ($q) use ($location, $investmentMinMax) {
                    $q->whereIn('ofc_city', $location)
                        ->where(function ($q2) use ($investmentMinMax) {
                            $q2->whereBetween('buyer_sell_price', $investmentMinMax)
                                ->orWhereBetween('inv_asking_price', $investmentMinMax)
                                ->orWhereBetween('loan_amount', $investmentMinMax)
                                ->orWhereBetween('accel_inv_req', $investmentMinMax);
                        });
                })
                    ->orWhere(function ($q) use ($investmentMinMax) {
                        $q->whereBetween('buyer_sell_price', $investmentMinMax)
                            ->orWhereBetween('inv_asking_price', $investmentMinMax)
                            ->orWhereBetween('loan_amount', $investmentMinMax)
                            ->orWhereBetween('accel_inv_req', $investmentMinMax);
                    })
                    ->orWhere(function ($q) use ($location) {
                        $q->whereIn('ofc_city', $location);
                    });
            });
        } elseif ($hasIndustry && $hasLocation) {
            $queryObject->where(function ($query) use ($industry, $location) {
                $query->where(function ($q) use ($industry, $location) {
                    $q->whereIn('ofc_city', $location)->whereIn('industry_sector', $industry);
                })
                    ->orWhere(function ($q) use ($industry) {
                        $q->whereIn('industry_sector', $industry);
                    })
                    ->orWhere(function ($q) use ($location) {
                        $q->whereIn('ofc_city', $location);
                    });
            });
        } elseif ($hasLocation) {
            $queryObject->whereIn('ofc_city', $location);
        } elseif ($hasIndustry) {
            $queryObject->whereIn('industry_sector', $industry);
        } elseif ($hasInvestment) {
            $queryObject->where(function ($query) use ($investmentMinMax) {
                $query->whereBetween('buyer_sell_price', $investmentMinMax)
                    ->orWhereBetween('inv_asking_price', $investmentMinMax)
                    ->orWhereBetween('loan_amount', $investmentMinMax)
                    ->orWhereBetween('accel_inv_req', $investmentMinMax);
            });
        }

        return $queryObject;
    }
}
