<?php

namespace App\Livewire;

use App\Models\Country;
use Livewire\Component;

class Countries extends Component
{
    public $countries;

    public function render()
    {
        $this->countries = Country::all();
        return view('livewire.countries');
    }
}
