<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add2ArtikelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artikel', function($table) {
            $table->string('artikel_parent')->after('keyword')->nullable();
            $table->string('language')->after('artikel_parent')->nullable();
           });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('artikel', function($table) {
            $table->dropColumn('artikel_parent');
            $table->dropColumn('language');
        });
    }
}
