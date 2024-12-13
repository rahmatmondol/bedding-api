<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;

class StoreBookingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (auth()->user()->hasRole('customer') || auth()->user()->hasRole('admin')) {
            return true;
        }

        return false;
    }

    // show error message
    public function failedAuthorization()
    {
        return response()->json(['error' => 'You are not authorized bookings.'], 403);
    }
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bid_id' => 'required|exists:bids,id|unique:bookings,bid_id',
        ];
    }
}
