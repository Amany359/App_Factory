<?php

namespace App\Http\Requests\User\Shape;

use Illuminate\Foundation\Http\FormRequest;

class CalculatePropertiesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow the request for all authenticated users
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'shape_type' => 'required|string|in:rectangle,cylinder', // Shape type must be either rectangle or cylinder
            'dimensions' => 'required|array', // Dimensions must be provided as an array
            'dimensions.length' => 'required_if:shape_type,rectangle|numeric|min:0', // Length is required for rectangle shapes
            'dimensions.width' => 'required_if:shape_type,rectangle|numeric|min:0', // Width is required for rectangle shapes
            'dimensions.height' => 'required_if:shape_type,rectangle,cylinder|numeric|min:0', // Height is required for rectangle and cylinder shapes
            'dimensions.radius' => 'required_if:shape_type,cylinder|numeric|min:0', // Radius is required for cylinder shapes
            'density' => 'required|numeric|min:0', // Density is required and must be a positive number
        ];
    }

    /**
     * Custom error messages for validation.
     */
    public function messages(): array
    {
        return [
            'shape_type.required' => 'The shape type is required.',
            'shape_type.in' => 'The shape type must be either rectangle or cylinder.',
            'dimensions.required' => 'The dimensions field is required.',
            'dimensions.length.required_if' => 'The length is required for rectangle shapes.',
            'dimensions.width.required_if' => 'The width is required for rectangle shapes.',
            'dimensions.height.required_if' => 'The height is required for rectangle and cylinder shapes.',
            'dimensions.radius.required_if' => 'The radius is required for cylinder shapes.',
            'density.required' => 'The density is required.',
            'density.numeric' => 'The density must be a numeric value.',
            'density.min' => 'The density must be a positive value.',
        ];
    }
}
