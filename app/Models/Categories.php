<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Categories extends Model
{
    use HasFactory;

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
