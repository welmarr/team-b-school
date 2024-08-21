<?php

namespace App\Http\Requests\Secured;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDealershipProfileRequest extends FormRequest
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
            'dealership_name' => ['required', 'string', 'max:255'],
            'dealership_phone' => ['required', 'string', 'min:10'],
            'dealership_address_line_1' => ['nullable', 'required_with_all:new_dealership_city,new_dealership_state,new_dealership_zip', 'string', 'max:255'],
            'dealership_address_line_2' => ['nullable', 'string', 'max:255'],
            'dealership_city' => ['nullable', 'required_with_all:new_dealership_address_line_1,new_dealership_state,new_dealership_zip', 'string', 'max:255'],
            'dealership_state' => ['nullable', 'required_with_all:new_dealership_address_line_1,new_dealership_city,new_dealership_zip', 'string', 'max:255'],
            'dealership_zip' => ['nullable', 'required_with_all:new_dealership_address_line_1,new_dealership_city,new_dealership_state', 'string', 'max:255'],
        ];
    }
}
