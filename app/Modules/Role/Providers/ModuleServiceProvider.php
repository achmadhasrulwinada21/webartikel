<?php

namespace App\Modules\Role\Providers;

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
        $this->loadTranslationsFrom(module_path('role', 'Resources/Lang', 'app'), 'role');
        $this->loadViewsFrom(module_path('role', 'Resources/Views', 'app'), 'role');
        $this->loadMigrationsFrom(module_path('role', 'Database/Migrations', 'app'), 'role');
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('role', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('role', 'Database/Factories', 'app'));
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
