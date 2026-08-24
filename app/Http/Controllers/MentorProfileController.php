<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\ProfileMentor;
use App\Models\UserProfile;
use App\Models\IndPrefMentor;
use App\Models\IndPrefMentorExpertise;
use App\Mail\ProfileCreation;
use App\Helpers\BusinessExHelper;
use App\Models\UserAccount;

class MentorProfileController extends Controller
{
    public function createMentorProfile()
    {
        return view('registration.create-mentor-profile');
    }

    public function createMentor(Request $request)
    {
        $mentorName = $request->input('mentor_name', $request->input('name'));
        $mentorMobile = $request->input('mentor_mobile', $request->input('mobile'));
        $mentorEmail = $request->input('mentor_email', $request->input('email'));
        $mentorLocation = $request->input('mentor_location', $request->input('location'));
        $mentorCity = $request->input('mentor_city', $request->input('city'));
        $mentorState = $request->input('mentor_state', $request->input('state'));
        $mentorCountry = $request->input('mentor_country', $request->input('country'));
        $mentorOccupation = $request->input('mentor_occupation', $request->input('occupation'));
        $mentorCompany = $request->input('mentor_company', $request->input('company'));
        $mentorDesignation = $request->input('mentor_designation', $request->input('designation'));
        $mentorSummary = $request->input('mentor_profile_summary', $request->input('summary'));
        $mentorHeadline = $request->input('mentor_adv_headline', $request->input('headline'));
        $mentorIntro = $request->input('mentor_intro', $request->input('introduction'));
        $mentorLinkedIn = $request->input('mentor_linkedin', $request->input('linkedin'));

        $mentorOccupationRaw = $request->input('mentor_occupation', $request->input('occupation'));
        $mentorOccupation = $mentorOccupationRaw;
        if (is_string($mentorOccupationRaw)) {
            $mentorOccupation = collect(config('constants.mentorOccupation', []))->flip()->get($mentorOccupationRaw, $mentorOccupationRaw);
            if (is_string($mentorOccupation) && is_numeric($mentorOccupation)) {
                $mentorOccupation = (int) $mentorOccupation;
            }
        }
        if (is_string($mentorOccupation) && is_numeric($mentorOccupation)) {
            $mentorOccupation = (int) $mentorOccupation;
        }

        $request->validate([
            'mentor_name' => ['required', 'string', 'max:100'],
            'mentor_mobile' => ['required', 'string', 'max:20'],
            'mentor_email' => ['required', 'email', 'max:100', 'unique:profile_mentors,mentor_email'],
            'mentor_location' => ['nullable', 'string', 'max:155'],
            'mentor_occupation' => ['nullable', 'string', 'max:255'],
            'mentor_linkedin' => ['nullable', 'url', 'max:255'],
        ], [
            'mentor_name.required' => 'Your name is required.',
            'mentor_mobile.required' => 'Your mobile number is required.',
            'mentor_email.required' => 'Your email is required.',
        ]);

        $userId = Auth::id();
        if (!$userId) {
            $user = UserAccount::firstOrCreate(
                ['email' => $mentorEmail],
                [
                    'name' => $mentorName,
                    'mobile' => $mentorMobile,
                    'location' => $mentorLocation ?? 'India',
                    'company_name' => $mentorCompany ?? 'N/A',
                    'designation' => $mentorDesignation ?? 'Mentor',
                    'password' => bcrypt('BusinessEx@' . random_int(1000, 999999)),
                    'user_rand_id' => strtolower(Str::random(8)),
                    'reg_profile' => 'Mentor',
                    'is_active' => 1,
                ]
            );
            $userId = $user->user_id;
        }

        $mentorProfileStr = CommonController::profileUniqueStr();
        $imageName = null;
        $uploadFile = $request->file('mentor_profile_pic') ?: $request->file('image');

        if ($uploadFile) {
            $imagePic = $uploadFile;
            $imgExt = $imagePic->getClientOriginalExtension();

            $mentorProfilePath = sprintf(
                config('constants.MentorProfileImagePath'),
                date('Ym'),
                random_int(100, 99999) . '_' . time(),
                $imgExt
            );

            $imageName = CommonController::imageUploadPost($mentorProfilePath, $imagePic);
        }

        $professionalExperience = [];
        $experienceYears = $request->input('experience_years', []);
        $sectorExpertise = $request->input('sector_expertise', []);
        foreach ($experienceYears as $index => $year) {
            $yearValue = trim((string) $year);
            if ($yearValue === '') {
                continue;
            }

            $professionalExperience[] = (object) [
                'prof_exp_year' => $yearValue,
                'mentor_sector_expertise' => $sectorExpertise[$index] ?? null,
            ];
        }

        DB::beginTransaction();

        try {
            $mentor = ProfileMentor::create([
                'mentor_profile_str' => $mentorProfileStr,
                'user_id' => $userId,
                'mentor_name' => $mentorName,
                'mentor_mobile' => $mentorMobile,
                'mentor_email' => $mentorEmail,
                'mentor_location' => trim((string) $mentorLocation, '"'),
                'mentor_city' => trim((string) $mentorCity, '"'),
                'mentor_state' => trim((string) $mentorState, '"'),
                'mentor_country' => trim((string) $mentorCountry, '"'),
                'mentor_adv_headline' => $mentorHeadline,
                'mentor_intro' => $mentorIntro,
                'mentor_occupation' => is_numeric($mentorOccupation) ? (int) $mentorOccupation : null,
                'mentor_company' => $mentorCompany,
                'mentor_designation' => $mentorDesignation,
                'mentor_profile_summary' => $mentorSummary,
                'mentor_profile_pic' => $imageName,
                'mentor_linkedin' => $mentorLinkedIn,
                'mentor_profile_status' => config('constants.ProfileStatus.Awaiting'),
                'trackid' => $request->input('trackid'),
                'utm_source' => $request->input('utm_source'),
                'utm_medium' => $request->input('utm_medium'),
                'utm_campaign' => $request->input('utm_campaign'),
            ]);

            $lastInsertId = $mentor->mentor_id;

            if (!empty($professionalExperience)) {
                BusinessExHelper::saveProfessionalExperience($professionalExperience, $lastInsertId, $userId);
            }

            $sectorPreferences = $request->input('mentor_sector_preference', $request->input('sector_preference', []));
            foreach ((array) $sectorPreferences as $pref) {
                $entries = is_array($pref) ? $pref : explode(',', (string) $pref);
                foreach ($entries as $entry) {
                    $entry = trim((string) $entry);
                    if ($entry === '') {
                        continue;
                    }

                    $parts = explode('_', $entry);
                    $subCategoryId = (int) ($parts[0] ?? $entry);
                    $parentCategoryId = (int) ($parts[2] ?? 0);
                    IndPrefMentor::create([
                        'mentor_profile_id' => $lastInsertId,
                        'user_id' => $userId,
                        'parent_category_id' => $parentCategoryId,
                        'sub_category_id' => $subCategoryId,
                        'profile_status' => config('constants.ProfileStatus.Awaiting'),
                    ]);
                }
            }

            $subjectExpertise = $request->input('mentor_subject_expertise', $request->input('subject_expertise', []));
            foreach ((array) $subjectExpertise as $exp) {
                $entries = is_array($exp) ? $exp : explode(',', (string) $exp);
                foreach ($entries as $entry) {
                    $entry = trim((string) $entry);
                    if ($entry === '') {
                        continue;
                    }

                    $parts = explode('_', $entry);
                    $subCategoryId = (int) ($parts[0] ?? $entry);
                    $parentCategoryId = (int) ($parts[2] ?? 0);
                    IndPrefMentorExpertise::create([
                        'mentor_profile_id' => $lastInsertId,
                        'user_id' => $userId,
                        'parent_category_id' => $parentCategoryId,
                        'sub_category_id' => $subCategoryId,
                        'profile_status' => config('constants.ProfileStatus.Awaiting'),
                    ]);
                }
            }

            $user = UserAccount::find($userId);
            if ($user && $user->reg_profile === null) {
                $user->update(['reg_profile' => 'Other']);
            }

            UserProfile::create([
                'user_id' => $userId,
                'profile_id' => $lastInsertId,
                'profile_type' => config('constants.profileTypes.Mentor'),
                'profile_str' => $mentorProfileStr,
                'profile_status' => config('constants.ProfileStatus.Awaiting'),
            ]);

            DB::commit();

            try {
                if ($user && !empty($user->email)) {
                    $MailData = [$mentorName, 'Mentor', 'Mentor'];
                    Mail::to($user->email)->send(new ProfileCreation($MailData));
                }
            } catch (\Exception $e) {
                Log::alert('Profile creation mail failed for ' . ($user->email ?? 'unknown') . ' -- ' . $e->getMessage());
            }

            Log::info("Registration successful : " . $mentorEmail);

            return redirect()->back()->with('success', 'Mentor Profile Registration Successful. Please check your email for confirmation.');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($imageName) {
                try {
                    Storage::disk('s3')->delete($imageName);
                } catch (\Exception $storageException) {
                    Log::warning('Failed to remove mentor image: ' . $storageException->getMessage());
                }
            }
            Log::error('Registration Failed : ' . $e->getMessage());

            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function createMentorNewPost(Request $request)
    {
        return $this->createMentor($request);
    }
}
