<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Firebase extends Model
{
    protected $fillable = [
        'user_id',
        'firebase_token',
        'refresh_token',
        'firebase_uid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
