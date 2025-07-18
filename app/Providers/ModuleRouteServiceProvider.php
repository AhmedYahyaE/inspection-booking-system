<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ModuleRouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $modulesPath = base_path('Modules');
        if (is_dir($modulesPath)) {
            foreach (scandir($modulesPath) as $module) {
                $routeFile = $modulesPath . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'routes.php';
                if (is_file($routeFile)) {
                    Route::middleware('api')->group($routeFile);
                }
            }
        }
    }
}
