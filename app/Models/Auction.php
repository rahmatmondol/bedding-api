<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    /** @use HasFactory<\Database\Factories\AuctionFactory> */
    use HasFactory;
    
    protected $fillable = [
        'title', 
        'slug',
        'description',
        'price',
        'priceType',
        'currency',
        'status',
        'level',
        'deadline', 
        'is_featured', 
        'commission',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function review()
    {
        return $this->hasOne(Reviews::class);
    }

    public function payment()
    {
        return $this->hasOne(Payments::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }


    public function subcategory()
    {
        return $this->belongsTo(Subcategories::class);
    }

    public function images()
    {
        return $this->hasMany(Images::class, 'service_id');
    }

    public function location()
    {
        return $this->belongsTo(Locations::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skills::class , 'services_skills', 'service_id', 'skill_id');
    }

    public function bids()
    {
        return $this->hasMany(Bids::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
}
