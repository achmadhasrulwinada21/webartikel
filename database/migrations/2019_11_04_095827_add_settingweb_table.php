<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingwebTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('settingweb', function($table) {
            $table->string('nm_perusahaan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('fax')->nullable();
            $table->string('logo_sosmed1')->nullable();
            $table->string('link_sosmed1')->nullable();
            $table->string('logo_sosmed2')->nullable();
            $table->string('link_sosmed2')->nullable();
            $table->string('logo_sosmed3')->nullable();
            $table->string('link_sosmed3')->nullable();
            $table->string('copyright')->nullable();
           });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('settingweb', function($table) {
            $table->dropColumn('nm_perusahaan');
            $table->dropColumn('alamat');
            $table->dropColumn('no_telp');
            $table->dropColumn('fax');
            $table->dropColumn('logo_sosmed1');
            $table->dropColumn('link_sosmed1');
            $table->dropColumn('logo_sosmed2');
            $table->dropColumn('link_sosmed2');
            $table->dropColumn('logo_sosmed3');
            $table->dropColumn('link_sosmed3');
            $table->dropColumn('copyright');
        });
    }
}
