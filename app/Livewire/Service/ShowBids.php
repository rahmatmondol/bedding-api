<?php

namespace App\Livewire\Service;

use Livewire\Component;
use App\Models\Bids;

class ShowBids extends Component
{
    public $service_id;

    public function mount($service_id)
    {
        $this->service_id = $service_id;
    }

    public function render()
    {
        $bids = Bids::where('service_id', $this->service_id)->with('provider')->get();

        return view('livewire.service.show-bids', compact('bids'));
    }
}
