<?php

namespace App\Modules\City\Providers;

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
        $this->loadTranslationsFrom(module_path('city', 'Resources/Lang', 'app'), 'city');
        $this->loadViewsFrom(module_path('city', 'Resources/Views', 'app'), 'city');
        $this->loadMigrationsFrom(module_path('city', 'Database/Migrations', 'app'), 'city');
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('city', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('city', 'Database/Factories', 'app'));
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
