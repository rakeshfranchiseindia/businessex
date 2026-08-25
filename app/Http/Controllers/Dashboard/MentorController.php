<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAccount;
use App\Models\ProfileMentor;
use App\Models\IndPrefMentor;
use App\Models\IndPrefMentorExpertise;
use App\Models\ProfileMentorProfExp;
use App\Models\IndustryCategory;
use App\Models\MentorCategory;

require_once app_path('Helpers/common_helper.php');

class MentorController extends Controller
{
    /**
     * Manage Mentor Information page (Confidential / Advertisement / Profile / Preferences tabs).
     */
    public function edit($user_rand_id)
    {
        $user = $this->resolveUserAccount($user_rand_id);
        $mentor = $this->findMentor($user_rand_id, $user->user_id);

        $indPref = collect();
        $expertisePref = collect();
        $experience = collect();

        if ($mentor) {
            $indPref = IndPrefMentor::join('industry_categories', 'ind_pref_mentors.sub_category_id', '=', 'industry_categories.cat_id')
                ->where('ind_pref_mentors.mentor_profile_id', $mentor->mentor_id)
                ->select('industry_categories.cat_id as id', 'industry_categories.category_name as name', 'industry_categories.parent_id as pid')
                ->get();

            $expertisePref = IndPrefMentorExpertise::join('mentor_categories', 'ind_pref_mentor_expertise.sub_category_id', '=', 'mentor_categories.mentor_category_id')
                ->where('ind_pref_mentor_expertise.mentor_profile_id', $mentor->mentor_id)
                ->select('mentor_categories.mentor_category_id as id', 'mentor_categories.mentor_category_name as name', 'mentor_categories.mentor_parent_id as pid')
                ->get();

            $experience = ProfileMentorProfExp::join('industry_categories', 'profile_mentor_prof_exp.exp_sector', '=', 'industry_categories.cat_id')
                ->where('profile_mentor_prof_exp.mentor_profile_id', $mentor->mentor_id)
                ->select('profile_mentor_prof_exp.exp_year', 'industry_categories.cat_id as sector_id', 'industry_categories.category_name as sector_name')
                ->get();
        }

        $categories = IndustryCategory::select('cat_id', 'category_name', 'parent_id')->orderBy('category_name')->get();

        return view('account_dashboard.mentorConfidentials', compact('user', 'user_rand_id', 'mentor', 'indPref', 'expertisePref', 'experience', 'categories'));
    }

    public function getConfidentialInfo($user_rand_id)
    {
        $user = $this->resolveUserAccount($user_rand_id);
        $mentor = $this->findMentor($user_rand_id, $user->user_id);
        return response()->json([
            'status' => true,
            'data' => [
                'name' => $mentor->mentor_name ?? '',
                'mobile' => $mentor->mentor_mobile ?? '',
                'email' => $mentor->mentor_email ?? '',
                'location' => $mentor->mentor_location ?? '',
            ]
        ]);
    }

