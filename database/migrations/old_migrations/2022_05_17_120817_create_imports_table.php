<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('manifeste');
            $table->integer('num_EORI');
            $table->date('date');
            $table->integer('num_connaissement');
            $table->string('driver');
            $table->string('compagnie');
            $table->string('navire');
            $table->string('provenance');
            $table->string('destination');
            $table->date('date_arrive');
            $table->date('date_sortie');
            $table->string('observation')->nullable();
            $table->double('tarre');
            $table->double('poid_brut');
            $table->integer('nbr_colis');
            $table->string('type');
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
        Schema::dropIfExists('imports');
    }
}
