<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagasinagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magasinages', function (Blueprint $table) {
            $table->id();
            $table->string('client');
            $table->date('date_entree');
            $table->date('date_sortie')->nullable();
            $table->string('mat_entree');
            $table->string('mat_sortie')->nullable();
            $table->foreignId('depot_id')->constrained();
            $table->double('prix');
            $table->softDeletes();
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
        Schema::dropIfExists('magasinages');
    }
}
