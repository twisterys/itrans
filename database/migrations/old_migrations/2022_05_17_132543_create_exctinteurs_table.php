<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExctinteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exctinteurs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client');
            $table->string('type_extinteur');
            $table->integer('poids');
            $table->date('date_last_control');
            $table->date('date_next_control');
            $table->foreignId('vehicle_id')->constrained();
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
        Schema::dropIfExists('exctinteurs');
    }
}
