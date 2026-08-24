<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class BusinessProfileSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_business_profile_employee_and_entity_fields_are_stored_as_strings(): void
    {
        $this->assertTrue(in_array(Schema::getColumnType('profile_business', 'emp_count'), ['string', 'varchar'], true));
        $this->assertTrue(in_array(Schema::getColumnType('profile_business', 'entity_type'), ['string', 'varchar'], true));
        $this->assertTrue(in_array(Schema::getColumnType('profile_business', 'business_type'), ['string', 'varchar'], true));

        $response = $this->post('/registration/create-business-profile', [
            'user_id' => 1,
            'your_name' => 'RakeshBusinessProfile',
            'email' => 'rakeshBusiness@gmail.com',
            'mobile_no' => '9818502547',
            'designation' => 'CEO',
            'advertisement_headline' => 'this is first businessheadline',
            'introduction' => 'this is business profile Introduction',
            'company_name' => 'RakeshBusinessCompany',
            'establishment_year' => '2011',
            'employee_count' => '11-50',
            'entity_type' => 'partnership',
            'business_type' => 'b2c',
            'industry_sector' => 'education',
            'business_website' => 'https://businessex.com/',
            'facilities' => 'business profile Facilities',
            'address' => 'Hello Address',
            'city' => 'mathura',
            'state' => 'UP',
            'country' => 'India',
            'pin_code' => '281201',
            'one_line_pitch' => 'Sample Pitches: My company, Airto, is developing a web-based social seating check-in platform.',
            'annual_sales' => '3400000',
            'ebitda' => '120000',
            'gross_income' => '53452443',
            'inventory_value' => '87686',
            'ebitda_margin' => '14000',
            'rentals' => '50000',
            'company_summary_financial' => 'this is my business profile company summary',
            'director_name' => 'rakesh director',
            'director_email' => 'rakeshdirector@gmail.com',
            'director_designation' => 'coo',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('profile_business', [
            'seller_email' => 'rakeshBusiness@gmail.com',
            'emp_count' => '11-50',
            'entity_type' => 'partnership',
            'business_type' => 'b2c',
        ]);
    }
}
