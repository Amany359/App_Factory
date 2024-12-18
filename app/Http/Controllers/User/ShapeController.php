<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; // Base Controller
use App\Models\Shape; // Shape Model
use App\Http\Requests\User\Shape\StoreShapeRequest; // Store Validation Request
use App\Http\Requests\User\Shape\UpdateShapeRequest; // Update Validation Request
use App\Http\Requests\User\Shape\CalculatePropertiesRequest; // CalculateProperties Validation Request

use Illuminate\Http\Request;

class ShapeController extends Controller
{
    /**
     * Display a listing of the shapes.
     * GET: /api/user/shapes
     */
    public function index()
    {
        $shapes = Shape::with('material', 'user')->get();
        return successResponse($shapes, 'Shapes retrieved successfully');
    }

    /**
     * Store a newly created shape in storage.
     * POST: /api/user/shapes
     */
    public function store(StoreShapeRequest $request)
    {
        $shape = Shape::create($request->validated());
        return successResponse($shape, 'Shape created successfully', 201);
    }

    /**
     * Display the specified shape.
     * GET: /api/user/shapes/{id}
     */
    public function show($id)
    {
        $shape = Shape::with('material', 'user')->find($id);

        if (!$shape) {
            return errorResponse('Shape not found', 404);
        }

        return successResponse($shape, 'Shape retrieved successfully');
    }

    /**
     * Update the specified shape in storage.
     * PUT/PATCH: /api/user/shapes/{id}
     */
    public function update(UpdateShapeRequest $request, $id)
    {
        $shape = Shape::find($id);

        if (!$shape) {
            return errorResponse('Shape not found', 404);
        }

        $shape->update($request->validated());

        return successResponse($shape, 'Shape updated successfully');
    }

    /**
     * Remove the specified shape from storage.
     * DELETE: /api/user/shapes/{id}
     */
    public function destroy($id)
    {
        $shape = Shape::find($id);

        if (!$shape) {
            return errorResponse('Shape not found', 404);
        }

        $shape->delete();

        return successResponse(null, 'Shape deleted successfully');
    }

    public function calculateProperties(CalculatePropertiesRequest $request)
{
    // Validate the request and extract validated data
    $validated = $request->validated();

    $shapeType = $validated['shape_type']; // Type of shape (e.g., rectangle, cylinder)
    $dimensions = $validated['dimensions']; // Shape dimensions
    $density = $validated['density']; // Density of the material

    // Calculate volume based on shape type
    $volume = 0;
    if ($shapeType === 'rectangle') {
        $volume = $dimensions['length'] * $dimensions['width'] * $dimensions['height']; // Volume for a rectangle
    } elseif ($shapeType === 'cylinder') {
        $volume = pi() * pow($dimensions['radius'], 2) * $dimensions['height']; // Volume for a cylinder
    }

    // Calculate weight using density and volume
    $weight = $density * $volume;

    // Return a successful response with calculated properties
    return successResponse([
        'shape_type' => $shapeType,
        'volume' => $volume,
        'weight' => $weight,
    ], 'Properties calculated successfully');
}

}
