<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDossierItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossier_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->string('client');
            $table->string('importateur');
            $table->string('exportateur');
            $table->string('transitaire');
            $table->string('marchandise');
            $table->string('dum');
            $table->integer('numb_colis');
            $table->double('poid_brute');
            $table->string('observ')->nullable();
            $table->foreignId('dossier_id')->constrained();
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
        Schema::dropIfExists('dossier_items');
    }
}
