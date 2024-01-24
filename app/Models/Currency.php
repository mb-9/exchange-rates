<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string currency
 * @propert
 */
class Currency extends Model
{
    use HasFactory;

    public array $validationRules = [
        'currency'  => 'required|string',
        'rate'      => 'required|numeric',
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
     * @return array|bool array of error messages if the validation was not successful, true if model is valid
     */
    public function validate() : array|bool{

        $validator  = Validator::make($this->getAttributes(), $this->validationRules);
        if ($validator->fails()) {
            return $validator->messages()->jsonSerialize();
        }

        return true;

    }


}
