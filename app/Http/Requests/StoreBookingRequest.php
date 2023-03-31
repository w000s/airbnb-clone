<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'start_date' => 'required|date|after:tomorrow',
            'end_date' => 'required|date|after:start_date',
            'status' => 'nullable',
            'user_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'start_date.required' => 'Please select an available date to book.',
            'end_date.required' => 'Please select an available date to book.',
        ];
    }

    public function all($keys = null)
    {
        $allValues = parent::All();
        $allValues['status'] = 'booked';
        if (Auth::id()) {
            $allValues['user_id'] = Auth::id();
        }
        return $allValues;
    }
}
