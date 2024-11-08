<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServicesRequest extends FormRequest
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
            'priceType' => 'required|in:Nagotiation,Fixed',
            'currency' => 'in:AED,USD',
            'level' => 'required|in:Entry,Intermediate,Expert',
            'skills_ids' => 'required',
            'category_id' => 'required|integer',
            'subCategory_id' => 'required|integer',
            // 'images' => 'required',
            'location_name' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
        ];
    }
}
