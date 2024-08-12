<?php

namespace App\Http\Requests\Secured;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitRequest extends FormRequest
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
        $id = $this->route('unit');

        return [
            "name" => ["required","string", "min:2", "max:225", "unique:t_units,name," . $id],
            "description" => ["nullable","string", "max:225",],
            "abbreviation" => ["required","string", "max:225",],
        ];
    }
}
