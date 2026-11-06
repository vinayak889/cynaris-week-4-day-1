<?php

use App\Http\Controllers\Api\ApiItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public route or test route
Route::get('/health', function () {
    return response()->json(['status' => 'API is running successfully']);
});

// Protected routes using Laravel Sanctum Token Authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // 5 RESTful API Endpoints handled by ApiItemController
    Route::apiResource('items', ApiItemController::class);
});
