<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Services;

class reletedServceSlider extends Component
{
    /**
     * Create a new component instance.
     */

     public $categoryId;

    public function __construct($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $services = Services::with(['customer', 'images', 'category'])->where('category_id', $this->categoryId)->get();
        return view('components.releted-servce-slider', compact('services'));
    }
}
