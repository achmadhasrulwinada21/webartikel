<?php

namespace App\Model\Navbar;

use Illuminate\Database\Eloquent\Model;

class Navbarheader extends Model
{
    protected $table = 'navbar_header';
    protected $fillable = ['Judul','link'];
}
