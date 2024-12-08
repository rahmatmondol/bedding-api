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
    public $providerId;
    public $customerId;
    public $rejected;
    public $type = 'Service';


    public function mount()
    {
        $this->providerId = auth()->user()->hasRole('provider') ? auth()->user()->id : null;
        $this->customerId = auth()->user()->hasRole('customer') ? auth()->user()->id : null;

        if($this->type == 'Service'){
            $this->serviceBid(); 
        }else{
            $this->auctionBid();
        }
        
    }

    public function render()
    {
        return view('livewire.bids');
    }

    private function serviceBid(){

        $bids = BidList::with(['provider','provider.profile', 'service:id,price'])
        ->where('type', $this->type)
        ->when($this->providerId, fn($q) => $q->where('provider_id', $this->providerId))
        ->when($this->customerId, fn($q) => $q->where('customer_id', $this->customerId))
        ->orderByDesc('created_at')
        ->get();
      
        $this->pending = $bids->where('status', 'pending')->values();
        $this->accepted = $bids->where('status', 'accepted')->values();
        $this->rejected = $bids->where('status', 'rejected')->values();
    }

    private function auctionBid(){
       
        $bids = BidList::with(['provider','provider.profile', 'service','customer', 'customer.profile'])
        ->where('type', $this->type)
        ->whereHas('service', function($query){
            $query->where('user_id', auth()->user()->id);
        })
        ->orderByDesc('created_at')
        ->get();

        // dd($bids);
      
        $this->pending = $bids->where('status', 'pending')->values();
        $this->accepted = $bids->where('status', 'accepted')->values();
        $this->rejected = $bids->where('status', 'rejected')->values();
    }

    public function acceptbid($id)
    {

        DB::beginTransaction();
        try {
            $bid = BidList::find($id);
            $bid->status = 'accepted';
            $bid->save();

            if($bid->type == 'Service'){
                // create booking
                $booking = new Bookings;
                $booking->save();

                $booking->bid()->associate($bid->id);
                $booking->provider()->associate($bid->provider_id);
                $booking->customer()->associate($bid->customer_id);
                $booking->service()->associate($bid->service_id);
                $booking->save();

                // Send notification to customer
                $provider = User::find($bid->provider_id);
                $provider->notify(new BidAccept($booking));
            }
            
            // update service status
            $service = Services::find($bid->service_id);
            $service->status = 'Inactive';
            $service->save();
            
            DB::commit();

            if($bid->type == 'Auction'){

                // Send notification to customer
                $provider = User::find($bid->provider_id);
                $provider->notify(new BidAccept($bid));

                session()->flash('success', 'Bid accepted successfully.');
                return $this->redirect('/auth/bid/auction-list', navigate: true);
            }
            
            session()->flash('success', 'Bid accepted successfully.');
            return $this->redirect('/auth/bid/list', navigate: true);
    
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();

            if($bid->type == 'Auction'){
                session()->flash('error', 'Failed to place bid:'. $e->getMessage());
                return $this->redirect('/auth/bid/auction-list', navigate: true);
            }
            // Flash error message and Livewire navigate
            session()->flash('error', 'Failed to place bid:'. $e->getMessage());
            return $this->redirect('/auth/bid/list', navigate: true);
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
