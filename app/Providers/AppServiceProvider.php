<?php

namespace App\Providers;

use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
// use Spatie\Permission\Models\Permission;
use App\Modules\Permission\Http\Controllers\PermissionController as Permission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $permissions = [
            [
                "name"              => "View Role",
                "description"       => "to view role"
            ],
            [
                "name"              => "Create Role",
                "description"       => "to Create role"
            ],
            [
                "name"              => "Edit Role",
                "description"       => "to Edit role"
            ],
            [
                "name"              => "Delete User",
                "description"       => "to Delete User"
            ],
            [
                "name"              => "View User",
                "description"       => "to view User"
            ],
            [
                "name"              => "Create User",
                "description"       => "to Create User"
            ],
            [
                "name"              => "Edit User",
                "description"       => "to Edit User"
            ],
            [
                "name"              => "Delete User",
                "description"       => "to Delete User"
            ]
        ];

        // Save Permission
        $permission                 = new Permission;
        $permission->savePermission($permissions);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
