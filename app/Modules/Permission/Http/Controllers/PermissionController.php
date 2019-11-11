<?php

namespace App\Modules\Permission\Http\Controllers;

use Str;
use DB;
use App\User;
use App\Model\Master\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function savePermission($permissions) {

        // check first permission alreadyExist or not
        foreach ($permissions as $permission) {            
            $check = DB::table('permissions')->where("slug",Str::slug($permission['name'],'-'))->exists();
            
            if(!$check) {
                $p                  = DB::table('permissions')
                                    ->insert([
                                        "name" => $permission['name'],
                                        "guard_name" => "web",
                                        "slug"   => Str::slug($permission['name'],'-')
                                    ]);
            }
        }

        return true;
    }
}
