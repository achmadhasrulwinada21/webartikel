<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavbarSubmenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navbar_submenu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul_sub');
            $table->string('link_sub');
            $table->unsignedBigInteger('id_navbar');
            $table->timestamps();
            $table->foreign('id_navbar')
				->references('id')->on('navbar_header')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navbar_submenu');
    }
}