    public function updateConfidentialInfo(Request $request, $user_rand_id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z .\'-]+$/'],
            'mobile' => 'required|digits:10',
            'email' => 'required|email|max:255',
            'location' => 'required|string|max:255',
        ]);
        $user = $this->resolveUserAccount($user_rand_id);
        $mentor = $this->findOrNewMentor($user_rand_id, $user);
        $mentor->mentor_name = $request->name;
        $mentor->mentor_mobile = $request->mobile;
        $mentor->mentor_email = $request->email;
        $mentor->mentor_location = $request->location;
        $mentor->save();

        return response()->json([
            'status' => true,
            'message' => 'Information updated successfully!',
            'data' => $mentor->only(['mentor_name', 'mentor_mobile', 'mentor_email', 'mentor_location']),
        ]);
    }

    public function getAdvertisementDetails($user_rand_id)
    {
        $user = $this->resolveUserAccount($user_rand_id);
        $mentor = $this->findMentor($user_rand_id, $user->user_id);
        return response()->json([
            'status' => true,
            'data' => [
                'mentor_adv_headline' => $mentor->mentor_adv_headline ?? '',
                'mentor_intro' => $mentor->mentor_intro ?? '',
            ]
        ]);
    }

    public function updateAdvertisementDetails(Request $request, $user_rand_id)
    {
        $request->validate([
            'mentor_adv_headline' => 'required|string|max:255',
            'mentor_intro' => 'nullable|string|max:255',
        ]);
        $user = $this->resolveUserAccount($user_rand_id);
        $mentor = $this->findOrNewMentor($user_rand_id, $user);

        $mentor->mentor_adv_headline = $request->mentor_adv_headline;
        $mentor->mentor_intro = $request->mentor_intro ?? '';
        $mentor->mentor_profile_status = 1;
        $mentor->save();

        return response()->json([
            'status' => true,
            'message' => 'Advertisement details saved successfully.',
            'data' => [
                'mentor_adv_headline' => $mentor->mentor_adv_headline,
                'mentor_intro' => $mentor->mentor_intro,
            ]
        ]);
    }

    public function getMentorProfileDetails($user_rand_id)
    {
        $user = $this->resolveUserAccount($user_rand_id);
        $mentor = $this->findMentor($user_rand_id, $user->user_id);
        return response()->json([
            'status' => true,
            'data' => [
                'mentor_occupation' => $mentor->mentor_occupation ?? '',
                'mentor_company' => $mentor->mentor_company ?? '',
                'mentor_designation' => $mentor->mentor_designation ?? '',
                'mentor_profile_summary' => $mentor->mentor_profile_summary ?? '',
                'mentor_linkedin' => $mentor->mentor_linkedin ?? '',
                'mentor_profile_pic' => $mentor->mentor_profile_pic ?? '',
            ]
        ]);
    }

    public function updateMentorProfileDetails(Request $request, $user_rand_id)
    {
        $request->validate([
            'mentor_occupation' => 'required|integer',
            'mentor_company' => 'required|string|max:255',
            'mentor_designation' => 'required|string|max:255',
            'mentor_profile_summary' => 'required|string',
            'mentor_linkedin' => 'nullable|url|max:500',
            'mentor_profile_pic' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
        ]);
        $user = $this->resolveUserAccount($user_rand_id);
        $mentor = $this->findOrNewMentor($user_rand_id, $user);

        $mentor->mentor_occupation = $request->mentor_occupation;
        $mentor->mentor_company = $request->mentor_company;
        $mentor->mentor_designation = $request->mentor_designation;
        $mentor->mentor_profile_summary = $request->mentor_profile_summary;
        $mentor->mentor_linkedin = $request->mentor_linkedin;
        $mentor->mentor_profile_status = 1;

        if ($request->hasFile('mentor_profile_pic')) {
            $imagePic = $request->file('mentor_profile_pic');
            $imgExt = strtolower($imagePic->getClientOriginalExtension());
            $mentorProfilePath = config('constants.MentorProfileImagePath');
            $imgProfilePath = sprintf($mentorProfilePath, date('Ym'), random_int(100, 99999) . '_' . time(), $imgExt);
            $oldImage = $mentor->mentor_profile_pic;
            $imageName = $this->imageUploadPost($imgProfilePath, $imagePic);
            if (!$imageName) {
                return response()->json(['status' => false, 'message' => 'Profile image upload failed.'], 500);
            }
            if (!empty($oldImage)) {
                $oldFile = public_path($oldImage);
                if (file_exists($oldFile)) {
                    @unlink($oldFile);
                }
            }
            $mentor->mentor_profile_pic = $imageName;
            $mentor->mentor_profile_pic_name = $imagePic->getClientOriginalName();
        }

        $mentor->save();

        return response()->json([
            'status' => true,
            'message' => 'Mentor profile updated successfully.',
            'data' => [
                'mentor_occupation' => $mentor->mentor_occupation,
                'mentor_company' => $mentor->mentor_company,
                'mentor_designation' => $mentor->mentor_designation,
                'mentor_profile_summary' => $mentor->mentor_profile_summary,
                'mentor_linkedin' => $mentor->mentor_linkedin,
                'mentor_profile_pic' => $mentor->mentor_profile_pic,
            ]
        ]);
    }

    public function getMentorPreferenceDetails($user_rand_id)
    {
        $user = $this->resolveUserAccountOrNull($user_rand_id);
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
                'data' => ['expertise' => [], 'industries' => [], 'experience' => []],
            ], 404);
        }

        $mentor = $this->findMentor($user_rand_id, $user->user_id);
        if (!$mentor) {
            return response()->json([
                'status' => true,
                'data' => ['expertise' => [], 'industries' => [], 'experience' => []],
            ]);
        }

        $expertise = IndPrefMentorExpertise::join('mentor_categories', 'ind_pref_mentor_expertise.sub_category_id', '=', 'mentor_categories.mentor_category_id')
            ->where('ind_pref_mentor_expertise.mentor_profile_id', $mentor->mentor_id)
            ->select('mentor_categories.mentor_category_id as id', 'mentor_categories.mentor_category_name as name', 'mentor_categories.mentor_parent_id as pid')
            ->get();

        $indPref = IndPrefMentor::join('industry_categories', 'ind_pref_mentors.sub_category_id', '=', 'industry_categories.cat_id')
            ->where('ind_pref_mentors.mentor_profile_id', $mentor->mentor_id)
            ->select('industry_categories.cat_id as id', 'industry_categories.category_name as name', 'industry_categories.parent_id as pid')
            ->get();

        $experience = ProfileMentorProfExp::join('industry_categories', 'profile_mentor_prof_exp.exp_sector', '=', 'industry_categories.cat_id')
            ->where('profile_mentor_prof_exp.mentor_profile_id', $mentor->mentor_id)
            ->select('profile_mentor_prof_exp.exp_year', 'industry_categories.cat_id as sector_id', 'industry_categories.category_name as sector_name')
            ->get();

        return response()->json([
            'status' => true,
            'data' => [
                'expertise' => $expertise,
                'industries' => $indPref,
                'experience' => $experience,
            ]
        ]);
    }

    public function updateMentorPreferenceDetails(Request $request, $user_rand_id)
    {
        $request->validate([
            'sectors' => 'nullable',
            'sectors.*' => 'nullable|string|max:100',
            'expertise' => 'nullable',
            'expertise.*' => 'nullable|string|max:100',
            'exp_years' => 'nullable|array',
            'exp_years.*' => 'nullable|integer|min:0|max:80',
            'exp_sectors' => 'nullable|array',
            'exp_sectors.*' => 'nullable|integer',
        ]);

        $user = $this->resolveUserAccountOrNull($user_rand_id);
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not found.'], 404);
        }
        $mentor = $this->findMentor($user_rand_id, $user->user_id);
        if (!$mentor) {
            return response()->json(['status' => false, 'message' => 'Mentor profile not found.'], 404);
        }

        $unmatched = [];

        if ($request->has('sectors')) {
            $this->syncCategoryTags(
                $request->input('sectors'),
                IndPrefMentor::class,
                'mentor_profile_id',
                $mentor->mentor_id,
                $mentor->user_id,
                $unmatched
            );
        }

        if ($request->has('expertise')) {
            $this->syncCategoryTags(
                $request->input('expertise'),
                IndPrefMentorExpertise::class,
                'mentor_profile_id',
                $mentor->mentor_id,
                $mentor->user_id,
                $unmatched,
                MentorCategory::class,
                'mentor_category_id',
                'mentor_category_name',
                'mentor_parent_id'
            );
        }

        if ($request->has('exp_years')) {
            $years = (array) $request->input('exp_years', []);
            $sectors = (array) $request->input('exp_sectors', []);

            ProfileMentorProfExp::where('mentor_profile_id', $mentor->mentor_id)->delete();

            foreach ($years as $index => $year) {
                $sectorId = $sectors[$index] ?? null;
                if (empty($year) || empty($sectorId)) {
                    continue;
                }
                $row = new ProfileMentorProfExp();
                $row->mentor_profile_id = $mentor->mentor_id;
                $row->user_id = $mentor->user_id;
                $row->exp_year = (int) $year;
                $row->exp_sector = (int) $sectorId;
                $row->save();
            }
        }

        if (!empty($unmatched)) {
            return response()->json([
                'status' => false,
                'unmatched_sectors' => array_values($unmatched),
                'message' => 'Some preferences could not be matched to a category.',
            ], 200);
        }

        return response()->json([
            'status' => true,
            'message' => 'Preference data updated successfully.',
        ], 200);
    }

    public function getUserProfileDetails()
    {
        $user_id = Auth::id();
        $user = UserAccount::select('name', 'email', 'location', 'company_name', 'designation', 'mobile', 'profile_pic')
            ->where('user_id', $user_id)->first();
        $profile = ProfileMentor::select('mentor_adv_headline', 'mentor_intro', 'mentor_company', 'mentor_designation', 'mentor_profile_summary', 'mentor_linkedin')
            ->where('user_id', $user_id)->first();

        return view('account_dashboard.mymentor', compact('user', 'profile'));
    }

    /**
     * Find an existing mentor profile for this user (by profile string, then by user id).
     */
    private function findMentor($user_rand_id, $userId)
    {
        $mentor = ProfileMentor::where('mentor_profile_str', $user_rand_id)->first();
        if (!$mentor) {
            $mentor = ProfileMentor::where('user_id', $userId)->first();
        }
        return $mentor;
    }

    /**
     * Every Manage route/tab here is keyed by a route segment that's meant to
     * double as either the account's own user_rand_id (old, single-profile
     * behaviour) OR a *specific* mentor profile's own mentor_profile_str
     * (needed now that a user can have several Mentor profiles — the
     * dropdown passes THAT profile's str so Manage opens the right one).
     */
    private function resolveUserAccount($user_rand_id)
    {
        return $this->resolveUserAccountOrNull($user_rand_id)
            ?? UserAccount::where('user_rand_id', $user_rand_id)->firstOrFail();
    }

    private function resolveUserAccountOrNull($user_rand_id)
    {
        $mentor = ProfileMentor::where('mentor_profile_str', $user_rand_id)->first();
        if ($mentor) {
            $user = UserAccount::find($mentor->user_id);
            if ($user) {
                return $user;
            }
        }
        return UserAccount::where('user_rand_id', $user_rand_id)->first();
    }

    /**
     * Find an existing mentor profile, or start a new one pre-filled with the account's
     * confidential info (mentor_name/mobile/email/location are NOT NULL columns).
     */
    private function findOrNewMentor($user_rand_id, UserAccount $user)
    {
        $mentor = $this->findMentor($user_rand_id, $user->user_id);
        if (!$mentor) {
            $mentor = new ProfileMentor();
            $mentor->user_id = $user->user_id;
            $mentor->mentor_profile_str = $user_rand_id;
            $mentor->mentor_name = $user->name;
            $mentor->mentor_mobile = $user->mobile;
            $mentor->mentor_email = $user->email;
            $mentor->mentor_location = $user->location;
        }
        return $mentor;
    }

    /**
     * Sync a comma-separated / array tag list against industry_categories into the given pivot model.
     */
    /**
     * Sync a comma-separated / array tag list against a category table into the given pivot model.
     *
     * @param string $categoryModel  IndustryCategory::class or MentorCategory::class
     * @param string $idColumn       category primary key column (cat_id / mentor_category_id)
     * @param string $nameColumn     category display-name column (category_name / mentor_category_name)
     * @param string $parentColumn   category parent-id column (parent_id / mentor_parent_id)
     */
    private function syncCategoryTags(
        $input,
        $modelClass,
        $fkColumn,
        $profileId,
        $userId,
        array &$unmatched,
        $categoryModel = IndustryCategory::class,
        $idColumn = 'cat_id',
        $nameColumn = 'category_name',
        $parentColumn = 'parent_id'
    ) {
        $tags = is_array($input) ? $input : explode(',', $input);
        $tags = array_filter(array_map('trim', $tags));

        $validCategoryIds = [];
        foreach ($tags as $tagName) {
            $category = $categoryModel::whereRaw('LOWER(TRIM(' . $nameColumn . ')) = ?', [strtolower($tagName)])->first();
            if (!$category) {
                $unmatched[] = $tagName;
                continue;
            }
            $validCategoryIds[] = $category->{$idColumn};
            $exists = $modelClass::where($fkColumn, $profileId)
                ->where('user_id', $userId)
                ->where('sub_category_id', $category->{$idColumn})
                ->exists();
            if (!$exists) {
                $row = new $modelClass();
                $row->{$fkColumn} = $profileId;
                $row->user_id = $userId;
                $row->parent_category_id = $category->{$parentColumn};
                $row->sub_category_id = $category->{$idColumn};
                $row->profile_status = 1;
                $row->save();
            }
        }

        if (!empty($validCategoryIds)) {
            $modelClass::where($fkColumn, $profileId)
                ->where('user_id', $userId)
                ->whereNotIn('sub_category_id', $validCategoryIds)
                ->delete();
        } else {
            $modelClass::where($fkColumn, $profileId)
                ->where('user_id', $userId)
                ->delete();
        }
    }

    /**
     * Autocomplete search for the "Subject Expertise" tag box (mentor_categories,
     * a separate taxonomy from industry_categories used by "Sector Preference").
     */
    public function searchMentorCategories(Request $request)
    {
        $search = trim($request->input('search', ''));
        if ($search === '') {
            return response()->json(['status' => true, 'data' => []]);
        }
        $categories = MentorCategory::select('mentor_category_id', 'mentor_category_name', 'mentor_parent_id')
            ->where('mentor_category_name', 'LIKE', '%' . $search . '%')
            ->orderBy('mentor_category_name', 'asc')
            ->limit(20)
            ->get()
            ->map(function ($category) {
                return ['id' => $category->mentor_category_id, 'name' => $category->mentor_category_name, 'pid' => $category->mentor_parent_id];
            });
        return response()->json(['status' => true, 'data' => $categories]);
    }

    /**
     * Comma-separated sector preference names for a mentor profile id.
     * Ported from the old MentorController for reuse (e.g. contact-history style listings).
     */
    public function getMentorSectors($mentorId)
    {
        $sectorPref = IndPrefMentor::join('industry_categories', 'ind_pref_mentors.sub_category_id', '=', 'industry_categories.cat_id')
            ->where('ind_pref_mentors.mentor_profile_id', $mentorId)
            ->pluck('industry_categories.category_name');
        return $sectorPref->implode(', ');
    }

    /**
     * Comma-separated subject-expertise names for a mentor profile id.
     */
    public function getMentorSubjectExpertise($mentorId)
    {
        $subjectExp = IndPrefMentorExpertise::join('mentor_categories', 'ind_pref_mentor_expertise.sub_category_id', '=', 'mentor_categories.mentor_category_id')
            ->where('ind_pref_mentor_expertise.mentor_profile_id', $mentorId)
            ->pluck('mentor_categories.mentor_category_name');
        return $subjectExp->implode(', ');
    }

    private function imageUploadPost($imagePath, $imagePic)
    {
        $directory = public_path('uploads/' . dirname($imagePath));
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        $fileName = basename($imagePath);
        $imagePic->move($directory, $fileName);
        return 'uploads/' . $imagePath;
    }
}
