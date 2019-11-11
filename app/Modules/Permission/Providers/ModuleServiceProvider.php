<?php

namespace App\Modules\Permission\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(module_path('permission', 'Resources/Lang', 'app'), 'permission');
        $this->loadViewsFrom(module_path('permission', 'Resources/Views', 'app'), 'permission');
        $this->loadMigrationsFrom(module_path('permission', 'Database/Migrations', 'app'), 'permission');
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('permission', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('permission', 'Database/Factories', 'app'));
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
