<?php

namespace App\Livewire;

use Livewire\Component;

class BookingPopup extends Component
{
    public $bid;

    public function mount($bid)
    {
        $this->bid = $bid;
    }

    public function render()
    {
        return view('livewire.booking-popup');
    }
}
