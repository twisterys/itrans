<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnsFromVehicle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->date('date_debut_validite')->nullable()->change();
            $table->string('P_T_M_C_T')->nullable()->change();
            $table->dropColumn('immat_anterieur');
            $table->dropColumn('adress');
            $table->dropColumn('usage');
            $table->dropColumn('nbr_place');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            //
        });
    }
}
