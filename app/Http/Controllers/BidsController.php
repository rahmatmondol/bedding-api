<?php

namespace App\Http\Controllers;

use App\Models\Bids;
use App\Http\Requests\StoreBidsRequest;
use App\Http\Requests\UpdateBidsRequest;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;

class BidsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // send all bids by service id
        $providerId = request()->query('provider');
        $serviceId = request()->query('service');
        $customerId = request()->query('customer');
        $status = request()->query('status');

        if (!$providerId && !$customerId) {
            return ResponseHelper::error('Bids', 'Please provide a provider id or customer id', 404);
        }

        if (!$providerId && !$serviceId && !$status) {
            return ResponseHelper::error('Bids', 'Please provide a provider id, service id or status', 404);
        }

        try {
            $query = Bids::when($providerId, fn($q) => $q->where('provider_id', $providerId))
            ->when($serviceId, fn($q) => $q->where('service_id', $serviceId))
            ->when($customerId, fn($q) => $q->where('customer_id', $customerId))
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
        $bidId = request()->query('bid');
        $serviceId = request()->query('service');
        $customerId = request()->query('customer');
    
        // Check if at least one parameter is provided
        if (!$bidId && !$serviceId && !$customerId) {
            return ResponseHelper::error('Invalid data', 'Please provide at least one of the following: customer id, service id, or bid id', 400);
        }
    
        try {
            // Build the query with conditions and eager load relationships
            $query = Bids::when($bidId, fn($q) => $q->where('id', $bidId))
                ->when($serviceId, fn($q) => $q->where('service_id', $serviceId))
                ->when($customerId, fn($q) => $q->where('customer_id', $customerId))
                ->with([
                    'provider' => function ($query) {
                        $query->with([
                            'reviews',
                            'profile',
                        ]);
                    },
                    'service:id,price',
                ]);
                // ->select('id', 'amount', 'message');
            $bids = $query->get();
    
            return ResponseHelper::success('Bids retrieved successfully', $bids);
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
        // dd($request->all());
        try {
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
