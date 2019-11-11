<?php

use App\Model\Setup\Settingweb;
use Illuminate\Database\Seeder;

class Settingseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = new Settingweb();
        $setting->title               = "Adira Admin";
        $setting->nm_web              = "Adira Company";
        $setting->link_web            = "http://adira.local";
        $setting->logo_web            = "assets/logo_web/Cold cup 22 oz.jpg";
        $setting->nm_perusahaan       = "Graha Adira";
        $setting->alamat              = "MT. Haryono Kav.42 Jakarta 12780";
        $setting->fax                 = "+62-21 2966 7345";
        $setting->logo_sosmed1        = "data_file/logo_sosmed/fb.jpg";
        $setting->link_sosmed1        = "www.facebook.com";
        $setting->logo_sosmed2        = "data_file/logo_sosmed/ig.jpg";
        $setting->link_sosmed2        = "www.instagram.com";
        $setting->logo_sosmed3        = "data_file/logo_sosmed/tw.jpg";
        $setting->link_sosmed3        = "www.twitter.com";
        $setting->copyright           = "copyright adira";
        $setting->no_telp             = "+62-21 2966 7373";
        $setting->kode                = "001";
        $setting->alt_teks            = "adira";
        $setting->alt_teks_fb         = "adira";
        $setting->alt_teks_ig         = "adira";
        $setting->alt_teks_twit       = "adira";
        $setting->save();
    }
}
