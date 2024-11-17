<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Services;

class ServiceSlider extends Component
{
    public $services;
    public $item = 10;
    
    public function render()
    {
        return view('livewire.service-slider');
    }

    public function mount()
    {
        // get all services with images
        $this->services = Services::with('images')->limit($this->item)->get();
    }
}
