<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Bids as BidList;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Notifications\BidAccept;
use App\Models\Bookings;
use App\Models\Services;

class Bids extends Component
{

    public $pending;
    public $accepted;
    public $rejected;

    public function mount()
    {
        $providerId = auth()->user()->hasRole('provider') ? auth()->user()->id : null;
        $customerId = auth()->user()->hasRole('customer') ? auth()->user()->id : null;

        $bids = BidList::with(['provider','provider.profile', 'service:id,price'])
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

        DB::beginTransaction();
        try {
            $bid = BidList::find($id);
            $bid->status = 'accepted';
            $bid->save();

            // create booking
            $booking = new Bookings;
            $booking->save();

            $booking->bid()->associate($bid->id);
            $booking->provider()->associate($bid->provider_id);
            $booking->customer()->associate($bid->customer_id);
            $booking->service()->associate($bid->service_id);
            $booking->save();

            // update service status
            $service = Services::find($bid->service_id);
            $service->status = 'Inactive';
            $service->save();
            
            // Send notification to customer
            $provider = User::find($bid->provider_id);
            $provider->notify(new BidAccept($booking));

            DB::commit();
            
            session()->flash('success', 'Bid accepted successfully.');
            return $this->redirect('/auth/bid/list', navigate: true);
    
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();
            // Flash error message and Livewire navigate
            session()->flash('error', 'Failed to place bid. Please try again.');
            $this->redirect('/service/'. $this->service->slug, navigate: true);
        }

       
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