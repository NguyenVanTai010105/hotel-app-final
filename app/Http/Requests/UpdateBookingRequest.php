<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'status' => 'required|in:pending,confirmed,cancelled,checked_in,checked_out',
            'notes' => 'nullable|string|max:2000',
        ];
    }
}
