<?php

namespace App\Livewire;
use App\Models\Services;
use Livewire\Component;

class ReletedServicesSlider extends Component
{
    public $categoryId;
    public function mount($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function render()
    {
        $services = Services::where('category_id', $this->categoryId)->get();
        return view('livewire.releted-services-slider', compact('services'));
    }

}

