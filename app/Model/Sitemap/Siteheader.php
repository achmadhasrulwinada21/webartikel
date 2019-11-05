<?php

namespace App\Model\Sitemap;

use Illuminate\Database\Eloquent\Model;

class Siteheader extends Model
{
    protected $table = 'sitemap_header';
    protected $fillable = ['Judul','link'];
}
