<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject; // Add this import
class User extends Authenticatable implements JWTSubject
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

    public function getJWTIdentifier()
    {
        return $this->getKey(); // Typically the primary key (id)
    }

    /**
     * Get the custom claims for the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return []; // You can add custom claims if needed, like roles, permissions, etc.
    }

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

    public function providerBids()
    {
        return $this->hasMany(Bids::class, 'provider_id');
    }

    public function customerBids()
    {
        return $this->hasMany(Bids::class, 'customer_id');
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
