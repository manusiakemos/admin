<?php

namespace Manusiakemos\Admin;

use Illuminate\Support\ServiceProvider;

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
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->publishes([
            __DIR__ . '/../src/Http/Controllers/Admin' => app_path('/Http/Controllers/Admin'),
            __DIR__ . '/../database/migrations' => database_path('migrations'),
            __DIR__ . '/../src/View' => app_path('/View'),
            __DIR__ . '/../resources/images' => resource_path('admin/images'),
            __DIR__ . '/../resources/js' => resource_path('admin/js'),
            __DIR__ . '/../resources/lang' => resource_path('lang'),
            __DIR__ . '/../resources/sass' => resource_path('admin/sass'),
            __DIR__ . '/../resources/views' => resource_path('views/vendor/admin'),
        ],'admin');
    }
}
