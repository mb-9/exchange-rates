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
       
        $response = Http::get(Config::get('app.restCountriesUrl'), 
            ['fields' =>  'name,capital,currencies,population,timezones,flags']);
        $arrCountries = $response->json();

        foreach($arrCountries as $country)
        {

            $newCountry = new Country();

            if(isset($country['name']['common']))
                $newCountry->commonName = $country['name']['common'];

            if(isset($country['name']['official']))
                $newCountry->officialName = $country['name']['official'];

            if(isset($country['capital'][0]))
                $newCountry->capital = $country['capital'][0];
            
            if(isset($country['population']))
                $newCountry->population = $country['population'];

            if(isset($country['timezones'][0]))
                $newCountry->timezone = $country['timezones'][0];

            if(isset($country['flags']['png']))
                $newCountry->flagUrl = $country['flags']['png'];
            
            if(isset($country['currencies']))
            {

                $currencyCode   = NULL;
                $arrKeys        = array_keys($country['currencies']);
                
                if(isset($arrKeys[0]))
                    $currencyCode = $arrKeys[0];
                
                $newCountry->currencyCode = $currencyCode;

                if(isset($country['currencies'][$currencyCode]['symbol']))
                    $newCountry->currencySymbol = $country['currencies'][$currencyCode]['symbol'];
            
            }

            //TODO: validation 


            if(!$newCountry->save()){
                //TODO: log this
            }
            
        }

    }
}
