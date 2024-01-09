<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Enigma\ValidatorTrait;


class Country extends Model
{
    use ValidatorTrait;
    use HasFactory;

     /**
     * Boot method.
     */
    public static function boot()
    {
        parent::boot();
        static::validateOnSaving();
    }

  

}
