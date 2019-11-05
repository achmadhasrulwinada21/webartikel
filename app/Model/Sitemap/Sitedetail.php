<?php

namespace App\Model\Sitemap;

use Illuminate\Database\Eloquent\Model;

class Sitedetail extends Model
{
    protected $table = 'sitemap_detail';
    protected $fillable = ['judul_detail','link_detail','id_sitemap'];
}
