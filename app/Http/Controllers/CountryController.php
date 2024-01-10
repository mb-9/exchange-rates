<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Currency;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
    public function view($id): View
    {
        $country = Country::findOrFail($id);
        
        $rates   = Currency::where('currency', $country->currencyCode)->get();

        return view('country.view', [
            'country'       => $country, 
            'rates'         => $rates 
        ]);
    }

    public function fetch() 
    {
        DB::beginTransaction();
        try {

            DB::table('countries')->truncate();

            $response = Http::get(Config::get('app.restCountriesUrl'), 
                ['fields' =>  'name,capital,currencies,population,timezones,flags']);

            $arrCountries = $response->json();

            foreach($arrCountries as $country)
            {
                
                $newCountry = new Country();
                $newCountry->fillAttributesFromApiResult($country);

                if(!$result = $newCountry->validate()){
                    Log::error(json_encode($result));
                    continue;
                }

                if(!$newCountry->save()){
                    Log::error("Could not save a country ".$country->officialName." to database");
                    continue;
                } 
            }

            DB::commit();
        } catch (\Exception $e){
            Log::error("Exception:". $e->getMessage());
            DB::rollback();
        }

    }
}
