<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    protected $fullfillable = [
        'name',
        'description',
        'slug',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function services()
    {
        return $this->hasMany(Services::class);
    }
}
