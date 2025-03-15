<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServicesRequest extends FormRequest
{
    // show error message
    public function failedAuthorization()
    {
        return response()->json(['error' => 'You are not authorized to create an auction.'], 403);
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = auth()->user();

        // Check if the postType is Auction and the user has the provider role
        if ($this->input('postType') === 'Auction' && $user->hasRole('provider')) {
            return true;
        }

        // Allow if the user is a customer or admin
        if ($user->hasRole('customer') || $user->hasRole('admin')) {
            return true;
        }

        return false;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:services',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'priceType' => 'required|in:Negotiable,Fixed',
            'currency' => 'required|in:AED,USD',
            'level' => 'in:Entry,Intermediate,Expert',
            'category_id' => 'required|integer|exists:categories,id',
            'subCategory_id' => 'required|integer|exists:sub_categories,id',
            'images' => 'required|max:2048',
            // 'location_name' => 'required|string',
            // 'latitude' => 'required',
            // 'longitude' => 'required',
            // 'skills' => 'required|json',
            'postType' => 'required|in:Auction,Service', // Add postType validation
        ];
    }
}
