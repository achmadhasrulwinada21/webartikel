<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Banner extends Eloquent {
    protected $table = 'banner';
    protected $fillable = ['foto','status','link','alt_teks'];
}
