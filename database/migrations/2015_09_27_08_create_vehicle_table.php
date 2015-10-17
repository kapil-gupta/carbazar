<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('vehicle', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('category_id')->unsigned();
            $table->integer('varient_id')->unsigned();
            $table->enum('is_active', [0,1])->default(1);
            $table->integer('created_by')->unsigned()->default(1001);
            $table->integer('updated_by')->unsigned()->default(1001);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('vehicle', function($table) {
             $table->foreign('varient_id')->references('id')->on('common_attributes');
             $table->foreign('category_id')->references('id')->on('common_attributes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle');
    }
}
