<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileStartup;
use App\Models\UserProfile;
use App\Models\StartupImage;
use App\Models\ProfileStartupMgmt;
use App\Mail\ProfileCreation;
use App\Models\UserAccount;

class StartupProfileController extends Controller
{
    public function createStartupProfile(){
        return view('registration.create-startup-profile');
    }
    
    /**
     * Create Startup Profile with comprehensive validation and data handling
     * Saves data to: user_account, user_profile, profile_startups, profile_startup_mgmt, startup_images
     */
    public function createStartup(Request $request)
    {
        try {
            // ✅ COMPREHENSIVE VALIDATION
            $validated = $request->validate([
                // Confidential Information
                'your_name'                 => 'required|string|max:255',
                'email'                     => 'required|email|max:100',
                'mobile_no'                 => 'required|string|max:20',
                'designation'               => 'required|string|max:100',

                // Advertisement Details
                'advertisement_headline'    => 'required|string|max:255',
                'introduction'              => 'required|string',

                // Company Information
                'name_of_entity'            => 'required|string|max:255',
                'business_type'             => 'required|string',
                'nature_of_entity'          => 'nullable|string',
                'industry_sector'           => 'required|string',
                'establishment_year'        => 'required|integer|min:1900|max:' . date('Y'),
                'number_of_employees'       => 'required|string',
                'certification_incorporation' => 'nullable|file|mimes:png,jpeg,jpg,gif|max:2048',
                'website'                   => 'nullable|url',
                'facilities'                => 'nullable|string',
                'company_summary'           => 'nullable|string',

                // Financial Details
                'annual_sales'              => 'nullable|numeric|min:0',
                'inventory_value'           => 'nullable|numeric|min:0',
                'gross_income'              => 'nullable|numeric|min:0',
                'ebitda'                    => 'nullable|numeric',
                'ebitda_margin'             => 'nullable|string',
                'rentals'                   => 'nullable|numeric|min:0',

                // Social Media Links
                'facebook_url'              => 'nullable|url',
                'twitter_url'               => 'nullable|url',
                'linkedin_url'              => 'nullable|url',

                // Headquarters
                'address'                   => 'required|string',
                'city'                      => 'nullable|string|max:100',
                'pin_code'                  => 'required|string|max:20',

                // Director Information
                'director_name'             => 'nullable|string|max:255',
                'director_email'            => 'nullable|email',
                'director_designation'      => 'nullable|string|max:100',

                // Management Team
                'team_member_name'          => 'nullable|array',
                'team_member_name.*'        => 'nullable|string|max:255',
                'team_member_designation'   => 'nullable|array',
                'team_member_designation.*' => 'nullable|string|max:100',
                'team_member_email'         => 'nullable|array',
                'team_member_email.*'       => 'nullable|email',

                // Business Plan
                'company_stage'             => 'nullable|string',
                'customer_problem_solution' => 'nullable|string',
                'startup_product'           => 'nullable|string',
                'target_customer_segment'   => 'nullable|string',
                'target_market'             => 'nullable|string',
                'competitors'               => 'nullable|string',
                'competitive_advantage'     => 'nullable|string',
                'sales_marketing_strategy'  => 'nullable|string',
                'funding_round'             => 'nullable|string',
                'investment_amount'         => 'nullable|numeric|min:0',

                // Business Requirements - Investors
                'seeking_investors'         => 'nullable|boolean',
                'investor_investment_amount' => 'nullable|numeric|min:0',
                'investor_business_stake'   => 'nullable|numeric|min:0|max:100',
                'investor_investment_reason' => 'nullable|string',

                // Business Requirements - Loan
                'seeking_loan'              => 'nullable|boolean',
                'loan_amount'               => 'nullable|numeric|min:0',
                'loan_repayment_period'     => 'nullable|string',
                'loan_interest_rate'        => 'nullable|numeric|min:0',
                'loan_existing_details'     => 'nullable|string',
                'loan_reason'               => 'nullable|string',
                'loan_collateral_details'   => 'nullable|string',

                // Business Requirements - Buyers
                'seeking_buyers'            => 'nullable|boolean',
                'buyer_selling_price'       => 'nullable|numeric|min:0',
                'buyer_selling_reason'      => 'nullable|string',

                // Business Requirements - Incubators
                'seeking_incubators'        => 'nullable|boolean',
                'incubator_requirements'    => 'nullable|string',
                'incubator_expected_investment' => 'nullable|numeric|min:0',
                'incubator_time_period'     => 'nullable|string',

                // Business Requirements - Mentors
                'seeking_mentors'           => 'nullable|boolean',
                'mentor_requirements'       => 'nullable|string',

                // Business Pitch and Media
                'one_line_pitch'            => 'required|string',
                'business_photos'           => 'nullable|array|max:4',
                'business_photos.*'         => 'nullable|file|mimes:png,jpeg,jpg,gif|max:2048',
                'business_documents'        => 'nullable|array|max:4',
                'business_documents.*'      => 'nullable|file|mimes:doc,docx,xls,xlsx,pdf|max:5120',
            ], [
                'email.unique' => 'This email is already registered.',
                'your_name.required' => 'Your name is required.',
                'address.required' => 'Company address is required.',
                'one_line_pitch.required' => 'Business pitch is required.',
            ]);

            DB::beginTransaction();

            // Get user ID from authenticated user or create/fetch one from the submitted email
            $userId = Auth::id();
            if (!$userId) {
                $user = UserAccount::firstOrCreate(
                    ['email' => $validated['email']],
                    [
                        'name' => $validated['your_name'],
                        'mobile' => $validated['mobile_no'],
                        'location' => $validated['city'] ?? 'India',
                        'company_name' => $validated['name_of_entity'],
                        'designation' => $validated['designation'],
                        'password' => bcrypt('BusinessEx@' . random_int(1000, 999999)),
                        'user_rand_id' => strtolower(\Illuminate\Support\Str::random(8)),
                        'reg_profile' => 'Startup',
                        'is_active' => 1,
                    ]
                );
                $userId = $user->user_id;
            }

            $startupProfileStr = $this->generateProfileString();

            // ✅ 1. Create Startup Profile Record
            $startup = ProfileStartup::create([
                'startup_profile_str'       => $startupProfileStr,
                'user_id'                   => $userId,
                'startup_name'              => $validated['name_of_entity'],
                'startup_mobile'            => $validated['mobile_no'],
                'startup_email'             => $validated['email'],
                'startup_designation'       => $validated['designation'],
                'advmt_headline'            => $validated['advertisement_headline'],
                'startup_intro'             => $validated['introduction'],
                'name_of_entity'            => $validated['name_of_entity'],
                'business_type'             => $validated['business_type'],
                'nature_of_entity'          => $validated['nature_of_entity'] ?? null,
                'industry_sector'           => $validated['industry_sector'],
                'estb_date'                 => $validated['establishment_year'],
                'emp_count'                 => $validated['number_of_employees'],
                'business_website'          => $validated['website'] ?? null,
                'facilities_desc'           => $validated['facilities'] ?? null,
                'company_summary'           => $validated['company_summary'] ?? null,
                'annual_sales'              => $validated['annual_sales'] ?? 0,
                'inventory_value'           => $validated['inventory_value'] ?? 0,
                'gross_profit'              => $validated['gross_income'] ?? 0,
                'ebitda'                    => $validated['ebitda'] ?? 0,
                'ebitda_margin'             => $validated['ebitda_margin'] ?? null,
                'rentals'                   => $validated['rentals'] ?? 0,
                'facebook_profile'          => $validated['facebook_url'] ?? null,
                'twitter_profile'           => $validated['twitter_url'] ?? null,
                'linkedin_profile'          => $validated['linkedin_url'] ?? null,
                'ofc_address'               => $validated['address'],
                'ofc_city'                  => $validated['city'] ?? null,
                'ofc_pincode'               => $validated['pin_code'],
                'director_name'             => $validated['director_name'] ?? null,
                'director_email'            => $validated['director_email'] ?? null,
                'director_designation'      => $validated['director_designation'] ?? null,
                'company_stage'             => $validated['company_stage'] ?? null,
                'customer_problem'          => $validated['customer_problem_solution'] ?? null,
                'product_service'           => $validated['startup_product'] ?? null,
                'customer_segment'          => $validated['target_customer_segment'] ?? null,
                'target_market'             => $validated['target_market'] ?? null,
                'competitors'               => $validated['competitors'] ?? null,
                'competitive_advantage'     => $validated['competitive_advantage'] ?? null,
                'sales_marketing'           => $validated['sales_marketing_strategy'] ?? null,
                'business_pitch'            => $validated['one_line_pitch'],
                
                // Investor Preferences
                'seeking_investors'         => $request->has('seeking_investors') ? 1 : 0,
                'inv_asking_price'          => $validated['investor_investment_amount'] ?? null,
                'inv_stake'                 => $validated['investor_business_stake'] ?? null,
                'inv_reason'                => $validated['investor_investment_reason'] ?? null,
                
                // Loan Preferences
                'seeking_loan'              => $request->has('seeking_loan') ? 1 : 0,
                'loan_amount'               => $validated['loan_amount'] ?? null,
                'loan_repayment_period'     => $validated['loan_repayment_period'] ?? null,
                'loan_interest_rate'        => $validated['loan_interest_rate'] ?? null,
                'loan_reason'               => $validated['loan_reason'] ?? null,
                'loan_collateral_details'   => $validated['loan_collateral_details'] ?? null,
                
                // Buyers Preferences
                'seeking_acquirers'         => $request->has('seeking_buyers') ? 1 : 0,
                'buyer_sell_price'          => $validated['buyer_selling_price'] ?? null,
                'buyer_sell_reason'         => $validated['buyer_selling_reason'] ?? null,
                
                // Incubator Preferences
                'seeking_incubators'        => $request->has('seeking_incubators') ? 1 : 0,
                'accel_req_details'         => $validated['incubator_requirements'] ?? null,
                'accel_inv_req'             => $validated['incubator_expected_investment'] ?? null,
                'accel_time_period'         => $validated['incubator_time_period'] ?? null,
                
                // Mentor Preferences
                'seeking_mentorship'        => $request->has('seeking_mentors') ? 1 : 0,
                'mentor_req_details'        => $validated['mentor_requirements'] ?? null,
                
                'startup_profile_status'    => config('constants.ProfileStatus.Awaiting'),
            ]);

            $startupId = $startup->startup_id;

            // ✅ 2. Create User Profile Record
            UserProfile::create([
                'user_id'           => $userId,
                'profile_id'        => $startupId,
                'profile_type'      => config('constants.profileTypes.Startup'),
                'profile_str'       => $startupProfileStr,
                'profile_status'    => config('constants.ProfileStatus.Awaiting'),
            ]);

            // ✅ 3. Save Management Team Information
            if (!empty($validated['team_member_name'])) {
                foreach ($validated['team_member_name'] as $index => $name) {
                    if (!empty($name)) {
                        ProfileStartupMgmt::create([
                            'startup_profile_id' => $startupId,
                            'user_id'            => $userId,
                            'mgmt_name'          => $name,
                            'mgmt_designation'   => $validated['team_member_designation'][$index] ?? null,
                            'mgmt_email'         => $validated['team_member_email'][$index] ?? null,
                        ]);
                    }
                }
            }

            // ✅ 4. Save Business Photos
            if ($request->hasFile('business_photos')) {
                foreach ($request->file('business_photos') as $photo) {
                    if ($photo && $photo->isValid()) {
                        $this->saveStartupImage($photo, $startupId, $userId, 'photo');
                    }
                }
            }

            // ✅ 5. Save Business Documents
            if ($request->hasFile('business_documents')) {
                foreach ($request->file('business_documents') as $document) {
                    if ($document && $document->isValid()) {
                        $this->saveStartupImage($document, $startupId, $userId, 'document');
                    }
                }
            }

            // ✅ 6. Save Certification of Incorporation
            if ($request->hasFile('certification_incorporation')) {
                $this->saveStartupImage(
                    $request->file('certification_incorporation'),
                    $startupId,
                    $userId,
                    'certification'
                );
            }

            DB::commit();

            // ✅ Send Success Email
            $user = UserAccount::find($userId);
            if ($user) {
                try {
                    Mail::to($user->email)->send(new ProfileCreation([
                        $validated['name_of_entity'],
                        'Startup',
                        'Startup'
                    ]));
                } catch (\Exception $e) {
                    Log::warning("Startup profile email failed for {$user->email}: " . $e->getMessage());
                }
            }

            Log::info("Startup profile created successfully: {$validated['email']} (ID: {$startupId})");

            return redirect()
                ->route('register.create-startup-profile')
                ->with('success', 'Startup Profile created successfully! Your profile is awaiting admin review.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->errors());

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Startup profile creation failed: " . $e->getMessage() . "\n" . $e->getTraceAsString());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Save Startup Images and Documents
     */
    private function saveStartupImage($file, $startupId, $userId, $type = 'photo')
    {
        try {
            $fileName = time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $imagePath = config('constants.StartupImagePath', 'uploads/startups/');
            $fullPath = 'startups/' . date('Ym') . '/' . $fileName;

            $imageType = match (strtolower((string) $type)) {
                'photo', 'certification' => StartupImage::TYPE_IMAGE,
                'document' => StartupImage::TYPE_DOCUMENT,
                default => StartupImage::TYPE_IMAGE,
            };

            // Upload to storage (S3 or local)
            $storagePath = Storage::disk('public')->putFileAs(
                'startups/' . date('Ym'),
                $file,
                $fileName
            );

            StartupImage::create([
                'startup_id'       => $startupId,
                'type'             => $imageType,
                'startup_img_path' => $storagePath,
                'startup_img_name' => $file->getClientOriginalName(),
                'is_active'        => 1,
            ]);

            Log::info("Startup image saved: {$fileName} for startup {$startupId}");

        } catch (\Exception $e) {
            Log::error("Failed to save startup image: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Generate unique profile string
     */
    private function generateProfileString()
    {
        return 'STR_' . strtoupper(substr(md5(time() . rand()), 0, 12));
    }
}
