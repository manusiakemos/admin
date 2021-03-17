<?php

namespace Manusiakemos\Admin;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Route;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../src/Http/Controllers/Admin' => app_path('/Http/Controllers/Admin'),
            __DIR__ . '/../src/Models' => app_path('/Models'),
            __DIR__ . '/../src/Http/Middleware' => app_path('/Http/Middleware'),
            __DIR__ . '/../database/migrations' => database_path('migrations'),
            __DIR__ . '/../resources/images' => resource_path('admin/images'),
            __DIR__ . '/../resources/js' => resource_path('admin/js'),
            __DIR__ . '/../resources/lang' => resource_path('lang'),
            __DIR__ . '/../resources/sass' => resource_path('admin/sass'),
            __DIR__ . '/../resources/views' => resource_path('views/vendor/admin'),
            __DIR__ . '/../routes' => base_path('routes'),
        ], 'admin');

        $this->publishes([
            __DIR__ . '/../src/View' => app_path('/View'),
            __DIR__ . '/../resources/views/components' => resource_path('views/vendor/admin/components'),
        ], 'component');
    }
}
