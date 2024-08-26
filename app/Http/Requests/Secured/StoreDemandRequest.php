<?php

namespace App\Http\Requests\Secured;

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
     * @return array
     */
    public function rules()
    {
        return [
            'cars.*.brand' => 'required|string|max:255',
            'cars.*.year' => 'required|integer|min:1900',
            'cars.*.model' => 'required|string|max:255',
            'cars.*.memo' => 'nullable|string|max:255',
            'cars.*.filepond' => 'array',
            'cars.*.filepond.*' => 'required|string',
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'cars.*.brand.required' => 'The brand is required for each car.',
            'cars.*.year.required' => 'The year is required for each car.',
            'cars.*.model.required' => 'The model is required for each car.',
            'cars.*.filepond.*.required' => 'Each car must have at least one file uploaded.',
        ];
    }
}
