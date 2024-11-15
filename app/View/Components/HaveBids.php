<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Bids;
class HaveBids extends Component
{

    public $serviceId;
    /**
     * Create a new component instance.
     */
    public function __construct($serviceId)
    {
        $this->serviceId = $serviceId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $bids = Bids::with('service')->where('service_id', $this->serviceId)->get();

        return view('components.have-bids', compact('bids'));
    }
}
