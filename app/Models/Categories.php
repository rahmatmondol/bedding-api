<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'status',
    ];

    public function subCategories()
    {
        return $this->hasMany(SubCategories::class , 'category_id');
    }

    public function services()
    {
        return $this->hasMany(Services::class);
    }

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

}
