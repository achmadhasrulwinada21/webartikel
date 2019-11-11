<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBranchOffice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_office', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('province_id');
            $table->foreign('province_id')
				->references('id')->on('province')
                ->onDelete('cascade');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')
				->references('id')->on('city')
                ->onDelete('cascade');
            $table->longText('address');
            $table->string('phone_number');
            $table->string('office_type');
            $table->string('fax');
            $table->string('head_office')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_office');
    }
}
