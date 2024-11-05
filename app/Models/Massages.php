<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Massages extends Model
{
    use HasFactory;

    protected $fillable = [
        'massage',
        'status',
    ];

    /**
     * An accessor to retrieve the sender of the message.
     *
     * @return \App\Models\User
     */
    protected function sender(): Attribute
    {
        // This accessor makes it easier to retrieve the sender of the message.
        // It retrieves the user with the given user_id.
        // It uses the `Attribute::make` method to create an accessor
        // for the `sender` attribute.
        // The `get` method is a closure that will be executed
        // when the `sender` attribute is accessed.
        // The closure takes no arguments and returns an instance of the `User` model.
        return Attribute::make(
            get: fn () => User::findOrFail($this->user_id)
        );
    }

    protected function receiver(): Attribute
    {
        return Attribute::make(
            get: fn () => User::findOrFail($this->receiver_id)
        );
    }
}

