<?php

use Illuminate\Support\Facades\Route;
use Modules\Tenants\Controllers\TenantController;

Route::middleware('auth:sanctum')->prefix('api/v1')->group(function () {
    Route::get('tenant', [TenantController::class, 'show']);
});
