<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Locations extends Model
{
    use HasFactory;
    protected $fullfillable = [
        'name',
        'latitude',
        'longitude',
    ];
}
