<?php

namespace App\Modules\Branchoffice\Providers;

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
        $this->loadTranslationsFrom(module_path('branchoffice', 'Resources/Lang', 'app'), 'branchoffice');
        $this->loadViewsFrom(module_path('branchoffice', 'Resources/Views', 'app'), 'branchoffice');
        $this->loadMigrationsFrom(module_path('branchoffice', 'Database/Migrations', 'app'), 'branchoffice');
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('branchoffice', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('branchoffice', 'Database/Factories', 'app'));
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
