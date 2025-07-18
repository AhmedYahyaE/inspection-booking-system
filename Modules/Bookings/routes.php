<?php

use Illuminate\Support\Facades\Route;
use Modules\Bookings\Controllers\BookingController;

Route::middleware('auth:sanctum')->prefix('api/v1/bookings')->group(function () {
    Route::get('/', [BookingController::class, 'index']);
    Route::post('/', [BookingController::class, 'store']);
    Route::delete('{id}', [BookingController::class, 'destroy']);
});
