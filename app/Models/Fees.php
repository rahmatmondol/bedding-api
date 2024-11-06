<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Fees extends Model
{
    use HasFactory;
    protected $fullfillable = [
        'name',
        'description',
        'amount',
        'currency',
        'status',
    ];
    
}
