<?php

namespace App\Http\Controllers;

use App\Models\Bids;
use App\Http\Requests\StoreBidsRequest;
use App\Http\Requests\UpdateBidsRequest;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;
use App\Models\Services;
use App\Notifications\BidPlaced;
use App\Models\User;
use App\Services\FirebaseDatabase;

class BidsController extends Controller
{

    public $review_rating;
    public $comment;
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
        // send all bids by service id
        $serviceId = request()->query('service_id');
        $status = request()->query('status');

        $providerId = auth()->user()->hasRole('provider') ? auth()->user()->id : null;
        $customerId = auth()->user()->hasRole('customer') ? auth()->user()->id : null;

        try {
            $query = Bids::when($providerId, fn($q) => $q->where('provider_id', $providerId)
                ->with('service:id,title,skills', 'customer', 'customer.profile'))
                ->where('type', 'Service')
                ->when($serviceId, fn($q) => $q->where('service_id', $serviceId)
                    ->with(['provider', 'provider.profile', 'service:id,title,skills']))
                ->when($customerId, fn($q) => $q->where('customer_id', $customerId)
                    ->with(['provider', 'provider.profile', 'service:id,title,skills']))
                ->when($status, fn($q) => $q->where('status', $status));
            $bids = $query->get();

            return ResponseHelper::success('Bids', $bids);
        } catch (\Exception $e) {
            return ResponseHelper::error('Bids', $e->getMessage(), 404);
        }
    }

    //get my auction bids
    public function myAuctionBids()
    {
        // send all bids by service id
        $serviceId = request()->query('service_id');
        $status = request()->query('status');

        $providerId = auth()->user()->hasRole('provider') ? auth()->user()->id : null;
        $customerId = auth()->user()->hasRole('customer') ? auth()->user()->id : null;

        try {
            $query = Bids::when($providerId, fn($q) => $q->where('provider_id', $providerId)
                ->with('service:id,title,skills', 'customer', 'customer.profile'))
                ->where('type', 'Auction')
                ->when($serviceId, fn($q) => $q->where('service_id', $serviceId)
                    ->with(['provider', 'provider.profile', 'service:id,title,skills']))
                ->when($customerId, fn($q) => $q->where('customer_id', $customerId)
                    ->with(['provider', 'provider.profile', 'service:id,title,skills']))
                ->when($status, fn($q) => $q->where('status', $status));
            $bids = $query->get();

            return ResponseHelper::success('Bids', $bids);
        } catch (\Exception $e) {
            return ResponseHelper::error('Bids', $e->getMessage(), 404);
        }
    }

    public function auctionBids()
    {
        try {
            $bids = Bids::with(['provider', 'provider.profile', 'service', 'customer', 'customer.profile'])
                ->where('type', 'Auction')
                ->whereHas('service', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })
                ->orderByDesc('created_at')
                ->get();

            return ResponseHelper::success('Bids', $bids);
        } catch (\Exception $e) {
            return ResponseHelper::error('Bids', $e->getMessage(), 404);
        }
    }


    public function list()
    {
        return view('user.bid.list');
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
            $information = Bids::with(['provider', 'provider.profile', 'provider.reviews', 'service'])->findOrFail($bidId);

            return ResponseHelper::success('Bid information', $information);
        } catch (\Exception $e) {
            return ResponseHelper::error('Error retrieving bids', 'Internal server error', 500);
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

            $service = Services::find($request->service_id);

            // Create bid
            $bid = new Bids;
            $bid->amount = $request->amount;
            $bid->message = $request->message ?? '';
            $bid->type = $service->postType;
            $bid->save();

            // // Send notification to customer
            // $user = User::find($service->user_id);
            // $user->notify(new BidPlaced($bid));

            $firebaseDatabase = $this->firebaseDatabase->create('/notifications/user_' . $service->user_id, [
                'created_at' => now()->format('Y-m-d H:i:s'),
                'read_at' => false,
                'data' => [
                    'bid_id' => $bid->id,
                    'url' => '/auth/bid/list',
                    'avatar' => auth()->user()->profile->image,
                    'service_id' => $service->id,
                    'message' => auth()->user()->name . ' has placed a bid on your service.',
                    'details' => 'bid amount: ' . $bid->amount . ', bid message: ' . $bid->message,
                ],
                'title' => 'You have a new bid',
            ]);

            $bid->provider()->associate(auth()->user()->id);
            $bid->save();

            // attach to customer
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



    public function auctionStore(StoreBidsRequest $request)
    {
        DB::beginTransaction();
        try {

            $provider = auth()->user()->hasRole('provider') ? auth()->user()->id : null;
            $customer = auth()->user()->hasRole('customer') ? auth()->user()->id : null;

            if ($provider) {
                // Check if the user already has a bid for the service
                if (auth()->user()->providerBids()->where('service_id', $request->service_id)->exists()) {
                    return ResponseHelper::error('Error placing bid', 'You already have a bid for this Auction', 422);
                }
            }

            if ($customer) {
                // Check if the user already has a bid for the service
                if (auth()->user()->customerBids()->where('service_id', $request->service_id)->exists()) {
                    return ResponseHelper::error('Error placing bid', 'You already have a bid for this Auction', 422);
                }
            }


            $service = Services::find($request->service_id);
            // check if self bid

            if (auth()->user()->id == $service->user_id) {
                return ResponseHelper::error('Error placing bid', 'You cannot bid on your own service', 422);
            }

            // Create bid
            $bid = new Bids;
            $bid->amount = $request->amount;
            $bid->message = $request->message ?? '';
            $bid->type = $service->postType;
            $bid->provider_id = $provider;
            $bid->customer_id = $customer;
            $bid->service_id = $request->service_id;
            $bid->save();

            $firebaseDatabase = $this->firebaseDatabase->create('/notifications/user_' . $service->user_id, [
                'created_at' => now()->format('Y-m-d H:i:s'),
                'read_at' => false,
                'data' => [
                    'bid_id' => $bid->id,
                    'url' => '/auth/bid/list',
                    'avatar' => auth()->user()->profile->image,
                    'service_id' => $service->id,
                    'message' => auth()->user()->name . ' has placed a bid on your service.',
                    'details' => 'bid amount: ' . $bid->amount . ', bid message: ' . $bid->message,
                ],
                'title' => 'You have a new bid',
            ]);

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
            // Check if the user already has a bid for the service
            if (auth()->user()->providerBids()->where('service_id', $request->service_id)->exists()) {
                return ResponseHelper::error('You already have a bid for this service', 422);
            }

            $service = Services::find($request->service_id);
            // Create bid
            $bid = new Bids;
            $bid->amount = $request->amount;
            $bid->message = $request->message ?? '';
            $bid->type = $service->postType;
            $bid->save();

            $bid->provider()->associate(auth()->user()->id);
            $bid->save();

            // attach to customer
            $bid->customer()->associate($service->user_id);
            $bid->save();

            // attach to service
            $bid->service()->associate($request->service_id);
            $bid->save();

            $firebaseDatabase = $this->firebaseDatabase->create('/notifications/user_' . $service->user_id, [
                'created_at' => now()->format('Y-m-d H:i:s'),
                'read_at' => false,
                'data' => [
                    'bid_id' => $bid->id,
                    'url' => '/auth/bid/list',
                    'avatar' => auth()->user()->profile->image,
                    'service_id' => $service->id,
                    'message' => auth()->user()->name . ' has placed a bid on your service.',
                    'details' => 'bid amount: ' . $bid->amount . ', bid message: ' . $bid->message,
                ],
                'title' => 'You have a new bid',
            ]);


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
        $bid = $bids->with(['provider', 'provider.profile', 'provider.reviews', 'service'])->findOrFail($bids->id);
        return ResponseHelper::success('Bid information', $bid);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bids $bids)
    {
        $bid = $bids->load(['provider', 'service']);
        return view('bids.edit', compact('bid'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBidsRequest $request, Bids $bids)
    {
        $bid = $bids->findOrFail($bids->id);
        $bid->amount = $request->amount;
        $bid->message = $request->message;

        if ($bid->save()) {
            return ResponseHelper::success('Bid updated successfully', $bid);
        }

        return ResponseHelper::error('Error updating bid', 'Something went wrong', 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bids $bids)
    {
        try {
            $bids->delete();
            return ResponseHelper::success('Bid deleted successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('Error deleting bid', 'Something went wrong', 500);
        }
    }
}
