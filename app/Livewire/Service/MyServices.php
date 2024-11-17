<?php

namespace App\Livewire\Service;

use Livewire\Component;
use App\Models\Service;
use App\Models\Category;

class MyServices extends Component
{


    public $services;
    public $categories;
    public function mount()
    {

        //get all services with pagination
        $this->categories = Category::all();
        $this->services = Service::where('user_id', auth()->user()->id)->paginate(8)->toArray();
        // dd($this->services);
    }
    public function render()
    {
        //check if user have role of customer then show not authorized
        if (!auth()->user()->hasRole('customer') && !auth()->user()->hasRole('admin')) {
            return abort(403, 'Unauthorized access.');
        }

        return view('livewire.service.my-services');
    }


    //filter services by category
    public function filter($category_id)
    {
        $this->services = Service::where('category_id', $category_id)->with('user')->paginate(8)->toArray();
    }
}
