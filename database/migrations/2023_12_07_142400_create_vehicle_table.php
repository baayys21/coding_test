<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_vehicle', function (Blueprint $table) {
            $table->id();
            $table->string('merek');
            $table->string('model');
            $table->string('nomor_plat');
            $table->integer('tarif');
            $table->integer('flag_active');
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
        Schema::dropIfExists('m_vehicle');
    }
}
