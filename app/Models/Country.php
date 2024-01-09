<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;


class Country extends Model
{
    use HasFactory;


    public $validationRules = [
        'commonName'        => '',
        'officialName'      => 'required',
        'capital'           => '',
        'population'        => 'required|integer',
        'timezone'          => 'required',
        'flagUrl'           => 'required',
        'currencyCode'      => '',
        'currencySymbol'    => '',
    ];

    /*public $validationMessages = [
        'name.required' => 'Name field is required.',
    ];*/

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

    public function validate(){

        $validator  = Validator::make($this->getAttributes(), $this->validationRules);
       
        if ($validator->fails()) {
            return $validator->messages();
        }

        return true;

    }
  

}
