<?php

namespace App\Http\Requests\Unsecured;

use Illuminate\Foundation\Http\FormRequest;

class TrackRepairRequest extends FormRequest // Corrected class name
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reference' => ['required', 'string', 'exists:t_requests,reference']
        ];
    }

    public function messages()
    {
        return [
            'reference.exists' => 'The reference code you entered is not valid. Please try again.',
        ];
    }
}
