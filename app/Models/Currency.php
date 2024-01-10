<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;

    public $validationRules = [
        'currency'  => 'required|string',
        'rate'      => 'required|integer',
    ];


    /**
     * Returns decimal 
     */
    public function rateDecimal(){
        return $this->rate/100000;
    } 

    public function rateFormatted(){
        return rtrim($this->rate, '0');
    }

    /**
     * Validates the model
     *
     * @return array array of error messages if the validation was not successful 
     * @return bool true if validation has been successful 
     */
    public function validate() : array|bool{

        $validator  = Validator::make($this->getAttributes(), $this->validationRules);
       
        if ($validator->fails()) {
            return $validator->messages()->jsonSerialize();
        }

        return true;

    }

    
}
