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

        /*$response = Http::get(Config::get('app.restCountriesUrl'), 
            ['fields' =>  'name,capital,currencies,population,timezones,flags']);
        $arrCountries = $response->json();*/

        $dummyData = '[{"flags":{"png":"https://flagcdn.com/w320/sk.png","svg":"https://flagcdn.com/sk.svg","alt":"The flag of Slovakia is composed of three equal horizontal bands of white, blue and red. The coat of arms of Slovakia is superimposed at the center of the field slightly towards the hoist side."},"name":{"common":"Slovakia","official":"Slovak Republic","nativeName":{"slk":{"official":"Slovenská republika","common":"Slovensko"}}},"currencies":{"EUR":{"name":"Euro","symbol":"€"}},"capital":["Bratislava"],"population":5458827,"timezones":["UTC+01:00"]}]';
        $arrCountries = json_decode($dummyData,true);

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

            //dd($newCountry->getAttributes());
            dd($newCountry->validate());


            if(!$newCountry->save()){
                //TODO: log this
            }
            
        }

    }
}
