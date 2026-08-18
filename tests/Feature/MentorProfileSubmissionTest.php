<?php

namespace Tests\Feature;

use App\Models\UserAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MentorProfileSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_mentor_profile_can_be_submitted_and_saved(): void
    {
        UserAccount::create([
            'name' => 'Test Mentor',
            'email' => 'mentor@example.com',
            'password' => Hash::make('secret123'),
            'mobile' => '9999999999',
            'location' => 'Delhi',
            'reg_profile' => 'Mentor',
        ]);

        $response = $this->post('/registration/create-mentor-profile', [
            'user_id' => 1,
            'mentor_name' => 'John Doe',
            'mentor_mobile' => '9999999999',
            'mentor_email' => 'mentor@example.com',
            'mentor_location' => 'Delhi',
            'mentor_city' => 'Delhi',
            'mentor_state' => 'Delhi',
            'mentor_country' => 'India',
            'mentor_adv_headline' => 'Helping startups scale',
            'mentor_intro' => 'I help founders with GTM strategy.',
            'mentor_occupation' => 'Corporate Professional',
            'mentor_company' => 'Acme Business',
            'mentor_designation' => 'Director',
            'mentor_profile_summary' => 'Experienced leader with 10 years in SaaS.',
            'mentor_linkedin' => 'https://linkedin.com/in/johndoe',
            'experience_years' => ['8'],
            'sector_expertise' => ['1'],
            'mentor_subject_expertise' => '1',
            'mentor_sector_preference' => '1',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('profile_mentors', [
            'mentor_name' => 'John Doe',
            'mentor_email' => 'mentor@example.com',
        ]);
    }
}
