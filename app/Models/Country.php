<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Country extends Model
{
    use HasFactory;


    public $validationRules = [
        'commonName'        => 'string',
        'officialName'      => 'required',
        'capital'           => 'string',
        'population'        => 'required|integer',
        'timezone'          => 'required',
        'flagUrl'           => 'required',
        'currencyCode'      => 'string',
        'currencySymbol'    => 'string',
    ];


    public $validationAttributes = [
        'commonName'        => 'Názov',
        'officialName'      => 'Oficiálny názov',
        'capital'           => 'Hlavné mesto',
        'population'        => 'Počet obyvateľov',
        'timezone'          => 'Časová zóna',
        'flagUrl'           => 'Vlajka',
        'currencyCode'      => 'Kód meny',
        'currencySymbol'    => 'Symbol meny',
    ];

    
    /**
     * Validates the model
     *
     * @return array array of error messages if the validation was not successful 
     * @return bool true if validation has been successful 
     */
    public function validate() : array|bool
    {

        $validator  = Validator::make($this->getAttributes(), $this->validationRules);
       
        if ($validator->fails()) {
            return $validator->messages()->jsonSerialize();
        }

        return true;
    }

    
    /**
     * Sets model attributes from the result of calling api
     *
     * @param  array $country
     * @return void
     */
    public function fillAttributesFromApiResult(array $country) : void 
    {

        $this->commonName     = $country['name']['common'] ?? NULL;
        $this->officialName   = $country['name']['official'] ?? NULL;
        $this->capital        = $country['capital'][0] ?? NULL;
        $this->population     = $country['population'] ?? NULL;
        $this->timezone       = $country['timezones'][0] ?? NULL;
        $this->flagUrl        = $country['flags']['png'] ?? NULL;
        
        if(isset($country['currencies']))
        {

            $arrKeys      = array_keys($country['currencies']);
            $currencyCode = $arrKeys[0] ?? NULL;
            
            $this->currencyCode   = $currencyCode;
            $this->currencySymbol = $country['currencies'][$currencyCode]['symbol'] ?? NULL;
        
        }

    }

    
  

}
