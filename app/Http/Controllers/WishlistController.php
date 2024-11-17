<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Http\Requests\StoreWishlistRequest;
use App\Http\Requests\UpdateWishlistRequest;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseHelper;
use App\Models\Bids;
use App\Models\Services;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $providerId = auth()->user()->id;
        try {
            $wishlists = Wishlist::with(['service','service.customer','service.images','service.skills'])->where('provider_id', $providerId)->get();

            return ResponseHelper::success('Wishlists', $wishlists);
        } catch (\Exception $e) {
            return ResponseHelper::error('error', $e->getMessage(), 404);
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
    public function store(StoreWishlistRequest $request)
    {
        DB::beginTransaction();
        try {
            // Create wishlist
            $wishlist = new Wishlist;
            $wishlist->service()->associate($request->service_id);
            $wishlist->provider()->associate(auth()->user()->id);
            $wishlist->save();

            DB::commit();
            return ResponseHelper::success('Added to wishlist', $wishlist);
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseHelper::error('Error', 'Something went wrong:'.$e, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWishlistRequest $request, Wishlist $wishlist)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist)
    {
        try {
            $wishlist->delete();
            return ResponseHelper::success('Deleted from wishlist', $wishlist);
        } catch (\Exception $e) {
            return ResponseHelper::error('Error', 'Something went wrong:'.$e, 500);
        }
    }
}
