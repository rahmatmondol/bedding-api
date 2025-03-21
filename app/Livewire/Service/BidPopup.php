<?php

namespace App\Livewire\Service;

use Livewire\Component;
use App\Models\bids;
use Illuminate\Support\Facades\Notification;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;
use App\Models\Services;
use App\Models\User;
use App\Notifications\BidPlaced;
use App\Services\FirebaseDatabase;

class BidPopup extends Component
{
    public $service;
    public $amount;
    public $message;    

    protected $firebaseDatabase;

    public function __construct()
    {
        $this->firebaseDatabase = app(FirebaseDatabase::class);
    }

    public function mount($service)
    {
        $this->service = $service;
        $this->amount = $service->price;
    }

    public function render()
    {
        return view('livewire.service.bid-popup');
    }

    public function submitBid()
    {
        // Check if the user already has a bid for the service
        if (auth()->user()->providerBids()->where('service_id', $this->service->id)->exists()) {
            session()->flash('error', 'You have already placed a bid for this service.');
            return $this->redirect('/service/'. $this->service->slug, navigate: true);
        }

        DB::beginTransaction();
        try {
            // Create bid
            $bid = new Bids();
            $bid->amount = $this->amount;
            $bid->message = $this->message ?? '';
            $bid->type = $this->service->postType;
            $bid->provider()->associate(auth()->user()->id); // Associate provider
            $bid->customer()->associate($this->service->user_id); // Associate customer
            $bid->service()->associate($this->service->id); // Associate service
            $bid->save();

            $firebaseDatabase = $this->firebaseDatabase->create('/notifications/user_' . $this->service->user_id, [
                'created_at' => now()->format('Y-m-d H:i:s'),
                'read_at' => false,
               'data' => [
                    'bid_id' => $bid->id,
                    'url' => '/auth/bid/list',
                    'avatar' => auth()->user()->profile->image,
                    'service_id' => $this->service->id,
                    'message' => auth()->user()->name . ' has placed a bid on your service.',
                    'details' => 'bid amount: ' . $bid->amount . ', bid message: '.$bid->message,
                ],
                'title' => 'You have a new bid',
            ]);
    
            // Commit the transaction
            DB::commit();
    
            // Send notification to customer
            $user = User::find($this->service->user_id);
            $user->notify(new BidPlaced($bid));

            // Flash success message and Livewire navigate
            session()->flash('success', 'Bid placed successfully.');
            return $this->redirect('/service/'. $this->service->slug, navigate: true);
    
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();
            // Flash error message and Livewire navigate
            session()->flash('error', 'Failed to place bid. Please try again.');
            $this->redirect('/service/'. $this->service->slug, navigate: true);
        }
    }
    
}
