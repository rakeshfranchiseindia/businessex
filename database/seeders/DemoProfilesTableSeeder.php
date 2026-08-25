<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DemoProfilesTableSeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            ['city' => 'Mumbai', 'state' => 'MH'],
            ['city' => 'New Delhi', 'state' => 'DL'],
            ['city' => 'Bengaluru', 'state' => 'KA'],
            ['city' => 'Chennai', 'state' => 'TN'],
            ['city' => 'Hyderabad', 'state' => 'TS'],
            ['city' => 'Pune', 'state' => 'MH'],
            ['city' => 'Kolkata', 'state' => 'WB'],
            ['city' => 'Jaipur', 'state' => 'RJ'],
            ['city' => 'Ahmedabad', 'state' => 'GJ'],
            ['city' => 'Lucknow', 'state' => 'UP'],
        ];

        foreach (range(1, 10) as $number) {
            $userId = $this->upsertUser($number, $cities[$number - 1]);
            $this->upsertBusiness($number, $userId, $cities[$number - 1]);
            $this->upsertStartup($number, $userId, $cities[$number - 1]);
            $this->upsertInvestor($number, $userId, $cities[$number - 1]);
            $this->upsertMentor($number, $userId, $cities[$number - 1]);
        }

        $this->command?->info('Seeded 10 business, 10 startup, 10 investor, and 10 mentor profiles.');
    }

    private function upsertUser(int $number, array $location): int
    {
        $email = "demo.user{$number}@businessex.test";
        DB::table('user_account')->updateOrInsert(
            ['email' => $email],
            [
                'name' => "Demo User {$number}",
                'company_name' => "Demo Company {$number}",
                'mobile' => '900000'.str_pad((string) $number, 4, '0', STR_PAD_LEFT),
                'location' => $location['city'],
                'password' => Hash::make('DemoPassword!2026'),
                'user_rand_id' => "demo-user-{$number}",
                'is_active' => 1,
                'reg_source' => 1,
                'updated_at' => now(),
            ]
        );

        return (int) DB::table('user_account')->where('email', $email)->value('user_id');
    }

    private function upsertBusiness(int $number, int $userId, array $location): void
    {
        DB::table('profile_business')->updateOrInsert(
            ['business_profile_str' => "demo-business-{$number}"],
            [
                'user_id' => $userId, 'seller_name' => "Business Owner {$number}",
                'seller_email' => "demo.business{$number}@businessex.test", 'seller_mobile' => '900000'.str_pad((string) $number, 4, '0', STR_PAD_LEFT),
                'seller_company' => "Demo Business {$number}", 'advmt_headline' => "Growing Business Opportunity {$number}",
                'seller_intro' => 'A verified demo business opportunity for local development and testing.',
                'industry_sector' => (string) (15 + $number), 'business_type' => '1', 'entity_type' => '1',
                'ofc_city' => $location['city'], 'ofc_state' => $location['state'], 'ofc_country' => 'India',
                'annual_sales' => 1000000, 'buyer_sell_price' => 5000000, 'seeking_buyers' => 1,
                'seeking_investors' => 1, 'business_profile_status' => 1, 'membership_paid' => 1, 'membership_plan' => 1,
                'activated_at' => now(), 'last_login_at' => now(), 'updated_at' => now(), 'created_at' => now(),
            ]
        );
    }

    private function upsertStartup(int $number, int $userId, array $location): void
    {
        DB::table('profile_startups')->updateOrInsert(
            ['startup_profile_str' => "demo-startup-{$number}"],
            [
                'user_id' => $userId, 'startup_name' => "Startup Founder {$number}",
                'startup_email' => "demo.startup{$number}@businessex.test", 'startup_mobile' => '900000'.str_pad((string) $number, 4, '0', STR_PAD_LEFT),
                'name_of_entity' => "Demo Startup {$number}", 'advmt_headline' => "High Growth Startup {$number}",
                'startup_intro' => 'An innovative demo startup profile for local development and testing.',
                'industry_sector' => 15 + $number, 'ofc_city' => $location['city'], 'ofc_state' => $location['state'], 'ofc_country' => 'India',
                'annual_sales' => '1000000', 'inv_asking_price' => '2500000', 'seeking_investors' => 1,
                'seeking_mentorship' => 1, 'startup_profile_status' => 1, 'membership_paid' => 1, 'membership_plan' => 1,
                'activated_at' => now(), 'last_login_at' => now(), 'updated_at' => now(), 'created_at' => now(),
            ]
        );
    }

    private function upsertInvestor(int $number, int $userId, array $location): void
    {
        DB::table('profile_investor')->updateOrInsert(
            ['inv_profile_str' => "demo-investor-{$number}"],
            [
                'user_id' => $userId, 'inv_name' => "Investor {$number}", 'inv_email' => "demo.investor{$number}@businessex.test",
                'inv_mobile' => '900000'.str_pad((string) $number, 4, '0', STR_PAD_LEFT), 'inv_city' => $location['city'],
                'inv_state' => $location['state'], 'inv_country' => 'India', 'inv_headline' => "Strategic Investor {$number}",
                'inv_abt_urself' => 'An experienced demo investor profile for local development and testing.',
                'invest_size_min' => 1000000, 'invest_size_max' => 10000000, 'inv_profile_status' => 1,
                'membership_paid' => 1, 'membership_plan' => 1, 'reg_source' => 1,
                'activated_at' => now(), 'last_login_at' => now(), 'updated_at' => now(), 'created_at' => now(),
            ]
        );
    }

    private function upsertMentor(int $number, int $userId, array $location): void
    {
        DB::table('profile_mentors')->updateOrInsert(
            ['mentor_profile_str' => "demo-mentor-{$number}"],
            [
                'user_id' => $userId, 'mentor_name' => "Mentor {$number}", 'mentor_email' => "demo.mentor{$number}@businessex.test",
                'mentor_mobile' => '900000'.str_pad((string) $number, 4, '0', STR_PAD_LEFT), 'mentor_city' => $location['city'],
                'mentor_state' => $location['state'], 'mentor_country' => 'India', 'mentor_adv_headline' => "World Class Mentor {$number}",
                'mentor_profile_summary' => 'An experienced demo mentor profile for local development and testing.',
                'mentor_profile_status' => 1, 'membership_paid' => 1, 'membership_plan' => 1,
                'activated_at' => now(), 'last_login_at' => now(), 'updated_at' => now(), 'created_at' => now(),
            ]
        );
    }
}
