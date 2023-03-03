<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypevehicleToDossierVehicle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dossier_vehicle', function (Blueprint $table) {
            $table->unsignedBigInteger('typeVehicle_id')->nullable();
            $table->foreign('typeVehicle_id')->references('id')->on('type_vehicles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dossier_vehicle', function (Blueprint $table) {
            $table->dropColumn('typeVehicle_id');
            $table->dropForeign('typeVehicle_id');
        });
    }
}
