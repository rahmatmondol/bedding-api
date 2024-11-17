<?php

namespace App\Livewire\Service;

use App\Models\Services;
use App\Models\Wishlist;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ServiceDetails extends Component
{
    public $slug;
    public $hasWishlist;
    public $wishlistCount = 0;
    public $service;

    public function getListeners()
    {
        return [
            'updatedService' => 'mount',
        ];
    }

    public function mount()
    {
        $this->slug = request()->route('slug');
        $service = Services::where('slug', $this->slug)->firstOrFail()->load('category', 'images');
        $this->wishlistCount = Wishlist::where('service_id', $service->id)->count();
        $this->hasWishlist = $this->checkIfServiceIsInWishlist($service);

        $this->service = $service;
    }

    public function render()
    {
        return view('livewire.service.service-details');
    }

    /**
     * Toggle a service in the wishlist of the currently authenticated user.
     *
     * @return void
     */
    public function toggleWishlist()
    {
        if ($this->hasWishlist) {
            Wishlist::where('service_id', $this->service->id)
                ->where('provider_id', Auth::id())
                ->first()
                ->delete();
            session()->flash('success', 'Removed from wishlist');
            return $this->redirect('/service/'. $this->service->slug, navigate: true);
        } else {
            $wishlist = new Wishlist;
            $wishlist->service()->associate($this->service->id);
            $wishlist->provider()->associate(Auth::id());
            $wishlist->save();
        }

        session()->flash('success', 'Added to wishlist');
        return $this->redirect('/service/'. $this->service->slug, navigate: true);
    }

    private function checkIfServiceIsInWishlist(Services $service): bool
    {
        return Wishlist::where('service_id', $service->id)
            ->where('provider_id', Auth::id())
            ->exists();
    }
}

