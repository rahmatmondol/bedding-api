<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    protected $fullfillable = [
        'name',
        'description',
        'amount',
        'currency',
        'status',
    ];
    
}
