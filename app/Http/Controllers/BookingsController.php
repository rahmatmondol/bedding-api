<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Services;
use App\Models\Users;
use App\Models\bokkings;
use App\Http\Requests\StoreBookingsRequest;
use App\Http\Requests\UpdateBookingsRequest;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // send all booking by service id
       $serviceId = request()->query('service_id');
       $customerId = request()->query('customer_id');
       $status = request()->query('status');

       if (!$customerId && !$serviceId && !$status) {
           return ResponseHelper::error('bookings', 'Please provide customer id, service id and status', 404);
       }

       try {
           $query = Bookings::with(['service','bid:id,amount'])
           ->when($customerId, fn($q) => $q->where('customer_id', $customerId))
           ->when($serviceId, fn($q) => $q->where('service_id', $serviceId))
           ->when($status, fn($q) => $q->where('status', $status));
           $bookings = $query->get();

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
            // Create bokking
            $booking = new Bookings;

            // attach to service
            $booking->service()->associate($request->service_id);

            // attach to user
            $booking->provider()->associate($request->provider_id);

            // attach to user
            $booking->customer()->associate($request->customer_id);

            // attach to user
            $booking->bid()->associate($request->bid_id);

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
    public function update(UpdateBookingsRequest $request, Bookings $bookings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bookings $bookings)
    {
        //
    }
}
