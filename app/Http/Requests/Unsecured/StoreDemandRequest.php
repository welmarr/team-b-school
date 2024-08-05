<?php

namespace App\Http\Requests\Unsecured;

use Illuminate\Foundation\Http\FormRequest;

class StoreDemandRequest extends FormRequest
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phonenumber' => 'required|numeric',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'zipcode' => 'required|numeric',
            'brand' => 'required|string|max:255|exists:t_car_brands,id',
            'year' => 'required|numeric|digits:4',
            'model' => 'required|string|max:255|exists:t_car_models,id',
            'filepond' => 'required|array',
            'filepond.*' => 'exists:t_temporary_files,folder', // Check each element in the array
            'memo' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'firstname.required' => 'The first name field is required.',
            'firstname.string' => 'The first name must be a string.',
            'firstname.max' => 'The first name may not be greater than 255 characters.',
            'lastname.required' => 'The last name field is required.',
            'lastname.string' => 'The last name must be a string.',
            'lastname.max' => 'The last name may not be greater than 255 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email may not be greater than 255 characters.',
            'phonenumber.required' => 'The phone number field is required.',
            'phonenumber.numeric' => 'The phone number must be a number.',
            'address1.required' => 'The address1 field is required.',
            'address1.string' => 'The address1 must be a string.',
            'address1.max' => 'The address1 may not be greater than 255 characters.',
            'address2.string' => 'The address2 must be a string.',
            'address2.max' => 'The address2 may not be greater than 255 characters.',
            'state.required' => 'The state field is required.',
            'state.string' => 'The state must be a string.',
            'state.max' => 'The state may not be greater than 255 characters.',
            'state.exists' => 'The selected state is invalid.',
            'city.string' => 'The city must be a string.',
            'city.max' => 'The city may not be greater than 255 characters.',
            'zipcode.required' => 'The zip code field is required.',
            'zipcode.numeric' => 'The zip code must be a number.',
            'brand.required' => 'The brand field is required.',
            'brand.string' => 'The brand must be a string.',
            'brand.max' => 'The brand may not be greater than 255 characters.',
            'brand.exists' => 'The brand does not appear in our database.',
            'year.required' => 'The year field is required.',
            'year.numeric' => 'The year must be a number.',
            'year.digits' => 'The year must be 4 digits.',
            'model.string' => 'The model must be a string.',
            'model.max' => 'The model may not be greater than 255 characters.',
            'model.exists' => 'The model does not appear in our database.',
            'filepond.required' => 'Images is required.',
            'filepond.array' => 'Something wrong. Try again.',
            'filepond.*.exists' => 'Something wrong. Try again.',
            'memo.string' => 'The memo must be a string.',
            'memo.max' => 'The memo may not be greater than 1000 characters.',
        ];
    }
}
