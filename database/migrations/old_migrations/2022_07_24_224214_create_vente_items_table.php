<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenteItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vente_items', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->decimal('tax', 8, 2)->nullable();
            $table->decimal('montant_ht', 8, 2)->nullable();
            $table->decimal('qte', 8, 2)->nullable();
            $table->decimal('prix_unitaire', 8, 2)->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('vente_id');
            $table->foreign('vente_id')->references('id')->on('ventes');
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
        Schema::dropIfExists('vente_items');
    }
}
