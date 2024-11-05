<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public function service()
    {
        return $this->hasOne(Service::class);
    }

    public function provider()
    {
        return $this->belongsTo(User::class);
    }
}
