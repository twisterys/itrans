<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('num_EORI');
            $table->date('date');
            $table->string('driver');
            $table->string('mat_camion');
            $table->string('mat_remorque');
            $table->string('mat_contenaire');
            $table->string('compagnie');
            $table->string('navire');
            $table->string('provenance');
            $table->string('destination');
            $table->date('date_chargement');
            $table->date('date_embarque');
            $table->string('observation')->nullable();
            $table->double('tarre');
            $table->double('poid_brut');
            $table->integer('nbr_colis');
            $table->double('frais_peage');
            $table->double('frais_TMSA');
            $table->double('montant_fret');
            $table->double('devise');
            $table->string('cours');
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
        Schema::dropIfExists('exports');
    }
}
