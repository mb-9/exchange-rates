<?php

namespace App\Livewire;

use Livewire\Component;

class Country extends Component
{

    public $country;

    public function render()
    {
        $this->country = Country::all();
        return view('livewire.country');
    }
}
