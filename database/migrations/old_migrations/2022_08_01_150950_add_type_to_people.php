<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToPeople extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('people', function (Blueprint $table) {
            $table->string('matricule')->nullable()->change();
            $table->string('categorie')->nullable()->change();
            $table->string('nom')->nullable()->change();
            $table->string('prenom')->nullable()->change();
            $table->date('date_naiss')->nullable()->change();
            $table->string('situation_familiale')->nullable()->change();
            $table->string('nationalite')->nullable()->change();
            $table->string('cin')->nullable()->change();
            $table->integer('nbre_enfant')->nullable()->change();
            $table->string('tele')->nullable()->change();
            $table->string('sexe')->nullable()->change();
            $table->integer('nb_deduction')->nullable()->change();
            $table->string('transport')->nullable()->change();
            $table->string('adress')->nullable()->change();
            $table->string('ville')->nullable()->change();
            $table->string('fonction')->nullable()->change();
            $table->string('section')->nullable()->change();
            $table->date('date_embauche')->nullable()->change();
            $table->date('date_depart')->nullable()->change();
            $table->string('banque')->nullable()->change();
            $table->string('N_Cmp_Banc')->nullable()->change();
            $table->string('mode_reglement')->nullable()->change();
            $table->decimal('prime_presentation', 10, 2)->nullable()->change();
            $table->decimal('prime_panier', 10, 2)->nullable()->change();
            $table->decimal('prime_logement', 10, 2)->nullable()->change();
            $table->string('retraite')->nullable()->change();
            $table->string('cnss')->nullable()->change();
            $table->date('date_affiliation')->nullable()->change();
            $table->string('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('people', function (Blueprint $table) {
            //
        });
    }
}
