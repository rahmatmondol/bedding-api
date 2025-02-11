<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServicesRequest extends FormRequest
{
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
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'priceType' => 'required|in:Negotiable,Fixed',
            'currency' => 'in:AED,USD',
            // 'level' => 'required|in:Entry,Intermediate,Expert',
            // 'skills_ids' => 'required',
            'category_id' => 'required|integer',
            'subCategory_id' => 'required|integer',
            'images' => 'required|max:2048',
            'location_name' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
        ];
    }
}
