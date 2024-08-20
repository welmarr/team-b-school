<?php

namespace App\Http\Requests\Secured;

use Illuminate\Foundation\Http\FormRequest;

class SubmitEstimationRequest extends FormRequest
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
            'budget' => ['required', 'min:1'],
            'duration' => ['required', 'min:1'],
        ];
    }
    public function messages(): array
    {
        return [
            'budget.required' => 'The budget is required and cannot be left empty.',
            'budget.min' => 'The budget must be at least :min.',
            'duration.required' => 'The duration is required and cannot be left empty.',
            'duration.min' => 'The duration must be at least :min.',
        ];
    }
}
