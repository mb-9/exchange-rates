<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class CountryController extends Controller
{
    
    /**
     * Show all the countries
     */
    public function index(): View
    {
        return view('country.index', [
        ]);
    }

     /**
     * Show detail of a country
     */
    public function view(): View
    {
        return view('country.view', [
        ]);
    }

    public function fetch() 
    {

       
        $response = Http::get(Config::get('app.restCountriesUrl'), 
        ['fields' =>  'name,capital,currencies,population,timezones,flags,currencies']);

        dd($response->json());

    }
}
