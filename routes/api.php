<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::post("register",[AuthController::class,'register']);
Route::post("login",[AuthController::class,'login']);

Route::middleware("auth:sanctum")->group(function () {
    Route::prefix('products')->group(function () {
        // Get All
        Route::get("/", [ProductController::class, 'index']);
        // Get By ID
        Route::get('/{id}', [ProductController::class, 'show']);

        // Add New
        Route::post('/', [ProductController::class, 'store']);

        // Update >put . upload File
        Route::post('/{id}', [ProductController::class, 'update']);

        // Delete Item
        Route::delete("/{id}", [ProductController::class, 'destroy']);
    });
Route::post("logout",[AuthController::class,'logout']);


});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
