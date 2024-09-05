<?php

namespace App\Http\Requests\Secured;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {

        // Check if the time is provided and adjust it if necessary
        if ($this->has('appointment_time')) {
            $appointmentTime = $this->appointment_time;

            // Split the time by ":" to get hours and minutes
            $timeParts = explode(':', $appointmentTime);

            // Ensure we have exactly two parts (hours and minutes)
            if (count($timeParts) === 2) {
                // Ensure length 2 for hours and minutes by padding with leading zeros if necessary
                $hours = str_pad($timeParts[0], 2, '0', STR_PAD_LEFT);
                $minutes = str_pad($timeParts[1], 2, '0', STR_PAD_LEFT);

                // Reconstruct the time in HH:mm format
                $formattedTime = $hours . ':' . $minutes;

                // Merge the corrected time back into the request data
                $this->merge(['appointment_time' => $formattedTime]);
            } else {
                // If time format is incorrect or has more/less than two parts, set it to null
                $this->merge(['appointment_time' => '00:00']);
            }
        }
        if ($this->has(['appointment_date', 'appointment_time'])) {
            $combinedDatetime = Carbon::createFromFormat('m/d/Y H:i', $this->appointment_date . ' ' . $this->appointment_time);
            $this->merge([
                'appointment_datetime' => $combinedDatetime->format('Y-m-d H:i'),
            ]);
        }
    }

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
            'appointment_datetime' => ['required', 'date', 'after_or_equal:' . \Carbon\Carbon::now()->setTimeZone('America/New_York')->format('Y-m-d H:i')],
        ];
    }

    public function messages(): array
    {
        return [
            'appointment_datetime.required' => 'Please select an appointment date.',
            'appointment_datetime.date' => 'The appointment date must be a valid date.',
            'appointment_datetime.after_or_equal' => 'Please, the date must be a after or equal to ' . \Carbon\Carbon::now()->setTimeZone('America/New_York') . '.',
            'appointment_date.date' => 'The appointment date must be a valid date.',
            'appointment_date.after' => 'The appointment date must be a future date.',
            'appointment_time.required' => 'Please select an appointment time.',
            'appointment_time.regex' => 'The appointment time must be in a valid 24-hour format (e.g., 15:00).',
        ];
    }
}
