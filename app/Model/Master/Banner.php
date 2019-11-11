<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Banner extends Eloquent {
    protected $table = 'banner';
    protected $fillable = ['nama','foto','ket','status','link'];
}
