<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Services;
use App\Models\User;
use App\Models\bokkings;
use App\Http\Requests\StoreBookingsRequest;
use App\Http\Requests\UpdateBookingsRequest;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;
use App\Models\Bids;
use App\Notifications\BidAccept;
use App\Services\FirebaseDatabase;

class BookingsController extends Controller
{

    protected $firebaseDatabase;

    public function __construct(FirebaseDatabase $firebaseDatabase)
    {
        $this->firebaseDatabase = $firebaseDatabase;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // send all booking by service id
        $serviceId = request()->query('service_id');
        $status = request()->query('status');

        $providerId = auth()->user()->hasRole('provider') ? auth()->user()->id : null;
        $customerId = auth()->user()->hasRole('customer') ? auth()->user()->id : null;

        try {
            $bookings = Bookings::with(['service', 'service.images', 'service.skills', 'bid:id,amount'])
                ->when($customerId, function ($query) use ($customerId) {
                    return $query->where('customer_id', $customerId);
                })
                ->when($providerId, function ($query) use ($providerId) {
                    return $query->where('provider_id', $providerId);
                })
                ->when($serviceId, function ($query) use ($serviceId) {
                    return $query->where('service_id', $serviceId);
                })
                ->when($status, function ($query) use ($status) {
                    return $query->where('status', $status);
                })
                ->get();

            return ResponseHelper::success('bookings', $bookings);
        } catch (\Exception $e) {
            return ResponseHelper::error('bookings', $e->getMessage(), 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingsRequest $request)
    {

        DB::beginTransaction();

        try {
            // get provider info by bid id
            $bid = Bids::findOrFail($request->bid_id);

            // update bid status
            $bid->status = 'accepted';
            $bid->save();

            // Send notification to provider
            $provider = User::findOrFail($bid->provider_id);
            $provider->notify(new BidAccept($bid));

            // Create bokking
            $booking = new Bookings;

            // attach to service
            $booking->service()->associate($bid->service_id);

            // attach to user
            $booking->provider()->associate($bid->provider_id);

            // attach to user
            $booking->customer()->associate(auth()->user()->id);

            // attach to user
            $booking->bid()->associate($request->bid_id);

            $service = User::findOrFail($bid->service_id);


            $firebaseDatabase = $this->firebaseDatabase->create('/notifications/user_' . $bid->provider_id, [
                'created_at' => now()->format('Y-m-d H:i:s'),
                'read_at' => false,
                'data' => [
                    'bid_id' => $bid->id,
                    'url' => '/auth/booking/list',
                    'avatar' => auth()->user()->profile->image,
                    'service_id' => $bid->service_id,
                    'message' => '( '.$service->title .' ) is accepting your bid.',
                    'details' => '',
                ],
                'title' => 'Your bid has been accepted',
            ]);


            $booking->save();

            // If everything goes well, commit the transaction
            DB::commit();

            return ResponseHelper::success('Successfully booking placed', $booking);
        } catch (\Exception $e) {
            // If any error occurs, rollback the transaction
            DB::rollBack();

            return ResponseHelper::error('booking placed failed: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bookings $bookings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bookings $bookings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingsRequest $request, Bookings $booking)
    {
        DB::beginTransaction();
        try {
            $booking->status = $request->status;
            $booking->save();
            DB::commit();
            return ResponseHelper::success('Successfully booking placed', $booking);
        } catch (\Exception $e) {
            // If any error occurs, rollback the transaction
            DB::rollBack();
            return ResponseHelper::error('booking placed failed: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bookings $bookings)
    {
        //
    }
}
