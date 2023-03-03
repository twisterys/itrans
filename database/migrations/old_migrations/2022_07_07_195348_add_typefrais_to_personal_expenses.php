<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypefraisToPersonalExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personal_expenses', function (Blueprint $table) {
            $table->unsignedBigInteger('typeFrais_id')->nullable();
            $table->foreign('typeFrais_id')->references('id')->on('type_frais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personal_expenses', function (Blueprint $table) {
            $table->dropColumn('typeFrais_id');
            $table->dropForeign('typeVehicle_id');
        });
    }
}
