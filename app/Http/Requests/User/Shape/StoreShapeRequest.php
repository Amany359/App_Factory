<?php

namespace App\Http\Requests\User\Shape;

use Illuminate\Foundation\Http\FormRequest;

class StoreShapeRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'shape_type' => 'required|string',
            'dimensions' => 'required|array',
            'material_id' => 'required|exists:materials,id',
            'area' => 'required|numeric',
            'volume' => 'required|numeric',
            'weight' => 'required|numeric',
        ];
    }
}
