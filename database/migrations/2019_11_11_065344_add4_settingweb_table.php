<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add4SettingwebTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('settingweb', function($table) {
            $table->string('alt_teks_fb')->after('alt_teks')->nullable();
            $table->string('alt_teks_ig')->after('alt_teks_fb')->nullable();
            $table->string('alt_teks_twit')->after('alt_teks_ig')->nullable();
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
            $table->dropColumn('alt_teks_fb');
            $table->dropColumn('alt_teks_ig');
            $table->dropColumn('alt_teks_twit');
           });
    }
}
