<?php

namespace App\Livewire;

use Livewire\Component;

class ServiceCard extends Component
{
    public $service;
    public function render()
    {
        return view('livewire.service-card');
    }
}
