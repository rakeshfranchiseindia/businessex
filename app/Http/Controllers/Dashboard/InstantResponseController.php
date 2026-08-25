<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ContactInvestor;
use App\Models\ContactLender;
use App\Models\ContactMentor;
use App\Models\ProfileMembership;

require_once app_path('Helpers/common_helper.php');


class InstantResponseController extends Controller
{
    public function index()
    {
        return view('account_dashboard.instant_responses');
    }

    /**
     * How many contacts this profile has revealed so far, and how many total
     * "insta response" credits the active membership grants.
     */
    public function getInstaRevealCount(Request $request)
    {
        $userId = Auth::id();
        $profileTypeCode = $this->currentProfileTypeCode();
        $modelClass = $this->contactModelFor($profileTypeCode);

        $revealedCount = 0;
        if ($modelClass) {
            $revealedCountQuery = $modelClass::where('user_id', $userId)
                ->where('contact_viewed', config('constants.ProfileStatus.Active'));
            $activeInstanceId = $this->activeProfileInstanceId();
            if ($activeInstanceId) {
                $revealedCountQuery->where('profile_id', $activeInstanceId);
            }
            $revealedCount = $revealedCountQuery->count();
        }

        $totalCredits = ProfileMembership::where('user_id', $userId)
            ->where('is_active', 1)
            ->where(function ($query) {
                $query->whereNull('expiry_date')->orWhere('expiry_date', '>=', now());
            })
            ->sum('instant_responses');

        return response()->json([
            'count' => $revealedCount,
            'total' => $totalCredits > 0 ? $totalCredits : 0,
        ]);
    }

    /**
     * Marks a single contact as "viewed"/revealed.
     */
    public function viewInstaStatusUpdate(Request $request)
    {
        $profileTypeCode = $this->currentProfileTypeCode();
        $modelClass = $this->contactModelFor($profileTypeCode);

        if (!$modelClass) {
            return response()->json('Unsupported profile type', 400);
        }

        $modelClass::where('contact_id', $request->input('contact_id'))
            ->update(['contact_viewed' => config('constants.ProfileStatus.Active')]);

        return response()->json('Insta Contact Viewed Updated Successfully', 200);
    }

    /**
     * Full list of instant-contact submissions for the current profile type.
     */
    public function getInstaResponse(Request $request)
    {
        $userId = Auth::id();
        $profileTypeCode = $this->currentProfileTypeCode();
        $modelClass = $this->contactModelFor($profileTypeCode);

        if (!$modelClass) {
            return response(['code' => 200, 'message' => 'No Insta Response Found'], 200);
        }

        $columns = ['contact_id', 'contact_name', 'contact_mobile', 'contact_email', 'contact_company', 'contact_comment', 'contact_viewed', 'created_at'];
        if ($profileTypeCode == config('constants.profileTypes.Lender')) {
            $columns[] = 'contact_loan_amount';
        } elseif ($profileTypeCode != config('constants.profileTypes.Mentor')) {
            $columns[] = 'contact_investment';
        }

        $rowsQuery = $modelClass::select($columns)->where('user_id', $userId);
        $activeInstanceId = $this->activeProfileInstanceId();
        if ($activeInstanceId) {
            $rowsQuery->where('profile_id', $activeInstanceId);
        }
        $rows = $rowsQuery->orderBy('contact_id', 'desc')->get();

        if ($rows->count() == 0) {
            return response(['code' => 200, 'message' => 'No Insta Response Found'], 200);
        }

        $instaResponse = [];
        foreach ($rows as $row) {
            if ($profileTypeCode == config('constants.profileTypes.Lender')) {
                $investment = convertAmountToShort($row->contact_loan_amount, 0);
            } elseif ($profileTypeCode == config('constants.profileTypes.Mentor')) {
                $investment = '';
            } else {
                $investment = convertAmountToShort($row->contact_investment, 0);
            }

            $instaResponse[] = [
                'contact_id' => $row->contact_id,
                'contact_name' => $row->contact_name,
                'contact_mobile' => $row->contact_mobile,
                'contact_email' => $row->contact_email,
                'contact_company' => $row->contact_company,
                'contact_investment' => $investment,
                'contact_comment' => $row->contact_comment,
                'contact_viewed' => $row->contact_viewed,
                'created_at' => $row->created_at,
            ];
        }

        return response()->json($instaResponse);
    }

    private function currentProfileTypeCode()
    {
        return config('constants.profileTypes.' . ucfirst(session('profile_type', 'investor')));
    }

    /**
     * Numeric id (investor_id/lender_id/mentor_id) of the currently-active
     * profile instance, resolved from session('active_profile_str') — a user
     * can own more than one profile of the same type, so contact_investors/
     * contact_lender/contact_mentor.profile_id (which identifies the SPECIFIC
     * profile a contact was made against) needs to be filtered by this, not
     * just the type. Returns null when there's no active instance yet.
     */
    private function activeProfileInstanceId()
    {
        $type = session('profile_type', 'investor');
        $activeProfileStr = session('active_profile_str');
        if (!$activeProfileStr) {
            return null;
        }
        $instances = getUserProfileInstances(Auth::id())[$type] ?? [];
        foreach ($instances as $instance) {
            if ($instance['profile_str'] === $activeProfileStr) {
                return $instance['id'];
            }
        }
        return null;
    }

    private function contactModelFor($profileTypeCode)
    {
        if ($profileTypeCode == config('constants.profileTypes.Investor')) {
            return ContactInvestor::class;
        }
        if ($profileTypeCode == config('constants.profileTypes.Lender')) {
            return ContactLender::class;
        }
        if ($profileTypeCode == config('constants.profileTypes.Mentor')) {
            return ContactMentor::class;
        }
        return null;
    }
}
