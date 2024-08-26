<?php

namespace App\Http\Requests\Secured;

use Illuminate\Foundation\Http\FormRequest;

class ToolMovementRequest extends FormRequest
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
            'action_type' => ['required', 'string', 'in:scrap,add'],
            'qty' => ['required', 'integer'],
            'memo' => ['nullable', 'string', 'min:2'],
        ];
    }

    public function messages(): array
    {
        return [
            'action_type.required' => 'The action type is required.',
            'action_type.string' => 'The action type must be a string.',
            'action_type.in' => 'The action type must be either scrap or add.',
            'qty.required' => 'The quantity is required.',
            'qty.integer' => 'The quantity must be an integer.',
        ];
    }
}
