<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleVarients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_varient', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('model_id')->unsigned();
            $table->enum('is_active', [0, 1])->default(1);
            $table->integer('created_by')->unsigned()->default(1001);
            $table->integer('updated_by')->unsigned()->default(1001);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('vehicle_varient', function($table) {
             $table->foreign('model_id')->references('id')->on('vehicle_model');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_varient');
    }
}
