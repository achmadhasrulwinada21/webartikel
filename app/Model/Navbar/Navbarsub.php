<?php

namespace App\Model\Navbar;

use Illuminate\Database\Eloquent\Model;

class Navbarsub extends Model
{
    protected $table = 'navbar_submenu';
    protected $fillable = ['judul_sub','link_sub','id_navbar'];
}
