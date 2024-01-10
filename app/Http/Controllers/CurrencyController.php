<?php

namespace App\Http\Controllers;

use App\Models\Country;
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
                       
            $json = json_encode($xmlObject);
            $phpArray = json_decode($json, true); 
       
            dd($phpArray);

            DB::commit();
        } catch (\Exception $e){
            Log::error("Exception:". $e->getMessage());
            DB::rollback();
        }

    }
}
