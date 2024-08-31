<?php

namespace App\Http\Requests\Unsecured;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
        //dd(request()->all());
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],

            'dealership_code' => ['sometimes', 'required_if:dealership_option,use_dealership', 'string', 'max:255', 'exists:t_dealerships,code'],

            'dealership_option' => ['required', 'string', 'in:use_dealership,create_dealership,simple_customer'],

            'new_dealership_name' => ['sometimes', 'required_if:dealership_option,create_dealership', 'string', 'max:255'],
            'new_dealership_phone' => ['sometimes', 'required_if:dealership_option,create_dealership', 'string', 'min:10', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'unique:t_dealerships,phone'],

            'new_dealership_address_line_1' => 'nullable|string|required_with_all:new_dealership_address_line_2,new_dealership_state,new_dealership_city,new_dealership_zip',
            'new_dealership_address_line_2' => 'nullable|string|required_with:new_dealership_address_line_1',
            'new_dealership_state' => 'nullable|string|required_with:new_dealership_address_line_1',
            'new_dealership_city' => 'nullable|string|required_with:new_dealership_address_line_1',
            'new_dealership_zip' => 'nullable|string|required_with:new_dealership_address_line_1',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'The first name is required.',
            'first_name.string' => 'The first name must be a string.',
            'first_name.max' => 'The first name may not be greater than 255 characters.',

            'last_name.required' => 'The last name is required.',
            'last_name.string' => 'The last name must be a string.',
            'last_name.max' => 'The last name may not be greater than 255 characters.',

            'email.required' => 'The email address is required.',
            'email.string' => 'The email address must be a string.',
            'email.email' => 'The email address must be a valid email address.',
            'email.max' => 'The email address may not be greater than 255 characters.',
            'email.unique' => 'The email address is already in use.',

            'phone.required' => 'The phone number is required.',
            'phone.string' => 'The phone number must be a string.',
            'phone.regex' => 'The phone number format is invalid. Examples: 123 456 7890, (123) 456-7890.',
            'phone.min' => 'The phone number must be at least 10 characters.',
            'phone.unique' => 'The phone number is already in use.',

            'password.required' => 'The password is required.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.letters' => 'The password must contain at least one letter.',
            'password.mixedCase' => 'The password must contain at least one uppercase letter and one lowercase letter.',
            'password.numbers' => 'The password must contain at least one number.',
            'password.symbols' => 'The password must contain at least one symbol.',

            'dealership_code.required_if' => 'The dealership code is required when joining a dealership.',

            'new_dealership_name.required_if' => 'The new dealership name is required when registering a dealership.',
            'new_dealership_name.string' => 'The new dealership name must be a string.',
            'new_dealership_name.max' => 'The new dealership name may not be greater than 255 characters.',

            'new_dealership_phone.required_if' => 'The new dealership phone is required when registering a dealership.',
            'new_dealership_phone.string' => 'The new dealership phone must be a string.',
            'new_dealership_phone.regex' => 'The phone number format is invalid. Examples: 123 456 7890, (123) 456-7890.',
            'new_dealership_phone.min' => 'The phone number must be at least 10 characters.',

            'new_dealership_address_line_1.required_with_all' => 'All address fields must be filled together or left empty.',
            'new_dealership_address_line_2.required_with' => 'All address fields must be filled together or left empty.',
            'new_dealership_state.required_with' => 'All address fields must be filled together or left empty.',
            'new_dealership_city.required_with' => 'All address fields must be filled together or left empty.',
            'new_dealership_zip.required_with' => 'All address fields must be filled together or left empty.',
        ];
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        //dd(parent::validationData());
        return parent::validationData();
    }
}
