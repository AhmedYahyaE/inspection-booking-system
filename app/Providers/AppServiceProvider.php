<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \Modules\Bookings\Repositories\BookingRepositoryInterface::class,
            \Modules\Bookings\Repositories\BookingRepository::class
        );
        $this->app->bind(
            \Modules\Teams\Repositories\TeamRepositoryInterface::class,
            \Modules\Teams\Repositories\TeamRepository::class
        );
        $this->app->bind(
            \Modules\Availability\Repositories\AvailabilityRepositoryInterface::class,
            \Modules\Availability\Repositories\AvailabilityRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
