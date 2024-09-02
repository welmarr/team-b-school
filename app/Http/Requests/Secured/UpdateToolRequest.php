<?php

namespace App\Http\Requests\Secured;

use Illuminate\Foundation\Http\FormRequest;

class UpdateToolRequest extends FormRequest
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

        $id = "";
        if ($this->route('tool')) {
            $id = $this->route('tool')->id;
        }
        return [
            "name" => ["required", "string", "min:2", "max:225", "unique:t_tools,name," . $id],
            "alert" => ["required", "integer"],
            "description" => ["nullable", "string", "min:2", "max:225"],
            "type" => ["required", "exists:t_tool_types,id"],
            "unit" => ["required", "exists:t_units,id"],
            "tracked" => ["sometimes", "in:on"],
        ];
    }
}
