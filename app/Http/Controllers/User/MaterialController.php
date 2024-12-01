<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Http\Requests\User\Material\StoreMaterialRequest;
use App\Http\Requests\User\Material\UpdateMaterialRequest;

class MaterialController extends Controller
{
    /**
     * Display a listing of the materials.
     * GET: /api/user/materials
     */
    public function index()
    {
        $materials = Material::with('shapes')->get();
        return successResponse($materials, 'Materials retrieved successfully');
    }

    /**
     * Store a newly created material in storage.
     * POST: /api/user/materials
     */
    public function store(StoreMaterialRequest $request)
    {
        $material = Material::create($request->validated());
        return successResponse($material, 'Material created successfully', 201);
    }

    /**
     * Display the specified material.
     * GET: /api/user/materials/{id}
     */
    public function show($id)
    {
        $material = Material::with('shapes')->find($id);

        if (!$material) {
            return errorResponse('Material not found', 404);
        }

        return successResponse($material, 'Material retrieved successfully');
    }

    /**
     * Update the specified material in storage.
     * PUT/PATCH: /api/user/materials/{id}
     */
    public function update(UpdateMaterialRequest $request, $id)
    {
        $material = Material::find($id);

        if (!$material) {
            return errorResponse('Material not found', 404);
        }

        $material->update($request->validated());

        return successResponse($material, 'Material updated successfully');
    }

    /**
     * Remove the specified material from storage.
     * DELETE: /api/user/materials/{id}
     */
    public function destroy($id)
    {
        $material = Material::find($id);

        if (!$material) {
            return errorResponse('Material not found', 404);
        }

        $material->delete();

        return successResponse(null, 'Material deleted successfully');
    }

    /**
     * Calculate the total area of shapes associated with a specific material.
     * GET: /api/user/materials/{id}/total-area
     */
    public function calculateTotalArea($id)
    {
        $material = Material::with('shapes')->find($id);

        if (!$material) {
            return errorResponse('Material not found', 404);
        }

        $totalArea = $material->shapes()->sum('area');

        return successResponse([
            'material_id' => $id,
            'material_name' => $material->name,
            'total_area' => $totalArea,
        ], 'Total area calculated successfully');
    }
}
