<?php
use App\Http\Controllers\User\ShapeController;
use App\Http\Controllers\User\MaterialController;


Route::prefix('user')->group(function () {
    Route::apiResource('shapes', ShapeController::class);
    Route::apiResource('materials', MaterialController::class);
    Route::post('/user/shapes/calculate', [ShapeController::class, 'calculateProperties']);
  // Calculate the total area of shapes associated with a specific material
   Route::get('materials/{id}/total-area', [MaterialController::class, 'calculateTotalArea']);
});

