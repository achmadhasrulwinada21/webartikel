<?php

namespace App\Model\Setup;

use Illuminate\Database\Eloquent\Model;

class Settingweb extends Model
{
     protected $table = 'settingweb';
    protected $fillable = ['title','nm_web','link_web','logo_web','nm_perusahaan','alamat','fax','logo_sosmed1','link_sosmed1','logo_sosmed2','link_sosmed2','logo_sosmed3','link_sosmed3','copyright','no_telp'];
}
