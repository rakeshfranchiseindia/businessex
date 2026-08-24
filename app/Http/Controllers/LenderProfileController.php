<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileLender;
use App\Models\UserProfile;
use App\Models\IndPrefLender;
use App\Models\LocPrefLender;
use App\Models\UserAccount;
use App\Mail\ProfileCreation;

class LenderProfileController extends Controller
{
    /**
     * Show Lender Profile Creation Form
     */
    public function createLenderProfile()
    {
        return view('registration.create-lender-profile');
    }

    /**
     * Create Lender Profile with proper validation and schema-compatible values.
     */
    public function createLender(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'                   => 'required|string|max:255',
                'email'                  => 'required|email|max:100|unique:profile_lenders,lender_email',
                'mobile'                 => 'required|string|max:20',
                'location'               => 'required|string|max:255',
                'advertisement_headline' => 'required|string|max:255',
                'introduction'           => 'required|string',
                'lender_type'            => 'required|in:Private Lender,NBFC Personnel',
                'occupation'             => 'nullable|string',
                'lending_interest_rate'  => 'nullable|numeric|min:0|max:100',
                'sector_preference'      => 'nullable|string|max:255',
                'profile_pictures'       => 'nullable|file|mimes:png,jpeg,jpg,gif|max:2048',
                'professional_summary'   => 'nullable|string',
                'location_preference'    => 'nullable|string|max:255',
            ], [
                'email.unique' => 'This email is already registered as a lender.',
                'name.required' => 'Your name is required.',
                'lender_type.required' => 'Lender type is required.',
                'lender_type.in' => 'Please select a valid lender type.',
            ]);

            DB::beginTransaction();

            $userId = Auth::id();
            if (!$userId) {
                throw new \Exception('User must be authenticated or user_id must be provided.');
            }

            $lenderTypeMap = [
                'Private Lender' => 3,
                'NBFC Personnel' => 2,
            ];

            $lenderTypeValue = $lenderTypeMap[$validated['lender_type']] ?? 3;
            $lenderProfileStr = $this->generateProfileString();

            $profilePicPath = null;
            if ($request->hasFile('profile_pictures')) {
                $profilePicPath = $this->saveProfilePicture($request->file('profile_pictures'));
            }

            $lender = ProfileLender::create([
                'lender_profile_str'      => $lenderProfileStr,
                'user_id'                 => $userId,
                'lender_name'             => $validated['name'],
                'lender_mobile'           => $validated['mobile'],
                'lender_email'            => $validated['email'],
                'lender_location'         => $validated['location'],
                'lender_adv_headline'     => $validated['advertisement_headline'],
                'lender_intro'            => $validated['introduction'],
                'lender_type'             => $lenderTypeValue,
                'lender_occupation'       => $validated['occupation'] ?? null,
                'lending_interest_rate'   => $validated['lending_interest_rate'] ?? 0,
                'prof_summary'            => $validated['professional_summary'] ?? null,
                'profile_pic_path'        => $profilePicPath,
                'lender_profile_status'   => config('constants.ProfileStatus.Awaiting'),
            ]);

            $lenderId = $lender->lender_id;

            UserProfile::create([
                'user_id'        => $userId,
                'profile_id'     => $lenderId,
                'profile_type'   => config('constants.profileTypes.Lender'),
                'profile_str'    => $lenderProfileStr,
                'profile_status' => config('constants.ProfileStatus.Awaiting'),
            ]);

            if (!empty($validated['sector_preference'])) {
                IndPrefLender::create([
                    'lender_profile_id' => $lenderId,
                    'user_id' => $userId,
                    'parent_category_id' => 0,
                    'sub_category_id' => 0,
                    'profile_status' => config('constants.ProfileStatus.Awaiting'),
                ]);
            }

            if (!empty($validated['location_preference'])) {
                LocPrefLender::create([
                    'lender_profile_id' => $lenderId,
                    'user_id' => $userId,
                    'place_id' => 'manual-' . time(),
                    'location_name' => $validated['location_preference'],
                    'loc_state' => '',
                    'loc_country' => '',
                    'loc_latitude' => '0',
                    'loc_longitude' => '0',
                    'profile_status' => config('constants.ProfileStatus.Awaiting'),
                ]);
            }

            DB::commit();

            $user = UserAccount::find($userId);
            if ($user && !empty($user->email)) {
                try {
                    Mail::to($user->email)->send(new ProfileCreation([
                        $validated['name'],
                        'Lender',
                        'Lender'
                    ]));
                } catch (\Exception $e) {
                    Log::warning("Lender profile email failed for {$user->email}: " . $e->getMessage());
                }
            }

            Log::info("Lender profile created successfully: {$validated['email']} (ID: {$lenderId})");

            return redirect()->back()->with('success', 'Lender Profile created successfully! Your profile is awaiting admin review.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->errors());

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Lender profile creation failed: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Save Profile Picture
     */
    private function saveProfilePicture($file)
    {
        try {
            if (!$file || !$file->isValid()) {
                return null;
            }

            $fileName = time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();

            $storagePath = Storage::disk('s3')->putFileAs(
                'lenders/' . date('Ym'),
                $file,
                $fileName
            );

            Log::info("Lender profile picture saved: {$fileName}");
            return $storagePath;

        } catch (\Exception $e) {
            Log::error("Failed to save lender profile picture: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Generate unique profile string
     */
    private function generateProfileString()
    {
        return 'LND_' . strtoupper(substr(md5(time() . rand()), 0, 12));
    }
}

