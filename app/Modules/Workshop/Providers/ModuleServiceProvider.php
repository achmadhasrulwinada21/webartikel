<?php

namespace App\Modules\Workshop\Providers;

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
        $this->loadTranslationsFrom(module_path('workshop', 'Resources/Lang', 'app'), 'workshop');
        $this->loadViewsFrom(module_path('workshop', 'Resources/Views', 'app'), 'workshop');
        $this->loadMigrationsFrom(module_path('workshop', 'Database/Migrations', 'app'), 'workshop');
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('workshop', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('workshop', 'Database/Factories', 'app'));
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
