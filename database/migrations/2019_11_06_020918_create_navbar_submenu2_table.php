<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavbarSubmenu2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navbar_submenu2', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul_sub2');
            $table->string('link_sub2');
            $table->unsignedBigInteger('id_sub');
            $table->timestamps();
            $table->foreign('id_sub')
				->references('id')->on('navbar_submenu')
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
        Schema::dropIfExists('navbar_submenu2');
    }
}
