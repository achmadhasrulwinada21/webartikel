<?php

namespace App\Modules\Award\Providers;

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
        $this->loadTranslationsFrom(module_path('award', 'Resources/Lang', 'app'), 'award');
        $this->loadViewsFrom(module_path('award', 'Resources/Views', 'app'), 'award');
        $this->loadMigrationsFrom(module_path('award', 'Database/Migrations', 'app'), 'award');
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('award', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('award', 'Database/Factories', 'app'));
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
