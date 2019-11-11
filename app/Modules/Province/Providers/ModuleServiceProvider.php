<?php

namespace App\Modules\Province\Providers;

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
        $this->loadTranslationsFrom(module_path('province', 'Resources/Lang', 'app'), 'province');
        $this->loadViewsFrom(module_path('province', 'Resources/Views', 'app'), 'province');
        $this->loadMigrationsFrom(module_path('province', 'Database/Migrations', 'app'), 'province');
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('province', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('province', 'Database/Factories', 'app'));
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
