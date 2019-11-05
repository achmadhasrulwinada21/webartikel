<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';
    protected $fillable = ['nama','foto','ket','status','link'];
}
