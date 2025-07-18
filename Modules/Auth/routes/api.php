<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Controllers\AuthController;

Route::prefix('api/v1/auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});
