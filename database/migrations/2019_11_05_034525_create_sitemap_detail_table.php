<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitemapDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sitemap_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul_detail');
            $table->string('link_detail');
            $table->unsignedBigInteger('id_sitemap');
            $table->timestamps();
            $table->foreign('id_sitemap')
				->references('id')->on('sitemap_header')
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
        Schema::dropIfExists('sitemap_detail');
    }
}
