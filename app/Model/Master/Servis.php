<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class Servis extends Model
{
    protected $table = 'service';
    protected $fillable = ['nama','foto','ket','status','link'];
}
