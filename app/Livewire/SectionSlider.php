<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Services;

class SectionSlider extends Component
{
    public $item;
    public $name;
    public $services;

    public function mount()
    {
        // get all services with images
        $this->services = Services::with(['images', 'customer', 'customer.profile'])
        ->orderBy('created_at', 'desc')
        ->limit($this->item)->get();
    }

    public function render()
    {
        return view('livewire.section-slider');
    }
}
