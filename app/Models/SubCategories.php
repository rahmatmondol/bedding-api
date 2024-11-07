<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class SubCategories extends Model
{
    use HasFactory;
    protected $fillable = [
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
