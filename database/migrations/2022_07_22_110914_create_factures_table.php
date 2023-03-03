<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->nullable();
            $table->decimal('montant_ht', 8, 2)->nullable();
            $table->decimal('montant_ttc', 8, 2)->nullable();
            $table->decimal('tax', 8, 2)->nullable();
            $table->string('paiement_statut')->nullable();
            $table->date('facture_date')->nullable();
            $table->date('echeance_date')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->unsignedBigInteger('shema_id')->nullable();
            $table->foreign('shema_id')->references('id')->on('shemas');
            $table->longText('note')->nullable();
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
        Schema::dropIfExists('factures');
    }
}
