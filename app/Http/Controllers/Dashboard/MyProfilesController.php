<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\ProfileBusiness;
use App\Models\ProfileInvestor;
use App\Models\ProfileLender;
use App\Models\ProfileMentor;
use App\Models\ProfileStartup;
use App\Models\ProfileVisitor;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

require_once app_path('Helpers/common_helper.php');


class MyProfilesController extends Controller
{
    public function newListings()
    {
        $profileStrs = UserProfile::where('profile_type', config('constants.profileTypes.Business'))
            ->where('profile_status', config('constants.ProfileStatus.Active'))
            ->orderBy('updated_at', 'desc')
            ->limit(8)
            ->pluck('profile_str');

        $sellers = ProfileBusiness::whereIn('business_profile_str', $profileStrs)
            ->where('business_profile_status', config('constants.ProfileStatus.Active'))
            ->get();

        return response()->json([
            'status' => true,
            'listings' => $this->formatByType(config('constants.profileTypes.Business'), $sellers),
        ]);
    }

    public function savedSearches()
    {
        $bookmarks = Bookmark::where('user_id', Auth::id())
            ->where('bookmark_status', config('constants.ProfileStatus.Active'))
            ->orderBy('bookmark_id', 'desc')
            ->get();

        return response()->json(['status' => true, 'listings' => $this->fetchGroupedByType($bookmarks)]);
    }

    public function searchHistory()
    {
        $visitors = ProfileVisitor::where('user_id', Auth::id())
            ->orderBy('visitor_id', 'desc')
            ->get()
            ->unique('profile_str');

        return response()->json(['status' => true, 'listings' => $this->fetchGroupedByType($visitors)]);
    }

    private function fetchGroupedByType($rows)
    {
        $listings = [];
        foreach ($rows->groupBy('profile_type') as $profileType => $items) {
            $profileStrs = $items->pluck('profile_str')->unique()->values()->toArray();
            $listings = array_merge($listings, $this->fetchProfilesByType((int) $profileType, $profileStrs));
        }
        return $listings;
    }

    private function fetchProfilesByType($profileType, $profileStrs)
    {
        if (empty($profileStrs)) {
            return [];
        }

        switch ($profileType) {
            case config('constants.profileTypes.Business'):
                $rows = ProfileBusiness::whereIn('business_profile_str', $profileStrs)
                    ->where('business_profile_status', config('constants.ProfileStatus.Active'))->get();
                break;
            case config('constants.profileTypes.Investor'):
                $rows = ProfileInvestor::whereIn('inv_profile_str', $profileStrs)
                    ->where('inv_profile_status', config('constants.ProfileStatus.Active'))->get();
                break;
            case config('constants.profileTypes.Lender'):
                $rows = ProfileLender::whereIn('lender_profile_str', $profileStrs)
                    ->where('lender_profile_status', config('constants.ProfileStatus.Active'))->get();
                break;
            case config('constants.profileTypes.Mentor'):
                $rows = ProfileMentor::whereIn('mentor_profile_str', $profileStrs)
                    ->where('mentor_profile_status', config('constants.ProfileStatus.Active'))->get();
                break;
            case config('constants.profileTypes.Startup'):
                $rows = ProfileStartup::whereIn('startup_profile_str', $profileStrs)
                    ->where('startup_profile_status', config('constants.ProfileStatus.Active'))->get();
                break;
            default:
                // Incubation / Broker have no dashboard module in this project yet.
                return [];
        }

        return $this->formatByType($profileType, $rows);
    }

