<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function bids()
    {
        return $this->hasMany(Bids::class);
    }

    public function payments()
    {
        return $this->hasMany(Payments::class);
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }

    public function skills()
    {
        return $this->hasMany(Skills::class);
    }

    public function services()
    {
        return $this->hasMany(Services::class);
    }

    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
