<?php

namespace Tests\Feature;

use Database\Seeders\SitePageContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(SitePageContentSeeder::class);
    }

    public function test_the_application_returns_a_successful_response(): void
    {
        $this->get('/')->assertStatus(200)->assertSee('Compassion in action. Hope in community.');
    }
}
