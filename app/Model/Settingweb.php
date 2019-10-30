<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Settingweb extends Model
{
     protected $table = 'settingweb';
    protected $fillable = ['title','nm_web','link_web','logo_web'];
}
