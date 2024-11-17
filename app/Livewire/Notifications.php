<?php

namespace App\Livewire;

use Livewire\Component;
use App\Notifications\NewBidPlacedNotification;

class Notifications extends Component
{
    public function render()
    {
        $notifications = auth()->user()->notifications;
        return view('livewire.notifications', compact('notifications'));
    }
}

