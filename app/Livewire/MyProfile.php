<?php

namespace App\Livewire;

use Livewire\Component;
use App\Helpers\CountryHelper;
use App\Models\Categories;

class MyProfile extends Component
{

    public $countries;
    public $user;
    public $categories;

    public function mount()
    {
        $this->user = auth()->user()->load('profile');
        $this->countries = CountryHelper::getAllCountries();
        $this->categories = Categories::all();
    }

    public function render()
    {
        return view('livewire.my-profile');
    }
}
