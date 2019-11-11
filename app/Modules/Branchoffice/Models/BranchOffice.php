<?php

namespace App\Modules\Branchoffice\Models;

use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{
    //
    protected $table = 'branch_office';

    public function provinces(){
        return $this->belongsTo('App\Modules\Province\Models\Province', 'province_id');
    }

    public function cities(){
        return $this->belongsTo('App\Modules\City\Models\City', 'city_id');
    }
}
