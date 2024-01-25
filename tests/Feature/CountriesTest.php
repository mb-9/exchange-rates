<?php

namespace Tests\Feature;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CountriesTest extends TestCase
{

    use RefreshDatabase;

    public function test_homepage_contains_list_of_countries(): void
    {
        $response = $this->get('/');
        $response->assertSee("List of countries");
        $response->assertStatus(200);
    }

    public function test_homepage_contains_non_empty_list_of_countries(): void
    {
        $newCountry = new Country();
        $newCountry->commonName     = "Vogoshpere";
        $newCountry->officialName   = "Planet of Vogosphere";
        $newCountry->capital        = "Vogoyork";
        $newCountry->population     = "54866";
        $newCountry->timezone       = "-";
        $newCountry->flagUrl        = "-";
        $newCountry->currencyCode   = "VOG";
        $newCountry->currencySymbol = "v~";
        $newCountry->save();

        $response = $this->get('/');
        $response->assertSee("Vogoshpere");
        $response->assertStatus(200);
    }

}
