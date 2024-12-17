<?php

namespace App\Providers;

use App\Services\RouteManager;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentColor;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('routemanager', function ($app) {
            return new RouteManager();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Schema::defaultStringLength(191);
        Model::unguard();

        FilamentColor::register([
            'primary' => "#00993c",

        ]);

    }
}
