<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisiteTechniqueTacosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visite_technique_tacos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref');
            $table->date('date_last_visit');
            $table->date('date_next_visit');
            $table->foreignId('taco_id')->constrained();
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
        Schema::dropIfExists('visite_technique_tacos');
    }
}
