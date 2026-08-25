<?php

namespace Tests\Feature;

use App\Models\BusinessexContact;
use App\Models\BxCity;
use App\Models\IndPrefInvestor;
use App\Models\LocPrefInvestor;
use App\Models\ProfileInvestor;
use App\Models\ProfileMentor;
use App\Models\ProfileStartup;
use App\Models\UserAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use App\Mail\VerifyEmailMail;
use Tests\TestCase;

class ApplicationWorkflowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        if (!Schema::hasTable('testimonials')) {
            Schema::create('testimonials', function ($table): void {
                $table->id();
                $table->text('text');
                $table->string('name');
                $table->string('designation')->nullable();
                $table->timestamps();
            });
        }
    }

    public function test_all_public_listing_routes_accept_filter_search_and_sort_parameters(): void
    {
        $routes = [
            '/businesslisting?business_type=investor&location[]=1&industry[]=1&min=100&max=100000',
            '/investorlisting?state[]=Delhi&city[]=Delhi&sortby=desc&minInvestment=1000',
            '/mentorlisting?state[]=Delhi&city[]=Delhi&occupation[]=1&sortby=asc',
            '/startuplisting?business_type=investor&location[]=1&industry[]=1&min_investment=100&max_investment=100000',
        ];

        foreach ($routes as $route) {
            $this->get($route)->assertSuccessful();
        }
    }

    public function test_startup_listing_filters_by_sidebar_industry_and_location_ids(): void
    {
        $city = BxCity::create([
            'city' => 'Mumbai',
            'state' => 'MH',
        ]);

        ProfileStartup::create([
            'startup_profile_str' => 'startup-filter-test',
            'user_id' => 1,
            'startup_name' => 'Filtered Startup',
            'industry_sector' => 16,
            'ofc_city' => 'Mumbai',
            'ofc_state' => 'MH',
            'inv_asking_price' => '250000',
            'startup_profile_status' => 1,
        ]);

        $this->assertDatabaseHas('profile_startups', [
            'industry_sector' => 16,
            'ofc_city' => 'Mumbai',
            'ofc_state' => 'MH',
            'startup_profile_status' => 1,
        ]);
        $this->get('/startuplisting?business_type=all&min_investment=0&max_investment=1000000000&industry[]=16&location[]=' . $city->id)
            ->assertSuccessful()
            ->assertSee('Filtered Startup');
    }

    public function test_investor_listing_applies_all_sidebar_filters(): void
    {
        $investor = ProfileInvestor::create([
            'inv_profile_str' => 'investor-filter-test',
            'user_id' => 1,
            'inv_name' => 'Filtered Investor',
            'inv_type' => 1,
            'inv_city' => 'Delhi',
            'inv_state' => 'DL',
            'invest_size_min' => '100000',
            'invest_size_max' => '500000',
            'inv_profile_status' => 1,
        ]);

        IndPrefInvestor::create([
            'investor_profile_id' => $investor->investor_id,
            'user_id' => 1,
            'parent_category_id' => 1,
            'sub_category_id' => 16,
            'profile_status' => 1,
        ]);

        LocPrefInvestor::create([
            'investor_profile_id' => $investor->investor_id,
            'user_id' => 1,
            'place_id' => 'city-1',
            'location_name' => 'Mumbai, Maharashtra',
            'loc_state' => 'Maharashtra',
            'loc_country' => 'India',
            'loc_latitude' => '',
            'loc_longitude' => '',
            'profile_status' => 1,
        ]);

        $this->get('/investorlisting?investorType[]=1&city[]=Mumbai&industrysub[]=16&minInvestment=200000&maxInvestment=300000')
            ->assertSuccessful()
            ->assertSee('Filtered Investor');
    }

    public function test_mentor_listing_filters_by_sidebar_location_id(): void
    {
        $city = BxCity::create([
            'city' => 'Mumbai',
            'state' => 'MH',
        ]);

        ProfileMentor::create([
            'mentor_profile_str' => 'mentor-filter-test',
            'user_id' => 1,
            'mentor_name' => 'Filtered Mentor',
            'mentor_city' => 'Mumbai',
            'mentor_state' => 'MH',
            'mentor_profile_status' => 1,
        ]);

        $this->get('/mentorlisting?location[]=' . $city->id)
            ->assertSuccessful()
            ->assertSee('Filtered Mentor');
    }

    public function test_guest_listing_pages_render_login_modal_target_for_contact_actions(): void
    {
        $this->get('/businesslisting')->assertSee('data-target="#login"', false);
        $this->get('/investorlisting')->assertSee('data-target="#login"', false);
        $this->get('/mentorlisting')->assertSee('data-target="#login"', false);
        $this->get('/startuplisting')->assertSee('data-target="#login"', false);
    }

    public function test_profile_submission_endpoints_validate_required_fields(): void
    {
        $endpoints = [
            '/registration/create-business-profile',
            '/registration/create-investor-profile',
            '/registration/create-lender-profile',
            '/registration/create-mentor-profile',
            '/registration/create-startup-profile',
        ];

        foreach ($endpoints as $endpoint) {
            $this->from($endpoint)->post($endpoint, [])->assertRedirect($endpoint)->assertSessionHasErrors();
        }
    }

    public function test_contact_us_rejects_invalid_input(): void
    {
        $this->from('/contact-us')->post('/contact-us', [
            'contact_name' => '',
            'contact_email' => 'invalid-email',
            'contact_mobile' => '123',
            'contact_comment' => 'too short',
        ])->assertRedirect('/contact-us')->assertSessionHasErrors([
            'contact_name',
            'contact_email',
            'contact_mobile',
            'contact_comment',
        ]);
    }

    public function test_contact_us_saves_valid_input(): void
    {
        $payload = [
            'contact_name' => 'Test Visitor',
            'contact_email' => 'visitor@business.test',
            'contact_mobile' => '9876543210',
            'contact_comment' => 'This is a valid contact message.',
        ];

        $this->from('/contact-us')->post('/contact-us', $payload)
            ->assertRedirect('/contact-us')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('businessex_contactus', [
            'contact_email' => $payload['contact_email'],
            'contact_name' => $payload['contact_name'],
        ]);
    }

    public function test_contact_us_enforces_requested_field_formats_and_lengths(): void
    {
        $payload = [
            'contact_name' => 'Valid Visitor',
            'contact_email' => 'visitor@sample.com',
            'contact_mobile' => '1234567890',
            'contact_comment' => str_repeat('A', 255),
        ];

        $this->from('/contact-us')->post('/contact-us', $payload)
            ->assertRedirect('/contact-us')
            ->assertSessionHasErrors('contact_email');

        $payload['contact_email'] = 'visitor@business.test';
        $payload['contact_name'] = 'John';
        $payload['contact_mobile'] = '123456789';
        $payload['contact_comment'] = 'Too short';

        $this->from('/contact-us')->post('/contact-us', $payload)
            ->assertRedirect('/contact-us')
            ->assertSessionHasErrors(['contact_name', 'contact_mobile', 'contact_comment']);
    }

    public function test_newsletter_returns_json_validation_errors_for_ajax_requests(): void
    {
        $this->withHeaders(['X-Requested-With' => 'XMLHttpRequest'])->postJson('/newsLetterSubscribe', [
            'newsletter_name' => '',
            'newsletter_email' => 'bad-email',
            'newsletter_phone' => '123',
            'newsletter_city' => '',
        ])->assertStatus(422)->assertJsonValidationErrors([
            'newsletter_name',
            'newsletter_email',
            'newsletter_phone',
            'newsletter_city',
        ]);
    }

    public function test_newsletter_rejects_an_email_without_an_account(): void
    {
        $this->withHeaders(['X-Requested-With' => 'XMLHttpRequest'])->postJson('/newsLetterSubscribe', [
            'newsletter_name' => 'Visitor',
            'newsletter_email' => 'unknown@business.test',
            'newsletter_phone' => '9876543210',
            'newsletter_city' => 'Delhi',
        ])->assertStatus(404)->assertJson([
            'error' => 'User does not exist',
        ]);
    }

    public function test_newsletter_rejects_numeric_names_and_placeholder_email_domains(): void
    {
        foreach (['visitor@test.com', 'visitor@sample.com', 'visitor@example.com'] as $email) {
            $this->withHeaders(['X-Requested-With' => 'XMLHttpRequest'])->postJson('/newsLetterSubscribe', [
                'newsletter_name' => '12345',
                'newsletter_email' => $email,
                'newsletter_phone' => '9876543210',
                'newsletter_city' => 'Delhi',
            ])->assertStatus(422)->assertJsonValidationErrors(['newsletter_name', 'newsletter_email']);
        }
    }

    public function test_newsletter_subscribes_an_existing_user(): void
    {
        $user = UserAccount::create([
            'name' => 'Newsletter User',
            'email' => 'newsletter@business.test',
            'password' => Hash::make('secret123'),
            'company_name' => 'Newsletter Company',
            'user_rand_id' => 'newsletter-user',
            'is_active' => 1,
        ]);

        $this->withHeaders(['X-Requested-With' => 'XMLHttpRequest'])->postJson('/newsLetterSubscribe', [
            'newsletter_name' => 'Newsletter User',
            'newsletter_email' => $user->email,
            'newsletter_phone' => '9876543210',
            'newsletter_city' => 'Delhi',
        ])->assertOk()->assertJson([
            'success' => 'Subscribed successfully!',
        ]);

        $this->assertDatabaseHas('businessex_newsletter', [
            'user_id' => $user->user_id,
            'email' => $user->email,
            'status' => 'P',
        ]);
    }

    public function test_login_rejects_invalid_credentials(): void
    {
        UserAccount::create([
            'name' => 'Login User',
            'email' => 'login@business.test',
            'password' => Hash::make('correct-password'),
            'company_name' => 'Login Company',
            'user_rand_id' => 'login-user',
            'is_active' => 1,
        ]);

        $this->from('/login')->post('/login', [
            'email' => 'login@business.test',
            'password' => 'wrong-password',
        ])->assertRedirect('/login')->assertSessionHasErrors('login_email');

        $this->assertGuest();
    }

    public function test_login_accepts_valid_credentials_and_authenticates_user(): void
    {
        $user = UserAccount::create([
            'name' => 'Login User',
            'email' => 'valid-login@business.test',
            'password' => Hash::make('correct-password'),
            'company_name' => 'Login Company',
            'user_rand_id' => 'valid-login-user',
            'is_active' => 1,
        ]);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'correct-password',
        ])->assertRedirect('/dashboard/myaccount');

        $this->assertAuthenticatedAs($user);
    }

    public function test_quick_registration_validates_required_fields(): void
    {
        $this->from('/')->post('/quick-register', [])->assertRedirect('/')->assertSessionHasErrors([
            'profile',
            'name',
            'phone_number',
            'email',
        ]);
    }

    public function test_quick_registration_creates_user_and_sends_verification_mail(): void
    {
        Mail::fake();

        $this->from('/')->post('/quick-register', [
            'profile' => '1',
            'name' => 'Quick Register User',
            'phone_number' => '9876543210',
            'email' => 'quick-register@business.test',
            'company' => 'Quick Register Company',
        ])->assertRedirect('/')->assertSessionHas('success');

        $this->assertDatabaseHas('user_account', [
            'name' => 'Quick Register User',
            'email' => 'quick-register@business.test',
            'company_name' => 'Quick Register Company',
        ]);

        Mail::assertSent(VerifyEmailMail::class);
    }

    public function test_logout_clears_authenticated_session(): void
    {
        $user = UserAccount::create([
            'name' => 'Logout User',
            'email' => 'logout@business.test',
            'password' => Hash::make('secret123'),
            'company_name' => 'Logout Company',
            'user_rand_id' => 'logout-user',
            'is_active' => 1,
        ]);

        $this->actingAs($user)->post('/logout')->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_authenticated_users_can_open_profile_detail_routes(): void
    {
        $user = UserAccount::create([
            'name' => 'Test User',
            'email' => 'user@business.test',
            'password' => Hash::make('secret123'),
            'company_name' => 'Test Company',
            'user_rand_id' => 'test-user',
            'is_active' => 1,
        ]);

        $this->actingAs($user)->get('/businesslisting/1')->assertNotFound();
        $this->actingAs($user)->get('/investorlisting/1')->assertNotFound();
        $this->actingAs($user)->get('/mentorlisting/1')->assertNotFound();
        $this->actingAs($user)->get('/startuplisting/1')->assertNotFound();
    }
}
