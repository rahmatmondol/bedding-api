<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fullfillable = [
        'name',
        'description',
        'slug',
        'status',
    ];

    public function subCategories()
    {
        return $this->hasMany(SubCategories::class);
    }

    public function services()
    {
        return $this->hasMany(Services::class);
    }
}
