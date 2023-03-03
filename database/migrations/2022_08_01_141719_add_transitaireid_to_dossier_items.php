<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransitaireidToDossierItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dossier_items', function (Blueprint $table) {
            $table->unsignedBigInteger('transitaire_id')->nullable();
            $table->foreign('transitaire_id')->references('id')->on('transitaires');
            $table->dropColumn('transitaire');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dossier_items', function (Blueprint $table) {
            $table->dropForeign('transitaire_id');
            $table->dropColumn('transitaire_id');
        });
    }
}
