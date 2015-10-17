<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleFeatures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_feature', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('category_id')->unsigned();
            $table->enum('is_active', [0, 1])->default(1);
            $table->integer('created_by')->unsigned()->default(1001);
            $table->integer('updated_by')->unsigned()->default(1001);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('vehicle_feature', function($table) {
             $table->foreign('category_id')->references('id')->on('vehicle_feture_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_feature');
    }
}
