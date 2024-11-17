<?php

namespace App\Livewire\Service;

use Livewire\Component;
use App\Models\Services;
use App\Models\Categories;
class ServiceList extends Component
{
    public $services;
    public $categories;

    public function mount()
    {

        //get all services with pagination
        if (auth()->user()->hasRole('customer')) {
            $this->services = Services::with(['customer', 'images'])->where('user_id', auth()->user()->id)->paginate(8)->toArray();
        } else {
            $this->services = Services::with(['customer', 'images'])->paginate(8)->toArray();
        }
        $this->categories = Categories::all();

        // dd($this->services);
    }
    public function render()
    {
        return view('livewire.service.service-list');
    }

    //filter services by category
    public function filter($category_id)
    {
        $this->services = Services::with(['customer', 'images'])->where('category_id', $category_id)->paginate(8)->toArray();
    }
}
