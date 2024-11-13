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
        //
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
