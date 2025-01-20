<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use App\Http\Requests\StoreReviewsRequest;
use App\Http\Requests\UpdateReviewsRequest;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseHelper;
use App\Models\Bookings;

class ReviewsController extends Controller
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
    public function store(StoreReviewsRequest $request)
    {
        DB::beginTransaction();
        try {
            // check if booking is completed
            $booking = Bookings::find($request->booking_id);
            if($booking->status != 'completed'){
                return ResponseHelper::error('Error', 'Booking is not completed', 500);
            }
            
            // return ResponseHelper::success('Review created successfully', $booking);

            // Create reviews
            $reviews = new Reviews;
            $reviews->rating = $request->rating;
            $reviews->comment = $request->comment;
            $reviews->save();

            // attach to user
            $reviews->customer()->associate(auth()->user()->id);
            $reviews->service()->associate($booking->service_id);
            $reviews->provider()->associate($booking->provider_id);
            $reviews->save();

            DB::commit();
            return ResponseHelper::success('Review created successfully', $reviews, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseHelper::error('Error', 'Something went wrong:'.$e, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reviews $reviews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reviews $reviews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewsRequest $request, Reviews $reviews)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reviews $reviews)
    {
        //
    }
}
