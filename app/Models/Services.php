<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Services extends Model
{
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
        return $this->hasMany(Images::class, 'service_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skills::class , 'services_skills', 'service_id', 'skill_id');
    }

    public function bids()
    {
        return $this->hasMany(Bids::class);
    }

}
