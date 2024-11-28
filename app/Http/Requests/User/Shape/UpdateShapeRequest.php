<?php

namespace App\Http\Requests\User\Shape;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShapeRequest extends FormRequest
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
            'user_id' => 'sometimes|exists:users,id',
            'shape_type' => 'sometimes|string',
            'dimensions' => 'sometimes|array',
            'material_id' => 'sometimes|exists:materials,id',
            'area' => 'sometimes|numeric',
            'volume' => 'sometimes|numeric',
            'weight' => 'sometimes|numeric',
        ];
    }
}
