<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelUservehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rel_uservehicle', function (Blueprint $table) {
            $table->id();
            $table->integer('id_vehicle');
            $table->integer('id_users');
            $table->date('datefrom');
            $table->date('dateto');
            $table->integer('flag_active')->default(1);
            $table->integer('createdBy');
            $table->datetime('created_at');
            $table->integer('updatedBy')->nullable();
            $table->datetime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rel_uservehicle');
    }
}
