<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::create(\App\Model\Vehicle\Vehicle::TABLE_NAME, function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->string('license_plate');
            $table->string('colour');
            $table->unsignedMediumInteger('seats_count');
            $table->unsignedSmallInteger('doors_count');
            $table->unsignedSmallInteger('wheels_count');
            $table->unsignedInteger('engine_cc');
            $table->boolean('has_boot');
            $table->boolean('has_trailer');
            $table->boolean('has_sunroof');
            $table->boolean('has_gps');
            $table->timestamps();

            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on(\App\Model\Vehicle\Type::TABLE_NAME);

            $table->unsignedBigInteger('fuel_type_id');
            $table->foreign('fuel_type_id')->references('id')->on(\App\Model\Vehicle\FuelType::TABLE_NAME);

            $table->unsignedBigInteger('model_id');
            $table->foreign('model_id')->references('id')->on(\App\Model\Vehicle\Model::TABLE_NAME);

            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on(\App\Model\Vehicle\Owner::TABLE_NAME);

            $table->unsignedBigInteger('transmission_id');
            $table->foreign('transmission_id')->references('id')->on(\App\Model\Vehicle\Transmission::TABLE_NAME);

            $table->unsignedBigInteger('usage_id');
            $table->foreign('usage_id')->references('id')->on(\App\Model\Vehicle\Usage::TABLE_NAME);

            $table->unsignedBigInteger('weight_category_id');
            $table->foreign('weight_category_id')->references('id')->on(\App\Model\Vehicle\WeightCategory::TABLE_NAME);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\Model\Vehicle\Vehicle::TABLE_NAME);
    }
}
