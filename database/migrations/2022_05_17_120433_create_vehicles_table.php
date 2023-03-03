<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('N_immatriculation');
            $table->string('immat_anterieur');
            $table->date('date_pre_mise_circul');
            $table->date('date_m_c_maroc');
            $table->date('date_mutation');
            $table->date('date_debut_validite');
            $table->string('usage');
            $table->string('proprietaire');
            $table->string('adress');
            $table->string('marque');
            $table->string('type');
            $table->string('modele');
            $table->string('genre');
            $table->string('num_chassis');
            $table->string('type_carburant');
            $table->integer('puissance_fiscale');
            $table->integer('nbr_cylindre');
            $table->integer('nbr_place');
            $table->double('P_T_A_C');
            $table->double('poids_a_vide');
            $table->double('P_T_M_C_T');
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
        Schema::dropIfExists('vehicles');
    }
}
