<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Bookings as BookingList;
use App\Notifications\BookingCompleted;
use App\Notifications\Review;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Reviews;

class Bookings extends Component
{

    public $bookings;
    public $accepted;
    public $completed;
    public $rating;
    public $comment;
    public $reviews;

    public function mount()
    {
        $providerId = auth()->user()->hasRole('provider') ? auth()->user()->id : null;
        $customerId = auth()->user()->hasRole('customer') ? auth()->user()->id : null;

        $bookings = BookingList::with(['service','service.skills', 'service.images', 'provider', 'provider.profile', 'service.category', 'bid:id,amount'])
        ->when($providerId, fn($q) => $q->where('provider_id', $providerId))
        ->when($customerId, fn($q) => $q->where('customer_id', $customerId))
        ->orderByDesc('created_at')
        ->get();

        $this->reviews = Reviews::where('customer_id', auth()->user()->id)->get();
        $this->bookings = $bookings;
        $this->accepted = $bookings->where('status', 'accepted')->values();
        $this->completed = $bookings->where('status', 'completed')->values();
    }

    public function render()
    {
        return view('livewire.bookings');
    }

    /**
     * Update booking status to 'completed' and send notification to customer.
     *
     * @param int $id The booking ID to be updated.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptbooking($id)
    {
       

        DB::beginTransaction();
        try {
            $booking = BookingList::find($id);
            $booking->status = 'completed';
            $booking->save();

            // Send notification to customer
            $provider = User::find($booking->provider_id);
            $provider->notify(new BookingCompleted($booking));

            DB::commit();

            // Flash success message and Livewire navigate
            session()->flash('success', 'Booking Completed successfully.');
            return $this->redirect('/auth/booking/list', navigate: true);
            
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();
            // Flash error message and Livewire navigate
            session()->flash('error', 'Failed to accept booking: ' . $e->getMessage());
            return $this->redirect('/auth/booking/list', navigate: true);
        }
    }

    /**
     * write a review
     *
     * @param int $id The booking ID to be updated.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function makereview($id)
    {
    
        DB::beginTransaction();
        try {
            $booking = BookingList::find($id);

            $review = new Reviews;
            $review->rating = $this->rating ?? 0;
            $review->comment = $this->comment ?? ' ';
            $review->customer_id = $booking->customer_id;
            $review->provider_id = $booking->provider_id;
            $review->service_id = $booking->service_id;
            $review->save();

            // Send notification to customer
            $booking->provider->notify(new Review($booking));

            DB::commit();

            // Flash success message and Livewire navigate
            session()->flash('success', 'Review submitted successfully.');
            return $this->redirect('/auth/booking/list', navigate: true);
            
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();
            // Flash error message and Livewire navigate
            session()->flash('error', 'Failed to review: ' . $e->getMessage());
            return $this->redirect('/auth/booking/list', navigate: true);
        }
    }
}
