<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bids extends Model
{
    protected $fillable = [
        'status', 
        'amount',
        'message',
    ];

    public function provider()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Services::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class);
    }
}

