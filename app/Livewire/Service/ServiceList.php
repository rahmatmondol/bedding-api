<?php

namespace App\Livewire\Service;

use Livewire\Component;
use App\Models\Services;
use App\Models\Categories;
class ServiceList extends Component
{
    public $services;
    public $categories;
    public $page = 'all';
    public $type = 'Service';

    public function mount()
    {   

        if (auth()->user()->hasRole('provider')) {
            if ($this->page == 'wishlist') {
                $wishlist_ids = auth()->user()->wishlists->pluck('service_id')->toArray();
                $this->services = Services::with(['images', 'customer'])
                ->whereIn('id', $wishlist_ids)
                ->orderByDesc('created_at')
                ->paginate(8)
                ->toArray();
            }elseif ($this->type == 'Auction') {
                $this->services = Services::with(['customer', 'images'])
                ->where('user_id', auth()->user()->id)
                ->whereIn('postType', [$this->type])
                ->orderByDesc('created_at')
                ->paginate(8)
                ->toArray();
            }else{
                $this->services = Services::with(['customer', 'images'])
                ->whereIn('postType', [$this->type])
                ->orderByDesc('created_at')
                ->paginate(8)
                ->toArray();
            }
        }else{
            $this->services = Services::with(['customer', 'images'])
            ->where('user_id', auth()->user()->id)
            ->whereIn('postType', [$this->type])
            ->orderByDesc('created_at')
            ->paginate(8)
            ->toArray();
        }

        // dd($this->services);
        $this->categories = Categories::all();
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
