<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
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
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasOne(Reviews::class);
    }

    public function payments()
    {
        return $this->hasOne(Payments::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function images()
    {
        return $this->hasMany(Images::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function skills()
    {
        return $this->hasMany(Skills::class);
    }

    public function bids()
    {
        return $this->hasMany(Bids::class);
    }

}
