<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\Model\Vehicle\Model::TABLE_NAME, function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->string('name');
            $table->boolean('is_hgv');

            $table->unsignedBigInteger('manufacturer_id');
            $table->foreign('manufacturer_id')->references('id')->on(\App\Model\Vehicle\Manufacturer::TABLE_NAME);
        });
    }

    /**
     * Reverse the migrations.s
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\Model\Vehicle\Model::TABLE_NAME);
    }
}
