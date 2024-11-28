<?php
use App\Http\Controllers\User\ShapeController;
use App\Http\Controllers\User\MaterialController;


Route::prefix('user')->group(function () {
    Route::apiResource('shapes', ShapeController::class);
    Route::apiResource('materials', MaterialController::class);
});
