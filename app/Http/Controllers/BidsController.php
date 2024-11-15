<?php

namespace App\Http\Controllers;

use App\Models\Bids;
use App\Http\Requests\StoreBidsRequest;
use App\Http\Requests\UpdateBidsRequest;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;
use App\Models\Services;


class BidsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // send all bids by service id
        $serviceId = request()->query('service_id');
        $status = request()->query('status');

        $providerId = auth()->user()->hasRole('provider') ? auth()->user()->id : null;
        $customerId = auth()->user()->hasRole('customer') ? auth()->user()->id : null;

        try {
            $query = Bids::when($providerId, fn($q) => $q->where('provider_id', $providerId))
            ->when($serviceId, fn($q) => $q->where('service_id', $serviceId))
            ->when($customerId, fn($q) => $q->where('customer_id', $customerId)
            ->with(['provider', 'provider.profile']))
            ->when($status, fn($q) => $q->where('status', $status));
            $bids = $query->get();

            return ResponseHelper::success('Bids', $bids);
        } catch (\Exception $e) {
            return ResponseHelper::error('Bids', $e->getMessage(), 404);
        }
    }

        /**
     * Display a listing of the resource.
     */
    public function info()
    {
        // Retrieve query parameters
        $bidId = request()->query('bid_id');

        try {
            //get provider info by bid id
            $information = Bids::with(
                [
                    'provider' => function ($query) {
                    $query->with(['reviews', 'profile']);
                }, 
                'service'
            ])->findOrFail($bidId);
    
            return ResponseHelper::success('Bid information', $information);
        } catch (\Exception $e) {
            return ResponseHelper::error('Error retrieving bids', 'An error occurred while retrieving bids. Please try again later.', 500);
        }
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBidsRequest $request)
    {
        DB::beginTransaction();
        try {
            // Check if the user already has a bid for the service
            if (auth()->user()->providerBids()->where('service_id', $request->service_id)->exists()) {
                return ResponseHelper::error('Error placing bid', 'You already have a bid for this service', 422);
            }

            // Create bid
            $bid = new Bids;
            $bid->amount = $request->amount;
            $bid->message = $request->message ?? '';
            $bid->save();

            $bid->provider()->associate(auth()->user()->id);
            $bid->save();

            // attach to customer
            $service = Services::find($request->service_id);
            $bid->customer()->associate($service->user_id);
            $bid->save();

            // attach to service
            $bid->service()->associate($request->service_id);
            $bid->save();
           

            // If everything goes well, commit the transaction
            DB::commit();

            return ResponseHelper::success('Successfully bid placed', $bid);
        } catch (\Exception $e) {
            // If any error occurs, rollback the transaction
            DB::rollBack();

            return ResponseHelper::error('bid placed failed: ' . $e->getMessage(), 500);
        }
    }

       /**
     * Store a newly created resource in storage.
     */
    public function localstore(StoreBidsRequest $request)
    {
        DB::beginTransaction();

        try {
            if (auth()->user()->providerBids()->where('service_id', $request->service_id)->exists()) {
                return ResponseHelper::error('Error placing bid', 'You already have a bid for this service', 422);
            }

            // Create bid
            $bid = new Bids;
            $bid->amount = $request->amount;
            $bid->message = $request->message ?? '';
            $bid->save();

            // attach to service
            $bid->service()->associate($request->service);
            $bid->save();

            // attach to user
            $bid->provider()->associate($request->provider);
            $bid->save();

            // attach to user
            $bid->customer()->associate($request->customer);
            $bid->save();

            // If everything goes well, commit the transaction
            DB::commit();

            return ResponseHelper::success('Successfully bid placed', $bid);
        } catch (\Exception $e) {
            // If any error occurs, rollback the transaction
            DB::rollBack();

            return ResponseHelper::error('bid placed failed: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bids $bids)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bids $bids)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBidsRequest $request, Bids $bids)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bids $bids)
    {
        //
    }
}
