<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Seller;
use App\Models\User;
use App\Models\UserAccount;
use App\Models\UserProfile;
use App\Models\ProfileBusiness;
use App\Models\BusinessImage;
use App\Models\ProfileBusinessMgmt;
use App\Models\IndustrySectorMentorBusiness;
use App\Models\IndustrySectorIncubatorBusiness;
use App\Mail\ProfileCreation;

class BusinessProfileController extends Controller
{

    public function createBusinessProfile()
    {
        return view('registration.create-business-profile');
    }

    public function storeBusinessProfile(Request $request)
    {
        $validated = $request->validate([
            'your_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:100'],
            'mobile_no' => ['required', 'string', 'max:20'],
            'designation' => ['required', 'string', 'max:255'],
            'advertisement_headline' => ['required', 'string', 'max:255'],
            'introduction' => ['required', 'string'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'establishment_year' => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
            'employee_count' => ['nullable', 'string', 'max:50'],
            'entity_type' => ['nullable', 'string', 'max:80'],
            'business_type' => ['nullable', 'string', 'max:80'],
            'industry_sector' => ['nullable', 'string', 'max:255'],
            'business_website' => ['nullable', 'url', 'max:255'],
            'facilities' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'pin_code' => ['nullable', 'string', 'max:20'],
            'one_line_pitch' => ['nullable', 'string', 'max:255'],
            'team_name' => ['nullable', 'array'],
            'team_name.*' => ['nullable', 'string', 'max:255'],
            'team_designation' => ['nullable', 'array'],
            'team_designation.*' => ['nullable', 'string', 'max:255'],
            'team_email' => ['nullable', 'array'],
            'team_email.*' => ['nullable', 'email', 'max:255'],
            'annual_sales' => ['nullable', 'numeric'],
            'inventory_value' => ['nullable', 'numeric'],
            'ebitda' => ['nullable', 'numeric'],
            'gross_income' => ['nullable', 'numeric'],
            'ebitda_margin' => ['nullable', 'numeric'],
            'rentals' => ['nullable', 'numeric'],
        ], [
            'your_name.required' => 'Your name is required.',
            'email.required' => 'Your email is required.',
            'mobile_no.required' => 'Your mobile number is required.',
            'advertisement_headline.required' => 'Advertisement headline is required.',
            'introduction.required' => 'Introduction is required.',
            'designation.required' => 'Designation is required.',
        ]);

        $sellerProfileStr = CommonController::profileUniqueStr();
        $userId = $request->input('user_id', Auth::id());

        if (!$userId) {
            $user = UserAccount::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'name' => $validated['your_name'],
                    'mobile' => $validated['mobile_no'],
                    'location' => $validated['city'] ?? 'India',
                    'company_name' => $validated['company_name'] ?? null,
                    'designation' => $validated['designation'],
                    'password' => bcrypt('BusinessEx@' . random_int(1000, 999999)),
                    'user_rand_id' => strtolower(Str::random(8)),
                    'reg_profile' => 'Business',
                    'is_active' => 1,
                ]
            );
            $userId = $user->user_id;
        }

        DB::beginTransaction();

        try {
            $sellerName = $request->input('your_name', $request->input('seller_name'));
            $sellerMobile = $request->input('mobile_no', $request->input('seller_mobile'));
            $sellerEmail = $request->input('email', $request->input('seller_email'));
            $sellerCompany = $request->input('company_name_confidential', $request->input('company_name'));
            $sellerDesignation = $request->input('seller_designation', $request->input('designation'));
            $employeeCount = $request->input('employee_count');
            $entityType = $request->input('entity_type');
            $businessType = $request->input('business_type');

            $seller = new ProfileBusiness([
                'business_profile_str' => $sellerProfileStr,
                'user_id' => $userId,
                'seller_name' => $sellerName,
                'seller_mobile' => $sellerMobile,
                'seller_email' => $sellerEmail,
                'seller_designation' => $sellerDesignation,
                'advmt_headline' => $request->input('advertisement_headline'),
                'seller_intro' => $request->input('introduction'),
                'seller_company' => $sellerCompany,
                'estb_year' => $request->input('establishment_year'),
                'emp_count' => is_string($employeeCount) ? trim($employeeCount) : $employeeCount,
                'entity_type' => is_string($entityType) ? trim($entityType) : $entityType,
                'business_type' => is_string($businessType) ? trim($businessType) : $businessType,
                'industry_sector' => $request->input('industry_sector'),
                'business_website' => $request->input('business_website'),
                'facilities_desc' => $request->input('facilities'),
                'annual_sales' => $request->input('annual_sales'),
                'ebitda' => $request->input('ebitda'),
                'gross_profit' => $request->input('gross_income'),
                'inventory_value' => $request->input('inventory_value'),
                'ebitda_margin' => $request->input('ebitda_margin'),
                'rentals' => $request->input('rentals'),
                'company_summary' => $request->input('company_summary_financial'),
                'director_name' => $request->input('director_name'),
                'director_email' => $request->input('director_email'),
                'director_designation' => $request->input('director_designation'),
                'ofc_address' => $request->input('address'),
                'ofc_city' => trim((string) $request->input('city', $request->input('ofc_city')), '"'),
                'ofc_state' => trim((string) $request->input('state', $request->input('ofc_state')), '"'),
                'ofc_country' => trim((string) $request->input('country', $request->input('ofc_country')), '"') ?: 'India',
                'ofc_pincode' => $request->input('pin_code'),
                'business_pitch' => $request->input('one_line_pitch'),
                'seeking_investors' => $request->input('seeking_investors'),
                'seeking_buyers' => $request->input('seeking_buyers'),
                'seeking_loan' => $request->input('seeking_loan'),
                'seeking_mentors' => $request->input('seeking_mentors'),
                'seeking_accelerators' => $request->input('seeking_accelerators'),
                'inv_asking_price' => $request->input('inv_asking_price'),
                'inv_stake' => $request->input('inv_stake'),
                'inv_reason' => $request->input('inv_reason'),
                'buyer_sell_price' => $request->input('buyer_sell_price'),
                'buyer_sell_reason' => $request->input('buyer_sell_reason'),
                'loan_amount' => $request->input('loan_amount'),
                'loan_repayment_period' => $request->input('loan_repayment_period'),
                'loan_interest_rate' => $request->input('loan_interest_rate'),
                'loan_reason' => $request->input('loan_reason'),
                'loan_existing' => $request->input('loan_existing'),
                'loan_collateral_details' => $request->input('loan_collateral_details'),
                'mentor_req_details' => $request->input('mentor_req_details'),
                'accel_req_details' => $request->input('accel_req_details'),
                'accel_inv_req' => $request->input('accel_inv_req'),
                'accel_time_period' => $request->input('accel_time_period'),
                'trackid' => $request->input('trackid'),
                'utm_source' => $request->input('utm_source'),
                'utm_medium' => $request->input('utm_medium'),
                'utm_campaign' => $request->input('utm_campaign'),
                'business_profile_status' => config('constants.ProfileStatus.Awaiting'),
            ]);

            $seller->save();
            $lastInsertId = $seller->business_id;

            $teamNames = $request->input('team_name', []);
            $teamDesignations = $request->input('team_designation', []);
            $teamEmails = $request->input('team_email', []);

            foreach ((array) $teamNames as $index => $teamName) {
                $memberName = trim((string) $teamName);
                if ($memberName === '') {
                    continue;
                }

                ProfileBusinessMgmt::create([
                    'business_profile_id' => $lastInsertId,
                    'user_id' => $userId,
                    'mgmt_name' => $memberName,
                    'mgmt_designation' => trim((string) ($teamDesignations[$index] ?? '')) ?: null,
                    'mgmt_email' => trim((string) ($teamEmails[$index] ?? '')) ?: null,
                ]);
            }

            if ($request->hasFile('seller_prof_pic')) {
                foreach ($request->file('seller_prof_pic') as $businessImage) {
                    $imgExt = $businessImage->getClientOriginalExtension();
                    $imgProfilePath = sprintf(config('constants.BusinessProfileImagePath'), date('Ym'), random_int(100, 99999) . '_' . time(), $imgExt);
                    $businessImagePath = CommonController::imageUploadPost($imgProfilePath, $businessImage);
                    BusinessImage::create([
                        'business_id' => $lastInsertId,
                        'type' => BusinessImage::TYPE_IMAGE,
                        'business_img_path' => $businessImagePath,
                    ]);
                }
            }

            if ($request->hasFile('seller_doc_path')) {
                foreach ($request->file('seller_doc_path') as $businessDocument) {
                    $docExt = $businessDocument->getClientOriginalExtension();
                    $busDocPath = sprintf(config('constants.BusinessProfileDocPath'), date('Ym'), random_int(100, 99999) . '_' . time(), $docExt);
                    $businessDocPath = CommonController::imageUploadPost($busDocPath, $businessDocument);
                    BusinessImage::create([
                        'business_id' => $lastInsertId,
                        'type' => BusinessImage::TYPE_DOCUMENT,
                        'business_img_path' => $businessDocPath,
                    ]);
                }
            }

            UserProfile::create([
                'user_id' => $userId,
                'profile_id' => $lastInsertId,
                'profile_type' => config('constants.profileTypes.Business'),
                'profile_str' => $sellerProfileStr,
                'profile_status' => config('constants.ProfileStatus.Awaiting'),
            ]);

            DB::commit();

            $user = UserAccount::find($userId);
            try {
                if ($user && !empty($user->email)) {
                    $MailData = [$sellerName, 'Business', 'Seller'];
                    Mail::to($user->email)->send(new ProfileCreation($MailData));
                }
            } catch (\Exception $e) {
                Log::alert('Profile creation mail failed for ' . ($user->email ?? 'unknown') . ' -- ' . $e->getMessage());
            }

            Log::info('Seller registration successful : ' . $sellerEmail);

            return redirect()->back()->with('success', 'Business Profile Registration Successful. Please check your email for confirmation.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Seller Registration Failed : ' . $e->getMessage());

            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
