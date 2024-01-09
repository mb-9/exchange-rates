<?php

namespace App\Http\Controllers;

use App\Models\Country;
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
       
        //TODO: delete data 

        $response = Http::get(Config::get('app.restCountriesUrl'), 
            ['fields' =>  'name,capital,currencies,population,timezones,flags']);
        $arrCountries = $response->json();

  
        foreach($arrCountries as $country)
        {

            $newCountry = new Country();

            $newCountry->commonName     = $country['name']['common'] ?? NULL;
            $newCountry->officialName   = $country['name']['official'] ?? NULL;
            $newCountry->capital        = $country['capital'][0] ?? NULL;
            $newCountry->population     = $country['population'] ?? NULL;
            $newCountry->timezone       = $country['timezones'][0] ?? NULL;
            $newCountry->flagUrl        = $country['flags']['png'] ?? NULL;
            
            if(isset($country['currencies']))
            {

                $arrKeys      = array_keys($country['currencies']);
                $currencyCode = $arrKeys[0] ?? NULL;
                
                $newCountry->currencyCode = $currencyCode;
                $newCountry->currencySymbol = $country['currencies'][$currencyCode]['symbol'] ?? NULL;
            
            }

            //TODO: validation 
            $newCountry->validate();

            if(!$newCountry->save()){
                //TODO: log this
            }
            
        }

    }
}
