<?php

namespace App\Http\Requests\Secured;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'appointment_date' => ['required', 'date', 'after:yesterday'],
            'appointment_time' => ['required', 'regex:/^(?:[01]?[0-9]|2[0-3]):[0-5][0-9]$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'appointment_date.required' => 'Please select an appointment date.',
            'appointment_date.date' => 'The appointment date must be a valid date.',
            'appointment_date.after' => 'The appointment date must be a future date.',
            'appointment_time.required' => 'Please select an appointment time.',
            'appointment_time.regex' => 'The appointment time must be in a valid 24-hour format (e.g., 15:00).',
        ];
    }


}
