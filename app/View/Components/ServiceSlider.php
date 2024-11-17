<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Services;

class ServiceSlider extends Component
{

    public $item;

    /**
     * Create a new component instance.
     */
    public function __construct($item)
    {
        $this->item = $item;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $services = Services::all()->take($this->item);
        return view('components.service-slider', compact('services'));
    }
}
