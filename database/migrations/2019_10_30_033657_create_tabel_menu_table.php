<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabelMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabel_menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('link');
            $table->string('icon');
            $table->unsignedBigInteger('childjudul');
            $table->unsignedBigInteger('id_jdl');
            $table->timestamps();
            $table->foreign('id_jdl')
				->references('id')->on('judul_menu')
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
        Schema::dropIfExists('tabel_menu');
    }
}
