<?php

namespace Tests\Feature;

use Database\Seeders\SitePageContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FlutterwaveDonationTest extends TestCase
{
    use RefreshDatabase;

    private const LINK = 'https://flutterwave.com/pay/qrslug-993880-0zxql4pisalb';

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(SitePageContentSeeder::class);
        config(['services.flutterwave.pay_link' => self::LINK]);
    }

    public function test_donate_page_links_to_the_flutterwave_payment_page_safely(): void
    {
        $this->get(route('donate'))
            ->assertOk()
            ->assertSee('Give online in minutes')
            ->assertSee('href="'.self::LINK.'" target="_blank" rel="noopener noreferrer"', false);
    }

    public function test_get_involved_shows_the_donation_card_and_keeps_the_pledge_form(): void
    {
        $this->get(route('get-involved'))
            ->assertOk()
            ->assertSee(self::LINK, false)
            ->assertSee('id="donation-pledge"', false)
            ->assertSee(route('donate.submit'))
            ->assertDontSee('[ADD VERIFIED');
    }

    public function test_navigation_home_and_footer_point_to_the_donate_page(): void
    {
        $this->get(route('home'))->assertOk()->assertSee('href="'.route('donate').'"', false)->assertSee('Donate Now');
    }

    public function test_page_falls_back_to_the_pledge_form_when_no_link_is_configured(): void
    {
        config(['services.flutterwave.pay_link' => null]);

        $this->get(route('donate'))
            ->assertOk()
            ->assertDontSee('flutterwave.com/pay', false)
            ->assertSee('Record a donation pledge');
    }
}
