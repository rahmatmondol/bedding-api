<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Skills extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'description',
    ];

    public function services()
    {
        return $this->belongsToMany(Services::class, 'services_skills', 'skill_id', 'service_id');
    }
}
