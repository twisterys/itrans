<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('matricule');
            $table->string('categorie');
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naiss');
            $table->string('situation_familiale');
            $table->string('nationalite');
            $table->string('cin');
            $table->integer('nbre_enfant');
            $table->string('tele');
            $table->string('sexe');
            $table->integer('nb_deduction');
            $table->string('transport');
            $table->string('adress');
            $table->string('ville');
            $table->string('fonction');
            $table->string('section');
            $table->date('date_embauche');
            $table->date('date_depart');
            $table->double('salaire_base')->nullable();
            $table->double('taux_horaire')->nullable();
            $table->string('banque');
            $table->string('N_Cmp_Banc');
            $table->string('mode_reglement');
            $table->double('prime_presentation');
            $table->double('prime_panier');
            $table->double('prime_logement');
            $table->string('retraite');
            $table->string('cnss');
            $table->date('date_affiliation');
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
        Schema::dropIfExists('people');
    }
}
