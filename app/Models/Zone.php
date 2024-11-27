<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $hidden = [
        'coordinates',
        'created_at',
        'updated_at'


    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
