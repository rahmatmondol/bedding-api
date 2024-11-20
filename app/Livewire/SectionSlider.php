<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Services;

class SectionSlider extends Component
{
    public $item;
    public $name;
    public $services;
    public $category;

    public function mount()
    {
        // get all services with images
        if ($this->category) {
            $this->services = Services::with(['images', 'customer', 'customer.profile'])
                ->where('category_id', $this->category)
                ->orderBy('created_at', 'desc')
                ->limit($this->item)->get();
        } else {
            $this->services = Services::with(['images', 'customer', 'customer.profile'])
                ->orderBy('created_at', 'desc')
                ->limit($this->item)->get();
        }
    }

    public function render()
    {
        return view('livewire.section-slider');
    }
}
