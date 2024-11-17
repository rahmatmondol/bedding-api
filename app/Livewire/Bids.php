<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Bids as BidList;

class Bids extends Component
{

    public $pending;
    public $accepted;
    public $rejected;

    public function mount()
    {
        $providerId = auth()->user()->hasRole('provider') ? auth()->user()->id : null;
        $customerId = auth()->user()->hasRole('customer') ? auth()->user()->id : null;

        $bids = BidList::with(['provider','provider.profile'])
        ->when($providerId, fn($q) => $q->where('provider_id', $providerId))
        ->when($customerId, fn($q) => $q->where('customer_id', $customerId))
        ->get();

        $this->pending = $bids->where('status', 'pending')->values();
        $this->accepted = $bids->where('status', 'accepted')->values();
        $this->rejected = $bids->where('status', 'rejected')->values();
    }

    public function render()
    {
        return view('livewire.bids');
    }

    public function acceptbid($id)
    {
        $bid = BidList::find($id);
        $bid->status = 'accepted';
        $bid->save();

        // Send notification to customer
        // $user = User::find($this->service->user_id);
        // $user->notify(new BidPlaced($bid));

        session()->flash('success', 'Bid accepted successfully.');
        return $this->redirect('/auth/bid/list', navigate: true);
    }

    public function rejectbid($id)
    {
        $bid = BidList::find($id);
        $bid->status = 'rejected';
        $bid->save();

        // Send notification to customer
        // $user = User::find($this->service->user_id);
        // $user->notify(new BidPlaced($bid));

        session()->flash('success', 'Bid rejected successfully.');
        return $this->redirect('/auth/bid/list', navigate: true);
    }
}
