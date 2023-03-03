<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnicalVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technical_visits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref');
            $table->date('date_last_visit');
            $table->date('date_next_visit');
            $table->string('visit_disque');
            $table->string('vignette');
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
        Schema::dropIfExists('technical_visits');
    }
}
