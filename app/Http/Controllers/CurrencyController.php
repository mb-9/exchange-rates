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

class CurrencyController extends Controller
{
    

    public function fetch() 
    {

        DB::beginTransaction();
        try {

            $xmlString = file_get_contents(Config::get('app.referenceRatesUrl'));
            $xmlObject = simplexml_load_string($xmlString);
                       
            $json     = json_encode($xmlObject);
            $phpArray = json_decode($json, true); 

            $arrElements = $phpArray['Cube']['Cube']['Cube'] ?? [];
            $date        = $phpArray['Cube']['Cube']['@attributes']['time'] ?? [];

            foreach($arrElements as $num => $currencyElement){
                
                $newCurrency = new Currency();
                $newCurrency->currency = $currencyElement['@attributes']['currency'] ?? NULL;
                $newCurrency->rate     = (int) 100000 * $currencyElement['@attributes']['rate'] ?? NULL;
                $newCurrency->date     = $date;
                
             
                if(!$result = $newCurrency->validate()){
                    Log::error(json_encode($result));
                    continue;
                }

                if(!$newCurrency->save()){
                    Log::error("Could not save the currency ".$newCurrency->currency." to database");
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