    private function formatByType($profileType, $rows)
    {
        $out = [];

        foreach ($rows as $row) {
            if ($profileType === config('constants.profileTypes.Business')) {
                $out[] = [
                    'profileTypeStr' => 'Business',
                    'title' => $row->advmt_headline,
                    'description' => $row->seller_intro,
                    'price' => getAskingPrice($row->toArray()),
                    'priceLabel' => priceLabelBusiness($row->toArray()),
                    'location' => getSellerLocation($row->toArray()),
                    'thumbimage' => !empty($row->seller_prof_thumb_pic)
                        ? config('constants.ImageCDN') . '/' . $row->seller_prof_thumb_pic
                        : randomSubCategoryImage($row->industry_sector, '100', '100'),
                    'profileurl' => '/business/' . Str::slug(trim(strtolower(cleanSpecialChar((string) $row->advmt_headline))), '-') . '/' . strtolower($row->business_profile_str),
                    'membership_paid' => (bool) $row->membership_paid,
                    'membership_plan' => $row->membership_plan,
                ];
            } elseif ($profileType === config('constants.profileTypes.Investor')) {
                [$minInvestment, $maxInvestment] = getInvestmentRange($row->toArray());
                $title = getSlugUrl($row->toArray(), $minInvestment, $maxInvestment);
                $out[] = [
                    'profileTypeStr' => 'Investor',
                    'title' => $title,
                    'description' => $row->inv_intro,
                    'location' => $row->inv_city ?: 'India',
                    'investmentRange' => $minInvestment . ' - ' . $maxInvestment,
                    'thumbimage' => !empty($row->inv_profile_pic_path) ? config('constants.ImageCDN') . '/' . $row->inv_profile_pic_path : null,
                    'profileurl' => '/investor/' . Str::slug(trim(strtolower(cleanSpecialChar((string) $title))), '-') . '/' . strtolower($row->inv_profile_str),
                    'membership_paid' => (bool) $row->membership_paid,
                    'membership_plan' => $row->membership_plan,
                ];
            } elseif ($profileType === config('constants.profileTypes.Lender')) {
                $out[] = [
                    'profileTypeStr' => 'Lender',
                    'title' => $row->lender_adv_headline,
                    'description' => $row->lender_intro,
                    'location' => $row->lender_city,
                    'thumbimage' => !empty($row->profile_pic_path) ? config('constants.ImageCDN') . '/' . $row->profile_pic_path : null,
                    'profileurl' => '/lender/' . Str::slug(trim(strtolower(cleanSpecialChar((string) $row->lender_adv_headline))), '-') . '/' . strtolower($row->lender_profile_str),
                ];
            } elseif ($profileType === config('constants.profileTypes.Mentor')) {
                $out[] = [
                    'profileTypeStr' => 'Mentor',
                    'title' => $row->mentor_adv_headline,
                    'description' => $row->mentor_intro,
                    'location' => $row->mentor_city,
                    'thumbimage' => !empty($row->mentor_profile_pic) ? config('constants.ImageCDN') . '/' . $row->mentor_profile_pic : null,
                    'profileurl' => '/mentor/' . Str::slug(trim(strtolower(cleanSpecialChar((string) $row->mentor_adv_headline))), '-') . '/' . strtolower($row->mentor_profile_str),
                    'membership_paid' => (bool) $row->membership_paid,
                    'membership_plan' => $row->membership_plan,
                ];
            } elseif ($profileType === config('constants.profileTypes.Startup')) {
                $out[] = [
                    'profileTypeStr' => 'Startup',
                    'title' => $row->advmt_headline,
                    'description' => $row->startup_intro,
                    'price' => getAskingPrice($row->toArray()),
                    'priceLabel' => strtoupper(priceLabelStartup($row->toArray())),
                    'location' => $row->ofc_city,
                    'thumbimage' => !empty($row->startup_prof_thumb_pic) ? $row->startup_prof_thumb_pic : randomSubCategoryImage($row->industry_sector, '100', '100'),
                    'profileurl' => '/startup/' . Str::slug(trim(strtolower(cleanSpecialChar((string) $row->advmt_headline))), '-') . '/' . strtolower($row->startup_profile_str),
                    'membership_paid' => (bool) $row->membership_paid,
                    'membership_plan' => $row->membership_plan,
                ];
            }
        }

        return $out;
    }
}
