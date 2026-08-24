<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_startup_profile_route_redirects_to_the_registration_form(): void
    {
        $response = $this->get('/registration/create-startup-profile');

        $response->assertStatus(200);
        $response->assertSee('Create your Start-up Profile');
    }
}
