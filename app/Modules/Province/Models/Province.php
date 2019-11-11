<?php

namespace App\Modules\Province\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    protected $table = 'province';

    public function cities(){
        return $this->hasMany("App\Modules\City\Models\City", "province_id");
    }
}
