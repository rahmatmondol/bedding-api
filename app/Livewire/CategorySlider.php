<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Categories;
class CategorySlider extends Component
{
    public $categories;
    public $name;
    public $limit = 10;
    public function mount()
    {
        $this->categories = Categories::limit($this->limit)->get();
    }
    public function render()
    {
        return view('livewire.category-slider');
    }
}
