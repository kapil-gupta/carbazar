<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('is_active', [0,1])->default(1);
            $table->integer('created_by')->unsigned()->default(1001);
            $table->integer('updated_by')->unsigned()->default(1001);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_category');
    }
}
