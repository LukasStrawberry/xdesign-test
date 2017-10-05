<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleOwnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\Model\Vehicle\Owner::TABLE_NAME, function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->string('name');
            $table->string('profession');

            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on(\App\Model\Vehicle\OwnerCompany::TABLE_NAME);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\Model\Vehicle\Owner::TABLE_NAME);
    }
}
