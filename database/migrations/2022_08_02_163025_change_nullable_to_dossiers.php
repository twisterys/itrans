<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNullableToDossiers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dossiers', function (Blueprint $table) {
            $table->date('date')->nullable()->change();
            $table->string('compagnie')->nullable()->change();
            $table->string('navire')->nullable()->change();
            $table->string('provenance')->nullable()->change();
            $table->string('destination')->nullable()->change();
            $table->date('date_arrive')->nullable()->change();
            $table->date('date_sortie')->nullable()->change();
            $table->integer('nbr_colis')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dossiers', function (Blueprint $table) {
            //
        });
    }
}
