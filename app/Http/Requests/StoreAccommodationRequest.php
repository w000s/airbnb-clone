<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccommodationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'location' => 'required',
            'description' => 'required',
            'facilities' => 'nullable',
            'beds' => 'nullable',
            'bedrooms' => 'nullable',
            'maximum_of_guests' => 'required',
            'price' => 'required',
            'images' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'location.required' => 'A location is required',
            'description.required' => 'A description is required',
            'maximum_of_guests.required' => 'Defining the maximum of guests is required',
            'price.required' => 'Defining the price is required',
            'images.required' => 'Uploading images of the tiny house is a required field',

        ];
    }
}
